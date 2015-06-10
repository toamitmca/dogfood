<?php 

$sessionVar = $this->session->userdata('roleAccess');
// echo "<pre>";
// print_r($sessionVar);
// exit();
$approveExpReport=$sessionVar['Approved Expense report'];
$approvePreExpReport=$sessionVar['Approved Pre-Expense report'];

// if(($approveExpReport=='No') || ($approvePreExpReport=='No')){
//     $this->session->set_flashdata('message','You don\'t Permission to Access this Page');
//     $base_url  = base_url();
//     redirect($base_url.'business/dashboard/claimReportList/');
//     exit();
// }
//echo $approveExpReport.' '.$approvePreExpReport;
//exit();
// p($report);
// exit();
foreach ($policyName as $key2 => $value2) {
 $policyName=$value2->t_PolicyName;
}
if(!empty($report)){
  foreach ($report as $key3 => $value3) {
        $reportId=$value3->a_ReportId;
        $reportName=$value3->t_ReportName;
        $amountReq=$value3->n_AmountReq;
        $reportTypeId=$value3->n_ReportTypeId;
        $claimFrom=$value3->d_ClaimFrom;
        $claimTo=$value3->d_ClaimTo;
        $cashAdvance=$value3->n_CashAdvance;
        $preExpAmt=$value3->n_PreExpAmt;
        $reportDesc=$value3->t_ReportDesc;
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

if($reportTypeId==0){
  $reportType='Pre-Expense Report';
}else{
  $reportType='Expense Report';
}
if(!empty($approvedOn)){
  $approveDate= date('d M, Y', strtotime($approvedOn));
}else{
  $approveDate="";
}
$dClaimFrom = date('d M, Y', strtotime($claimFrom));
$dClaimTo = date('d M, Y', strtotime($claimTo));
$repSubmitOn= date('d M, Y', strtotime($createdOn));
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
}else{
   $reportId='';$amountReq='';$preExpAmt='';$amountToPaid='';
        $reportName='';
        $amountReq='';
        $reportTypeId='';
        $claimFrom='';
        $claimTo='';
        $cashAdvance='';
        $preExpAmt='';
        $reportDesc='';
        $active='';
        $createdBy='';
        $createdOn='';
        $voilated='';
        $approvedOn='';
        $approved='';
        $deptName='';
        $repStatus='';
        $firstName='';
        $lastName='';
        $dClaimFrom = '';
        $dClaimTo = '';
        $repSubmitOn= '';
        $approveDate='';
}


// p($sideReport);
// exit();
?>
<section class="main_caintainer">
<div class="leftSide">
<div class="colL"><select name="employee_name" id="employee_name">
                      <option value=''>Select An Employee Name</option>
                      <?php if(!empty($sideEmpName)){
                        foreach ($sideEmpName as $key => $value) { ?>
                      <option value="<?php echo $value->a_EmpId?>"><?php echo $value->t_EmpFirstName.' '.$value->t_EmpLastName?></option>
                   <?php  }}else{ echo "No Records Found";} ?>
                  </select>
<span class="iconsel"></span>
</div>
<div id="noRecord">
<div class='colL2' id="appendReport">
<?php if(!empty($sideReport)){
    foreach ($sideReport as $key1 => $value1) { ?>

<h5><a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>"><?php echo $value1->t_ReportName; ?></a></h5>
<span class="date"><?php echo date('d M, Y', strtotime($value1->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value1->d_ClaimTo)); ?></span> 
<span class="iconerror"></span>
<span class="price"><span class="WebRupee">Rs</span> <?php echo $value1->n_CashAdvance; ?></span>
<h4><?php echo $value1->t_EmpFirstName.' '.$value1->t_EmpLastName; ?></h4>

<span class="submitt">Submitted<small><?php echo $repSubmitOn; ?></small></span>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" class="aprove">aprove</a>
<?php if($value1->b_IsVoilated==1){?>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" class="iconlink"></a>
<?php }?>


 <?php  }}else{ echo "No Records Found";} ?></div>
 </div>
</div>


<div class="rightSide"><div class="right_top"><h1><?php echo $reportType; ?></h1>
<span class="buttonWrap">
  <?php if($approved==1) { ?>
  <a href="<?php echo base_url();?>business/dashboard/downloadReport/<?php echo $reportId;?>" class="loadbtn" target="_blank" id="download_reprt"> Download Report</a>
  <?php   }else{ ?>
    <button type="button" class="loadbtn" name="p_approved" id="p_approved">Partially Approve</button>
    <button type="button" class="loadbtn" name="approved" id="approved">Approve</button>
    <button type="button" class="loadbtn" name="reject" id="reject">Reject</button>
    <a href="<?php echo base_url();?>business/dashboard/downloadReport/<?php echo $reportId;?>" class="loadbtn" target="_blank" id="download_reprt">Download Report </a>
  <?php  } ?>
   
 
</span>
<div class="fix"></div></div>
<div class="innerReport">
<div class="innerLeft">
<h2><?php echo $reportName; ?></h2>

<p><span class="blue"><?php echo $firstName.' '.$lastName; ?>,</span><?php echo $reportTypeId; ?> </p>
<p id="showDesc" style="display:block !important"><?php echo $reportDesc; ?> </p>
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


<div class="innerReport">
<?php /*?><span class="dscp" id="reportDesc"><?php echo substr($reportDesc,0,20); ?></span><?php */?>

<br />
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
<?php if($approved==1) { ?>
  <li class="green" ><span id="amount_app"><span class="WebRupee" >Rs</span><?php echo $amountReq; ?></span></li>
  <?php }else{ ?>
  <li class="green" ><span id="amount_app"><span class="WebRupee" >Rs</span><?php echo $amountReq; ?></span></li>
<?php  }?>

<li>Cash Advance</li>
<li><span class="WebRupee">Rs</span> <?php echo $cashAdvance; ?></li>
<li>To Be Paid</li>
<?php if($approved==1) { ?>
<li class="green" ><span id="amount_paid"><span class="WebRupee" >Rs</span> <?php echo $amountToPaid; ?></span></li>
 <?php }else{ ?>
<li class="green"><span id="amount_paid"><span class="WebRupee" >Rs</span> <?php echo $amountToPaid; ?></span></li>
 <?php  }?>
</ul>

</div>

</div>
<div class="innerRight">

<br/>

<?php if($voilated==1){ ?>
   <span class="bug"></span>
 <?php }?>
</div>
<div class="notes">
<p id="msg"></p>
<table>
   <tr>
    <td>
    <span class="notesHead"> Notes<span class="add" id="addNotes"></span></span> </td>
    <td><?php if($voilated==1){ ?><a href="#" class="bug"></a> <?php }?></td>
    <td><a href="#" class="link"></a></td>
  </tr>
 
  <tr id="notesEdit">
      <td colspan="3" class="editNotes">
        <textarea name="notesfields" placeholder="enter your notes" id="notesfields"></textarea><input type="button" value="Submit" id="add_notes" class="loadbtn">
      </td>
  </tr>

</table>
</div>
<div class="notes notesEx" id="notes">

<table >
  <tbody>
 
  <tr id="notesAppend"></tr>
  <?php $i=0; 
  if(!empty($notes)){ 
    foreach ($notes as $key4 => $value4) { ?>
    <tr>   
      <td><span class="table_span"><?php echo substr($value4->t_NoteDesc,0,20); ?></span> <span class="table_span2"><?php echo $value4->t_NoteDesc; ?></span></td>
      <td><?php echo date('d M, Y', strtotime($value4->d_CreatedOn));?>,by <?php echo $value4->t_Name; ?></td>
      <?php if(($value4->t_Type=='Admin') && ($value4->n_CreatedBy==$businessId)){$delClass="del";}else{$delClass='';} ?>
      <td><span class="<?php echo $delClass; ?> alert" id="<?php echo $i; ?>"></span></td>
    </tr>
     <input type="hidden" name="note_id" id="note_id<?php echo $i; ?>" value="<?php echo $value4->a_NoteId ?>"/>
 <?php $i++; }
 }else{ echo "<p id='hideNotes'>No notes</p>";} ?>
</tbody>
</table>



</div>
<span class="expand" id="expandNotes"></span>

<div class="Expenses">
<a class="headexp">Expense</a><a href="" class="loadbtn">Details</a>
<table border="1">
    <tr>
    <th>&nbsp;</th>
    <th>Type</th>
    <th>Category</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Merchant</th>
    <th>Purpose</th>
    <th>Reimbusable</th>
    <th>&nbsp;</th>
  </tr>
  <?php if(!empty($expense)) {
    foreach ($expense as $key5 => $value5) { ?>
    <tr>
        <td><input type="checkbox" disabled="true"></td>
        <td><?php if($value5->t_EnumKey=='Mileage') { ?>
        <img src="<?php echo base_url(); ?>assects/images/IconMileage.png" /></td>
        <?php  }else{ ?>
        <img src="<?php echo base_url(); ?>assects/images/IconMoneySpent.png" /></td>
        <?php   } ?>
        <td><?php echo $value5->t_CustCatName; ?></td>
        <td><?php echo $value5->d_Date; ?></td>
        <td><span class="WebRupee">Rs</span><?php echo $value5->t_Amount; ?></td>
        <td><?php echo $value5->t_Merchant; ?></td>
        <td><?php echo $value5->t_Purpose; ?></td>
        <?php if($value5->b_IsReimburs==0){$reimburse="No";}else{$reimburse="Yes";}?>
        <td><?php echo $reimburse; ?></td>
        <td> <?php if($value5->b_IsVoilated==1) {?>
        <a href="#" class="bug">
          <?php } ?> <a href="#" class="link"></a></td>
  </tr>
 <?php  }}else{ echo "No Expense Found";} ?>

</table>

</div>


<a href="" class="loadbtn">Download Report</a>
<div class="report">
<h1>Report Action Log</h1>
<p>Last Update 25/12/2014, by Manish Gupta</p>

<?php $this->load->view('layout/footer'); ?>

</div>






</div>

</div>
</section>
<div class="fix"></div>

<script type="text/javascript">

$(document).ready(function(){
 var getString=	$('#showDesc').text().length;
 //alert(getString);
 if(getString >'95'){
	 //alert('yes');
	 $('#showDesc').addClass('dscp');
	 $('#showDesc').click(function(){
		 $(this).toggleClass('showDscp');
	 });
 }
  $('.notesShow').show();
  $('.notesHide').hide();
  $("#showDesc").hide();
  $('#notes table tr').click(function(){
    $(this).find('.table_span').toggle();
      $(this).find('.table_span2').toggle();
  });
});
$(document).ready(function(){
    var appr="<?php echo $approved;?>";
    if(appr==1){
      $('#amount_app').show();
      $('#amount_paid').show();
    }else{
      $('#amount_app').hide();
      $('#amount_paid').hide();
    }
      
      $('#notesEdit').hide();

$("#addNotes").on('click',function(){
  console.log("hiii");
  $("#hideNotes").remove();
  $('#notesfields').val('');
  $('#notesEdit').toggle();
});
  $("#add_notes").on('click',function(){
    $('#notesEdit').hide();
    var texValue= $('#notesfields').val();
    var name="<?php echo ucfirst($firstBusName).' '.ucfirst($lastBusName);?>";
    var reportId = "<?php echo $reportId; ?>";
    var date="<?php echo date('d M, Y');?>";

    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/addNotes",
      type: 'POST',
      data: { 'reportId' : reportId ,'texValue' : texValue },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);

        if(data.length>0){
          $("#msg").html('<p>Added Successfully</p>').delay().fadeOut(2000);
          $.each(data, function (index, value) {
            var appendLink ="<span id="+value.n_id+" class='del alert'></span>";
            var inputField="<input type='hidden' name='note_id' id='note_id"+value.n_id+"' value="+value.n_id+" >";
          $("<tr id='notesAppend'><td>"+texValue+"</td><td>"+date+",by "+name+"</td><td>"+appendLink+"</td></tr>"+inputField+"").insertBefore("#notesAppend");
        });
      }
    }
 });
});
});
$("#expandNotes").on('click',function(){
  $('#notes').toggleClass('notesEx');
  $(this).toggleClass('bottomArrow');
  $('#notes').scrollTop(0);
});

