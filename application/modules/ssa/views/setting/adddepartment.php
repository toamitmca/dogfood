<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>
<div class="rightSide">	
	
		<span class="buttonWrap">
			<a href="<?php echo base_url();?>ssa/admin/departmentlisting/" class="loadbtn">Back</a>
		</span>
	
	<form action="<?php echo base_url(); ?>ssa/admin/department_add/" method="post" name="adddept">
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
					 <option value="<?php echo $value->a_BusinessId; ?>"><?php echo $value->t_BusinessName; ?></option>
				<?php } ?>
				 
				</select>
			</div>
			<br />
			<div class="col">
				<label>Department Name</label>
				<input type="text" name="dept_name[]" id="business_name_0"/>
			</div>
				<button type="button" name="add_more" id="add_more">Add More</button>
			
				<span id="add_new"></span>
			
			<div class="col">
				
			</div>
            <button type="submit" name="submit" class="loadbtn bluebg">Add Department</button>
			
		</div>
	</form>
    
 </div>   
 <div class="fix"></div>   
</section>
<?php $this->load->view('layout/footer');  ?>
<script type="text/javascript">
var i=1;
$(document).ready(function(){
	$("#add_more").on('click',function(){
		$("#add_new").append("<div class='col' id='rem_div"+i+"'><label></label><input type='text' name='dept_name[]' style='width:45%'  id='business_name_"+i+"'><span class='del' style='display:inline-block' id="+i+"></span></div> <br />");
	i++;
	});
});
$(document.body).on('click','.del',function(){
	var id=$(this).attr('id');
	console.log(id);
	$("#rem_div"+id).remove();
});

</script>
</body>
</html>
