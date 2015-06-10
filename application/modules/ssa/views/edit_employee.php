<?php 

$status=array(  '0' => array('a_statusId' => 0, 'a_staName' => 'Active'),
                '1' => array('a_statusId' => 2, 'a_staName' => 'Blocked'),
             );
//exit();
  $a_EmpId=$viewEmp->a_EmpId;
	$empCode=$viewEmp->t_EmpCode;
	$empFirstName=$viewEmp->t_EmpFirstName;
	$empLastName=$viewEmp->t_EmpLastName;
	$statusCon=$viewEmp->n_Status;
	$depId=$viewEmp->n_DeptId;
	$policyId=$viewEmp->n_PolicyId;
	$officePhone=$viewEmp->t_OfficePhone;
	$mobilePhone=$viewEmp->t_MobilePhone;
	$empDob=$viewEmp->d_EmpDOB;
	$address1=$viewEmp->t_AddfLine;
	$address2=$viewEmp->t_AddSecLine;
	$address3=$viewEmp->t_AddThirdLine;
	$countrySelected=$viewEmp->n_CountryId;
	$stateSelected=$viewEmp->n_StateId;
	$citySelected=$viewEmp->n_CityId;
	$pincode=$viewEmp->n_PinCode;
  $b_Deleted=$viewEmp->b_Deleted;

// p($empData);
// echo "</br>";
// p($assignedRole);
// exit();
//echo $pincode;
?>
<section class="main_caintainer">
	<div class="leftSide" ></div>
	
<div class="rightSide">
      <span class="buttonWrap">
			<a href="<?php echo base_url(); ?>ssa/superadmin/add_employee/" class="loadbtn">Add Employee</a>
		</span>
	 <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }
?>
	<form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $a_EmpId; ?>">
	<input type="hidden" name="business_id" value="<?php echo  $viewEmp->n_BusinessId ;?>">
	<input type="hidden" name="emp_id" id="emp_id" value="<?php echo  $viewEmp->a_EmpId; ?>">

    <div class="right_top right_topss1"><h2 id="changePass" class="secIcon">Change password & Security answer</h2></div>
<table class="tabS toggpas">
<tr>
<td><button type="button" class="loadbtn bluebg" name="submit1" onclick="return badminpassword(this.value)">Change Password</button></td><td><span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span> </td>
<td><button type="button" class="loadbtn bluebg" onclick ="return badminans(this.value)">Change Security Answer</button></td>
</tr>
<!--<tr><td><button type="button" class="loadbtn bluebg" onclick ="return badminans(this.value)">Change Security Answer</button></td></tr>
-->
</table>
<div id="msgerr" style="color:green;"></div>


<!-- <div class="right_top right_topss1"><h2 class="secIcon">CHANGE SECURITY</h2></div>
<table class="tabS toggpas">
<tr>
<td><input type="text" name="answer" id="answer" placeholder="ENTER YOUR ANSWER"></td>
<td><input type="text" name="canswer" id="canswer" placeholder="ENTER YOUR CONFIRM ANSWER" ></td>

</tr>
</table> -->

