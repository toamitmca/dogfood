<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/citylisting/" class="loadbtn">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/cityadd/" method="post" name="addstate">
		<div class="right_top">
			<h2>Add City</h2> 
			<span class="buttonWrap"></span>
			
			<div class="fix">
				<?php if(validation_errors()!='')
			{
			echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
			} ?>
			</div>
		</div>
		<div class="formPreExp">
			<div class="col">
				<label>Country</label>
				<select name="country_id" id="country_id">
					<option value="">Select a Country</option>
					<?php foreach ($listing as $key => $value) {?>
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
				<input type="text" name="city_name" id="city_name"/>
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add</button>
			
		</div>
	</form>
</div>
<div class="fix"></div>    
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