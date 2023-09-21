<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique()->comment('專案編號');
            $table->string('name')->comment('專案名稱');
            $table->longText('description')->nullable()->comment('專案描述');
            $table->integer('staff_id')->unsigned()->index()->comment('專案負責人ID');
            $table->integer('sort')->default(0)->comment('專案優先順序');
            $table->date('start_date')->nullable()->comment('專案開始日');
            $table->date('end_date')->nullable()->comment('專案完成日');
            $table->integer('status')->default(0)->comment('專案狀態【0=尚未進行、1=進行中、2=驗收中、3=收款中、4=結案】');
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
        Schema::dropIfExists('projects');
    }
}
