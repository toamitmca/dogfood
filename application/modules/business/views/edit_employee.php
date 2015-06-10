<?php 

$sessionVar = $this->session->userdata('roleAccess');
// p($sessionVar);
// exit();
$editEmployee=$sessionVar['Manage Employees'];
    
foreach($empData as $key4 => $value4) {
	    $b_Deleted=$value4->b_Deleted;
		$a_EmpId=$value4->a_EmpId;
		$empCode=$value4->t_EmpCode;
		$empFirstName=$value4->t_EmpFirstName;
		$empLastName=$value4->t_EmpLastName;
		$statusCon=$value4->n_Status;
		$depId=$value4->n_DeptId;
		$policyId=$value4->n_PolicyId;
		$officePhone=$value4->t_OfficePhone;
		$mobilePhone=$value4->t_MobilePhone;
		$empDob=$value4->d_EmpDOB;
		$address1=$value4->t_AddfLine;
		$address2=$value4->t_AddSecLine;
		$address3=$value4->t_AddThirdLine;
		$countrySelected=$value4->n_CountryId;
		$stateSelected=$value4->n_StateId;
		$citySelected=$value4->n_CityId;
		$pincode=$value4->n_PinCode;
}
$empDob = date('d M, Y', strtotime($empDob));
/*$department=array(	'0' =>array('a_depId'=>1,'a_depName'=>'Department1'),
					'1' =>array('a_depId'=>2,'a_depName'=>'Department2'),
					'2' =>array('a_depId'=>3,'a_depName'=>'Department3'),
					'3' =>array('a_depId'=>4,'a_depName'=>'Department4'),
					'4' =>array('a_depId'=>5,'a_depName'=>'Department5'),
					);
$policy=array(	'0' =>array('a_policyId'=>1,'a_polName'=>'policy1'),
					'1' =>array('a_policyId'=>2,'a_polName'=>'policy2'),
					'2' =>array('a_policyId'=>3,'a_polName'=>'policy3'),
					'3' =>array('a_policyId'=>4,'a_polName'=>'policy4'),
					'4' =>array('a_policyId'=>5,'a_polName'=>'policy5'),
					);*/
$status=array(	'0' =>array('a_statusId'=>0,'a_staName'=>'Active'),
					'1' =>array('a_statusId'=>2,'a_staName'=>'Blocked'),

					);

// p($empData);
// echo "</br>";
// p($assignedRole);
// exit();
//echo $pincode;
?>
<section class="main_caintainer">
	<div class="leftSide" >
	<input style="width:100%;" type="text" name="search_name" placeholder="---Employee Name---" id="search_name">
		<ul class="leftmenu" id="leftSide">
				<span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
				<?php if(!empty($side)){?>
				<?php foreach ($side as $key3 => $value3) {?>
					<li><a href="<?php echo base_url(); ?>business/dashboard/edit_employee/<?php echo $value3->a_EmpId; ?>" class="" ><?php echo $value3->t_EmpFirstName.' '.$value3->t_EmpLastName ;?></a></li>
			<?php }}else{echo "No records Found"; }?>
		</ul>
	</div>
<div class="rightSide">
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url(); ?>business/dashboard/edit_employee/" class="loadbtn bluebg">Add Employee</a>
		</span>
		<div class="fix"></div>
	</div>
	 <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }
