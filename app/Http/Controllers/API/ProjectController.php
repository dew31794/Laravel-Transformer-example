<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Transformers\ProjectList\ProjectTransformer as ProjectListTransformer;
use App\Transformers\ProjectCreate\ProjectTransformer as ProjectCreateTransformer;
use App\Transformers\ProjectSingle\ProjectTransformer as ProjectSingleTransformer;
use App\Transformers\ProjectUpdate\ProjectTransformer as ProjectUpdateTransformer;
use App\Http\Requests\API\ProjectCreateRequest;
use App\Http\Requests\API\ProjectUpdateRequest;
use Carbon\Carbon;

class ProjectController extends ApiController
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
            $project = Project::query();

            $project_list = fractal($project->get(), new ProjectListTransformer)->toArray();

            return response()->json([
                'Status' => 'Success',
                'Data' => $project_list,
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
    public function store(ProjectCreateRequest $request)
    {
        $data = Project::where('num', $request->num)->get();

        if(!count($data)){
            $project = Project::create($request->except(['_token']));
            
            $createProject = fractal(Project::where('id', $project->id)->firstOrFail(), new ProjectCreateTransformer);

            return $this->respondSuccess($createProject);
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
        $project = Project::find($id);

        if(!empty($project)){
            $showProject = fractal($project, new ProjectSingleTransformer);

            return $this->respondSuccess($showProject);
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
    public function update(ProjectUpdateRequest $request, $id)
    {
        $project = Project::find($id);

        if(!empty($project)){
            $data = array(
                'name'          => $request->name,
                'description'   => $request->description,
                'staff_id'      => $request->staff_id,
                'sort'          => $request->sort,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'status'        => $request->status,
                'remark'        => $request->remark,
            );

            if($project->update($data)){
                $updateProject = fractal(Project::find($id), new ProjectUpdateTransformer);

                return $this->respondSuccess($updateProject);
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
        $project = Project::find($id);

        if(!empty($project)){
            if($project->delete()){
                $message = $project->name.' 專案已刪除。';
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
