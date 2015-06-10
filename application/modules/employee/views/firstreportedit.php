<?php 
//p($policyAssign);

$myreimbunded = 0;
########### Rqhul yadav  12/12/2014 #########

if($expenselist !=="Something Went Wrong"){

foreach ($expenselist as $key => $value) {
		if($value->b_IsReimburs == 1){
			$myreimbunded = $myreimbunded+$value->t_Amount; 
		}
}
}
$data = checklogin(); 
// myreimbunded
?>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<input type="hidden" name="monthlyexp" id="monthlyexp" value="<?php echo $policyname->n_MaxRptAmt;?>">

<script>
	$(document).ready(function() {

		$(document.body).on("click",".link",function(){
			var getId= $(this).next().attr('id');
			$('.popupsecond').attr('id', getId);
			$("#check").val(getId);
			$('.overlayNew').fadeIn();
			$('.popupsecond').fadeIn();
		});

		// box close ends here

		$('.mypopup').click(function(){

			var txt=cl_Hidden.val();
txt='';
			$("#preview input[type=text]").each(function(row,tr){
				//alert($(tr).html());
				txt=txt+','+$(tr).val();
			});
			//cl_Hidden.val('');
			cl_Hidden.val(txt);
			//alert(cl_Hidden.val());
			$('.overlayNew').fadeOut();
			$('.popupsecond').fadeOut();
			var MyId = $("#check").val();
			// getting which list it is
			var MyId = MyId.split('_');
			//$('atthFile_'+MyId[1]).html("<input type='text' name='img[]' class='imgVal'"+MyId+" value=''>");
			$("#atthFile_"+MyId[1]).val(); 


		});
	});
var cl_Hidden;
	function fn_GetImagePath(input)
	{
		//alert('dfhgdf');
		//cl_Hidden.val('');
		var per =$(input).parents("td");
	//	alert($(per).find('input[type=file]').attr('id'));
	//	alert($("#popupFile input[type=text][id=check]").val());
		if($(per).find('input[type=file]').attr('id')!=$("#popupFile input[type=text][id=check]").val())
		{

    $("#preview").empty();
    //cl_Hidden.val('');
		}
		
		cl_Hidden=$(per).find("input[type=hidden][id=t_FileName]");
	
	}
</script>
<div class="overlayNew"></div>
<?php 
	
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
<style>.pink {border: 1px solid red;border: 10px solid green;}.atthFile{display: none;} .imgList{width:40px; height:40px;}</style>
<form id="imageform111" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>employee/dashboard/ajaxImageUpload' style="clear:both">
	<div class="popupsecond">
		<a class="close_icon mypopup"></a>
		<h2>Select Your File</h2>
		<div class="inputfile" id="popupFile"><input type="text" name="hidden" value="" id="check">
		<input type="text" name="nametest" value="">
		<label class="btn" for="photoimg">Select Your File</label>
		<input type="file" name="photos[]" id="photoimg" multiple="true" style="display:none;"/>
        </div>
		<div style="margin-top:10px;">
			<div id='preview'>
			</div>
		</div>
	</div>
</form>



<div class="overlay" id="checkboxPop4" >
<div class="popup">
<a class="close_icon"></a>
<div class="buttonWrap">
	<a  class="loadbtn bluebg" id="" onclick="return updatedatailssingls(this.value)">Save</a></div>
