
<?php 
setcookie('value', 1, time() + (86400 * 30), "/"); // 86400 = 1 day
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Corona Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <!--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">-->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
  
  <!--csrf token-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}" type="text/javascript"></script> -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <!-- <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> -->
  <link rel="stylesheet" href="{{ asset('css/_sidebar.scss') }}">
  
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
  <!-- Morris.js charts -->
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
<link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Source+Sans+Pro&display=swap" rel="stylesheet">
  
  	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
  	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"></script>-->
  	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

    <style>
                body {
                    font-family: 'Baloo 2', cursive;
font-family: 'Source Sans Pro', sans-serif;
                }
    
        .content {
            padding-top: 15px;
        }
        		@import url('https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i');

.right_menu .dropdown-item-title {
    color:#000 !important;
}
ul {
	list-style: none;
}

.brand-link {
            background-color: #367fa9 !important;
}

.alert-info, .alert-info a, .bg-info, .bg-info a, .label-info, .label-info a {
    color: #fff!important;
}
.main-header {
            background-color: #3c8dbc !important;   
        margin-bottom: -24px;
}

.sidebar-dark-primary {
    background-color: #000 !important;
}

.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active , .sidebar-dark-primary .nav-treeview>.nav-item>.nav-link.active, .sidebar-dark-primary .nav-treeview>.nav-item>.nav-link.active:hover{
    border-left: 3px solid #007bff !important;
    color: #fff; 
        background: #1e282c !important;
    box-shadow: none;
    border-radius: 0;
}


.chatbox-holder {
  position: fixed;
      right: -20px;
  bottom: 0;
  display: flex;
  align-items: flex-end;
  height: 0;
  z-index: 99999999;
}

.chatbox {
  width: 400px;
  height: 400px;
  margin: 0 20px 0 0;
  position: relative;
  box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
  display: flex;
  flex-flow: column;
  border-radius: 10px 10px 0 0;
  background: white;
  bottom: 0;
  transition: .1s ease-out;
}

.chatbox-top {
  position: relative;
  display: flex;
  padding: 10px 0;
  border-radius: 10px 10px 0 0;
  background: rgba(0, 0, 0, .05);
}

.chatbox-icons {
  padding: 0 10px 0 0;
  display: flex;
  position: relative;
}

.chatbox-icons .fa {
  background: rgba(220, 0, 0, .6);
  padding: 3px 5px;
  margin: 0 0 0 3px;
  color: white;
  border-radius: 0 5px 0 5px;
  transition: 0.3s;
}

.chatbox-icons .fa:hover {
  border-radius: 5px 0 5px 0;
  background: rgba(220, 0, 0, 1);
}

.chatbox-icons a, .chatbox-icons a:link, .chatbox-icons a:visited {
  color: white;
}

.chat-partner-name, .chat-group-name {
  flex: 1;
  padding: 0 0 0 95px;
  font-size: 15px;
  font-weight: bold;
  color: #30649c;
  text-shadow: 1px 1px 0 white;
  transition: .1s ease-out;
}

.status {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  display: inline-block;
  box-shadow: inset 0 0 3px 0 rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(0, 0, 0, 0.15);
  background: #cacaca;
  margin: 0 3px 0 0;
}

.online {
  background: #b7fb00;
}

.away {
  background: #ffae00;
}

.donot-disturb {
  background: #ff4343;
}

.chatbox-avatar {
  width: 80px;
  height: 80px;
  overflow: hidden;
  border-radius: 50%;
  background: white;
  padding: 3px;
  box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
  position: absolute;
  transition: .1s ease-out;
  bottom: 0;
  left: 6px;
}

.chatbox-avatar img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

.chat-messages {
  border-top: 1px solid rgba(0, 0, 0, .05);
  padding: 10px;
  overflow: auto;
  display: flex;
  flex-flow: row wrap;
  align-content: flex-start;
  flex: 1;
}

.message-box-holder {
  width: 100%;
  margin: 0 0 15px;
  display: flex;
  flex-flow: column;
  align-items: flex-end;
}

.message-sender {
  font-size: 12px;
  margin: 0 0 15px;
  color: #30649c;
  align-self: flex-start;
}

