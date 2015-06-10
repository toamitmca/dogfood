<?php 

$department=array(  '0' =>array('a_depId'=>1,'a_depName'=>'Department1'),
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
$status=array(  '0' =>array('a_statusId'=>1,'a_staName'=>'Active'),
          '1' =>array('a_statusId'=>0,'a_staName'=>'Inactive'),

          );

//p($profile);
//exit;
//echo $profile->t_EmpFirstName;
// echo "</br>";
// p($assignedRole);
 //exit();
//echo $pincode;
//p($country);
//exit();
?>
<section class="main_caintainer">
   <?php $this->load->view('profileleft'); ?>

<div class="rightSide" >
  <div>

    <div class="fix"></div>
  </div>
  <form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>employee/profile/profileedit/"> 

   <div class="col">
    <label>Status</label>
    <input type="text" name="status" id="status" readonly="readonly" value="<?php if($profile->n_Status==1) { echo "Active"; } else { echo "Decative" ;} ?>"/>
  </div>

  <!-- <div class="col">
    <label>Lasted updated by user Name</label>
    <input type="text" name="user_name" id="user_name" readonly="readonly" value="<?php //echo  $profile->d_ModifiedOn; ?>"/>
  </div> -->
  <div class="">
    <div class="col">
      <label>First Name</label>
      <input type="text" name="first_name" id="first_name" readonly="readonly" value="<?php echo $profile->t_EmpFirstName; ?>"/>
    </div>
    <div class="col">
      <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" readonly="readonly" value="<?php echo $profile->t_EmpLastName; ?>" />
    </div>
    <div class="col">
    <label>Policy</label>
     <?PHP echo policy('list' ,$profile->n_PolicyId ,$profile->n_BusinessId); ?>
     </div>

   <div class="col">
    <label>Department</label>
    <?PHP echo department('list' ,$profile->n_DeptId ,$profile->n_BusinessId); ?>
   
  </div>


    <div class="col">
      <label>Employee Id</label>
      <input type="text" name="employee_id" id="employee_id" readonly="readonly" value="<?php echo $profile->t_EmpCode; ?>"/>
    </div>
    <div class="col">
      <label>DOB</label>
      <input type="text" id="" readonly="readonly" name="date_of_birth" value="<?php echo $profile->d_EmpDOB; ?>"/>
    </div>
    <div class="col">
      <label>Office Phone </label>
      <input type="text" name="office_phone" id="office_phone"  value="<?php echo  $profile->t_OfficePhone; ?>" />
    </div>
    <div class="col">
      <label>Mobile Phone </label>
      <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $profile->t_MobilePhone; ?>" />
    </div>
    <div class="col">
      <label>Address Line1</label>
      <input type="text" name="address_line1" id="address_line1" value="<?php echo $profile->t_AddfLine; ?>" />
    </div>
    <div class="col">
      <label>Address Line2</label>
      <input type="text" name="address_line2" id="address_line2" value="<?php echo $profile->t_AddSecLine;?>"/>
    </div>
    <div class="col">
      <label>Address Line3</label>
      <input type="text" name="address_line3" id="address_line3" value="<?php echo $profile->t_AddThirdLine; ?>"/>
    </div>
    <div class="col">
      <label>Country</label>
      <?php echo country('list',$profile->n_CountryId,1) ?>
        
    </div>
    <div class="col">
      <label>State</label> 
<input type="hidden" id='get_state' value="<?php echo $profile->n_StateId; ?>">

      <select name="state_id" id="state_id">
        <option value="">Select a State</option>
       
      </select>
      <span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
    </div>
    <div class="col">
    <input type="hidden" id='get_city' value="<?php echo $profile->n_CityId; ?>">
      <label>City</label>
        <select name="city_id" id="city_id" >
          <option value="">Select a City</option>
        
        </select>
        <span class="loading1" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
    </div>

  <div class="col">
    <label>PIN Code</label>
    <input type="text" name="pin_code" id="pin_code" value="<?php echo $profile->n_PinCode ?>" />
  </div>

   <div class="col">
    <label>Security Ans</label>
    <input type="password" name="seq_code" id="seq_code" value="<?php echo $profile->n_seqAns ?>" />
  </div>
  <div></div>
  <div class="right_top">
    <span class="buttonWrap">
      <button type="submit" class="loadbtn bluebg" name="submit">Update</button>
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

function getstate(getid)
{
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country").val();
    console.log(countryId);
    //var getstateId = $("#get_state").val();
    //console.log(getstateId);
    //console.log(countryId);
    $.ajax({
      url: "<?php echo base_url();?>employee/profile/getStateDropDown",
      type: 'POST',
      data: { 'id' : countryId },
      
        dataType: "json",
      success: function (data) {
            console.log(data);
              $.each(data,function (index,value){
                
             $("#state_id").append("<option value='"+value.a_StateId+"'>"+value.t_StateName+"</option>");
        });
           }
      });
  }


  $("#state_id").on('change',function(){
    $("#city_id").empty();
    $("#city_id").html("<option value=''>Select a City</option>");
    var stateId=$("#state_id").val();
    //console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>employee/profile/getCityDropDown",
      type: 'POST',
      data: { id : stateId },
      
      dataType: "json",
      success: function (data) {
            //console.log(data);

              $.each(data,function (index,value){
        $("#city_id").append("<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  });

// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $profile->n_CountryId;?>';
      var getid = 1;
     console.log(countryId);
        $(".loading").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>employee/profile/getStateDropDown',
        type: 'POST',
        dataType: 'json',
        data: {'id': countryId},
        success: function(data){
         // console.log(data);
          $('#state_id').empty();   
          if(data !=0){
            $('#state_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#state_id').html(firstOption); 
            var checkSelected = '<?php echo $profile->n_StateId; ?>';  
            $.each(data, function(index, value) {
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
// END STATE SELECTED CODE 

// START BYDEFAULT CITY SELECTED CODE
$(document).ready(function(){
    $(window).bind('load',function(){
      var stateId = '<?php echo $profile->n_StateId;?>';
      
      //console.log(stateId);
        $(".loading1").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>employee/profile/getCityDropDown',
        type: 'POST',
        dataType: 'json',
        data: { id : stateId },
        success: function(data){
          $('#city_id').empty();   
          if(data !=0){
            $('#city_id').empty();
            var firstOption = '<option value="">Select City</option>';
            $('#city_id').html(firstOption); 
            var checkSelectedcity = '<?php echo $profile->n_CityId; ?>';  
            //console.log(checkSelectedcity);
            $.each(data, function(index, value) {
              if(checkSelectedcity==value.a_CityId){var selected = "selected";}else{ selected = "";}
              var SelectcityData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
              $('#city_id').append(SelectcityData);
            });
            $(".loading1").css('display', 'none');
          }
          if(data ==0){
            var SelectcityData = '<option value="0">Select City</option>';
            $('#city_id').append(SelectcityData);
            $(".loading1").css('display', 'none');
          }
        }
      });
      // end of window
    });
  });

// FOR DESABLED POLICY
 $(document).ready(function(){
    $(window).bind('load',function(){
      $("#policy").attr('disabled', 'disabled');
    });
  });
// FOR DESABLED DEPARTMENT
  $(document).ready(function(){
    $(window).bind('load',function(){
      $("#department").attr('disabled', 'disabled');
    });
  });




  $(document).ready(function() {
var  checkflogin ="<?php echo $firstlogin->fpasschange; ?>"
var myurl ="<?php echo base_url();?>";
if(checkflogin==3){
 alert("Please change the  Security answer ");
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
</script>
</body>
</html>
