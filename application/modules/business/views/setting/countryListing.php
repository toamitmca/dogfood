<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/countryadd/" class="loadbtn bluebg">Add Country</a></span>

	<div class="right_top">
			<h2>Country Listing</h2>
			<span class="buttonWrap"></span>

</div>


<div class="Expenses">
	<table border="1" style="width:100%;">
    <tbody>
    <tr>
    	<th>&nbsp;&nbsp;</th>
    	<th>Country Name</th>
    	<th>&nbsp;</th>
    </tr>
<?php $i=1;
if(!empty($listing)){
   foreach ($listing as $key => $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $value->t_CountryName; ?></td>
    <td><a  href="<?php echo base_url(); ?>ssa/admin/deletecountry/<?php echo $value->a_CountryId; ?>" class="bug alert"></a> <a href="<?php echo base_url(); ?>ssa/admin/editcountry/<?php echo $value->a_CountryId; ?>" class="link" for="atthFile"></a></td>
  </tr>
  <?php  $i++; }
?>
<?php }else{
  echo "No record Found";
  } ?>
   
  
  
</tbody></table>
	
</div>

</div>
<div class="fix"></div>
</section>

</body>
</html>
