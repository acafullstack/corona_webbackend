<!DOCTYPE html>
<html>
<head>
  <title>Report Submited</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!--<h3>Report Submited by User</h3>-->
    <div class="container">
        <!--<p>Name <strong>{{$user_name}}</strong></p>-->
        <!--<p>Email<strong>{{$email}}</strong></p>-->
        <!--<p>Report Type<strong>{{$report_type}}</strong></p>-->
        <!--<p>Situation<strong>{{$situation}}</strong></p>-->
        <!--<p>Location<strong>{{$location}}</strong></p>-->
        
        
        <table class="main">
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2>Dear Admin</h2>
                        <p>This is to notify you that a report has been received from the Coronavirus Tracking system with the following details:</p>
                          <table class="table table-bordered" style="text-align: left; width: 50%;">
						    <tbody>
						    <tr>
						      <th style="   padding: 4px;    background: #fff;color: #000;width: 34%;"><span>User Name</span><span style="padding-left: 17px;">:</span></th>
						      <th style="   padding: 4px;     background: #f2f2f2;color: #000;">{{strtoupper($user_name)}}</th>
						    </tr>
						    <tr>
						      <td style="   padding: 4px;  background: #fff;color: #000;"><span>Email</span><span style="padding-left: 15px;">:</span></th>
						      <td style="   padding: 4px; background: #f2f2f2;color: #000;">{{$email}}</td>
						      
						    </tr>
						    <tr>
						      <td style="   padding: 4px;  background: #fff;color: #000;"><span>Report Type</span><span style="padding-left: 15px;">:</span></th>
						      <td style="   padding: 4px; background: #f2f2f2;color: #000;">{{$report_type}}</td>
						      
						    </tr>
						    <tr>
						      <td style="   padding: 4px;  background: #fff;color: #000;"><span>Situation</span><span style="padding-left: 33px;">:</span></th>
						      <td style="   padding: 4px; background: #f2f2f2;color: #000;">{{$situation}}</td>
						      
						    </tr>
						    <tr>
						      <td style="   padding: 4px;  background: #fff;color: #000;"><span>Location</span><span style="padding-left: 34px;">:</span></th>
						      <td style="   padding: 4px; background: #f2f2f2;color: #000;">{{$location}}</td>
						    </tr>
						  </tbody>
						</table>
						<p style="font-weight: 700;margin-bottom: 0;    margin-top: 2px;">For your immediate action please.</p>
						<p style="margin-bottom: 0;    margin-top: 2px;">Thank you</p>
						<p style="margin-bottom: 0;    margin-top: 2px;">App Management Team</p>
						<p style="margin-bottom: 0;    margin-top: 2px;">Lagos</p>
						<p style="margin-bottom: 0;    margin-top: 2px;">Nigeria</p>
						<p style="margin-bottom: 0;    margin-top: 2px;">08137548264</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
        </div>
</body>
</html>