.message-sender a, .message-sender a:link, .message-sender a:visited, .chat-partner-name a, .chat-partner-name a:link, .chat-partner-name a:visited {
  color: #30649c;
  text-decoration: none;
}

.message-box {
  padding: 6px 10px;
  border-radius: 6px 0 6px 0;
  position: relative;
  background: rgba(100, 170, 0, .1);
  border: 2px solid rgba(100, 170, 0, .1);
  color: #6c6c6c;
  font-size: 12px;
}

.message-box:after {
  content: "";
  position: absolute;
  border: 10px solid transparent;
  border-top: 10px solid rgba(100, 170, 0, .2);
  border-right: none;
  bottom: -22px;
  right: 10px;
}

.message-partner {
  background: rgba(0, 114, 135, .1);
  border: 2px solid rgba(0, 114, 135, .1);
  align-self: flex-start;
}

.message-partner:after {
  right: auto;
  bottom: auto;
  top: -22px;
  left: 9px;
  border: 10px solid transparent;
  border-bottom: 10px solid rgba(0, 114, 135, .2);
  border-left: none;
}

.chat-input-holder {
  display: flex;
  border-top: 1px solid rgba(0, 0, 0, .1);
}

.chat-input {
  resize: none;
  padding: 5px 10px;
  height: 40px;
  font-family: 'Lato', sans-serif;
	font-size: 14px;
  color: #999999;
  flex: 1;
  border: none;
  background: rgba(0, 0, 0, .05);
   border-bottom: 1px solid rgba(0, 0, 0, .05);
}

.chat-input:focus, .message-send:focus {
  outline: none;
}

.message-send::-moz-focus-inner {
	border:0;
	padding:0;
}

.message-send {
  -webkit-appearance: none;
  background: #9cc900;
  background: -moz-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -webkit-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -o-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -ms-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: linear-gradient(180deg, #00d8ff, #00b5d6);
  color: white;
  font-size: 12px;
  padding: 0 15px;
  border: none;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
}

.attachment-panel {
  padding: 3px 10px;
  text-align: right;
}

.attachment-panel a, .attachment-panel a:link, .attachment-panel a:visited {
  margin: 0 0 0 7px;
  text-decoration: none;
  color: rgba(0, 0, 0, 0.5);
}

.chatbox-min {
  margin-bottom: -362px;
/*   height: 46px; */
}

.chatbox-min .chatbox-avatar {
  width: 60px;
  height: 60px;
}

.chatbox-min .chat-partner-name, .chatbox-min .chat-group-name {
  padding: 0 0 0 75px;
}

.settings-popup {
  background: white;
	border-radius: 20px/10px;
	box-shadow: 0 3px 5px 0 rgba(0, 0, 0, .2);
  font-size: 13px;
	opacity: 0;
	padding: 10px 0;
	position: absolute;
	right: 0;
	text-align: left;
	top: 33px;
	transition: .15s;
	transform: scale(1, 0);
	transform-origin: 50% 0;
	width: 120px;
  z-index: 2;
  border-top: 1px solid rgba(0, 0, 0, .2);
  border-bottom: 2px solid rgba(0, 0, 0, .3);
}

.settings-popup:after, .settings-popup:before {
  border: 7px solid transparent;
	border-bottom: 7px solid white;
	border-top: none;	
	content: "";
	position: absolute;
	left: 45px;
	top: -10px;
  border-top: 3px solid rgba(0, 0, 0, .2);
}

.settings-popup:before {
  border-bottom: 7px solid rgba(0, 0, 0, .25);
  top: -11px;
}

.settings-popup:after {
  border-top-color: transparent;
}

#chkSettings {
	display: none;
}

#chkSettings:checked + .settings-popup {
	opacity: 1;
	transform: scale(1, 1);
}

.settings-popup ul li a, .settings-popup ul li a:link, .settings-popup ul li a:visited {
  color: #999;
  text-decoration: none;
  display: block;
  padding: 5px 10px;
}

.settings-popup ul li a:hover {
  background: rgba(0, 0, 0, .05);
}

