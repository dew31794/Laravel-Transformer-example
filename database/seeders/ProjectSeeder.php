<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Carbon\Carbon;
use DB;
use Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 6 筆資料
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Project::truncate();
        Project::unguard();

        $datas = array(
            array(
                'num' => 'P2300001',
                'name' => '成品書店官方網站',
                'description' => '單純內容網站，無其他功能',
                'staff_id' => '9',
                'sort' => '1',
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 0,
                'remark' => NULL
            ),
            array(
                'num' => 'P2300002',
                'name' => '國太產業保險系統',
                'description' => NULL,
                'staff_id' => '9',
                'sort' => '2',
                'start_date' => '2023-01-01',
                'end_date' => NULL,
                'status' => 1,
                'remark' => NULL
            ),
            array(
                'num' => 'P2300003',
                'name' => '方克診所視訊問診系統',
                'description' => NULL,
                'staff_id' => '8',
                'sort' => '1',
                'start_date' => '2023-06-01',
                'end_date' => NULL,
                'status' => 1,
                'remark' => NULL
            ),
            array(
                'num' => 'P2300004',
                'name' => '博克書店電子商務系統',
                'description' => NULL,
                'staff_id' => '9',
                'sort' => '3',
                'start_date' => '2023-01-09',
                'end_date' => '2023-08-31',
                'status' => '3',
                'remark' => NULL
            ),
            array(
                'num' => 'P2300005',
                'name' => '專案系統改進(內)',
                'description' => NULL,
                'staff_id' => '2',
                'sort' => '1',
                'start_date' => '2022-01-01',
                'end_date' => NULL,
                'status' => 1,
                'remark' => NULL
            ),
            array(
                'num' => 'P2300006',
                'name' => '出缺勤系統(內)',
                'description' => NULL,
                'staff_id' => '1',
                'sort' => '1',
                'start_date' => '2020-01-01',
                'end_date' => NULL,
                'status' => 1,
                'remark' => NULL
            ),
        );

        foreach ($datas as $data) {
            Project::create($data);
        }
    }
}
