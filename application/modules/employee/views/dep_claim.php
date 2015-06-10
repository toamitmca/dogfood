<section class="main_caintainer">
<?php $data = checklogin(); ?>
<div class="leftSide" style="height: 0px;">
<div class="colL">
	<h3>Claims Reports </h3>
</div>
<div id="noRecord">
<div id="appendReport">
<?php
	if($response == 'Something Went Wrong'){
		echo "No Claim Yet";
	}else{


		foreach ($response as $key => $value) {
?>
<?php
		if($value->n_status == 'save'){
			$myval = "Saved";
		}elseif($value->n_status == 'Reject'){
			$myval = "Rejected";
		}elseif($value->n_status == 'submit'){
			$myval = "Submitted";
		}
		elseif($value->n_status == 'Reimbursed'){
			$myval = "Reimbursed";
		}
		///wire frame admin  Reimbursed
?>
<div class="colL2">
<h5><a href="<?php echo base_url();?>employee/dashboard2/editclaim/<?php echo $value->a_ReportId; ?>"><?php echo $value->t_ReportName; ?></a></h5>
<span class="date"><?php echo date('d M, Y', strtotime($value->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value->d_ClaimTo)); ?></span> 
<span class="price"><span class="WebRupee">Rs</span><?php echo $value->n_AmountReq; ?></span>
<h4><?php echo $data['firstname'].' '.$data['t_EmpLastName']; ?></h4>
<span class="submitt">
<?php echo $myval; ?>
<small><?php echo date('d M, Y', strtotime($value->d_CreatedOn)); ?> </small>
</span>

<a class="aprove" href="<?php echo base_url();?>employee/dashboard2/editclaim/<?php echo $value->a_ReportId; ?>"><?php echo $myval; ?></a>

</div>

<?php
	}
}

?>



 </div>

 </div>

 </div>


    <div class="rightSide">
    <div class="right_top">
    	<span class="buttonWrap">
    		<a class="loadbtn bluebg" href="<?php base_url();?>dashboard2/reportfirst2/">Add Claim Report</a></span>
<div class="fix"></div></div>
    
    
    </div>
</section>


<div class="fix"></div>

</body>
</html>
