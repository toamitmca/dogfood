<section class="main_caintainer">
<?php $this->load->view('policy/leftlistpolict');?>
<div class="rightSide">
 <a href="<?php echo base_url(); ?>ssa/policy/policyadd" class="loadbtn">New Policy</a> </span>
    <div class="right_top">
            <h2>Policy Listing</h2>
            <span class="buttonWrap"></span>

    </div>
<span calss="message">
<?php echo $this->session->flashdata('message');

?>
</span>
<span id="pmsg" class="message"></span>
<div class="Expenses">

    <table border="1" style="width:100%;" id="plist">
    <thead>
    <tr>
        <th>Sr. No. </th>
        <th>Policy Name </th>
        
        <th onclick="return dfffsdfs(this.value); ">Business Name</th>
        <th style="width:135px;">Action</th>
    </tr>
    </thead>
     <tbody>
<?php 

//p($data); exit;

$i=1;
if($data !=="Something Went Wrong"){
    foreach ($data as  $value) {?>
      <tr id="plidttr<?php echo $value->a_PolicyId ?>">
  <td><?php echo $i; ?></td>
  <td><a href="<?php echo base_url(); ?>ssa/policy/policyedit/<?php echo $value->a_PolicyId;  ?>"><?php echo $value->t_PolicyName; ?></a></td>
  <td><a href="<?php echo base_url(); ?>ssa/policy/policyedit/<?php echo $value->a_PolicyId;  ?>"> <?php echo $value->t_BusinessName;?></a></td>
  <td><!-- <a href="<?php echo base_url(); ?>ssa/policy/policyedit/<?php echo $value->a_PolicyId;  ?>" class="edit" for="atthFile"></a> -->
  <p onclick="return ssapolicydeleteedit(<?php echo $value->a_PolicyId;  ?>);"  class="del alert"></p>
        <!--  <a  href="<?php // echo base_url(); ?>ssa/business/business_delete/<?php // echo $value->a_BusinessId; ?>" class="del alert"></a>  -->
    <?php //if($value->b_Deleted==0){ ?>
    <!-- <a href="<?php //echo base_url(); ?>ssa/business/business_status/<?php // echo $value->a_BusinessId; ?>/<?php // echo $value->b_Deleted; ?>" class="inactive" for="atthFile1">Inactive</a> -->
  <?php //} else { ?>
   <!-- <a href="<?php //echo base_url(); ?>ssa/business/business_status/<?php //echo $value->a_BusinessId; ?>/<?php // echo $value->b_Deleted; ?>" class="active_button" for="atthFile1">Active</a> -->
  <?php //} ?>
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
<script type="text/javascript" src="<?php echo base_url();?>assects/js/policy2.js"></script>
</body>
</html>
