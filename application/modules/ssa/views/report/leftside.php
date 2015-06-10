<div class="leftSide">
<div class="colL">
 <span class="iconsel"></span>
<select name="business" id="businessid" onchange=" reportsearch();">
<?php foreach ($businessname as $value1) {  ?>
  <option value="<?php echo $value1->a_BusinessId ?>"><?php echo $value1->t_BusinessName ?></option>
  <?php   }  ?>
</select>
</div>
<div><ul id="empty1111">
<?php if(!empty($sideReport)){
    foreach ($sideReport as $key1 => $value1) { ?>

<div class="colL2" id="appendReport">
<h5><a href="<?php echo base_url();?>ssa/claimreport/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_BusinessId;?>"><?php echo $value1->t_ReportName; ?></a></h5>
<span class="date"><?php echo $value1->d_ClaimFrom; ?> - <?php echo $value1->d_ClaimTo; ?></span> 
<span class="iconerror"></span>
<span class="price"><span class="WebRupee">Rs</span> <?php echo $value1->n_CashAdvance; ?></span>
<h4><?php echo $value1->t_EmpFirstName.' '.$value1->t_EmpLastName; ?></h4>

<span class="submitt">Submitted<small><?php  // echo  $repSubmitOn; ?></small></span> 
<a href="<?php echo base_url();?>ssa/claimreport/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_BusinessId;?>" class="aprove">aprove</a>
<a href="<?php echo base_url();?>ssa/claimreport/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_BusinessId;?>" class="iconlink"></a>
</div>
 <?php  }}else{ echo "No Records Found";} ?>
 </ul>
  </div>
</div>
</div>
</div>