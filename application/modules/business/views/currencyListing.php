<?php 
// echo "<pre>";
// print_r($listing);
//exit();
?>
<section class="main_caintainer">
<?php $this->load->view('setting/leftSetting');?>

<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/admin/currencyadd/" class="loadbtn bluebg">Add Currency</a></span>

    <div class="right_top">
            <h2>Currency Listing</h2>
            <span class="buttonWrap"></span>

    </div>


<?php echo $this->session->flashdata('message');?>
<div class="Expenses">
    <table border="1" style="width:100%;">
    <tbody>
    <tr>
        <th>&nbsp;&nbsp;</th>
        <th>Country Name</th>
        <th>Currency Name</th>
        <th>&nbsp;</th>
    </tr>
<?php $i=1;
if(!empty($listing)){
    foreach ($listing as $key => $value) {?>
      <tr>
    <td><?php echo $i; ?></td>
     <td><?php echo $value->t_CountryName; ?></td>
    <td><?php echo $value->t_CurrencyName; ?></td>
    <td><a  href="<?php echo base_url(); ?>ssa/admin/deletecurrency/<?php echo $value->a_CurrencyId; ?>" class="del alert"></a> <a href="<?php echo base_url(); ?>ssa/admin/editcurrency/<?php echo $value->a_CurrencyId; ?>" class="edit" for="atthFile"></a></td>
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
