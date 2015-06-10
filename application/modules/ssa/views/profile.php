<section class="main_caintainer">
<?php $this->load->view('profileleft'); ?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url();?>ssa/superadmin/listing/" class="loadbtn">System Admin Listing</a></span>

<div class="right_top"><h2>Profile</h2> <span class="buttonWrap"></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}

	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>

<form action="<?php echo base_url();?>ssa/superadmin/profile" method="post"> 
<div class="formPreExp">
	<?php 	$address = explode('___',$response->t_Address); ?>
	<div class="col">
		<label>First Name</label>
		<input type="text" name="firstName" readonly="readonly" value="<?php echo $response->firstName; ?><?php echo set_value('firstName');?>" >
	</div>
	<div class="col">
		<label>Last Name</label>
		<input type="text" name="lastName" readonly="readonly" value="<?php echo $response->lastName;?><?php echo set_value('lastName');?>" >
	</div>
	<div class="col">
		<label>Country</label>
		<?php echo country('list',$response->n_CountryId,1 ); ?>
	</div>

	<div class="col">
		<label>State</label>
		<select style="width:48%;" name="n_StateId_1" id="StateId_1" onchange="return getCity(1);">
			<option value="">Select Country</option>
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
		<label>Address </label>
		<input type="text" name="t_Address1" value="<?php echo $address[0]; echo set_value('t_Address1');?>" >
	</div>

	<div class="col">
		<label>Address</label>
		<input type="text" name="t_Address2" value="<?php echo $address[1];  echo set_value('t_Address2');?>" >
	</div>
	<div class="col">
		<label>Email Id</label>
		<input readonly="readonly" type="text" name="t_username" id="t_username" readonly="readonly" value="<?php  echo $response->t_username;?>" >
		<div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>
	</div>
	<div class="col">
		<label>Security Ans</label>
		<input type="password"  name="seq_ans" value="<?php echo $response->n_sec_answ;   echo set_value('seq_ans');?>" >
	</div>

<input type="submit" name="submit" value="Update" class="loadbtn bluebg">

</div>
</form>
<div class="fix"></div>
</div>
</section>

<?php $this->load->view('layout/footer');?>
<script>


$(document).ready(function() {
var  checkflogin ="<?php echo $firstlogin->fpasschange; ?>"
var myurl ="<?php echo base_url();?>";
if(checkflogin==3){
 alert("Please change the  Security answer ");
 $.ajax({
                    url: myurl+'ssa/superadmin/firstloginupdate',
                    type:'POST',
                    dataType:'json',
                    data: {'act_mode':'systemadminloginup'},
                    success: function(data1){
                    console.log(data1);
                                       }
                    });
}
 });






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


	$(document).ready(function(){
		$(window).bind('load',function(){
			var countryId = '<?php echo $response->n_CountryId;?>';
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
						var checkSelected = '<?php echo $response->n_StateId; ?>';	
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


$(document).ready(function(){
		$(window).bind('load',function(){
			var StateId = '<?php echo $response->n_StateId;?>';
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
						var checkSelected = '<?php echo $response->n_CityId; ?>';
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

	
</script>
</body>
</html>
