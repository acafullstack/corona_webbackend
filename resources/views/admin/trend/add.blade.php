@include('layouts.header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add {{$info_news->title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add {{$info_news->title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if(Session::has('alert'))
            <div class="alert alert-danger">
              {{ Session::get('alert') }}
            </div>
            @endif
          <form class="form-horizontal" method="POST" action="{{ url('store/trend') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Title</label>
            <input required id="title" value="{{old('title')}}" type="text" placeholder="title" class="form-control" name="title">
          </div>
        </div>
        
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">URL</label>
            <input required id="url" value="{{old('url')}}" type="text" placeholder="url" class="form-control" name="url">
          </div>
        </div>
        </div>
        
        
         
 <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="title">Description</label>
            <textarea class="form-control" name="description" required> {{old('description')}}</textarea>
          </div>
        </div>
        
      
        </div>
        
        <div class="row">
        
                 <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Period</label>
            <input required id="url" value="{{old('period')}}" type="date" placeholder="Period" class="form-control" name="period">
          </div>
        </div>
            
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Select the file type</label><br>
              <input type="radio" id="image" name="file" value="image"  checked >
              <label for="image">Image</label>
              <input type="radio" id="video" name="file" value="video">
              <label for="video">Video</label>
          </div>
        </div>

        </div>
        
        <div class="row">
            <div class="col-sm-12" style="text-align: center;">
               <div class="form-group">
                    <label for="title">Trend Image</label> 
                    <label style="display: none;">
											<input id="images" type="file"  name="news_image">
										
										</label>
										<div class="dummi-img">
									
								<img id="blah" src="{{url('trend_image/dummy.jpeg')}}" style=" width: 170px; height: 170px; padding: 9px; border-radius: 50%;" />
								</div>
									<a style="margin-top: 8px;   color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_images" href="#">Browse image</a>
            </div>
        </div>
        </div>
        
 <div class="row">

       <div class="col-sm-12 text-center">
        <button type="submit" id="submits" class="btn pl-5 pr-5 btn-success" style="margin-bottom: 10px;">Save</button>
        </div>
</div>
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
    $(document).ready(function(){
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

 });
 
  $('#submits').click(function() {
    $(this).attr('disabled', 'disabled');
    $(this).parents('form').submit();
});
    </script>
    
    

@include('layouts.footer')
