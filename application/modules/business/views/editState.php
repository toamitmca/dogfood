<?php 
// echo "<pre>";
// print_r($country);
// exit();
foreach ($state as $key => $value) {
	$a_CountryId=$value->n_CountryId;
	$a_StateId=$value->a_StateId;
	$t_StateName=$value->t_StateName;
}
if(empty($t_StateName)){
	$t_StateName="";
}
?>
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/statelisting/" class="loadbtn bluebg">Back</a>
		</span>
		<div class="fix"></div>
	</div>
	<form action="<?php echo base_url(); ?>ssa/admin/editstate/" method="post" name="addstate">
		<div class="right_top">
			<h2>Add State</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
		</div>
		<div class="formPreExp">
		<input type="hidden" name="stateId" id="stateId" value="<?php echo $a_StateId?>"/>
			<div class="col">
				<label>Country</label>
				<select name="country_id" id="country_id">
				<option value="">Select a Country</option>
				
				<?php foreach ($country as $key1 => $value1) {?>
					<?php if($a_CountryId==$value1->a_CountryId){ $select="selected"; }else{ $select=""; } ?>
					<option value="<?php echo $value1->a_CountryId; ?>" <?php echo $select; ?>><?php echo $value1->t_CountryName; ?></option>
					
				<?php } ?>
				 
				</select>
			</div>
			<div class="col">
				<label>State</label>
				<input type="text" name="state_name" id="state_name" value="<?php echo $t_StateName; ?>"/>
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
</body>
</html>
