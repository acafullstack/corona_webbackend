@include('layouts.header')


    <style>
        .content {
    padding-top: 15px;
    padding-left: 11px;
    padding-right: 10px;
}
    </style>

    <!-- Content Header (Page header) -->
    <!--<div class="content-header">-->
    <!--  <div class="container-fluid">-->
    <!--    <div class="row mb-2">-->
    <!--      <div class="col-sm-6">-->
    <!--        <h1 class="m-0 text-dark">Edit News</h1>-->
    <!--      </div>-->
    <!--      <div class="col-sm-6">-->
    <!--        <ol class="breadcrumb float-sm-right">-->
    <!--          <li class="breadcrumb-item"><a href="#">Home</a></li>-->
    <!--          <li class="breadcrumb-item active">Edit News</li>-->
    <!--        </ol>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
       
      <div class="container-fluid">
        <div class="row">
             <div class="heading_til" style="width: 100%;">
                    <h2>Edit {{$info_news->title}}</h2>
                </div>
          <div class="col-md-12">
            @if(Session::has('alert'))
            <div class="alert alert-danger">
              {{ Session::get('alert') }}
            </div>
            @endif
             @if(Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
            @endif
          <form class="form-horizontal" method="POST" action="{{ url('update/trend') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="trend_id" value="{{$trends->id}}">
            <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Title</label>
            <input required id="title" value="{{$trends->title}}" type="text" placeholder="title" class="form-control" name="title">
          </div>
           <div class="form-group">
            <label for="title">URL</label>
            <input required id="url" value="{{$trends->url}}" type="text" placeholder="url" class="form-control" name="url">
          </div>
          <div class="form-group">
            <label for="title">Description</label>
            <textarea class="form-control" name="description" required> {{$trends->description}}</textarea>
          </div>
            <div class="form-group">
            <label for="title">Period</label>
            <input required id="url" value="{{$trends->period}}" type="date" placeholder="Period" class="form-control" name="period">
          </div>
          
        </div>
        
              <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Select the file type</label><br>
              <input type="radio" id="image" name="file" value="image"  @if($trends->file_type=="image") checked @endif @if($trends->file_type=="") checked @endif >
              <label for="image">Image</label>
              <input type="radio" id="video" name="file" value="video" @if($trends->file_type=="video") checked @endif>
              <label for="video">Video</label>
          </div>
           <div class="form-group">
                    <!--<label for="title">News Image</label> -->
                    <label style="display: none;">
											<input id="images" type="file"  name="news_image">
										    <input id="" type="hidden" value={{$trends->image}}  name="news_img">
										</label>
										<div class="dummi-img">
								@if($trends->image=="")
								<img id="blah" src="{{url('trend_image/dummy.jpg')}}" style=" width: 100%; height: 226px; padding: 9px; border-radius: 50%;" />
									@elseif($trends->file_type=="video")
								    <video width="100%" height="189px" controls>
                                      <source src="{{url('trend_image/'.$trends->image)}}" >
                                    
                                    </video>
								@else
								<img id="blah" src="{{url('trend_image/'.$trends->image)}}" style=" width: 100%; height: 226px; padding: 9px; border-radius: 50%;" />
								@endif
								</div>
									<a style="margin-top: 8px;   color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_images" href="#">Browse image</a>
                                
                            <button type="submit" id="submits" class="btn pl-5 pr-5 btn-success" style="margin-bottom: 10px;float:right;margin-top: 10px;">Save</button>
            
            </div>
        </div>
      
        </div>
         
 <!--<div class="row">-->
 <!--       <div class="col-sm-12">-->
          
 <!--       </div>-->
        
      
 <!--       </div>-->
        
        <!--<div class="row">-->
        
        <!--         <div class="col-sm-6">-->
        
        <!--</div>-->
            
      
<!---->
        <!--</div>-->
        
        <!--<div class="row">-->
        <!--    <div class="col-sm-12" style="text-align: center;">-->
              
        <!--</div>-->
        <!--</div>-->
        

      </form>

    </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <script>
        $('#add_images').click(function(){
	$('#images').click();
	});

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#images").change(function() {
  readURL(this);
});

 $('#submits').click(function() {
    $(this).attr('disabled', 'disabled');
    $(this).parents('form').submit();
});
    </script>
    
    
@include('layouts.footer')
