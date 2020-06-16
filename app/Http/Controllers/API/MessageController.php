<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;  
use App\Admins; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Mail;
use Illuminate\Support\Str;
use DB;

class MessageController extends Controller 
{
    public function message(Request $request)
    {
        $created_at = now();
        // print_r($created_at);exit;
        if($request->msg=="")
        {
            return response()->json(['status'=>'failed', 'msg'=>'You forgot to Write a Message']);
        }
        $admin = Admins::first();
        // print_r($admin);exit;
        
        $userss = User::find($request->sender_id);
        
        $data = array(
            'sender_id'=> $request->sender_id,
            'receiver_id'=> $admin->id,
            'msg'=> $request->msg, 
            'parent_id'=>0, 
            'user_name'=>$userss->first_name,
            'user_image'=>$userss->profile_image, 
             'created_at'=>$created_at,
            );
            
        $id = DB::table('message')->insertGetId($data);
        $check= DB::table('message')->where('sender_id',$request->sender_id)->where('conversation_id','!=',"")->first();
        // print_r($check);exit;
        if(isset($check))
        {
           $success = DB::table('message')->where('id',$id)->update(['conversation_id'=>$check->conversation_id, 'parent_id'=>$check->id]); 
           $converstion_id = $check->conversation_id;
        }else{
        $converstion_id = $id . Str::random(5);
        $success = DB::table('message')->where('id',$id)->update(['conversation_id'=>$converstion_id]);
        
        
        // Email and SMS to ADMIN
            // $user = User::where('id', $request->sender_id)->first();
            // $admin_email = $admin->email;
            // $email_data = array( 'user_name' => $user->first_name . ' ' .$user->last_name, 'email' => $user->email, 'message' => $request->msg);
    
            // Mail::send(['html'=>'admin/msg_email_to_admin'], $email_data, function($message) use($admin_email) {
            //     $message->to($admin_email, 'Corona APP')->subject('Message From User');
            //     $message->from('info@sendways.com','Corona APP');
            // }); 
            
            // file_get_contents("http://www.estoresms.com/smsapi.php?username=projects@degreydigital.com&password=3805963m9523&sender=User&recipient=923364114217&message=$request->msg");
        // End
            
        }
        
        if($success)
        {
            return response()->json(['status'=>'success', 'msg'=>'Message Sent Successfully', 'converstion_id'=>$converstion_id]);
        }else{
            return response()->json(['status'=>'failed', 'msg'=>'There is something Wrong']);
        } 
    }
    
    public function all_msg(Request $request)
    {
       $all_msg =  DB::table('message')->where('conversation_id',$request->conversation_id)->get();
       DB::table('message')->where('conversation_id',$request->conversation_id)->where('receiver_id',$request->user_id)->update(['seen'=>1]);
       	// foreach($all_msg as $msg)
        // 	{
        // 	   $abc =  DB::table('message')->where('conversation_id',$request->conversation_id)->where('receiver_id',$request->user_id)->get();
        // 	   echo "<pre>";
        // 	    print_r($abc);exit;
        	   //DB::table('message')->where('id',$msg->id)->where('receiver_id',$request->user_id)->update(['seen'=>1]);
        // 	}
        	
       return response()->json(['status'=>'success', 'all_msg'=>$all_msg]);
    }
    
    
}