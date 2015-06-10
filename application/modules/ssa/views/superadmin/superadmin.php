<section class="main_caintainer">
<?php $this->load->view('sadminleft'); ?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url();?>ssa/superadmin/listing/" class="loadbtn">System Admin Listing</a></span>

<div class="right_top"><h2>Create New System Admin</h2> <span class="buttonWrap"></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}

	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>

<form action="<?php echo base_url();?>ssa/superadmin/superadminAdd/" method="post"> 

<div class="formPreExp">

<div class="col">
		<label>Status</label>
		<Select name="status">
			<option value="Active"  <?php echo set_select('status', 'Active', TRUE); ?>  >Open</option>
			<option value="Blocked" <?php echo set_select('status', 'Inactive'); ?> >Blocked</option>

		</Select>
	</div>

	<div class="col">
		<label>First Name</label>
		<input type="text" name="firstName" value="<?php echo set_value('firstName')?>" >
	</div>
	<div class="col">
		<label>Last Name</label>
		<input type="text" name="lastName" value="<?php echo set_value('lastName');?>" >
	</div>
	<div class="col datecol">
		<label>DOB</label>
		<input type="text" name="dob" class="datepicker_all" value="<?php echo set_value('dob');?>" >
	</div>

<div class="col">
		<label>Email Id</label>
		<input type="text" name="t_username" id="t_username" onkeyUp="return emailfunction($(this));" value="<?php echo set_value('t_username');?>" >
		<div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>
	</div>

<div class="col">
		<label>Address1 </label>
		<input type="text" name="t_Address1" value="<?php echo set_value('t_Address1');?>" >
	</div>

	<div class="col">
		<label>Address2</label>
		<input type="text" name="t_Address2" value="<?php echo set_value('t_Address2');?>" >
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
    <?php
   if(isset($_POST['n_StateId_1']))
   {
   	 $st = $_POST['n_StateId_1'];
   }
   else {
   	$st = '';

   }
    
   if(isset($_POST['n_CityId_1']))
   {
   	 $ct = $_POST['n_CityId_1'];
   }
   else {
     $ct = '';
   }
     ?>
	<div class="col">
		<label>State</label>
		<select name="n_StateId_1" id="StateId_1" onchange="return getCity(1);">
			<option value="">Select State</option>
		</select>
		<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	</div>
	<div class="col">
		<label>City</label>
		<select name="n_CityId_1" id="CityId_1" >
			<option value="">Select City</option>
		</select>
		<span class="loading1" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	</div>
	<div class="col">
	<?php $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
          $chars = 8;
          $randomString=  substr(str_shuffle($letters), 0, $chars);
          // $password= generateRandomString(6);
          $password= $randomString; ?>
		
		<input type="hidden" name="t_password" readonly="readonly" value="<?php echo $password; ?>" >
	</div>

<input type="submit" name="submit" value="Save" class="loadbtn bluebg">

</div>
</form>
</div>
<div class="fix"></div>
</section>

<?php $this->load->view('layout/footer');?>
<script>
	function getstate(getid){
		var countryId = $("#country").val();
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

function getCity(getid){
		var StateId = $('#StateId_'+getid).val();
		$(".loading").css('display', 'inline-block');
		$.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': StateId},
				success: function(data){
					console.log(data);
					$('#CityId_'+getid).empty();		
					if(data !=0){
						$('#CityId_'+getid).empty();
						var firstOption = '<option value="">Select City</option>';
						$('#CityId_'+getid).html(firstOption);		
						$.each(data, function(index, value) {
							var SelectData  = "<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
							$('#CityId_'+getid).append(SelectData);
						});
						$(".loading").css('display', 'none');
					}
					if(data ==0){
						var selectData = '<option value="0">Select State</option>';
						$('#CityId_'+getid).append(selectData);
						$(".loading").css('display', 'none');
					}
				}
			});
				
	}


	function emailfunction(){
		var emailId = $("#t_username").val();
		var MybaseUrl = "<?php echo base_url();?>";
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		//console.log(emailId);
		if(emailId==''){
			return false;
		}
		if(filter.test(emailId)){
			$(".loadingemail").css('display', 'block');
			$("#t_username").parent().find('span').remove();
			$.ajax({
				url: MybaseUrl+'ssa/superadmin/checkEmail/',
				type: 'POST',
				dataType: 'json',
				data: {'email':emailId},
				success:function(data){
					if(data.myworkdone >0){
						$("#t_username").after('<span>Already have an account with this mail id</span>');
						$("#t_username").parent().find('span').not("span:first").remove();
						$(".loadingemail").css('display', 'none');
					}else{
						$(".loadingemail").css('display', 'none');
					}
					
				}
			});
		
		}else{
			$("#t_username").after('<span>Please Enter Valid Email</span>');
			$("#t_username").parent().find('span').not("span:first").remove();
		}
		
	}

	$(document).ready(function(){
		$(window).bind('load',function(){
			var countryId = '<?php echo $c1;?>';
			var getid = 1;
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
						var checkSelected = '<?php echo $st; ?>';	
						$.each(data, function(index, value) {
							console.log(checkSelected);
							if(checkSelected==value.a_StateId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_StateId+"'>"+value.t_StateName+"</option>";
							$('#StateId_'+getid).append(SelectData);
						});
						$(".loading").css('display', 'none');
					}
					if(data ==0){
						var selectData = '<option value="0">Select State</option>';
						$('#StateId_'+getid).append(selectData);
						$(".loading").css('display', 'none');
					}
				}
			});
			// end of window
		});		
	});

$(document).ready(function(){
		$(window).bind('load',function(){
			var StateId = '<?php echo $st;?>';
			var getid = 1;
				$(".loading").css('display', 'inline-block');
		    $.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': StateId},
				success: function(data){
					$('#CityId_'+getid).empty();		
					if(data !=0){
						$('#CityId_'+getid).empty();
						var firstOption = '<option value="">Select State</option>';
						$('#CityId_'+getid).html(firstOption);	
						var checkSelected = '<?php echo $ct; ?>';	
						$.each(data, function(index, value) {
							console.log(checkSelected);
							if(checkSelected==value.a_CityId){var selected = "selected";}else{ selected = "";}
							var SelectData  = "<option "+selected+" value='"+value.a_CityId+"'>"+value.t_CityName+"</option>";
							$('#CityId_'+getid).append(SelectData);
						});
						$(".loading").css('display', 'none');
					}
					if(data ==0){
						var selectData = '<option value="0">Select Country</option>';
						$('#CityId_'+getid).append(selectData);
						$(".loading").css('display', 'none');
					}
				}
			});
			// end of window
		});		
	});


</script>
</body>
</html>