<div id="msg"></div>
	<div class="col"><label>Status</label> 
		<select name="status" id="status">
			<option value=''>Select a Status</option>

		<option value="o" <?php if($b_Deleted==0){ echo 'selected="selected"';}  ?> >Active</option>
    <option value="2" <?php if($b_Deleted==2){ echo 'selected="selected"';}  ?> >Blocked</option>
		</select>
	</div>
	<!-- <div class="col">
		<label>Lasted updated by user Name</label>
		<input type="text" name="user_name" id="user_name" readonly="readonly" value="xyz"/>
	</div> -->
	<div class="">
		<div class="col">
			<label>First Name</label>
			<input type="text" name="first_name" id="first_name" value="<?php echo $empFirstName; ?>"/>
		</div>
		<div class="col">
			<label>Last Name</label>
				<input type="text" name="last_name" id="last_name" value="<?php echo $empLastName; ?>" />
		</div>
		<div class="col">
			<label>Policy Assigned</label> 
			<select name="policy" id="policy">
				<option value=''>Select a policy</option>
				
				
			</select>
		</div>
		<div class="col">
			<label>Department</label> 
			<select name="department" id="department">
				<option value=''>Select a Department</option>
				

				
			</select>
		</div>
	
		<div class="col">
			<label>Employee Id</label>
			<input type="text" name="employee_id" id="employee_id" value="<?php echo $empCode; ?>"/>
		</div>
		<div class="col">
			<label>DOB</label>
			<input type="text" id="datepicker-example1s3" style="width:100%;" name="date_of_birth" value="<?php echo $empDob; ?>"/>
		</div> 
		<div class="col">
			<label>Office Phone </label> 
			<input type="text" name="office_phone" id="office_phone" onkeypress="return isNumber(event);" maxlength="15"  value="<?php echo $officePhone; ?>" />
		</div>
		<div class="col">
			<label>Mobile Phone </label>
			<input type="text" name="mobile_phone" onkeypress="return isNumber(event)" id="mobile_phone" maxlength="11" value="<?php echo $mobilePhone; ?>" />
		</div>
		<div class="col">
			<label>Address Line1</label>
			<input type="text" name="address_line1" id="address_line1" value="<?php echo $address1; ?>" />
		</div>
		<div class="col">
			<label>Address Line2</label>
			<input type="text" name="address_line2" id="address_line2" value="<?php echo $address2; ?>"/>
		</div>
		<div class="col">
			<label>Address Line3</label>
			<input type="text" name="address_line3" id="address_line3" value="<?php echo $address3; ?>"/>
		</div>
		<div class="col">
      <label>Country</label>

           <?php echo country('list',$countrySelected,1); ?>

    </div>
		<div class="col">
			<label>State</label> 
			<select name="state_id" id="state_id" onchange="return getcity(this.value)">
				<option value="">Select a State</option>

			</select>

		</div>
		<div class="col">
			<label>City</label>
				<select name="city_id" id="city_id1">
					<option value="">Select a City</option>

				</select>

    </div>
		</div>

	<div class="col">
		<label>PIN Code</label>
		<input type="text" name="pin_code" id="pin_code" value="<?php echo $pincode; ?>" />
	</div>
	<div></div>
	<div class="right_top">
		<span class="buttonWrap">
			<button type="submit" class="loadbtn bluebg" name="submit">Update </button>
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
			
		</form>
	</div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">

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
            //console.log(data);
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
          //  console.log(data);

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
			//console.log("hi");
			// console.log(searchValue);
			searchValue="";
		}
		$.ajax({
			  url: "<?php echo base_url();?>business/dashboard/searchName",
			  type: 'POST',
			  data: { name : searchValue },
			  //async: true,
	    	  //dataType: "json",
	    	  async: true,
	    	  dataType: "json",
			  success: function (data) {
	        	 // console.log(data);
	        	if(data!=null){  
	        	   $("#leftSide").empty();
					$.each(data,function (index,value){
						var list="<ul>";
							list +="<li>";
							list +="<a href=<?php echo base_url(); ?>business/dashboard/edit_employee/"+value.a_EmpId+">"+value.t_EmpFirstName+' '+value.t_EmpLastName+"</a>";
							//list +=value.t_EmpFirstName+' '+value.t_EmpLasttName;
							//list +=list;
							list +="</li>";
							list +="</ul>";
						$("#leftSide").append(list);
					});
				}else{
				    $("#leftSide").html('<p>No Result Found</p>');
				     }
				    
				}
		    });

});

 


// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $countrySelected;?>';
      var getid = 1;
      //console.log(countryId);
        $(".loading").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>ssa/superadmin/getStateDropDown',
        type: 'POST',
        dataType: 'json',
        data: {'id': countryId},
        success: function(data){
          $('#state_id').empty();   
          if(data !=0){
            $('#state_id').empty();
            var firstOption = '<option value="">Select State</option>';
            $('#state_id').html(firstOption); 
            var checkSelected = '<?php echo $stateSelected; ?>';  
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
      var stateId = '<?php echo $stateSelected;?>';
      
      //console.log(stateId);
        $(".loading1").css('display', 'inline-block');
        $.ajax({
        url: '<?php echo base_url();?>ssa/superadmin/getCityDropDown',
        type: 'POST',
        dataType: 'json',
        data: { id : stateId },
        success: function(data){
          $('#city_id1').empty();   
          if(data !=0){
            $('#city_id1').empty();
            var firstOption = '<option value="">Select City</option>';
            $('#city_id1').html(firstOption); 
            var checkSelectedcity = '<?php echo $citySelected; ?>';  
            //console.log(checkSelectedcity);
            $.each(data, function(index, value) {
              if(checkSelectedcity==value.a_CityId){var selected = "selected";}else{ selected = "";}
              var SelectcityData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
              $('#city_id1').append(SelectcityData);
            });
            $(".loading1").css('display', 'none');
          }
          if(data ==0){
            var SelectcityData = '<option value="0">Select City</option>';
            $('#city_id1').append(SelectcityData);
            $(".loading1").css('display', 'none');
          }
        }
      });
      // end of window
    });   
  });


function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}


function badminans(){
  var Mybase_url ="<?php echo base_url()?>";
//alert('asddasd');
var ans= $('#answer').val();
var cans =$('#canswer').val();
var id = $('#emp_id').val();

/*if(ans !==cans){ 
alert('not match');
return false;
}*/
if (confirm("Do you want to change sequrity answre !") == true) {
  $(".loading").css('display', 'inline-block');

$.ajax({
       url: Mybase_url+'ssa/superadmin/empadminans/',
        type:'POST',
        data: { 'a_mode':'eanswer', 'id':id,'passans':cans},
        success: function(data){
          console.log(data);
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
//alert('asddasd');
var password= $('#password').val();
var cpassword=$('#cpassword').val();
var id = $('#emp_id').val();

if (confirm("Do you want to change password !") == true) {
  $(".loading").css('display', 'inline-block');
       // x = "You pressed OK!";
  /*else {
        x = "You pressed Cancel!";
    }*/
$.ajax({
       url: Mybase_url+'ssa/superadmin/empnpassword/',
        type:'POST',
        data: { 'a_mode':'epassword', 'id':id},
        success: function(data){
         $(".loading").css('display', 'none');
		$('#msgerr').html('Email has ben sent on the registered email id for password reset.');
       }
      });
   }

}

$(document).ready(function(){
    $(window).bind('load',function(){
      var busid = '<?php echo $viewEmp->n_BusinessId;?>';
    //console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/emppolicy",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
           $("#policy").empty();
              $("#policy").append("<option >Select Policy</option>");
              var checkSelectedpolicy = '<?php echo $policyId; ?>'; 
          $.each(data,function (index,value){
          	//console.log(checkSelectedpolicy);
          	 if(checkSelectedpolicy==value.a_PolicyId){var selected = "selected";}else{ selected = "";}
          $("#policy").append("<option "+selected+" value="+value.a_PolicyId+">"+value.t_PolicyName+"</option>");
          });
           }
      });
});
});
  $(document).ready(function(){ 
   $(window).bind('load',function(){
      var busid = '<?php echo $viewEmp->n_BusinessId;?>';
   console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/empdepartment",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
      success: function (data) {
              //console.log(data);
              $("#department").empty();
              $("#department").append("<option >Select Department</option>");
              var checkSelecteddep = '<?php echo $depId; ?>'; 
             console.log(checkSelecteddep);
              $.each(data,function (index,value1){
              	if(checkSelecteddep==value1.a_DeptId){var selected ="selected";}else{ selected = "";}
              $("#department").append("<option "+selected+" value="+value1.a_DeptId+" >"+value1.t_DeptName+"</option>");
              });
            }
          });
        });
         });
  
</script>
</body>
</html>
