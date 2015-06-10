<section class="main_caintainer">
<?php $this->load->view('businessLeft'); ?>


<script type="text/javascript">
	$(document).ready(function(){
		$('#changePass').click(function(){
			$(this).next().next().toggleClass('changePass2');
		});
	});
</script>



<div class="rightSide">
<a href="<?php echo base_url();?>ssa/business/business_list/" class="loadbtn bluebg" style="float:left" >Back</a>
<div><span class="buttonWrap"><a href="<?php echo base_url();?>ssa/business/business_add/" class="loadbtn">New Business</a></span>
<div class="fix"></div></div>



<div class="right_top"><h2 class="right_topss"><!-- Edit Business Details --></h2> <span class="buttonWrap"></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}
?>

<form action="<?php echo base_url();?>ssa/business/business_edit/<?php echo $state->a_BusinessId; ?>" method="post"> 
<div class="formPreExp">

	<div class="col">
		<label>Business Name</label>
		<input type="hidden" name="a_BusinessId" value="<?php echo $state->a_BusinessId;?>" >
		<input type="text" name="t_BusinessName" value="<?php echo $state->t_BusinessName;?>" >
	</div>
	<div class="col">
		<label>Status </label>
	<?php if(isset($_POST['n_Status']))
		{
		    $statusid=$_POST['n_Status'];
		} ?>
		<select name="n_Status" id="status11" onchange="return mydt(this.value)">
			<option value='1' <?php /*if(isset($statusid)) { if($statusids==1) { ?> selected="selected" <?php  } else */ if($state->n_Status==1){  echo 'selected="selected"'; } /*}*/ ?> >Close</option>
			<option value='2' <?php /*if(isset($statusid)) { if($statusids==2) { ?> selected="selected" <?php  } else */ if($state->n_Status==2){ echo 'selected="selected"'; } /*}*/ ?> >Open</option>
		<option value='3' <?php /*if(isset($statusid)) { if($statusids==2) { ?> selected="selected" <?php  } else */ if($state->n_Status==3){ echo 'selected="selected"'; } /*}*/ ?> >Open-Trial</option>
		<option value='4' <?php /*if(isset($statusid)) { if($statusids==2) { ?> selected="selected" <?php  } else */ if($state->n_Status==4){ echo 'selected="selected"'; } /*}*/ ?> >Blocked</option>
		<option value='5' <?php /*if(isset($statusid)) { if($statusids==2) { ?> selected="selected" <?php  } else */ if($state->n_Status==5){ echo 'selected="selected"'; } /*}*/ ?> >Closed-Payment Pending</option>
		</select>
	</div>
	<div class="col">
		<label>Address Line1</label>
		<?php $business_add= $state->t_Address;
		$bus_add=  explode('___', $business_add, 2);
    //p($bus_add);

		    ?>
		<input type="text" name="businessAddress" value="<?php echo  $bus_add[0];?>" >
	</div>
	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="businessAddress2" value="<?php echo $bus_add[1]; ?>" >
	</div>
	<div class="col">
		<label>Country</label> 
		<?php echo country('list',$state->n_CountryId,1); ?>
	</div>
	<div class="col">
		<label>State</label> 
		<select name="n_StateId_1" id="StateId_1" onchange="return getCity(1);">
			<option value="0">Select Country</option>
		</select>
		<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	</div>


<div class="col">
	<label>City</label>
		<select name="n_City_1" id="n_City_1">
			<option value=''>City</option>
		</select>
</div>


<div class="col">
	<label>Number of employees</span></label> 
	<input type="text" name="n_UserCount" value="<?php echo $state->n_UserCount;?>" />
</div>

<div class="col"> 
	<label>Start Date</label>
	<input type="text" name="d_StartDate" id=""  readonly="" class="" value="<?php echo date('d M, Y', strtotime($state->d_StartDate));?>" />
</div>

<div class="col">
	<label>End Date</label> <!-- $newDate = date("d-M-Y", strtotime($state->d_EndDate)); --><!--  echo $data = date('d M, Y', strtotime($database)); -->
	<input type="text" name="d_EndDate" id="d_EndDate" readonly="" class="" value="<?php //echo date('d M, Y', strtotime($state->d_EndDate));?>" />