?>
	<form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>business/dashboard/edit_employee/<?php echo $this->uri->segment('4');?>"> 
	<input type="hidden" name="emp_id" id="emp_id"  value="<?php echo $a_EmpId; ?>"/>
	<div class="col"><label>Status</label>
		<select style="width:30%;" name="status" id="status">
			<option value='0' <?php if($b_Deleted==0){echo 'selected="selected"';} ?>  <?php echo set_select('status', '0'); ?>>Active</option>
			<option value='2' <?php if($b_Deleted==2){echo 'selected="selected"';} ?>  <?php echo set_select('status', '2'); ?>>Blocked</option>
					</select>
	</div>
	
	<div class="formPreExp">
		<div class="col">
			<label>First Name</label>
			<input type="text" name="first_name" id="first_name" value="<?php echo $empFirstName; ?>"/>
		</div>
		<div class="col">
			<label>Last Name</label>
				<input type="text" name="last_name" id="last_name" value="<?php echo $empLastName; ?>" />
		</div>
		<div class="col">
		<span id="message" style="position: absolute;top: -7px; right: 20px;"></span>
			<label>Policy Assigned</label> 
     <?php echo policy('list',$policyId,1); ?>



		</div>
		<div class="col">
			<label>Department</label> 
			<?php echo department('list',$depId,1); ?>
		</div>
		<div class="col">
			<label>Employee Id</label>
			<input type="text" name="employee_id" id="employee_id" value="<?php echo $empCode; ?>"/>
		</div>

		<div class="col">
			<label>Email Id</label>
			<input type="text" name="email" id="email" readonly="readonly" value="<?php echo $value4->t_EmaiId; ?>"/>
		</div>
		<div class="col">
			<label>DOB</label>
			<input type="text" id="datepicker-example1s3" name="date_of_birth" value="<?php echo $empDob; ?>"/>
		</div> 
		<div class="col">
			<label>Office Phone </label>
			<input type="text" name="office_phone"  onkeypress="return isNumber(event)" maxlength="15"  id="office_phone"  value="<?php echo $officePhone; ?>" />
		</div>
		<div class="col">
			<label>Mobile Phone </label>
			<input type="text" name="mobile_phone" onkeypress="return isNumber(event)" maxlength="11" id="mobile_phone" value="<?php echo $mobilePhone; ?>" />
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
				<select name="country_id" id="country_id">
					<option value="">Select a Country</option>
					<?php foreach ($country as $key => $value) {
						 if($value->a_CountryId==$countrySelected) {
						 	$selectCountry='selected';
						 	}else{
						 		$selectCountry='';
						 		}?>
							<option <?php echo $selectCountry; ?> value="<?php echo $value->a_CountryId; ?>"><?php echo $value->t_CountryName; ?></option>
					<?php } ?>
				</select>
		</div>
		<div class="col">
			<label>State</label> 
			<select name="state_id" id="state_id">
				<option value="">Select a State</option>
				<?php foreach ($stateList as $key5 => $value5) {
						 if($value5->a_StateId==$stateSelected) {
						 	$selectState='selected';
						 	}else{
						 		$selectState='';
						 		}?>
							<option <?php echo $selectState; ?> value="<?php echo $value5->a_StateId; ?>"><?php echo $value5->t_StateName; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col">
			<label>City</label>
				<select name="city_id" id="city_id">
					<option value="">Select a City</option>
					<?php foreach ($cityList as $key6 => $value6) {
						 if($value6->a_CityId==$citySelected) {
						 	$selectCity='selected';
						 	}else{
						 		$selectCity='';
						 		}?>
							<option <?php echo $selectCity; ?> value="<?php echo $value6->a_CityId; ?>"><?php echo $value6->t_CityName; ?></option>
				<?php } ?>
				</select>
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
			</div>
		</form>
	</div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
$(document).ready(function(){

  var access="<?php echo $editEmployee; ?>";
  console.log(access);
  if(access=="No"){
   $("input").prop('disabled','disabled');
   $("select").prop('disabled','disabled');
   $(".loadbtn").hide();
  }
  
});

/*Rahul yavad*/
$(document).ready(function(){

  var policyid="<?php echo $policyId; ?>";
  console.log(policyid);

$.ajax({
		  url: "<?php echo base_url();?>business/dashboard/emppolicychang",
		  type: 'POST',
		  data: { 'policyid':policyid },
		  async: true,
    	  dataType: "json",
		  success: function (data) {
        	  console.log(data);
             if(data.noexp = 0){

$('#message').val('');
           }
         else{
         	//$('#policy').prop('disabled', true);
         	$('#policy').css('pointer-events','none');

$( "#policy" ).parent().mouseover(function() {
$( "#message" ).html( "Policy cannot be changed for the employee" );
});

$( "#policy" ).parent().mouseleave(function() {
		$( "#message" ).empty(); 
});


//$('#message').val('Policy cannot be changed for the employee');

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
		  data: { id : stateId },
		  async: true,
    	  dataType: "json",
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
	console.log(searchValue);
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
			  data: { 'name' : searchValue },
			  async : true,
	    	  dataType : 'JSON',
			  success: function (data) {
	        	  console.log(data);
	        	if(data!=null){  
	        	   $("#leftSide").empty();
					$.each(data,function (index,value){
						var list="<ul>";
							list +="<li>";
							list +="<a href=<?php echo base_url(); ?>business/dashboard/edit_employee/"+value.a_EmpId+">"+value.t_EmpFirstName+' '+value.t_EmpLastName+"</a>";
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

</script>
</body>
</html>
