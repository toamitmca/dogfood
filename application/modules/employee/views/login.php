<!doctype html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="<?php echo base_url();?>assects/css/main.css" type="text/css" />
<style>
.loginwrap {width: 100%; height: 100%;padding: 6% 0 0 0; background: url(../application/assets/images/loginbg.jpg); text-align: center;background-size: 100% 100%;}
.lmain{width: 22%; margin: auto;background: #fff;padding-bottom: 1%;display: block;border-radius: 3px;box-shadow: 0px 2px 10px 1px #F1F1F1;border: 1px solid  #107474;}
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
              <h1>Employee Login</h1>
              <div class="innerlogin">
              		<form action="<?php echo base_url();?>employee/login/index/" method="post">
              			<label>UserName</label>
              			<input type="text" name="username" value="<?php echo set_value('username'); ?>">
              			<label>Password</label>
              			<input type="password" name="password" value="">
              			<input type="submit" name="submit" value="Login" class="loginButon bluebg" style="display:inline-block; float:left; width:auto">
              			 <a id="changePassword">Forgot Password</a>
              				</form>
                       <div class="changePassword">
                     <a class="closePopup">x</a>
                      <span class="message" id="mess"  ></span>
                    <input type="hidden" name="matchmail" id="matchemail" value="">
                    <label>Enter Your Email Id</label>
                    <input type="text" id="empemail" name="email" onblur="return emppasscheck();" value="" placeholder="Enter your Email">
                    <label>Enter Your Security Answer</label>
                    <input type="text" id="sequrityquestion" name="sequrityquestio" value="" placeholder="Enter your answer">
                    <input type="button" class="submitLogin margintop" name="password_change" value="Password Send" onclick="return resetpassword();">
             </div>
              </div>
                </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}
	function emppasscheck() {
     var Mybase_url =base_url();
     console.log(Mybase_url);
     var empmail= $('#empemail').val();
    $.ajax({
    url: Mybase_url+'employee/employeepasswordreset/',
	type: 'POST',
	dataType:'json',
	data: {'empmail':empmail } ,
	 success: function(data){
          console.log(data.correctpass);
if(data.correctpass=="1"){
$('#mess').html('match your emailid');
$('#matchemail').val('1');
//alert('hello');

}
      }
     });
	
	}
	function resetpassword() {

     var Mybase_url =base_url();
     var empmail= $('#empemail').val();
     var seq= $('#sequrityquestion').val();
     var empmailmatch= $('#matchemail').val();
     /*if(empmail==""){
   return false ;
     }*/
if(empmailmatch ==""){
	   $('#empemail').css("border","solid 1px red");
       $('#empemail').focus();

              return false ;
               } 
               else{

      $('#empemail').css("border","");
      }
if(empmail ==""){
	   $('#empemail').css("border","solid 1px red");
       $('#empemail').focus();

              return false ;
               } 
               else{

      $('#empemail').css("border",""); 
      }
if(seq ==""){
	   $('#sequrityquestion').css("border","solid 1px red");
       $('#sequrityquestion').focus();
              return false ;
               } 
               else{

      $('#sequrityquestion').css("border",""); 
      }
    $.ajax({
    url: Mybase_url+'employee/empepasswordreset/',
	type: 'POST',
	dataType:'json',
	data: {'empmail':empmail ,'seqquestion':seq },
	 success: function(data){
	 	  $('#mess').empty();
	 	console.log('rahul;');
          console.log(data.w);
          if(data.w !==""){
          $('#mess').html('Password  has been sent on emailId');
          $('#matchemail').val('');
         }
     }
     });
	}
</script>
</body> 