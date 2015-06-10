<section class="main_caintainer">
<?php $this->load->view('businessLeft'); ?>

<div class="rightSide">

<div><span class="buttonWrap"><a href="" class="loadbtn bluebg">New Business</a></span>
<div class="fix"></div></div>
<div class="right_top"><h2>Provide New Business Details</h2> <span class="buttonWrap"></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}
?>
	
<?php ?>
<form action="<?php echo base_url();?>ssa/business/business_add/" method="post"> 
<div class="formPreExp">
	<div class="col">
		<label>Business Name</label>
		<input type="text" name="t_BusinessName" value="" >
	</div>
	<div class="col">
		<label>Status Open</label>
		<select style="width:30%;" name="n_Status">
			<option value='0'>Close</option>
			<option value='1'>Open</option>
		</select>
	</div>
	<div class="col">
		<label>Address Line1</label>
		<input type="text" name="businessAddress" value="" >
	</div>
	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="businessAddress2" value="" >
	</div>

	<div class="col">
		<label>Country</label> 
		<?php echo country('list',0,1); ?>
	</div>

	<div class="col">
		<label>State</label> 
		<select style="width:30%;" name="n_StateId" id="StateId_1" onchange="return getCity(1);">
			<option value="0">Select Country</option>
		</select>
		<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	</div>


<div class="col">
	<label>City</label>
		<select style="width:40%;" name="n_City" id="n_City_1">
			<option value=''>City</option>
		</select>
</div>


<div class="col">
	<label>Employees</span></label> 
	<input type="text" name="n_UserCount" value="" />
</div>

<div class="col">
	<label>Start Date</label>
	<input type="text" name="d_StartDate" value="" id="datepicker-example1s5" />
</div>

<div class="col">
	<label>End Date</label>
	<input type="text" name="d_EndDate" id="datepicker-example1s4" value="" />
</div> 

<div class="col">
	<label>Default Currency</label>
	<?php
		echo currency();
	?>
</div>

<div class="col">
	<label>Expenses in other currency</label>
	<select style="width:30%;" name="b_ExpOtherCtry" >
		<option value='0'>No</option>
		<option value='1'>Yes</option>
	</select>
</div>
    
<div class="col">
	<label>Date Format</label>
	<select style="width:30%;" name="t_DateFormat" >
		<option value='DMY'>DMY</option>
		<option value='YMD'>YMD</option>
		<option value='MDY'>MDY</option>
	</select>

</div> 

   
<div class="col">
	<label>Distance Measure</label>
	<select style="width:30%;" name="n_Distance">
		<option value='km'>KM</option>
		<option value='Meter'>Meter</option>
		<option value='Miles'>Miles</option>
	</select>
</div>

<div class="right_top">
	<h2>Applicant Information</h2><span class="buttonWrap"></span>
<div class="formPreExp">
	
	<div class="col">
		<label>First Name</label>
		<input type="text" name="appFirstName" value="">
	</div>

	<div class="col">
		<label>Last Name</label>
		<input type="text" name="appLastName" value="" />
	</div>

	<div class="col">
		<label>Address Line1</label>
		<input type="text" name="appAddress1" value=""/>
	</div>

	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="appAddress2" value=""/>
	</div>

<div class="col">
	<label>Country</label>
	<?php echo country('list',0,2); ?>

</div>

<div class="col">
	<label>State</label>
	<select style="width:30%;" name="n_StateId" id="StateId_2" onchange="return getCity(2);">
			<option value="0">Select Country</option>
	</select>
	<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	
</div>   

<div class="col">
	<label>City</label> 
	<select style="width:30%;" name="appCity" id="n_City_2">
		<option value=''>City</option>
	</select>
</div>

<div class="col">
	<label>Phone</label>
	<input type="text" name="appPhone" value="">
</div>

<div class="col">
	<label>Email Address</label>
	<input type="text" name="appEmail" value="">
</div>

<div class="col">
	<label>DOB</label>
	<input type="text" name="appDob" id="datepicker-example1s3" value=""/>
</div> 

<div class="col">
	<label>Position in Company</label>
	<input type="text" name="appCompanyPosition" value=""/>
</div>

<div class="right_top">
<h2>Billing Information</h2>
	<span class="buttonWrap"></span>

	<div class="formPreExp">
		<div class="col">
			<label>Billing Type</label>
			<select style="width:30%;" name="n_BillingType" >
				<option value=''>Trial</option>
				<option value='1'>Trial</option>
				<option value='2'>Trial</option>
				<option value='3'>Trial</option>
			</select>
		</div>

	<div class="col">
		<label>Billing Contact</label>
		<input type="text" name="t_Billingname" value="">
	</div>

	<div class="col">
		<label>Email Address</label>
		<input type="text" name="businessEmail" value="">
	</div>

	<div class="col">
		<label>Package</label>
		<select style="width:30%;" name="businessPackage" >
			<option value=''>Basic</option>
			<option value='1'>Basic</option>
			<option value='2'>Basic</option>
			<option value='3'>Basic</option>
		</select>
	</div>

<div class="col">
	<label>Address Line1ss</label>
	<input type="text" name="businessAddress" value=""/>
</div>

<div class="col">
	<label>Address Line2</label>
	<input type="text" name="businessAddress" value="" />
</div>

<div class="col">
	<label>Country</label>
	<?php echo country('list',0,3); ?>
</div>

<div class="col">
	<label>State</label>
	<select style="width:30%;" name="n_StateId" id="StateId_3" onchange="return getCity(3);">
		<option value="0">Select Country</option>
	</select>
	<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
</div>


<div class="col">
	<label>City</label>
	<select style="width:40%;" name="n_City" id="n_City_3">
			<option value=''>City</option>
	</select>
</div>

<div></div>
<div class="right_top">
	<span class="buttonWrap">
		<input type="submit" name="submit" value="Create Business" class="loadbtn bluebg">
	</span>
<div class="fix"></div>

</form>

</div>
</div>
</section>
<div class="fix"></div>
<?php $this->load->view('layout/footer');?>
<script type="text/javascript">
	function getstate(getid){
		//var countryId = $("#country").val();
		var countryId = $(".country"+getid).val();
		$(".loading").css('display', 'inline-block');
		$.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);		
						$.each(data, function(index, value) {
							var SelectData  = "<option value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
							$('#StateId_'+getid).append(SelectData);
						});
						$(".loading").css('display', 'none');
					}
					if(data ==0){
						var selectData = '<option value="0">Select Country</option>';
						$('#StateId_'+getid).append(selectData);
						$(".loading").css('display', 'none');
					}
				}
			});
				
	}

	function getCity(GetId){
		var stateId = $("#StateId_"+GetId).val();
		$(".loading").css('display', 'inline-block');
		$.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);		
						$.each(data, function(index, value) {
							var SelectData  = "<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
							$('#n_City_'+GetId).append(SelectData);
						});
						$(".loading").css('display', 'none');
					}
					if(data ==0){
						var selectData = '<option value="0">Select State</option>';
						$('#n_City_'+GetId).append(selectData);
						$(".loading").css('display', 'none');
					}

				}
			});

	}







</script>
</body>
</html>
