@include('layouts.header')

  <style>
        .select_styling {
            padding: 5px 20px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .plus{
            position: absolute;
                bottom: -8px;
            right: 26px;
            color: #3F51B5;
            font-size: 39px;
            cursor: pointer;
        }
        .minus{
            position: absolute;
                bottom: -8px;
            right: 26px;
            color: #3F51B5;
            font-size: 39px;
            cursor: pointer;
        }
        
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
    <!--        <h1 class="m-0 text-dark">Edit Risk Information</h1>-->
    <!--      </div>-->
    <!--      <div class="col-sm-6">-->
    <!--        <ol class="breadcrumb float-sm-right">-->
    <!--          <li class="breadcrumb-item"><a href="#">Home</a></li>-->
    <!--          <li class="breadcrumb-item active">Edit Risk Information</li>-->
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
                    <h2>Edit Risk Information</h2>
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
          <form class="form-horizontal" method="POST" action="{{ url('update_risk/info') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="info_id" value="{{$info->id}}">
            <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Title</label>
            <input required id="title" value="{{$info->title}}" type="text" placeholder="title" class="form-control" name="title">
          </div>
        </div>
        
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Title Description</label>
            <textarea class="form-control" name="description" required> {{$info->description}}</textarea>
          </div>
        </div>
        </div>
        
        <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="title">Body Content</label>
            <textarea class="form-control" name="content" required> {{$info->content}}</textarea>
          </div>
        </div>
        
        </div>
        
        <div class="row">
            
            @php $i=1 @endphp
            @foreach($risk_detail as $key => $value)
            @if($i>1)
            <input type="hidden" name="info_detail_id[]" value="{{$value->id}}">
            <div class="col-sm-6 remove">
          <div class="form-group">
            <label for="title">Yes/NO</label><br>
            <input required id="size" value="{{$value->is_risk}}" type="text" placeholder="yes/no" class="form-control" name="is_risk[]">
          </div>
        </div>
        
        <div class="col-sm-6 remove">
          <div class="form-group">
            <label for="title">Description</label>
            <input required id="price" value="{{$value->description}}" type="text" placeholder="description" class="form-control" name="descriptionss[]" style="
    width: 92%;"><p class="minus">-</p>
            
          </div>
           </div>
            
            @else
            <input type="hidden" name="info_detail_id[]" value="{{$value->id}}">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Yes/NO</label><br>
            <input required id="size" value="{{$value->is_risk}}" type="text" placeholder="yes/no" class="form-control" name="is_risk[]">
          </div>
        </div>
        
        <div class="col-sm-6">
          <div class="form-group">
            <label for="title">Description</label>
            <input required id="price" value="{{$value->description}}" type="text" placeholder="description" class="form-control" name="descriptionss[]" style="
    width: 92%;"><p class="plus">+</p>
            
          </div>
          
        </div>
            @endif
                @php $i++ @endphp
             @endforeach
        </div>
          <div class="row" id="my_append">
        </div>
        
        <div class="row">
            <div class="col-sm-6">
               <div class="form-group">
                    <label for="title">Image</label> 
                    <label style="display: none;">
											<input id="images" type="file"  name="news_image">
										    <input id="" type="hidden" value={{$info->image}}  name="news_img">
										</label>
										<div class="dummi-img">
									
								<img id="blah" src="{{url('information_center_image/'.$info->image)}}" style=" width: 170px; height: 170px; padding: 9px; border-radius: 50%;" />
								</div>
									<a style="margin-top: 8px;   color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_images" href="#">Browse image</a>
            </div>
        </div>
        <div class="col-sm-6">
               <div class="form-group">
                    <label for="title">ICon</label> 
                    <label style="display: none;">
											<input id="image" type="file"  name="icon_img">
										    <input id="" type="hidden" value={{$info->icon}}  name="icon_img">
										</label>
										<div class="dummi-img" style="margin-left: 16px;">
									
								<img id="blahs" src="{{url('information_center_icon/'.$info->icon)}}" style=" width: 170px; height: 170px; padding: 9px; border-radius: 50%;" />
								</div>
									<a style="margin-top: 8px; margin-left: 42px;   color: #fff; background-color: #ee8322; border-color: #ee8322;" class="btn btn-primary" id="add_image" href="#">Browse image</a>
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
    
     $('#submits').click(function() {
    $(this).attr('disabled', 'disabled');
    $(this).parents('form').submit();
});
    
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
	$('#image').click();
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

$("#image").change(function() {
  readURLs(this);
});

     $(document).on('click', '.minus', function(e) { 
     $(this).closest('.remove').prev().remove();
        $(this).closest('.remove').remove();
    });
    
    $('.minus').click(function(){
        // alert("asdas"); 
      $(this).closest('.remove').prev().remove();
        $(this).closest('.remove').remove();
    });
    
    
    $('.plus').click(function(){
    //   alert("asdas"); 
        $('#my_append').append(`<div class="col-sm-6 remove">
          <div class="form-group">
            <label for="title">Yes/NO</label><br>
            <input required id="size" value="" type="text" placeholder="Yes/NO" class="form-control" name="is_risk[]">
          </div>
        </div>
        
        <div class="col-sm-6 remove">
          <div class="form-group">
            <label for="title">Description</label>
            <input required id="price" value="" type="text" placeholder="Description" class="form-control" name="descriptionss[]"style="
    width: 92%;"><p class="minus">-</p>
            
          </div>
          
        </div>`)
    });
    </script>
    
@include('layouts.footer')
