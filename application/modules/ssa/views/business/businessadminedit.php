<script type="text/javascript">
  $(document).ready(function(){
    $('#changePass').click(function(){
      $(this).next().next().toggleClass('changePass2');
    });
  });
</script>

<?php if($bprofile !=="Something Went Wrong"){ ?>

<?php

$status=array(  '0' =>array('a_statusId'=>1,'a_staName'=>'Open'),
                '1' =>array('a_statusId'=>0,'a_staName'=>'Blocked'),

          );

?>

<?php
/*p($bprofile);
exit;*/

if(!empty($bprofile->tba_Address)){
  $address= explode('___', $bprofile->tba_Address);
}else{
  $address[0]='';
  $address[1]='';
  $address[2]='';
}

 //p($address);
 //exit();
//p($country);
 //echo $bprofile->b_Status;

 //exit();

 ?>
<section class="main_caintainer">
  <div class="leftSide">
<ul class="leftmenu">
</ul>
</div>
  <div class="rightSide">
  <div>
    

    <div class="fix"></div>
  </div>
  <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }

  if($this->session->flashdata('message')){
    echo $this->session->flashdata('message');
  }
?>
  <form name="detail_informaton1" id="detail_informaton1" method="post" action="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $bprofile->a_BusnAdminId ; ?>">

<div class="right_top">

<h2 id="changePass" class="secIcon right_topss">Change password & Security answer </h2> <span class="buttonWrap"></span>
<span class="changePass2">




<table class="tabS ">
<span id="msg" class="msgerr"></span>
<input type="hidden" name="" id="adminid" value="<?php echo $bprofile->a_BusnAdminId; ?>">
<tr> </td>
<td><input type="button" class="loadbtn bluebg"  name="save_password" value="Change Password" onclick="return badminpassword();"></td>
<td><input type="button" class="loadbtn bluebg new" name="save_ans" value="Change Security Answer" onclick="return badminans();"> </td> <td> <span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span> </td> </tr>

<tr><!-- <td><input type="button" class="loadbtn bluebg"  name="save_password" value="Change Password" onclick="return badminpassword();"></td>--></tr>
<span id="msg1" class="msgerr"></span>
</table>
</span>
  

  <div class="formPreExp">
   <div class="col">
    <label>Status</label>
    <select name="status" id="status">
        <option value="">Select Status</option>
        <option value="1" <?php if($bprofile->b_Status==1){ ?>selected="selected" <?php } ?>  >Open</option>
        <option value="0" <?php if($bprofile->b_Status==0){ ?>selected="selected" <?php } ?>>Blocked</option>

      </select>
      </div>
    <div class="col">
      <label>First Name</label>
      <input type="text" name="first_name" id="first_name"  value="<?php echo $bprofile->t_FirstName; ?>" />
    </div>
    <div class="col">
      <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $bprofile->t_LastName; ?>" />
    </div>
     <div class="col">
      <label>Email Id.</label>
      <input type="text" name="t_Email" id="t_Email" readonly  value="<?php echo $bprofile->t_Email; ?>" />
    </div>
    <div class="col">
    <label>Department</label> 
      <select name="department" id="department">
        <option value=''>Select a Department</option>
      </select>
    </div>

 <div class="col">
      <label>Employee Id</label>
      <input type="text" name="employee_id" id="employee_id"  value="<?php echo $bprofile->t_AdminCode; ?>" />
    </div>
    <div class="col">
      <label>DOB</label>
      <input type="text" name="date_of_birth" value="<?php echo date('d M, Y', strtotime($bprofile->d_DOB)); ?>" />
    </div> 
    <div class="col">
      <label>Office Phone </label>
      <input type="text" name="office_phone" id="office_phone" onkeypress="return isNumber(event)" maxlength="15" value="<?php echo $bprofile->t_Contact; ?>" />
    </div>
    <div class="col">
      <label>Mobile Phone </label>
      <input type="text" name="mobile_phone" id="mobile_phone" onkeypress="return isNumber(event)" maxlength="11"  value="<?php echo $bprofile->t_Mobile; ?>">
    </div>
    <div class="col">
      <label>Address Line1</label>
      <input type="text" name="address_line1" id="address_line1" value="<?php if(isset($address[0])) { echo $address[0]; } ?>"/>
    </div>
    <div class="col">
      <label>Address Line2</label>
      <input type="text" name="address_line2" id="address_line2" value="<?php if(isset($address[1])) { echo $address[1]; }  ?>"/>
    </div>
   <!--  <div class="col">
      <label>Address Line3</label>
      <input type="text" name="address_line3"  id="address_line3" value="<?php //if(isset($address[2])) {echo $address[2];}  ?>" />
    </div> -->
     <div class="col">
        <label>Country</label>
        <?php echo country('list' ,$bprofile->n_CountryId,1 ) ?>
         
    </div>
    

    <div class="col">
      <label>State</label> 
      <select name="state_id" id="state_id" onchange="return getCity(1)">
        <option value="">Select a State</option>
        
      </select>

    </select>
    <span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
  
    </div>
    <div class="col">
      <label>City</label>
      <select name="city_id" id="city_id" >
          <option value="">Select a City</option>
          
        </select>
    </div>

  <div class="col">
    <label>PIN Code</label>
    <input type="text" name="pin_code" id="pin_code" value="<?php echo $bprofile->t_Pincode; ?> "/>
  </div>
   
 

  <div></div>
    <div class="right_top">
    <span class="buttonWrap">
      
    </span>

