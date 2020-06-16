@include('layouts.header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Message</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Message</li>
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
          <form class="form-horizontal" method="POST" action="{{ url('sending_user_msg') }}" enctype="multipart/form-data">
            @csrf
         
        
        
         
         <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Message</label>
                <textarea class="form-control" name="message" required> {{old('Message')}}</textarea>
            </div>
        </div>
        
      
        </div>
        
       
        
       
        
 <div class="row">

       <div class="col-sm-12 text-center">
        <button type="submit" class="btn pl-5 pr-5 btn-success" style="margin-bottom: 10px;">Send</button>
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
 
    </script>
    
    

@include('layouts.footer')
