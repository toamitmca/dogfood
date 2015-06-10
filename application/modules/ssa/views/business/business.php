<section class="main_caintainer">
<?php $this->load->view('businessLeft');

if(isset($_POST))
{
if(isset($_POST['businessAddress']))
{
    $busadr=$_POST['businessAddress'];
}
else 
{
	$busadr='';
}
if(isset($_POST['businessAddress2']))
{
   $busadr2=$_POST['businessAddress2'];
}
else 
{
	$busadr2='';
}

if(isset($_POST['appAddress1']))
{
   $busadr3=$_POST['appAddress1'];
}
else 
{
	$busadr3='';
}
if(isset($_POST['appAddress2']))
{
   $busadr4=$_POST['appAddress2'];
}
else 
{
	$busadr4='';
}
if(isset($_POST['BullingAddress']))
{
   $busadr5=$_POST['BullingAddress'];
}
else 
{
	$busadr5='';
}
if(isset($_POST['BillingAddress2']))
{
   $busadr6=$_POST['BillingAddress2'];
}
else 
{
	$busadr6='';
}

if(isset($_POST['appLastName']))
{
   $lastname=$_POST['appLastName'];
}
else 
{
	$lastname='';
}
}
?>


<div class="rightSide">

<div>
<div class="fix"></div></div>
<a class="loadbtns bluebg" href="<?php echo base_url(); ?>ssa/business/business_list/">Back</a>
<div class="right_top"><h2>Provide New Business Details</h2> <span class="buttonWrap"></span>
<span class="buttonWrap"><a class="loadbtn bluebg" href="<?php echo base_url(); ?>ssa/business/business_list/">Business Listing</a></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}
?>


<?php if(isset($_POST['n_StateId_1']))
{
	  $s5=$_POST['n_StateId_1'];
}
else
{ 
	 $s5=0;
}


 if(isset($_POST['n_StateId_2']))
{
	 $s6=$_POST['n_StateId_2'];
}
else
{
	 $s6=0;
}


 if(isset($_POST['n_StateId_3']))
{
	 $s7=$_POST['n_StateId_3'];
}
else
{
	 $s7=0;
}

if(isset($_POST['n_City_1']))
{
	$ct5=$_POST['n_City_1'];
}
else
{
	  $ct5=0;
}
if(isset($_POST['n_City_2']))
{
	 $ct6=$_POST['n_City_2'];
}
else
{
	$ct6=0;
}
if(isset($_POST['n_City_3']))
{
	 $ct7=$_POST['n_City_3'];
}
else
{
	 $ct7=0;
}
?>
<form action="<?php echo base_url();?>ssa/business/business_add/" method="post">
<div class="formPreExp">
	<div class="col">
		<label>Business Name</label>
		<input type="text" name="t_BusinessName" value="<?php echo set_value('t_BusinessName')?>" >
	</div>

  <?php if(isset($_POST['n_Status']))
  {
  	$selected="selected='selected'";
  }
  else
  {
	$selected="";
  }
  ?>

	<div class="col">
		<label>Status </label>
		<select name="n_Status" id="status11" onchange="return mydt(this.value)">
		    <option value="-1">Select Status</option>
		    <option value='2' <?php echo set_select('n_Status', '2'); ?> >Open</option>
		    <option value='1' <?php echo set_select('n_Status', '1'); ?>  >Close</option>
            <option value='3' <?php echo set_select('n_Status', '3'); ?> >Open-Trial</option>
            <option value='4' <?php echo set_select('n_Status', '4'); ?> >Blocked</option>
            <option value='5' <?php echo set_select('n_Status', '5'); ?> >Closed-Payment Pending</option>
		</select>
	</div>

	<div class="col">
		<label>Address Line1</label>
		<input type="text" name="businessAddress" value="<?php echo $busadr; ?>" >
	</div>
	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="businessAddress2" value="<?php echo $busadr2;?>" >
	</div>

<?php if(isset($_POST['n_CountryId_1']))
{
	$c1=$_POST['n_CountryId_1'];
}
else
{
	$c1=0;
}
?>
	<div class="col">
		<label>Country</label>
		<?php echo country('list',$c1,1); ?>
	</div>

	<div class="col">
		<label>State</label>
		<select name="n_StateId_1" id="StateId_1" onchange="return getCity(1);">
			<option value="0">--Select Country--</option>
		</select>
		<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	</div>


<div class="col">
	<label>City</label>
		<select name="n_City_1" id="n_City_1">
			<option value=''>--Select City--</option>
		</select>
</div>


<div class="col">
	<label>Number of employees</label>
	<input type="text" name="n_UserCount" value="<?php echo set_value('n_UserCount')?>" />
