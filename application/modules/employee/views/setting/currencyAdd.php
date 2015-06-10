<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/currencylisting/" class="loadbtn bluebg">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/currencyadd/" method="post" name="addcurrency">
		<div class="right_top">
			<h2>Add Currency</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
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
				<label>Currency</label>
				<input type="text" name="currency_name" id="currency_name"/>
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add</button>
			
		</div>
	</form>
    
</div>
<div class="fix"></div>    
</section>

</body>
</html>