<span>

 <?php
 if($rool !=="Something Went Wrong") {
$roolaccscheck = array();
foreach ($rool as  $value1) {
  $roolaccscheck[] =$value1->n_RoleAccessId;
 $amount=$value1->n_AmtRange;
 $businesssid=$value1->n_BusinessId;
 $createdby =$value1->n_CreatedBy;
 $EmpId =$value1->n_EmpId;
}
}
else{
   $roolaccscheck[]="";
}
  ?>
  <span id="msgrool" class="msge"></span>
   
   <input type="hidden" name="business" id="businessid" value="<?php  echo  $businesssid ;?>">
   <input type="hidden" name="creadedby" id="createdbyid" value="<?php echo $createdby; ?>">
   <input type="hidden" name="adminid" id="adminid" value="<?php echo $EmpId; ?>">
<table id="roolaccess">
<tbody>
<?php
   if($amount <0){
    $amount='';
   }
   else{
$amount =number_format($amount, 2, '.', '');

   }



 foreach ($access as $key => $value) {
if(!empty($roolaccscheck)){
          if(in_array($value->a_RoleAccessId, $roolaccscheck)){ $check="checked";}else{ $check=''; }
           }else{
          $check='';
        }
?>
 <tr> <td><input type="checkbox"  name="check" id="f" <?php  echo $check; ?> value="<?php echo  $value->a_RoleAccessId; ?>" /> <?php echo $value->t_AccessName;  ?></td>
  <?php if($value->a_RoleAccessId==5){ ?> <td> < Rs <input type="text" name="amount" id="amoubtid" value="<?php  echo  $amount ?>"></td>   <?php }?></tr>
   <?php } ?>

</tbody>
</table>
 <!-- <input type="button" name="button" value="save" onclick="return updaterool();">  -->
</span>


<input type="submit" class="loadbtn bluebg" onclick="return updaterool();" name="submit"  value="Update">

    <div class="fix"></div>
  </div>


      </div>
    </form>
  </div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?> 


<?php }  

else {
echo 'business admin not found';


}

?>

<script>
function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}








function badminans(){
  var Mybase_url = base_url();

var ans= $('#answer').val();
var cans =$('#canswer').val();
var id = $('#adminid').val();

if (confirm("Do you want to change sequrity answre !") == true) {
  $(".loading").css('display', 'inline-block');
$.ajax({
       url: Mybase_url+'ssa/business/badminans/',
        type:'POST',
        data: { 'a_mode':'answer', 'id':id,'passans':cans},
        success: function(data){
          //console.log(data);
          $('#msg').html('Email has ben sent on the registered email id for Changing Security Answer.');
           $('#answer').val('');
            $('#canswer').val('');
             $(".loading").css('display', 'none');
        }
      });
}

}



function badminpassword(){
  var Mybase_url = base_url();

/*var password= $('#password').val();
var cpassword=$('#cpassword').val();*/
var id = $('#adminid').val();

if (confirm("Do you want to change Password !") == true) {
  $(".loading").css('display', 'inline-block');

$.ajax({
       url: Mybase_url+'ssa/business/badminpassword/',
        type:'POST',
        data: { 'a_mode':'password', 'id':id},
        success: function(data){
          //console.log(data);
 $(".loading").css('display', 'none');
$('#msg').html('Email has ben sent on the registered email id for password reset.');

  

        }
      });
}

}





