<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Support\Str;
use DB;

class UserController extends Controller 
{
	public $successStatus = 200;

    public function login(Request $request)
    { 
        $user = User::where('email', $request->email)->where('password', md5($request->password))->first();
        if ($user)
        {
            // $user =Auth::user();
             if($user->user_role==1)
            {
              return response()->json(['status'=>'failed','msg'=>'Only user can Login']);   
            }
            // Auth::login($user);
            $data = array(
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name, 
                'user_type_id'=>$user->user_type_id,
                'email'=>$user->email,
                'gender'=>$user->gender,
                'age'=>$user->age,
                'enforce_level'=>$user->enforce_level,
                'gover_level'=>$user->gover_level,
                'border_level'=>$user->border_level,
                'gbv_level'=>$user->gbv_level,
                'chv_level'=>$user->chv_level,
                'state'=>$user->state,
                'profile_image'=>$user->profile_image,
                );
                $conversation_id = DB::table('message')->where('sender_id',$user->id)->first();
                if(isset($conversation_id))
                {
                    return response()->json(['status'=>'success','data'=>$data,'conversation_id'=>$conversation_id->conversation_id]);
                }else{
                    return response()->json(['status'=>'success','data'=>$data, 'conversation_id'=>""]);
                }
            return response()->json(['status'=>'success','data'=>$data]); 
        } 
        else{ 
            return response()->json(['status'=>'failed', 'msg'=>'Invalid email/password']); 
        }
    }

