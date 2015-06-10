<?php
 foreach ($policyName as $key2 => $value2) {
        $policyName=$value2->t_PolicyName;
}
foreach ($report as $key3 => $value3) {
        $reportId=$value3->a_ReportId;
        $reportName=$value3->t_ReportName;
        $amountReq=$value3->n_AmountReq;
        $amountReqrah=$value3->n_AmountReq;
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
?>
<section class="main_caintainer">
<!--  <div class="leftSide" style="height: 0px;">
<div class="colL new">

  <select name="businesslisting"id="businesslisting"  onchange="return searchEmpbus(this.value);">
  <option>Select Business </option>
  <?php //foreach //($business as $value) {  ?>
  <option value="<?php //echo $value->a_BusinessId; ?>"> <?php // echo $value->t_BusinessName; ?></option>
   
<?php // } ?>
  </select>
  <span class="iconsel"></span>
</div>
<div class="colL new">
  <select name="employeelisting" id="employeelisting" onchange="return searchEmpReportsssa();">
  <option>Select Employee</option>
  </select>
  <span class="iconsel"></span>
</div>
<div id="noRecord">
 <ul id="appendReport1">
<?php
       /* if($response == 'Something Went Wrong'){
        echo "Record not found";
        }
        else{
        foreach ($response as $key => $value){*/
        ?>
        
          <li class="colL2"> 
          <h5><a href="<?php  //echo base_url();?>ssa/claimreport/detailReports/<?php //echo $value->a_ReportId; ?>/<?php //echo $value->n_BusinessId; ?>/<?php //echo $value->n_DeptId; ?>/<?php //echo $value->n_CreatedBy; ?>/<?php // echo $value->n_PolicyId; ?>"><?php //echo $value->t_ReportName; ?></a></h5>
          <span class="date"><?php  
                       //  $dClaimFrom = date('d m Y', strtotime($value->d_ClaimFrom));
           //echo $dClaimFrom; ?> - <?php 
              //       $d_ClaimTo = date('d m Y', strtotime($value->d_ClaimTo));
          // echo $d_ClaimTo; ?></span>
          <span class="price"><span class="WebRupee">Rs</span><?php // echo $value->n_AmountReq; ?></span>
          <h4 class="colour"><?php // echo $value->t_EmpFirstName.' '.$value->t_EmpLastName; ?></h4>
          <span class="submitt">
            <small>
            <?php // $createdon=  date('d/ m/ Y', strtotime($value->d_CreatedOn)); 
                //echo  $createdon; ?>
            </small>
          </span>
          <li>
          <?php
         // }
        //  }
                 ?>
</ul>
 </div>
 </div>
 -->
 <!-- </div> -->
<!--  Download report start  -->
<div id="download_report"><div class="right_top"><h1>Expense Claim Report</h1>
<span class="buttonWrap">

  <?php if($approved==1) { ?>
<?php
if($ssa_rembursed=='Something Went Wrong'){ ?>
 <button type="button" class="loadbtn new2" onclick="return rmbursed(1)" name="approved" id="">Rembursed</button>
<?php }
else{
if (in_array("8", $ssa_rembursed)) { echo '.'; } else{?>
    <button type="button" onclick="return rmbursed(1)" class="loadbtn new2" name="approved" id="">Rembursed</button>

<?php } } ?>
<!-- rembursed start hear -->
 <button type="button"  onclick="return download_report('download_report');" class="loadbtn" target="_blank"> Download Report</button>
  <?php   }else{ ?>
    <!-- <button type="button" class="loadbtn new1" name="p_approved" id="p_approved">Partically Approve</button> -->
    <button type="button" class="loadbtn new2" onclick="return rmbursed(2);" name="approved" id="">Approve</button>
    <button type="button" class="loadbtn new3" onclick="return rmbursed(3);" name="reject" id="">Reject</button>
     <button type="button"  onclick="return download_report('download_report');" class="loadbtn" target="_blank"> Download Report</button>
  <?php  } ?>
</span>
<div class="fix"></div>
</div>
<div class="innerReport">
<div class="innerLeft">
<h2><?php echo $reportName; ?></h2>
<p><span class="blue"><?php echo $firstName.' '.$lastName; ?>, &nbsp;</span><?php echo $createdBy; ?> </p>
<span class="dscp">Description 

</span></br>
</div>
<div class="innerRight">
	<ul class="rightdet"> 
<li>Report Id</li>
<input type="hidden" name="myreportsid" id="myreportsid" value="<?php echo  $reportId; ?>">


<input type="hidden" name="report_id" id="reportid" value="<?php echo  $reportId; ?>">
<li ><?php echo $reportId; ?></li>
<li>Claim Period</li>
<li><?php echo $dClaimFrom; ?> - <?php echo $dClaimTo; ?></li>
<li>Submitted On</li>
<li><?php echo $createdOn; ?></li>
</ul>
</div>
<div class="innerReport">

<!--varun thakur-->
<script>
$(document).ready(function(){
  $(".dscp").click(function(){
    $(".show").slideToggle(500);
  });
});
</script>


<?php ?><span class="show" id="reportDesc"><?php echo substr($reportDesc,0,20); ?></span><?php ?>
<br />
<ul class="description">
<li>Department </li>
<li><?php echo $deptName; ?></li>
<li>Policy</li>
<li><?php echo $policyName; ?></li>
<!-- <li>Status</li>
 <?php if($approved==1) { ?>
 <li id="status_rep">Approved(<?php echo $approveDate; ?>)</li>
  <?php }else{ ?>
  <li id="status_rep"><?php echo $repStatus; ?>(<?php echo $repSubmitOn; ?>)</li>
  <?php   }?>
  -->
</ul>
<ul class="description">
<li>Amount Requested </li>
<li class="blue"><span class="WebRupee">Rs</span> <?php echo $amountReqrah; ?></li>
<?php
$amountrept= array();
if(!empty($expense)){
  foreach ($expense as $key6 => $value6) {
      $amountrept[]=$value6->t_Amount;
           }  }else{
      $amountrept[]=0;
 }
?>
<li>Amount Reported</li>
<li class="blue"><span class="WebRupee">Rs</span> <?php  $data= array_sum($amountrept);    echo number_format((float)$data, 2, '.', ''); ?></li>
</ul>
<ul class="description">
	<li class="approved">Amount Approved </li> 
<?php if($approved==1) { ?>
  <li class="green" id="amount_app"><span class="WebRupee">Rs</span><?php echo $amountReq; ?></li>
  <?php }else{ ?>
  <li class="green" id="amount_app"><span class="WebRupee">Rs</span><?php echo $amountReq; ?></li>
<?php  }?>

<li>Cash Advance</li>
<li><span class="WebRupee">Rs</span> <?php echo $cashAdvance; ?></li>
<li>To Be Paid </li>
<?php if($approved==1) { ?>
<li class="green" id="amount_paid"><span class="WebRupee">Rs</span> <?php echo $amountToPaid; ?></li>
 <?php }else{ ?>
      <li class="green" id="amount_paid"><span class="WebRupee">Rs</span> <?php echo $amountToPaid; ?></li>
 <?php  }?>
</ul>
</div>
</div>
<div class="innerRight">
<br/>
<?php //if($voilated==1){ ?>
   <!-- <span class="bug"></span> -->
 <?php //}?>
</div>
<div class="notes">
<span id="msg"></span>
<table id="note_append">
<tbody>
   <tr>
    <td>
   <a class="add">Notes</a> </td>
    <td><a href="#" class="bug"></a></td>
    <td><a href="#" class="link"></a></td>
  </tr>

  <tr id="notesEdit">
      <td colspan="3" class="editNotes">
        <textarea name="notesfields" placeholder="enter your notes" id="notesfields"></textarea><input type="button" value="Submit" id="add_notes" class="loadbtn">
      </td>
  </tr>
  </tbody>
</table>
</div>
 <div class="notes notesEx" id="notes">
 <table>
  <tbody>
  
  <tr id="notesAppend"></tr>
  <?php
//  echo 'hi';
//p($notes);
   $i=0;
    foreach ($notes as $key4 => $value4) { ?>
    <tr id='removetr_<?php echo $i; ?>"'>
      <td><span class="table_span"><?php echo substr($value4->t_NoteDesc,0,20); ?></span> <span class="table_span2"><?php echo $value4->t_NoteDesc; ?></span></td>
      <td><?php echo date('d-M-Y',strtotime($value4->d_CreatedOn));?>,by <?php echo $value4->t_Name; ?></td>
      <?php if(($value4->t_Type=='Admin') && ($value4->n_CreatedBy==$businessId)){$delClass="del";}else{$delClass='';} ?>
      <td><span class="<?php echo $delClass; ?> del" id="<?php echo $i; ?>" onclick="return deletenote(<?php echo $i; ?>,<?php echo $value4->a_NoteId?>)"></span></td>
    </tr>
     <input type="hidden" name="note_id" id="note_id<?php echo $i; ?>" value="<?php echo $value4->a_NoteId ?>"/>
 <?php $i++; }?>
</tbody>
</table> 
 </div> 
<span class="expand" id="expandNotes"></span>

<div class="Expenses">
<a class="headexp">Expense</a><!-- <a href="" class="loadbtn">Details</a> -->
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
  <?php 
  //p($notes);
 // p($expense);
if(!empty($expense)){


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
         <td><a href="#" class="bug"></a> <a href="#" class="link"></a></td>
  </tr>
 <?php  } } else{
echo 'Record not found';

 }

 ?>

