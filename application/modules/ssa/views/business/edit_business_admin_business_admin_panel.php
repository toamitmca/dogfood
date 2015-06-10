<?php 
$userId = checklogin();
$sessionVar = $this->session->userdata('roleAccess');
// p($sessionVar);
// exit();
$editAdmin=$sessionVar['Manage Admins'];
$assignedRole = array();
// p($empData);
// exit();
if(!empty($empData)){
	foreach ($empData as $key4 => $value4) {
			$a_EmpId=$value4->a_BusnAdminId;
			$empCode=$value4->t_AdminCode;
			$empFirstName=$value4->t_FirstName;
			$empLastName=$value4->t_LastName;
			$statusCon=$value4->b_Status;
			$deptId=$value4->n_DeptId;
			$email=$value4->t_Email;
			$officePhone=$value4->t_Contact;
			$mobilePhone=$value4->t_Mobile;
			$empDob=$value4->d_DOB;
			$address=$value4->tba_Address;
			// $address2=$value4->t_AddSecLine;
		    //$address3=$value4->t_AddThirdLine;
			$countrySelected=$value4->n_CountryId;
			$stateSelected=$value4->n_StateId;
			$citySelected=$value4->n_CityId;
			$pincode=$value4->t_Pincode;
			$amountRange=$value4->n_AmtRange;
			//$assignedRole[]=$value4->a_EmpAccessMapId;
			$assignedRole[]=$value4->n_RoleAccessId;
			$add=explode("___", $address);
			if(!empty($add[0])){
				$address1=$add[0];
			}else{
				$address1='';
			}

			if(!empty($add[1])){
				$address2=$add[1];
			}else{
				$address2='';
			}
			if(!empty($add[2])){
				$address3=$add[2];
			}else{
				$address3="";
			}

			$dateOfBirth = date('d M, Y', strtotime($empDob));
	}
}else{
			$a_EmpId='';
			$empCode='';
			$empFirstName='';
			$empLastName='';
			$statusCon='';
			$depId='';
			$email='';
			$deptId="";
			$officePhone='';
			$mobilePhone='';
			$empDob='';
			$address='';
			$address2='';
			$address3='';
			$countrySelected='';
			$stateSelected='';
			$citySelected='';
			$pincode='';
			$amountRange='';
			$assignedRole='';
			$dateOfBirth='';
			$address1="";
			$address2="";
			$address3="";
			
}

// echo $address1."<br/>";
// echo $address2."<br/>";
// echo $address3."<br/>";
// exit();
/*$department=array(	'0' =>array('a_depId'=>1,'a_depName'=>'Department1'),
					'1' =>array('a_depId'=>2,'a_depName'=>'Department2'),
					'2' =>array('a_depId'=>3,'a_depName'=>'Department3'),
					'3' =>array('a_depId'=>4,'a_depName'=>'Department4'),
					'4' =>array('a_depId'=>5,'a_depName'=>'Department5'),
					);*/

     $status =array('0' =>array('a_statusId'=>1,'a_staName'=>'Active'),
					'1' =>array('a_statusId'=>0,'a_staName'=>'Inactive'),
					);
if($amountRange=='-1.000'){
	$amountRange='0.00';
}else{
	$amountRange=$amountRange;
}
// p($empData);
// echo "</br>";
// p($assignedRole);
// exit();
//echo $pincode;
?>
<section class="main_caintainer">
	<div class="leftSide" >
	<input style="width:100%;" type="text" name="search_name" placeholder="---Name---" id="search_name">
		<ul class="leftmenu">
			<div id="leftSide">
				<?php foreach ($side as $key3 => $value3) {?>
				<li><a href="<?php echo base_url(); ?>business/dashboard/editbabapanel/<?php echo $value3->a_BusnAdminId; ?>" class="" ><?php echo $value3->t_FirstName.' '.$value3->t_LastName ;?></a>
				</li>
			<?php } ?>
			</div>
		</ul>
	</div>
<div class="rightSide">
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url(); ?>business/dashboard/babapanel/" class="loadbtn bluebg">Add Admin</a>
		</span>
		<div class="fix"></div>
	</div>
	<?php 
		
		if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}?>
