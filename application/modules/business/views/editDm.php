<?php 

foreach ($listing as $key => $value) {
	$settingId=$value->a_SettingId;
	$settingValue=$value->t_SettingValue;
}
if(empty($settingValue)){
	$settingValue="";
}

?>

<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>


<div class="rightSide">	
<div><span class="buttonWrap"><a href="<?php echo base_url();?>ssa/admin/dmlisting/" class="loadbtn bluebg">Back</a></span>
<div class="fix"></div></div>

<form action="<?php echo base_url(); ?>ssa/admin/editdm/" method="post" name="editdm">
<input type="hidden" name="enum_type_id" id="enum_type_id" value="4" />
	<div class="right_top"><h2>Edit Measurement</h2> <span class="buttonWrap"></span>
	<div class="fix"></div></div>


<div class="formPreExp">
<input type="hidden" name="dm_id" id="dm_id" value="<?php echo $settingId?>"/>
<div class="col"><label>Distance Measure</label> <input type="text" name="dm_name" id="dm_name" value="<?php echo $settingValue; ?>"/></div>


<div class="right_top"><span class="buttonWrap"><button type="submit" name="submit" class="loadbtn bluebg">Update</button></span>
<div class="fix"></div>
</div>
<!--<h2 class="genHead">Milage</h2>

<div class="right_top">&nbsp;</div>
<h2 class="genHead">Period Spending Limits</h2>

<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Spending Limits</a></span>
<div class="fix"></div></div>
<h2 class="genHead">Period Category Restrictions</h2>
<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Category Restrictions</a></span>
<div class="fix"></div></div>-->
</div>
</form>
</section>
<div class="fix"></div>
</body>
</html>
