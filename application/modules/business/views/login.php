<!doctype html>
<html>
<head>
<style>
.loginwrap {width: 100%; height: 100%;padding: 2% 0 0 0; background: url(../application/assets/images/loginbg.jpg); text-align: center;background-size: 100% 100%;}
.lmain{width: 22%; margin: auto;background: #fff;padding-bottom: 1%;display: block;border-radius: 3px;box-shadow: 0px 2px 10px 1px #F1F1F1;border: 1px solid  #107474; font-family:Arial, Helvetica, sans-serif;}
.lmain h1{margin: 0; padding: 3% 0 3%;background: #eee;color: #107474;font-family: 'News Cycle', sans-serif;position: relative;font-size: 20px;font-weight: bold;border-bottom: 1px solid #107474;}
.innerlogin { padding:6%;}
.lmain label{ display: block; font-family: 'News Cycle', sans-serif; padding: 5px 2px; text-align: left;}
.lmain input[type="text"],input[type="password"]{-moz-appearance: none;-webkit-appearance: none;appearance: none;display: inline-block;width: 100%;height: 36px;padding: 0 8px;margin: 0;background: #fff;border: 1px solid #d9d9d9;border-top: 1px solid #c0c0c0;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;-moz-border-radius: 1px;-webkit-border-radius: 1px;border-radius: 1px;font-size: 15px;color: #404040; border-radius: 3px; box-shadow: 0 0 1px #ddd inset;}
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
#msgcorrect{ background: none repeat scroll 0 0 #dff0d8;border: 1px solid #d6e9c6;border-radius: 2px;color: #3c763d;display: block;font-size: 13px;margin-top: 3px;padding: 3px; }
.forget{display: inherit;text-align: right;margin-top: 13px;font-size: 13px;text-decoration: underline;cursor: pointer;}
</style>
</head>
<body>
<div class="overlay"></div>
<div class="loginwrap">
    <div class="admin-logo">
        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assects/images/logo.png" /></a>
    </div>
<div id="login_form" class="lmain">
<h1>Business Admin</h1>
	<div class="innerlogin">
		<?php 
				if(validation_errors()){
				    echo '<div class="errordiv">';
			      		echo validation_errors('<li class="error">');
			      	echo '</div>';
			     }
 
			    echo $this->session->flashdata('message');

		?>
		<form action="<?php echo base_url();?>business/business/index/" method="post">
			<label>UserName</label>
			<input type="text" name="email" value="<?php echo set_value('email'); ?>">
			<label>Password</label>
			<input type="password" name="password" value="">
			<input type="submit" name="submit" value="Login" class="loginButon bluebg" style="display:inline-block; float:left; width:auto">
		</form>
		<a class="forget">Forgot Password</a>
			
		<div class="changePassword">
<a class="closePopup">x</a>
		<form action="<?php echo base_url();?>business/forgot/" method="post">
		<span id="msg"></span>
		<span id="msgcorrect"></span>
			<label>Enter your Email Id</label>
			
			<input type="text" name="ffemail" id="f_email" onkeyUp="return my(this.value);">
			<div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>
			<label>Enter Your Security Answer</label>
			<input type="text" name="ff_seq" id="f_seq" onkeyUp="return seq(this.value);">
			<div class="loadingemails" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>
			<input type="submit" name="submit" value="Send" class="submitLogin margintop">
		</form>
	</div>
</div></div>
</div>
</body> 


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('.forget').click(function(){
			$('.overlay').fadeIn();
			$('.changePassword').fadeIn();
		});
		$('.closePopup').click(function(){
			$('.overlay').fadeOut();
			$('.changePassword').fadeOut();
		});
    });
</script>
<script>
function my(){
		var femail = $("#f_email").val();
		var MybaseUrl = "<?php echo base_url();?>";
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		
		if(femail==''){
			return false;
		}
		if(filter.test(femail)){
			$(".loadingemail").css('display', 'block');
			$("#f_email").parent().find('span').remove();
			$.ajax({
				url: MybaseUrl+'business/checkEmail/',
				type: 'POST',
				dataType: 'json',
				data: {'email':femail},
				success:function(data){
					
					if(data.correctemail >0)
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
		
		}else{
			$("#f_email").after('<span>Please Enter Valid Email</span>');
			$("#f_email").parent().find('span').not("span:first").remove();
			var issemail="<input type='hidden' name='is_email' value='1'>"
			$("#emailis").append(issemail);		

		}
		
	}
	function seq()
	{
		var fseq= $("#f_seq").val();
		var semail=$("#f_email").val();
		var MybaseUrl = "<?php echo base_url();?>";
		if(fseq!='')
		{
			$(".loadingemails").css('display', 'block');
			$("#f_seq").parent().find('span').remove();
			$.ajax({
				url: MybaseUrl+'business/checkSeq/',
				type: 'POST',
				dataType: 'json',
				data: {'seq':fseq , 'semail':semail},
				success:function(data){
					$("#f_seq").empty();
					if(data.correctseq >0){
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
		
		}else{
			$("#f_seq").after('<span>Please Enter Security Code</span>');
			$("#f_seq").parent().find('span').not("span:first").remove();


		}


	}
</script>