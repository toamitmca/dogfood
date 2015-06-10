<?php 
$userId= checklogin();
$businessId=$userId['n_BusinessId'];





/*$department=array(  '0' =>array('a_depId'=>1,'a_depName'=>'Department1'),
          '1' =>array('a_depId'=>2,'a_depName'=>'Department2'),
          '2' =>array('a_depId'=>3,'a_depName'=>'Department3'),
          '3' =>array('a_depId'=>4,'a_depName'=>'Department4'),
          '4' =>array('a_depId'=>5,'a_depName'=>'Department5'),
          );
$policy=array(  '0' =>array('a_policyId'=>1,'a_polName'=>'policy1'),
          '1' =>array('a_policyId'=>2,'a_polName'=>'policy2'),
          '2' =>array('a_policyId'=>3,'a_polName'=>'policy3'),
          '3' =>array('a_policyId'=>4,'a_polName'=>'policy4'),
          '4' =>array('a_policyId'=>5,'a_polName'=>'policy5'),
          );
$status=array(  '0' =>array('a_statusId'=>0,'a_staName'=>'Active'),
          '1' =>array('a_statusId'=>2,'a_staName'=>'Blocked'),

          );
*/
          ?>
          <?php // echo $_POST['country_id']; ?>
<section class="main_caintainer">
  <div class="leftSide" >
  <input style="width:100%;" type="text" name="search_name" placeholder="---Employee Name---" id="search_name">
    <ul class="leftmenu" id="leftSide">
        <span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
      <?php if(!empty($side)){?>
        <?php foreach ($side as $key3 => $value3) {?>
          <li><a href="<?php echo base_url(); ?>business/dashboard/edit_employee/<?php echo $value3->a_EmpId; ?>" class="" ><?php echo $value3->t_EmpFirstName.' '.$value3->t_EmpLastName ;?></a></li>
      <?php }}else{
        echo "No Records found";
        } ?>
    </ul>
  </div>
<div class="rightSide">
  <div>
    <span class="buttonWrap">
      <a href="<?php echo base_url(); ?>business/dashboard/add_employee/" class="loadbtn bluebg">Add Employee</a>
    </span>
    <div class="fix"></div>
   <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }
?>
  </div>
  <form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>business/dashboard/add_employee/"> 
  
  <div class="col"><label>Status</label> 
    <select  name="status" id="status">
      <option value=''>Select a Status</option>
     <!--  <?php  //foreach ($status as $key9 => $value9) { ?>
      <option value="<?php  //echo $value9['a_statusId']; ?>"><?php // echo $value9['a_staName'] ?></option>
      <?php //} ?> -->
      <option value="0"  <?php echo set_select('status', '0'); ?> >Active</option>
      <option value="2"  <?php echo set_select('status', '2'); ?> >Blocked</option>
    </select>
  </div>
 
  <div class="formPreExp">
    <div class="col">
      <label>First Name</label>
     <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name');?>"/>
    </div>
    <div class="col">
      <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name');?>"/>
    </div>

    <div class="col">
      <label>Policy Assigned</label>
   <?php
                  if(!empty($_POST['policy'])){
                  $policyid=$_POST['policy'];
                  }
                  else{
                  $policyid=0;
                  }
          ?>
<?php echo policy('list',$policyid,$userId['n_BusinessId']); ?>
      </select>
    </div>
    <div class="col">
      <label>Department</label>
<?php
                  if(!empty($_POST['department'])){
                  $departmentid=$_POST['department'];
                  }
                  else{
                  $departmentid=0;

                  }

 ?>



      <?php echo department('list',$departmentid,$userId['n_BusinessId']); ?>
    </div>
    <div class="col">
      <label>Email Id</label>
      <input type="hidden" name="unikemail" id="unikemail" value="">
         <input type="text" name="email" id="email1" autocomplete="off" value="<?php echo set_value('email');?>"/>
        <span id="email1_msg" style="position: absolute;top: -7px; right: 20px;"> </span>
        </div>
    <div class="col">
      <label>Employee Id</label>
      <input type="hidden" name="unikeempcode" id="unikeempcode" value="">
      <input type="text" name="employee_id" id="employee_id" autocomplete="off" value="<?php echo set_value('first_name');?>"/>
      <span id="employee_id_msg" style="position: absolute;
