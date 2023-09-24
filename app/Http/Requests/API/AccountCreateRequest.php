<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class AccountCreateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account'               => 'required|string|min:6|max:12|unique:accounts',
            'password'              => 'required|string|min:8|max:32|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'staff_id'              => 'required|integer|unique:accounts',
            'status'                => 'required|integer',
            // 'remark'                => 'nullable|string',
        ];
    }

    /**
     * Individually verified callback messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account.required'  => '請輸入帳號。',
            'account.string'    => '帳號請輸入英文字。',
            'account.min'       => '帳號請勿小於6個字。',
            'account.max'       => '帳號請勿超過12個字。',
            'account.unique'    => '帳號已存在，請重新輸入。',

            'password.required' => '請輸入密碼。',
            'password.string'   => '密碼請輸入文字。',
            'password.min'      => '密碼請勿小於8個字。',
            'password.max'      => '密碼請勿超過32個字。',
            'password.confirmed'=> '密碼與再次輸入密碼必須一樣。',

            'password_confirmation.required_with' => '請再次輸入密碼。',
            'password_confirmation.same'   => '密碼與再次輸入密碼必須一樣。',

            'staff_id.required' => '請輸入員工ID。',
            'staff_id.integer'  => '員工ID請輸入數字。',
            'staff_id.unique'   => '員工ID已存在(重複)，請重新輸入。',
            
            'status.required'   => '請輸入帳號狀態。',
            'status.integer'    => '帳號狀態請輸入數字。',

            // 'remark.required'  => '請輸入備註。',
            // 'remark.string'    => '備註請輸入文字。',
        ];
    }
}
