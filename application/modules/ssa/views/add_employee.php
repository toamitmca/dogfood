 <?php

$status=array(  '0' =>array('a_statusId'=>0,'a_staName'=>'Active'),
          '1' =>array('a_statusId'=>2,'a_staName'=>'Blocked'),

          );
?>
<section class="main_caintainer">
  <div class="leftSide" >
  <input style="width:100%;" type="text" name="search_name" placeholder="---Employee Name---" id="search_name">
    <ul class="leftmenu" id="leftSide">
        <span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
      <?php if(!empty($side)){?>
        <?php foreach ($side as $key3 => $value3) {?>
          <li><a href="<?php echo base_url(); ?>ssa/employee/edit_employee/<?php echo $value3->a_EmpId; ?>" class="" ><?php echo $value3->t_EmpFirstName.' '.$value3->t_EmpLastName ;?></a></li>
      <?php }}else{
        echo "No Records found";
        } ?>
    </ul>
  </div>
<div class="rightSide">
  <div>
    <span class="buttonWrap">
      <a href="<?php echo base_url(); ?>ssa/employee/employeelock/" class="loadbtn bluebg">Employee Listing</a>
    </span>
    <div class="fix"></div>
   <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }
?>
  </div>
  <form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>ssa/superadmin/add_employee/"> 
  
  <div class="col"><label>Status</label> 
<?php if(isset($_POST['status']))
{
  $sts =$_POST['status'];
}
else 
{
  $sts='';
}
 ?>

    <select name="status" id="status">
      <option value=''>Select a Status</option>
      <?php foreach ($status as $key9 => $value9) { ?>
      <option value="<?php echo $value9['a_statusId']; ?>" <?php if($value9['a_statusId']==$sts) {?> selected="selected" <?php } ?>><?php echo $value9['a_staName'] ?></option>
      <?php } ?>
    </select>
  </div>
  
  <div class="">
    <div class="col">
      <label>First Name</label>
     <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name')?>"  />
    </div>
    <div class="col">
      <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name')?>" />
    </div>
        <div class="col"><label>Business Name</label> 
<?php if(isset($_POST['business']))
{
  $mybus =$_POST['business'];
}
else 
{
  $mybus='';
}
 ?>
 <?php //echo $businessid_select; ?>
    <select name="business" id="business" onchange="return getpolicy(this.value)">
    <!-- set_select() -->
      <option value=''>Select Business Name</option>
      <?php foreach ($busdetail as  $value10) { ?>
      <option value="<?php echo $value10->a_BusinessId; ?>" <?php echo set_select('business', "$value10->a_BusinessId"); ?> <?php if($value10->a_BusinessId==$businessid_select) {?> selected="selected" <?php } ?>><?php echo $value10->t_BusinessName; ?></option>
      <?php } ?>
    </select>
  </div>

    <div class="col">
      <label>Policy Assigned</label> 
      <?php if(isset($_POST['policy']))
{
  $pol =$_POST['policy'];
}
else 
{
  $pol='';
}
 ?>
      <select name="policy" id="policy" onchange="return getdepartment(this.value)">
        <option value=''>Select a policy</option>
       </select>
    </div>
    <div class="col">

<?php if(isset($_POST['department']))
{
  $mdep =$_POST['department'];
}
else 
{
  $mdep='';
}
 ?>
      <label>Department</label> 
      <select name="department" id="department">
        <option value=''>Select a Department</option>
      </select>
    </div>




 
    <div class="col">
      <label>Email Id</label>
      <input type="text" name="email" id="email1"  value="<?php echo set_value('email')?>" />
      
    </div>
    <div class="col">
      <label>Employee Id</label>
      <input type="text" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id')?>" />
        <div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>

    </div>


    <div class="col">
      <label>DOB</label>
      <input type="text" id="datepicker-example1s3"  name="date_of_birth"  value="<?php echo set_value('date_of_birth')?>"/>
    </div> 
    <div class="col">
      <label>Office Phone </label>
      <input type="text" name="office_phone" id="office_phone" onkeypress="return isNumber(event);" maxlength="15" value="<?php echo set_value('office_phone')?>"  />
    </div>
    <div class="col">
      <label>Mobile Phone </label> 
      <input type="text" name="mobile_phone" id="mobile_phone" onkeypress="return isNumber(event);" maxlength="11" value="<?php echo set_value('mobile_phone')?>" />
    </div>
    <div class="col">
      <label>Address Line1</label>
      <input type="text" name="address_line1" id="address_line1" value="<?php echo set_value('address_line1')?>"  />
    </div>
    <div class="col">
      <label>Address Line2</label>
      <input type="text" name="address_line2" id="address_line2"  value="<?php echo set_value('address_line2')?>" />
    </div>
    <div class="col">
      <label>Address Line3</label>
      <input type="text" name="address_line3" id="address_line3" value="<?php echo set_value('address_line3')?>" />
    </div>
    <div class="col">
    <?php // COUNTRY
    if(isset($_POST['n_CountryId_1'])) {
      $con=$_POST['n_CountryId_1'];
      }
      else
      {
        $con='';
        }
