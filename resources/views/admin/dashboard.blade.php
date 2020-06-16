@include('layouts.header')
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" />-->
            <style>
                /*.small-box-footer {*/
                    
                /*}*/
                .icon img  {
                     width: 45px;
                }
                .small-box  p {
                    margin: 0 !important;
                }
                .cust_ul_buttons a {
                        background: #17a2b8;
                        color: #fff;
                        padding: 7px 16px;
                        border-radius: 4px;
                }
                .cust_ul_buttons  {
                        padding-bottom: 11px;
                        /*justify-content: center !important;*/
                        padding-top: 14px;
                        border-top: 2px solid #17a2b8;
                        margin-left: 10px;
                }
                .Cust_mine {
                    width: 12%;
                    margin-left: .5%;
                }
                .small-box .icon {
                        top: -41px !important;
                }
                #iw_container  {
                    text-align: center !important;
                        width: 235px;
                            height: 210px;
                }
                #iw_container img  {
                    width: 100px !important;
                    height: 100px !important;
                    border-radius: 50% !important;
                    margin-bottom: 10px;
                }
                #iw_container .iw_title {
                   font-size: 14px;
                }
                #iw_container .iw_title b  {
                   font-size: 19px !important;
                   color: #367fa9;
                }
                
                
                
            </style>



<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row" style=" margin-bottom: 6px;margin-top: 6px;border: 2px solid #367fa9;">
        @foreach($count_array as $key => $count)
        <div class="Cust_mine">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$count['count']}}</h3>

              <p>{{strtoupper($key)}}</p>
            </div>
            <div class="icon">
                <img src="{{url('/images')}}/{{$key}}.png" alt="">
              <!--<i class="ion ion-pie-graph" style=" color: {{$count['color']}};"></i>-->
            </div>
            <a href="{{url('/admin/symptom_related_report_logs')}}/{{$key}}" class="small-box-footer" style="background: {{$count['color']}};">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</section>
    
<!--<ul class="nav nav-tabs cust_ul_buttons">-->
<!--    <a href="{{url('/dashboard/check_ins')}}">Check Ins</a>-->
<!--    <a href="{{url('/dashboard/reports')}}" style="margin-left: 10px;">Reports</a>-->
<!--</ul>-->
<!--<div class="md-form">-->
<!--  <input placeholder="Selected date" type="text" id="date-picker-example" class="form-control datepicker">-->
<!--  <label for="date-picker-example">Try me...</label>-->
<!--</div>-->
<div style="width: 99.8%; height: 650px;margin-left: 2px;border: 2px solid #367fa9;">
	{!! Mapper::render() !!}
</div>
<!--// <script>
// $(document).ready(function() {
//     $('.datepicker').pickadate();
// });
// </script>-->
<script src="{{ asset('/assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('/assets/dist/js/pages/dashboard3.js')}}"></script>

@include('layouts.footer')
