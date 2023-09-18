<?php

namespace App\Transformers\StaffInfoList;

use League\Fractal\TransformerAbstract;
use App\Models\StaffInfo;
use Carbon\Carbon;

class StaffInfoTransformer extends TransformerAbstract
{
    /**
     * 自動包含的資源列表
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'children_project'
    ];
    
    /**
     * 可能包含的資源列表
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * 轉化器 - 回傳欄位轉化結果
     *
     * @return array
     */
    public function transform(StaffInfo $staff_info)
    {
        $params = [
            // 'id'           => $staff_info->id,
            'num'          => $staff_info->num,
            'name'         => $staff_info->name,
            'gender'       => $this->transGender($staff_info->gender),
            'phone'        => $staff_info->phone,
            'email'        => $staff_info->email,
            'arrival_date' => $this->transDateformat($staff_info->arrival_date,2),
            'resignation_date' => $this->transDateformat($staff_info->resignation_date,2),
            'department'   => $staff_info->department,
            'job_title'    => $staff_info->job_title,
            'status'       => $staff_info->status,
            'remark'       => $staff_info->remark,
            // 'created_at' => $staff_info->created_at,
            // 'updated_at' => $staff_info->updated_at,
        ];
        
        return $params;
    }

    /**
     * 關聯的資源列表
     *
     * @return array
     */
    public function includeChildrenProject(StaffInfo $staff_info)
    {
        $childrenProject = $staff_info->childrenProject()->orderBy('created_at', 'desc')->get();

        return $childrenProject ? $this->collection($childrenProject, new ProjectTransformer, FALSE)
                                : $this->null();
    }
    
    /**
     * gender = 帶入「性別」參數 
     * 
     * @return string
     */
    protected function transGender($gender){
        switch($gender){
            case 0:
                return NULL;
            case 1:
                return '男';
            case 2:
                return '女';
        }
    }

    /**
     * date = 日期
     * formatCase = 選擇格式
     * 
     * @return string
     */
    protected function transDateformat($date,$formatCase){
        if($date){
            switch($formatCase){
                case 1:
                    return Carbon::parse($date)->format('Y-m-d');
                case 2:
                    return Carbon::parse($date)->format('Y/m/d');
                default:
                    return $date;
            }
        }else{
            return NULL;
        }
    }
}
