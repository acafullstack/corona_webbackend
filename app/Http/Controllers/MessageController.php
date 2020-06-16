<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Session;
use DateTime;

class MessageController extends Controller
{
    
    public function send_msg(Request $request)
    {
        // print_r($request->all());exit;
        $messagess = DB::table('message')->where('conversation_id',$request->id)->get();
        	foreach($messagess as $msg)
        	{
        	   DB::table('message')->where('conversation_id',$request->id)->where('receiver_id',$request->admin_id)->update(['seen'=>1]);
        	}
        $single_messagess = DB::table('message')->where('conversation_id',$request->id)->where('parent_id',0)->first();
        $user = User::find($single_messagess->sender_id);
        $conversation_id = $request->id;
        return ['status'=>1, 'msg'=>$messagess, 'converstion_id'=>$conversation_id, 'user'=>$user];
       
    }
    
    public function sending_msg(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        
        $first_msg =  DB::table('message')->where('conversation_id',$request->my_converstion)->first();
        $data = array(
            'sender_id'=>$request->admin_ids,
            'receiver_id'=>$first_msg->sender_id,
            'msg'=>$request->msgs,
            'parent_id'=>$first_msg->id,
            'conversation_id'=>$request->my_converstion,
            );
            
            // print_r($data);exit;
            $success = DB::table('message')->insertGetId($data);
            $data = DB::table('message')->where('id',$success)->first();
            if($success)
            {
                $user = User::where('id', $first_msg->sender_id)->first();
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n \"to\" : \"$user->token\",\n \"notification\" : {\n     \"body\" : \"$request->msgs\",\n     \"title\": \"Message from Admin\"\n }\n}");
                
                $headers = array();
                $headers[] = 'Authorization: key=AAAAIX3zR4Q:APA91bFfJHdn_V3X-CVaP_4GKr6Khs4I0iiI5fwxX2dp8t7X8CWFZ06NZUWSTwxUup2kspyhrZdMscWX3HXNxTV9CXh7p8lLKdl8s5faFiuxEp_SAXEuF_q-fIbIVrtGxXbFsU6Qjp1z';
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);
                
                return ['status'=>1, 'data'=>$data];
            }else{
                return ['status'=>0, 'msg'=>'There is something wrong' ];
            }
    }
    
    public function all_msg()
    {
        $msg = DB::table('message')->where('parent_id',0)->get();
        return view('admin.message.home', compact('msg'));
    }
    
    public function user_msg($id)
    {
        $messagess = DB::table('message')->where('conversation_id',$id)->get();
        // echo "<pre>";
        // print_r($messagess);exit;
        	foreach($messagess as $msg)
        	{
        	    $admin_id = Session::get('admin_id');
        	   DB::table('message')->where('conversation_id',$id)->where('receiver_id',$admin_id)->update(['seen'=>1]);
        	}
        $single_messagess = DB::table('message')->where('conversation_id',$id)->where('parent_id',0)->first();
        $user = User::find($single_messagess->sender_id);
        $conversation_id = $id;
        
        return view('admin.message.reply', compact('messagess','single_messagess','user','conversation_id'));
        
    }
    
    public function total_msg_count()
    {
        $new_msg_count = $new_msg_count = DB::table('message')->groupBy('conversation_id')->where('seen', '=', 0)->where('receiver_id', '=', 1)->get();
        $total_msg_count = count($new_msg_count);
        $get_msg = $new_msg_count = DB::table('message')->groupBy('conversation_id')->where('seen', '=', 0)->where('receiver_id', '=', 1)->orderBy('id','DESC')->get();
        //  $get= $new_msg_count = DB::table('message')->groupBy('conversation_id')->where('seen', '=', 0)->where('receiver_id', '=', 1)->orderBy('id','DESC')->first();
        // $current  = now();
        $now = new DateTime();
        $date =   $now->format('Y-m-d H:i:s'); 
        // print_r($get->created_at); echo "<br>";
        // print_r($date);exit;
        
        return ['status'=>1, 'data'=>$total_msg_count, 'get_msg'=>$get_msg, 'now'=>$date];
    }
    
    public function send_all_msg(Request $request)
    {
        // print_r($request->all());exit;
        $ids = $request->ids;
        // print_r($ids);exit();
        $request->session()->put('user_ids', $ids);
         return redirect('add_user_msg');
    }
    
    public function add_user_msg()
    {
        return view('admin.users.user_msg');
    } 
    
     public function sending_user_msg(Request $request)
    {
        // print_r($request->all());exit;
        if($request->message=="")
        {
            return redirect()->back()->with('alert', 'You forget to Enter Message')->withInput();
        }
        $user_id = $request->session()->get('user_ids');
        // print_r($user_id);exit();
        foreach ($user_id as $key => $user_ids) {
            $converstion_id = DB::table('message')->where('sender_id',$user_ids)->first();
            $first_msg =  DB::table('message')->where('conversation_id',$converstion_id->conversation_id)->first();
            $admin_id = Session::get('admin_id');
        $data = array(
            'sender_id'=>$admin_id,
            'receiver_id'=>$user_ids,
            'msg'=>$request->message,
            'parent_id'=>$first_msg->id,
            'conversation_id'=>$converstion_id->conversation_id,
            );
            
            // print_r($data);exit;
            $success = DB::table('message')->insertGetId($data);
        }
        if($success)
        {
           $request->session()->forget('user_ids');
        return redirect('admin/users')->with('success', 'Message Sended Successfully');  
        }else{
            return redirect()->back()->with('alert', 'Something want wrong')->withInput();
        }
        
    }
    
    
    
    
    
    
    
    
    
}