$(document.body).on("click",".del",function(){
//$(".del").on('click',function(){
  id=$(this).attr('id');
  console.log(id);
  var noteId=$("#note_id"+id).val();
  console.log(noteId);
      $.ajax({
            url: "<?php echo base_url();?>business/dashboard/deleteNote",
            type: 'POST',
            data: { 'noteId' : noteId ,},
            async: true,
            dataType: "json",
            success: function (data) {

                  console.log(data);
                if(data.length>0){
                $("#msg").html('<p>Deleted Successfully</p>').delay().fadeOut(2000);
            }
          }
          
      });
      //alert('yes');
           $(this).parents('tr').remove();

  });
$("#approved").on('click',function(){


  var ok = confirm('Do you really want to delete this record');
    if(ok){
      $('#amount_app').show();
      $('#amount_paid').show();
      $('#p_approved').hide();
      $('#approved').hide();
      $('#reject').hide();
      var reportId="<?php echo $reportId; ?>";
      $.ajax({
              url: "<?php echo base_url();?>business/dashboard/approveReport",
              type: 'POST',
              data: { 'reportId' : reportId ,},
              async: true,
              dataType: "json",
              success: function (data) {
                  console.log(data);
                  if(data){
                  $("#status_rep").html("Approved(<?php echo date('d-M-Y'); ?>)");
                  $("#msg").html('<p>Approved Successfully</p>').delay().fadeOut(2000);
              }
            }
            
        });
    }else{
      return false;
    }
});


