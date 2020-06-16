@include('layouts.header')


<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
 <script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
 
 
     
        <style>
             .cust_table {
                background: white;
                white-space: nowrap;
            }
            .dataTables_paginate {
                    height: auto !important;
                margin-top: 0 !important;
            }
        </style>
 
<div class="content-header">
     <div class="heading_til">
                    <h2>{{$info_news->title}}</h2>
                </div>
          
  <div class="container-fluid">
      <div class="add_news text-right">
       <a href="{{url('add/trend/'.$info_news->id) }}" class="btn btn-sm btn-success cust_color" style="margin: 11px;"><i class="fa fa-plus"></i> Add {{$info_news->title}}</a>
       </div>
    <div class="row mb-2">
       
        @if(Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
            @endif
        <div class="container">
            <div class="content">
                <div class="table-responsive">
				<table class="table dataTable table-hover cust_table" id="table_id" style="margin-top: 5px !important;">
					<thead class="back_blue">
						<tr>
							<th>#</th>
							<th>Media</th>
							<th>Title</th> 
							<th>Description</th>
							<th>URL</th>
							<th>Period</th>
							<th>Created At</th>
							<th width="130" class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($trends as $key => $row)
						<tr>
							<td>{{ $key + 1 }}</td>
                            @if($row->image == "")
							<td><img style="width:75px; height:60px;" src="{{url('/assets/images/news/not_found.jpg')}}"></td>
								@elseif($row->file_type=="video")
							<td>
    							<video width="75" height="60" controls>
                                    <source src="{{url('/assets/images/news/'.$row->image)}}" >
                                </video>
                            </td>
                            @else
							<td><img style="width:75px; height:60px;" src="{{url('trend_image/'.$row->image)}}"></td>
							@endif
							<td>{{$row->title}}</td>
							@php $str = substr($row->description,0,70) @endphp
							<td>{{$str}}..</td>
							<td>{{$row->url}}</td>
							<td>{{$row->period}}</td>
							<td>{{$row->created_at}}</td>
							<td class="text-center">
								<div class="actions-btns dule-btns">
									<a href="{{url('/trend/edit/'.$row->id .'/' .$info_news->id)}}" class="back_color btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
            </div>
            </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content-header -->
<section class="content">
    <div class="container-fluid"></div>
</section>	

 <script>
    
    	 $(document).ready(function() {
    $('#table_id').DataTable( {
        "order": [[ 6, "desc" ]]
    } );
} );
</script>

@include('layouts.footer')