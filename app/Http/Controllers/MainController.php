<?php

namespace App\Http\Controllers;
use App\Admins;
use App\Passenger;
use App\Tracing;
use App\User;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Session;
use Mapper;
use App\Check_Ins;
use App\Reports;
use App\Symptoms;
use App\Colors_Against_Symptoms;

class MainController extends Controller
{
    public function login(Request $request){
        $user = Admins::where('email', $request->email)->where('password', md5($request->password))->first();
        if ($user) {
            $request->session()->put('admin_id', $user->id);
            $request->session()->put('admin_email', $user->email);
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password.');
        }
    }

    public function logout(){
        session::flush();
        return redirect('/');
    }
    
    public function dashboard(){
        setcookie('value', 1, time() + (86400 * 30), "/");
        $all_reports = Reports::get();
        $symptoms = Symptoms::get();
        $count_array = array();
        foreach($symptoms as $symptom){
            if(!isset($count_array[$symptom->symptom]['count'])){
                $count_array[$symptom->symptom]['count'] = 0;
                $count_array[$symptom->symptom]['color'] = $symptom->color_code;
            }
            foreach($all_reports as $report){
                $array = explode(',', $report->symptom);
                $res = in_array($symptom->id, $array);
                if($res){
                    if(isset($count_array[$symptom->symptom]['count'])){
                        $count_array[$symptom->symptom]['count']++;
                        $count_array[$symptom->symptom]['color'] = $symptom->color_code;
                    }else{
                        $count_array[$symptom->symptom]['count'] = 1;
                        $count_array[$symptom->symptom]['color'] = $symptom->color_code;
                    }
                }
            }
        }
        Mapper::map('0.462685', '37.792653', ['zoom' => 7]);
	    foreach($all_reports as $key =>  $report){
	        $user = User::where('id', $report->user_id)->first();
	        if(!isset($user->profile_image)){
	            $image = url('/profile_image/not_found.jpg');
	        }else{
	            $image = url('/profile_image/')."/".$user->profile_image;
	        }
            if(isset($user->first_name) && isset($user->last_name)){
                $user_name = strtoupper($user->first_name." ".$user->last_name);
            }else $user_name = "";

            $temp_array = explode(',', $report->symptom);
	        $size = 0;
	        if(in_array("8" , $temp_array)){
	            $size = sizeof($temp_array) - 1;
	            if($size == 0){
    	            $color = 'green';
    	        }else{
    	            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
    	        }
	        }else{
	            $size = sizeof($temp_array);
	            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
	        }
	        
	        $url = url('/admin/report_details/'. $report->id);
	        Mapper::marker($report->lat, $report->lng, ['animation' => 'DROP', 'title' => $report->report_type,
	        'eventClick' => 
    	        "var infowindow = new google.maps.InfoWindow(); var iwContent = `<div id='iw_container'><div><img src='$image' height='42' width='42'></div><a href='$url'><div class='iw_title'>$user_name</div></a><div class='iw_title'>$report->report_type</div><div class='iw_title'>$report->city , $report->state</div><div class='iw_title'>$report->created_at</div></div>`;
                infowindow.setContent(iwContent);
                infowindow.open(map, marker_$key);",
	        'eventDblClick' => 'window.location.replace("'.$url.'");',
	        'icon' => ['url' => 'http://maps.google.com/mapfiles/ms/icons/'.$color.'-dot.png']
	        ]);
    	}
    	return view('admin.dashboard', compact('count_array'));
    }
    
    public function all_users(){
        $users = User::get()->all();
        return view('admin.users.home', compact('users'));
    }
    
    public function all_report_logs(){
        $all_report_logs = Reports::orderBy('id', 'DESC')->get();
        return view('admin.logs.all_report_logs', compact('all_report_logs'));
    }
    
    public function self_report_logs(){
        $self_report_logs = Reports::where('first_name', null)->orderBy('id', 'DESC')->get();
        return view('admin.logs.self_report_logs', compact('self_report_logs'));
    }
    
    public function third_party_report_logs(){
        $third_party_report_logs = Reports::where('first_name', '!=', null )->orderBy('id', 'DESC')->get();
        return view('admin.logs.third_party_report_logs', compact('third_party_report_logs'));
    }
    
    public function check_in_logs(){
        $all_check_ins = Check_Ins::orderBy('id', 'DESC')->get();
        return view('admin.logs.check_in_logs', compact('all_check_ins'));
    }

