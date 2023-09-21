<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class ProjectUpdateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'num'           => 'required|size:8|unique:projects',
            'name'          => 'required|string',
            // 'description'   => 'required',
            'staff_id'      => 'required|integer',
            'sort'          => 'required|integer',
            'start_date'    => [
                'nullable',
                'date_format:"Y-m-d"',              // 判斷日期格式
                'required_with:end_date',   // 當離職欄位有值時，到職欄位不得為空
            ],
            'end_date'      => [
                'nullable',
                'date_format:"Y-m-d"',              // 判斷日期格式
                'after_or_equal:start_date',      // 離職日必須跟到職日同一天或是在到職日之後
                
            ],
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
            // 'num.required'      => '請輸入專案編號。',
            // 'num.size'          => '專案編號需入8個字元',
            // 'num.unique'        => '專案編號已存在，請重新輸入。',

            'name.required'     => '請輸入專案名稱。',
            'name.string'       => '專案名稱請輸入文字。',

            // 'description.required'   => '請輸入專案描述',
            
            'staff_id.required' => '請輸入專案負責人ID。',
            'staff_id.integer'  => '專案負責人ID請輸入數字。',

            'sort.required'     => '請輸入專案優先順序。',
            'sort.integer'      => '專案優先順序請輸入數字。',

            'start_date.date_format'    => '請輸入正確格式的專案開始日。',
            'start_date.required_with'  => '當專案完成日有值時，專案開始日不得為空。',

            'end_date.date_format'      => '請輸入正確格式的專案完成日。',
            'end_date.after_or_equal'   => '專案完成日必須跟專案開始日同一天或是在專案開始日之後。',
            
            'status.required' => '請輸入專案狀態。',
            'status.integer'  => '專案狀態請輸入數字。',

            // 'remark.required'  => '請輸入備註。',
            // 'remark.string'    => '備註請輸入文字。',
        ];
    }
}