</div>

<div class="col">
	<label>Start Date  </label>
	<input class="" type="text" name="d_StartDate" id="d_StartDate" readonly="readonly"  value="<?php  echo date('d M,Y'); ?>" />
</div>

<div class="col">
	<label>End Date</label>
	<input class="" type="text" name="d_EndDate" id="d_EndDate" readonly="readonly"  value="<?php echo set_value('d_EndDate')?>" />
</div>

 <?php if(isset($_POST['n_CurrencyId']))
  {
 	$cur=$_POST['n_CurrencyId'];
  }
  else
  {
	$cur='';
  }
  ?>
<div class="col">
	<label>Default Currency</label>
	<?php
		echo currencyMyList('list',$cur);
	?>
</div>
<?php if(isset($_POST['b_ExpOtherCtry']))
  {
  	$selected="selected='selected'";
  }
  else
  {
	$selected="selected=''";
  }
  ?>
<div class="col">
	<label>Expenses in other currency</label>
	<select name="b_ExpOtherCtry" >
	    <option > Expenses In Other Currency</option>
		<option value='0' <?php echo $selected; ?> >No</option>
		<option value='1' <?php echo $selected; ?> >Yes</option>
	</select>
</div>
    
<div class="col">
	<label>Date Format</label>
	<select name="t_DateFormat" >
	   <option > --Select Date Format--</option>
		<option value='DMY' <?php if(isset($_POST['t_DateFormat'])) { if($_POST['t_DateFormat']=='DMY') { ?> selected="selected" <?php } } ?> >ddmmyyyy</option>
		<option value='YMD' <?php if(isset($_POST['t_DateFormat'])) { if($_POST['t_DateFormat']=='YMD') { ?> selected="selected" <?php } } ?> >yyyymmdd</option>
		<option value='MDY' <?php if(isset($_POST['t_DateFormat'])) { if($_POST['t_DateFormat']=='MDY') { ?> selected="selected" <?php } } ?> >mmddyyyy</option>
	</select>

</div> 

   <?php if(isset($_POST['n_Distance']))
  {
 	$dis=$_POST['n_Distance'];
  }
  else
  {
	$dis='';
  }
  ?>
<div class="col">
	<label>Distance Measure</label>
	<?php  echo distance('list',$dis,1)?>
</div></div>

<div class="right_top">
	<h2>Applicant Information</h2><span class="buttonWrap"></span></div>
<div class="formPreExp">
	
	<div class="col">
		<label>First Name</label>
		<input type="text" name="appFirstName" value="<?php echo set_value('appFirstName')?>">
	</div>

	<div class="col">
		<label>Last Name</label>
		<input type="text" name="appLastName" value="<?php echo $lastname;?>" />
	</div>

	<div class="col">
		<label>Address Line1</label>
		<input type="text" name="appAddress1" value="<?php echo $busadr3;?>"/>
	</div>

	<div class="col">
		<label>Address Line2</label>
		<input type="text" name="appAddress2" value="<?php echo $busadr4; ?>"/>
	</div>

<?php if(isset($_POST['n_CountryId_2']))
{
	$c2=$_POST['n_CountryId_2'];
}
else
{
	$c2=0;
} ?>
<div class="col">

	<label>Country</label>
	<?php echo country('list',$c2,2); ?>

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
	<input type="text" name="appPhone" onkeypress="return isNumber(event)" maxlength="11" value="<?php echo set_value('appPhone')?>">
</div>

<div class="col">
	<label>Email Address</label>
	<input type="hidden" name="uniquermail" id="uniquermail" value="">
	<input type="text" name="appEmail" id="appEmail" onkeyup="return checkemail(this.value)" value="<?php echo set_value('appEmail')?>">
</div>

<div class="col">
	<label>DOB</label>
	<input class="dat" type="text" name="appDob" id="datepicker-example1s3" value="<?php echo set_value('appDob')?>"/>
</div> 

<div class="col">
	<label>Position in Company</label>
	<input type="text" name="appCompanyPosition" value="<?php echo set_value('appCompanyPosition')?>"/>
</div>
</div>

 <?php if(isset($_POST['n_BillingType']))
  {
 	$billll=$_POST['n_BillingType'];
  }
  else
  {
	$billll='';
  }
  ?>
<div class="right_top">
<h2>Billing Information</h2>
	<span class="buttonWrap"></span></div>
	<div class="formPreExp">
		<div class="col">
			<label>Billing Type</label>
			