    public function get_tracing(){
        $all_check_ins = Tracing::orderBy('id', 'DESC')->get();
        return view('admin.tracing.check_in_logs', compact('all_check_ins'));
    }
    public function get_tracing_passenger(){
        $all_check_ins = Passenger::orderBy('id', 'DESC')->get();
        return view('admin.passenger.check_in_logs', compact('all_check_ins'));
    }
    public function get_gbv(){
        $all_check_ins = \App\GbvList::orderBy('id', 'DESC')->get();
        return view('admin.gbv.check_in_logs', compact('all_check_ins'));
    }
    public function get_chv(){
        $all_check_ins = \App\ChvList::orderBy('id', 'DESC')->get();
        return view('admin.chv.check_in_logs', compact('all_check_ins'));
    }
    public function get_chv_mother(){
        $all_check_ins = \App\ChvMotherList::orderBy('id', 'DESC')->get();
        return view('admin.chv_mother.check_in_logs', compact('all_check_ins'));
    }
    public function check_ins_on_map(){
        // $new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        // Mapper::map($new_arr[0]['geoplugin_latitude'], $new_arr[0]['geoplugin_longitude']);
	    $all_check_ins = Check_Ins::get();
        Mapper::map('0.462685', '37.792653', ['zoom' => 7]);
	    foreach($all_check_ins as $key => $check_in){
	        $user = User::where('id', $check_in->user_id)->first();
	        if(!isset($user->profile_image)){
	            $image = url('/profile_image/not_found.jpg');
	        }else{
	            $image = url('/profile_image/')."/".$user->profile_image;
	        }
	        $url = url('/admin/check_in_details/'. $check_in->id);
	        Mapper::marker($check_in->lat, $check_in->lng, ['animation' => 'DROP', 'title' => $check_in->people, 
	        'eventClick' => 
    	        "var infowindow = new google.maps.InfoWindow(); var iwContent = `<div id='iw_container'><div><img src='$image' height='42' width='42'></div><a href='$url'><div class='iw_title'>$check_in->people</div></a><div class='iw_title'>$check_in->time</div><div class='iw_title'>$check_in->utilities</div></div>`;
                infowindow.setContent(iwContent);
                infowindow.open(map, marker_$key);",
            'eventDblClick' => 'window.location.replace("'.$url.'");'
            ]);
	    }
	    return view('admin.check_ins.home');
    }
    
    public function check_in_details($check_in_id){
        $details = array();
	    $check_in_detail = Check_Ins::where('id', $check_in_id)->first();
	    $user_detail = User::where('id', $check_in_detail->user_id)->first();
	    
	    Mapper::map($check_in_detail->lat, $check_in_detail->lng, ['zoom' => 15]);
	    Mapper::marker($check_in_detail->lat, $check_in_detail->lng, ['animation' => 'DROP', 'title' => $check_in_detail->people, 'icon' => ['url' => 'http://maps.google.com/mapfiles/ms/icons/red-dot.png']]);
	    if(!isset($check_in_detail) || !isset($user_detail)){
            $details = array();
        }else{
            $details = array_merge($check_in_detail->toArray(), $user_detail->toArray());
            $details['location'] = $check_in_detail->city.",".$check_in_detail->state.",".$check_in_detail->country;
            $details['check_in_time'] = $check_in_detail->created_at;
        }



	    return view('admin.check_ins.details', compact('details'));
    }
    
    public function report_details($report_id){
        $details = array();
	    $report_detail = Reports::where('id', $report_id)->first();
	    $user_detail = User::where('id', $report_detail->user_id)->first();
	    $temp_array = explode(',', $report_detail->symptom);
        $size = 0;
        if(in_array("8" , $temp_array)){
            $size = sizeof($temp_array) - 1;
            if($size == 0){
	            $color = 'green';
	        }else{
	            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
	        }
        }else{
            $size = sizeof($temp_array);
            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
        }
	    Mapper::map($report_detail->lat, $report_detail->lng, ['zoom' => 15]);
	    Mapper::marker($report_detail->lat, $report_detail->lng, ['animation' => 'DROP', 'title' => $report_detail->report_type, 'icon' => ['url' => 'http://maps.google.com/mapfiles/ms/icons/'.$color.'-dot.png']]);
	    $details = array_merge($report_detail->toArray(), $user_detail->toArray());
	    
	    $situation = "";
        if($size == 1 || $size == 2){
            $situation = "Level 1 (Low Risk)";
        }
        if($size == 3 || $size == 4){
            $situation = "Level 2 (High Risk)";
        }
        if($size >= 5){
            $situation = "(Level 3) Severe Risk";
        }
	    $details['location'] = $report_detail->city.",".$report_detail->state.",".$report_detail->country;
	    $details['report_time'] = $report_detail->created_at;
	    $details['user_condition'] = $situation;
	    return view('admin.reports.details', compact('details'));
    }
    
