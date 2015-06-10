<section class="main_caintainer">
<?php $this->load->view('businessleftadmin'); ?>
<div class="rightSide">
<span class="buttonWrap"> <a href="<?php  echo base_url(); ?>ssa/business/businessadmin" class="loadbtn">Add Business Admin</a> </span>
    <div class="right_top">
            <h2>Business Admin Listing</h2>

        <span class="buttonWrap"></span>

    </div>
<?php echo $this->session->flashdata('message');?>
<div class="Expenses">
    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>Sr.No.</th>
        <th>Business admin name</th>
       <th>Business  name</th>
        <th>Email Id</th>
        <th>Contact No</th>
         <th>Status</th>
        <th style="width:135px;">Action</th>
    </tr>
<?php $i=1;
if($data !=="Something Went Wrong"){
    foreach ($data as  $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
     <td><a href="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $value->a_BusnAdminId; ?>" class="" for="atthFile"><?php echo $value->t_FirstName.' '.$value->t_LastName; ?></a></td>
    <td><a href="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $value->a_BusnAdminId; ?>" class="" for="atthFile"> <?php echo $value->t_BusinessName ;?></a></td>
    <td><a href="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $value->a_BusnAdminId; ?>" class="" for="atthFile"> <?php echo $value->t_Email ;?></a></td>
<td><a href="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $value->a_BusnAdminId; ?>" class="" for="atthFile"> <?php echo $value->t_Contact ;?></a></td>
<td><a href="<?php echo base_url(); ?>ssa/business/buseditbysys/<?php echo $value->a_BusnAdminId; ?>" class="" for="atthFile"> <?php  if($value->b_Status==1)
  {
      echo "Open";
  }else
  {
    echo "Blocked";
  }
   ?></a></td>

       <td><!-- <a href="<?php // echo base_url(); ?>ssa/business/buseditbysys/<?php  //echo $value->a_BusnAdminId; ?>" class="edit" for="atthFile"></a> -->
         <a title="Closed"  href="<?php echo base_url(); ?>ssa/business/deletebusadmin/<?php echo $value->a_BusnAdminId; ?>" class="del alert"></a> 

    <?php  if($value->b_Status==1){ ?>
    <a href="<?php echo base_url(); ?>ssa/business/inactivbusadmin/<?php echo $value->a_BusnAdminId; ?>" class="inactive" for="atthFile1">Blocked</a>
  <?php } else { ?>
   <a href="<?php echo base_url(); ?>ssa/business/activebusadmin/<?php echo $value->a_BusnAdminId; ?>" class="active_button" for="atthFile1">Open</a>
  <?php } ?>
    </td>
  </tr>
  <?php  $i++; }

}else{
    echo "No record Found";
}?>

</tbody></table>

</div>

</div>
<div class="fix"></div>
</section>
<?php $this->load->view('layout/footer'); ?>
</body>
</html>
