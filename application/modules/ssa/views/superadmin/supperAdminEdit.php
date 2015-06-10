<section class="main_caintainer">
<?php $this->load->view('sadminleft'); ?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url();?>ssa/superadmin/listing/" class="loadbtn">System Admin Listing</a></span>


<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}

	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
<script type="text/javascript">
    $(document).ready(function(){
		$(".right_topss").click(function(){
		$(".toggpas").slideToggle();
		});
		});
    </script>
<form action="<?php echo base_url();?>ssa/superadmin/editsystemadmin/<?php echo $response->a_SysloginId; ?>" method="post"> 
<div class="formPreExp ch">
	<?php 	$address = explode('___',$response->t_Address);?>
<input type="hidden" name="adminid" id="adminid" value="<?php echo $response->a_SysloginId; ?>"  >
	<div class="right_top"><h2 id="changePass" class="secIcon right_topss">Change password & Security answer </h2> <span class="buttonWrap"></span>
	<div id="msg1" style="color:green;"   ></div>
	<div id="msg" style="color:green;"></div>
	
    <table class="tabS toggpas">
	<tr><td><input type="button" name="" value="Change Password" onclick="return badminpassword (this.value)" class="loadbtn bluebg"></td> <td><input type="button" name="" value="Change Security Answer" onclick="return badminans (this.value)" class="loadbtn bluebg"></td><td> <span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span></td></tr>
	<!--<tr> <td><input type="button" name="" value="Change Password" onclick="return badminpassword (this.value)" class="loadbtn bluebg"></td></tr>
    -->
    </table>
</div>

     <div class="col">
		<label>Status</label>
		<Select name="status">
			<option value="Active" <?php if($response->IsActive=="Active"){echo 'selected="selected"';} ?> <?php echo set_select('status', 'Active'); ?>  > Open</option>
			<option value="Blocked" <?php if($response->IsActive=="Blocked"){echo 'selected="selected"';} ?> <?php echo set_select('status', 'Blocked'); ?>  > Blocked</option>
		</Select>
		</div>
	<div class="col">
		<label>First Name</label>
		<input type="text" name="firstName" value="<?php echo $response->firstName; ?><?php echo set_value('firstName');?>" >
	</div>
	<div class="col">
		<label>Last Name</label>
		<input type="text" name="lastName" value="<?php echo $response->lastName;?><?php echo set_value('lastName');?>" >
	</div>

<div class="col mydate">
		<label>DOB</label>

		<input type="text" class="datepicker_all " name="dob" value="<?php echo date('d M, Y', strtotime($response->t_Dob));?><?php echo set_value('dob');?>" >
	</div>




	<div class="col">
		<label>Country</label>
		<?php echo country('list',$response->n_CountryId,1); ?>
	</div>

	<div class="col">
		<label>State</label>
		<select name="n_StateId_1" id="StateId_1" onchange="return getCity(1);">
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
		<input readonly="readonly" type="text" name="t_username" id="t_username" value="<?php  echo $response->t_username;?>" >
		<div class="loadingemail" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></div>
	</div>
	
<input type="submit" name="submit" value="Update" class="loadbtn bluebg">

</div>
</form>
<div class="fix"></div>
</div></section>

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
		
		var stateId = $("#StateId_"+getid).val();
		$(".loading").css('display', 'inline-block');
		$.ajax({
				url: '<?php echo base_url();?>ssa/business/city/',
				type: 'POST',
				dataType: 'json',
				data: {'stateId': stateId},
				success: function(data){
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

function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}


function badminans(){
  var Mybase_url = base_url();
    
/*
var ans= $('#answer').val();
var cans =$('#canswer').val();*/
var id = $('#adminid').val();

if (confirm("Do you want to change Security answer !") == true) {
	$(".loading").css('display', 'inline-block');

$.ajax({
       url: Mybase_url+'ssa/superadmin/systemadminans/',
        type:'POST',
        data: { 'id':id},
        success: function(data){
          console.log(data);
          $('#msg1').html('Email has ben sent on the registered email id for Changing Security Answer.');
          $(".loading").css('display', 'none');
        }
      });

}

}

function badminpassword(){
	 
  var Mybase_url = base_url();
var id = $('#adminid').val();
if (confirm("Do you want to change Password !") == true) {
	 $(".loading").css('display', 'inline-block');
$.ajax({
       url: Mybase_url+'ssa/superadmin/systemadminpassword/',
        type:'POST',
        data: { 'id':id,},
        success: function(data){
          console.log(data);
       $('#msg').html('Email has ben sent on the registered email id for password reset.');
        $(".loading").css('display', 'none');

        }
      });
}
}
</script>
</body>
</html>