</table>

</div>


<a href="" class="loadbtn" onclick="return download_report('download_report');">Download Report</a>
<div class="report">
<!-- <h1>Report Action Log</h1>
<p>Last Update 25/12/2014, by Manish Gupta</p> -->

<?php $this->load->view('layout/footer'); ?>

</div>
</div>
</div>
</section>
<div class="fix"></div>

<script>
$(document).ready(function(e) {
  var s=1;
  $(".add").click(function(){
    $(this).parents('table').append("<tr class='ntd' id='removetr_"+s+"'><td><input type='hidden' id='getid_"+s+"' ><input type='text' name='notes[]' id='notes_"+s+"' placeholder='Input Your Message' class='notesnotcheck'></td><td><input type='button' class='loadbtn bluebg' name='Save' value='Save' onclick='return savenoteadmin("+s+");'></td><td><a class='del'></a></td></tr>");
    s++;
  });
});


function deletenote(valcountss,valid)
{
  $(document.body).on("click",".del",function(){
     


      $(this).parents("tr").remove();
  });
    var ccnt  = valcountss;
    var delid = valid;
    //alert(delid);
  $.ajax({
  url:"<?php echo base_url(); ?>ssa/claimreport/deletemynote",
  type:'POST',
  dataType:'json',
  data: {'deleteid':delid },
  success:function(data){
  
  alert('NOTE DELETED SUCCESSFULLY');
  //$("#removetr_"+ccnt).remove();

  alert
  
}
});

}

