<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//////////signup route //////////////////

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register'); 
Route::post('update_profile', 'API\UserController@update_profile');
Route::get('getnews', 'API\UserController@getnews');
Route::post('addnews', 'API\UserController@addnews');
Route::post('forgot_password', 'API\UserController@forgot_password');
Route::get('information_center', 'API\UserController@information_center');
Route::get('information_center_detail', 'API\UserController@information_center_detail');
Route::get('enforce_list', 'API\UserController@enforce_list');
Route::post('report', 'API\ReportController@report');



Route::post('collection', 'API\ReportController@collection');




Route::post('enforce', 'API\ReportController@enforce_report');
Route::post('check_in', 'API\ReportController@check_in');
Route::post('tracing_submit', 'API\ReportController@tracing_add');
Route::post('tracing_passenger_submit', 'API\ReportController@tracing_passenger_add');
Route::get('tracing_list', 'API\UserController@tracing_list');
Route::get('passenger_list', 'API\UserController@tracing_passenger_list');
Route::get('gbv_list', 'API\UserController@gbv_list');
Route::get('chv_list', 'API\UserController@chv_list');
Route::get('chv_mother_list', 'API\UserController@chv_mother_list');
Route::post('gbv_submit', 'API\ReportController@gbv_add');
Route::post('chv_submit', 'API\ReportController@chv_add');
Route::post('chv_mother_submit', 'API\ReportController@chv_mother_add');
Route::post('message', 'API\MessageController@message');
Route::post('all_msg', 'API\MessageController@all_msg');
Route::get('all_symptoms', 'API\ReportController@all_symptoms');
Route::post('profile_image', 'API\UserController@profile_image');
Route::get('getTrend', 'API\UserController@getTrend');
Route::post('update_token', 'API\UserController@update_token');






