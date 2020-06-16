@include('layouts.header')
    
<style>
    .details {
        background: #fff !important;
        padding: 23px !important;
        border-radius: 4px !important;
        margin-top: 20px;
    }
    .up_buton button {
        padding: 3px 22px;
        background: #3c8dbc;
        color: #fff;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
        display: none;
    }
    .up_buton h2 {
        font-size: 23px;
    }
    .left_side {
        background: #fff;
        color: #000;
    }
    .right_side {
        background: #f2f2f2;
        color: #000;
    }
    .form-control {
        background: transparent;
    }
    .cnfrm_btn {
        text-align: right;
    }
    .cnfrm_btn button {
        background: #367fa9;
    border: none;
    border-radius: 4px;
    padding: 4px 15px;
    color: #fff;
    cursor: pointer;
    }
</style>

    
<div class="container">
    <div class="content">
        <div class="heading_til">
            <h2>Admin Details</h2>
        </div>
        @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alert !</strong><span> {{ session()->get('error') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-sussess alert-dismissible fade show" role="alert">
                <strong>Success !</strong><span> {{ session()->get('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="details">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
				        <table class="table table-bordered table-striped table-hover" style="color: #367fa9;">
                            <tbody>
                                <form action="{{url('/admin/update_settings')}}" method="POST">
                                @csrf
                                <tr>
                                  <td class="left_side">Name</td>
                                  <td class="right_side"><input class="form-control" type="text" value="{{strtoupper($details->name)}}" readonly></td>
                                </tr>
                                <tr>
                                  <td class="left_side">Email</td>
                                  <td class="right_side"><input class="form-control" type="email" name="email" value="{{$details->email}}" readonly></td>
                                </tr>
                                <tr>
                                  <td class="left_side">Alert Phone Number's</td>
                                  <td class="right_side"><textarea class="form-control" type="text" name="alert_phone_numbers">{{$details->alert_phone_numbers}}</textarea>
                                </tr>
                                <tr>
                                  <td class="left_side">Alert Email Id's</td>
                                  <td class="right_side"><textarea class="form-control" type="text" name="alert_emails">{{$details->alert_emails}}</textarea>
                                </tr>
                                
                            </tbody>
                        </table>
			        </div>
			         <div class="cnfrm_btn">
			            <button type="submit">Update</button>
			        </div>
			    </div>
			    </form>
			    <div class="col-md-6">
                    <div class="table-responsive">
				        <table class="table table-bordered table-striped table-hover" style="color: #367fa9;">
                            <tbody>
                                <form action="{{url('/admin/update_password')}}" method="POST">
                                @csrf
                                <tr>
                                  <td class="left_side">Old Password</td>
                                  <td class="right_side"><input type="password" class="form-control" name="old_password"></td>
                                </tr>
                                <tr>
                                  <td class="left_side">New Password</td>
                                  <td class="right_side"><input type="password" class="form-control" name="new_password"></td>
                                </tr>
                                <tr>
                                  <td class="left_side">Confirm Password</td>
                                  <td class="right_side"><input type="password" class="form-control" name="confirm_password"></td>
                                </tr>
                            </tbody>
                        </table>
			        </div>
			        <div class="cnfrm_btn">
			            <button type="submit">Update</button>
			        </div>
			    </div>
			    </form>
			</div>
        </div>
    </div>
</div>
@include('layouts.footer')

