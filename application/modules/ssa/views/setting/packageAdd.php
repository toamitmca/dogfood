
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/packagelisting/" class="loadbtn">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/packageadd/" method="post" name="addpackage">
	<input type="hidden" name="enum_type_id" id="enum_type_id" value="6" />
		<div class="right_top">
			<h2>Add Package Type</h2> 
			<span class="buttonWrap"></span>
			<div class="fix"></div>
		</div>
		<div class="formPreExp">
			
			
			<div class="col">
				<label>Package Type</label>
				<input type="text" name="package_name" id="package_name"/>
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add</button>
			
		</div>
	</form>
    
</div>
<div class="fix"></div>
</section>


<?php $this->load->view('layout/footer'); ?>
</body>
</html>