<?php
foreach ($city as $key2 => $value2) {
	$cityName=$value2->t_CityName;
	$cityId=$value2->a_CityId;
	$n_StateId=$value2->n_StateId;
	$n_CountryId=$value2->n_CountryId;
}
// echo "<pre>";
// print_r($city);
// echo "</br>";
// p($country);
// echo "</br>";
// p($state);
// exit(); 
?>

<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/citylisting/" class="loadbtn bluebg">Back</a>
		</span>
		<div class="fix"></div>
	</div>
	<form action="<?php echo base_url(); ?>ssa/admin/editcity/" method="post" name="editcity">
	<input type="hidden" name="city_id" id="city_id" value="<?php echo $cityId;?>">
		<div class="right_top">
			<h2>Add City</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
		</div>
		<div class="formPreExp">
			<div class="col">
				<label>Country</label>
				<select name="country_id" id="country_id">
					<option value="">Select a Country</option>
					<?php foreach ($country as $key => $value) {?>
						<?php if($n_CountryId==$value->a_CountryId){ $select="selected"; }else{ $select=""; } ?>
						 <option value="<?php echo $value->a_CountryId; ?>" <?php echo $select; ?>><?php echo $value->t_CountryName; ?></option>
					<?php } ?>
				 
				</select>
			</div>

			<div class="col">
				<label>State</label>
				<select name="state_id" id="state_id">
					<option value="">Select a State</option>
					<?php foreach ($state as $key1 => $value1) {?>
					<?php if($n_StateId==$value1->a_StateId){ $select="selected"; }else{ $select=""; } ?>
						 <option value="<?php echo $value1->a_StateId; ?>" <?php echo $select; ?>><?php echo $value1->t_StateName; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col">
				<label>City</label>
				<input type="text" name="city_name" id="city_name" value="<?php echo $cityName; ?>"/>
			</div>
			<div class="right_top">
				<span class="buttonWrap">
					<button type="submit" name="submit" class="loadbtn bluebg">Update</button>
				</span>
				<div class="fix"></div>
			</div>
		</div>
	</form>
</section>

<div class="fix"></div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">

	$("#country_id").on('change',function(){
		$("#state_id").empty();
		$("#state_id").html("<option value=''>Select a State</option>");
		var countryId=$("#country_id").val();
	
		$.ajax({
		  url: "<?php echo base_url();?>ssa/admin/getStateDropDown",
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
</script>

</body>
</html>