    public function admin_settings_view(){
        $details = Admins::first();
        return view('admin.settings', compact('details'));
    }
    public function update_settings(Request $request){

        $admin = Admins::first();
        $admin->alert_emails = $request->alert_emails;
        $admin->alert_phone_numbers = $request->alert_phone_numbers;
        $admin->save();
        return redirect()->back()->with('success', 'Update Successfull.');
    }
    public function update_password(Request $request){
        $admin = Admins::first();
        if($admin->password == md5($request->old_password)){
            if($request->confirm_password == $request->new_password){
                $admin->password = md5($request->new_password);
                $admin->save();
                return redirect()->back()->with('success', 'Update Successfull.');
            }else{
                return redirect()->back()->with('error', 'New Password and Confirm Password does not match.');
            }
        }else{
            return redirect()->back()->with('error', 'Wrong Old Password.');
        }
    }
    public function set_level(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->enforce_level=1;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is setted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }

    }
    public function unset_level(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->enforce_level=0;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is unsetted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }
    }

    public function set_level2(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->gover_level=1;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is setted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }

    }
    public function unset_level2(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->gover_level=0;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is unsetted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }
    }

    public function set_level3(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->border_level=1;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is setted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }

    }
    public function unset_level3(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->border_level=0;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is unsetted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }
    }

    public function set_level4(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->gbv_level=1;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is setted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }

    }
    public function unset_level4(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->gbv_level=0;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is unsetted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }
    }

    public function set_level5(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->chv_level=1;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is setted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }

    }
    public function unset_level5(Request $request){
        $userdetail = User::where('id', '=', $request->user_id)->first();
        $userdetail->chv_level=0;
        if($userdetail->save()){
            return response()->json(['success'=>'User editer level is unsetted.']);
        }else{
            return response()->json(['fail'=>'sql error']);
        }
    }

    
    public function symptom_related_report_logs($symptom){
        $symptom_id = Symptoms::where('symptom', $symptom)->first()->id;
        $all_report_logs = Reports::where('symptom', 'like', '%' . $symptom_id . '%')->get();
        Mapper::map('0.493828', '37.829827', ['zoom' => 7]);
	    foreach($all_report_logs as $key =>  $report){
	        $user = User::where('id', $report->user_id)->first();
	        if(!isset($user->profile_image)){
	            $image = url('/profile_image/not_found.jpg');
	        }else{
	            $image = url('/profile_image/')."/".$user->profile_image;
	        }
	        if(isset($user->first_name) && isset($user->last_name)){
                $user_name = strtoupper($user->first_name." ".$user->last_name);
	        }else $user_name = "";


	        $temp_array = explode(',', $report->symptom);
	        $size = 0;
	        if(in_array("8" , $temp_array)){
	            $size = sizeof($temp_array) - 1;
	            if($size == 0){
    	            $color = 'green';
    	        }else{
    	            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
    	        }
	        }else{
	            $size = sizeof($temp_array);
	            $color = Colors_Against_Symptoms::where('number_of_symptoms', $size)->first()->color_code;
	        }
	        $url = url('/admin/report_details/'. $report->id);
	        Mapper::marker($report->lat, $report->lng, ['animation' => 'DROP', 'title' => $report->report_type,
	        'eventClick' => 
    	        "var infowindow = new google.maps.InfoWindow(); var iwContent = `<div id='iw_container'><div><img src='$image' height='42' width='42'></div><a href='$url'><div class='iw_title'>$user_name</div></a><div class='iw_title'>$report->report_type</div><div class='iw_title'>$report->city , $report->state</div><div class='iw_title'>$report->created_at</div></div>`;
                infowindow.setContent(iwContent);
                infowindow.open(map, marker_$key);",
	        'eventDblClick' => 'window.location.replace("'.$url.'");',
	        'icon' => ['url' => 'http://maps.google.com/mapfiles/ms/icons/'.$color.'-dot.png']
	        ]);
    	}
    	return view('admin.logs.symptom_related_logs', compact('all_report_logs'));
    }
}
