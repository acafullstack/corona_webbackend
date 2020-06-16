<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Check_Ins;
use App\Reports;

class MapController extends Controller
{
  
    public function check_ins(){
        // $new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        // Mapper::map($new_arr[0]['geoplugin_latitude'], $new_arr[0]['geoplugin_longitude']);
	    
        Mapper::map('44.92057', '-93.44786', ['animation' => 'DROP', 'title' => 'My Location']);
	    
	    $all_check_ins = Check_Ins::get();
	    foreach($all_check_ins as $key => $check_in){
	        $key = $key+1;
	        $url = url('/admin/check_in_details/'. $check_in->id);
	        Mapper::marker($check_in->lat, $check_in->lng, ['animation' => 'DROP', 'title' => $check_in->people, 
	        'eventClick' => 
    	        "var infowindow = new google.maps.InfoWindow(); var iwContent = `<div id='iw_container'><div class='iw_title'><b>People</b> : $check_in->people</div><div class='iw_title'><b>Time</b> : $check_in->time</div><div class='iw_title'><b>Utillity</b> : $check_in->utilities</div></div>`;
                infowindow.setContent(iwContent);
                infowindow.open(map, marker_$key);",
            'eventDblClick' => 'window.location.replace("'.$url.'");'
            ]);
	    }
	    return view('admin.check_ins.home');
    }
    
    public function check_in_details($check_in_id){
	    $check_in_detail = Check_Ins::where('id', $check_in_id)->first();
	    return view('admin.check_ins.details', compact('check_in_detail'));
    }
    
    public function reports(){
        // $new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        // Mapper::map($new_arr[0]['geoplugin_latitude'], $new_arr[0]['geoplugin_longitude']);
	    
        Mapper::map('44.92057', '-93.44786', ['animation' => 'DROP', 'title' => 'My Location']);
	    
	    $all_reports = Reports::get();
	    foreach($all_reports as $key =>  $report){
	        $key = $key+1;
	        $url = url('/admin/report_details/'. $report->id);
	        Mapper::marker($report->lat, $report->lng, ['animation' => 'DROP', 'title' => $report->report_type,
	        'eventClick' => 
    	        "var infowindow = new google.maps.InfoWindow(); var iwContent = `<div id='iw_container'><div class='iw_title'><b>Name</b> : $report->first_name</div><div class='iw_title'><b>Report Type</b> : $report->report_type</div></div>`;
                infowindow.setContent(iwContent);
                infowindow.open(map, marker_$key);",
	        'eventDblClick' => 'window.location.replace("'.$url.'");'
	        ]);
	    }
	    return view('admin.reports.home');
    }
    
    public function report_details($report_id){
	    $report_detail = Reports::where('id', $report_id)->first();
	    return view('admin.reports.details', compact('report_detail'));
    }
}