</div> 

<div class="col">
	<label>Default Currency</label>
	<?php
		echo currencyMyList('list',$state->n_CurrencyId);
	?>
</div>

<div class="col">
	<label>Expenses in other currency</label>
	<select name="b_ExpOtherCtry" >
		<option value='0' <?php if($state->b_ExpOtherCtry==0){ ?> selected="selected" <?php } ?> >No</option>
		<option value='1' <?php if($state->b_ExpOtherCtry==1){ ?> selected="selected" <?php } ?>>Yes</option>
	</select>
</div>
    
<div class="col">
	<label>Date Format</label>
	<select name="t_DateFormat" >
		<option value='DMY' <?php if($state->t_DateFormat=='DMY'){ ?> selected="selected" <?php } ?>  >ddmmyyyy</option>
		<option value='YMD' <?php if($state->t_DateFormat=='YMD'){ ?> selected="selected" <?php } ?> >yyyymmdd</option>
		<option value='MDY' <?php if($state->t_DateFormat=='MDY'){ ?> selected="selected" <?php } ?>  >mmddyyyy</option>
	</select>

</div> 

   
<div class="col">
	<label>Distance Measure</label>
	<?php  echo distance('list',$state->n_Distance,1)?>
	
</div>

<div class="right_top">
	<h2>Applicant Information</h2><span class="buttonWrap"></span></div>
<div class="formPreExp">
	
	<div class="col">
		<label>First Name</label>
		<input type="text" name="appFirstName" value="<?php echo $state->FNAME;?>">
	</div>

	<div class="col">
		<label>Last Name</label>
		<input type="text" name="appLastName" value="<?php echo $state->LNAME;?>" />
	</div>

	<div class="col">
		<label>Address Line1</label>
		<?php $address = $state->ADDRESS;
		   $add=  explode('___', $address, 2);
		//p($add);
		?>
		<input type="text" name="appAddress1" value="<?php echo $add['0'];?>"/>
	</div>

	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="appAddress2" value="<?php echo $add['1'];?>"/>
	</div>

<div class="col">
	<label>Country</label>
	<?php echo country('list',$state->COUNTRY,2); ?>

</div>

<div class="col">
	<label>State</label>
	<select name="n_StateId_2" id="StateId_2" onchange="return getCity(2);">
			<option value="0">Select Country</option>
	</select>
	<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	
</div>   

<div class="col">
	<label>City</label> 
	<select name="n_City_2" id="n_City_2">
		<option value=''>City</option>
	</select>
</div>

<div class="col">
	<label>Phone</label>
	<input type="text" name="appPhone" onkeypress="return isNumber(event)" maxlength="11"   value="<?php echo $state->CONTACT;?>">
</div>

<div class="col">
	<label>Email Address</label>
	<input type="text" name="appEmail" value="<?php echo $state->EMAIL;?>">
</div>
<!-- $state->d_DOB -->

<div class="col"> <!-- $newDate = date("d-M-Y", strtotime($state->d_DOB)); -->
	<label>DOB</label>
	<?php // echo $state->DOB; ?>
	<input type="text" name="appDob" id="datepicker-example1s3" class="dat" value="<?php if($state->DOB !=="1970-01-01 00:00:00"){ echo date('d M, Y', strtotime($state->DOB)); } ?>"/>
</div> 

<div class="col">
	<label>Position in Company</label>
	<input type="text" name="appCompanyPosition" value="<?php echo $state->POSITION;?>"/>
</div>
</div>
<div class="right_top">
<h2>Billing Information</h2>
	<span class="buttonWrap"></span>
</div>
</div>

	<div class="formPreExp">
		<div class="col">
			<label>Billing Type</label>
			<?php echo billing('list',$state->n_BillingType,1); ?>
			
		</div>

	<div class="col">
		<label>Bill to Contact</label>
		<input type="text" name="t_BillingContact"   value="<?php echo $state->bill_contact;?>">
	</div>

	<div class="col">
		<label>Email Address</label>
		<input type="text" name="BillingEmail" value="<?php echo $state->t_BillingEmailAdd;?>">
	</div>

	<div class="col">
		<label>Package</label>
	
		<?php echo package('list',$state->n_Package,1); ?>
			
	</div>

