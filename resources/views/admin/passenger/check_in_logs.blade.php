@include('layouts.header')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"/></script> -->
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
                <div style="position: absolute; right: 300px; top: 115px;">
                    From <input type='date' id='startdate' value="{{date('yy-m-d')}}">
                     To <input type='date' id='enddate' value="{{date('yy-m-d', strtotime('+1 day'))}}">
                </div>
                
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" id="table_1">
					<thead class="back_blue">
						<tr>
							<th>#</th>
                            <th>Name</th>
                            <th>Temp Reading</th>
                            <th>ID Number</th>
                            <th>Phone Number</th>
							<th>Vehicle number plate</th>
							<th>Seat Number</th>
							<th>FROM/village</th>
							<th>TO/village</th>
                            <th>Sub location/location/Hotel</th>
                            <th>Travel history last 14days</th>
                            <th>Do you have history of:</th>
                            <th>Next of Kin Names</th>
                            <th>Next of Kin Phone number</th>
                            <th>Publish Date</th>
                            <th>Collection Name</th>
                            </tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
<script>
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    Date.prototype.isValid = function () {
        // An invalid date object returns NaN for getTime() and NaN is the only
        // object not strictly equal to itself.
        return this.getTime() === this.getTime();
    };
    // $.fn.dataTable.ext.search.push(
    //     function( settings, data, dataIndex ) {
    //         var startdate = new Date($('#startdate').val());
    //         var enddate = new Date($('#enddate').val());
    //         var pubdate = new Date(data[14]) || 0; // use data for the age column
            
    //         if (  (!startdate.isValid() &&  !enddate.isValid()) || (startdate <= pubdate && !enddate.isValid()) || (startdate < pubdate && pubdate <= enddate) || ( !startdate.isValid() && pubdate <= enddate))
    //         {
    //             return true;
    //         }
    //         return false;
    //     }
    // );
    function getInput(data, type, full, meta) {
		return '<a href="{{ url("/admin/check_in_details/") }}/'+data+'">'+ (parseInt(meta.row + meta.settings._iDisplayStart) + 1) +'</a>';
    }
    var handleRecords = function () {
        var table =  $('#table_1').DataTable({
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                destroy: true,
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "ajax": "{{url('/admin/ajax_tracing_passenger')}}?from="+$('#startdate').val()+"&to="+$('#enddate').val(),
                // ajax: function (data, callback, settings) {
				// $.ajax({
                //     url: "{{url('/admin/ajax_tracing_passenger')}}",
                //     type: 'GET',
                //     data:{
                //         from:$('#startdate').val(),
                //         to:$('#enddate').val(),
                //         search:$('#table_1_filter input').val()
                //     },
                //     dataType: 'json',
                //     success:function(data){
                //         callback(data);  
                //     }
                //     });
                // },
                "columns": [
                    { "data": "user_id", render: getInput },
                    { "data": "passenger_name" },
                    { "data": "temp" },
                    { "data": "id_num" },
                    { "data": "tel_number" },
                    { "data": "vehicle_num" },
                    { "data": "seat_num" },
                    { "data": "from_village" },
                    { "data": "to_village" },
                    { "data": "location" },
                    { "data": "history_last" },
                    { "data": "infect_str" },
                    { "data": "contact" },
                    { "data": "contact_num" },
                    { "data": "publish_date" },
                    { "data": "collection" },
                ],
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "language": {
                    "lengthMenu": " _MENU_ records"
                },
                "columnDefs": [{  // set default column settings
                    'orderable': false,
                    'targets': [-1]
                }, {
                    "searchable": false,
                    "targets": [0]
                }],
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
    }
    $(document).ready(function() {
        // console.log(new Date().toDateInputValue());
        // $('#startdate').val(new Date().toDateInputValue());
        // $('#enddate').val(new Date().toDateInputValue());        
        handleRecords();
    });
    $('#startdate, #enddate').change( function() {                
        handleRecords();            
    } );
    // $(document).on('change','#table_1_filter input', function(e) { 
    //     e.preventDefault();
    //     handleRecords();            
    // } );
    $('#table_1 tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });
</script>
@include('layouts.footer')