function savenoteadmin(valuecount)
{  
    var mycount=valuecount;
    //alert('#notes_'+mycount);
    var notes =$('#notes_'+mycount).val();
    //alert(notes);
    var reportId =reportid=$('#myreportsid').val();

 $.ajax({
  url:"<?php echo base_url(); ?>ssa/claimreport/savemynote",
  type:'POST',
  dataType:'json',
  data: {'reportid':reportid, 'noteval':notes },
  success:function(data){
   $("#getid_"+mycount).val(data.a_NoteId);
   alert('NOTE ADDED SUCCESSFULLY');
  }});

}
</script>

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
  $('#notesfields').val('');
  $('#notesEdit').toggle();
});
  $("#add_notes").on('click',function(){
    $('#notesEdit').hide();
    var texValue= $('#notesfields').val();
    var name="<?php echo ucfirst($firstBusName).' '.ucfirst($lastBusName);?>";
    var reportId = "<?php echo $reportId; ?>";
    var date="<?php echo date('d-M-Y');?>";

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

/*$(document.body).on("click",".del",function(){
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

  });*/
$("#approved").on('click',function(){


  var ok = confirm('Do you really want to Aprove this record');
    if(ok){
      $('#amount_app').show();
      $('#amount_paid').show();
      $('#p_approved').hide();
      $('#approved').hide();
      $('#reject').hide();
      var reportId="<?php echo $reportId; ?>";
      $.ajax({
              url: "<?php echo base_url();?>ssa/claimreport/approveReport",
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
                var listReport="<h5>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+">"+value.t_ReportName+"</a>";
                    listReport+="</h5>";
                    listReport+="<span class='date'>"+value.d_ClaimFrom+"- "+value.d_ClaimTo+"</span>";
                    listReport+="<span class='price'><span class='WebRupee'>Rs</span>"+value.n_CashAdvance+"</span>";
                    listReport+="<h4>"+value.t_EmpFirstName+" "+value.t_EmpLastName+"<span class='iconerror'></span></h4>";
                    listReport+="<span class='submitt'>Submitted<small>"+value.d_CreatedOn+"</small></span>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='approve'>approve</a>";
                    listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='iconlink'></a>";
                 
                $("#appendReport").appendTo(listReport);
              });
        }else{
          $("#appendReport").html('<p>No Result Found</p>');
        }
        }
    });
});
$("#reportDesc").on('click',function(){
  $("#showDesc").toggleClass('showDiv');
});
</script>

<script type="text/javascript">
$('#add_ssanots').on('click',function(event) {
  event.preventDefault();
var j=1;
$('#note_append tbody').append("<tr><td><textarea id=notes_ssa"+j+" ></textarea></td><td><input type=button onclick='return notesave("+j+");'</td></tr>");
$('#msg').html('Some text and markup');
j++;
});


function notesave(j){
var notes =$('#notes_ssa'+j).val();
var reportId =reportid=$('#reportid').val();

$.ajax({
  url:"<?php echo base_url(); ?>ssa/claimreport/notessave",
  type:'POST',
  dataType:'jsonp',
  data: {'act_mode':act_mode ,'reportid':reportid},
 success:function(data){
  console.log(data);
  alert(data+'Successfully!.');

        }
});
}
    function download_report(strid) {
        window.print();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assects/js/business_search_sheetesh.js"></script>

<script type="text/javascript">
function rmbursed(action){
  alert('hello');
  alert(action);
if(action==1){
  var act_mode='reimbuesed';
}
if(action==2){
 var act_mode='approved';
}
if(action==3){
  var act_mode='reject';
}

var reportid=$('#reportid').val();
//alert(reportid);
$.ajax({
  url:"<?php echo base_url(); ?>ssa/claimreport/reportrembursed",
  type:'POST',
  dataType:'jsonp',
  data: {'act_mode':act_mode ,'reportid':reportid},
 success:function(data){
  console.log(data);
  alert(data+'Successfully!.');

        }
});
}
</script>
</body>
</html>
