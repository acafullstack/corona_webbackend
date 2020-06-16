<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\User;
use App\News;
use DB;

class EnforceCenterController extends Controller
{

    public function index()
    {
        $info = DB::table("enforce")->get();
        return view('admin.enforce_center.home', compact('info'));
    }

    public function add_info()
    {
        return view('admin.information_center.add');
    }

    public function edit_info($id)
    {

        $info = DB::table("information_center")->where('id',$id)->first();
        if($info->id==1)
        {
            $risk_detail = DB::table("information_center_detail")->where('information_center_id',$info->id)->get();
            return view('admin.information_center.risk', compact('info','risk_detail'));
        }
        //   if($info->id==2)
        //   {
        //       return view('admin.information_center.help', compact('info'));
        //   }
        return view('admin.information_center.edit', compact('info'));
    }
    public function delete($id)
    {

        DB::table("enforce")->where('id',$id)->delete();
        $info = DB::table("enforce")->get();
        return view('admin.enforce_center.home', compact('info'));
    }
    public function store_info(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;

        if($request->news_image =="")
        {
            return redirect()->back()->with('alert', 'You forgot to select image or video')->withInput();
        }

        if($request->icon_img =="")
        {
            return redirect()->back()->with('alert', 'You forgot to select image or video')->withInput();
        }

        if($request->hasfile('news_image')){

            if($request->file=="image")
            {
                $postData = $request->only('news_image');

                $file = $postData['news_image'];

                $fileArray = array('image' => $file);

                // Tell the validator that this file should be an image
                $rules = array(
                    'image' => 'mimes:jpeg,jpg,png,gif|required|max:3000' // max 3000kb
                );

                // Now pass the input and rules into the validator
                $validator = Validator::make($fileArray, $rules);


                // Check to see if validation fails or passes
                if ($validator->fails())
                {
                    return redirect()->back()->with('alert','Upload Image only')->withInput();
                }
            }

            $file=$request->file('news_image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('information_center_image');
            $file->move($destinationpath,$imgname);
        }

        if($request->hasfile('icon_img')){

            $postData = $request->only('icon_img');

            $file = $postData['icon_img'];

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
                return redirect()->back()->with('alert','Upload Image only')->withInput();
            }
            $file=$request->file('icon_img');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $iconName=uniqid().$filename;
            $destinationpath=public_path('information_center_icon');
            $file->move($destinationpath,$iconName);
        }

        $data = array(
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imgname,
            'icon'=>$iconName,
            'file_type'=>$request->file,
            'content'=>$request->content,
        );
        $success = DB::table('information_center')->insert($data);

        if($success)
        {
            return redirect('admin/information')->with('success', 'Information Center Added successfully');
        }else{
            return redirect()->back()->with('alert','Nothing to update')->withInput();
        }
    }

    public function update_info(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->hasfile('news_image')){

            if($request->file=="image")
            {
                $postData = $request->only('news_image');

                $file = $postData['news_image'];

                $fileArray = array('image' => $file);

                // Tell the validator that this file should be an image
                $rules = array(
                    'image' => 'mimes:jpeg,jpg,png,gif|required|max:3000' // max 3000kb
                );

                // Now pass the input and rules into the validator
                $validator = Validator::make($fileArray, $rules);


                // Check to see if validation fails or passes
                if ($validator->fails())
                {
                    return redirect()->back()->with('alert','Upload Image only')->withInput();
                }
            }
            // else{
            //     $postData = $request->only('news_image');

            // $file = $postData['news_image'];

            // $fileArray = array('video' => $file);

            // // Tell the validator that this file should be an image
            // $rules = array(
            //   'video' => 'mimes:flv,mp4,m3u8,ts,3gp,mov,avi,wmv|required|max:10000' // max 10000kb
            // );

            // // Now pass the input and rules into the validator
            // $validator = Validator::make($fileArray, $rules);


            // // Check to see if validation fails or passes
            // if ($validator->fails())
            // {
            //     return redirect()->back()->with('alert','Upload video only')->withInput();
            // }
            // }
            $file=$request->file('news_image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('information_center_image');
            $file->move($destinationpath,$imgname);
        }else{
            $imgname=$request->news_img;
        }

        if($request->hasfile('icon_img')){

            $postData = $request->only('icon_img');

            $file = $postData['icon_img'];

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
                return redirect()->back()->with('alert','Upload Image only')->withInput();
            }
            $file=$request->file('icon_img');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $iconName=uniqid().$filename;
            $destinationpath=public_path('information_center_icon');
            $file->move($destinationpath,$iconName);
        }else{
            $iconName=$request->icon_img;
        }