top: -7px;
right: 20px;"> </span>
        <!-- <div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div> -->

    </div>


    <div class="col">
      <label>DOB</label>
      <input type="text" id="datepicker-example1s3" name="date_of_birth" value="<?php echo set_value('date_of_birth');?>"/>
    </div> 
    <div class="col">
      <label>Office Phone </label>
      <input type="text" name="office_phone" id="office_phone"  value="<?php echo set_value('office_phone');?>"/>
    </div>
    <div class="col">
      <label>Mobile Phone </label>
      <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo set_value('mobile_phone');?>"/>
    </div>
    <div class="col">
      <label>Address Line1</label>
      <input type="text" name="address_line1" id="address_line1"  value="<?php echo set_value('address_line1');?>"/>
    </div>
    <div class="col">
      <label>Address Line2</label>
      <input type="text" name="address_line2" id="address_line2" value="<?php echo set_value('address_line2');?>"/>
    </div>
    <div class="col">
      <label>Address Line3</label>
      <input type="text" name="address_line3" id="address_line3" value="<?php echo set_value('address_line3');?>"/>
    </div>
	




    <div class="col">
      <label>Country</label>
        <select name="country_id" id="country_id">
          <option value="">Select a Country</option>
          <?php foreach ($country as $key => $value) {?>
             <option value="<?php echo $value->a_CountryId; ?>" >  <?php echo $value->t_CountryName; ?></option>
          <?php } ?>
        </select>
    </div>
    <div class="col">

<?php
                  if(!empty($_POST['state_id'])){
                  $pstateid=$_POST['state_id'];
                  }
                  else{
                  $pstateid=0;
                  }
          ?>

      <label>State</label> 
      <select name="state_id" id="state_id" >
        <option value="">Select a State</option>
        
        
      </select>
    </div>
    <div class="col">

<?php
                  if(!empty($_POST['city_id'])){
                  $pcityid=$_POST['city_id'];
                  }
                  else{
                  $pcityid=0;
                  }
          ?>



      <label>City</label>
        <select name="city_id" id="city_id">
          <option value="">Select a City</option>
          
          </option>
        
        </select>
    </div>

  <div class="col">
    <label>PIN Code</label>
    <input type="text" name="pin_code" id="pin_code"  value="<?php echo set_value('pin_code');?>"/>
  </div>
  <div></div>
  <div class="right_top">
    <span class="buttonWrap">
      <input type="submit" class="loadbtn bluebg" name="submit" value="Save">
    </span>
    <div class="fix"></div>
  </div>
<!--<h2 class="genHead">Milage</h2>

<div class="right_top">&nbsp;</div>
<h2 class="genHead">Period Spending Limits</h2>

<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Spending Limits</a></span>
<div class="fix"></div></div>
<h2 class="genHead">Period Category Restrictions</h2>
<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Category Restrictions</a></span>
<div class="fix"></div></div>-->
      </div>
    </form>
  </div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#search_name").empty();
});

$("#email1").on('keyup' , function(){
  var emailId = $("#email1").val();
    var MybaseUrl = "<?php echo base_url();?>";
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    //console.log(emailId);
    if(emailId==''){
      return false;
    }
    if(filter.test(emailId)){
      $(".loadingemail").css('display', 'block');
      $("#email1_msg").empty();
       var businessId="<?php echo $businessId;?>";
      $.ajax({
        url: MybaseUrl+'business/dashboard/checkemail',
        type: 'POST',
        dataType: 'json',
        data: {'act_mode':'employee','businessid':businessId, 'email':emailId},
        success:function(data){
          console.log(data);
          if(data.emailcorrect >0){
             $('#unikemail').val('');
            $("#email1_msg").html('Already have an account with this mail id');
            $("#email1").parent().find('span').not("span:first").remove();
            $(".loadingemail").css('display', 'none');
          }else{
            $('#unikemail').val('1');
            $(".loadingemail").css('display', 'none');
          }

        }
      });
    }else{
      $("#email1_msg").html("Please Enter Valid Email");
      $("#email1").parent().find('span').not("span:first").remove();
    }
});



