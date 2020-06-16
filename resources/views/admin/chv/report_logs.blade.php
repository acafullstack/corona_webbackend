@include('layouts.header')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"/></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"/></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"/></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"/></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"/></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"/></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"/></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"/></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"/></script>
    
        
        <style>
            .heading_til h2 {
                text-align: center;
            }
            .main-footer {
                margin-left: 0 !important;
            }
             .cust_table {
                background: white;
                white-space: nowrap;
            }
        </style>


        <div class="container">
            <div class="content">
                
                <div class="heading_til">
                    <h2>Self Report</h2>
                </div>
                
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" id="table_1">
					<thead class="back_blue">
						<tr>
							<th>#</th>
							<th>User</th>
							<th>Image / Video</th>
							<th>Report Type</th>
							<th>Symptoms</th>
							<th>Info</th>
							<th>City</th>							
							<th>State</th>							
							<th>Country</th>							
							<th>Time</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($self_report_logs as $key => $log)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ \App\User::where('id', $log->user_id)->first()->first_name }} {{ \App\User::where('id', $log->user_id)->first()->last_name }}</td>
							@if($log->video_or_image == NULL)
							<td><img src="{{ url('/report_image') }}/not_found.jpg" height="42" width="42"></td>
							@else
							<td><img src="{{ url('/report_image') }}/{{ $log->video_or_image }}" height="42" width="42"></td>
							@endif
							<td>{{ $log->report_type }}</td>
							<td style="    padding-top: 23px;padding-bottom: 18px;display: flex;flex-wrap: wrap;">
							    @foreach(explode(",", $log->symptom) as $symptom_id)
							        <span style="margin-left: 8px;  margin-bottom: 4px;border: 1px solid;padding: 1px 4px;background: #fff;border-radius: 3px; color:{{ \App\Symptoms::where('id', $symptom_id)->first()->color_code }}">{{ \App\Symptoms::where('id', $symptom_id)->first()->symptom }}</span>
							    @endforeach
							</td>
							<td>{{ $log->additional_info }}</td>
							<td>{{ $log->city }}</td>
							<td>{{ $log->state }}</td>
							<td>{{ $log->country }}</td>
							<td>{{ $log->created_at }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		 <div class="heading_til">
                    <h2>Third Party Report</h2>
                </div>
		
		<div class="container">
			<div class="content">
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" id="table_2">
					<thead class="back_blue">
						<tr>
							<th>#</th>
							<th>User</th>
							<th>Image / Video</th>
							<th>Report Type</th>
							<th>First Name</th>
							<th>Second Name</th>
							<th>Symptoms</th>
							<th>Info</th>
							<th>City</th>							
							<th>State</th>							
							<th>Country</th>							
							<th>Time</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($third_party_report_logs as $key => $log)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ \App\User::where('id', $log->user_id)->first()->first_name }} {{ \App\User::where('id', $log->user_id)->first()->last_name }}</td>
							@if($log->video_or_image == NULL)
							<td><img src="{{ url('/report_image') }}/not_found.jpg" height="42" width="42"></td>
							@else
							<td><img src="{{ url('/report_image') }}/{{ $log->video_or_image }}" height="42" width="42"></td>
							@endif
							<td>{{ $log->report_type }}</td>
							<td>{{ $log->first_name }}</td>
							<td>{{ $log->second_name }}</td>
							<td style="    padding-top: 23px;padding-bottom: 18px;display: flex;flex-wrap: wrap;">
							    @foreach(explode(",", $log->symptom) as $symptom_id)
							        <span style="margin-left: 8px;  margin-bottom: 4px;border: 1px solid;padding: 1px 4px;background: #fff;border-radius: 3px; color:{{ \App\Symptoms::where('id', $symptom_id)->first()->color_code }}">{{ \App\Symptoms::where('id', $symptom_id)->first()->symptom }}</span>
							    @endforeach
							</td>
							<td>{{ $log->additional_info }}</td>
							<td>{{ $log->city }}</td>
							<td>{{ $log->state }}</td>
							<td>{{ $log->country }}</td>
							<td>{{ $log->created_at }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
        </div>
<script>
    $(document).ready(function() {
        $('#table_1').DataTable({
            dom: 'Bfrtip',
            "pageLength": 15,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        $('#table_2').DataTable({
            dom: 'Bfrtip',
            "pageLength": 15,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
@include('layouts.footer')
