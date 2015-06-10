<?php
$sessionVar = $this->session->userdata('roleAccess');

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
 //p($report);
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
        $empcode=$value3->t_EmpCode;
}

if($reportTypeId==1){
  $reportType='Pre-Expense Report';
}else{
  $reportType='Expense Report';
}
if(!empty($approvedOn)){
  $approveDate= date('d M, Y', strtotime($approvedOn));
}else{
  $approveDate="";
}
$dClaimFrom  = date('d M, Y', strtotime($claimFrom));
$dClaimTo    = date('d M, Y', strtotime($claimTo));
$repSubmitOn = date('d M, Y', strtotime($createdOn));
if(!empty($amountReq)){
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
<div class="colL">

<input type="text" name="empname" id="byempname" value="" placeholder="Seaech employee name" onkeyup="return repert_advanse_search();">
<!-- <select name="employee_name" id="employee_name">
                      <option value=''>Select An Employee Name</option>
                      <?php if(!empty($sideEmpName)){
                        foreach ($sideEmpName as $key => $value) { ?>
                      <option value="<?php echo $value->a_EmpId?>"><?php echo $value->t_EmpFirstName.' '.$value->t_EmpLastName?></option>
                   <?php  }}else{ echo "No Records Found";} ?>
                  </select> -->
<span class="iconsel" id="advancesearch"></span>

<span class="s_advansesearch">
<!-- <input type="text" name="empname" id="byempname" value="" placeholder="Seaech employee name" onkeyup="return reportby_businessid();"> -->

<Select id="report_status" onchange="return repert_advanse_search();">
<option value="">Select</option>
<option value="0">Submitted</option>
<?php if($this->session->userdata['roleAccess']['Reimburse']=='yes'){ ?>
<option value="1">Approved</option>
<?php }?>
</Select>
<input type="text" name="bubmited" id="b_submited" class="datepicker_all" placeholder="Submited date" onblur="return repert_advanse_search();">
<p> By claim period</p>
<input type="text" name="from_claimperiod" id="from_claim" placeholder="From Claim period" class="datepicker_all" onblur="return repert_advanse_search();">
<input type="text" name="to_claimperiod" id="to_claim" placeholder="To Claim period" class="datepicker_all" onblur="return repert_advanse_search();">

</span>
</div>
<div id="noRecord">
<ul  id="appendReport">
<?php if(!empty($sideReport)){
    foreach ($sideReport as $key1 => $value1) { ?>

<li class="colL2"><h5><a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>"><?php echo $value1->t_ReportName; ?></a></h5>
<span class="date"><a  href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" ><?php echo date('d M, Y', strtotime($value1->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value1->d_ClaimTo)); ?></a></span> 
<span class="iconerror"></span>
<span class="price"><span class="WebRupee" >Rs</span> <a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" style="color:#178D8D;"><?php echo $value1->n_AmountReq; ?></a></span>
<h4 class="colour" ><?php echo $value1->t_EmpFirstName.' '.$value1->t_EmpLastName; ?></h4>
<span class="submitt"><a  href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" ><?php echo ucfirst($value1->n_status); ?>ed<small><?php echo $repSubmitOn; ?></small></a></span>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" class="aprove">approve</a>
<?php if($value1->b_IsVoilated==1){?>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>" class="iconlink"></a></li>

<?php }?>


 <?php  }}else{ echo "No Records Found";} ?></ul>
 </div>
</div>

<input type="hidden" name="myreportsid" id="myreportsid" value="<?php echo  $value1->a_ReportId; ?>">
<div class="rightSide"><div class="right_top"><h1><?php echo $reportType; ?></h1>
<span class="buttonWrap">
  <?php if($approved==1) { ?>
  <a href="<?php echo base_url();?>business/dashboard/downloadReport/<?php echo $reportId;?>" class="loadbtn" target="_blank" id="download_reprt"> Download Report</a>
    <a href="<?php echo base_url();?>business/dashboard/rimburseReport/<?php echo $reportId;?>" class="loadbtn" id="Rimburse"> Rimburse</a>
  <?php   }else{ ?>
   <!-- <button type="button" class="loadbtn" name="p_approved" id="p_approved">Partially Approve</button>-->
    <button type="button" class="loadbtn" name="approved" id="approved">Approve</button>
    <button type="button" class="loadbtn" name="reject" id="reject">Reject</button>
    <a href="<?php echo base_url();?>business/dashboard/downloadReport/<?php echo $reportId;?>" class="loadbtn" target="_blank" id="download_reprt">Download Report </a>
  <?php  } ?>

 </span>
<div class="fix"></div></div>


<div class="innerLeft">
<h2><?php echo $reportName; ?></h2>
<p><span class="blue"><?php echo $firstName.' '.$lastName; ?>, &nbsp;</span><?php echo $empcode; ?> </p>
<span class="dscp">Description 

</span></br>
<?php echo $reportDesc; ?>
</div>




<div class="innerReport">
<div class="innerLeft">
<h2><?php ///echo $reportName; ?></h2>


<p id="showDesc" style="display:block !important"> </p>
</div>

<div class="innerRight">
	<ul class="rightdet"> 
<li>Report Id</li>
<li><?php echo $reportId; ?></li>
<li>Claim Period</li>
<li><?php echo $dClaimFrom; ?> - <?php echo $dClaimTo; ?></li>
<li>Submitted On</li>
<li><?php echo $createdOn; ?></li>
</ul>

</div>








<div class="innerReport">
<span class="dscp" id="reportDesc"><?php// echo substr($reportDesc,0,20); ?></span>

<br />
<ul class="description ">
<li>Department Sales</li>
<li>Policy
Employee General</li>
<!---<li><?php echo $deptName; ?></li>-->
<!---<li>Policy</li>--->
<!---<li><?php echo $policyName; ?></li>--->
<!---<li>Status</li>--->
 <?php if($approved==1) { ?>
 <!---<li id="status_rep">Approved(<?php echo $approveDate; ?>)</li>--->
  <?php }else{ ?>
  <!---<li id="status_rep"><?php echo $repStatus; ?>(<?php echo $repSubmitOn; ?>)</li>-->
  <?php   }?>
</ul>

<ul class="description description_2">
<li>Amount Requested</li>
<li class="blue"><span class="WebRupee">Rs</span> <?php echo $amountReq; ?></li>
<li>Amount Reported</li>
<li><span class="WebRupee">Rs</span> <?php echo $amountReq; ?></li>
</ul>
<ul class="description description_3">
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
    <a class="add">Notes</a> 
    </span> </td>
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

function savenoteadmin(valuecount)
{
    var mycount=valuecount;
    //alert(mycount);
    //alert('#notes_'+mycount);
    var notes =$('#notes_'+mycount).val();
  //  alert(notes);
    var reportId =reportid=$('#myreportsid').val();
//alert(reportId);
 $.ajax({
  url:"<?php echo base_url(); ?>business/dashboard/addNotes",
  type:'POST',
 // dataType:'json',
  data: {'reportid':reportid, 'noteval':notes },
  success:function(data){
    //console.log(data);
    //alert(data);
   $("#getid_"+mycount).val(data.a_NoteId);
   alert('NOTE ADDED SUCCESSFULLY');
  }});

}





$(document).ready(function(e) {
  var s=1;
  $(".add").click(function(){
    $(this).parents('table').append("<tr class='ntd' id='removetr_"+s+"'><td><input type='hidden' id='getid_"+s+"' ><input type='text' name='notes[]' id='notes_"+s+"' placeholder='Input Your Message' class='notesnotcheck'></td><td><input type='button' class='loadbtn bluebg' name='Save' value='Save' onclick='return savenoteadmin("+s+");'></td><td><a class='del'></a></td></tr>");
    s++;
  });
});






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


  var ok = confirm('Do you really want to approved this record');
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
function repert_advanse_search(){
 // var searchValue=$("#employee_name").val();
  var empname = $('#byempname').val();
var status = $('#report_status').val();
var b_submited = $('#b_submited').val();
var to_claim = $('#to_claim').val();
var from_claim = $('#from_claim').val();
 /* console.log(searchValue);
  if(searchValue!=''){
    searchValue=searchValue;
  }else{
      //console.log("hi");
      // console.log(searchValue);
      searchValue="";
    }*/
  
    $.ajax({
        url: "<?php echo base_url();?>business/dashboard/searchReport_advanse",
        type: 'POST',
        data: {'act_mode':'by_business','empname':empname,'status':status,'b_submited':b_submited ,'to_claim':to_claim ,'from_claim':from_claim },
        async: true,
        dataType: "json",
        success: function (data) {
              console.log(data);
              $('#appendReport li').remove();
            if(data!=null){

              // $("#appendReport").empty(); 
            $.each(data,function (index,value){
                var listReport="<li class=colL2><h5>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+">"+value.t_ReportName+"</a>";
                    listReport+="</h5>";
                    listReport+="<span class='date'>"+value.d_ClaimFrom+"- "+value.d_ClaimTo+"</span>";
                    listReport+="<span class='price'><span class='WebRupee'>Rs</span>"+value.n_AmountReq+"</span>";
                    listReport+="<h4 class=colour>"+value.t_EmpFirstName+" "+value.t_EmpLastName;
                    if(value.b_IsVoilated==1){
                      listReport+="<span class='iconerror'></span>";
                    }
                    listReport+="</h4>";
                    listReport+="<span class='submitt'>Submitted<small>"+value.d_submitedon+"</small></span>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='aprove'>approve</a></li>";

                $("#appendReport").append(listReport);
              });
        }else{

          var list ="<li>Sorry No Report found</li>";
          $("#appendReport").append(list);
        }

        }
    });
}

$(document).ready(function(){
  $('.s_advansesearch').hide();
  $("#advancesearch").click(function(){
 $('#report_status').val('');
 $('#b_submited').val('');
 $('#to_claim').val('');
 $('#from_claim').val('');
    $('.s_advansesearch').toggle();
  });
});




$("#reportDesc").on('click',function(){
  $("#showDesc").toggleClass('showDiv');
});
</script>
</body>
</html>