$("#employee_id").on('keyup' , function(){
      var  empID = $("#employee_id").val();
      var businessId="<?php echo $businessId;?>";
      var MybaseUrl = "<?php echo base_url();?>";
      console.log(empID);
      console.log(businessId);
      $(".loadingemail").css('display', 'block');
      $("#employee_id_msg").empty();
      $.ajax({
        url: MybaseUrl+'business/dashboard/empidcheck',
        type: 'POST',
        dataType: 'json',
        data: { 'act_mode':'employee', 'empid':empID,'businessId': businessId},
        success:function(data){
          console.log(data);
          if(data.empcode >0){
            $('#unikeempcode').val('');
            $("#employee_id_msg").html('This Employee Id Already Exist Try Another');
            $("#employee_id").parent().find('span').not("span:first").remove();
            $(".loadingemail").css('display', 'none');
          }else{
            $('#unikeempcode').val('1');
            $(".loadingemail").css('display', 'none');
          }

        }
      });

});


$("#country_id").on('change',function(){
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country_id").val();
    console.log(countryId);
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getStateDropDown",
      type: 'POST',
      data: { id : countryId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);

              $.each(data,function (index,value){
        $("#state_id").append("<option value='"+value.a_StateId+"'>"+value.t_StateName+"</option>");
        });
           }
      });
  });

  $("#state_id").on('change',function(){
    $("#city_id").empty();
    $("#city_id").html("<option value=''>Select a City</option>");
    var stateId=$("#state_id").val();
    console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getCityDropDown",
      type: 'POST',
      dataType:'JSON',
      data: { 'id' : stateId },
      success: function (data) {
            console.log(data);
      $.each(data,function (index,value){
        $("#city_id").append("<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  });
  
$("#search_name").on('keyup',function(){
  var searchValue=$("#search_name").val();
  //console.log(searchValue);
  if(searchValue!=''){
    searchValue=searchValue;
  }else{
      console.log("hi");
      // console.log(searchValue);
      searchValue="";
    }
    $("#myloading").css('display','block');
    $.ajax({
        url: "<?php echo base_url();?>business/dashboard/searchName",
        type: 'POST',
        data: { name : searchValue },
        async: true,
          dataType: "json",
        success: function (data) {
          $("#myloading").css('display','none');
              console.log(data);
            if(data!=null){  
               $("#leftSide").empty();
          $.each(data,function (index,value){
            var list ="<li>";
              list +="<a href=<?php echo base_url(); ?>business/dashboard/edit_employee/"+value.a_EmpId+">"+value.t_EmpFirstName+' '+value.t_EmpLastName+"</a>";
              list +="</li>";
            $("#leftSide").append(list);
          });
        }else{
            $("#leftSide").html('<p>No Result Found</p>');
             }

        }
        });
});

/*countyr state selected*/

$(document).ready(function(){
    $(window).bind('load',function(){
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country_id").val();
    console.log(countryId);
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getStateDropDown",
      type: 'POST',
      data: { id : countryId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);
             var checkSelected = '<?php echo $pstateid; ?>';
              $.each(data,function (index,value){
                if(checkSelected==value.a_StateId){var selected = "selected";}else{ selected = "";}
        $("#state_id").append("<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>");
        });
           }
      });
  });
});

 $(document).ready(function(){
    $(window).bind('load',function(){
    $("#city_id").empty();
    $("#city_id").html("<option value=''>Select a City</option>");
    var stateId=<?php echo $pstateid; ?>;
    console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getCityDropDown",
      type: 'POST',
      data: { id : stateId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);
           var checkSelectedcity = '<?php echo $pcityid; ?>';
              $.each(data,function (index,value){
                if(checkSelectedcity==value.a_CityId){var selected = "selected";}else{ selected = "";}
        $("#city_id").append("<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  });
});

</script>
</body>
</html>
