<?php // $data = checklogin();//p($data);?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/pase.css" />
<script type="text/javascript" src="<?php echo base_url();?>assects/js/pase.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/default.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<script type="text/javascript" src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<style>
body{margin: 0 5%; box-shadow: 0 0 1px 1px #bbb; border: none;}
</style>
</head>

<body>
<?php 
// p($report);
// echo "<br/>";
// p($expense);
// exit();
foreach ($policyName as $key2 => $value2) {
 $policyName=$value2->t_PolicyName;
}
foreach ($report as $key3 => $value3) {
        $reportId=$value3->a_ReportId;
        $reportName=$value3->t_ReportName;
        $amountReq=$value3->n_AmountReq;
        $reportTypeId=$value3->n_ReportTypeId;
        $claimFrom=$value3->d_ClaimFrom;
        $claimTo=$value3->d_ClaimTo;
        $cashAdvance=$value3->n_CashAdvance;
        $preExpAmt=$value3->n_PreExpAmt;
        $active=$value3->b_Active;
        $createdBy=$value3->n_CreatedBy;
        $createdOn=$value3->d_CreatedOn;
        $voilated=$value3->b_IsVoilated;
        $approvedOn=$value3->d_ApprovedOn;
        $approved=$value3->b_Approved;
        $deptName=$value3->t_DeptName;
        $repStatus=$value3->n_status;
        $firstName=$value3->t_EmpFirstName;
        $lastName=$value3->t_EmpLastName;
}
if(!empty($approvedOn)){
  $approveDate= date("d-M-Y", strtotime($approvedOn));
}else{
  $approveDate="";
}

$dClaimFrom = date("d-M-Y", strtotime($claimFrom));
$dClaimTo = date("d-M-Y", strtotime($claimTo));
$repSubmitOn= date("d-M-Y", strtotime($createdOn));
if(!empty($amountReqnt)){
  $amountReq=$amountReq;
}else{
$amountReq='0.00';
}
if(!empty($preExpAmt)){
  $preExpAmt=$preExpAmt;
}else{
$preExpAmt='0.00';
}
if(!empty($cashAdvance)){
  $amountToPaid=$cashAdvance+$amountReq;
}else{
  $amountToPaid='';
}

// p($sideReport);
// exit();
?>
<div id="printReport">
<section class="main_caintainer">
<div style="padding:10px;"><div class="right_top"><h1>Expense Claim Report</h1>

<div class="fix"></div></div>
<div class="innerReport">
<div class="innerLeft">
<h2><?php echo $reportName; ?></h2>

<p><span class="blue"><?php echo $firstName.' '.$lastName; ?>,</span><?php echo $reportTypeId; ?> </p>
</div>

<div class="innerRight">
<ul class="rightdet"> 
<li>Report Id</li>
<li><?php echo $reportTypeId; ?></li>
<li>Claim Period</li>
<li><?php echo $dClaimFrom; ?> - <?php echo $dClaimTo; ?></li>
<li>Submitted On</li>
<li><?php echo $createdOn; ?></li>
</ul>
</div>
<ul class="description">
<li>Department</li>
<li><?php echo $deptName; ?></li>

<li>Policy</li>
<li><?php echo $policyName; ?></li>


<li>Status</li>
 <?php if($approved==1) { ?>
 <li id="status_rep">Approved(<?php echo $approveDate; ?>)</li>
  <?php }else{ ?>
  <li id="status_rep"><?php echo $repStatus; ?>(<?php echo $repSubmitOn; ?>)</li>
  <?php   }?>
</ul>



<ul class="description">
<li>Amount Requested</li>
<li class="blue"><span class="WebRupee">Rs</span> <?php echo $amountReq; ?></li>
<li>Amount Reported</li>
<li><span class="WebRupee">Rs</span> <?php echo $amountReq; ?></li>
</ul>

<ul class="description">
<li>Amount Approved</li>
<li class="green" id="amount_app"><span class="WebRupee">Rs</span><?php echo $amountReq; ?></li>
<li>Cash Advance</li>
<li><span class="WebRupee">Rs</span> <?php echo $cashAdvance; ?></li>
<li>To Be Paid</li>

<li class="green" id="amount_paid"><span class="WebRupee">Rs</span> <?php echo $amountToPaid; ?></li>
</ul>

</div>
<div class="innerRight">

<br/>

<span>Policy Voilation</span>
<?php if($voilated==1){ ?>
   <span class="bug"></span>
 <?php }?>
</div>
</div>
<div class="notes" style="margin:auto; width:98%;">

<table>
   <tr>
    <td><span> Notes</span></td>
   </tr>
 </table>
</div>

<div class="notes" style="margin:auto; width:98%;">

<table >
  <tbody>
  <?php $i=0; 
    foreach ($notes as $key4 => $value4) { ?>
    <tr>   
      <td><span class="table_span"><?php echo substr($value4->t_NoteDesc,0,20); ?></span> <span class="table_span2"><?php echo $value4->t_NoteDesc; ?></span></td>
      <td><?php echo date('d-M-Y',strtotime($value4->d_CreatedOn));?>,by <?php echo $value4->t_Name; ?></td>
    </tr>
  <?php $i++; }?>
  </tbody>
</table>
</div>
<div class="Expenses" style="display:block; margin:auto !important; width:98%;">
<a class="headexp">Expense</a>
<table border="1">
    <tr>
    <th>&nbsp;</th>
    <th>Type</th>
    <th>Category</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Merchant</th>
    <th>City</th>
    <th>Purpose</th>
    <th>Reimbusable</th>
    <th>Tag1</th>
    <th>Tag2</th>

  </tr>
  <?php foreach ($expense as $key5 => $value5) { ?>
    <tr>
       
        <td><?php if($value5->t_EnumKey=='Mileage') { ?>
        <img src="<?php echo base_url(); ?>assects/images/IconMileage.png" /></td>
        <?php  }else{ ?>
        <img src="<?php echo base_url(); ?>assects/images/IconMoneySpent.png" /></td>
        <?php   } ?>
        <td><?php echo $value5->t_CustCatName; ?></td>
        <td><?php echo $value5->d_Date; ?></td>
        <td><span class="WebRupee">Rs</span><?php echo $value5->t_Amount; ?></td>
        <td><?php echo $value5->t_Merchant; ?></td>
        <td><?php echo $value5->t_City; ?></td>
        <td><?php echo $value5->t_Purpose; ?></td>
        <?php if($value5->b_IsReimburs==0){$reimburse="No";}else{$reimburse="Yes";}?>
        <td><?php echo $value5->n_CustomTag1; ?></td>
        <td><?php echo $value5->n_CustomTag2; ?></td>
        <td></td>
        <td></td>
  </tr>

  <?php if($value5->b_IsVoilated=="1"){ ?>
    <tr>
    <td class="bug" colspan="11"></td>
  </tr>
  <?php  }?>
  <?php if($value5->t_CustCatName=="Meals"){ ?>
      <?php if($value5->b_IsVoilated=="1"){ ?>
    </tr>
    <tr>
        <td class="bug" colspan="11"></td>
      </tr>
    <?php  }?>
  <?php  }elseif($value5->t_CustCatName=="Lodging"){ ?>
    <tr>
    <td colspan="11">Start Date : <?php echo $value5->d_DateFrom; ?> ,Return Date : <?php echo $value5->d_DateTo; ?> , Booking Confirm <?php if($value5->t_BookingConfir==0){ ?> <span>no</span> <?php  }else{?><span>Yes</span></td>
    
    <?php } ?>
    <?php if($value5->b_IsVoilated=="1"){ ?>
    </tr>
    <tr>
        <td class="bug" colspan="11"></td>
      </tr>
    <?php  }?>
   <?php   }elseif($value5->t_CustCatName=="Air Travel"){ ?>
    <tr>
    <td colspan="11">Start Date : <?php echo $value5->d_DateFrom; ?>, Return Date : <?php echo $value5->d_DateTo; ?> ,From : <?php echo $value5->n_FromSource; ?> To <?php echo $value5->n_ToDestination; ?> ,Booking Confirm : <?php if($value5->t_BookingConfir==0){ ?> <span>No</span> <?php  }else{?>
    <span>Yes</span>
    <?php } ?>
    <?php if($value5->b_IsVoilated=="1"){ ?> </td>
   
    </tr>
    <tr>
        <td class="bug" colspan="11"></td>
      </tr>
    <?php  }?>
   <?php   }else{?>
     <tr>
    <td colspan="11" >Distance   : 0 , GPS Calculated : <?php if($value5->b_IsGpsCalculat==0) {?>  <span>No</span> <?php }else{?> <span>Yes</span>
    <?php }?></td>
    
  </tr>
<?php  }?>
  <?php if($value5->b_IsVoilated=="1"){ ?>
    </tr>
    <tr>
        <td class="bug"></td>
      </tr>
    <?php  }?>

<?php }  ?>

</table>

</div>

<div class="report" style="margin:10px auto; width:98%;">
<h1>Report Action Log</h1>
<p>Last Update 25/12/2014, by Manish Gupta</p>

<?php $this->load->view('layout/footer'); ?>
</div>
 <p>Report Attachment</p>
<div>
  <div></div>
</div>
 <p>Expense Receipts</p>
 
 <table>
  <tr>
    <th>Category</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Merchant</th>
    <th>&nbsp;</th>
  </tr>
 <?php foreach ($expense as $key5 => $value5) { ?>
   <tr>
    <td><?php echo $value5->t_CustCatName ?></td>
    <td><?php echo date('d-M-Y',strtotime($value5->d_CreatedOn)); ?></td>
    <td><?php echo $value5->t_Amount ?></td>
    <td><?php echo $value5->t_Merchant ?></td>
    <td><?php echo $value5->t_atthFile ?></td>
  </tr>
<?php } ?>
</table>
 
</div>

</div>
</section>
</div>
<div class="fix"></div>
<script type="text/javascript">
  $(document).ready(function(){

  var printContents = document.getElementById("printReport").innerHTML;
  //  alert(printContents);
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    $(document.body).on("click","button[class=cancel]",function(){

    });

  });

  
</script>

<style>
  .Expenses table tr td{text-align:left !important}
</style>

</body>
</html>
