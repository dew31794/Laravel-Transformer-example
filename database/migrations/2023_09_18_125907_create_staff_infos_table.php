<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique()->comment('員工編號');
            $table->string('name')->comment('員工姓名');
            $table->integer('gender')->default(0)->comment('員工性別【0=未選擇、1=男生、2=女生');
            $table->string('phone')->nullable()->comment('員工電話');
            $table->string('email')->nullable()->comment('員工郵件');
            $table->date('arrival_date')->nullable()->comment('到職日期');
            $table->date('resignation_date')->nullable()->comment('離職日期');
            $table->string('department')->nullable()->comment('員工部門');
            $table->string('job_title')->nullable()->comment('員工職稱');
            $table->integer('status')->default(0)->comment('員工狀態【0=未到職、1=在職、2=辭職、3=留職停薪、4=取消到職】');
            $table->text('remark')->nullable()->comment('備註');
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
        Schema::dropIfExists('staff_infos');
    }
}
