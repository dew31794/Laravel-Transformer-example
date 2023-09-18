<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    // 員工
    Route::group(['namespace' => 'API', 'prefix' => 'staff'], function () {
        // 取的員工列表
        Route::get('list', 'StaffInfoController@index')->name('api.staff.list');
        // 新增員工
        Route::post('create', 'StaffInfoController@store')->name('api.staff.create');
        // 取得員工內容
        Route::get('show/{id}', 'StaffInfoController@show')->name('api.staff.show');
        // 更新員工內容
        Route::put('update/{id}', 'StaffInfoController@update')->name('api.staff.update');
        // 刪除員工
        Route::delete('delete/{id}', 'StaffInfoController@destroy')->name('api.staff.delete');
    });
});