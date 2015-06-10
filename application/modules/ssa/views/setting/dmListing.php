<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/dmadd/" class="loadbtn">Add Measurement</a></span>

	<div class="right_top">
			<h2>Measurement Listing</h2>
			<span class="buttonWrap"></span>
		    <div class="fix">
	</div>
</div>

<?php echo $this->session->flashdata('message');?>
<div class="Expenses Expenses2">
	<table border="1" style="width:100%;">
    <tbody>
    <tr>
    	<th>&nbsp;&nbsp;</th>
     
    	<th>Measurement Name</th>
    	<th>&nbsp;</th>
    </tr>
<?php $i=1;
if(!empty($listing)){
   foreach ($listing as $key => $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
    
    <td><?php echo $value->t_SettingValue; ?></td>
    <td><a href="<?php echo base_url(); ?>ssa/admin/editdm/<?php echo $value->a_SettingId; ?>" class="edit" for="atthFile"></a>
        <a href="<?php echo base_url(); ?>ssa/admin/deletedm/<?php echo $value->a_SettingId; ?>" class="del alert"></a>
    </td>
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
