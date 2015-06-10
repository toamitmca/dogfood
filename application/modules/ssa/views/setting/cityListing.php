<?php 

?>
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/cityadd/" class="loadbtn">Add City</a></span>

    <div class="right_top">
            <h2>City Listing</h2>
            <span class="buttonWrap"></span>
        
</div>

<?php echo $this->session->flashdata('message');?>
<div class="Expenses Expenses2">
    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>&nbsp;&nbsp;</th>
        <th>Country Name</th>
        <th>State Name</th>
        <th>City Name</th>
        <th>&nbsp;</th>
    </tr>
<?php $i=1;
//$listing=array('None'=> 'None');
if(!empty($listing)){
      foreach ($listing as $key => $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
     <td><?php echo $value->t_CountryName; ?></td>
    <td><?php echo $value->t_StateName; ?></td>
     <td><?php echo $value->t_CityName; ?></td>
    <td><a href="<?php echo base_url(); ?>ssa/admin/editcity/<?php echo $value->a_CityId; ?>" class="edit" for="atthFile"></a>
    <a  href="<?php echo base_url(); ?>ssa/admin/deletecity/<?php echo $value->a_CityId; ?>" class="del alert"></a>
    </td>
  </tr>
  <?php  $i++; }
?>
<?php }else{
  echo "No Record Found";
  } ?>

  
  
</tbody></table>
    
</div>

</div>
<div class="fix"></div>
</section>

</body>
</html>
