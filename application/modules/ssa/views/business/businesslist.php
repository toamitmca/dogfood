<section class="main_caintainer">
<?php $this->load->view('businessLeft'); ?>
<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/business/business_add/" class="loadbtn">Add Business</a></span>
    <div class="right_top">
            <h2>Business Listing</h2>
            <span class="buttonWrap"></span>

    </div>
<?php echo $this->session->flashdata('message');?>
<div class="Expenses">
    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>&nbsp;&nbsp;</th>
        <th>Business Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th style="width:135px;">Action</th>
    </tr>
<?php $i=1;
if(!empty($data)){
    foreach ($data as  $value) {
 $c1date=date('d M, Y', strtotime($value->d_EndDate));
 $c2date=date('d M, Y', strtotime('1/01/1970'));
      ?>
      <tr>
    <td><?php echo $i;  ?></td>
     <td><a href="<?php echo base_url(); ?>ssa/business/business_edit/<?php echo $value->a_BusinessId; ?>" for="atthFile"><?php echo $value->t_BusinessName; ?></a></td>



    <td> <a href="<?php echo base_url(); ?>ssa/business/business_edit/<?php echo $value->a_BusinessId; ?>" for="atthFile"><?php echo date('d M, Y', strtotime($value->d_StartDate));?></a></td>
   
  
    <td> <a href="<?php echo base_url(); ?>ssa/business/business_edit/<?php echo $value->a_BusinessId; ?>" for="atthFile"><?php if(($c1date==$c2date) OR ($value->n_Status==2)){ echo 'N/A'; } else { echo date('d M, Y', strtotime($value->d_EndDate)); }?></a></td>
    <td> <a href="<?php echo base_url(); ?>ssa/business/business_edit/<?php echo $value->a_BusinessId; ?>" for="atthFile"><?php if($value->n_Status==2){ echo "Open"; } else { echo "Close"; } ?></a></td>

     
        <td> <!-- <a  href="<?php // echo base_url(); ?>ssa/business/business_edit/<?php // echo $value->a_BusinessId; ?>" class="edit" for="atthFile"></a> -->
         <a  href="<?php echo base_url(); ?>ssa/business/business_delete/<?php echo $value->a_BusinessId; ?>" class="del alert"></a> 

    <?php if($value->n_Status==2){ ?>
    <a href="<?php echo base_url(); ?>ssa/business/business_status/<?php echo $value->a_BusinessId; ?>/<?php echo $value->n_Status; ?>" class="inactive" for="atthFile1">Close</a>
  <?php } else { ?>
   <a href="<?php echo base_url(); ?>ssa/business/business_status/<?php echo $value->a_BusinessId; ?>/<?php echo $value->n_Status; ?>" class="active_button" for="atthFile1">Open</a>
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