$("#reject").on('click',function(){


  var ok = confirm('Do you really want to Reject this Report');
    if(ok){
      $('#download_reprt').hide();
      $('#p_approved').hide();
      $('#approved').hide();
      $('#reject').hide();
      var reportId="<?php echo $reportId; ?>";
      $.ajax({
              url: "<?php echo base_url();?>business/dashboard/rejectReport",
              type: 'POST',
              data: { 'reportId' : reportId ,},
              async: true,
              dataType: "json",
              success: function (data) {
                  console.log(data);
                  if(data){
                  $("#status_rep").html("Reject(<?php echo date('d-M-Y'); ?>)");
                  $("#msg").html('<p>Report Rejected</p>').delay().fadeOut(2000);
              }
            }
            
        });
    }else{
      return false;
    }
});


$("#employee_name").on('change',function(){
  var searchValue=$("#employee_name").val();
  console.log(searchValue);
  if(searchValue!=''){
    searchValue=searchValue;
  }else{
      //console.log("hi");
      // console.log(searchValue);
      searchValue="";
    }
    $.ajax({
        url: "<?php echo base_url();?>business/dashboard/searchReport",
        type: 'POST',
        data: { 'id' : searchValue },
        async: true,
        dataType: "json",
        success: function (data) {
              console.log(data);
            if(data!=null){  
               $("#appendReport").empty(); 
            $.each(data,function (index,value){
                var listReport="<div class='colL2'><h5>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+">"+value.t_ReportName+"</a>";
                    listReport+="</h5>";
                    listReport+="<span class='date'>"+value.d_ClaimFrom+"- "+value.d_ClaimTo+"</span>";
                    listReport+="<span class='price'><span class='WebRupee'>Rs</span>"+value.n_CashAdvance+"</span>";
                    listReport+="<h4>"+value.t_EmpFirstName+" "+value.t_EmpLastName+"<span class='iconerror'></span></h4>";
                    listReport+="<span class='submitt'>Submitted<small>"+value.d_CreatedOn+"</small></span>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='aprove'>approve</a>";
              if(value.b_IsVoilated==1){
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='iconlink'></a></div>";
                 }
                $("#appendReport").append(listReport);
              });
        }else{
          $("#noRecord").html('<p>No Result Found</p>');
        }
            
        }
    });
});
$("#reportDesc").on('click',function(){
  $("#showDesc").toggleClass('showDiv');
});
</script>
</body>
</html>
