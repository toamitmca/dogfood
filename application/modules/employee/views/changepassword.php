<section class="main_caintainer">
   <?php $this->load->view('profileleft'); ?>
  <div class="rightSide ">
  <div class="login_panel">
  <h3>Change Password</h3>
  <form>
  <span id="msg"></span>
<input type="hidden" name="matchpass" id="matchpass" value="">
<label>Old Password</label>
<input type="password" name="old_password" id="old_password" onkeyup="return checkpass (this.value)" required="required">
<span id="old_passwordmsg"></span>

<br/>
<label>New Password</label>
<input type="password" name="new_password" id="new_password" required="required">
<br/>
<label>Confirm Password</label>
<input type="password" name="confirm_password" id="confirm_password" onkeyup ="return passMatch(this.value)" required="required">
<span id="confirm_passwordmsg"> </span>

<input type="button" name="submit" value="Reset Password" onclick="return updatepasssword();" class="button_submit" >
</form>
<br/>

</div>
<div class="fix"></div>
<script type="text/javascript">


$(document).ready(function() {
var  checkflogin ="<?php echo $firstlogin->fpasschange; ?>"
var myurl ="<?php echo base_url();?>";
if(checkflogin==0 || checkflogin==2 ){
 alert("Please change the  password ");
 $.ajax({
                  url: myurl+'employee/firstloginemployee',
                    type:'POST',
                    dataType:'json',
                    data: {'act_mode':'employeeupdat'},
                    success: function(data1){
                    console.log(data1);
                                       }
                    });
}
 });

function checkpass()
  {
    var oldpass= $("#old_password").val();
    var MybaseUrl = "<?php echo base_url();?>";
    if(oldpass!='')
    {
     // $(".loadingemails").css('display', 'block');
     // $("#old_password").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'employee/profile/passcheck',
        type: 'POST',
        dataType: 'json',
        data: {'opass':oldpass},
        success:function(data){
  console.log(data);
          if(data.pass >0){
            $('#matchpass').val('1');
           // $("#old_password").nextUntil("br").not(".error_one:first").remove();
              $("#old_passwordmsg").html('<span style="background: none repeat scroll 0 0 #dff0d8;border: 1px solid #d6e9c6; border-radius: 2px;color: #3c763d; display: block; font-size: 13px;margin-top: 3px;padding: 3px;">Correct Password</span>');

           // $(".loadingemails").css('display', 'none');
          }else{
            $("#old_passwordmsg").html('<span class="error_one">Incorrect Password</span>');
             // $("#old_password").nextUntil("br").not(".error_one:first").remove();
            //  $(".loadingemails").css('display', 'none');
          }
        }
      });
    }else{
      $("#old_passwordmsg").html('<span>please Enter Password</span>');
      //$("#old_password").parent().find('span').not("span:first").remove();
    }
  }
  function passMatch()
  { 
    var newpass= $("#new_password").val();
    var cpass= $("#confirm_password").val();
   // $("#confirm_password").parent().find('span').remove();
    if(newpass==cpass)
    {
      $("#confirm_passwordmsg").html('<span style="color:green;">confirm password match</span>');
    }
    else
    {
      $("#confirm_passwordmsg").html('<span class="error_one">new password and confirm password did not match</span>');


    }

  }

  function updatepasssword(){
     var MybaseUrl = "<?php echo base_url();?>";
var newpass= $("#new_password").val();
    var cpass= $("#confirm_password").val();
var match =$('#matchpass').val();
//alert(match);
if(match ==1){

 if(newpass==cpass){
 $.ajax({
        url: MybaseUrl+'employee/profile/passupdate',
        type: 'POST',
        dataType: 'json',
        data: {'opass':cpass},
        success:function(data1){
  console.log(data1);
  //alert('password');
  $('#msg').html('Password update successfully');
  $("#confirm_password").val('');
   $("#new_password").val('');
   $('#matchpass').val('');
   $('#old_passwordmsg').html('');
   $('#confirm_passwordmsg').html('');
    $('#old_password').val('');
}
   });
}
}
  }
</script>
</body></html>