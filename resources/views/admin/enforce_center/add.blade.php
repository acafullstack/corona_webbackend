@include('layouts.header')


        <style>
             .content {
    padding-top: 15px !important;
    padding-left: 11px !important;
    padding-right: 10px !important;
}
        </style>
    
    <!-- Content Header (Page header) -->
    <!--<div class="content-header">-->
    <!--  <div class="container-fluid">-->
    <!--    <div class="row mb-2">-->
    <!--      <div class="col-sm-6">-->
    <!--        <h1 class="m-0 text-dark">Edit Information Center</h1>-->
    <!--      </div>-->
    <!--      <div class="col-sm-6">-->
    <!--        <ol class="breadcrumb float-sm-right">-->
    <!--          <li class="breadcrumb-item"><a href="#">Home</a></li>-->
    <!--          <li class="breadcrumb-item active">Edit Information Center</li>-->
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
                    <h2>Add Information Center</h2>
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
          <form class="form-horizontal" method="POST" action="{{ url('store/info') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label for="title">Title</label>
            <input required id="title" value="{{old('title')}}" type="text" placeholder="Header" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label for="title">Title Description</label>
            <textarea class="form-control" name="description" required> {{old('description')}}</textarea>
          </div>
          <div class="form-group">
            <label for="title">Select the file type</label><br>
              <input type="radio" id="image" name="file" value="image" checked >
              <label for="image">Image</label>
              <input type="radio" id="video" name="file" value="video" >
              <label for="video">Video</label>
          </div>
               <div class="form-group text-center" >
                    <label for="title">Image or Video</label> 
                    <label style="display: none;">
											<input id="images" type="file"  name="news_image">
										</label>
										<div class="dummi-img">
								<img id="blah" src="{{url('information_center_image/dummy.jpg')}}" style=" width: 170px; height: 170px; padding: 9px; border-radius: 50%;" />
								</div>
									<a style="margin-top: 8px;   color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_images" href="#">Browse</a>
                        <div class="form-group">
                    <label for="title">Icon</label> 
                    <label style="display: none;">
											<input id="my_image" type="file"  name="icon_img">
										</label>
										<div class="dummi-img" style="margin-left: 16px;">
									
								<img id="blahs" src="{{url('information_center_icon/dummy.png')}}" style=" width: 170px; height: 170px; padding: 9px; border-radius: 50%;" />
								</div>
									<a style="margin-top: 8px; color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_image" href="#">Browse image</a>
            </div>
            </div>
        </div>

        <div class="col-sm-8">
          
          <div class="form-group">
            <label for="title">Body Content</label>
            <textarea class="form-control" name="content" rows="30" required>{{old('content')}} </textarea>
          </div>
          
        </div>
        </div>
        
 <div class="row">

       <div class="col-sm-12 text-right">
        <button type="submit" id="submits" class="btn pl-5 pr-5 btn-success" style="margin-bottom: 10px;">Submit</button>
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

   $('#add_image').click(function(){
    //   alert('asd');
	$('#my_image').click();
	});

function readURLs(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blahs').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#my_image").change(function() {
  readURLs(this);
});

 $('#submits').click(function() {
    $(this).attr('disabled', 'disabled');
    $(this).parents('form').submit();
});
    </script>
    
@include('layouts.footer')
