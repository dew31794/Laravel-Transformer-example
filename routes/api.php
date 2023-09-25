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
        // 員工列表
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

    // 專案
    Route::group(['namespace' => 'API', 'prefix' => 'project'], function () {
        // 專案列表
        Route::get('list', 'ProjectController@index')->name('api.project.list');
        // 新增專案
        Route::post('create', 'ProjectController@store')->name('api.project.create');
        // 取得專案內容
        Route::get('show/{id}', 'ProjectController@show')->name('api.project.show');
        // 更新專案內容
        Route::put('update/{id}', 'ProjectController@update')->name('api.project.update');
        // 刪除專案
        Route::delete('delete/{id}', 'ProjectController@destroy')->name('api.project.delete');
    });

    // 帳戶
    Route::group(['namespace' => 'API', 'prefix' => 'account'], function () {
        // 帳戶列表
        Route::get('list', 'AccountController@index')->name('api.account.list');
        // 新增帳戶
        Route::post('create', 'AccountController@store')->name('api.account.create');
        // 取得帳戶內容
        Route::get('show/{id}', 'AccountController@show')->name('api.account.show');
        // 更新帳戶
        Route::put('update/{id}', 'AccountController@update')->name('api.account.update');
        // 刪除帳戶
        Route::delete('delete/{id}', 'AccountController@destroy')->name('api.account.delete');
        // 修改密碼
        Route::post('reset-password', 'AccountController@resetPassword')->name('api.account.reset.password');
    });
});