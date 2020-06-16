@include('layouts.header')

    <style>
        .dataTables_paginate {
            height: auto;
            margin: 0 !important;
        }
        
        .dataTables_paginate .previous {
                 color: #6c757d; 
                 pointer-events: none; 
                 cursor: auto; 
                 background-color: #fff; 
                 border-color: #dee2e6; 
                 margin-left: 0; 
                 border-top-left-radius: 0 !important; 
                 border-bottom-left-radius: 0 !important; 
                 padding: 0 !important; 
                 cursor: pointer; 
            }
            .paginate_button {
                     padding: 0 !important; 
                     margin-left: 0 !important; 
                     line-height: 1.25 ; 
                     color: #007bff; 
                     background-color: #fff; 
                     border: 0 !important; 
                     cursor: pointer; 
                }
                .dataTables_paginate .next {
                         border-top-right-radius: 0 !important; 
                         border-bottom-right-radius: 0 !important;   
                         padding: 0 !important; 
                         margin-left: -1px; 
                         line-height: 1.25; 
                         color: #007bff; 
                         background-color: #fff; 
                         border: 0 !important; 
                         cursor: pointer; 
                    }
                    .cust_table {
                        background: white;
                    }
    </style>



        <!--<div class="flex-center position-ref full-height">-->
        <!--    @if (Route::has('login'))-->
        <!--        <div class="top-right links">-->
        <!--            @auth-->
        <!--                <a href="{{ url('/') }}">Home</a>-->
        <!--            @else-->
        <!--                <a href="{{ route('login') }}">Login</a>-->

        <!--                @if (Route::has('register'))-->
        <!--                    <a href="{{ route('register') }}">Register</a>-->
        <!--                @endif-->
        <!--            @endauth-->
        <!--        </div>-->
        <!--    @endif-->
        
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
 <script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
 
 
 
        <div class="col-sm-12 text-center">
            <h1 class="m-0 text-dark">Information Center
            
            </h1>
          </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
            @endif
        <div class="container">
            <div class="content">
                <!--<a href="{{url('add/info') }}" class="btn btn-sm btn-success pull-right cust_color" style="margin: 11px;"><i class="fa fa-plus"></i> Add Information Center</a>-->
            <!--<div class="heading_til">-->
            <!--        <h2>Information Center</h2>-->
            <!--    </div>-->
                <div class="table-responsive" style="margin-top: 10px;">
				<table class="table table-hover cust_table no-footer" id="table_id">
					<thead class="back_blue">
						<tr>
							<th>#</th>
							<th>ICon</th>
							<th>Media</th>
							<th>Title</th> 
							<th>Description</th>
							<th width="130" class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($info as $key => $row)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td><img style="width:75px; height:60px;" src="{{url('information_center_icon/'.$row->icon)}}"></td>
							@if($row->image=="")
							<td><img style="width:75px; height:60px;" src="{{url('/information_center_image/not_found.jpg')}}"></td>
							@elseif($row->file_type=="video")
							<td>
							<video width="75" height="60" controls>
                                      <source src="{{url('information_center_image/'.$row->image)}}" >
                                    
                                    </video>
                                    </td>
                            @else
							<td><img style="width:75px; height:60px;" src="{{url('information_center_image/'.$row->image)}}"></td>
							@endif
							<td>{{$row->title}}</td>
							<td>{{$row->description}}</td>
							
							<td class="text-center">
								<div class="actions-btns dule-btns">
									<a href="{{url('info/edit/'.$row->id)}}" class="back_color btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
            </div>
            </div>
    

    <script>
    
    	 $(document).ready(function() {
    $('#table_id').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/dist/js/pages/dashboard3.js"></script>
@include('layouts.footer')
