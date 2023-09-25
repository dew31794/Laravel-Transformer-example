<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class AccountResetPasswordRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account'               => 'required|string|exists:accounts,account',
            'old_password'           => 'required|string',
            'password'              => 'required|string|confirmed',
            // 'password_confirmation' => 'required_with:password|same:password',
            'token'                 => 'required',
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
            'account.exists'    => '帳號不存在，請重新輸入。',

            'old_password.required' => '請輸入舊密碼。',
            'old_password.string'   => '舊密碼請輸入文字。',

            'password.required' => '請輸入密碼。',
            'password.string'   => '密碼請輸入文字。',
            'password.confirmed'=> '密碼與再次輸入密碼必須一樣。',

            // 'password_confirmation.required_with' => '請再次輸入密碼。',
            // 'password_confirmation.same'   => '密碼與再次輸入密碼必須一樣。',        

            'token.required'  => '請輸入金鑰。',
        ];
    }
}
