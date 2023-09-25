<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique()->comment('帳號');
            $table->string('password')->nullable()->comment('密碼');
            $table->integer('staff_id')->unsigned()->index()->comment('員工ID');
            $table->integer('status')->default(0)->comment('帳戶狀態【0=未啟用、1=啟用、2=停用、3=黑名單、9=刪除】');
            $table->text('remark')->nullable()->comment('備註');
            // $table->rememberToken(); //資料表一定要包含一個 remember_token 欄位，這是用來儲存「記住我」的 token
            $table->string('token', 64)->nullable()->comment('金鑰');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
