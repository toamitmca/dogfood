<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/countryadd/" class="loadbtn">Add Country</a></span>

	<div class="right_top">
			<h2>Country Listing</h2>
			<span class="buttonWrap"></span>

</div>
<span style="color:red;"> <?php echo $this->session->flashdata('message');?> </span>

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
    <td><a href="<?php echo base_url(); ?>ssa/admin/editcountry/<?php echo $value->a_CountryId; ?>" class="edit" for="atthFile"></a> <a  href="<?php echo base_url(); ?>ssa/admin/deletecountry/<?php echo $value->a_CountryId; ?>" class="del alert"></a> </td>
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
