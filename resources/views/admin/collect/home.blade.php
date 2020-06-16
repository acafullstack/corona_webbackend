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
                    @if ($success == "success")
                    <div class="alert alert-success" >
                        success
                    </div>
                    @endif
                <div class="table-responsive">
                <button href="#addcollection" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus-circle"></i> <span>  Add Collection</span></button>
				<table class="table dataTable table-hover cust_table" id="table_1">
					<thead class="back_blue">
						<tr>
							<th>#</th>
                            <th>Name</th>
                            <th style="width: 6%;">Actions</th>
                            </tr>
					</thead>
					<tbody>
                        @if(count($collect) != 0)
						@foreach($collect as $key => $log)
						<tr>
							<td>{{ $key + 1 }}</td>
                            <td>{{ $log->collection_name }}</td>
                            <td>
                                <a class="editcollection" data-id="{{ $log->id }}" data-toggle="modal"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                <a class="deletecollection" data-id="{{ $log->id }}" data-toggle="modal"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>
                            </td>
						</tr>
                        @endforeach
                        @else
                        <tr>
							<td>No data</td>
						</tr>
                        @endif
					</tbody>
				</table>
			</div>
        </div>
        <div class="modal fade" id="addcollection" style="top:30%" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Collection Name</h4>
                    </div>
                    <form id="createcltform" class="modal-content" action="{{ url('createcollection')}}" method="post">
                        @csrf
                    <div class="modal-body row">
                        <div class="col-md-6">Collection Name : <input type='text' name='collection_name' id='collection_name'></div>                 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        <button id='createbtn' type="button" class="btn blue">Save changes</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="editcollection" style="top:30%" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Collection Name</h4>
                    </div>
                    <form id="editcltform" class="modal-content" action="{{ url('editcollection')}}" method="post">
                        @csrf
                    <div class="modal-body row">
                        <input type='hidden' name='collection_id' id='collection_id'>
                        <div class="col-md-6">Collection Name : <input type='text' name='collection_name' id='edit_collection_name'></div>                 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        <button id='editbtn' type="button" class="btn blue">Save changes</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="delcollection" style="top:30%" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Delete Collection</h4>
                    </div>
                    <form id="delcltform" class="modal-content" action="{{ url('delcollection')}}" method="post">
                        @csrf
                    <div class="modal-body row">
                        <input type='hidden' name='collection_id' id='del_collection_id'>            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">No</button>
                        <button id='delbtn' type="button" class="btn blue">Yes</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
<script>
$('#createbtn').click(function(){
    $('#createcltform').submit();
});
$('.editcollection').click(function(){
    $('#collection_id').val($(this).data('id'));
    $('#edit_collection_name').val($(this).parents('tr').find('td:nth-child(2)').text());
    $('#editcollection').modal('show');
});
$('#editbtn').click(function(){
    $('#editcltform').submit();
});
$('.deletecollection').click(function(){
    $('#del_collection_id').val($(this).data('id'));
    $('#delcollection').modal('show');
});
$('#delbtn').click(function(){
    $('#delcltform').submit();
});
</script>
@include('layouts.footer')