<?php echo $this->session->flashdata('message');?>
	<form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>business/dashboard/editbabapanel/<?php echo $this->uri->segment('4');?>"> 
	<input type="hidden" name="emp_id" id="emp_id"  value="<?php echo $a_EmpId; ?>"/>
	<div class="col"><label>Status</label> 
		<select name="status" id="status">
			<option value=''>Select a Status</option>
			<?php foreach ($status as $key9 => $value9) { 
					if($value9['a_statusId']==$statusCon){$statusSelect="selected";}else{ $statusSelect="";} ?>
					<option value="<?php echo $value9['a_statusId']; ?>" <?php echo $statusSelect; ?>><?php echo $value9['a_staName'] ?></option>
				<?php } ?>
		</select>
	</div>
	
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
			<label>Department</label> 
			
			<?php echo department('list',$deptId,1); ?>
		</div>
	<div class="col">
      <label>Email Id</label>
      <input type="text" name="email" id="email1" autocomplete="off" value="<?php echo $email;?>"/>
     </div>
		<div class="col">
			<label>Employee Id</label>
			<input type="text" name="employee_id" id="employee_id" value="<?php echo $empCode; ?>"/>
		</div>
		<div class="col">
			<label>DOB</label>
			<input type="text" id="datepicker-example1s3"  name="date_of_birth" value="<?php echo $dateOfBirth; ?>"/>
		</div> 
		<div class="col">
			<label>Office Phone </label>
			<input type="text" name="office_phone" onkeypress="return isNumber(event)" id="office_phone"  value="<?php echo $officePhone; ?>" />
		</div>
		<div class="col">
			<label>Mobile Phone </label>
			<input type="text" name="mobile_phone" id="mobile_phone" onkeypress="return isNumber(event)"  value="<?php echo $mobilePhone; ?>" />
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
	<div class="edit_policy">
	<?php //p($role); ?>
	<?php foreach ($role as $key1 => $value1) { 
			//echo $value1->a_RoleAccessId;
				if(!empty($assignedRole)){
					if(in_array($value1->a_RoleAccessId, $assignedRole)){ $check="checked";}else{ $check=''; }
					//}
				}else{
					$check='';
				}
			?>
						
		<span><input type="checkbox" name="edit_policy[]" <?php echo $check; ?> value="<?php echo $value1->a_RoleAccessId; ?>"><?php echo $value1->t_AccessName; ?></span>
	<?php } ?>
		
	</div>
	<div class="edit_policy_right">
		<span><label>Rs.</label> <input style="width:30%;" type="text" name="amount" id="amount" value="<?php echo $amountRange; ?>"/></span>
	</div>

	<div class="right_top">
		<span class="buttonWrap">
			<button type="submit" class="loadbtn bluebg" name="submit" id="submit">Update Access</button>
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

  var access="<?php echo $editAdmin; ?>";
  console.log(access);
  if(access=="No"){
   $("input").prop('disabled','disabled');
   $("select").prop('disabled','disabled');
   $(".loadbtn").hide();
  }
  
});
	$("#country_id").on('change',function(){
		$("#state_id").empty();
		$("#state_id").html("<option value=''>Select a State</option>");
		var countryId=$("#country_id").val();
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
	//console.log(searchValue);
	if(searchValue!=''){
		searchValue=searchValue;
	}else{
			console.log("hi");
			// console.log(searchValue);
			searchValue="";
		}
		$.ajax({
			  url: "<?php echo base_url();?>business/dashboard/searchBusName",
			  type: 'POST',
			  data: { name : searchValue },
			  async: true,
	    	  dataType: "json",
			  success: function (data) {
	        	  console.log(data);
	        	if(data!=null){  
	        	   $("#leftSide").empty();
					$.each(data,function (index,value){
						var list="<ul>";
							list +="<li>";
							list +="<a href=<?php echo base_url(); ?>business/dashboard/editbabapanel/"+value.a_BusnAdminId+">"+value.t_FirstName+' '+value.t_LastName+"</a>";
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
