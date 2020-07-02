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

Route::get('/', function () {
    if (session()->get('admin_id')) {
        return redirect('/dashboard');
    }else{
        return view('auth.login');
    }
});
Route::get('/login', function () {
    if (session()->get('admin_id')) {
        return redirect('/dashboard');
    }else{
        return view('auth.login');
    }
});
Route::post('/login', 'MainController@login');

Route::group(['middleware' => 'authenticated'], function () {

    Route::get('/dashboard', 'MainController@dashboard');
    //all_users
    Route::get('admin/users', 'MainController@all_users');
    Route::post('admin/users/setlevel', 'MainController@set_level');
    Route::post('admin/users/unsetlevel', 'MainController@unset_level');
    Route::post('admin/users/setlevel2', 'MainController@set_level2');
    Route::post('admin/users/unsetlevel2', 'MainController@unset_level2');
    Route::post('admin/users/setlevel3', 'MainController@set_level3');


    Route::post('admin/users/collection', 'MainController@collection');


    Route::post('admin/users/unsetlevel3', 'MainController@unset_level3');
    Route::post('admin/users/setlevel4', 'MainController@set_level4');
    Route::post('admin/users/unsetlevel4', 'MainController@unset_level4');
    Route::post('admin/users/setlevel5', 'MainController@set_level5');
    Route::post('admin/users/unsetlevel5', 'MainController@unset_level5');


    Route::get('admin/collect', 'MainController@collect');
    Route::post('resetpwd', 'MainController@resetpwd');
    Route::post('createcollection', 'MainController@createcollection');
    Route::post('editcollection', 'MainController@editcollection');
    Route::post('delcollection', 'MainController@delcollection');




    //all_report_logs
    Route::get('admin/all_report_logs', 'MainController@all_report_logs');
    //symptom_related_report_logs
    Route::get('admin/symptom_related_report_logs/{symptom}', 'MainController@symptom_related_report_logs');
    //self_report_logs
    Route::get('admin/self_report_logs', 'MainController@self_report_logs');
    //third_party_report_logs
    Route::get('admin/third_party_report_logs', 'MainController@third_party_report_logs');
    //check_in_logs
    Route::get('admin/check_in_logs', 'MainController@check_in_logs');
    //check_ins_on_map
    Route::get('admin/check_ins_on_map', 'MainController@check_ins_on_map');
    
    Route::get('admin/check_in_details/{check_in_id}', 'MainController@check_in_details');
    Route::get('admin/report_details/{report_id}', 'MainController@report_details'); 
    
    Route::get('admin/settings', 'MainController@admin_settings_view'); 
    Route::post('admin/update_settings', 'MainController@update_settings'); 
    Route::post('admin/update_password', 'MainController@update_password');

//    Route::get('admin/reports', 'ReportCenterController@index');
    Route::get('admin/enforcement', 'EnforceCenterController@index');
    Route::get('enforce/delete/{id}', 'EnforceCenterController@delete');

    //tracing

    Route::get('admin/tracing', 'MainController@get_tracing');
    Route::get('admin/tracing_passenger', 'MainController@get_tracing_passenger');
    Route::get('admin/ajax_tracing_passenger', 'MainController@ajax_tracing_passenger');


    Route::get('admin/gbv', 'MainController@get_gbv');
    Route::get('admin/chv', 'MainController@get_chv');
    Route::get('admin/chv_mother', 'MainController@get_chv_mother');


    Route::get('admin/news/{id}', 'NewsController@index'); 
    Route::get('add/news/{id}', 'NewsController@add_news'); 
    Route::post('store/news', 'NewsController@store_news'); 
    Route::get('news/edit/{id}/{info_id}', 'NewsController@edit_news'); 
    Route::post('update/news', 'NewsController@update_news'); 
    Route::get('admin/information', 'InformationController@index');   
    Route::get('add/info', 'InformationController@add_info');  
    Route::post('store/info', 'InformationController@store_info');
    Route::get('info/edit/{id}', 'InformationController@edit_info'); 
    Route::post('update/info', 'InformationController@update_info');  
    Route::post('update_risk/info', 'InformationController@update_risk'); 
    Route::post('/send_msg', 'MessageController@send_msg'); 
     Route::post('/sending_msg', 'MessageController@sending_msg'); 
     Route::get('admin/all_msg', 'MessageController@all_msg');
     Route::get('admin/user_msg/{id}', 'MessageController@user_msg'); 
     Route::post('/total_msg_count', 'MessageController@total_msg_count'); 
     Route::post('/send_all_msg', 'MessageController@send_all_msg'); 
     Route::get('add_user_msg', 'MessageController@add_user_msg'); 
     Route::post('/sending_user_msg', 'MessageController@sending_user_msg');  
     Route::get('admin/trend/{id}', 'InformationController@trend');   
     Route::get('add/trend/{id}', 'InformationController@add_trend');  
      Route::post('store/trend', 'InformationController@store_trend');  
      Route::get('/trend/edit/{id}/{info_id}', 'InformationController@edit_trend');  
       Route::post('update/trend', 'InformationController@update_trend');
    Route::get('/logout', 'MainController@logout');
    
});

