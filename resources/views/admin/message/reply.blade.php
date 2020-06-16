@include('layouts.header')

<style>
.chatbox-holder {
    margin: 20px 0px;
    position: absolute !important;
    /*display: initial !important;*/
    top: 500px !important;
    right: 18% !important;
    bottom: unset !important;
}
.modal-content {
    box-shadow: none !important;
    border-radius : none ;
}
.chatbox {
  width: 600px;
     height: 500px; 
    margin: 0 60px 0 0;
    position: relative;
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
    display: flex;
    flex-flow: column;
    border-radius: 10px 10px 0 0;
    background: white;
    bottom: 0;
    transition: .1s ease-out;
}




.status {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  display: inline-block;
  box-shadow: inset 0 0 3px 0 rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(0, 0, 0, 0.15);
  background: #cacaca;
  margin: 0 3px 0 0;
}


.chat-messages {
  border-top: 1px solid rgba(0, 0, 0, .05);
  padding: 10px;
  overflow: auto;
  display: flex;
  flex-flow: row wrap;
  align-content: flex-start;
  flex: 1;
}

.message-box-holder {
  width: 100%;
  margin: 0 0 15px;
  display: flex;
  flex-flow: column;
  align-items: flex-end;
}

.message-sender {
  font-size: 12px;
  margin: 0 0 15px;
  color: #30649c;
  align-self: flex-start;
}

.message-sender a, .message-sender a:link, .message-sender a:visited, .chat-partner-name a, .chat-partner-name a:link, .chat-partner-name a:visited {
  color: #30649c;
  text-decoration: none;
}

.message-box {
  padding: 6px 10px;
  border-radius: 6px 0 6px 0;
  position: relative;
  background: rgba(100, 170, 0, .1);
  border: 2px solid rgba(100, 170, 0, .1);
  color: #6c6c6c;
  font-size: 12px;
}

.message-box:after {
  content: "";
  position: absolute;
  border: 10px solid transparent;
  border-top: 10px solid rgba(100, 170, 0, .2);
  border-right: none;
  bottom: -22px;
  right: 10px;
}

.message-partner {
  background: rgba(0, 114, 135, .1);
  border: 2px solid rgba(0, 114, 135, .1);
  align-self: flex-start;
}

.message-partner:after {
  right: auto;
  bottom: auto;
  top: -22px;
  left: 9px;
  border: 10px solid transparent;
  border-bottom: 10px solid rgba(0, 114, 135, .2);
  border-left: none;
}

.chat-input-holder {
  display: flex;
  border-top: 1px solid rgba(0, 0, 0, .1);
}

.chat-input {
  resize: none;
  padding: 5px 10px;
  /*height: 40px;*/
  font-family: 'Lato', sans-serif;
	font-size: 14px;
  color: #999999;
  flex: 1;
  border: none;
  background: rgba(0, 0, 0, .05);
   border-bottom: 1px solid rgba(0, 0, 0, .05);
   width: 100%;
}

.chat-input:focus, .message-send:focus {
  outline: none;
}

.message-send::-moz-focus-inner {
	border:0;
	padding:0;
}

.message-send {
  -webkit-appearance: none;
  background: #9cc900;
  background: -moz-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -webkit-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -o-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: -ms-linear-gradient(180deg, #00d8ff, #00b5d6);
  background: linear-gradient(180deg, #00d8ff, #00b5d6);
  color: white;
      font-size: 16px;
    padding: 15px 17px;
  border: none;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
  cursor: pointer;
}


.chatbox-min {
  margin-bottom: -362px;
/*   height: 46px; */
}

.chatbox-min .chatbox-avatar {
  width: 60px;
  height: 60px;
}

.chatbox-min .chat-partner-name, .chatbox-min .chat-group-name {
  padding: 0 0 0 75px;
}
  .content {
    padding-top: 15px !important;
    padding-left: 11px !important;
    padding-right: 10px !important;
}
/*.main-footer {*/
/*            margin-left: 0 !important;*/
/*        }*/

@media screen and (max-width: 480px) {
    .chatbox {
        width: 100%;
        margin: 0;
    }
    .chat-input {
        height: 52px;
    }
}

.send_msg {
    width: 100%;
}
	</style>

<div class="content">

    <div class="dashboard-left">
    	<div class="courselist">
    				<div class="clearfix"></div>
    				<div class="row">
    
    					<div class="col-md-12 col-sm-12 ">
    						<div class="x_panel">
    							<div class="x_content">
								<!--<div class="x_title">-->
								<!--	<div class="col-sm-6 text-left">-->
								<!--		<h2>Messages</h2><br>-->
										
								<!--	</div>-->
								<!--	<div class="col-sm-6 text-right">-->
								<!--		<div class="dashboard-heading text-right">-->
								<!--			 <a href="{{ url('blog/addblog') }}" class="add-catbtn">Add Blog <i class="fa fa-plus" aria-hidden="true"></i>-->
								<!--			</a>-->
								<!--			<button class="btn btn-sm btn-success"  id="selectAll">Select All Checkbox on this Page</button>-->

								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="clearfix"></div>-->
								<!--</div>-->
								<div class="row">
									<div class="col-sm-12">
										<div class="chatbox-holder">
										  
  <div class="chatbox">  
  <div class="chatbox-top">
      <div class="chat-partner-name">
        <!--<span class="status online"></span>-->
        <a id="" href="javascript:void(0)">{{$user->first_name}}</a>
      </div>
      </div>
    <div class="chat-messages">
        @foreach($messagess as $msg)
       @if(Session::get('admin_id') == $msg->sender_id)
       <div class="message-box-holder">
        <div class="message-box">
          {{$msg->msg}}
        </div>
      </div>
      @else
      <div class="message-box-holder">
        <div class="message-box message-partner">
          {{$msg->msg}}
        </div>
      </div>
      @endif
      
      @endforeach

    </div>
    
    <div class="chat-input-holder">
        <form id="reg_form2" class="modal-content" action="{{ url('sending_msg')}}" method="post">
            <input type="hidden" name="admin_ids" id="admin_idss" value="{{Session::get('admin_id')}}" >
        <input type="hidden" name="my_converstion" id="my_converstions" value="{{$conversation_id}}"  >
      <textarea class="chat-input" name="msgs" id="msg_textarea" required></textarea>
      <!--<input type="text" value="Send" class="message-send">-->
      <button class="message-send">Send</button>
      </form>
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
        	<script>
		$(function(){
  $('.fa-minus').click(function(){    $(this).closest('.chatbox').toggleClass('chatbox-min');
  });
  $('.fa-close').click(function(){
    $(this).closest('.chatbox').hide();
  });
});

 $(document).on('submit','#reg_form2',function(e){
    e.preventDefault();
         $.ajax({
      headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
      type:'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(msg){
             $("#msg_textarea").val("")
          	var html='<div class="message-box-holder">\
										<div class="message-box">' + msg.data.msg + '</div>\
										</div>';
			$('.chat-messages').append(html);
          
      }
      });
     });

	</script>
	


@include('layouts.footer')