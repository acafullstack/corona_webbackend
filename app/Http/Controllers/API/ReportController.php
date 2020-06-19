<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use App\Collect; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Mail;
use Illuminate\Support\Str;
use DB;
use App\Admins; 
use App\Report_Notifications; 
use App\Reports; 

class ReportController extends Controller 
{
    public function random(){
        return (float)rand() / (float)getrandmax();
    }
    public function check_lat_lng($lat, $lng, $size){
        // $lat = $lat + ($this->random() - 0.8) / 5000;
        // $lng = $lng + ($this->random() - 0.8) / 5000;
        $res = Reports::where('lat', $lat)->where('lng', $lng)->first();
        if($res){
            $res_size = sizeof(explode(',', $res->symptom));
            if($res_size == $size){
                return array($res->lat, $res->lng);
            }
            if($size == 1 || $size == 2){
                // $situation = "Level 1 (Low Risk)";
                if($res_size > $size){
                    $lat = $lat - 0.00002000;
        	        $lng = $lng - 0.00002000;
        	        return $this->check_lat_lng($lat, $lng, $size);
                }else{
                    return array($lat, $lng);
                }
                
            }
            if($size == 3 || $size == 4){
                // $situation = "Level 2 (High Risk)";
                $lat = $lat + 0.00002000;
    	        $lng = $lng + 0.00002000;
    	        return $this->check_lat_lng($lat, $lng, $size);
            }
            if($size >= 5){
                // $situation = "(Level 3) Severe Risk";
                $lat = $lat + 0.00004000;
    	        $lng = $lng + 0.00004000;
    	        return $this->check_lat_lng($lat, $lng, $size);
            }
        }else{
            return array($lat, $lng);
        }
    }
    
