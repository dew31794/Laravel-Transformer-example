<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Transformers\AccountList\AccountTransformer as AccountListTransformer;
use App\Transformers\AccountCreate\AccountTransformer as AccountCreateTransformer;
use App\Transformers\AccountSingle\AccountTransformer as AccountSingleTransformer;
use App\Transformers\AccountUpdate\AccountTransformer as AccountUpdateTransformer;
use App\Http\Requests\API\AccountCreateRequest;
use App\Http\Requests\API\AccountUpdateRequest;
use App\Http\Requests\API\AccountResetPasswordRequest;
use Carbon\Carbon;

class AccountController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            // 篩選有關聯資料表的資料回傳
            $account = Account::query();

            $account_list = fractal($account->get(), new AccountListTransformer)->toArray();

            return response()->json([
                'Status' => 'Success',
                'Data' => $account_list,
                'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
            ], 200);

        }catch(Exception $e){
            $message = "發生未知的錯誤：".$e->getMessage();
            $status_code = 500;

            return response()->json([
                'Status' => 'Failure',
                'ErrorMessage' => $message,
                'Code' => 500,
                'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountCreateRequest $request)
    {
        // 經過驗證的資料
        $request->validated();
        
        $data = Account::where('account', $request->account)->get();

        if(!count($data)){
            $account = array_merge($request->except(['_token','password_confirmation']), [
                'password'  => bcrypt($request->password),
            ]);

            $account = Account::create($account);
            
            $createAccount = fractal(Account::where('id', $account->id)->firstOrFail(), new AccountCreateTransformer);

            return $this->respondSuccess($createAccount);
        }else{
            $message = '課程編號已存在，請重新輸入。';
            $code = 422;

            return $this->respondError($message , $code);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);

        if(!empty($account)){
            $showAccount = fractal($account, new AccountSingleTransformer);

            return $this->respondSuccess($showAccount);
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountUpdateRequest $request, $id)
    {
        $account = Account::find($id);

        if(!empty($account)){
            if($account->update($request->all())){
                $updateAccount = fractal(Account::find($id), new AccountUpdateTransformer);

                return $this->respondSuccess($updateAccount);
            }else{
                $message = '更新失敗，請重新確認';
                $code = 422;
    
                return $this->respondError($message , $code);
            }
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);

        if(!empty($account)){
            if($account->delete()){
                $message = $account->name.' 帳號已刪除。';
                $code = 200;

                return $this->respondSuccessMsg($message , $code);
            }else{
                $message = '刪除失敗，請重新確認';
                $code = 422;
    
                return $this->respondError($message , $code);
            }
        }else{
            $message = '無任何資料被刪除，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
     * Remake the password field
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(AccountResetPasswordRequest $request)
    {

        $oldPassword = $request->input('old_password');
        $password = $request->input('password');

        $account = Account::where('account',$request->account)
                            ->where('token',$request->token)->first();

        if(!empty($account)){
            if (!Hash::check($oldPassword, $account->password)) {
                $message = '舊密碼輸入無效。';
                $code = 422;
    
                return $this->respondError($message , $code);
            }else{
                $request['password'] = bcrypt($request->password);

                // return $request->only('password');
                if($account->fill($request->only('password'))->save()){
                    $message = $account->staff->name.' 密碼已更新。';
                    $code = 200;
    
                    return $this->respondSuccessMsg($message , $code);
                }else{
                    $message = '密碼更新失敗。';
                    $code = 422;
        
                    return $this->respondError($message , $code);
                }
            }
        }else{
            $message = '無任何資料被刪除，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }
}