.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #007bff;
    color: #fff;
}
.dataTables_paginate  {
    height: 44px;
    margin-top: -26px !important;
}
.dataTables_paginate .previous  {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #dee2e6;
    margin-left: 0;
    border-top-left-radius: .25rem;
    border-bottom-left-radius: .25rem;
    padding: .5rem .75rem;
    cursor: pointer;
}
.dataTables_paginate .current {
    z-index: 1;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: .5rem .75rem;
    cursor: pointer;
}
.paginate_button  {
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    cursor: pointer;
}
.dataTables_paginate .next {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    cursor: pointer;
} 
.content {
    padding-top: 15px;
    padding-left: 11px;
    padding-right: 10px;
}
.heading_til {
        background: #fff;
    padding: 10px;
     /*width: 99%; */
    margin-top: 10px;
    text-align: center;
    /*margin-bottom: 10px;*/
}
.heading_til h2 {
    margin: 0 !important;
}
div.dataTables_wrapper div.dataTables_filter input {
    border: 1px solid #dee2e6;
    border-radius: 4px;
}
#table_1_filter , #table_2_filter {
    margin-top: -14px;
    margin-top: -31px;
}
.dt-buttons {
    margin-top: 12px;
}
.dt-buttons  button {
   padding: 3px 15px;
    background: #3c8dbc;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
}
.media-body h3 , .media-body p {
    color: #000 !important;
}
.up_label {
    color: #4b646f;
    background: #1a2226;
    padding: 10px 25px 10px 15px;
    font-size: 12px;
}
.brand-image {
    float: none;
}
.main_header_text {
        width: 100%;
    text-align: center;
    font-size: 20px;
    font-weight: 600;

}
/*.main_header_text a {*/
/*    color: #000 !important;*/
/*}*/
#report_notifications .dropdown-item i  {
    color: #000 !important;
}
#report_notifications .dropdown-item i:before  {
    margin-left: 10px;
}
  </style>


<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">-->
      <!--  <a href="index3.html" class="nav-link">Home</a>-->
      <!--</li>-->
<!--      <li class="nav-item d-none d-sm-inline-block">-->
<!--        <a href="#" class="nav-link">THE COVID-19 SYMPTOMS MONITORING CENTER-->
<!--</a>-->
{{--      </li>--}}
    </ul>

<div class="main_header_text">
<a href="#">THE COVID-19 SYMPTOMS MONITORING CENTER
</a>

