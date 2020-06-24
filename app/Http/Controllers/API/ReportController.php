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

    public function reportalldata(Request $request){
        file_put_contents("all.txt",print_r($request->report_data,1));
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'first_name'=>"",
                'second_name'=>"",
                'user_id'=>$array[$i]['user_id'],
                'report_type'=>$array[$i]['report_type'],
                'city'=>$array[$i]['city'],
                'country'=>$array[$i]['country'],
                'state'=>$array[$i]['state'],
                'address'=>$array[$i]['address'],
                'symptom'=>$array[$i]['symptom'],
                'additional_info'=>$array[$i]['additional_info'],
                'lat'=>$array[$i]['latitude'],
                'lng'=>$array[$i]['longitude'],
            );
            $success = DB::table('report')->insert($data);
            if(!$success)
            {
                file_put_contents("all2.txt",print_r($array[$i]['user_id'],1));
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                file_put_contents("all3.txt",print_r($array[$i]['user_id'],1));
                return response()->json(['status'=>'success', 'msg'=>'All report data Added successfully']);
            }
        }


    }
    public function checkalldata(Request $request){
        file_put_contents("all.txt",print_r($request->report_data,1));
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=>$array[$i]['user_id'],
                'people'=>$array[$i]['peaple'],
                'time'=>$array[$i]['time'],
                'utilities'=>$array[$i]['utilities'],
                'additional_info'=>$array[$i]['additional_info'],
                'lat'=>$array[$i]['latitude'],
                'lng'=>$array[$i]['longitude'],
                'city'=>$array[$i]['city'],
                'country'=>$array[$i]['country'],
                'address'=>$array[$i]['address'],
                'state'=>$array[$i]['state'],

            );
            $success = DB::table('check_in')->insert($data);
            if(!$success)
            {
                file_put_contents("all2.txt",print_r($array[$i]['user_id'],1));
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                file_put_contents("all3.txt",print_r($array[$i]['user_id'],1));
                return response()->json(['status'=>'success', 'msg'=>'All CheckIn data Added successfully']);
            }
        }


    }
    public function enforcealldata(Request $request){
    $array = json_decode($request->report_data,true);
    for($i=0; $i<sizeof($array) ; $i++){
        $data = array(
            'user_id'=>$array[$i]['user_id'],
            'enforce_type'=>$array[$i]['enforce_type'],
            'title'=>$array[$i]['title'],
            'description'=>$array[$i]['description'],

        );
        $success = DB::table('enforce')->insert($data);
        if(!$success)
        {
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
        if($i== sizeof($array)-1){
            return response()->json(['status'=>'success', 'msg'=>'All Enforce data Added successfully']);
        }
    }


}


    public function visitalldata(Request $request){
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=>$array[$i]['user_id'],
                'name'=>$array[$i]['name'],
                'title' => $array[$i]['title'],
                'age'=>$array[$i]['age'],
                'id_num'=>$array[$i]['id_num'],
                'nhif'=>$array[$i]['nhif'],
                'village'=>$array[$i]['village'],
                'nearname' => $array[$i]['nearname'],
                'mask'=>$array[$i]['mask'],
                'provide'=>$array[$i]['provide'],
                'mal'=>$array[$i]['mal'],
                'diabet'=>$array[$i]['diabet'],
                'hyper'=>$array[$i]['hyper'],
                'tb'=>$array[$i]['tb'],
                'ward' => $array[$i]['ward'],
                'indicate'=>$array[$i]['indicate'],
                'remark'=>$array[$i]['remark'],

            );
            $success = DB::table('chv_list')->insert($data);
            if(!$success)
            {
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                return response()->json(['status'=>'success', 'msg'=>'All Household data Added successfully']);
            }
        }


    }
    public function motheralldata(Request $request){
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=>$array[$i]['user_id'],
                'name'=>$array[$i]['name'],
                'title' => $array[$i]['title'],
                'age'=>$array[$i]['age'],
                'mother_id'=>$array[$i]['mother_id'],
                'nhif'=>$array[$i]['nhif'],
                'tel_num'=>$array[$i]['tel_num'],
                'clinic' => $array[$i]['clinic'],
                'due_date'=>$array[$i]['due_date'],
                'folic'=>$array[$i]['folic'],
                'mary'=>$array[$i]['mary'],
                'village'=>$array[$i]['village'],
                'ward'=>$array[$i]['ward'],
                'children'=>$array[$i]['children'],
                'remark'=>$array[$i]['remark'],

            );
            $success = DB::table('chv_mother_list')->insert($data);
            if(!$success)
            {
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                return response()->json(['status'=>'success', 'msg'=>'All Mothers data Added successfully']);
            }
        }


    }
    public function gbvalldata(Request $request){
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=>$array[$i]['user_id'],
                'title' => $array[$i]['title'],
                'county'=>$array[$i]['county'],
                'nature'=>$array[$i]['nature'],
                'gender'=>$array[$i]['gender'],
                'age'=>$array[$i]['age'],
                'report_date'=>$array[$i]['report_date'],
                'report_place' => $array[$i]['report_place'],
                'status'=>$array[$i]['status'],
                'remark'=>$array[$i]['remark'],

            );
            $success = DB::table('gbv_list')->insert($data);
            if(!$success)
            {
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                return response()->json(['status'=>'success', 'msg'=>'All Gbv data Added successfully']);
            }
        }


    }
    public function officealldata(Request $request){
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=> $array[$i]['user_id'],
                'passenger_name'=> $array[$i]['name'],
                'unique_card_number'=> $array[$i]['card_num'],
                'service_type'=> $array[$i]['service_type'],
                'tel_number'=> $array[$i]['tel_num'],
                'vehicle_number'=> $array[$i]['reg_num'],
                'destination'=> $array[$i]['destination'],
                'tracing_title'=> $array[$i]['title'],
                'publish_date'=> $array[$i]['date'],
                'home_address'=> $array[$i]['home_address'],

            );
            $success = DB::table('tracing')->insert($data);
            if(!$success)
            {
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                return response()->json(['status'=>'success', 'msg'=>'All Officers data Added successfully']);
            }
        }


    }
    public function passengeralldata(Request $request){
        $array = json_decode($request->report_data,true);
        for($i=0; $i<sizeof($array) ; $i++){
            $data = array(
                'user_id'=>$array[$i]['user_id'],
                'id_num' => $array[$i]['id_num'],
                'passenger_name'=>$array[$i]['name'],
                'temp'=>$array[$i]['temp'],
                'tel_number'=>$array[$i]['phone_num'],
                'vehicle_num'=>$array[$i]['vehicle_num'],
                'seat_num'=>$array[$i]['seat_num'],
                'from_village'=>$array[$i]['from_village'],
                'to_village'=>$array[$i]['to_village'],
                'location'=>$array[$i]['location'],
                'publish_date'=>$array[$i]['date'],
                'contact'=>$array[$i]['contact'],
                'contact_num'=>$array[$i]['contact_num'],
                'infect_str'=>$array[$i]['infect_str'],
                'history_last'=>$array[$i]['history_last'],

            );
            $success = DB::table('tracing_passenger')->insert($data);
            if(!$success)
            {
                return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
            }
            if($i== sizeof($array)-1){
                return response()->json(['status'=>'success', 'msg'=>'All Passengers data Added successfully']);
            }
        }


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
        $data = array(
            'user_id'=>$request->user_id,
            'id_num' => $request->id_num,
            'passenger_name'=>$request->name,
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
            $temp_value = (float) $request->temp;
            if($temp_value>=37.8){
                $user_email = 'covid19.laikipia@laikipia.go.ke';
                $email_temp = "Potential covid-19 alert from  ".$request->name." tel: ".$request->phone_num." temp ".$request->temp;
                $email_data = array( 'situation' => $email_temp,'email' => $user_email );


                Mail::send(['html'=>'admin/report_email'], $email_data, function($message) use($user_email) {
                    $message->to($user_email, 'COVID-19 Tracker')->subject('RE: Potential Covid-19 Alert!!');
                    $message->from('covid19.laikipia@laikipia.go.ke','COVID-19 Tracker');
                });


                $api_key = "K3245daMd05Lnd7b8di25T764xa5c85y520a2a36Bn36Re60PU7sXB0i5oG8n6ua";

                $shortcode = "LAIKIPIAGOV";
                $serviceId = '0';
                $mobile = "254706031031";

                $smsdata = array(
                    "api_key" => $api_key,
                    "shortcode" => $shortcode,
                    "mobile" => $mobile,
                    "message" => $email_temp,
                    "serviceId" => $serviceId,
                    "response_type" => "json",
                );

                $smsdata_string = json_encode($smsdata);
                //echo $smsdata_string . "\n";

                $smsURL = "http://sms.313-labs.com:7211/sms/v3/sendsms";

//POST
                $ch = curl_init($smsURL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $smsdata_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($smsdata_string))
                );

                $apiresult = curl_exec($ch);
                file_put_contents("sms.txt",print_r($apiresult,1));
                if (!$apiresult) {
                    die("ERROR on URL | error[" . curl_error($ch) . "] | error code[" . curl_errno($ch) . "]\n");
                }

                curl_close($ch);
            }

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