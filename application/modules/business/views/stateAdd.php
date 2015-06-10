<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/statelisting/" class="loadbtn bluebg">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/stateadd/" method="post" name="addstate">
		<div class="right_top">
			<h2>Add State</h2> 
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
				<label>State</label>
				<input type="text" name="state_name" id="state_name"/>
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add</button>
			
		</div>
	</form>
    
 </div>   
 <div class="fix"></div>   
</section>


</body>
</html>
