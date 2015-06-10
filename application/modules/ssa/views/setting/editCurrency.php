<?php 
// echo "<pre>";
// print_r($country);
// exit();
foreach ($currency as $key => $value) {
	$a_CountryId=$value->n_CountryId;
	$a_CurrencyId=$value->a_CurrencyId;
	$t_CurrencyName=$value->t_CurrencyName;
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
			
		</span>
		<div class="fix"></div>
	</div>
	<form action="<?php echo base_url(); ?>ssa/admin/editcurrency/" method="post" name="addcurrency">
		<div class="right_top">
        <a href="<?php echo base_url();?>ssa/admin/currencylisting/" class="loadbtn">Back</a>
			<h2>Edit Currency</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
		</div>
		<div class="formPreExp">
		<input type="hidden" name="currency_id" id="currency_id" value="<?php echo $a_CurrencyId?>"/>
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
				<label>Currency</label>
				<input type="text" name="currency_name" id="currency_name" value="<?php echo $t_CurrencyName; ?>"/>
			</div>
			<div class="right_top">
				<span class="buttonWrap">
					<button type="submit" name="submit" class="loadbtn bluebg">Update</button>
				</span>
				<div class="fix"></div>
			</div>
		</div>
	</form>
    </div>
</section>
<div class="fix"></div>
</body>
</html>
