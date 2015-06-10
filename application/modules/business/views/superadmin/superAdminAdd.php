<section class="main_caintainer">
 <?php $this->load->view('sadminleft'); ?>
<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/countryadd/" class="loadbtn bluebg">Add Country</a></span>

	<div class="right_top">
			<h2>Supper Admin Listing</h2>
			<span class="buttonWrap"></span>
		    <div class="fix">
	</div>
</div>
<?php 
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>

<div class="Expenses">
	<table border="1" style="width:100%;">
    <tbody>
    <tr>
    	<th>&nbsp;&nbsp;</th>
    	<th>System Admin Name</th>
    	<th>Created On</th>
    	<th></th>
    </tr>
   <?php 
    $i=1;
    if(!empty($response)){
    foreach ($response as $key => $value) {
   ?>
   <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $value->t_username; ?></td>
    <td><?php echo $value->d_createdon; ?></td>
    <td><a  href="<?php echo base_url(); ?>ssa/admin/deletecountry/<?php echo $value->a_SysloginId; ?>" class="bug alert"></a> <a href="<?php echo base_url(); ?>ssa/admin/editcountry/<?php echo $value->a_SysloginId; ?>" class="link" for="atthFile"></a></td>
  </tr>
  <?php  $i++; }
		}
  ?>
  
  
</tbody></table>
	
</div>



</section>
<div class="fix"></div>
</body>
</html>