</div>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">-->
    <!--  <div class="input-group input-group-sm">-->
    <!--    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
    <!--    <div class="input-group-append">-->
    <!--      <button class="btn btn-navbar" type="submit">-->
    <!--        <i class="fa fa-search"></i>-->
    <!--      </button>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</form>-->
    
    @php $new_msg_count = $new_msg_count = DB::table('message')->groupBy('conversation_id')->where('seen', '=', 0)->where('receiver_id', '=', 1)->get();  @endphp

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id="total_count_msg"></span>
        </a>
        <!--<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height: 351px;overflow: scroll;">-->
          
          
          
          
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item right_menu">-->
            <!-- Message Start -->
        <!--    <div class="media">-->
              
        <!--      <div class="media-body">-->
        <!--        <h3 class="dropdown-item-title">-->
        <!--          John Pierce-->
        <!--          <span class="float-right text-sm text-muted"></span>-->
        <!--        </h3>-->
                
        <!--        <p class="text-sm text-muted"></p>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- Message End -->
        <!--  </a>-->
        <!--  <a href="#" class="dropdown-item right_menu">-->
            <!-- Message Start -->
        <!--    <div class="media">-->
              
        <!--      <div class="media-body">-->
        <!--        <h3 class="dropdown-item-title">-->
        <!--          John Pierce-->
        <!--          <span class="float-right text-sm text-muted"></span>-->
        <!--        </h3>-->
                
        <!--        <p class="text-sm text-muted"></p>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- Message End -->
        <!--  </a>-->
        <!--  <a href="#" class="dropdown-item right_menu">-->
            <!-- Message Start -->
        <!--    <div class="media">-->
              
        <!--      <div class="media-body">-->
        <!--        <h3 class="dropdown-item-title">-->
        <!--          John Pierce-->
        <!--          <span class="float-right text-sm text-muted"></span>-->
        <!--        </h3>-->
                
        <!--        <p class="text-sm text-muted"></p>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- Message End -->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item right_menu">-->
            <!-- Message Start -->
        <!--    <div class="media">-->
              
        <!--      <div class="media-body">-->
        <!--        <h3 class="dropdown-item-title">-->
        <!--          Nora Silvester-->
        <!--          <span class="float-right text-sm text-warning"></span>-->
        <!--        </h3>-->
              
        <!--        <p class="text-sm text-muted"></p>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- Message End -->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
        <!--</div>-->
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height: 239px;overflow-y: scroll;">
        @php $get_msg = $new_msg_count = DB::table('message')->groupBy('conversation_id')->where('seen', '=', 0)->where('receiver_id', '=', 1)->orderBy('id','DESC')->get();  @endphp
            
            @foreach($get_msg as $get_msgs)
            @php $user=DB::table('users')->where('id',$get_msgs->sender_id)->first(); @endphp
          <a href="#" class="dropdown-item my_msg" >
            <!-- Message Start -->
            <input type="hidden" class="converstion_id" value="" >
            <div class="media">
                
              <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle msg_user_img">
              
              <div class="media-body">
                <h3 class="dropdown-item-title user_name">
                
                  <span class="float-right text-sm text-danger"><i class="fa fa-circle" style="color: green;"></i></span>
                </h3>
                <p class="text-sm get_msg"></p>
                <p class="text-sm text-muted" style="white-space: nowrap;"><i class="fa fa-clock-o mr-1 msg_time"></i></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
         
          
          
          <!--<a href="#" class="dropdown-item dropdown-footer" style="color: #000 !important;">See All Messages</a>-->
        </div>
      </li>
      
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell" onclick="reset()"></i>
          <span class="badge badge-warning navbar-badge" id="notification_count"></span>
        </a>
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div id="report_notifications" style="color: #000 !important;">
                
            </div>
            <a href="{{ url('/admin/all_report_logs') }}" class="dropdown-item dropdown-footer" style="color: #000 !important;">See All Logs</a>
        </div>
        
      </li>
      
      <script>
            notification_count();
         //   get_reports();
            function notification_count(){
                var notification_count = "<?php echo isset(\App\Report_Notifications::first()->notification_count)?\App\Report_Notifications::first()->notification_count:"" ?>";
                $("#notification_count").text(notification_count);
            }
            setInterval(function(){ 
                notification_count();
           //     get_reports();
            }, 1000);
            
            function get_reports(){
                $("#report_notifications").empty();
                var notification_count = "<?php echo isset(\App\Report_Notifications::first()->notification_count)?\App\Report_Notifications::first()->notification_count:"" ?>";
                var report_ids = "<?php echo isset(\App\Report_Notifications::first()->report_ids)?\App\Report_Notifications::first()->report_ids:"" ?>";
                if(report_ids.length > 0){
                    $.each(report_ids, function(key, value){
                        setCookie('value', value, 1);

                        var report_type = "<?php echo strtoupper(isset(\App\Reports::where('id', $_COOKIE['value'] )->first()->report_type)?\App\Reports::where('id', $_COOKIE['value'] )->first()->report_type:""); ?>";
                        var time = "<?php echo isset(\App\Reports::where('id', $_COOKIE['value'] )->first()->created_at)?\App\Reports::where('id', $_COOKIE['value'] )->first()->created_at:"" ?>";
                        
                        var createdDate = new Date(time);
                        var date = createdDate.toLocaleDateString();
                        
                        var day = createdDate.getDate();
                        var month = createdDate.getMonth() + 1; //months are zero based
                        var year = createdDate.getFullYear();
                        
                        var time = createdDate.toLocaleTimeString().replace(/(.*)\D\d+/, '$1');
                        
                        $("#report_notifications").append(
                            `<div class="dropdown-divider"></div>
                              <a href="#" class="dropdown-item">
                                <i class="fa fa-envelope mr-2">`+report_type+`</i>
                                <span class="float-right text-muted text-sm">`+day + '-' + month + '-' + year + ' ' + time+`</span>
                              </a>
                             <div class="dropdown-divider"></div>`
                        );
                    });
                }
            }
            
            function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            function reset(){
                setTimeout(function(){ 
                    <?php 
                        $res = \App\Report_Notifications::first();
                        if(isset($res)){
                          $res->notification_count = 0;
                          $res->report_ids = json_encode(array());
                          $res->save();
                        }

                    ?>;
                }, 3000);
                $("#notification_count").text(0);
            }
      </script>
      
      
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">-->
      <!--    <i class="fa fa-th-large"></i>-->
      <!--  </a>-->
      <!--</li>-->
      
      <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link" style="display: flex;">
                  <i class="fa fa-sign-out" style="margin-top: 6px;"></i>
                  <p>Logout</p>
                </a>
              </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

    <div class="chatbox-holder" style="display: none;">
  <div class="chatbox">
    <div class="chatbox-top">
      <!--<div class="chatbox-avatar">-->
      <!--  <a target="_blank" href="#"><img src=""></a> -->
      <!--</div>-->
      <div class="chat-partner-name">
        <!--<span class="status online"></span>-->
        <a id="user_name" href="javascript:void(0)"></a>
      </div>
      <div class="chatbox-icons">
         <!--<a href="javascript:void(0);"><i class="fa fa-minus"></i></a> -->
        <a href="javascript:void(0);"><i class="fa fa-close"></i></a>       
      </div>      
    </div>
    
    <input type="hidden" name="admin_id" id="admin_id" value="{{Session::get('admin_id')}}" >
    <div class="chat-messages">
   
         
    </div>
       
    
    <div class="chat-input-holder">
        <form id="reg_form" class="modal-content" action="{{ url('sending_msg')}}" method="post">
            <input type="hidden" name="admin_ids" id="admin_ids" value="{{Session::get('admin_id')}}" >
        <input type="hidden" name="my_converstion" id="my_converstion" value=""  >
      <textarea class="chat-input" name="msgs" id="msg_textare" required></textarea>
      <!--<input type="text" value="Send" class="message-send">-->
      <button class="message-send">Send</button>
      </form>
    </div>

  </div>