    public function report(Request $request)
    {   
        $size = sizeof(explode(',', $request->symptom));
    //     $res = $this->check_lat_lng(number_format($request->latitude, 8), number_format($request->longitude,8), $size);
	   // $request->latitude = $res[0];
	   // $request->longitude = $res[1];

	   $request->latitude = $request->latitude + ($this->random() - 0.8) / 5000;
	   $request->longitude = $request->longitude + ($this->random() - 0.8) / 5000;

          if($request->hasfile('image_video')){
            $postData = $request->only('image_video');

            $file = $postData['image_video'];

            $fileArray = array('image' => $file);

            // Tell the validator that this file should be an image
            $rules = array(
              'image' => 'mimes:jpeg,jpg,png,gif,mp4,flv,m3u8,ts,3gp,mov,wmv|required|max:3000' // max 3000kb
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($fileArray, $rules);


            // Check to see if validation fails or passes
            if ($validator->fails())
            {
                return response()->json(['status'=>'failed', 'msg'=>'Upload only Image or Video.']);
            }
            $file=$request->file('image_video');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('report_image');
            $file->move($destinationpath,$imgname);
        }
                // $symptom = DB::table('symptoms')->where('symptom',$request->symptom)->first();
        if(isset($imgname))
        {

             $data = array(
            'first_name'=>$request->first_name,
            'second_name'=>$request->second_name,
            'user_id'=>$request->user_id,
            'report_type'=>$request->report_type,
             'city'=>$request->city,
             'state'=>$request->state,
            'address'=>$request->address,
            'country'=>$request->country,
            'video_or_image'=>$imgname,
            'symptom'=>$request->symptom,
            'additional_info'=>$request->additional_info,
            'lat'=>$request->latitude,
            'lng'=>$request->longitude,
            'collection_id'=>$request->collection_id,
            );
        }else{
             $data = array(
            'first_name'=>$request->first_name,
            'second_name'=>$request->second_name,
            'user_id'=>$request->user_id,
            'report_type'=>$request->report_type,
             'city'=>$request->city,
             'country'=>$request->country,
             'state'=>$request->state,
            'address'=>$request->address,
            'symptom'=>$request->symptom,
            'additional_info'=>$request->additional_info,
            'lat'=>$request->latitude,
            'lng'=>$request->longitude,
            'collection_id'=>$request->collection_id,
            );
        }

        $success = DB::table('report')->insert($data);
        $report_id = DB::getPdo()->lastInsertId();

        if($success)
        {

//            $situation = "";
//            if($size == 1 || $size == 2){
//                $situation = "Level 1 (Low Risk)";
//            }
//            if($size == 3 || $size == 4){
//                $situation = "Level 2 (High Risk)";
//            }
//            if($size >= 5){
//                $situation = "(Level 3) Severe Risk";
//            }
//
//            $user = User::where('id', $request->user_id)->first();
//            $user_email = $user->email;
//            $email_data = array( 'situation' => $situation,'email' => $user_email );
//
//
//            Mail::send(['html'=>'admin/report_email'], $email_data, function($message) use($user_email) {
//                $message->to($user_email, 'COVID-19 Tracker')->subject('Symptoms Report Status');
//                $message->from('info@sendways.com','COVID-19 Tracker');
//            });
//
//            // Emails to ADMIN
//            $admin_emails = Admins::first()->alert_emails;
//            $admin_emails = explode(',', $admin_emails);
//            foreach($admin_emails as $admin_email){
//                $email_data = array( 'user_name' => $user->first_name . ' ' .$user->last_name, 'email' => $user_email, 'report_type' => $request->report_type, 'situation' => $situation, 'location' => $request->address);
//                Mail::send(['html'=>'admin/report_email_to_admin'], $email_data, function($message) use($admin_email) {
//                    $message->to($admin_email, 'COVID-19 Tracker')->subject('Symptoms Report Received');
//                    $message->from('info@sendways.com','COVID-19 Tracker');
//                });
//            }
            // End

            // SMS to ADMIN
//            $short_url = url("/admin/report_details/$report_id");
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//              CURLOPT_URL => "https://api-ssl.bitly.com/v4/shorten",
//              CURLOPT_RETURNTRANSFER => true,
//              CURLOPT_ENCODING => "",
//              CURLOPT_MAXREDIRS => 10,
//              CURLOPT_TIMEOUT => 0,
//              CURLOPT_FOLLOWLOCATION => true,
//              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//              CURLOPT_CUSTOMREQUEST => "POST",
//              CURLOPT_POSTFIELDS =>"{\n    \"group_guid\": \"BhavdR5cnb4\",\n    \"domain\": \"bit.ly\",\n    \"long_url\": \"$short_url\"\n}",
//              CURLOPT_HTTPHEADER => array(
//                "Authorization: Bearer 660c08da34c0d1863b9db0f6239f966b600015d9",
//                "Content-Type: application/json"
//              ),
//            ));
//
//            $response = curl_exec($curl);
//            file_put_contents("4.txt",print_r("dd",1));
//
//            curl_close($curl);
//            $response = json_decode($response);
//
//            $message ="A " .$situation. " symptoms report has been received from " .strtoupper($user->first_name). " " .strtoupper($user->last_name). " Please click " .$response->link. " for more or call 080097000010 for more. Thank you. The Virus Tracker Team.";
//            $admin_phone_numbers = Admins::first()->alert_phone_numbers;
//            $sms_send_link = "http://www.estoresms.com/smsapi.php?username=DeGrey&password=3805963m9523&sender=VIRUSTRACKA&recipient=$admin_phone_numbers&message=$message";
//
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//              CURLOPT_URL => "http://www.estoresms.com/smsapi.php",
//              CURLOPT_RETURNTRANSFER => true,
//              CURLOPT_ENCODING => "",
//              CURLOPT_MAXREDIRS => 10,
//              CURLOPT_TIMEOUT => 0,
//              CURLOPT_FOLLOWLOCATION => true,
//              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//              CURLOPT_CUSTOMREQUEST => "POST",
//              CURLOPT_POSTFIELDS => array('username' => 'DeGrey','password' => '3805963m9523','sender' => 'VIRUSTRACKA','recipient' => $admin_phone_numbers,'message' => $message),
//            ));
//
//            $result = curl_exec($curl);
//
//            curl_close($curl);
            //dd($result);
            // End

            //entry to notifications
//                $r_n = Report_Notifications::first();
//                $updateds_ids = array_merge(array($report_id), json_decode($r_n->report_ids));
//                $r_n->notification_count ++;
//                $r_n->report_ids = json_encode($updateds_ids);
//                $r_n->save();
            //end

            return response()->json(['status'=>'success', 'msg'=>'Report Added successfully']);
        }else{

            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
    }
    public function collection(Request $request)
    {
        $data = Collect::all();
        return response()->json(['status'=>'success', 'data'=>$data]);
    }
    public function enforce_report(Request $request){

        if($request->hasfile('image_video')){

            $postData = $request->only('image_video');

            $file = $postData['image_video'];

            $fileArray = array('image' => $file);

            // Tell the validator that this file should be an image
            $rules = array(
                'image' => 'mimes:jpeg,jpg,png,gif,mp4,flv,m3u8,ts,3gp,mov,wmv|required|max:3000' // max 3000kb
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($fileArray, $rules);


            // Check to see if validation fails or passes
            if ($validator->fails())
            {
                return response()->json(['status'=>'failed', 'msg'=>'Upload only Image or Video.']);
            }
            $file=$request->file('image_video');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('report_image');
            $file->move($destinationpath,$imgname);
        }
        // $symptom = DB::table('symptoms')->where('symptom',$request->symptom)->first();
        if(isset($imgname))
        {

            $data = array(
                'user_id'=>$request->user_id,
                'enforce_type'=>$request->enforce_type,
                'title'=>$request->title,
                'description'=>$request->description,
                'file_type'=>$request->file_type,
                'image'=>$imgname,
            );
        }else{
            $data = array(
                'user_id'=>$request->user_id,
                'enforce_type'=>$request->enforce_type,
                'title'=>$request->title,
                'description'=>$request->description,
            );
        }

        $success = DB::table('enforce')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'Enforce data Added successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
    }
    public function check_in(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
	            'peaple' => 'required', 
	            'time' => 'required', 
	            'utilities' => 'required', 
	            'user_id' => 'required',
	            'longitude' => 'required',
	            'latitude' => 'required',
	            'city' => 'required',
	            'country' => 'required', 
	            'address' => 'required', 
	            'state' => 'required',
	        ]);
	if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()], 401);            
	        }
	        
	        $data = array(
	            'user_id'=>$request->user_id,
	            'people'=>$request->peaple,
	            'time'=>$request->time,
	            'utilities'=>$request->utilities,
	            'additional_info'=>$request->additional_info, 
	            'lat'=>$request->latitude,
	            'lng'=>$request->longitude,
	            'city'=>$request->city,
	            'country'=>$request->country, 
	            'address'=>$request->address, 
	            'state'=>$request->state,
	            );
	            
	            $success = DB::table('check_in')->insert($data);

            if($success)
            {
                return response()->json(['status'=>'success', 'msg'=>'Report Saved Successfully']);  
            }else{
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
	        
    }
    public function tracing_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'title' => 'required',
            'card_num' => 'required',
            'service_type' => 'required',
            'tel_num' => 'required',
            'home_address' => 'required',
            'reg_num' => 'required',
            'date' => 'required',
            'destination' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = array(
            'user_id'=>$request->user_id,
            'passenger_name'=>$request->name,
            'unique_card_number'=>$request->card_num,
            'service_type'=>$request->service_type,
            'tel_number'=>$request->tel_num,
            'vehicle_number'=>$request->reg_num,
            'destination'=>$request->destination,
            'tracing_title'=>$request->title,
            'publish_date'=>$request->date,
            'home_address'=>$request->home_address,
        );

        $success = DB::table('tracing')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'Tracing Sent Successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }

    }


    public function tracing_passenger_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'id_num' => 'required',
            'temp' => 'required',
            'title' => 'required',
            'phone_num' => 'required',
            'vehicle_num' => 'required',
            'seat_num' => 'required',
            'from_village' => 'required',
            'date' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'contact_num' => 'required',
            'to_village' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = array(
            'user_id'=>$request->user_id,
            'id_num' => $request->id_num,
            'passenger_name'=>$request->name,
            'tracing_title'=>$request->title,
            'temp'=>$request->temp,
            'tel_number'=>$request->phone_num,
            'vehicle_num'=>$request->vehicle_num,
            'seat_num'=>$request->seat_num,
            'from_village'=>$request->from_village,
            'to_village'=>$request->to_village,
            'location'=>$request->location,
            'publish_date'=>$request->date,
            'contact'=>$request->contact,
            'contact_num'=>$request->contact_num,
            'infect_str'=>$request->infect_str,
            'history_last'=>$request->history_last,
            'collection_id'=>$request->collection_id,
        );

        $success = DB::table('tracing_passenger')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'Tracing Sent Successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }

    }


    public function gbv_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'county' => 'required',
            'nature' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'report_date' => 'required',
            'status' => 'required',
            'report_place' => 'required',
            'remark' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = array(
            'user_id'=>$request->user_id,
            'title' => $request->title,
            'county'=>$request->county,
            'nature'=>$request->nature,
            'gender'=>$request->gender,
            'age'=>$request->age,
            'report_date'=>$request->report_date,
            'report_place' => $request->report_place,
            'status'=>$request->status,
            'remark'=>$request->remark,
        );

        $success = DB::table('gbv_list')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'Tracing Sent Successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }

    }
    public function chv_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'name' => 'required',
            'age' => 'required',
            'id_num' => 'required',
            'nhif' => 'required',
            'village' => 'required',
            'nearname' => 'required',
            'mask' => 'required',
            'provide' => 'required',
            'indicate' => 'required',
            'ward' => 'required',
            'remark' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = array(
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'title' => $request->title,
            'age'=>$request->age,
            'id_num'=>$request->id_num,
            'nhif'=>$request->nhif,
            'village'=>$request->village,
            'nearname' => $request->nearname,
            'mask'=>$request->mask,
            'provide'=>$request->provide,
            'mal'=>$request->mal,
            'diabet'=>$request->diabet,
            'hyper'=>$request->hyper,
            'tb'=>$request->tb,
            'ward' => $request->ward,
            'indicate'=>$request->indicate,
            'remark'=>$request->remark,
        );

        $success = DB::table('chv_list')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'CHV Sent Successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }

    }

    public function chv_mother_add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'name' => 'required',
            'age' => 'required',
            'nhif' => 'required',
            'mother_id' => 'required',
            'tel_num' => 'required',
            'clinic' => 'required',
            'due_date' => 'required',
            'folic' => 'required',
            'mary' => 'required',
            'children' => 'required',
            'village' => 'required',
            'ward' => 'required',
            'remark' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = array(
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'title' => $request->title,
            'age'=>$request->age,
            'mother_id'=>$request->mother_id,
            'nhif'=>$request->nhif,
            'tel_num'=>$request->tel_num,
            'clinic' => $request->clinic,
            'due_date'=>$request->due_date,
            'folic'=>$request->folic,
            'mary'=>$request->mary,
            'village'=>$request->village,
            'ward'=>$request->ward,
            'children'=>$request->children,
            'remark'=>$request->remark,
        );

        $success = DB::table('chv_mother_list')->insert($data);

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'CHV Sent Successfully']);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }

    }

    public function all_symptoms()
    {
        $symptoms = DB::table('symptoms')->get();
        return response()->json(['status'=>'success', 'data'=>$symptoms]);  
    }
    
    
    
}