<div>
<input type="hidden" name="reportidtr4" id="reportidtr4" name="reportidtr4" value="">
<input type="hidden" name="ricogtr4" id="ricogtr4" name="ricogtr4" value="">
<input type="hidden" name="cathidden4" id="cathidden4" class="cathidden4" value="">
<input type="hidden" name="rimhidden4" id="rimhidden4" class="rimhidden4" value="">
<input type="hidden" name="taghidden4" id="taghidden4" class="taghidden4" value="">
<input type="hidden" name="voilhidden4" id="voilhidden4" class="voilhidden4" value="">
<input type="hidden" name="expnseid4" id="expnseid4" class="expnseid4" value="">

	<div 
	<div class="colRow"><label>Date</label> <input id="datepicker-example1s14" class="dat14 date4" type="text" name="datetr4"></div>
	<div class="colRow"><label>Amount</label><?php  if($curreny->CURRENCY == 'USD') { ?> <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/><?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?><input type="text"  name="amounttr4" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" id="amounttr4" class="amount1114" ></div>
	<div class="colRow"><label>Category</label> <select name="categorytr4" id="categorytr4" class="categorytr4"><option>Select Category</option>


  <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->a_SpndngCatId; ?>"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>
  </select></div>
	<div class="colRow"><label>Merchant</label> <input type="text" value="" name="merchant4" id="merchant4" class="merchant4"></div>
	<div class="colRow"><label>City</label> <select name="city4" id="city4" class="city4" onchange="return cityshe(this.value)"><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?><option value="-1">Other</option></select>

     </div>
<div class="colRow" id="lblothercity4" style="display:none"><label >Other City</label><input type="text" name="othercity" id="odrct" class="odrct"></div>
	<div class="colRow"><label>Purpose</label> <input type="text" value="" name="purposetr4" id="purposetr4" class="purposetrs4"></div>
	
	<div class="colRow"><label>Reimbursabe</label> <select name="reimbursabletr4" id="reimbursabletr4" class="reimbursabletr4"><option value="1">Yes</option><option value="0">No</option></select></div>
	<div class="colRow"><label>GL Code</label> <select name="glcodetr4" id="glcodetr4" name="glcodetr4"><option>Select GLCode </option>



  <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->a_SpndngCatId; ?>"><?php echo $value->t_GLCode; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>
  </select></div>
  
  <div class="colRow"><label>Custom Tag1</label> <select name="customtag14" id="customtag14" class="customtag14">


  <option value="">Select  Custom Tag1</option>
  <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>





  </select></div>
	<div class="colRow"><label>Custom Tag2</label> <select name="customtag24" id="customtag24" class="customtag24"><option value="">Select Custom Tag2</option>

<?php if(!empty($customtag2)){
                foreach ($customtag2 as $keys => $valuesc2) {?>
                    <option value = "<?php echo $valuesc2->a_CustTagId; ?>"><?php echo $valuesc2->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>

</select></div>
</div>

<label>Policy Violations Red</label> <a href="#" id="popamnt4" class="popamnt " ></a><input type="hidden" name="violationstatustr4" value="" class='violationstatustr4' id="violationstatustr4">
<a style="display: none; margin-left: 330px;" id="totalextraFInal" class="bug4" href="#" title="Your Amount is exceed from policy Report Max Amount"></a>
</div>

</div>


<!--
<div class="overlay">
<div class="popup">
<a class="close_icon"></a>
<div class="buttonWrap">
	<a href="" class="loadbtn bluebg" id="save_extra_exp">Save</a></div>
<div>
	<div class="colRow"><label>Type</label> <select><option>Money Spent</option></select></div>
	<div class="colRow"><label>Date</label> <input id="datepicker-example1s1" class="dat12" type="text"></div>
	<div class="colRow"><label>Amount</label><input type="text" value=""></div>
	<div class="colRow"><label>Category</label> <select><option>Travel</option></select></div>
	<div class="colRow"><label>Distance</label> <input type="text" value=""></div>
	<div class="colRow"><label>City</label> <input type="text" value=""></div>
	<div class="colRow"><label>Purpose</label> <input type="text" value=""></div>
	<div class="colRow"><label>GPS Calculated Yes</label></div>
	<div class="colRow"><label>Reimbursabe</label> <select><option>Yes</option></select></div>
	<div class="colRow"><label>GL Code</label> <select><option></option></select></div>
	<div class="colRow"><label>Custom Tag1</label> <select><option>Yes</option></select></div>
	<div class="colRow"><label>Custom Tag2</label> <select><option>Yes</option></select></div>
</div>

<div class="notes">
<table>
  <thead><tr>
    <td><a><a class="add addnotes">Notes</a></a></td>
     </tr></thead>
  <tbody>
     <tr>
    <td><a>First Note comes here</a></td>
    <td><a><span class="size_small">,</span> by Me</a></td>
    <td><a class="del"></a></td>
  </tr>
</tbody></table>
</div>
<div class="buttonWrap">
<br />
<label class="loadbtn bluebg" for="atthFile" >Attach</label> <input type="file" id="atthFile">
</div>
<hr />
<label>Policy Violations Red</label> <a href="#" class="bug" ></a>
</div>

</div>
-->
<section class="main_caintainer">
<?php $date= date("Y-m-d"); ?>
<div class="rightSide empwrap" style=" width: 99% !important;">
<div class="right_top" ><span class="buttonWrap"><a href="<?php echo base_url(); ?>employee/claim" class="loadbtn">Back to List</a>
<a href="<?php echo base_url();?>employee/dashboard/reportfirst2/" class="loadbtn bluebg">New Report</a> </span>
<span class="buttonWrap">
<?php 
if($claimreport->n_status == 'submit' || $claimreport->n_status == 'Reimbursed'|| $claimreport->b_Approved==1){
?><span>	
	<input type="button" class="loadbtn loadbtn2" value="Delete Report" style="cursor:not-allowed" > 
	<input type="button" class="loadbtn" name="" value="Save" style="cursor:not-allowed">
	<input type="button" class="loadbtn loadbtn2" value="Submit" style="cursor:not-allowed">
	<input type="button" class="loadbtn loadbtn2 bluebg" value="Save Notes" onclick="return submitmynote(this.value);">

</span>
<?php
}
else{
?>
<span>	
	<input type="button" id="delrept" class="loadbtn loadbtn2" value="Delete Report"> 
	<input type="button" id="savemynt" style="display:none;" onclick="return submitmynote(this.value);" class="loadbtn loadbtn2" value="Save Note" > 

	<input type="button" class="loadbtn" name="" value="Save" id="saveReport" onclick="return savereportexp(); " >
	<input type="button" id="deletereport" class="loadbtn loadbtn2" value="Submit" onclick="return  submitexpense();">
</span>

<?php	
}
?>


<div class="fix"></div></div>
<div id="sucessmsg"> </div>
<div class="formPreExp">
<div class="col"><label>Report Name </label> 
<input type="text" name="report_name" id="report_name" value="<?php echo $claimreport->t_ReportName;?>" /></div>
<div class="col">
	<p><span id="myreportIdfirst" style="display:inline-block;">Report Id  &nbsp;</span> <label id="myreportId"><?php echo $claimreport->a_ReportId; ?></label></p>
</div>

	<div class="col">
		<label>Report Type</label> 
		<select name="report_type" id="report_type">
			<option value="">--Select Report Type--</option>
			 <option value="1" <?php if($claimreport->n_ReportTypeId==1){ echo "selected"; } ?>>Expenses Reported</option>
			<option value="0" <?php if($claimreport->n_ReportTypeId==0){ echo "selected"; } ?>>Pre Expenses Request</option>
           
		</select>
	</div>

<div class="col">
	<label>Status</label>
	
<?php 
	if($claimreport->b_Approved==1){
?>
	<input type="text" name="status" id="status" value="<?php echo "Approved";  ?>" readonly="readonly">
<?php
	}else{
?>
	<input type="text" name="status" id="status" value="<?php echo $claimreport->n_status;  ?>" readonly="readonly">
<?php
	}
?>
	
</div>
<input type="hidden" name="departmentId" value="2">
<div class="col"><label>Claim Period Form</label> 
<input type="text" name="chaim_period_form" id="datepicker-example1" class="dat33 datepicker_all" value="<?php echo date('d M, Y', strtotime($claimreport->d_ClaimFrom)); ?>" ></div>
<div class="col"><label>Claim Period To</label> 
<input id="datepicker-example1s" name="chaim_period_to" class="dat33" type="text" value="<?php echo date('d M, Y', strtotime($claimreport->d_ClaimTo)); ?>" ></div>
<div class="col"><label>Cash Advance <?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?></label>
<input type="text" name="cash_advance" id="cash_advance" onkeypress="return isNumber(event)"; onkeyup = "return calculateTotalAmount();" value="<?php echo $claimreport->n_CashAdvance; ?>" /></div>
<div class="col">
	<p><span>Amount Reported </span> 
	<span class="amountg"><?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?><span id="TotalAmountRepoted"><?php echo $claimreport->n_AmountReq; ?></span></span></p>
</div>
<div class="col"><label>Description</label>
<input type="text" name="description" id="description" value="<?php echo $claimreport->t_ReportDesc;?>" /></div>
<div class="col">
	<p><span>Amount Requested</span>
	<span class="amountg">
	<?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?><span id="TotalamountRembasment"><?php echo $myreimbunded; ?></span></span></p>
</div>
</div>
<div class="notes" id="deep">
<table>
  <tr>
    <td><a class="add">Notes</a></td>
    <td>
    	<a href="#" class="bug" id="totalextraFInal" style="display:none;"></a>
    	<input type="hidden" name="b_IsVoilated" value="0" class="inputb" id="b_IsVoilated">
     </td>
    <td><label class="link2"></label>
    <input type="file" id="atthFile_0" name="atthFile" class="atthFile"></td>
  </tr>


<?php
  		if($notes !='Something Went Wrong'){

  		foreach ($notes as $key => $value) {
  
  ?>
  <tr class="ntd">
  <td><input type='text' name='notes[]' id='notes' placeholder='Input Your Message' class='notesnotcheck' value="<?php echo $value->t_NoteDesc; ?>"></td>
  
    <td><span class="size_small"><?php echo $value->d_CreatedOn ; ?>,</span> by <?php echo $value->myname; ?></td>
    <td><a class="del alert" id="delete_<?php echo $value->a_NoteId; ?>" onclick="return deltenote(<?php echo $value->a_NoteId; ?>);"></a></td>
  </tr>
  <?php			
  		}
  		}
  ?>
</table>
</div>
<div class="right_top" style="margin-top: 0px; padding-bottom: 8px !important; padding-top: 8px !important; border-top: 0px solid #999; border-bottom:0;">


<!-- <span class="buttonWrap">
<?php 
if($claimreport->n_status == 'submit' || $claimreport->n_status == 'Reimbursed'|| $claimreport->b_Approved==1){
?><span>	
	<input type="button" class="loadbtn loadbtn2" value="Delete Report" style="cursor:not-allowed" > 
	<input type="button" class="loadbtn" name="" value="Save" style="cursor:not-allowed">
	<input type="button" class="loadbtn loadbtn2" value="Submit" style="cursor:not-allowed">
	<input type="button" class="loadbtn loadbtn2 bluebg" value="Save Notes" onclick="return submitmynote(this.value);">

</span>
<?php
}
else{
?>
<span>	
	<input type="button" id="delrept" class="loadbtn loadbtn2" value="Delete Report"> 
	<input type="button" id="savemynt" style="display:none;" onclick="return submitmynote(this.value);" class="loadbtn loadbtn2" value="Save Note" > 

	<input type="button" class="loadbtn" name="" value="Save" id="saveReport" onclick="return savereportexp(); " >
	<input type="button" id="deletereport" class="loadbtn loadbtn2" value="Submit" onclick="return  submitexpense();">
</span>

<?php	
}
?> -->
<input type="button" class="loadbtn loadbtn2 bluebg" id="details" style="display:none;" value="Details" onclick="return showdetailspop(1);">
<span class="loading" style="display: none;">
	<img src="<?php echo base_url();?>assects/images/image.gif">
</span>
<div class="fix"></div>

<div class="Expenses exp">
<div>
	<a class="headexp">Expenses</a>
<?php 
if($claimreport->n_status == 'submit' || $claimreport->n_status == 'Reimbursed'|| $claimreport->b_Approved==1){
?>
    <span class="buttonWrap">
 		<a href="" class="loadbtn" style="cursor:not-allowed" >Import Expenses</a>
 		<a href="" class="loadbtn" style="cursor:not-allowed">Add Expenses</a>
 	</span>
<?php
		}
		else{
?>
    <span class="buttonWrap">
 		<a href="" class="loadbtn">Import Expenses</a>
 		<a class="loadbtn addexpense" onclick="return addnewexprow()" >Add Expenses</a>
 	</span>
<?php 
		}
?> 	
<div class="fix" id="totalextra" style="display:none;"></div>
</div>

<input type="hidden" name="hidden" value="5" id="countHidden">
<table border="1">
 <tr>
    <th><input type="checkbox" id="prentCheck_<php echo $i;?>" name="prentCheck" ></th>
    <th>Type</th>
    <th>Category</th>
    <th style="width:120px;">Date</th>
    <th>Amount</th>
    <th>Merchant</th>
    <th style="width:300px;">Purpose</th>
    <th>Reimb.</th>
    <th style="width:80px">Tag1</th>
    <th style="width:130px;">&nbsp;</th>
</tr>
<?php 
	if($expenselist!="Something Went Wrong"){
		$count = 0;
		foreach($expenselist as $key => $Myvalue){		
		$count = $count+1;	
?>
 <tr id="removetr_<?php echo $count; ?>">
    <td><input type="checkbox" id="check_<?php echo $count;?>" onclick="return getdetailsbtn(<?php echo $count; ?>,<?php echo $Myvalue->a_ExpPlcyMapId; ?>)"></td>
        <td> <?php  if($curreny->CURRENCY == 'USD') { ?> <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/><?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
        <td>
            <select  name="category[]" id="category_<?php echo $count;?>" class="category">
                <option value="">Select</option>
                <?php if(!empty($policyAssign)){


                    foreach ($policyAssign as $key => $value) {

                    	if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}
						if($Myvalue->n_CategoriesID == $value->n_spndngcatid){
							$selected = "selected";
						}else{
							$selected = "";
						}
					?>
                        <option <?php echo $selected; ?> value = "<?php echo $value->a_SpndngCatId.'-'.$value->t_SpndName.'@'.$spn; ?>*3"><?php echo $value->t_SpndName; ?></option>
                 <?php   }
                    }else{ echo "No Records Founds"; } ?>
            </select>
        </td>
        <td><input class="dat date datepicker_all date_<?php echo $count;?>" name="date[]" type="text" value="<?php echo date('d M, Y', strtotime($Myvalue->d_Date)); ?>" ></td>
        <td><input type="text" value="<?php echo $Myvalue->t_Amount; ?>"  class="amount1" id="amount_<?php echo $count;?>" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" ></td>
        <td><input type="text" name="merchant[]" class="merchant" value="<?php echo $Myvalue->t_Merchant; ?>" id="merchant_<?php echo $count;?>"></td>
        <td><input type="text" name="purpose[]" class="purpose" value="<?php echo $Myvalue->t_Purpose; ?>" id="purpose_<?php echo $count;?>"></td>
        <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_<?php echo $count;?>" onclick="return checkReimb();" <?php if($Myvalue->b_IsReimburs==1){ echo "checked";}?> ></td>
        <td>
            <select name="tag[]" class="tag" id="tag_<?php echo $count;?>">
                <option>Yes</option>
                <option>No</option>
            </select>
        </td>
        <td>
           <a href="#" class="comon" id="bug_<?php echo $count;?>"></a>
            <label class="link"></label>
            <input type="file" name="atthFile[]" id="atthFile_1" class="atthFile" >

            <span  class="save" onclick="return updatesingle(<?php echo $count;?>,<?php echo $Myvalue->a_ExpPlcyMapId; ?>)"></span>
            <input type="hidden" name="violationstatus" value="<?php echo $Myvalue->b_IsVoilated; ?>" class='violationstatus' id="violationstatus_<?php echo $count;?>">
            <span class="del" onclick="return deleteexp(<?php echo $Myvalue->a_ExpPlcyMapId; ?>,<?php echo $count;?>)"></span>
           <div class="imgName_<?php echo $count;?>">
            </div>
       </td>
     </tr>
<?php
		}
	}
?>
</table>
<div class="buttonWrapInner">
<!-- <a href="" class="loadbtn bluebg">Save Expensess</a> -->
<?php
if($claimreport->n_status == 'submit' || $claimreport->n_status == 'Reimbursed'|| $claimreport->b_Approved==1){
?>
<input type="button" name="save"  class="loadbtn" value="Save Expensess" style="cursor:not-allowed">
<?php
	}else{
?>
<input type="button" name="save" id="save_expenses" onclick="return addtrueexpense22();" class="loadbtn bluebg" value="Save Expensess">
<?php
	}
?>
<a href="" class="loadbtn">Copy</a>
<div class="fix"></div> </div>
</div>
<!--<div class="right_top" style=" margin-top: 14px; padding-bottom: 8px !important; border-bottom: 2px solid #807f82; height: 200px;"><span class="buttonWrap"><a href="" class="loadbtn">Import Expense</a><a href="" class="loadbtn">Export Expense</a> </span>
<div class="fix"></div>
</div>-->
<div class="fix"></div>
</section>
</div>
</div>
<div class="fix"></div>
<div class="popupsecondh" id="atthFil">
		<a class="close_icon"></a>
		<h2>Select Your File</h2>
		<div class="inputfile" id="popupFile"><input type="text" name="hidden" value="" id="check">
		<input class="boxtu" type="text"  name="nametest" value="">
		<label class="btn next" for="photoimg">Select Your File</label>
		<input type="file" name="photos[]" id="photoimg" multiple="true" style="display:none;">
        </div>
		<div style="margin-top:10px;">
			<div id="preview"></div>
		</div>
		
	</div>

</section>
<script>
$(document).ready(function(e) {
  $(".add").click(function(){
    $(this).parents('table').append("<tr class='ntd'><td><input type='text' name='notes[]' id='notes' placeholder='Input Your Message' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>,</span></td><td><a class='del'></a></td></tr>");
  });
 	$(document.body).on("click",".del",function(){
    	$(this).parents("tr").remove();
	});
});
</script>
<script>
$(document).ready(function(e) {
$(".add").click(function(){
    $("table").append("");
  });
});






function showdetailspop(apndcount)
{
 var getmycount=apndcount;
 var damountval    = $("#amount_"+getmycount).val();
 var dcatval       = $("#category_"+getmycount).val();
 var ddateval      = $(".date_"+getmycount).val();
 var dmerchantval  = $("#merchant_"+getmycount).val();
 var dpurposeval   = $("#purpose_"+getmycount).val();
 var drimbval      = $("#reimb_"+getmycount).val();
 var dtagval       = $("#tag_"+getmycount).val();
 var dvoilval      = $("#violationstatus_"+getmycount).val();
 //alert(dpurposeval);
 $(".date4").val(ddateval);
 $("#amounttr4").attr('id', 'amount_'+getmycount);
 $('#amount_'+getmycount).val(damountval);
 $("#cathidden4").val(dcatval);
 $("#merchant4").val(dmerchantval);
 $("#purposetr4").val(dpurposeval);
 $("#rimhidden4").val(drimbval);
 $("#taghidden4").val(dtagval);
 //$("#voilhidden4").val(dvoilval);bug4
 $("#violationstatustr4").attr('id', 'violationstatus_'+getmycount);
 $('#violationstatus_'+getmycount).val(dvoilval);
 $(".bug4").attr('class', 'bug');

 $("#checkboxPop4").show();

}

function getdetailsbtn(detailscount,getexpid)
{ var detailscounts=detailscount;
	var detailsid = getexpid;
	//alert(detailsid);
  $("#details").attr('onclick', 'return showdetailspop('+detailscounts+')');
  $("#details").css('display', 'inline-block');
  $("#expnseid4").val(detailsid);


}
</script>
<script>
 $(document).ready(function() { 
            $('#photoimg').die('click').live('change', function(){ 
            	var number =  $("#preview img").length;
            	if(number >=3){
            		$("#photoimg").prop("disable","disable",true);
            		alert("Only Three reports per expense");
            		return false;
            	}
			          //$("#preview").html('');
				$("#imageform111").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
				        $("#imageloadstatus").show();
					 	$("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				     $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
			});
        }); 
</script>
<script>
function savereportexp(){
  if($("#myreportId").text() == ""){
  var Mybase_url = '<?php echo base_url();?>';
  // form submit starts here
  var report_name         = $("#report_name").val();
  var report_type         = $("#report_type option:selected").val();
  var status              = $("#status").val();
  var chaim_period_form   = $("#datepicker-example1").val();
  var cash_advance        = $("#cash_advance").val();
  var chaim_period_to     = $("#datepicker-example1s").val();
  var description         = $("#description").val();
  var b_IsVoilated        = $("#b_IsVoilated").val();
  var buttonType          = 'save';
  var grandtotal          = parseInt($("#TotalAmountRepoted").text());

 // var notes               = $(".notes").val();
  var kancha = [];
  var count = 0; 
   $.each($('.ntd .notesnotcheck'), function() {
   		if($(this).val() != "" )
        kancha.push($(this).val());
    });

  
  //console.log($(".notesnotcheck").val());
 
if(report_name==""){
    $("#report_name").css('border','1px solid red');
    $("#report_name").focus();
    return false;
  }else{
    $("#report_name").css('border','1px solid green');
  }
  if(report_type==""){
    $("#report_type").css('border','1px solid red');
    $("#report_type").focus();
    return false;
  }else{
    $("#report_type").css('border','1px solid green');
  }
	if(kancha ==''){
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}else{
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}

   $('.loading').css('display', 'block');
   var buttonName = $("#saveReport").val();

    // ajax call will come here
      $.ajax({
        url: Mybase_url+'employee/dashboard2/reportsubmit/',
        type:'POST',
        dataType:'json',
        data: myData,
        success: function(data){
          //console.log(data);
          $("#saveReport").attr('disabled','TRUE');
          $("#myreportId").text(data.lastId);
          $("#delrept").attr('disabled', 'false');
          $("#myreportIdfirst").css('display', 'inline-block');
          $('.loading').css('display', 'none');
          $("#saveReport").removeAttr('id');
          if(data !=""){
            $("#sucessmsg").html('Report Generated Successfully');
            alert("Report Saved Successfully");
            $(".loadbtn ").removeAttr("disabled");
          }
         /* if(addtrueexpense()){
          	var myreportId = parseInt($("#myreportId").text());
          	window.location.replace(Mybase_url+"employee/dashboard2/editclaim/"+myreportId);
          }*/
        }
      });
    } else{
			//alert("Update");
		// update will come here
			  var myreportId =	$("#myreportId").text();
			  var Mybase_url = '<?php echo base_url();?>';
			  // form submit starts here
			  var report_name         = $("#report_name").val();
			  var report_type         = $("#report_type option:selected").val();
			  var status              = $("#status").val();
			  var chaim_period_form   = $("#datepicker-example1").val();
			  var cash_advance        = $("#cash_advance").val();
			  var chaim_period_to     = $("#datepicker-example1s").val();
			  var description         = $("#description").val();
			  var b_IsVoilated        = $("#b_IsVoilated").val();
			  var buttonType          = 'save';
			  var grandtotal          = parseInt($("#TotalAmountRepoted").text());

			 // var notes               = $(".notes").val();
			  var kancha = [];
			  var count = 0; 
			   $.each($('.ntd .notesnotcheck'), function() {
			   		if($(this).val() != "" )
			        kancha.push($(this).val());
			    });
			  //console.log($(".notesnotcheck").val());
			if(report_name==""){
			    $("#report_name").css('border','1px solid red');
			    $("#report_name").focus();
			    return false;
			  }else{
			    $("#report_name").css('border','1px solid green');
			  }
			  if(report_type==""){
			    $("#report_type").css('border','1px solid red');
			    $("#report_type").focus();
			    return false;
			  }else{
			    $("#report_type").css('border','1px solid green');
			  }
				if(kancha ==''){
					  var myData  = {'myreportId':myreportId, 'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
				}else{
					  var myData  = {'myreportId':myreportId,'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
				}

			   $('.loading').css('display', 'block');
			   var buttonName = $("#saveReport").val();

			    // ajax call will come here
			    var ok = confirm('Are You Sure you want to Save');
			  if(!ok){
			  	return false; 
			  }
			   $.ajax({
			        url: Mybase_url+'employee/dashboard2/updatereprote/',
			        type:'POST',
			        dataType:'json',
			        data: myData,
			        success: function(data){
			          $("#saveReport").attr('disabled','TRUE');
			          $("#myreportId").text(data.lastId);
			          $("#delrept").attr('disabled', 'false');
			          $("#myreportIdfirst").css('display', 'inline-block');
			          $('.loading').css('display', 'none');
			          $("#saveReport").removeAttr('id');
			          if(data !=""){
			            $("#sucessmsg").html('Report Generated Successfully');
			            alert("Report Submitted Successfully");
			            $(".loadbtn ").removeAttr("disabled");
			          }
			         // addtrueexpense();
			        }
			      });
	
		// update end will come here
	}       
    // ajax call ends here
  // form submit ends here
}
function submitexpense(){
  if($("#myreportId").text() ==""){
  var Mybase_url = '<?php echo base_url();?>';
  // form submit starts here
  var report_name         = $("#report_name").val();
  var report_type         = $("#report_type option:selected").val();
  var status              = $("#status").val();
  var chaim_period_form   = $("#datepicker-example1").val();
  var cash_advance        = $("#cash_advance").val();
  var chaim_period_to     = $("#datepicker-example1s").val();
  var description         = $("#description").val();
  var b_IsVoilated        = $("#b_IsVoilated").val();
  var buttonType          = 'submit';
  var grandtotal          = parseInt($("#TotalAmountRepoted").text());
 // var notes               = $(".notes").val();
  var kancha = [];
  var count = 0; 
   $.each($('.ntd .notesnotcheck'), function() {
   		if($(this).val() != "" )
        kancha.push($(this).val());
    });
  //console.log($(".notesnotcheck").val());
if(report_name==""){
    $("#report_name").css('border','1px solid red');
    $("#report_name").focus();
    return false;
  }else{
    $("#report_name").css('border','1px solid green');
  }
  if(report_type==""){
    $("#report_type").css('border','1px solid red');
    $("#report_type").focus();
    return false;
  }else{
    $("#report_type").css('border','1px solid green');
  }
	if(kancha ==''){
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}else{
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}

   $('.loading').css('display', 'block');
   var buttonName = $("#saveReport").val();

    // ajax call will come here
    var ok = confirm('Are You Sure you want to submit');
  if(!ok){
  	return false; 
  }
      $.ajax({
        url: Mybase_url+'employee/dashboard2/reportsubmit/',
        type:'POST',
        dataType:'json',
        data: myData,
        success: function(data){

          $("#saveReport").attr('disabled','TRUE');
          $("#myreportId").text(data.lastId);
          $("#delrept").attr('disabled', 'false');
          $("#myreportIdfirst").css('display', 'inline-block');
          $('.loading').css('display', 'none');
          $("#saveReport").removeAttr('id');
          if(data !=""){
            $("#sucessmsg").html('Report Generated Successfully');
            alert("Report Submitted Successfully");
            $(".loadbtn ").removeAttr("disabled");
          }
          //addtrueexpense();
        }
      });
    // ajax call ends here
  // form submit ends here
	}else{
		// update will come here
			  var myreportId =	$("#myreportId").text();
			  var Mybase_url = '<?php echo base_url();?>';
			  // form submit starts here
			  var report_name         = $("#report_name").val();
			  var report_type         = $("#report_type option:selected").val();
			  var status              = $("#status").val();
			  var chaim_period_form   = $("#datepicker-example1").val();
			  var cash_advance        = $("#cash_advance").val();
			  var chaim_period_to     = $("#datepicker-example1s").val();
			  var description         = $("#description").val();
			  var b_IsVoilated        = $("#b_IsVoilated").val();
			  var buttonType          = 'submit';
			  var grandtotal          = parseInt($("#TotalAmountRepoted").text());

			 // var notes               = $(".notes").val();
			  var kancha = [];
			  var count = 0; 
			   $.each($('.ntd .notesnotcheck'), function() {
			   		if($(this).val() != "" )
			        kancha.push($(this).val());
			    });
			if(report_name==""){
			    $("#report_name").css('border','1px solid red');
			    $("#report_name").focus();
			    return false;
			  }else{
			    $("#report_name").css('border','1px solid green');
			  }
			  if(report_type==""){
			    $("#report_type").css('border','1px solid red');
			    $("#report_type").focus();
			    return false;
			  }else{
			    $("#report_type").css('border','1px solid green');
			  }
				if(kancha ==''){
					  var myData  = {'myreportId':myreportId, 'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
				}else{
					  var myData  = {'myreportId':myreportId,'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
				}
			   $('.loading').css('display', 'block');
			   var buttonName = $("#saveReport").val();
			    // ajax call will come here
			    var ok = confirm('Are You Sure you want to submit');
			  if(!ok){
			  	return false; 
			  }
			   $.ajax({
			        url: Mybase_url+'employee/dashboard2/updatereprote/',
			        type:'POST',
			        dataType:'json',
			        data: myData,
			        success: function(data){
			        	//console.log(data); 
			          $("#saveReport").attr('disabled','TRUE');
			          $("#myreportId").text(data.lastId);
			          $("#delrept").attr('disabled', 'false');
			          $("#myreportIdfirst").css('display', 'inline-block');
			          $('.loading').css('display', 'none');
			          $("#saveReport").removeAttr('id');
			          if(data !=""){
			            $("#sucessmsg").html('Report Generated Successfully');
			            alert("Report Submitted Successfully");
			            $(".loadbtn ").removeAttr("disabled");
			          }
			          //addtrueexpense();
					  window.location.href = Mybase_url+"employee/claim";
			        }
			      });
		// update end will come here
	}
}
</script>
<script type="text/javascript">
function calculateTotalAmount(){
		var preexpense  =  0;
		 if(preexpense ==""){
			  preexpense = 0;
		} 
		
		var forcount    = 1+parseInt($("#countHidden").val());	
		var total       = 0;
				
		for (var i = 1; i < forcount; i++) {
			
			if($("#amount_"+i).val() == ""){
				var amount = 0;
			}else{
				   // alert("#category_"+i);
            var categoryval = $("#category_"+i+" option:selected").val();
             //console.log(categoryval);
            var ispopup1 = categoryval.substring(categoryval.lastIndexOf("-") + 1);
     
       

            var ispopup12 = ispopup1.substring(0, ispopup1.lastIndexOf("@"));
            //console.log(ispopup12);

            var ispopup = ispopup1.substring(0, ispopup1.lastIndexOf("*"));
            //console.log(ispopup);

        //var ammount=  ispopup1.substring(ispopup1.lastIndexOf("@")+1);
        //console.log(ammount);

        var ammount1=  ispopup.substring(ispopup.lastIndexOf("@"));
     //  console.log(ammount1);
          var ammount122=  parseInt(ispopup.substring(ispopup.lastIndexOf("@")+1));
     // console.log(ammount122);
      //alert(ammount122);

                var amount = parseInt($("#amount_"+i).val());
         		   // console.log(amount);
               
                if(ammount122 < amount){
                	//alert('ss');
                 $(".popamnt").addClass("bug");
                 $(".popamnt").attr('title',  'Your Expence is exceeds from policy Report Max Amount');
                 $("#violationstatustr").val(1);
               	 $("#bug_"+i).addClass("bug");
               	 

               	 $("#violationstatus_"+i).val(1);
                }
                else{
                	//alert('how');
                 $(".popamnt").removeClass("bug");
                  $("#violationstatustr").val(0);
                 $("#bug_"+i).removeClass("bug");   
                 $("#violationstatus_"+i).val(0);
                }
              
              
               
			}
				
			total = total+amount;	
              }
			
	
		  total  = parseInt(preexpense)+parseInt(total); 
		  $("#TotalAmountRepoted").html(total);
		  if(total>$("#monthlyexp").val()){
      var iscashallow=$("#cash_allowed").val();
      if(iscashallow==0)
       {
			$("#totalextraFInal").css('display', 'block');
            $("#totalextraFInal").css('margin-left', '330px');
            $("#totalextraFInal").attr('title',  'Your Amount is exceed from policy Report Max Amount And Cash is not allowed');
			$("#b_IsVoilated").val(2);
    }
    else 
       {
      $("#totalextraFInal").css('display', 'block');
            $("#totalextraFInal").css('margin-left', '330px');
            $("#totalextraFInal").attr('title',  'Your Amount is exceed from policy Report Max Amount');
      $("#b_IsVoilated").val(1);

    }
			
		}else{
			$("#totalextraFInal").css('display', 'none');
			$("#b_IsVoilated").val(0);
		}
		checkReimb();
	}
	/*function calculateTotalAmount(){
		var preexpense  =  $("#cash_advance").val();
		if(preexpense ==""){
			preexpense = 0;
		} 
		var forcount    = 1+parseInt($("#countHidden").val());	
		var total       = 0;
		for (var i = 1; i < forcount; i++) {
			if($("#amount_"+i).val() == ""){
				var amount = 0;
			}else{
                var categoryval = parseInt($("#category_"+i+" option:selected").val());
                //console.log(categoryval);
                var amount = parseInt($("#amount_"+i).val());
         		//console.log(amount);
                if(categoryval < amount){
               	 $("#bug_"+i).addClass("bug");
               	 $("#violationstatus_"+i).val(1);
                }
                else{
                 $("#bug_"+i).removeClass("bug");   
                 $("#violationstatus_"+i).val(0);
                }
			}
			total = total+amount;	
		}
		total  = parseInt(preexpense)+parseInt(total); 
		$("#TotalAmountRepoted").html(total);
		if(total>$("#monthlyexp").val()){
			$("#totalextraFInal").css('display', 'block');
		$("#b_IsVoilated").val(1);
		}else{
			$("#totalextraFInal").css('display', 'none');
			$("#b_IsVoilated").val(0);
		}
		checkReimb();
	}*/
	function checkReimb(){
		var forcount = 1+parseInt($("#countHidden").val());	
		var totalval    = 0;
		for (var i = 1; i < forcount; i++) {
			if($("#reimb_"+i).prop('checked') == true){
				if($("#amount_"+i).val() == ""){
					var amount = 0;
				}else{
					var amount = parseInt($("#amount_"+i).val());
					totalval  = totalval + amount; 
				}
			}	

		}

		$("#TotalamountRembasment").html(totalval);
	}
function isNumber(evt) { 
        //Call this function  =  onkeypress="return isNumber(event)"
		 var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
		 	alert('Please Enter only Numeric key')
		  	return false;
		 }else{
			return true;	
		}
}
<?php $Totalcount = count($expenselist); ?>
var mycount = <?php echo $Totalcount+1; ?>;
function addnewexprow(){
	$(".Expenses table tr:last").after('<tr>'
    +'<td><input type="checkbox" id="check_'+mycount+'"></td>'
    +'<td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"></td>'
    +'<td><select  name="category" class="category" id="category_'+mycount+'"><option value="0">Select</option> <?php foreach ($policyAssign as $key => $value) {echo "<option value=".$value->n_SingleExpLmt.">".$value->t_SpndName."</option>";}?></select></td>'
    +'<td><input class="dat date_5 datepicker_all" name="date_'+mycount+'" type="text"></td>'
    +'<td><input type="text" value="" class="amount1" id="amount_'+mycount+'" name="amount_'+mycount+'" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();"></td>'
    +'<td><input type="text" value="" class="merchant" id="merchant_'+mycount+'"></td>'
    +'<td><input type="text" value="" class="purpose" id="purpose_'+mycount+'"></td>'
    +'<td><input type="checkbox" name="" class="reimb" id="reimb_'+mycount+'"></td>'
    +'<td>'
    +'<select name="" class="tag" id="tag_'+mycount+'">'
    +'<option>Yes</option>'
    +'<option>No</option>'
    +'</select>'
    +'</td>'
    +'<td><a href="#" class="comon" id="bug_'+mycount+'"></a>'
    +'<label class="link"></label>'
    +'<input type="file" id="atthFile_'+mycount+'" class="atthFile">'
    +'<a href="#" class="save"></a>'
    +'<input type="hidden" id="t_FileName" >'
    +'<a class="del"></a>'
    +'</td>'+
      '</tr>');

$('.datepicker_all').Zebra_DatePicker({
		format: 'd M, Y'});
$('.datepicker_all').unwrap();
$('.datepicker_all').parent().wrapInner('<span style="position:relative; display:inline-block"></span>');

  $("#countHidden").val(mycount++);
}



function addtrueexpense22(){
   var flag = 0; 
   if(flag==1){
    alert("all row inserted Successfully");
    return false;
   }
   var categoryval=[];
   var datevalval=[];
   var amountval=[];
   var merchantval=[];
   var purpose = []; 
   var reimbval=[];
   var tagval=[];
   var violationstatus = []; 
   var i=k=j=x=l=m=y=s=vs=0;

     $(".category").each(function(){
          categoryval[i] = $(this).val();
          i++;
    });

    $(".dat").each(function(){
        datevalval[k] = $(this).val();
        k++;
    });

    $(".amount1").each(function(){
        amountval[j] = $(this).val();
        j++;
    });

    $(".purpose").each(function(){
        purpose[x] = $(this).val();
        x++;
    });

    $(".merchant").each(function(){
        merchantval[s] = $(this).val();
        s++;
    });

    $(".reimb").each(function(){
        if($(this).prop('checked')==true){
            reimbval[y] = 1;
            alert(reimbval[y]);
          
        }else{
            reimbval[y] = 0;
            alert(reimbval[y]);
        }
        y++; 
    });

    $(".tag").each(function(){
        tagval[m] = $(this).val();
        m++;
    });

    $(".violationstatus").each(function(){
        violationstatus[vs] = $(this).val();
        vs++;
    });

 var Mybase_url  = '<?php echo base_url();?>';
 var categoryval = JSON.stringify(categoryval);
 var datevalval  = JSON.stringify(datevalval);
 var amountval   = JSON.stringify(amountval);
 var merchantval = JSON.stringify(merchantval);
 var purpose     = JSON.stringify(purpose);
 var reimbval    = JSON.stringify(reimbval);
 var tagval      = JSON.stringify(tagval);
 var violationstatus = JSON.stringify(violationstatus);
 
 var amoutcount= amountval.length;

 var Report_Id   = parseInt($("#myreportId").html());
 if(Report_Id !='NaN'){
    var mydata  = {'categoryval':categoryval, 'datevalval':datevalval, 'amountval':amountval,'merchantval':merchantval,'purpose':purpose,'reimbval': reimbval, 'tagval':tagval,'Report_Id':Report_Id,'violationstatus':violationstatus};
 }else{
    Report_Id   = 0; 
    var mydata  = {'categoryval':categoryval, 'datevalval':datevalval, 'amountval':amountval,'merchantval':merchantval,'purpose':purpose,'reimbval': reimbval, 'tagval':tagval,'Report_Id':Report_Id,'violationstatus':violationstatus};
 }
 
 $.ajax({
        url: Mybase_url+'employee/dashboard2/expenceaddupdate/',
        type:'POST',
        dataType:'json',
        data: mydata,
        success: function(data){
            //console.log(data.a_ExpPlcyMapId); 
            //alert(data.a_ExpPlcyMapId);
            var she = data.a_ExpPlcyMapId;
            //console.log(she);
           /* if($("#amount_5").val()!='')
            {
               $("#getrtrnid_5").val(she);

                if($("#amount_4").val()!='')
                {
                  she=she-1;
                  $("#getrtrnid_4").val(she);
                }

                if($("#amount_3").val()!='')
                {
                 she=she-1;
                 $("#getrtrnid_3").val(she);
                }

                if($("#amount_2").val()!='')
                {
                  she=she-1;
                $("#getrtrnid_2").val(she);
                }
                if($("#amount_1").val()!='')
                {
                  she=she-1;
                 $("#getrtrnid_1").val(she);
                }



            }
             
            else  if($("#amount_4").val()!='')
            {
               $("#getrtrnid_4").val(she);

               if($("#amount_3").val()!='')
                {
                 she=she-1;
                 $("#getrtrnid_3").val(she);
                }

                if($("#amount_2").val()!='')
                {
                  she=she-1;
                $("#getrtrnid_2").val(she);
                }
                if($("#amount_1").val()!='')
                {
                  she=she-1;
                 $("#getrtrnid_1").val(she);
                }
            }

             else  if($("#amount_3").val()!='')
            {
               $("#getrtrnid_3").val(she);

               if($("#amount_2").val()!='')
                {
                  she=she-1;
                $("#getrtrnid_2").val(she);
                }
                if($("#amount_1").val()!='')
                {
                  she=she-1;
                 $("#getrtrnid_1").val(she);
                }
            }

             else  if($("#amount_2").val()!='')
            {
               $("#getrtrnid_2").val(she);


               if($("#amount_1").val()!='')
               {
                  she=she-1;
                 $("#getrtrnid_1").val(she);
              }
            }

             else  if($("#amount_1").val()!='')
            {
               $("#getrtrnid_1").val(she);
            }
           */ flag = 1;
            alert("Added Successfully");
        }
      });


}


/*function addtrueexpense12(){
   var flag = 0; 
   if(flag==1){
   	alert("all row inserted Successfully");
   	return false;
   }
   var categoryval=[];
   var datevalval=[];
   var amountval=[];
   var merchantval=[];
   var purpose = []; 
   var reimbval=[];
   var tagval=[];
   var violationstatus = []; 
   var i=k=j=x=l=m=y=s=vs=0;
    $(".category").each(function(){
        categoryval[i] = $(this).val();
        i++;
    });
    $(".dat").each(function(){
        datevalval[k] = $(this).val();
        k++;
    });
    $(".amount1").each(function(){
        amountval[j] = $(this).val();
        j++;
    });
    $(".purpose").each(function(){
        purpose[x] = $(this).val();
        x++;
    });
    $(".merchant").each(function(){
        merchantval[s] = $(this).val();
        s++;
    });

    $(".reimb").each(function(){
    	if($(this).prop('checked')==true){
    		reimbval[y] = 1;
    	}else{
    		reimbval[y] = 0;
    	}
    	y++; 
    });

    $(".tag").each(function(){
        tagval[m] = $(this).val();
        m++;
    });

    $(".violationstatus").each(function(){
        violationstatus[vs] = $(this).val();
        vs++;
    });

 var Mybase_url  = '<?php echo base_url();?>';
 var categoryval = JSON.stringify(categoryval);
 var datevalval  = JSON.stringify(datevalval);
 var amountval   = JSON.stringify(amountval);
 var merchantval = JSON.stringify(merchantval);
 var purpose     = JSON.stringify(purpose);
 var reimbval    = JSON.stringify(reimbval);
 var tagval      = JSON.stringify(tagval);
 var violationstatus = JSON.stringify(violationstatus);
 var Report_Id   = parseInt($("#myreportId").html());

 if(Report_Id !='NaN'){
 	var mydata  = {'categoryval':categoryval, 'datevalval':datevalval, 'amountval':amountval,'merchantval':merchantval,'purpose':purpose,'reimbval': reimbval, 'tagval':tagval,'Report_Id':Report_Id,'violationstatus':violationstatus};
 }else{
 	Report_Id   = 0; 
 	var mydata  = {'categoryval':categoryval, 'datevalval':datevalval, 'amountval':amountval,'merchantval':merchantval,'purpose':purpose,'reimbval': reimbval, 'tagval':tagval,'Report_Id':Report_Id,'violationstatus':violationstatus};
 }
 
 $.ajax({
        url: Mybase_url+'employee/dashboard2/expencepolicymapsubmit/',
        type:'POST',
        dataType:'json',
        data: mydata,
        success: function(data){
        	console.log(data); 
        	flag = 1;
        }
      });
}*/
</script>
<script>
	$(document).ready(function() {
/*		$('.category').change(function(){
			$('.overlay').show();
		});	*/
		$(document.body).on("click",".close_icon",function(){
			$('.overlay').hide();
		});
	});
</script>
<script>
	$("#delrept").click(function(){
		var myid  = parseInt($("#myreportId").html());
		var Mybase_url = '<?php echo base_url();?>';
		if(isNaN(myid)){
			$("#delrept").attr('disabled', 'disabled');	
			return false;
		}else{

			$.ajax({
				url: Mybase_url+'employee/dashboard2/deletereport/',
				type: 'POST',
				dataType: 'JSON',
				data: {'reportId': myid},
				success:function(data){
					console.log(data);
					if(data==true){
						window.location.replace(Mybase_url+"employee/dashboard2/reportfirst2/");
					}
				}
			});
		}
	});
</script>
<script>
 $(document).ready(function(){
 $(".link2").click(function(){
  //$(".link2").click(function(){
    $(".popupsecondh").fadeIn();
	$(".overlayNew").fadeIn();
  });
  $(document.body).on("click",".close_icon",function(){
  $(".popupsecondh").fadeOut();
  $(".overlayNew").fadeOut();
  });
});


 function submitmynote()
{
  var Mybase_url = '<?php echo base_url();?>';
  if($("#myreportId").text() != "")
  {
    var myrptid= $("#myreportId").text();
    var mynote = [];
    var count = 0; 
    $.each($('.ntd .notesnotcheck'), function() {
    if($(this).val() != "" )
    mynote.push($(this).val());
   
    });
  
  var myData  = { 'id':myrptid , 'note': mynote }

  }

  $.ajax({
        url: Mybase_url+'employee/dashboard2/mynotesubmit/',
        type:'POST',
        dataType:'json',
        data: myData,
        success: function(data){
        if(data !="")
        {
          alert("NOTE ADDED SUCCESSFULLY");
        }
        }
      });
}

function deleteexp(deleteid,countval)
{     

	 var agree =   confirm("Sure You Want To Delete");
	 if(agree)
	 {


     var del = deleteid;
	 var countdel=countval;
	 var Mybase_url = '<?php echo base_url();?>';
     $.ajax({
	 	      url: Mybase_url+'employee/dashboard/deleted/',
              type:'POST',
              dataType:'json',
              data:{'delete':del},

        success: function(data){
        if(data !="")
        {
           $("#removetr_"+countdel).remove();
           alert("EXPENSE DELETED SUCCESSFULLY");
        }
        }
     });
 }
 else
 {
 	return false;
 }
    

}
function cityshe12()

 { 
    var citylist= $("#city12").val();
    if(citylist==-1)
    {  
        $("#lblothercity12").css({'display': 'block'});
    }

 else
    {
        $("#lblothercity12").css({'display': 'none'});
    }



 }


function updatesingle(valuecount,updateid)
{ 
    var Mybase_url = '<?php echo base_url();?>'
    var myperid = valuecount;
    var updateexpid = updateid;

//alert(myperid);
//alert(islastid);

if(updateexpid!='')
{

	
   var catval      = $("#category_"+myperid).val();
   var dateval     = $(".date_"+myperid).val();
   var amountval   = $("#amount_"+myperid).val();
   var merchantval = $("#merchant_"+myperid).val();
   var purposeval  = $("#purpose_"+myperid).val();
   var reimbval1    = $("#reimb_"+myperid).prop( "checked" );
   var tagval      = $("#tag_"+myperid).val();
   var voilaval    = $("#violationstatus_"+myperid).val();
 
   if(reimbval1==true){ reimbval=1;}else{reimbval=0; }

   var mydata={'catval1':catval,'dateval1':dateval,'amountval1':amountval,'merchantval1':merchantval,'purposeval1':purposeval,'reimbval1':reimbval,'tagval1':tagval,'voilaval1':voilaval,'rowid':updateexpid};
    console.log(mydata);
    $.ajax({
        url: Mybase_url+'employee/dashboard2/singleexpupdate/',
        type:'POST',
        dataType:'json',
        data: mydata,
        success: function(data){
        alert('update successfully');
         }


    });
}

  
}


function updatedatailssingls()
{ 
    var Mybase_url = '<?php echo base_url();?>'
   
    var updateexpid =  $("#expnseid4").val();

//alert(myperid);
//alert(islastid);

if(updateexpid!='')
{  
   var catval       = $("#categorytr4").val();
   var dateval      = $(".date_4").val();
   var amountval    = $(".amount1114").val();
   var merchantval  = $("#merchant4").val();
   var purposeval   = $("#purposetr4").val();
   var reimbval     = $("#reimbursabletr4").val();
   var tagval1      = $("#customtag14").val();
   var tagval2      = $("#customtag24").val();
   var glcode       = $("#glcodetr4").val();
   var voilaval     = $(".violationstatustr4").val();
   var cityval      = $(".city4").val();
   var mydata={'catval1':catval,'dateval1':dateval,'amountval1':amountval,'merchantval1':merchantval,'purposeval1':purposeval,'reimbval1':reimbval,'ctagval1':tagval1,'ctagval2':tagval2,'glcode1':glcode, 'voilaval1':voilaval,'cityval1':cityval,'rowid':updateexpid};
    //console.log(mydata);
    $.ajax({
        url: Mybase_url+'employee/dashboard/singleupdatedetails/',
        type:'POST',
        dataType:'json',
        data: mydata,
        success: function(data){
        alert('update successfully');
        $(".amount1114").attr('id', 'amount4');
        $('.overlay').hide();

         }


    });
}

  
}

</script>

