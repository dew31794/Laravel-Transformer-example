<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use Carbon\Carbon;
use DB;
use Str;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Account::truncate();
        Account::unguard();
        
        $datas = array(
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '1',
                'status' => '1',
                'remark' => NULL,
                'token' => Str::random(64)
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '2',
                'status' => '1',
                'remark' => NULL
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '3',
                'status' => '1',
                'remark' => NULL
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '4',
                'status' => '1',
                'remark' => NULL
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '5',
                'status' => '1',
                'remark' => NULL
            ),
            // array(
            //     'account' => Str::random(6),
            ////     'password' => md5($this->Rand_Password(10)),
            //     'password' => Hash::make('Ab123456'),
            //     'staff_id' => '6',
            //     'status' => '1',
            //     'remark' => NULL
            // ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '7',
                'status' => '0',
                'remark' => NULL
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '8',
                'status' => '1',
                'remark' => NULL
            ),
            array(
                'account' => Str::random(6),
                // 'password' => md5($this->Rand_Password(10)),
                'password' => Hash::make('Ab123456'),
                'staff_id' => '9',
                'status' => '1',
                'remark' => NULL,
                'token' => Str::random(64)
            ),
            // array(
            //     'account' => Str::random(6),
            ////     'password' => md5($this->Rand_Password(10)),
            //     'password' => Hash::make('Ab123456'),
            //     'staff_id' => '10',
            //     'status' => '1',
            //     'remark' => NULL
            // )
        );

        foreach ($datas as $data) {
            Account::create($data);
        }
    }
    /***
     * 產生亂數密碼
     * 預設值為8碼
     * 
     * @version 1.0
     * @author Black
     * 
     * strlen = 取得字串長度
     * substr = 取得部分值
     * rand(min,max) = 亂數產生一個值
     * 
     */
    function Rand_Password($length=8){
        $passwordChars = '123456789'.'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 1; $i <= $length; $i++) {
            $RandomNumber = rand(0,strlen($passwordChars));
            $password .= substr($passwordChars,$RandomNumber-1,1);
        }
        return $password;
    }
}
