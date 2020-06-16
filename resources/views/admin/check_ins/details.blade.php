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
</style>

    
    <div class="container">
        <div class="content">
            
            <div class="heading_til">
                    <h2>Check In Details</h2>
                </div>
            
             <div class="details">
            
            <div class="row">
                
               
                
                <div class="col-md-6">
               
            <div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" style="color: #367fa9;">
                      <tbody>
                        <tr>
                          <td class="left_side">Name</td>
                          <td class="right_side">{{isset($details['first_name'])?strtoupper($details['first_name']):""}} {{isset($details['first_name'])?strtoupper($details['first_name']):""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Age</td>
                          <td class="right_side">{{isset($details['age'])?$details['age']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Location</td>
                          <td class="right_side">{{isset($details['state'])?$details['state']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">People</td>
                          <td class="right_side">{{isset($details['people'])?$details['people']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Facility</td>
                          <td class="right_side">{{isset($details['utilities'])?$details['utilities']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Time</td>
                          <td class="right_side">{{isset($details['time'])?$details['time']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Location of Check In</td>
                          <td class="right_side">{{isset($details['location'])?$details['location']:""}}</td>
                        </tr>
                        <tr>
                          <td class="left_side">Check In Time</td>
                          <td class="right_side">{{ date("d/m/Y H:i:s", strtotime(isset($details['check_in_time'])?$details['check_in_time']:"")) }}</td>
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

