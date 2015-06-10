<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>


<div class="rightSide">	
<span class="buttonWrap"><a href="<?php echo base_url();?>ssa/admin/countrylisting/" class="loadbtn bluebg">Back</a></span>

<form action="<?php echo base_url(); ?>ssa/admin/countryadd/" method="post" name="addcountry">
	<div class="right_top"><h2>Add Country</h2> <span class="buttonWrap"></span>
	<div class="fix"></div></div>


<div class="formPreExp">
<div class="col"><label>Country</label> <input type="text" name="country_name" id="country_name"/></div>
<button type="submit" name="submit" class="loadbtn bluebg">Add</button>


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
</div>
<div class="fix"></div>
</section>

</body>
</html>
