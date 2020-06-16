@include('layouts.header')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"/></script>


    <style>
        /*.main-footer {*/
        /*    margin-left: 0 !important;*/
        /*}*/
        .content {
    padding-top: 15px !important;
    padding-left: 11px !important;
    padding-right: 10px !important;
}
#notify_length {
    margin-top: 14px;
}
#notify_filter {
    margin-top: -32px;
}
.cust_table {
    background: white;
}
    </style>


<div class="container">
<div class="content">
<div class="dashboard-left">
	<div class="courselist">
		<div class="right_col" role="main">
			<div class="">
				<div class="clearfix"></div>
				<div class="row">
					@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block col-sm-12">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<div class="col-md-12 col-sm-12 ">
						<div class="x_panel">
							<div class="x_content">
							    
							    <div class="heading_til">
                    <h2>Messages</h2>
                </div>
							    
								<!--<div class="x_title">-->
								<!--	<div class="col-sm-6 text-left">-->
								<!--		<h2>Messages</h2><br>-->
										
								<!--	</div>-->
								<!--	<div class="col-sm-6 text-right">-->
								<!--		<div class="dashboard-heading text-right">-->
								<!--		 <a href="{{ url('blog/addblog') }}" class="add-catbtn">Add Blog <i class="fa fa-plus" aria-hidden="true"></i>-->
								<!--			</a>-->
								<!--			<button class="btn btn-sm btn-success"  id="selectAll">Select All Checkbox on this Page</button>-->

								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="clearfix"></div>-->
								<!--</div>-->
								<div class="row">
									<div class="col-sm-12">
										<div class="card-box table-responsive">
											<div class="courseslist">
									
												<div class="message_shows"></div>
												<table class="table dataTable table-hover cust_table no-footer" id="notify">
													<thead>
														<tr>
															<th>Serial#</th>
															<th>Sender Name</th>
														    <th>Message</th>
														    
															<th>Created At</th>
															<th>Action</th>		
														</tr>
													</thead>
													<tbody>
													    @php $i = 1; @endphp
														@foreach ($msg as $key => $row)
														<?php $user=DB::table('users')->where('id',$row->sender_id)->first(); 
														?>
														<tr>
														    <td>{{$i}}</td>
														    @php $i++; @endphp
															@if(isset($user->user_name))
                                								<td>{{$user->user_name}}</td>
															@else
																<td></td>
															@endif
                                							<td>{{$row->msg}}</td>
                                						
                                						
                                							
                                							<td>{{$row->created_at}}</td>
                                							<td>
                                							    <a href="{{ url('admin/user_msg/'.$row->conversation_id) }}" class="actionbtn">
																	<i class="fa fa-envelope" style="font-size: 18px;" aria-hidden="true"></i>
																</a>
                                							</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>			
<script type="text/javascript">
$(document).ready( function () {
    $('#notify').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
});

</script> 
@include('layouts.footer')