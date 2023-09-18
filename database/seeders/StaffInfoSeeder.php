<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\StaffInfo;
use Carbon\Carbon;
use DB;

class StaffInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 10 筆資料
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        StaffInfo::truncate();
        StaffInfo::unguard();

        $datas = array(
            array(
                'num' => 'S23001',
                'name' => '郭小黑',
                'gender' => '1',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => NULL,
                'resignation_date' => NULL,
                'department' => '管理部',
                'job_title' => '總經理',
                'status' => '1',
                'remark' => '請勿刪除',
            ),
            array(
                'num' => 'S23002',
                'name' => '陳之憾',
                'gender' => '1',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-01-01',
                'resignation_date' => NULL,
                'department' => '工程部',
                'job_title' => 'PHP 資深後端工程師',
                'status' => '1',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23003',
                'name' => '張筱珮',
                'gender' => '2',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-07-15',
                'resignation_date' => NULL,
                'department' => '設計部',
                'job_title' => '平面設計師',
                'status' => '1',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23004',
                'name' => '吳依修',
                'gender' => '1',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-03-01',
                'resignation_date' => '2023/08/31',
                'department' => '工程部',
                'job_title' => 'PHP 後端工程師',
                'status' => '2',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23005',
                'name' => '陳貞左',
                'gender' => '1',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-02-17',
                'resignation_date' => NULL,
                'department' => '工程部',
                'job_title' => 'PHP 後端工程師',
                'status' => '1',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23006',
                'name' => '黃靜瑩',
                'gender' => '2',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => NULL,
                'resignation_date' => NULL,
                'department' => '工程部',
                'job_title' => '數據分析師',
                'status' => '0',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23007',
                'name' => '陳佩芬',
                'gender' => '2',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-01-01',
                'resignation_date' => NULL,
                'department' => '工程部',
                'job_title' => '數據分析師',
                'status' => '3',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23008',
                'name' => '嚴加成',
                'gender' => '1',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-01-01',
                'resignation_date' => NULL,
                'department' => '專案部',
                'job_title' => '專案管理師',
                'status' => '1',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23009',
                'name' => '曾佩宭',
                'gender' => '2',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => '2023-02-01',
                'resignation_date' => NULL,
                'department' => '專案部',
                'job_title' => '專案管理師',
                'status' => '1',
                'remark' => NULL,
            ),
            array(
                'num' => 'S23010',
                'name' => '林鴻妏',
                'gender' => '2',
                'phone' => '09'.$this->Rand_phone(8),
                'email' => Str::random(10).'@example.com',
                'arrival_date' => NULL,
                'resignation_date' => NULL,
                'department' => '專案部',
                'job_title' => '專案管理師',
                'status' => '0',
                'remark' => NULL,
            )
        );

        foreach ($datas as $data) {
            StaffInfo::create($data);
        }
    }

    /***
     * 產生亂數號碼
     * 預設值為8碼
     * 
     * @version 1.0
     * @author Black
     */

    function Rand_phone($length=8) {
        $Phone_number = '';
        for ($i = 1; $i <= $length; $i++) {
            $random_number = rand(0,9);
            $Phone_number .= $random_number;
        }
        return $Phone_number;
    }
}
