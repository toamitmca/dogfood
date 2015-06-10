<section class="main_caintainer">
 <?php $this->load->view('sadminleft'); ?>
<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/superadmin/superadminAdd/" class="loadbtn">Add New System Admin</a></span>
	<div class="right_top">
			<h2>System Admin Listing</h2>
			<span class="buttonWrap"></span>
		    <div class="fix">
	</div>
</div>
<?php 
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
<div class="Expenses systlisting">
	<table border="1" style="width:100%;">
    <tbody>
    <tr>
    	<th>Sr.No.</th>
    	<th>Full Name</th>
    	<th>Email Id</th>
    	<th>Created On</th>
      <th>Status</th>
    	<th>Action</th>
    </tr>
   <?php     $i=1;
    if(!empty($response)){
    foreach ($response as $key => $value) {

if($value->a_SysloginId !==$current_admin_id) {

   ?>
   <tr>
    <td><?php echo $i;?></td>
	  <td><a href="<?php  echo base_url();?>ssa/superadmin/editsystemadmin/<?php echo $value->a_SysloginId;?>"><?php echo $value->firstName.' '.$value->lastName;?></a></td>
    <td><a href="<?php  echo base_url();?>ssa/superadmin/editsystemadmin/<?php echo $value->a_SysloginId;?>"><?php echo $value->t_username; ?></a></td>
    <td><a href="<?php  echo base_url();?>ssa/superadmin/editsystemadmin/<?php echo $value->a_SysloginId;?>"><?php echo date('d M, Y', strtotime($value->d_createdon));?></a></td>
    <td><a href="<?php  echo base_url();?>ssa/superadmin/editsystemadmin/<?php echo $value->a_SysloginId;?>"><?php if($value->IsActive=='Active'){echo 'Open';} else{echo 'Blocked';}  ?></a></td>
    <td>
    	<!-- <a class="edit" href="<?php //echo base_url();?>ssa/superadmin/editsystemadmin/<?php //echo $value->a_SysloginId; ?>"></a> -->
    	<a title="Closed" class="del alert" href="<?php echo base_url();?>ssa/superadmin/deletesystemadmin/<?php echo $value->a_SysloginId; ?>"></a>
<?php if($value->IsActive!='Active') { ?>
      <a class="active_button " href="<?php echo base_url();?>ssa/superadmin/activesystemadmin/<?php echo $value->a_SysloginId; ?>">Open</a>
      <?php } else { ?>
      <a class="inactive " href="<?php echo base_url();?>ssa/superadmin/inactivesystemadmin/<?php echo $value->a_SysloginId; ?>">Blocked</a>
      <?php } ?>
    </td>
  </tr>
  <?php  $i++; } }
		}
  ?>


</tbody></table>
	
</div>
</div>

</section>
<div class="fix"></div>
</body>
</html>