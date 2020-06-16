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
							<th>Title</th>
                            <th>Name of person visited</th>
                            <th>Age of person visited</th>
							<th>ID Number</th>
							<th>Registered for NHIF</th>
							<th>Village</th>
                            <th>Ward</th>
                            <th>Name of nearest Health facility</th>
                            <th>Do you have face masks?</th>
                            <th>Provide any pre-existing condition</th>
                            <th>Malnutrition</th>
                            <th>Diabetes</th>
                            <th>Hypertension</th>
                            <th>Do you have TB or Asthma?</th>
                            <th>Indicate any form of disability</th>
                            <th>Remarks</th>
                            <th>Submit Time</th>
                        </tr>
					</thead>
					<tbody>
						@foreach($all_check_ins as $key => $log)
						<tr>
							<td><a href="{{ url('/admin/check_in_details/'. $log->id) }}">{{ $key + 1 }}</a></td>
                            <td>{{ $log->title }}</td>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->age }}</td>
							<td>{{ $log->id_num }}</td>
							<td>{{ $log->nhif }}</td>
							<td>{{ $log->village }}</td>
                            <td>{{ $log->ward }}</td>
                            <td>{{ $log->nearname }}</td>
                            <td>{{ $log->mask }}</td>
                            <td>{{ $log->provide }}</td>
                            <td>{{ $log->mal }}</td>
                            <td>{{ $log->diabet }}</td>
                            <td>{{ $log->hyper }}</td>
                            <td>{{ $log->tb }}</td>
                            <td>{{ $log->indicate }}</td>
                            <td>{{ $log->remark }}</td>
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
