<!doctype html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="<?php echo base_url();?>assects/css/main.css" type="text/css" />
<style>
.loginwrap {width: 100%; height: 100%;padding: 2% 0 0 0; background: url(../application/assets/images/loginbg.jpg); text-align: center;background-size: 100% 100%;}
.lmain{width: 22%; margin: auto;background: #fff;padding-bottom: 1%;display: block;border-radius: 3px;box-shadow: 0px 2px 10px 1px #F1F1F1;border: 1px solid  #107474;}
.lmain h1{margin: 0; padding: 3% 0 3%;background: #eee;color: #107474;font-family: 'News Cycle', sans-serif;position: relative;font-size: 20px;font-weight: bold;border-bottom: 1px solid #107474;}
.innerlogin { padding:6%;}
.lmain label{ display: block; font-family: 'News Cycle', sans-serif; padding: 5px 2px; text-align: left;}
.lmain input[type="text"],input[type="password"]{-moz-appearance: none;-webkit-appearance: none;appearance: none;display: inline-block;width: 100%;height: 30px;padding: 0 8px;margin: 0;background: #fff;border: 1px solid #d9d9d9;border-top: 1px solid #c0c0c0;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;-moz-border-radius: 1px;-webkit-border-radius: 1px;border-radius: 1px;font-size: 15px;color: #404040; border-radius: 3px; box-shadow: 0 0 1px #ddd inset;}
.submitLogin{border: 1px solid #178d8d; border-radius: 3px; color: #fff; width: 100%; padding:3% 0; margin-top:5%; font-family: 'News Cycle', sans-serif; font-size:1em;text-shadow: 0 1px rgba(0,0,0,0.3); border: 1px solid #178d8d;background-color: #178d8d; cursor: pointer;}
.submitLogin:hover{ background: #107474;}

.errordiv { display: block; }
.error {list-style-type: none; text-align: left;font-family: 'News Cycle', sans-serif;font-size: 12px;color: rgb(211, 56, 7); line-height:22px; }
.error p{ display: none;}
.overlay{position:fixed; width:100%; height:100%; background:rgba(0,0,0,.8); left:0; top:0; z-index:99; display: none;}
.changePassword{width:250px; height:200px; position:fixed; left:0; right:0; top:0; bottom:0; margin:auto; border:solid 2px #ccc; z-index:100; background:#fff; padding:10px; border-radius:2px; display:none}
.changePassword h3{font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#18aaaa; margin:0; padding:0; text-align:left; border-bottom:solid 2px #18aaaa; padding-bottom:5px;}
.changePassword  label{font-size:14px; color:#333}
.loginButon{background: #8f8f8f; padding:5px 10px;vertical-align: top;color: #fff; margin-top:10px; display:block;border-radius: 3px;font-size:14px;font-family: 'futura_oblique'; vertical-align:middle; border:none; width:100%; font-family:Arial, Helvetica, sans-serif; cursor:pointer}
.bluebg {color: #fff !important; background: #188f8d !important;}
.closePopup{position:absolute; width:18px; height:18px; font-size:13px; right:0; top:0; text-align:center; line-height:16px; background:#333; color:white; border-radius:0 2px 0 2px; cursor:pointer;}
.closePopup:hover{background:#18aaaa;}
#msg{background: none repeat scroll 0 0 #fdd7d0;border: 1px solid #e09385;border-radius: 2px;color: #862413;display: block;font-size: 13px;margin-top: 3px;padding: 3px;}
#changePassword{display: inherit; text-align: right; margin-top: 13px; font-size: 13px; text-decoration:underline; cursor:pointer}
#msgcorrect{ background: none repeat scroll 0 0 #dff0d8;border: 1px solid #d6e9c6;border-radius: 2px;color: #3c763d;display: block;font-size: 13px;margin-top: 3px;
    padding: 3px;
}
</style>
<script>
	$(document).ready(function(e) {
        $('#changePassword').click(function(){
			$('.overlay').fadeIn();
			$('.changePassword').fadeIn();
		});
		$('.closePopup').click(function(){
			$('.overlay').fadeOut();
			$('.changePassword').fadeOut();
		});
    });
</script>

</head>
<body style="font-family:Arial, Helvetica, sans-serif">
<div class="overlay"></div>
<div class="loginwrap">
    <div class="admin-logo">
        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assects/images/logo.png" /></a>
    </div>
<div id="login_form" class="lmain">
	<h1>Login Admin</h1>
	<div class="innerlogin">
		<form action="<?php echo base_url();?>ssa/admin/index/" method="post">
			<?php 
				if(validation_errors()){
				    echo '<div class="errordiv">';
			      		echo validation_errors('<li class="error">');
			      	echo '</div>';
			     }
			    echo '<div class="error">';
				echo $this->session->flashdata('message');
				echo '</div>';
			?>
			<label>Email</label><input type="text" name="email" value="<?php echo set_value('email');?>">
			<label>Password</label><input type="password" name="Password" value="">

			<input type="submit" name="submit" value="Login" class="loginButon bluebg" style="display:inline-block; float:left; width:auto" >
            <a id="changePassword">Forgot Password</a>
		</form>
	</div>
	<div class="changePassword">
<a class="closePopup">x</a>
<h3>Change Password</h3>
<span id="msg" style="display:none;"></span>
<span id="msgcorrect" style="display:none;"></span>
<label>Enter Your Email Id</label>
<input type="text" name="pass_email" id="ssa_email11" onkeyup="return mail_check();">
<input type="hidden" name="check_mail" id="check_mail2" value="">
<label>Enter Your Security Answer</label>
<input type="text" name="sequerty_ques" id="seq_question" onkeyup=" return mail_s_question();">
<input type="hidden" name="check_ans" id="check_ans11" value="">
<input type="button" name="password_send" id="password_send" value ="Send Password" onclick="return password_send();" class="loginButon bluebg" >
</div></div>

<script type="text/javascript">
$(document).ready(function() {
   // alert("yes");
});
function mail_check(){
var myemail = $('#ssa_email11').val();
$.ajax({
				url :'http://192.168.1.22/expense2/ssa/admin/ssa_admin_mail_check/',
				type:'POST',
				dataType: 'json', 
				data: {'email': myemail},
				success: function(data1){
					data = data1.correctemail;
					if(data>0)
					{	
				    $('#msg').empty();
				     $('#msg').css("display" ,"none");
					$('#check_mail2').val(data);
					$('#msgcorrect').css("display" ,"block");
				    $('#msgcorrect').html('Correct Mail');
				    }
				     else {
				     	$('#msgcorrect').empty();
				     	 $('#msgcorrect').css("display" ,"none");
				     	$('#msg').css("display" ,"block");
				     	$('#msg').html('Incorrect Mail');
				     	

				     }
				}
			});
}
function mail_s_question(){
var myemail = $('#ssa_email11').val();
var myans = $('#seq_question').val();
$.ajax({
				url :'http://192.168.1.22/expense2/ssa/admin/ssa_admin_ansmail_check/',
				type:'POST',
				dataType: 'json', 
				data: {'email': myemail , 'ans':myans},
				success: function(data2){
					
					data3 = data2.correctemailans;
				if(data3>0)
				{
					$('#msg').empty();
					$('#msg').css("display" ,"none");
					$('#check_ans11').val(data3);
					//console.log(data);
					$('#msgcorrect').css("display" ,"block");
				    $('#msgcorrect').html('Correct Security');
				}
				else
				{
					$('#msgcorrect').empty();
					 $('#msgcorrect').css("display" ,"none");
					$('#msg').css("display" ,"block");
				    $('#msg').html('Incorrect Security');
				}
				}
			});
}


function password_send(){
var myemail = $('#ssa_email11').val();
var mail_c = $('#check_mail').val();
var ans_c = $('#check_mail2').val();
var myans = $('#seq_question').val();
$.ajax({
				url :'http://192.168.1.22/expense2/ssa/admin/ssa_admin_password_send/',
				type:'POST',
				//dataType: 'json', 
				data: {'email': myemail , 'ans':myans ,'mail_check':mail_c,'ans_check':ans_c},
				success: function(data){
					console.log(data);
					$('#check_ans').append(data);
					if(data==1){

					$('#msg').empty();
					 $('#msg').css("display" ,"none");
					$('#msgcorrect').css("display" ,"block");
                    $('#msgcorrect').html('Your password send to your Email-Id sucessfully ');
					}
					else{
					 $('#msgcorrect').empty();
					  $('#msgcorrect').css("display" ,"none");
                     $('#msg').css("display" ,"block");
                     $('#msg').html("Email or security  code didn't match ");


					}
					console.log(data);
				}
			});
}
</script>
</div>
</body>
