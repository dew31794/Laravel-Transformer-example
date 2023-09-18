<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\StaffInfo;
use App\Transformers\StaffInfoList\StaffInfoTransformer as StaffInfoListTransformer;
use App\Transformers\StaffInfoCreate\StaffInfoTransformer as StaffInfoCreateTransformer;
use App\Transformers\StaffInfoSingle\StaffInfoTransformer as StaffInfoSingleTransformer;
use App\Transformers\StaffInfoUpdate\StaffInfoTransformer as StaffInfoUpdateTransformer;
use App\Http\Requests\API\StaffInfoCreateRequest;
use App\Http\Requests\API\StaffInfoUpdateRequest;
use Carbon\Carbon;

class StaffInfoController extends ApiController
{
    /**
     * 顯示資料列表。
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            // 篩選有關聯資料表的資料回傳
            $staff_info = StaffInfo::whereHas('childrenProject', function ($query) {
                return $query;
            });

            $staff_list = fractal($staff_info->get(), new StaffInfoListTransformer)->toArray();

            return response()->json([
                'Status' => 'Success',
                'Data' => $staff_list,
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
     * 將資料存入資料表。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffInfoCreateRequest $request)
    {
        $data = StaffInfo::where('num', $request->num)->get();

        if(!count($data)){
            $staff_info = StaffInfo::create($request->except(['_token']));
            
            $createStaffInfo = fractal(StaffInfo::where('id', $staff_info->id)->firstOrFail(), new StaffInfoCreateTransformer);

            return $this->respondSuccess($createStaffInfo);
        }else{
            $message = '課程編號已存在，請重新輸入。';
            $code = 422;

            return $this->respondError($message , $code);
        }
    }

    /**
     * 顯示指定資料。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff_info = StaffInfo::find($id);

        if(!empty($staff_info)){
            $showStaff = fractal($staff_info, new StaffInfoSingleTransformer);

            return $this->respondSuccess($showStaff);
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
     * 更新資料表指定資料
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffInfoUpdateRequest $request, $id)
    {
        $staff_info = StaffInfo::find($id);

        if(!empty($staff_info)){
            $data = array(
                'name'          => $request->name,
                'gender'        => $request->gender,
                'phone'         => $request->phone,
                'email'         => $request->email,
                'arrival_date'  => $request->arrival_date,
                'resignation_date' => $request->resignation_date,
                'department'    => $request->department,
                'job_title'     => $request->job_title,
                'remark'        => $request->remark,
            );

            if($staff_info->update($data)){
                $updateStaff = fractal(StaffInfo::find($id), new StaffInfoUpdateTransformer);

                return $this->respondSuccess($updateStaff);
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
     * 從資料表內刪除指定資料
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff_info = StaffInfo::find($id);

        if(!empty($staff_info)){
            if($staff_info->delete()){
                $message = $staff_info->name.'員工資料已刪除。';
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
}