<div class="col">
	<label>Address Line1</label>
	<?php $bul_add=$state->t_Address; 
            $badd= explode('%', $bul_add,2);

	?>
	<input type="text" name="BullingAddress" value="<?php echo $state->t_AddfLine?>"/>
</div>
<div class="col">
	<label>Address Line2</label>
	<input type="text" name="BillingAddress2" value="<?php  echo $state->t_AddSecLine;?>" />
</div>
<div class="col">
	<label>Country</label>
	<?php echo country('list',$state->bill_cont_id,3); ?>
</div>
<div class="col">
	<label>State</label>
	<select name="n_StateId_3" id="StateId_3" onchange="return getCity(3);">
		<option value="0">Select Country</option>
	</select>
	<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
</div>
<div class="col">
	<label>City</label>
	<select name="n_City_3" id="n_City_3">
			<option value=''>City</option>
	</select>
</div>

<div class="">
	<span class="buttonWrap">
		<input type="submit" name="submit" value="Save Business" class="loadbtn bluebg">
	</span>
<div class="fix"></div>
</div>
</form>

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




// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $state->n_CountryId;?>';
      var getid = 1;
     // console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected = '<?php echo $state->n_StateId; ?>';	
						//console.log(checkSelected);
						$.each(data, function(index, value) {
							 if(checkSelected==value.a_StateId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
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

      // end of window
    });   
  });
// END STATE SELECTED CODE 


// START BYDEFAULT CITY SELECTED CODE
$(document).ready(function(){
    $(window).bind('load',function(){
      var stateId = '<?php echo $state->n_StateId; ?>';
      //console.log(stateId);
      var GetId=1;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php echo $state->n_City; ?>';	
						console.log(checkSelected1);	
						$.each(data, function(index, value) {
							//console.log(checkSelected1);
							 if(checkSelected1==value.a_CityId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
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
      // end of window
    });   
  });



// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $state->bill_cont_id;?>';
      var getid = 3;
      //console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected2 = '<?php echo $state->bill_state_id; ?>';	
						$.each(data, function(index, value) {
							 if(checkSelected2==value.a_StateId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
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

      // end of window
    });   
  });
// END STATE SELECTED CODE 


// START BYDEFAULT CITY SELECTED CODE
$(document).ready(function(){
    $(window).bind('load',function(){
      var stateId = '<?php echo $state->bill_state_id; ?>';
      var GetId=3;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php echo $state->bill_city_id; ?>';
						//console.log(checkSelected1);		
						$.each(data, function(index, value) {
							 if(checkSelected1==value.a_CityId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
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
      // end of window
    });   
  });





// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = '<?php echo $state->COUNTRY;?>';
      var getid = 2;
      //console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected2 = '<?php echo $state->STATE; ?>';	
						$.each(data, function(index, value) {
							 if(checkSelected2==value.a_StateId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
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

      // end of window
    });   
  });
// END STATE SELECTED CODE 


// START BYDEFAULT CITY SELECTED CODE
$(document).ready(function(){
    $(window).bind('load',function(){
      var stateId = '<?php echo $state->STATE; ?>';
      var GetId=2;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php echo $state->CITY; ?>';	
						//console.log(checkSelected1);	
						$.each(data, function(index, value) {
							//console.log(value.a_CityName);
							 if(checkSelected1==value.a_CityId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
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
      // end of window
    });   
  });

function mydt()
{
	var statuss=$("#status11").val();
	//console.log(statuss);
	var myydate= '<?php echo date('d M,Y'); ?>';
	//console.log(myydate);
	if(statuss==1)
	{
		$("#d_EndDate").val(myydate);
	}
	else 
	{
		$("#d_EndDate").val('');
	}

}

</script>
</body>
</html>
