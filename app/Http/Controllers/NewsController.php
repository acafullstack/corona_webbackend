<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\User;
use App\News;
use DB;

class NewsController extends Controller
{
    
    public function index($id)
    {
        $news = News::get();
        $info_news = DB::table('information_center')->where('id',$id)->first();
        // echo "<pre>";
        // print_r($info_news);exit;
        return view('admin.news.home', compact('news','info_news'));
    }
    
    public function add_news($id)
    {
        $info_news = DB::table('information_center')->where('id',$id)->first();
        return view('admin.news.add', compact('info_news'));
    }
    
    public function store_news(Request $request)
    {
//         $file=$request->file('news_image');
// $ext=$file->getClientOriginalExtension();
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->news_image =="")
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
                    $destinationpath=public_path('assets/images/news');
                    $file->move($destinationpath,$imgname);
                }
                $news = new News;
                $news->title = $request->title;
                 $news->url = $request->url;
                  $news->description = $request->description;
                $news->image = $imgname;
                 $news->file_type = $request->file;
                  $news->period = $request->period;
                $success = $news->save();
                // print_r($imgname);exit;
                if($success)
                {
                    return redirect('admin/news')->with('success', 'News added successfully');
                }else{
                     return redirect()->back()->with('alert','There is something wrong')->withInput();
                }
                  
    }      
    
    public function edit_news($id, $info_id)
    {
         $info_news = DB::table('information_center')->where('id',$info_id)->first();
        $news = News::find($id);
        return view('admin.news.edit', compact('news', 'info_news'));
    } 
    
    public function update_news(Request $request)
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
                    $destinationpath=public_path('assets/images/news');
                    $file->move($destinationpath,$imgname);
                }else{
                    $imgname=$request->news_img;
                }
                $news =News::find($request->news_id);
                $news->title = $request->title;
                 $news->url = $request->url;
                  $news->description = $request->description;
                $news->image = $imgname;
                $news->file_type = $request->file;
                  $news->period = $request->period;
                $success = $news->save();
                
                if($success)
                {
                    return redirect()->back()->with('success', 'News Updated successfully');
                }else{
                     return redirect()->back()->with('alert','There is something wrong')->withInput();
                }
                  
    }    
    
    
    
    
    
}