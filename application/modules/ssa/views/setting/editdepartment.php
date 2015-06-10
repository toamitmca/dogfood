<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
	<?php //p($deplist);
	//exit(); ?>
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/departmentlisting/" class="loadbtn">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/editdepartment/<?php echo $deplist->a_DeptId;  ?>" method="post" name="adddept">
		<div class="right_top">
			<h2>Add Department</h2> 
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
				<label>Business</label>
				<select name="business_id" id="business_id">
				<option value="">Select a Business</option>
				<?php foreach ($buslist as $key => $value) {?>
					 <option value="<?php echo $value->a_BusinessId; ?>" <?php if($value->a_BusinessId==$deplist->n_BusinessId){ ?> selected="selected" <?php } ?>><?php echo $value->t_BusinessName; ?></option>
				<?php } ?>
				 
				</select>
			</div>
			<br />
			<div class="col">
				<label>Department Name</label>
				<input type="text" name="dept_name" value="<?php echo $deplist->t_DeptName; ?>" id="business_name_0"/>
			</div>
				<div class="col">
				
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add Department</button>
			
		</div>
	</form>
    
 </div>   
 <div class="fix"></div>   
</section>

</body>
</html>
