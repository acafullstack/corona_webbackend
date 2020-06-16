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
             .cust_table {
                background: white;
                white-space: nowrap;
            }
        </style>
    
    
    
        <div class="container">
            <div class="content">
                <div class="heading_til">
                    <h2>All Users</h2>
                    @if ($success == "success")
                    <div class="alert alert-success" >
                        reset success
                    </div>
                    @endif
                     @if (session('success'))
                    <div class="alert alert-success" >
                    {{ session('success') }}
                    </div>
                    @endif
                </div>

				<form class="form-horizontal" method="POST" action="{{url('send_all_msg')}}" enctype="multipart/form-data">
				@csrf
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" style="vertical-align:middle;" id="table_1">
                    <col>
                    <colgroup span="1"></colgroup>
                    <tr>
                        <td rowspan="2" style="vertical-align:middle;" align="center">#</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;">Profile</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;">Name</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;">Gender</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;">Age</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;">Email</td>
                        <td align="center" colspan="5" width="400" scope="colgroup" style="vertical-align:middle;">Edit Level</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;width:200px;">Created At</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;width:200px;">Location</td>
                        <td align="center" rowspan="2" style="vertical-align:middle;width:200px;">Reset Password</td>
                    </tr>
                    <tr>
                        <th scope="col" style="vertical-align:middle;text-align:center;">Enforcement</th>
                        <th scope="col" style="vertical-align:middle;text-align:center;">Tracing government offices</th>
                        <th scope="col" style="vertical-align:middle;text-align:center;">Tracing border</th>
                        <th scope="col" style="vertical-align:middle;text-align:center;">GBV</th>
                        <th scope="col" style="vertical-align:middle;text-align:center;">CHV</th>
                    </tr>
                @foreach($users as $key => $row)
                    <tr>
                        <th  style="vertical-align:middle;" scope="row"><input type="checkbox" class="accepted" name="ids[]" value={{$row->id}}></th>
                        @if($row->profile_image == NULL)
                        <td style="vertical-align:middle;" align="center"><img src="{{ url('/profile_image') }}/not_found.jpg" height="42" width="42"></td>
                                @else
                            <td style="vertical-align:middle;" align="center"><img src="{{ url('/profile_image') }}/{{ $row->profile_image }}" height="42" width="42"></td>
                                @endif
                            <td style="vertical-align:middle;" align="center">{{ strtoupper($row->first_name) }} {{ strtoupper($row->last_name) }}</td>
                            <td style="vertical-align:middle;" align="center">{{ strtoupper($row->gender) }}</td>
                            <td style="vertical-align:middle;" align="center">{{ $row->age }}</td>
                            <td style="vertical-align:middle;" align="center">{{ strtolower($row->email) }}</td>
                            <td style="vertical-align:middle;" align="center"><input {{ $row->enforce_level == 1 ? 'checked' : '' }} type="checkbox" class="levelaccepted1"  value={{$row->id}}></td>
                            <td style="vertical-align:middle;" align="center"><input {{ $row->gover_level == 1 ? 'checked' : '' }} type="checkbox" class="levelaccepted2"  value={{$row->id}}></td>
                            <td style="vertical-align:middle;" align="center"><input {{ $row->border_level == 1 ? 'checked' : '' }} type="checkbox" class="levelaccepted3"  value={{$row->id}}></td>
                            <td style="vertical-align:middle;" align="center"><input {{ $row->gbv_level == 1 ? 'checked' : '' }} type="checkbox" class="levelaccepted4"  value={{$row->id}}></td>
                            <td style="vertical-align:middle;" align="center"><input {{ $row->chv_level == 1 ? 'checked' : '' }} type="checkbox" class="levelaccepted5"  value={{$row->id}}></td>
                            <td  style="vertical-align:middle;" align="center">{{ $row->created_at }}</td>
                            <td>{{ strtoupper($row->state) }}</td>
                            <td><a class="basicreset" data-id="{{ $row->id }}" data-toggle="modal"><i class="fa fa-exchange" data-toggle="tooltip" title="Reset"></i></a></td>
                    </tr>
                @endforeach
				</table>

			</div>
			</form>
            </div>
            </div>
            <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Reset Password</h4>
                        </div>
                        <form id="resetform" class="modal-content" action="{{ url('resetpwd')}}" method="post">
                            @csrf
                        <div class="modal-body row">
                            <input type='hidden' name='userid' id='userid'>
                            <div class="col-md-6">Password : <input type='password' name='resetpwd' id='resetpwd'></div>
                            <div class="col-md-6">Confirm : <input type='password' id='rresetpwd'></div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            <button id='resetbtn' type="button" class="btn blue">Save changes</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
                'pdfHtml5',
            ]
        });
    });

    $('.basicreset').click(function(){
        $('#userid').val($(this).data('id'));
        $('#basic').modal('show');
    });
    $('#resetbtn').click(function(){
        if($('#resetpwd').val() != $('#rresetpwd').val()){
            alert('Please Again')
        }else{
            $('#resetform').submit();
        }
    });

    $('.levelaccepted1').change(function () {
        var checked = $(this).is(':checked');
        var id = $(this).val();
        if(checked){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/setlevel',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Enforcement editer level is setted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/unsetlevel',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Enforce editer level is unsetted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }


    });

    $('.levelaccepted2').change(function () {
        var checked = $(this).is(':checked');
        var id = $(this).val();
        if(checked){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/setlevel2',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Tracing government editer level is setted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/unsetlevel2',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Tracing government editer level is unsetted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }


    });

    $('.levelaccepted3').change(function () {
        var checked = $(this).is(':checked');
        var id = $(this).val();
        if(checked){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/setlevel3',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Tracing border editer level is setted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/unsetlevel3',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('Tracing border editer level is unsetted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }


    });

    $('.levelaccepted4').change(function () {
        var checked = $(this).is(':checked');
        var id = $(this).val();
        if(checked){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/setlevel4',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('GBV editer level is setted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/unsetlevel4',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('GBV editer level is unsetted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }


    });
    $('.levelaccepted5').change(function () {
        var checked = $(this).is(':checked');
        var id = $(this).val();
        if(checked){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/setlevel5',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('CHV editer level is setted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: './users/unsetlevel5',
                type: "post",
                data: {user_id:id,flag:checked},
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    alert('CHV editer level is unsetted');

                },
                error: function (response) {
                    alert('Error' + response);
                }
            });
        }


    });

</script>

@include('layouts.footer')
