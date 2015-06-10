<?php
$userId = checklogin();

$status=array(	
				'0' =>array('a_statusId'=>1,'a_staName'=>'Active'),
				'1' =>array('a_statusId'=>0,'a_staName'=>'Inactive'),
			);

?>
<section class="main_caintainer">
	<div class="leftSide" >
	<input style="width:100%;" type="text" name="search_name" placeholder="--- Name---" id="search_name">
		<ul class="leftmenu" id="leftSide">
				<span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
				<?php foreach ($side as $key3 => $value3) {?>
					<li><a href="<?php echo base_url(); ?>business/dashboard/editbabapanel/<?php echo $value3->a_BusnAdminId; ?>" class="" ><?php echo $value3->t_FirstName.' '.$value3->t_LastName ;?></a></li>
			<?php } ?>
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
	}

	?>
	<?php echo $this->session->flashdata('message');?>
	<form name="detail_informaton" id="detail_informaton" method="post" action="<?php echo base_url(); ?>business/dashboard/babapanel/"> 
	
	<div class="col"><label>Status</label> 
		<select style="width:30%;" name="status" id="status">
			<option value=''>Select a Status</option>
			<?php foreach ($status as $key9 => $value9) { ?>
				<option value="<?php echo $value9['a_statusId']; ?>" ><?php echo $value9['a_staName'] ?></option>
			<?php } ?>
		</select>
	</div>
	
	<div class="formPreExp">
		<div class="col">
			<label>First Name</label>
			<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name');?>" />
		</div>
		<div class="col">
			<label>Last Name</label>
				<input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name');?>"/>
		</div>
		<div class="col">
			<label>Department</label> 
			<?php echo department('list',$userId['n_BusinessId'],1); ?>
		</div>
	<div class="col">
      <label>Email Id</label>
      	<input type="text" name="email" id="email1" autocomplete="off" value="<?php echo set_value('email');?>"/>
    </div>
		<div class="col">
			<label>Employee Id</label>
			<input type="text" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id');?>"/>
		</div>
		<div class="col">
			<label>DOB</label>
			<input type="text" id="datepicker-example1s3" name="date_of_birth" value="<?php echo set_value('date_of_birth');?>" />
		</div> 
		<div class="col">
			<label>Office Phone </label>
			<input type="text" name="office_phone" id="office_phone" value="<?php echo set_value('office_phone');?>"/>
		</div>
		<div class="col">
			<label>Mobile Phone </label>
			<input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo set_value('mobile_phone');?>">
		</div>
		<div class="col">
			<label>Address Line1</label>
			<input type="text" name="address_line1" id="address_line1" value="<?php echo set_value('address_line1');?>"/>
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
						 <option value="<?php echo $value->a_CountryId; ?>"><?php echo $value->t_CountryName; ?></option>
					<?php } ?>
				</select>
		</div>
		<div class="col">
			<label>State</label> 
			<select name="state_id" id="state_id">
				<option value="">Select a State</option>
			</select>
		</div>
		<div class="col">
			<label>City</label>
				<select name="city_id" id="city_id">
					<option value="">Select a City</option>
				</select>
		</div>

	<div class="col">
		<label>PIN Code</label>
		<input type="text" name="pin_code" id="pin_code" value="<?php echo set_value('pin_code');?>"/>
	</div>
	<div></div>
	<div class="edit_policy">
	<?php foreach ($role as $key1 => $value1) {?>
		<span><input type="checkbox" name="edit_policy[]" value="<?php echo $value1->a_RoleAccessId; ?>"><?php echo $value1->t_AccessName; ?></span>
	<?php } ?>
		
	</div>
	<div class="edit_policy_right">
		<span><label>Rs.</label> <input style="width:30%;" type="text" name="amount" id="amount" value="<?php echo set_value('amount');?>"/></span>
	</div>

	<div class="right_top">
		<span class="buttonWrap">
			<button type="submit" class="loadbtn bluebg" name="submit">Add Access</button>
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
			  url: "<?php echo base_url();?>business/dashboard/searchBusName",
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
							list +="<a href=<?php echo base_url(); ?>business/dashboard/editbabapanel/"+value.a_BusnAdminId+">"+value.t_FirstName+' '+value.t_LastName+"</a>";
							list +="</li>";
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
