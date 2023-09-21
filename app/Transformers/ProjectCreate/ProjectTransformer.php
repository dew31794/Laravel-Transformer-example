<?php

namespace App\Transformers\ProjectCreate;

use League\Fractal\TransformerAbstract;
use App\Models\Project;
use Carbon\Carbon;

class ProjectTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Project $project)
    {
        $params = [
            // 'id'           => $project->id,
            'num'          => $project->num,
            'name'         => $project->name,
            'description'  => $project->description,
            'staff_id'     => $project->staff->name,
            'sort'         => $project->sort,
            'start_date'   => $project->start_date,
            'end_date'     => $project->end_date,
            'status'       => $project->status,
            'remark'       => $project->remark,
            // 'created_at'   => $project->created_at,
            // 'updated_at'   => $project->updated_at,
        ];
        
        return $params;
    }
}
