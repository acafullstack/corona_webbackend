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
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" id="table_1">
					<thead class="back_blue">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>People</th>
							<th>Time</th>
							<th>Facility</th>
							<th>Notes</th>
							<th>Location</th>							
							<th>Check-In Time</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($all_check_ins as $key => $log)
						<tr>
							<td><a href="{{ url('/admin/check_in_details/'. $log->id) }}">{{ $key + 1 }}</a></td>
                            @if(isset(\App\User::where('id', $log->user_id)->first()->first_name) && isset(\App\User::where('id', $log->user_id)->first()->last_name))
							    <td>{{ strtoupper(\App\User::where('id', $log->user_id)->first()->first_name) }} {{ strtoupper(\App\User::where('id', $log->user_id)->first()->last_name) }}</td>
	                        @else
                                <td></td>
                            @endif
                            <td>{{ $log->people }}</td>
							<td>{{ $log->time }}</td>
							<td>{{ $log->utilities }}</td>
							@if($log->additional_info == null)
							    <td>N/A</td>
							@else
							    <td>{{ $log->additional_info }}</td>
							@endif
							<td>{{ $log->address }}</td>
							<td>{{ date("d/m/Y H:i:s", strtotime($log->created_at)) }}</td>
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
        
        $('#table_1 tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });
    });
</script>
@include('layouts.footer')
