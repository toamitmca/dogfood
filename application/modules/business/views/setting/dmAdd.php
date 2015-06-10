
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/dmlisting/" class="loadbtn bluebg">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/dmadd/" method="post" name="adddm">
	<input type="hidden" name="enum_type_id" id="enum_type_id" value="4" />
		<div class="right_top">
			<h2>Add City</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
		</div>
		<div class="formPreExp">
			<div class="col">
				<label>Type</label>
				<select name="type_id" id="type_id">
					<option value="">Select a Value</option>
					<option value="0">For One</option>
					<option value="1">For All</option>
				</select>
			</div>
			<div class="col" id="business_name_div">
				<label>Business Name</label>
				<select name="business_name_id" id="business_name_id">
					<option value="">Select a Name</option>
					<?php foreach ($listing as $key => $value) {?>
						 <option value="<?php echo $value->a_BusinessId; ?>"><?php echo $value->t_BusinessName; ?></option>
					<?php } ?>
				 
				</select>
			</div>
			<div class="col">
				<label>Distance Measure</label>
				<input type="text" name="dm_name" id="dm_name"/>
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add</button>
			
		</div>
	</form>
    
</div>
<div class="fix"></div>
</section>


<?php $this->load->view('layout/footer'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#business_name_div").hide();
});
$("#type_id").on('change',function(){
	var typeValue=$("#type_id").val();
	if(typeValue=="1"){
		$("#business_name_div").show();
	}else{
		$("#business_name_div").hide();
	}
});

</script>

</body>
</html>