// STATE
      if(isset($_POST['state_id'])) {
      $rst=$_POST['state_id'];
      }
      else
      {
        $rst='';
        }
// CITY
      if(isset($_POST['city_id'])) {
      $rct=$_POST['city_id'];
      }
      else
      {
        $rct='';
        }
         ?>
      <label>Country</label>
                
           <?php echo country('list',$con,1); ?>
        
    </div>
    <div class="col">
      <label>State</label> 
      <select name="state_id" id="state_id" onchange="return getcity(this.value);">
        <option value="">Select a State</option>
        
        
      </select>
    </div>
    <div class="col">
      <label>City</label>
        <select name="city_id" id="city_id1">
          <option value="">Select a City</option>
          
          </option>
        
        </select>
    </div>

  <div class="col">
    <label>PIN Code</label>
    <input type="text" name="pin_code" id="pin_code" value="<?php echo set_value('pin_code')?>"  />
  </div>
  <div></div>
  <div class="right_top">
    <span class="buttonWrap">
      <input type="submit" class="loadbtn bluebg" name="submit" id="submit" value="Save">
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
        $("#email1").parent().find('span').remove();
        $.ajax({
          url: MybaseUrl+'business/dashboard2/checkemail',
          type: 'POST',
          dataType: 'json',
          data: {'email':emailId},
          success:function(data){
            //console.log(data);
            if(data.emailcorrect >0){
              $("#email1").after('<span>Already have an account with this mail id</span>');
              $("#email1").parent().find('span').not("span:first").remove();
              $(".loadingemail").css('display', 'none');
                $("#submit").attr('disabled', 'disabled');
            }else{
               $("#submit").attr('disabled', false);
              $(".loadingemail").css('display', 'none');
            }
            
          }
        });
      
      }else{
        $("#email1").after('<span>Please Enter Valid Email</span>');
        $("#email1").parent().find('span').not("span:first").remove();
      }
      
  });



$("#employee_id").on('keyup' , function(){
      var  empID = $("#employee_id").val();
      var MybaseUrl = "<?php echo base_url();?>"
      console.log(empID);
      $(".loadingemail").css('display', 'block');
      $("#employee_id").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard2/empidcheck',
        type: 'POST',
        dataType: 'json',
        data: {'empid':empID},
        success:function(data){
          //console.log(data);
          if(data.empcode >0){
            $("#employee_id").after('<span>This Employee Id Already Exist Try Another</span>');
            $("#employee_id").parent().find('span').not("span:first").remove();
             $("#submit").attr('disabled', 'disabled');

            $(".loadingemail").css('display', 'none');
          }else{
             $("#submit").attr('disabled', false);

            $(".loadingemail").css('display', 'none');
          }
          
        }
      });
  });

 function getstate (){
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country").val();
    console.log(countryId);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/getStateDropDown",
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
  }


  function getcity()
  {
    $("#city_id1").empty();
    $("#city_id1").html("<option value=''>Select a City</option>");
    var stateId=$("#state_id").val();
    console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/getCityDropDown",
      type: 'POST',
      data: { id : stateId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);

              $.each(data,function (index,value){
        $("#city_id1").append("<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  }
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







 function getpolicy()
  { var busid=$("#business").val();
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/emppolicy",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
          console.log(data);
          if(data!='Something Went Wrong')
          {
          $("#policy").empty();
          $("#policy").append("<option >Select Policy</option>");
          $.each(data,function (index,value){
          $("#policy").append("<option value="+value.a_PolicyId+">"+value.t_PolicyName+"</option>");
          });
        }
        else 
        {
          var ok=confirm("There is no Policy has been Created for this business \n Would you like to create the policy?");
          if(ok){
            window.location.href="<?php echo base_url(); ?>ssa/policy/policyadd";
          }else{
            $(".loadbtn").hide();
          }
          $("#policy").empty();
          $("#policy").append("<option >Select Policy</option>");
          $("#policy").append("<option >No Policy</option>"); 
        }
           
        }
      });
  }
 function getdepartment()
  { var busid=$("#business").val();
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/empdepartment",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
      success: function (data) {
              console.log(data);
               if(data!='Something Went Wrong')
               {
              $("#department").empty();
              $("#department").append("<option >Select Department</option>");
              $.each(data,function (index,value1){
              $("#department").append("<option value="+value1.a_DeptId+">"+value1.t_DeptName+"</option>");
              });
            }
            else 
            {
              $("#department").empty();
              $("#department").append("<option >Select Department</option>");
              $("#department").append("<option >No Department</option>");

            }
            }
          });
        }


// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = "<?php echo $con; ?>";
        console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
        url: '<?php echo base_url();?>ssa/superadmin/getStateDropDown',
        type: 'POST',
        dataType: 'json',
        data: {'id': countryId},
        success: function(data){
          console.log(data);
          $('#state_id').empty();   
          if(data !=0){
            $('#state_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#state_id').html(firstOption); 
            var checkSelected = "<?php  echo $rst; ?>";  
            console.log("Karan ="+checkSelected);
            $.each(data, function(index, value) {
               if(checkSelected==value.a_StateId){var selected = "selected";}else{ selected = "";}
              var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
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

      // end of window
    });   
  });
// END STATE SELECTED CODE 


// START BYDEFAULT CITY SELECTED CODE
$(document).ready(function(){
    $(window).bind('load',function(){
      var stateId = '<?php  echo $rst; ?>';
    
      //console.log(stateId);
    $.ajax({
        url: '<?php echo base_url();?>ssa/superadmin/getCityDropDown',
        type: 'POST',
        dataType: 'json',
        data: {'id': stateId},
        success: function(data){
          console.log(data);
          $('#city_id1').empty();    
          if(data !=0){
            $('#city_id1').empty();
            var firstOption = '<option value="">Select State First</option>';
            $('#city_id1').html(firstOption);  
            var checkSelected1 = '<?php  echo $rct; ?>';    
            $.each(data, function(index, value) {
              console.log(checkSelected1);
               if(checkSelected1==value.a_CityId){var selected = "selected";}else{ selected = "";}
              var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
              $('#city_id1').append(SelectData);
            });
            $(".loading").css('display', 'none');
          }
          if(data ==0){
            var selectData = '<option value="0">Select State</option>';
            $('#city_id1').append(selectData);
            $(".loading").css('display', 'none');
          }

        }
      });
      // end of window
    });   
  });

$(document).ready(function(){
    $(window).bind('load',function(){
   var busid= "<?php echo $mybus; ?>";
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/emppolicy",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
          console.log(data);
        
          if(data!=0)
          {
          
            var checkSelected1 = '<?php  echo $pol; ?>';    
         
          $.each(data,function (index,value){
            if(checkSelected1==value.a_PolicyId){var selected = "selected";}else{ selected = "";}
          $("#policy").append("<option "+selected+" value="+value.a_PolicyId+">"+value.t_PolicyName+"</option>");
          });
        }
        else 
        {
          $("#policy").empty();
         
          $("#policy").append("<option >No Policy</option>"); 
        }
           
        }
      });
});
  });


$(document).ready(function(){
    $(window).bind('load',function(){
    var busid= "<?php echo $mybus; ?>";
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/empdepartment",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
          console.log(data);
        
          if(data!=0)
          {
          
            var checkSelected1 = '<?php  echo $mdep; ?>';    
         
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
 

 //##### sheetesh start here #########
/*function getempdetailshe()
{
    var busid       =  $("#business").val();
    var policy      =  $("#policy").val();
    var department  =  $("#department").val();
    var email1      =  $("#email1").val();
    
    $.ajax({
      url: "<?php echo base_url();?>ssa/employee/getEmpdetail",
      type: 'POST',
      data: { 'busid' : busid , 'policy' : policy , 'department' : department , 'email1' : email1},
      async: true,
      dataType: "json",
      success: function (data) {
      if(data.empcheck >0){
         alert("YOU CAN  NOT CREATED WITH SAME Business Policy Department And Email Id");
        }
      }

        });
}*/

 //##### sheetesh start end #########

</script>
</body>
</html>
