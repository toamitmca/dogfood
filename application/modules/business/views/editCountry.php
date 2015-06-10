<?php 
// echo "<pre>";
// print_r($listing);
// exit();
foreach ($listing as $key => $value) {
	$countryId=$value->a_CountryId;
	$countryNameValue=$value->t_CountryName;
}
if(empty($countryNameValue)){
	$countryNameValue="";
}

?>

<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>


<div class="rightSide">	
<span class="buttonWrap"><a href="<?php echo base_url();?>business/dashboard/countrylisting/" class="loadbtn bluebg">Back</a></span>

<form action="<?php echo base_url(); ?>business/dashboard/editcountry/" method="post" name="editcountry">
	<div class="right_top"><h2>Add Country</h2> <span class="buttonWrap"></span>
	<div class="fix"></div></div>


<div class="formPreExp">
<input type="hidden" name="countryId" id="countryId" value="<?php echo $countryId?>"/>
<div class="col"><label>Country</label> <input type="text" name="country_name" id="country_name" value="<?php echo $countryNameValue; ?>"/></div>
<button type="submit" name="submit" class="loadbtn bluebg">Update</button>



</div>
</form>

</div>
<div class="fix"></div>
</section>

</body>
</html>