</div>
          
          

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link" style="text-align: center;
    padding-left: 0;">
      <img src="{{ asset('assets/dist/img/logo.png') }}" alt="Corona" class="brand-image elevation-3"
           style="opacity: .8">
      <!--<span class="brand-text font-weight-light">Corona Virus</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info" style="    margin-top: -6px;">
          <a href="#" class="d-block">Super Admin</a>
          <a href="#" style=" font-size: 11px;"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="header up_label">MAIN NAVIGATION</li>
                <li class="nav-item">
            <a href="{{ url('/')}}"  class="nav-link {{ Request::segment(1) == 'dashboard'? 'active':'' }}">
            <i class="fa fa-tachometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>   

            <li class="nav-item">
              <a href="{{ url('admin/users')}}"  class="nav-link {{ Request::segment(2) == 'users'? 'active':'' }}">
              <i class="fa fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/collect')}}"  class="nav-link {{ Request::segment(2) == 'collect'? 'active':'' }}">
              <i class="fa fa-users"></i>
                <p>
                  Collection Center
                </p>
              </a>
            </li>
          
{{--           <li class="nav-item">--}}
{{--            <a href="{{ url('admin/all_msg')}}"  class="nav-link {{ Request::segment(2) == 'all_msg'? 'active':'' }}">--}}
{{--            <i class="fa fa-envelope"></i>--}}
{{--              <p>--}}
{{--                All Messages--}}
{{--              </p>--}}
{{--            </a>--}}
{{--          </li>--}}
          
          <!--<li class="nav-item">-->
          <!--  <a href="{{ url('admin/check_ins')}}"  class="nav-link">-->
          <!--  <i class="fa fa-users"></i>-->
          <!--    <p>-->
          <!--      Check Ins-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item">
           <a href="{{ url('admin/enforcement')}}"  class="nav-link">
           <i class="fa fa-users"></i>
           <p>
            Enforcement
           </p>
           </a>
         </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Tracing
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ url('admin/tracing')}}"  class="nav-link">
                  <i class="fa"></i>
                  <p>
                    Tracing Government
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/tracing_passenger')}}"  class="nav-link">
                  <i class="fa"></i>
                  <p>
                    Tracing Passenger
                  </p>
                </a>
              </li>
            </ul>
          </li>




          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>
                CHV
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('admin/chv')}}"  class="nav-link">
                  <i class="fa"></i>
                  <p>
                    HOUSEHOLD VISIT
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/chv_mother')}}"  class="nav-link">
                  <i class="fa"></i>
                  <p>
                    PREGNANT MOTHER
                  </p>
                </a>
              </li>
            </ul>
          </li>
         <li class="nav-item">
            <a href="{{ url('admin/gbv')}}"  class="nav-link">
              <i class="fa fa-users"></i>
              <p>
                GBV
              </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-files-o"></i>
              <p>
                Logs
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;"> -->
              <li class="nav-item">
                <!--<a href="{{ url('admin/report_logs')}}" class="nav-link {{ Request::segment(2) == 'report_logs'? 'active':'' }}">-->
                <!--  <i class="fa fa-file nav-icon"></i>-->
                <!--  <p>Report Logs</p>-->
                <!--</a>-->
                  <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Report Logs
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item" style="    padding-left: 30px !important;">
                <a href="{{ url('admin/all_report_logs')}}" class="nav-link {{ Request::segment(2) == 'all_report_logs'? 'active':'' }}">
                  <i class="fa fa-ban nav-icon"></i>
                  <p>All Reports</p>
                </a>
              </li>
              <li class="nav-item" style="    padding-left: 30px !important;">
                <a href="{{ url('admin/self_report_logs')}}" class="nav-link {{ Request::segment(2) == 'self_report_logs'? 'active':'' }}">
                  <i class="fa fa-ban nav-icon"></i>
                  <p>Self Reports</p>
                </a>
              </li>
              <li class="nav-item" style="    padding-left: 30px !important;">
                <a href="{{ url('admin/third_party_report_logs')}}" class="nav-link {{ Request::segment(2) == 'third_party_report_logs'? 'active':'' }}">
                  <i class="fa fa-file-text nav-icon"></i>
                  <p>Third Party Reports</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="./index3.html" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Dashboard v3</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>

              <!--<li class="nav-item">-->
              <!--  <a href="{{ url('admin/check_in_logs')}}" class="nav-link {{ Request::segment(2) == 'check_in_logs'? 'active':'' }}">-->
              <!--    <i class="fa fa-file-code-o nav-icon"></i>-->
              <!--    <p>Check In Logs</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="./index3.html" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Dashboard v3</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Check In Logs
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item" style="    padding-left: 30px !important;">
                <a href="{{ url('admin/check_in_logs')}}" class="nav-link {{ Request::segment(2) == 'check_in_logs'? 'active':'' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Listing</p>
                </a>
              </li>
              <li class="nav-item" style="    padding-left: 30px !important;">
                <a href="{{ url('admin/check_ins_on_map')}}" class="nav-link {{ Request::segment(2) == 'check_ins_on_map'? 'active':'' }}">
                  <i class="fa fa-map-marker nav-icon"></i>
                  <p>Map</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="./index3.html" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Dashboard v3</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>
            <!-- </ul> -->
          </li>
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="{{ url('admin/report_logs')}}"  class="nav-link">-->
          <!--  <i class="fa fa-users"></i>-->
          <!--    <p>-->
          <!--      Report Logs-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="nav-item">-->
          <!--  <a href="{{ url('admin/check_in_logs')}}"  class="nav-link">-->
          <!--  <i class="fa fa-users"></i>-->
          <!--    <p>-->
          <!--      Check In Logs-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          
          
          <!-- <li class="nav-item">-->
          <!--  <a href="{{ url('admin/news')}}"  class="nav-link {{ Request::segment(2) == 'news'? 'active':'' }}">-->
          <!--  <i class="fa fa-newspaper-o"></i>-->
          <!--    <p>-->
          <!--      News-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
        <li class="nav-item">
            <a href="{{ url('admin/information')}}"  class="nav-link {{ Request::segment(2) == 'information'? 'active':'' }}">
            <i class="fa fa-info"></i>
              <p>
                Information Center
              </p>
            </a>
          </li>
          
          <!--<li class="nav-item">-->
          <!--  <a href="{{ url('admin/trend')}}"  class="nav-link {{ Request::segment(2) == 'trend'? 'active':'' }}">-->
          <!--  <i class="fa fa-info"></i>-->
          <!--    <p>-->
          <!--      Trend-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          
{{--          <li class="nav-item">--}}
{{--            <a href="{{ url('admin/settings')}}"  class="nav-link {{ Request::segment(2) == 'settings'? 'active':'' }}">--}}
{{--            <i class="fa fa-cog"></i>--}}
{{--              <p>--}}
{{--                Settings--}}
{{--              </p>--}}
{{--            </a>--}}
{{--          </li>--}}
          
          <!--     <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="fa fa-envelope"></i>-->
          <!--        <p>Canned Messages</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--  </ul>-->
          <!--</li>-->
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

	<script>
	$(function(){
			setInterval(function(){
			    
		          $.ajax({
		              headers: {
						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
					},  
		            url:"{{url('total_msg_count')}}",
		            type:"POST",
		            success:function(data){
		               $('#total_count_msg').text(""); 
		             $('#total_count_msg').text(data.data);
		             $.each(data.get_msg, function(i,msg){
		                 
		                 $('.converstion_id').val(msg.conversation_id); 
		                 $('.get_msg').text(msg.msg);
		                 $('.user_name').text(msg.user_name);
		                 dt1 = new Date(msg.created_at);
                        dt2 = new Date(data.now);
                        // var time = diff_minutes(dt1, dt2)
                         var minsDiff = Math.floor((dt2.getTime() - dt1.getTime()) / 1000 / 60);
                            var hoursDiff = Math.floor(minsDiff / 60);
                            minsDiff = minsDiff % 60;
                         $('.msg_time').text(hoursDiff + 'h' + minsDiff + 'min ago');
                        
		                 if(msg.user_image==null || msg.user_image==""){
		                 var url='not_found.jpg';
		                 var full_url= '{{url("/profile_image")}}/'+url;
		                 $('.msg_user_img').attr({ "src": full_url });
		                 }else{
		                  var full_url= '{{url("/profile_image")}}/'+msg.user_image;
		                 $('.msg_user_img').attr({ "src": full_url });
		                 }
		                 
		            });
		            }
		          });
       		},10000);

});

