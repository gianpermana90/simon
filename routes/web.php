<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Providers\UrlManagement;

Route::get(UrlManagement::index, [
    'uses'=>'LoginController@index',
]);

Route::post(UrlManagement::login_process, [
    'uses'=>'LoginController@process',
]);

Route::get(UrlManagement::logout, [
    'uses'=>'LoginController@logout',
]);

Route::get(UrlManagement::register_user, [
    'uses'=>'RegisterController@index',
]);

Route::post(UrlManagement::register_process, [
    'uses'=>'RegisterController@addUser',
]);

Route::post(UrlManagement::delete_user, [
    'uses'=>'RegisterController@deleteUser',
]);

Route::get(UrlManagement::admin_dashboard, [
    'uses'=>'AdminController@index',
]);

Route::get(UrlManagement::user_list, [
    'uses'=>'UserController@listUsers',
]);

Route::get(UrlManagement::user_profile, [
    'uses'=>'UserController@index',
]);

Route::get(UrlManagement::analytic_canvaser, [
    'uses'=>'AnalyticsController@canvaserAnalytic',
]);

Route::post(UrlManagement::insert_extracted_data, [
    'uses'=>'DataController@insertData',
]);

Route::post(UrlManagement::set_target_canvaser, [
    'uses'=>'DataController@setTargetCanvaser',
]);

Route::post(UrlManagement::set_target_current_month, [
    'uses'=>'DataController@setTargetCurrentMonth',
]);