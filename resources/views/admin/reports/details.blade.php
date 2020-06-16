@include('layouts.header')
    
<style>
    .details {
            background: #fff !important;
            padding: 23px !important;
            border-radius: 4px !important;
            margin-top: 20px;
    }
    .up_buton button {
        padding: 3px 22px;
        background: #3c8dbc;
        color: #fff;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
        display: none;
    }
    .up_buton h2 {
        font-size: 23px;
    }
     .left_side {
        background: #fff;
        color: #000;
    }
    .right_side {
        background: #f2f2f2;
        color: #000;
    }
    .set_style {
            margin-bottom: 10px;
    }
    .set_style img {
        border-radius: 14px;
    }
</style>

    
    <div class="container">
        <div class="content">
            
            <div class="heading_til">
                    <h2>Report Details</h2>
                </div>
            
             <div class="details">
            
            <div class="row">
                
               
                
                <div class="col-md-6">
            
            <div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" style="color: #367fa9;">
                      <tbody>
       <!--                 <tr>-->
       <!--                     <div class="text-center set_style">-->
       <!--                   	@if($details['video_or_image'] == null)-->
							<!--<img src="{{ url('/report_image') }}/not_found.jpg" height="100" width="100">-->
							<!--@else-->
							<!--<img src="{{ url('/report_image') }}/{{ $details['video_or_image'] }}" height="100" width="100">-->
							<!--@endif-->
							<!--</div>-->
       <!--                 </tr>-->
                        <tr>
                          <td  class="left_side">Name</td>
                          <td class="right_side">{{strtoupper($details['first_name'])}} {{strtoupper($details['first_name'])}}</td>
                        </tr>
                        <tr>
                          <td  class="left_side">Age</td>
                          <td class="right_side">{{$details['age']}}</td>
                        </tr>
                        <tr>
                          <td  class="left_side">Report Type</td>
                          <td class="right_side">{{$details['report_type']}}</td>
                        </tr>
                        <tr>
                          <td  class="left_side">Location of Report</td>
                          <td class="right_side">{{$details['location']}}</td>
                        </tr>
                      <tr>
                          <td  class="left_side">Symptoms</td>
                          <td class="right_side" style="display: flex;padding-top: 23px;padding-bottom: 18px;flex-wrap: wrap;">
							    @foreach(explode(",", $details['symptom']) as $symptom_id)
							        <span style="margin-left: 8px;  margin-bottom: 4px;border: 1px solid;padding: 1px 4px;background: #fff;border-radius: 3px; color:{{ \App\Symptoms::where('id', $symptom_id)->first()->color_code }}">{{ \App\Symptoms::where('id', $symptom_id)->first()->symptom }}</span>
							    @endforeach
							</td>
                        </tr>
                        <tr>
                            <td class="left_side">
                                Media
                            </td>
                            <td class="right_side">
                                @if($details['video_or_image'] == null)
    							    <img src="{{ url('/report_image') }}/not_found.jpg" height="100" width="100">
    							@else
    							    <img src="{{ url('/report_image') }}/{{ $details['video_or_image'] }}" height="100" width="100">
    							@endif
                            </td>
                        </tr>
                      <tr>
                          <td  class="left_side">Notes</td>
                          <td class="right_side">{{$details['additional_info']}}</td>
                        </tr>
                      <tr>
                          <td  class="left_side">Condition</td>
                          <td class="right_side">{{$details['user_condition']}}</td>
                        </tr>
                        <tr>
                          <td  class="left_side">User State</td>
                          <td class="right_side">{{$details['state']}}</td>
                        </tr>
                        <tr>
                          <td  class="left_side">Report Time</td>
                          <td class="right_side">{{ date("d/m/Y H:i:s", strtotime($details['report_time'])) }}</td>
                        </tr>
                      </tbody>
                    </table>
			</div>
			</div>
			
			   <div class="col-md-6">
			        <div style="width: 100%;">
			           </div>
            
	    {!! Mapper::render() !!}
    </div> 
			        </div>
			        
			        </div>
			        
                </div>
        </div>
        
        
       
    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/dist/js/pages/dashboard3.js"></script>
</script>
@include('layouts.footer')