    public function update_profile(Request $request) 
    { 
       // echo "<pre>";
       // print_r($request->all());exit;
        $check = User::where('email', $request->email)->first();
        if(!isset($check))
        {
           return response()->json(['status'=>'failed', 'msg'=>'You have enter wrong email']);  
        }
       if($request->hasfile('profile_image')){

            $postData = $request->only('profile_image');

            $file = $postData['profile_image'];

            $fileArray = array('image' => $file);

            // Tell the validator that this file should be an image
            $rules = array(
              'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($fileArray, $rules);

            // Check to see if validation fails or passes
            if ($validator->fails())
            {        
                return response()->json(['status'=>'failed', 'msg'=>'Upload image only']);
            }
            if($check->image_name!="")
            {
                $destinationpath=public_path("profile_image/".$check->image_name);
                File::delete($destinationpath);
            }
                $file=$request->file('profile_image');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $ext=$file->getClientOriginalExtension();
                $imgname=uniqid().$filename;
                $destinationpath=public_path('profile_image');
                $file->move($destinationpath,$imgname);
            }
        // print_r($imgname);exit;
       //$success = $my_user->save();
       if($request->password!="")
       {
           if(!isset($imgname))
           {
             $imgname="";  
           }
           $data = array(
           'first_name'=>strtolower($request->first_name),
           'last_name'=>strtolower($request->last_name),
           'password'=>md5($request->password),  
           'user_type_id'=>$request->user_type_id,
           'gender'=>$request->gender,
           'age'=>$request->age,
           'state'=>$request->state,
           'profile_image'=>$imgname,
           );
       }else{
            if(!isset($imgname))
           {
             $imgname="";  
           }
           $data = array(
           'first_name'=>strtolower($request->first_name),
           'last_name'=>strtolower($request->last_name),
           'user_type_id'=>$request->user_type_id,
           'gender'=>$request->gender,
           'age'=>$request->age,
           'state'=>$request->state,
           'profile_image'=>$imgname,
           );
       }
       
            // print_r($data);exit;
            $success = DB::table('users')->where('email',$request->email)->update($data);
        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'User Profile Updated Successfully']);  
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
    }
    
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'gender' => 'required',
            'age' => 'required',
            'state' => 'required',
            'user_type_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $check = User::where('email', $request->email)->first();
        if(isset($check))
        {
           return response()->json(['status'=>'failed', 'msg'=>'This email is already register. Try other Email']);  
        }
       // $input = $request->all(); 
       $my_user= new User;
       $my_user->first_name = strtolower($request->first_name);
        $my_user->last_name = strtolower($request->last_name);
        $my_user->user_type_id = $request->user_type_id;
       $my_user->email = $request->email;
       $my_user->password = md5($request->password);
       $my_user->gender = strtolower($request->gender);
       $my_user->age = strtolower($request->age);
       $my_user->state = strtolower($request->state);

       $success = $my_user->save();

        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'User Register Successfully']);  
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
    }
    
    public function forgot_password(Request $request)
    {
        $check = User::where('email',$request->email)->first();
        
        if(!isset($check))
        {
            return response()->json(['status'=>'failed', 'msg'=>'You have Enter wrong Email']);
        }
        
        $email = $request->email;
        $password = Str::random(8);
        $hash_password = md5($password);
        DB::table('users')->where('email',$request->email)->update(['password'=>$hash_password]);
        $email_data = array( 'password' => $password,'email'=>$email );

        $test = Mail::send(['html'=>'forgot_password_email'], $email_data, function($message) use($email ) {
              $message->to($email, 'Corona APP')->subject
                 ('Password');
              $message->from('info@sendways.com','Corona APP');
        }); 
         
        return response()->json(['status'=>'success', 'msg'=>'New Password is sent to your Email']);  
    }
    
    public function getnews()
    {
        $news = DB::table('news')->orderBy('id','DESC')->get();
        return response()->json(['status'=>'success','data'=>$news]); 
    }
    
    public function getTrend()
    {
        $trend = DB::table('trends')->orderBy('id','DESC')->get();
        return response()->json(['status'=>'success','data'=>$trend]); 
    }
    
    public function information_center()
    {
        $information_center = DB::table('information_center')->get();
        return response()->json(['status'=>'success','information_center'=>$information_center]); 
    }

    public function enforce_list()
    {
        $enforce_list = DB::table('enforce')->get();
        return response()->json(['status'=>'success','enforce_list'=>$enforce_list]);
    }
    public function tracing_list()
    {
        $tracing_list = DB::table('tracing')->get();
        return response()->json(['status'=>'success','tracing_list'=>$tracing_list]);
    }
    public function tracing_passenger_list()
    {
        $tracing_list = DB::table('tracing_passenger')->get();
        return response()->json(['status'=>'success','tracing_passenger'=>$tracing_list]);
    }
    public function gbv_list()
    {
        $gbv_list = DB::table('gbv_list')->get();
        return response()->json(['status'=>'success','gbv_list'=>$gbv_list]);
    }

    public function chv_list()
    {
        $chv_list = DB::table('chv_list')->get();
        return response()->json(['status'=>'success','chv_list'=>$chv_list]);
    }
    public function chv_mother_list()
    {
        $chv_mother_list = DB::table('chv_mother_list')->get();
        return response()->json(['status'=>'success','chv_mother_list'=>$chv_mother_list]);
    }
    public function information_center_detail(Request $request)
	{
	        $information_center = DB::table('information_center_detail')->where('information_center_id',$request->information_center_id)->get();
	        return response()->json(['status'=>'success','information_center'=>$information_center]); 
	    } 
	    
	public function profile_image(Request $request)
	{
	   if($request->hasfile('profile_image')){

            $postData = $request->only('profile_image');

            $file = $postData['profile_image'];

            $fileArray = array('image' => $file);

            // Tell the validator that this file should be an image
            $rules = array(
              'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($fileArray, $rules);

            // Check to see if validation fails or passes
            if ($validator->fails())
            {        
                return response()->json(['status'=>'failed', 'msg'=>'Upload image only']);
            }
            $user = User::where('id', $request->user_id)->first();
            if($user->image_name!="")
            {
                $destinationpath=public_path("profile_image/".$check->image_name);
                File::delete($destinationpath);
            }
                $file=$request->file('profile_image');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $ext=$file->getClientOriginalExtension();
                $imgname=uniqid().$filename;
                $destinationpath=public_path('profile_image');
                $file->move($destinationpath,$imgname);
            }
            // print_r($user);exit;
            $data = array(
           'first_name'=>strtolower($user->first_name),
           'last_name'=>strtolower($user->last_name),
          
           'user_type_id'=>$user->user_type_id,
           'gender'=>$user->gender,
           'age'=>$user->age,
           'state'=>$user->state,
           'profile_image'=>$imgname,
           );
            $success = DB::table('users')->where('id',$request->user_id)->update($data);
                if($success)
                {
                    return response()->json(['status'=>'success', 'msg'=>'User Profile Image Updated Successfully', 'image_name'=>$imgname]);  
                }else{
                    return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
                }
	}

    public function update_token(Request $request){
        $user = User::where('id', $request->user_id)->first();
        if($user){
            $user->token = $request->token;
            $user->save();
            return response()->json(['status'=>'success', 'msg'=>'User Token Updated Successfully']); 
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        }
    }
}
