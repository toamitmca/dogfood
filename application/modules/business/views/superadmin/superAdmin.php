<section class="main_caintainer">
<?php $this->load->view('sadminleft'); ?>

<div class="rightSide">
<span class="buttonWrap"><a href="" class="loadbtn bluebg">New Business</a></span>

<div class="right_top"><h2>Create New Super Admin</h2> <span class="buttonWrap"></span>
<div class="fix"></div></div>
<?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}

	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
	
<?php ?>
<form action="<?php echo base_url();?>ssa/superadmin/superadminAdd/" method="post"> 
<div class="formPreExp">
	<div class="col">
		<label>Email Id</label>
		<input type="text" name="t_username" value="<?php echo set_value('t_username');?>" >
	</div>
	<div class="col">
		<label>Password</label>
		<input type="text" name="t_password" value="<?php echo set_value('t_password');?>" >
	</div>

<input type="submit" name="submit" value="Create Super Admin" class="loadbtn bluebg">

</div>
</form>
<div class="fix"></div>
</section>

</body>
</html>
