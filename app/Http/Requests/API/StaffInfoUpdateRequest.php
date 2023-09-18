<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class StaffInfoUpdateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'num'           => 'required|size:6|unique:staff_infos',
            'name'          => 'required|string',
            'gender'        => 'required|integer',
            'phone'         => 'required|string|max:12|min:7',
            'email'         => 'required|email',
            'arrival_date'  => [
                'nullable',
                'date_format:"Y-m-d"',              // 判斷日期格式
                'required_with:resignation_date',   // 當離職欄位有值時，到職欄位不得為空
            ],
            'resignation_date'  => [
                'nullable',
                'date_format:"Y-m-d"',              // 判斷日期格式
                'after_or_equal:arrival_date',      // 離職日必須跟到職日同一天或是在到職日之後
                
            ],
            'department'    => 'required|string',
            'job_title'     => 'required|string',
            'status'        => 'required|integer',
            // 'remark'        => 'nullable|string',
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
            // 'num.required'      => '請輸入員工編號。',
            // 'num.size'          => '員工編號需入6個字元',
            // 'num.unique'        => '員工編號已存在，請重新輸入。',

            'name.required'     => '請輸入員工姓名。',
            'name.string'       => '員工姓名請輸入文字。',

            'gender.required'   => '請輸入性別。',
            'gender.integer'    => '性別請輸入數字。',
            
            'phone.required'    => '請輸入電話號碼。',
            'phone.string'      => '電話號碼請輸入數字及符號。',
            'phone.max'         => '字數請勿超過12個字。',
            'phone.min'         => '字數請勿小於7個字。',

            'email.required'    => '請輸入電子郵件。',
            'email.email'       => '請輸入正確的電子郵件。',

            'arrival_date.date_format' => '請輸入正確格式的到職日。',
            'arrival_date.required_with' => '當離職日有值時，到職日不得為空。',

            'resignation_date.date_format' => '請輸入正確格式的離職日。',
            'resignation_date.after_or_equal' => '離職日必須跟到職日同一天或是在到職日之後。',
            
            
            'department.required' => '請輸入員工部門。',
            'department.string'  => '員工部門請輸入文字',

            'job_title.required' => '請輸入工作職稱。',
            'job_title.string'  => '工作職稱請輸入文字。',

            'status.required' => '請輸入員工狀態。',
            'status.integer'  => '員工狀態請輸入數字。',

            // 'remark.required'  => '請輸入備註。',
            // 'remark.string'    => '備註請輸入文字。',
        ];
    }
}
