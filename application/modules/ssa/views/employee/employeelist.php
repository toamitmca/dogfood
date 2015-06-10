<section class="main_caintainer">
<?php $this->load->view('employeeLeft');?>
<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/superadmin/add_employee/<?php echo $businessid; ?>" class="loadbtn">Add Employee</a></span>
    <div class="right_top">
            <h2>Employee Listing</h2>

    </div>
<?php echo $this->session->flashdata('message');?>
<div class="Expenses">

    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>Sr.No.</th>
        <th>Emp Code</th>
        <th>Name</th>
        <th>Email</th>
        <th>Business Name </th>
        <th>Department</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tbody>
     <tbody id="hello">
<?php $i=1;
if($data !=="Something Went Wrong"){
    foreach ($data as  $value) {?>
      <tr id="getmyemp" >
    <td><?php echo $i; ?></td>
    <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php echo $value->t_EmpCode; ?></a></td>
    <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php echo  ucfirst($value->t_EmpFirstName); echo  ucfirst($value->t_EmpLastName);  ?></a></td>
     <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php echo $value->t_EmaiId; ?></a></td>
     <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php echo $value->t_BusinessName; ?></a></td>
     <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php echo $value->t_DeptName; ?></a></td>
      <td><a href="<?php echo base_url(); ?>ssa/superadmin/edit_employee/<?php echo $value->a_EmpId; ?>" class="" for="atthFile"><?php if($value->b_Deleted==0) {echo "Active"; } else { echo "Blocked
"; } ?></a></td>

    <td><!-- <a href="<?php // echo base_url(); ?>ssa/superadmin/edit_employee/<?php // echo $value->a_EmpId; ?>" class="edit" for="atthFile"></a>  -->
    <a title="Terminate"  href="<?php echo base_url(); ?>ssa/employee/employee_delete/<?php echo $value->a_EmpId; ?>" class="del alert"></a> 
    <a href="<?php echo base_url(); ?>ssa/employee/employee_status/<?php echo $value->a_EmpId; ?>/<?php echo $value->b_Deleted; ?>" <?php if($value->b_Deleted==0){ ?>class="inactive" <?php } else { ?>class="active_button"  <?php } ?>for="atthFile1"><?php if($value->b_Deleted==0){ echo 'Blocked
';} else{ echo 'Active' ;} ?></a>

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
<script type="text/javascript" src="<?php echo base_url(); ?>assects/js/employee_filter.js"></script>
</body>
</html>