        $data = array(
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imgname,
            'icon'=>$iconName,
            'file_type'=>$request->file,
            'content'=>$request->content,
        );
        $success = DB::table('information_center')->where('id',$request->info_id)->update($data);

        if($success)
        {
            return redirect()->back()->with('success', 'Information Center Updated successfully');
        }else{
            return redirect()->back()->with('alert','Nothing to update')->withInput();
        }

    }

    public function update_risk(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;

        $combine = array_combine($request->is_risk, $request->descriptionss);

        if($request->hasfile('news_image')){

            $postData = $request->only('news_image');

            $file = $postData['news_image'];

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
                return redirect()->back()->with('alert','Upload Image only')->withInput();
            }
            $file=$request->file('news_image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('information_center_image');
            $file->move($destinationpath,$imgname);
        }else{
            $imgname=$request->news_img;
        }


        if($request->hasfile('icon_img')){

            $postData = $request->only('icon_img');

            $file = $postData['icon_img'];

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
                return redirect()->back()->with('alert','Upload Image only')->withInput();
            }
            $file=$request->file('icon_img');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $iconName=uniqid().$filename;
            $destinationpath=public_path('information_center_icon');
            $file->move($destinationpath,$iconName);
        }else{
            $iconName=$request->icon_img;
        }

        $data = array(
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imgname,
            'icon'=>$iconName,
            'content'=>$request->content,
        );
        $success = DB::table('information_center')->where('id',$request->info_id)->update($data);

        $combine = array_combine($request->is_risk, $request->descriptionss);

        foreach($request->info_detail_id as $info_detail_ids)
        {
            DB::table("information_center_detail")->where('id',$info_detail_ids)->delete();
        }

        foreach($combine as $key =>$data)
        {
            $success = DB::table("information_center_detail")->insert(['is_risk'=>$key,'description'=>$data,'information_center_id'=>1]);
        }

        //         echo "<pre>";
        // print_r($combine);exit;

        if($success)
        {
            return redirect()->back()->with('success', 'Information Center Updated successfully');
        }else{
            return redirect()->back()->with('alert','There is something wrong')->withInput();
        }

    }

    public function trend($id)
    {
        $trends = DB::table('trends')->get();
        $info_news = DB::table('information_center')->where('id',$id)->first();
        return view('admin.trend.home', compact('trends','info_news'));
    }

    public function add_trend($id)
    {
        $info_news = DB::table('information_center')->where('id',$id)->first();
        return view('admin.trend.add', compact('info_news'));
    }

    public function store_trend(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->news_image =="")
        {
            return redirect()->back()->with('alert', 'You forgot to select image')->withInput();
        }

        if($request->hasfile('news_image')){
            if($request->file=="image")
            {
                $postData = $request->only('news_image');

                $file = $postData['news_image'];

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
                    return redirect()->back()->with('alert','Upload Image only')->withInput();
                }
            }
            $file=$request->file('news_image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('trend_image');
            $file->move($destinationpath,$imgname);
        }
        // print_r($imgname);exit;
        $data = array(
            'title'=> $request->title,
            'url'=> $request->url,
            'description' => $request->description,
            'image'=> $imgname,
            'file_type' => $request->file,
            'period' => $request->period,
        );
        $success = DB::table('trends')->insert($data);
        // print_r($imgname);exit;
        if($success)
        {
            return redirect('admin/trend')->with('success', 'Trend added successfully');
        }else{
            return redirect()->back()->with('alert','There is something wrong')->withInput();
        }

    }

    public function edit_trend($id, $info_id)
    {
        $trends = DB::table('trends')->where('id',$id)->first();
        $info_news = DB::table('information_center')->where('id',$info_id)->first();
        return view('admin.trend.edit', compact('trends', 'info_news'));
    }

    public function update_trend(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->hasfile('news_image')){
            if($request->file=="image")
            {
                $postData = $request->only('news_image');

                $file = $postData['news_image'];

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
                    return redirect()->back()->with('alert','Upload Image only')->withInput();
                }
            }
            $file=$request->file('news_image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $ext=$file->getClientOriginalExtension();
            $imgname=uniqid().$filename;
            $destinationpath=public_path('trend_image');
            $file->move($destinationpath,$imgname);
        }else{
            $imgname=$request->news_img;
        }
        $data = array(
            'title'=> $request->title,
            'url'=> $request->url,
            'description' => $request->description,
            'image'=> $imgname,
            'file_type' => $request->file,
            'period' => $request->period,
        );
        //   echo "<pre>";
        //     print_r($data);exit;
        $success = DB::table('trends')->where('id',$request->trend_id)->update($data);

        if($success)
        {
            return redirect()->back()->with('success', 'Trend Updated successfully');
        }else{
            return redirect()->back()->with('alert','There is something wrong')->withInput();
        }

    }








}