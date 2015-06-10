<?php 
// echo "<pre>";
// print_r($listing);
// exit();
?>
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/department_add/" class="loadbtn">Add Department</a></span>

    <div class="right_top">
            <h2>Department Listing</h2>
            <span class="buttonWrap"></span>

    </div>


<?php echo $this->session->flashdata('message');?>
<div class="Expenses Expenses2">
    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>&nbsp;&nbsp;</th>
        <th>Department Name</th>
        <th>Business Name</th>
        <th>&nbsp;</th>
    </tr>
<?php $i=1;
if(!empty($deptlist)){
    foreach ($deptlist as $key => $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
     <td><?php echo $value->t_DeptName; ?></td>
    <td><?php echo $value->name; ?></td>
    <td>
    <a href="<?php echo base_url(); ?>ssa/admin/editdepartment/<?php echo $value->a_DeptId; ?>" class="edit" for="atthFile"></a>
    <a href="<?php echo base_url(); ?>ssa/admin/deletedepartment/<?php echo $value->a_DeptId; ?>" class="del alert"></a></td>
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

</body>
</html>