function diff_minutes(dt2, dt1) 
 {

  var diff =(dt2.getTime() - dt1.getTime()) / 1000;
  diff /= 60;
  return Math.abs(Math.round(diff));
  
 }
	
	
	
	
    $('.my_msg').click(function(){
        var convstion_id = $(this).find('.converstion_id').val();
        var adminId = $('#admin_id').val();
        $.ajax( {
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
					},
					url: '<?php echo url("send_msg"); ?>',
					data: {id:convstion_id, admin_id:adminId},
					success: function ( msg ) {
					  
					    $('#my_converstion').val(msg.converstion_id);
					   $('#user_name').text(msg.user.first_name);
					   $('.message-box-holder').remove();
					    var admin_id = $('#admin_id').val();
					    $.each(msg.msg, function(i,msg){
					        if(msg.sender_id == admin_id){
								var html='<div class="message-box-holder">\
										<div class="message-box">' + msg.msg + '</div>\
										</div>';
							}else{
							    var html='<div class="message-box-holder">\
										<div class="message-box message-partner">' + msg.msg + '</div>\
										</div>';
							}
									
					        $('.chat-messages').append(html);
					        $('.chatbox').show();
					    });
						
					}
				} );
    });	
    
     $(document).on('submit','#reg_form',function(e){
    e.preventDefault();
         $.ajax({
      headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
      type:'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(msg){
             $("#msg_textare").val("")
          	var html='<div class="message-box-holder">\
										<div class="message-box">' + msg.data.msg + '</div>\
										</div>';
			$('.chat-messages').append(html);
          
      }
      });
     });
    
    
    	            $(document).ready(function(){
                      $(".nav-link").click(function(){
                        $(this).addClass("active");
                      });
                    });
	
		$(function(){
                  $('.fa-minus').click(function(){    $(this).closest('.chatbox').toggleClass('chatbox-min');
                  });
                  $('.fa-close').click(function(){
                    $(this).closest('.chatbox').hide();
                  });
                });

    $(document).ready(function() {
      $('.media').click(function(){
        $('.chatbox-holder').css('display', 'flex');
      });
    });

	</script>
l
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
      
      
    @yield('content')

  <!-- /.content-wrapper -->