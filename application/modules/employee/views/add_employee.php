<?php 

$department=array(	'0' =>array('a_depId'=>1,'a_depName'=>'Department1'),
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
					);
$status=array(	'0' =>array('a_statusId'=>1,'a_staName'=>'Active'),
					'1' =>array('a_statusId'=>0,'a_staName'=>'Inactive'),
					
					);
?>
<section class="main_caintainer">
	<div class="leftSide" >
	<input style="width:100%;" type="text" name="search_name" placeholder="---Employee Name---" id="search_name">
		<ul class="leftmenu">
			<div id="leftSide">
				<?php foreach ($side as $key3 => $value3) {?>
				<li><a href="<?php echo base_url(); ?>employee/employee/edit_employee/<?php echo $value3->a_EmpId; ?>" class="" ><?php echo $value3->t_EmpFirstName.' '.$value3->t_EmpLastName ;?></a>
				</li>
			<?php } ?>
			</div>
		</ul>
	</div>
<div class="rightSide">
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url(); ?>super_state_admin/super_state_admin1/business_admin_business_admin_panel/" class="loadbtn bluebg">Add Employee</a>
		</span>
		<div class="fix"></div>
	</div>
	<form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>employee/employee/add_employee/"> 
	
	<div class="col"><label>Status</label> 
		<select style="width:30%;" name="status" id="status">
			<option value=''>Select a Status</option>
			<?php foreach ($status as $key9 => $value9) { ?>
			<option value="<?php echo $value9['a_statusId']; ?>"><?php echo $value9['a_staName'] ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col">
		<label>Lasted updated by user Name</label>
		<input type="text" name="user_name" id="user_name" readonly="readonly" value="xyz"/>
	</div>
	<div class="formPreExp">
		<div class="col">
			<label>First Name</label>
			<input type="text" name="first_name" id="first_name" />
		</div>
		<div class="col">
			<label>Last Name</label>
				<input type="text" name="last_name" id="last_name"  />
		</div>
		<div class="col">
			<label>Policy Assigned</label> 
			<select style="width:30%;" name="policy" id="policy">
				<option value=''>Select a policy</option>
				<?php foreach ($policy as $key7 => $value7) { ?>
					<option value="<?php echo $value7['a_policyId']; ?>" ><?php echo $value7['a_polName']; ?></option>
				<?php } ?>
				
			</select>
		</div>
		<div class="col">
			<label>Department</label> 
			<select style="width:30%;" name="department" id="department">
				<option value=''>Select a Department</option>
				<?php foreach ($department as $key8 => $value8) { ?>
					<option value="<?php echo $value8['a_depId']; ?>" ><?php echo $value8['a_depName']; ?></option>
				<?php } ?>
				
			</select>
		</div>
		<div class="col">
			<label>Employee Id</label>
			<input type="text" name="employee_id" id="employee_id" />
		</div>
		<div class="col">
			<label>DOB</label>
			<input type="text" id="datepicker-example1s3" name="date_of_birth" />
		</div> 
		<div class="col">
			<label>Office Phone </label>
			<input type="text" name="office_phone" id="office_phone"  />
		</div>
		<div class="col">
			<label>Mobile Phone </label>
			<input type="text" name="mobile_phone" id="mobile_phone" />
		</div>
		<div class="col">
			<label>Address Line1</label>
			<input type="text" name="address_line1" id="address_line1"  />
		</div>
		<div class="col">
			<label>Address Line2</label>
			<input type="text" name="address_line2" id="address_line2" />
		</div>
		<div class="col">
			<label>Address Line3</label>
			<input type="text" name="address_line3" id="address_line3" />
		</div>
		<div class="col">
			<label>Country</label>
				<select name="country_id" id="country_id">
					<option value="">Select a Country</option>
					<?php foreach ($country as $key => $value) { ?>
						<option value="<?php echo $value->a_CountryId; ?>"><?php echo $value->t_CountryName; ?></option>
					<?php } ?>
				</select>
		</div>
		<div class="col">
			<label>State</label> 
			<select name="state_id" id="state_id">
				<option value="">Select a State</option>
				<option  value="<?php echo $value5->a_StateId; ?>"><?php echo $value5->t_StateName; ?></option>
				
			</select>
		</div>
		<div class="col">
			<label>City</label>
				<select name="city_id" id="city_id">
					<option value="">Select a City</option>
					<option  value="<?php echo $value6->a_CityId; ?>"><?php echo $value6->t_CityName; ?>
					</option>
				
				</select>
		</div>

	<div class="col">
		<label>PIN Code</label>
		<input type="text" name="pin_code" id="pin_code"  />
	</div>
	<div></div>
	<div class="right_top">
		<span class="buttonWrap">
			<button type="submit" class="loadbtn bluebg" name="submit">Save</button>
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

	$("#country_id").on('change',function(){
		$("#state_id").empty();
		$("#state_id").html("<option value=''>Select a State</option>");
		var countryId=$("#country_id").val();
		console.log(countryId);
		$.ajax({
		  url: "<?php echo base_url();?>employee/employee/getStateDropDown",
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
		  url: "<?php echo base_url();?>employee/employee/getCityDropDown",
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
			//console.log("hi");
			// console.log(searchValue);
			searchValue="";
		}
		$.ajax({
			  url: "<?php echo base_url();?>employee/employee/searchName",
			  type: 'POST',
			  data: { name : searchValue },
			  //async: true,
	    	  //dataType: "json",
	    	  async: true,
	    	  dataType: "json",
			  success: function (data) {
	        	  console.log(data);
	        	if(data!=null){  
	        	   $("#leftSide").empty();
					$.each(data,function (index,value){
						var list="<ul>";
							list +="<li>";
							list +="<a href=<?php echo base_url(); ?>employee/employee/edit_employee/"+value.a_EmpId+">"+value.t_EmpFirstName+' '+value.t_EmpLastName+"</a>";
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



</script>
</body>
</html>