function updaterool(){
var Mybase_url = base_url();
var  businessid = $('#businessid').val();
var  amount = $('#amoubtid').val();
var  createdby = $('#createdbyid').val(); 
var  admin = $('#adminid').val();
var arrcat=new Array();
$('#roolaccess tbody tr').each(function(row,tr){

if ($(tr).find('td:nth-child(1) input[type=checkbox]').is(':checked')){
arrcat[row]= { "cat_id":$(tr).find('td:nth-child(1) input[type=checkbox]').val() };
}
})
  // var savedatacat = JSON.stringify(arr);
  // alert(savedatacat);   password

 $.ajax({
       url: Mybase_url+'ssa/business/roolupdate/',
        type:'POST',
        data: { 'a_mode':'update', 'businessid':businessid,'amount':amount, 'createdby':createdby ,'admin':admin , 'roolaccs':arrcat},
        success: function(data){
          console.log(data);
          $('#msgrool').html('Rool Access updated successfully.');
        }
      });

 // alert(JSON.stringify(arr));

}







  function getstate(getid){
    var countryId = $("#country").val();
    //var countryId = $(".country"+getid).val();
    $(".loading").css('display', 'inline-block');
    $.ajax({
        url: '<?php echo base_url();?>ssa/business/state/',
        type: 'POST',
        dataType: 'json',
        data: {'countryId': countryId},
        success: function(data){
          $('#state_id').empty();   
          if(data !=0){
            $('#state_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#state_id').html(firstOption);   
            $.each(data, function(index, value) {
              var SelectData  = "<option value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
              $('#state_id').append(SelectData);
            });
            $(".loading").css('display', 'none');
          }
          if(data ==0){
            var selectData = '<option value="0">Select Country</option>';
            $('#state_id').append(selectData);
            $(".loading").css('display', 'none');
          }
        }
      });
        
  }

function getCity(getid){
    
    var stateId = $("#state_id").val();
    $(".loading").css('display', 'inline-block');
    $.ajax({
        url: '<?php echo base_url();?>ssa/business/city/',
        type: 'POST',
        dataType: 'json',
        data: {'stateId': stateId},
        success: function(data){
          $('#city_id').empty();    
          if(data !=0){
            $('#city_id').empty();
            var firstOption = '<option value="">Select City</option>';
            $('#city_id').html(firstOption);    
            $.each(data, function(index, value) {
              var SelectData  = "<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
              $('#city_id').append(SelectData);
            });
            $(".loading").css('display', 'none');
          }
          if(data ==0){
            var selectData = '<option value="0">Select State</option>';
            $('#city_id').append(selectData);
            $(".loading").css('display', 'none');
          }
        }
      });
        
  }


  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $bprofile->n_CountryId;?>';
      var getid = 1;
        $(".loading").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>ssa/business/state/',
        type: 'POST',
        dataType: 'json',
        data: {'countryId': countryId},
        success: function(data){
          $('#state_id').empty();   
          if(data !=0){
            $('#state_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#state_id').html(firstOption); 
            var checkSelected = '<?php echo $bprofile->n_StateId; ?>';  
            $.each(data, function(index, value) {
              //console.log(checkSelected);
              if(checkSelected==value.a_StateId){var selected = "selected";}else{ selected = "";}
              var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
              $('#state_id').append(SelectData);
            });
            $(".loading").css('display', 'none');
          }
          if(data ==0){
            var selectData = '<option value="0">Select State</option>';
            $('#state_id').append(selectData);
            $(".loading").css('display', 'none');
          }
        }
      });
      // end of window
    });   
  });

$(document).ready(function(){
    $(window).bind('load',function(){
      var StateId = '<?php echo $bprofile->n_StateId;?>';
      var getid = 1;
        $(".loading").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>ssa/business/city/',
        type: 'POST',
        dataType: 'json',
        data: {'stateId': StateId},
        success: function(data){
          $('#city_id').empty();    
          if(data !=0){
            $('#city_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#city_id').html(firstOption);  
            var checkSelected = '<?php echo $bprofile->n_CityId; ?>'; 
            $.each(data, function(index, value) {
             // console.log(checkSelected);
              if(checkSelected==value.a_CityId){var selected = "selected";}else{ selected = "";}
              var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
              $('#city_id').append(SelectData);
            });
            $(".loading").css('display', 'none');
          }
          if(data ==0){
            var selectData = '<option value="0">Select State</option>';
            $('#city_id').append(selectData);
            $(".loading").css('display', 'none');
          }
        }
      });
      // end of window
    });   
  });


 

$(document).ready(function(){
    $(window).bind('load',function(){
   var busid= "<?php echo $bprofile->n_BusinessId; ?>";
    //console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/empdepartment",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
          //console.log(data);
        
          if(data!='Something Went Wrong')
          {
          
            var checkSelected1 = '<?php  echo $bprofile->n_DeptId; ?>';    
            //console.log(checkSelected1);
         
          $.each(data,function (index,value){
            if(checkSelected1==value.a_DeptId){var selected = "selected";}else{ selected = "";}
         $("#department").append("<option "+selected+" value="+value.a_DeptId+">"+value.t_DeptName+"</option>");
          });
        }
        else 
        {
          $("#department").empty();

          $("#department").append("<option >No Department</option>");
        }

        }
      });
});
  });

</script>
</body>
</html>