<?php echo billing('list',$billll,1); ?>

		</div>

	<div class="col">
		<label>Bill to Contact</label>
		<input type="text" name="t_BillingContact"  value="<?php echo set_value('t_BillingContact')?>">
	</div>

	<div class="col">
		<label>Email Address</label>
		<input type="text" name="BillingEmail" value="<?php echo set_value('BillingEmail')?>">
	</div>
 <?php if(isset($_POST['BillingPackage']))
  {
 	$pack=$_POST['BillingPackage'];
  }
  else
  {
	$pack='';
  }
  ?>
	<div class="col">
		<label>Package</label>
		
<?php echo package('list',$pack,1); ?>

	</div>

<div class="col">
	<label>Address Line1</label>
	<input type="text" name="BullingAddress" value="<?php echo $busadr5;?>"/>
</div>

<div class="col">
	<label>Address Line2</label>
	<input type="text" name="BillingAddress2" value="<?php echo $busadr6;?>" />
</div>
<?php if(isset($_POST['n_CountryId_3']))
{
	$c3=$_POST['n_CountryId_3'];
}
else
{
	$c3=0;
} ?>
<div class="col">
	<label>Country</label>
	<?php echo country('list',$c3,3); ?>
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
</div></div>

<div></div>
<div class="">
	<span class="buttonWrap">
		<input type="submit" name="submit" value="Create Business" id="submit"  class="loadbtn bluebg">
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
					console.log(data);
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



  function checkemail()
  {
      var emailId = $("#appEmail").val();
      //console.log(emailId);
      var MybaseUrl = "<?php echo base_url();?>";
      var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
      //console.log(emailId);
      if(emailId==''){
        return false;
      }
      if(filter.test(emailId)){
        $(".loadingemail").css('display', 'block');
        $("#appEmail").parent().find('span').remove();
        $.ajax({
          url: MybaseUrl+'ssa/business/checkbusinessemail',
          type: 'POST',
          dataType: 'json',
          data: {'email':emailId},
          success:function(data){

            if(data.correctemail >0){
               $('#uniquermail').val('');
              $("#appEmail").after('<span>Already have an account with this Email id</span>');
              $("#appEmail").parent().find('span').not("span:first").remove();
              $("#submit").attr('disabled', 'disabled');

              $(".loadingemail").css('display', 'none');
            }else{
            	$('#uniquermail').val('1');
            	$("#submit").attr('disabled', false);
              $(".loadingemail").css('display', 'none');
            }

          }
        });

      }else{
      	$('#uniquermail').val('');
        $("#appEmail").after('<span>Please Enter Valid Email</span>');
        $("#appEmail").parent().find('span').not("span:first").remove();
      }

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
      var countryId = "<?php echo $c1; ?>";
    //  console.log('deep='+countryId);

      var getid = 1;
      //console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					//console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected = "<?php  echo $s5; ?>";	
						console.log("Karan ="+checkSelected);
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
      var stateId = '<?php  echo $s5; ?>';
      var GetId=1;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					//console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php  echo $ct5; ?>';		
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
      var countryId = "<?php echo $c2; ?>";
      //console.log('deep='+countryId);

      var getid = 2;
     //console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					//console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected = "<?php  echo $s6; ?>";	
						//console.log("Karan ="+checkSelected);
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
      var stateId = '<?php  echo $s6; ?>';
      var GetId=2;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					//console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select State First</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php  echo $ct6; ?>';		
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
//// 3rd

// STATE BY DEAFULT  SELECTED CODE 
  $(document).ready(function(){
    $(window).bind('load',function(){
      var countryId = "<?php echo $c3; ?>";
     //console.log('deep='+countryId);

      var getid = 3;
     // console.log(countryId);
        $(".loading").css('display', 'inline-block');
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/state/',
				type: 'POST',
				dataType: 'json',
				data: {'countryId': countryId},
				success: function(data){
					//console.log(data);
					$('#StateId_'+getid).empty();		
					if(data !=0){
						$('#StateId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#StateId_'+getid).html(firstOption);	
						var checkSelected = "<?php  echo $s7; ?>";	
						//console.log("Karan ="+checkSelected);
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
      var stateId = '<?php  echo $s7; ?>';
      var GetId=3;
      //console.log(stateId);
       
       $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
					//console.log(data);
					$('#n_City_'+GetId).empty();		
					if(data !=0){
						$('#n_City_'+GetId).empty();
						var firstOption = '<option value="">Select City</option>';
						$('#n_City_'+GetId).html(firstOption);	
						var checkSelected1 = '<?php  echo $ct7; ?>';		
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

// CHECK EMAIL EXIST ON KEY UP CODE


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




// END################################

</script>
</body>
</html>
