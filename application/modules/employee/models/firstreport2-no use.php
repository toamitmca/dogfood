
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<input type="hidden" name="monthlyexp" id="monthlyexp" value="<?php echo $policyname->n_MaxRptAmt;?>">
<input type="hidden" name="cash_allowed" id="cash_allowed" value="<?php echo $policyname->b_CashAdAllowed;?>">

<script>
	/*$(document).ready(function(e) {
		
		$('.chk_box').parent().click(function(){
			//alert('yes');
			if($(this).children().is(":checked")){
				$('#checkboxPop').fadeIn();
				}
				
				else{
					//alert('no')
					}
		});
 });*/
</script>
<script>
$(document).ready(function(){
	
 $(".close_icon").click(function(){
  //alert('yes');
  $(".popupsecondh").fadeOut();
  $(".overlayNew").fadeOut();
  });
	
 $(".link2").click(function(){
  //$(".link2").click(function(){
    $(".popupsecondh").fadeIn();
	$(".overlayNew").fadeIn();
  });
});

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
			var txt='';
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
//p($spnd);
	
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}


//print_r($policyAssign);
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


<div class="overlay" id="checkboxPop" >
<div class="popup">
<a class="close_icon"></a>
<div class="buttonWrap">
	<a  class="loadbtn bluebg" id="" onclick="return addtravelexpence(this.value)">Save</a></div>
<div>
<input type="hidden" name="reportidtr" id="reportidtr" name="reportidtr" value="">
<input type="hidden" name="ricogtr" id="ricogtr" name="ricogtr" value="">

	<div class="colRow"><label>Type</label> <select name="typetr" id="typetr" class="typetr"><option value="2">Mileage </option></select></div>
	<div class="colRow"><label>Date</label> <input id="datepicker-example1s1" class="dat12" type="text" name="datetr"></div>
	<div class="colRow"><label>Amount</label><input type="text"  name="amounttr" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" id="amounttr" class="amount111" ></div>
	<div class="colRow"><label>Category</label> <select name="categorytr" id="categorytr" class="categorytr"><option>Select Category</option>


  <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->a_SpndngCatId; ?>"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>
  </select></div>
	<div class="colRow"><label>Distance</label> <input type="text" value="" name="distancetr" id="distancetr" class="distancetr"></div>
	<div class="colRow"><label>City</label> <select name="city" id="city" class="city" onchange="return cityshe(this.value)"><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?><option value="-1">Other</option></select>

     </div>
<div class="colRow" id="lblothercity" style="display:none"><label >Other City</label><input type="text" name="othercity" id="odrct" class="odrct"></div>
	<div class="colRow"><label>Purpose</label> <input type="text" value="" name="purposetr" id="purposetr" class="purposetrs"></div>
	<div class="colRow"><label>GPS Calculated </label><select name="gpstr" id="gpstr" class="gpstr"><option value="1">Yes</option><option value="0">No</option></select></div>
	<div class="colRow"><label>Reimbursabe</label> <select name="reimbursabletr" id="reimbursabletr" class="reimbursabletr"><option value="1">Yes</option><option value="0">No</option></select></div>
	<div class="colRow"><label>GL Code</label> <select name="glcodetr" id="glcodetr" name="glcodetr"><option>Select GLCode </option>


<?php if(!empty($spnd)){
                foreach ($spnd as $keys => $values) {?>
                    <option value = "<?php echo $values->n_spndngcatid; ?>"><?php echo $values->t_GLCode; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>

    </select></div>
  
  <div class="colRow"><label>Custom Tag1</label> <select name="customtag1" id="customtag1" class="customtag1">


  <option value="">Select  Custom Tag1</option>
  <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>





  </select></div>
	<div class="colRow"><label>Custom Tag2</label> <select name="customtag2" id="customtag2" class="customtag2"><option value="">Select Custom Tag2</option>

<?php if(!empty($customtag2)){
                foreach ($customtag2 as $keys => $valuesc2) {?>
                    <option value = "<?php echo $valuesc2->a_CustTagId; ?>"><?php echo $valuesc2->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>

</select></div>
</div>

<div class="notes">
<table>
  <thead><tr>
    <td><a><a class="add addnotes" id="addtravelnotes">Notes</a></a></td>
     </tr></thead>
  <tbody>
     <tr>
    
  </tr>
</tbody></table>
</div>
<div class="buttonWrap">
<br />
<label class="loadbtn bluebg" for="atthFile" >Attach</label> <input type="file" id="atthFile">
</div>
<hr />
<label>Policy Violations Red</label> <a href="#" id="popamnt" class="popamnt " ></a><input type="hidden" name="violationstatustr" value="" class='violationstatustr' id="violationstatustr">
</div>

</div>

<!-- #############################################LODGING################################################### -->

<div class="overlay" id="checkboxPop1" >
<div class="popup">
<a class="close_icon"></a>
<div class="buttonWrap">
    <a  class="loadbtn bluebg" id="" onclick="return addlodgingexpence(this.value)">Save</a></div>
<div>
<input type="hidden" name="reportidtr1" id="reportidtr1" name="reportidtr1" value="">
<input type="hidden" name="ricogtr1" id="ricogtr1" name="ricogtr1" value="">

    <div class="colRow"><label>Type</label> <select name="typetr1" id="typetr1" class="typetr1"><option value="2">Mileage </option></select></div>
    <div class="colRow"><label>Date</label> <input id="datepicker-example1s2" class="dat124" type="text" name="datetr"></div>
    <div class="colRow"><label>Amount</label><input type="text"  name="amounttr1" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" id="amounttr" class="amount1111" ></div>
    <div class="colRow"><label>Category</label> <select name="categorytr1" id="categorytr1" class="categorytr1"><option>Select Category</option>


  <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->n_spndngcatid; ?>" <?php if($value->a_SpndngCatId==651) {?> selected="selected" <?php } ?>><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>
  </select></div>

    <div class="colRow"><label>hotel</label> <input type="text" value="" name="hoteltr1" id="hoteltr1" class="hoteltr1"></div>
    <div class="colRow"><label>City</label> <select name="city1" id="city1" class="city1" onchange="return cityshe1(this.value)"><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?><option value="-1">Other</option></select>

     </div>
<div class="colRow" id="lblothercity1" style="display:none"><label >Other City</label><input type="text" name="othercity1" id="odrct1" class="odrct1"></div>
    <div class="colRow"><label>Purpose</label> <input type="text" value="" name="purposetr1" id="purposetr1" class="purposetr1"></div>
    <div class="colRow"><label>Booking Confirmation</label> <input type="text" value="" name="bookingtr1" id="bookingtr1" class="bookingtr1"></div>
    <div class="colRow"><label>GPS Calculated </label><select name="gpstr1" id="gpstr1" class="gpstr1"><option value="1">Yes</option><option value="0">No</option></select></div>
    <div class="colRow"><label>Reimbursabe</label> <select name="reimbursabletr1" id="reimbursabletr1" class="reimbursabletr1"><option value="1">Yes</option><option value="0">No</option></select></div>
    <div class="colRow"><label>GL Code</label> <select name="glcodetr" id="glcodetr1" name="glcodetr1"><option>Select GLCode </option>


<?php if(!empty($spnd)){
                foreach ($spnd as $keys => $values) {?>
                    <option value = "<?php echo $values->a_SpndngCatId; ?>"><?php echo $values->t_GLCode; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>

    </select></div>
    <div class="colRow"><label>Check In</label> <input id="datepicker-example1s4" class="dat121" type="text" name="checkintr"></div>
    <div class="colRow"><label>Check Out</label> <input id="datepicker-example1s3" class="dat122" type="text" name="checkouttr"></div>
 
    <div class="colRow"><label>Custom Tag1</label> <select name="customtag11" id="customtag11" class="customtag11"><option value="">TAG 1</option>

<?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    </select></div>
    <div class="colRow"><label>Custom Tag2</label> <select name="customtag21" id="customtag21" class="customtag21"><option value="">TAG 2</option>


    <?php if(!empty($customtag2)){
                foreach ($customtag2 as $keys => $valuesc2) {?>
                    <option value = "<?php echo $valuesc2->a_CustTagId; ?>"><?php echo $valuesc2->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    </select></div>
</div>

<div class="notes">
<table>
  <thead><tr>
    <td><a><a class="add addnotes" id="addlodgingnotes">Notes</a></a></td>
     </tr></thead>
  <tbody>
     <tr>
    
  </tr>
</tbody></table>
</div>
<div class="buttonWrap">
<br />
<label class="loadbtn bluebg" for="atthFile" >Attach</label> <input type="file" id="atthFile">
</div>
<hr />
<label>Policy Violations Red</label> <a href="#" id="popamnt" class="popamnt " ></a><input type="hidden" name="violationstatustr" value="" class='violationstatustr1' id="violationstatustr">
</div>

</div>
<!--#####################################END ##########################################################################-->
<!-- ###################################################### STARTS AIR TEAVE #########################################-->

<div class="overlay" id="checkboxPop2" >
<div class="popup">
<a class="close_icon"></a>
<div class="buttonWrap">
    <a  class="loadbtn bluebg" id="" onclick="return addairtravelingexpence(this.value)">Save</a></div>
<div>
    <input type="hidden" name="reportid" id="reportidtr12" name="reportidtr12" value="">
    <input type="hidden" name="ricogtr12" id="ricogtr12" name="ricogtr12" value="">
    <div class="colRow"><label>Type</label> <select name="typetr12" id="typetr12" class="typetr12"><option value="2">Money Spent </option></select></div>
    <div class="colRow"><label>Date</label> <input class="dat125 datepicker_new" type="text" name="datetr" /> </div>
    <div class="colRow"><label>Amount</label><input type="text"  name="amounttr12" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" id="amounttr" class="amount11112" ></div>
    <div class="colRow"><label>Category</label> <select name="categorytr12" id="categorytr12" class="categorytr12"><option>Select Category</option>


  <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->n_spndngcatid; ?>"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>
  </select></div>

    <div class="colRow"><label>carrier</label> <input type="text" value="" name="carriertr12" id="carriertr12" class="carriertr12"></div>
    <div class="colRow"><label>City</label> <select name="city12" id="city12" class="city12" onchange="return cityshe12(this.value)"><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?><option value="-1">Other</option></select>

     </div>
<div class="colRow" id="lblothercity12" style="display:none"><label >Other City</label><input type="text" name="othercity12" id="odrct12" class="odrct12"></div>
  <div class="colRow"><label>Start Date</label> <input id="datepicker-example1s6" class="dat131" type="text" name="checkintr"></div>
    <div class="colRow"><label>End Date</label> <input class="dat135 datepicker_new" type="text" name="checkouttr"></div>

<div class="colRow"><label>From</label> <select name="from12" id="from12" class="from12" ><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?></select>

     </div>

<div class="colRow"><label>To</label> <select name="to12" id="to12" class="to12" ><option>Select City</option><?php foreach ($list as $cityvalue) {?>
    <option value="<?php echo $cityvalue->a_CityId; ?>"><?php echo $cityvalue->t_CityName; ?></option>
     <?php  } ?></select>

     </div>

    <div class="colRow"><label>Purpose</label> <input type="text" value="" name="purposetr12" id="purposetr12" class="purposetr12"></div>
    <div class="colRow"><label>Booking Confirmation</label> <input type="text" value="" name="bookingtr12" id="bookingtr12" class="bookingtr12"></div>
    <div class="colRow"><label>GPS Calculated </label><select name="gpstr12" id="gpstr12" class="gpstr12"><option value="1">Yes</option><option value="0">No</option></select></div>
    <div class="colRow"><label>Reimbursabe</label> <select name="reimbursabletr12" id="reimbursabletr12" class="reimbursabletr12"><option value="1">Yes</option><option value="0">No</option></select></div>
    <div class="colRow"><label>GL Code</label> <select name="glcodetr12" id="glcodetr12" name="glcodetr12"><option>Select GLCode </option>


<?php if(!empty($spnd)){
                foreach ($spnd as $keys => $values) { ?>
                    <option value = "<?php echo $values->n_spndngcatid; ?>"><?php echo $values->t_GLCode; ?></option>
             <?php   }
                }else{ echo "<option>No Records Founds</option>"; } ?>

    </select></div>
  
    <div class="colRow"><label>Custom Tag1</label> <select name="customtag112" id="customtag112" class="customtag112"><option value="">Tag 1</option>

  <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?></select></div>



    <div class="colRow"><label>Custom Tag2</label> <select name="customtag212" id="customtag212" class="customtag212"><option value="">Tag 2</option>

  <?php if(!empty($customtag2)){
                foreach ($customtag2 as $keys => $valuesc2) {?>
                    <option value = "<?php echo $valuesc2->a_CustTagId; ?>"><?php echo $valuesc2->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?></select></div>
</div>

<div class="notes">
<table>
  <thead><tr>
    <td><a><a class="add addnotes" id="addairtravelnotes">Notes</a></a></td>
     </tr></thead>
  <tbody>
     <tr>
    
  </tr>
</tbody></table>
</div>
<div class="buttonWrap">
<br />
<label class="loadbtn bluebg" for="atthFile" >Attach</label> <input type="file" id="atthFile">
</div>
<hr />
<label>Policy Violations Red</label> <a href="#" id="popamnt" class="popamnt " ></a><input type="hidden" name="violationstatustr" value="" class='violationstatustr12' id="violationstatustr">
</div>

</div>
<!-- END-->
<section class="main_caintainer">
<?php $date= date("Y-m-d"); ?>
<div class="rightSide empwrap" style=" width: 99% !important;">

<div class="right_top" ><span class="buttonWrap"><a href="<?php echo  base_url(); ?>employee/claim" onclick="return getConfirmation(this.value)" class="loadbtn iswantsave">Back to List</a>
<a href="" class="loadbtn bluebg">New Report</a> </span>
<span>
<input type="button" id="delrept" style="display:none;" class="loadbtn loadbtn2" value="Delete Report" >
<input type="button" id="savemynt" style="display:none;" onclick="return submitmynote(this.value);" class="loadbtn loadbtn2" value="Save Note" > 


<input type="button" id="deletereport" class="loadbtn loadbtn2" style="display:none;" value="Submit" onclick="return submitexpense();">
<input type="button" class="loadbtn" name="" value="Save" id="saveReport" onclick="return savereportexp(); " >

</span>
<div class="fix"></div></div>
<div id="sucessmsg"> </div>
<div class="formPreExp">






<?php 

//print_r($curreny);

/*$a1=5;
$b1=5;
$c1=4;
//$d1=7;
//$e1=5;

if($a1==$b1)
{
  echo $a1= $a1-1;

}
else {
   $a1= $a1-0;
}

if($a1==$c1)
{
  echo $a1= $a1-1;
}
else
{
   $a1= $a1-0;
}*/
/*
if($a1==$d1)
{
   $a1= $a1-1;
  
}
else
{
   $a1= $a1-0;
}

if($a1==$e1)
{
  echo $a1= $a1-1;
  
}
else
{
   $a1= $a1-0;
}

*/
//echo  $a1;

?>
<div class="col">
    <p><span id="myreportIdfirst" style="display:none;">Report Id  &nbsp;</span> <label id="myreportId"></label></p>
    
</div>
<div class="col">
    <p><span id="" style="display:none;">  &nbsp;</span><p><label id="mycreatedate"></label></p>
</div>
<div class="col"><label>Report Name</label> 
<input type="text" name="report_name" id="report_name" /></div>

<div class="col">
        <label>Report Type</label> 
        <select name="report_type" id="report_type">
            <option value="">--Select Report Type--</option>
            <option value="1">Expenses Reported</option>
            <option value="0">Pre Expenses Request</option>
            
        </select>
    </div>



	
<div class="col">
	<label>Status</label>
	<input type="text" name="status" id="status" value="Open" readonly="readonly">
</div>

<input type="hidden" name="departmentId" value="2">
<div class="col"><label>Claim Period Form</label> 
<input type="text" name="chaim_period_form" id="datepicker-example1" class="dat33 datepicker_all" ></div>

<div class="col"><label>Claim Period To</label> 
<input id="datepicker-example1s" name="chaim_period_to" class="dat33" type="text"></div>
<div class="col"><label>Cash Advance <?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?></label>
<input type="text" name="cash_advance" id="cash_advance" onkeypress="return isNumber(event)"; onclick="return checkcashallowd(this.value)"  /><!-- REMOVE FROM CASH ADVANCE INPUT onkeyup = "return calculateTotalAmount();" --></div>
<div class="col"><label>Pre Expence Amount <?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?></label> 
<input type="text" name="pre_exp_amnt" id="pre_exp_amnt" /></div>

<div class="col">
	<p><span>Amount Reported </span> 
	<span class="amountg"><?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
  <span class="WebRupee">Rs</span> <?php } ?><span id="TotalAmountRepoted">00.00</span></span></p>
</div>

<div class="col"><label>Description</label>

<input type="text" name="description" id="description" /></div>

<div class="col">
	<p><span>Amount Requested</span>
	<span class="amountg"><?php  if($curreny->CURRENCY == 'USD') { ?> $  <?php }else {?>
	<span class="WebRupee">Rs</span> <?php } ?><span id="TotalamountRembasment">00.00</span></span></p>
</div>
<input type="hidden" name="ywli" id="ywli" class="ywli" value="0">

</div>
<div class="notes" id="deep">
<table>
  <tr>
    <td><a class="add" id="add">Notes</a></td>
    <td>
    	<a href="#" class="bug" id="totalextraFInal" style="display:none; 0px 0px 0px 330px;"></a>
    	<input type="hidden" name="b_IsVoilated" value="0" class="inputb" id="b_IsVoilated">
     </td>
    <td><label class="link2"></label>
    <input type="file" id="atthFile_0" name="atthFile" class="atthFile"></td>
  </tr>

  <tr class="ntd">
    <td><input type="text" name="notes[]" id="notes" placeholder="Input Your Message" class="notesnotcheck"></td>
    <td><span class="size_small"><?php echo $date; ?>, </span> by Me  <span class="del"></span></td>
    <td></td>
  </tr>
</table>

</div>
<div class="right_top" style="margin-top: 0px; padding-bottom: 8px !important; padding-top: 8px !important; border-top: 0px solid #999; border-bottom:0;"><span class="buttonWrap">
<!-- <span>
<input type="button" id="delrept" style="display:none;" class="loadbtn loadbtn2" value="Delete Report" > 
<input type="button" class="loadbtn" name="" value="Save" id="saveReport" onclick="return savereportexp(); " >
<input type="button" id="deletereport" class="loadbtn loadbtn2" value="Submit" onclick="return submitexpense();">

</span> -->
<span class="loading" style="display: none; left: 584px;position: absolute;right: 21% !important;top: -204px;">
	<img src="<?php echo base_url();?>assects/images/image.gif">
</span>
<div class="fix"></div>

<div class="Expenses exp">
<div>

	<a class="headexp">Expenses</a>
 	<span class="buttonWrap">
 		<a href="" class="loadbtn">Import Expenses</a>
 		<a class="loadbtn addexpense">Add Expenses</a>
 	</span>
 	<div class="fix" id="totalextra" style="display:none;"></div>
</div>
<input type="hidden" name="hidden" value="5" id="countHidden">
<table border="1" class="myyclono">
<thead>

 <tr id="wantremove">
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
</thead>
<tr >
<div class='copyclonee'>
<tr>
    <td><input type="checkbox" id="check_1" class="chk_box" value="112" >
    <input type="hidden" id="getrtrnid_1" class="getrtrnid_1" value="" ></td>
     <td> <?php  if($curreny->CURRENCY == 'USD') { ?>  <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/><?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
    <td>
    	<select  name="category[]" id="category_1" class="category">
            <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value ="<?php echo $value->n_spndngcatid.'-'.$value->t_SpndName .'@'.$spn; ?>*1"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>

    </td>
    <td><input id="datepicker-example1s5"  class="dat date date_1" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_1" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();"></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_1"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_1"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_1" onclick="return checkReimb();" ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_1">
	    	  <option >Tag 1</option>
        <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    	</select>
    </td>
    <td>
    
        
		<a href="#" class="comon" id="bug_1"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_1" class="atthFile" >
    	<span class="save" onclick="return updatesingle(1)"></span>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_1">
    	<span class="del" onclick="return deletesingle(1)"></span>
    	<div class="imgName_1">
    		
    	</div>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2">
    <input type="hidden" id="getrtrnid_2" class="getrtrnid_2" value="" ></td>
     <td> <?php  if($curreny->CURRENCY == 'USD') { ?> <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/><?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
    <td>
        <select  class="category" name="category[]" id="category_2">
          <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $value->n_spndngcatid.'-'.$value->t_SpndName.'@'.$spn; ?>*2"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_2 datepicker_all" name="date_1" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_2" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_2"></td>
    <td><input type="text" value="" name="purpose[]" class="purpose" id="purpose_2"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_2" onclick="return checkReimb();" ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_2">
	    	  <option >Tag 1</option>
        <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_2"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_2" class="atthFile" >
   <span class="save" onclick="return updatesingle(2)"></span>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="hidden" value="" class='violationstatus' id="violationstatus_2">
		<span class="del" onclick="return deletesingle(2)"></span>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_3">
    <input type="hidden" id="getrtrnid_3" class="getrtrnid_3" value="" ></td>
    <td> <?php  if($curreny->CURRENCY == 'USD') { ?>  <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/> <?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
    <td>
        <select  class="category" name="category[]" id="category_3">
            <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $value->n_spndngcatid.'-'.$value->t_SpndName.'@'.$spn; ?>*3"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>     
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_3 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_3" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_3"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_3"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_3" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_3">
	       <option >Tag 1</option>
        <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_3"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_3" class="atthFile" >
    	<span class="save" onclick="return updatesingle(3)"></span>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_3">
      <span class="del" onclick="return deletesingle(3)"></span>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_4">
    <input type="hidden" id="getrtrnid_4" class="getrtrnid_4" value="" ></td>
     <td> <?php  if($curreny->CURRENCY == 'USD') { ?>  <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/> <?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
    <td>
        <select class="category" name="category[]" id="category_4">
            <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $value->n_spndngcatid.'-'.$value->t_SpndName.'@'.$spn;?>*4"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_4 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_4" name="amount_4" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_4"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_4"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_4" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_4">
	    	  <option >Tag 1</option>
        <?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_4"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_4" class="atthFile" >
    <span class="save" onclick="return updatesingle(4)"></span>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_4">
    	<span class="del" onclick="return deletesingle(4)"></span>
    </td>
    
  </tr>
  <tr class="helloer">
    <td><input type="checkbox" id="check_5">
    <input type="hidden" id="getrtrnid_5" class="getrtrnid_5" value="" ></td>
     <td> <?php  if($curreny->CURRENCY == 'USD') { ?> <img src="<?php echo base_url();?>assects/images/icons/IconMoneySpent.png"/> <?php } else { ?><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/><?php } ?></td>
    <td>
        <select  name="category[]" class="category" id="category_5">
          <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) { if($value->n_SingleExpLmt!=''){ $spn=$value->n_SingleExpLmt;} else { $spn='Null';}?>
                    <option value = "<?php echo $value->n_spndngcatid.'-'.$value->t_SpndName.'@'.$spn; ?>*5"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_5 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" class="amount1" value="" id="amount_5" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_5"></td>
    <td><input type="text" class="purpose" name="purpose[]" value="" id="purpose_5"></td>
    <td><input type="checkbox" class="reimb" name="reimb[]" id="reimb_5" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_5">
	    	<option >Tag 1</option>
    		<?php if(!empty($customtag1)){
                foreach ($customtag1 as $keys => $valuesc1) {?>
                    <option value = "<?php echo $valuesc1->a_CustTagId; ?>"><?php echo $valuesc1->t_CustText; ?></option>
             <?php } }else{ echo "<option>No Records Founds</option>"; } ?>

    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_5"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_5" class="atthFile" >
    	<span class="save" onclick="return updatesingle(5)"></span>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_5">
      <span class="del" onclick="return deletesingle(5)"></span>
    </td>
    
  </tr>

 </div>
 </tr>
 <div id="addclonee"></div>
  
</table>
<div class="buttonWrapInner">
<!-- <a href="" class="loadbtn bluebg">Save Expensess</a> -->
<input type="button" name="save" id="save_expenses" onclick="return addtrueexpense22();" class="loadbtn bluebg" value="Save Expenses" style="display:block;">

<a class="loadbtn" onclick="return copymore(this.value)">Copy</a>
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
  var s=1;
  $("#add").click(function(){
    $(this).parents('table').append("<tr class='ntd' id='removetr"+s+"'><td><input type='text' name='notes[]' id='notes"+s+"' placeholder='Input Your Message' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>,</span></td><td><a class='del' id='delnote_"+s+"' onclick='return deletenoteonsubmit("+s+")'></a></td></tr>");
    s++;
  });
 	$(".del").on("click",function(){
    	$(this).parents("tr").remove();
	});
});


function deletenoteonsubmit(countval)
{
  var counttr=countval;
  //alert(counttr);
 // alert("removetr"+counttr);
 var agree=confirm("Are you sure you want to delete this file?");
 if(agree)
 {
 $("#removetr"+counttr).remove();
  if($("#myreportId").text() != "")
  {
    submitmynote(8888);
  }
}
else
{
  return false;
}

}
</script>





<script>
$(document).ready(function(e) {
  $("#addtravelnotes").click(function(){
    $(this).parents('table').append("<tr class='ntd'><td><input type='text' name='notest' id='notest' placeholder='Input Your Message' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>, by me</span></td><td><a class='del'></a></td></tr>");
  });
    $(document.body).on("click",".del",function(){
        $(this).parents("tr").remove();
    });
});
</script>



<script>
$(document).ready(function(e) {
  $("#addlodgingnotes").click(function(){
    $(this).parents('table').append("<tr class='ntd'><td><input type='text' name='notesd' id='notesd' placeholder='Input Your Message' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>, by me</span></td><td><a class='del'></a></td></tr>");
  });
    $(document.body).on("click",".del",function(){
        $(this).parents("tr").remove();
    });
});
</script>
<script>
$(document).ready(function(e) {
  $("#addairtravelnotes").click(function(){
    $(this).parents('table').append("<tr class='ntd'><td><input type='text' name='notesat' id='notesat' placeholder='Input Your Message' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>, by me</span></td><td><a class='del'></a></td></tr>");
  });
    $(document.body).on("click",".del",function(){
        $(this).parents("tr").remove();
    });
});
</script>

<script>
$(document).ready(function(e) {
  $("#report_name").blur(function(){
   $('#ywli').val('1');
      });


   $("#report_type").blur(function(){
       $('#ywli').val('1');
      });

   $("#datepicker-example1").blur(function(){
       $('#ywli').val('1');
      });

   $("#datepicker-example1s").blur(function(){
       $('#ywli').val('1');
      });

   $("#cash_advance").blur(function(){
       $('#ywli').val('1');
      });

   $("#pre_exp_amnt").blur(function(){
       $('#ywli').val('1');
      });

    $("#description").blur(function(){
       $('#ywli').val('1');
      });

});



function getConfirmation(){
 var isconf = $("#ywli").val();

if(isconf!=0)  {
   var retVal = confirm("Do you want to abandon unsaved changes");
   if( retVal == true ){
    return true;
   }
   else{
     return false;
   }
 }
}

$(document).ready(function(e) {
$(".nav").click(function(){
 var isconf = $("#ywli").val();

if(isconf!=0)  {
   var retVal = confirm("Do you want to abandon unsaved changes");
   if( retVal == true ){
    return true;
   }
   else{
     return false;
   }
 }

});
});



</script>

<script>
$(document).ready(function(e) {
$(document.body).on("click",".close_icon",function(){
			$('.#atthFil').hide();
		});

$(".add").click(function(){
    $("table").append("");
  });
});

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
   $.each($('#deep .notesnotcheck'), function() {
   		if($(this).val() != "" )
        kancha.push($(this).val());
    });

  
  //console.log($(".notesnotcheck").val());
 
if(chaim_period_form==""){
    $("#datepicker-example1").css('border','1px solid red');
    $("#datepicker-example1").focus();
    return false;
  }else{
    $("#datepicker-example1").css('border','1px solid green');
  }
  if(chaim_period_to==""){
    $("#datepicker-example1s").css('border','1px solid red');
    $("#datepicker-example1s").focus();
    return false;
  }else{
    $("datepicker-example1s").css('border','1px solid green');
  }

  if(description==""){
    $("#description").css('border','1px solid red');
    $("#description").focus();
    return false;
  }else{
    $("description").css('border','1px solid green');
  }
	if(kancha ==''){
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}else{
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha,'n_status':buttonName,'b_IsVoilated':b_IsVoilated,'buttonType':buttonType,'grandtotal':grandtotal};
	}

   $('.loading').css('display', 'block');
   var buttonName = $("#saveReport").val();
//alert("shetetesh ujssm");
    // ajax call will come here
      $.ajax({
        url: Mybase_url+'employee/dashboard2/reportsubmit/',
        type:'POST',
        dataType:'json',
        data: myData,
        success: function(data){
         // alert('hii');
       
          $("#saveReport").attr('disabled','TRUE');
          $("#myreportId").text(data.MID); 
          $("#reportidtr12").val(data.MID)
          $("#reportidtr1").val(data.MID)
          $("#reportidtr").val(data.MID)
          $("#mycreatedate").text(data.MYDATE);
          $("#delrept").css('display', 'inline-block');
           $("#deletereport").css('display', 'inline-block');
           $("#ywli").val('');

          //$("#delrept").css('margin-left', '330px');
          
          $("#myreportIdfirst").css('display', 'inline-block');
          $('.loading').css('display', 'none');
          $("#saveReport").removeAttr('id');
          // console.log(data);
          if(data !=""){
            $("#sucessmsg").html('Report Generated Successfully');
            alert("Report Saved Successfully");
            $(".loadbtn ").removeAttr("disabled");
          }
         /* if(addtrueexpense()){
          	var myreportId = parseInt($("#myreportId").text());
          	window.location.replace(Mybase_url+"employee/dashboard2/editclaim/"+myreportId);
          }
*/        }
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
			   $.each($('#deep .notesnotcheck'), function() {
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
			    var ok = confirm('Are You Sure you want to Save Again');
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
			          $("#myreportId").text(data.MID);
                $("#reportidtr12").val(data.MID)
                $("#mycreatedate").text(data.MYDATE);
                $("#delrept").css('display', 'inline-block');
                $("#deletereport").css('display', 'inline-block');
                $("#myreportIdfirst").css('display', 'inline-block');
                $("#ywli").val('');
                     
			          $('.loading').css('display', 'none');
			          $("#saveReport").removeAttr('id');
			          if(data !=""){
                
			            $("#sucessmsg").html('Report Generated Successfully');
			            alert("Report Updated Successfully");
			            $(".loadbtn ").removeAttr("disabled");
			          }
			          //addtrueexpense();
			        }
			      });
	
		// update end will come here
	}       
    // ajax call ends here
  // form submit ends here
}

function submitmynote(mydelvalue)
{
  var delvalu=mydelvalue;
 // alert(delvalu);
  var Mybase_url = '<?php echo base_url();?>';
  if($("#myreportId").text() != "")
  {
    var myrptid= $("#myreportId").text();
    var mynote = [];
    var count = 0; 
    $.each($('#deep .notesnotcheck'), function() {
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
        if(delvalu==8888)
        {
          alert("NOTE DELETED SUCCESSFULLY");
        }
        else {

        if(data !="")
        {
          alert("NOTE ADDED SUCCESSFULLY");
        }
        
       }
        }
      });

}


function submitexpense(){
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
  var buttonType          = 'submit';
  var grandtotal          = parseInt($("#TotalAmountRepoted").text());


 // var notes               = $(".notes").val();
  var kancha = [];
  var count = 0; 
   $.each($('#deep .notesnotcheck'), function() {
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
         // console.log(data.MYDT);
          $("#saveReport").attr('disabled','TRUE');
          $("#myreportId").append(data.a_ReportId);
          $("#delrept").css('display', 'block');
          $("#savemynt").css('display', 'block');
          //$("#save_expenses_not").css('display', 'block');
          $("#save_expenses").css('display', 'none');
          $("#ywli").val('');
         
          $('.loading').css('display', 'none');
          $("#saveReport").removeAttr('id');
          $("#ywli").val('');
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
			  var buttonType          = 'submit';
			  var grandtotal          = parseInt($("#TotalAmountRepoted").text());

			 // var notes               = $(".notes").val();
			  var kancha = [];
			  var count = 0; 
			   $.each($('#deep .notesnotcheck'), function() {
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
			    var ok = confirm('Are You Sure you want to Submit');
			  if(!ok){
			  	return false; 
			  }
			   $.ajax({
			        url: Mybase_url+'employee/dashboard2/updatereprote/',
			        type:'POST',
			        dataType:'json',
			        data: myData,
			        success: function(data){
			        //	console.log(data); 
			          $("#saveReport").attr('disabled','TRUE');
			          $("#myreportId").text(data.MID);
			          $("#delrept").css('display', 'inline-block');
                $("#savemynt").css('display', 'inline-block');
			          $("#myreportIdfirst").css('display', 'block');
			          $('.loading').css('display', 'none');
                $("#save_expenses").css('display', 'none');
                $("#ywli").val('');
         
			          $("#saveReport").removeAttr('id');
			          if(data !=""){
                  $("#report_name").attr('readonly', 'readonly');
                  $("#report_type").attr('disabled', 'disabled');
                  $("#status").attr('readonly', 'readonly');
                  $("#chaim_period_form").attr('readonly', 'readonly');
                  $("#cash_advance").attr('readonly', 'readonly');
                  $("#chaim_period_to").attr('readonly', 'readonly');
                  $("#description").attr('readonly', 'readonly');
    


			            $("#sucessmsg").html('Report Generated Successfully');
			            alert("Report Submitted Successfully");
			            $(".loadbtn ").removeAttr("disabled");
			          }
			          //addtrueexpense();
			        }
			      });
	
		// update end will come here
	}       
    // ajax call ends here
  // form submit ends here
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
				    
            var categoryval = $("#category_"+i+" option:selected").val();
            //  console.log(categoryval);
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
       console.log(ammount122);

                var amount = parseInt($("#amount_"+i).val());
         		    //console.log(amount);
                if(ammount122!=NaN)
                {
                if(ammount122 < amount){
                 $(".popamnt").addClass("bug");
                 $(".popamnt").attr('title',  'Your Expence is exceeds from policy Report Max Amount');
                  $("#violationstatustr").val(1);
               	 $("#bug_"+i).addClass("bug");
               	 $("#violationstatus_"+i).val(1);
                }
                else{
                 $(".popamnt").removeClass("bug");
                  $("#violationstatustr").val(0);
                 $("#bug_"+i).removeClass("bug");   
                 $("#violationstatus_"+i).val(0);
                }
              }
              else
              {
                $(".popamnt").addClass("bug");
                 $(".popamnt").attr('title',  'This Expanse is not in your policy');
                  $("#violationstatustr").val(1);
                 $("#bug_"+i).addClass("bug");
                 $("#violationstatus_"+i).val(1);

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


    function checkcashallowd()
    {
        var cashshe=$("#cash_allowed").val();
        //alert(cashshe);
        if(cashshe==0)
        {
            $("#totalextraFInal").css('display', 'block');
            $("#totalextraFInal").css('margin-left', '330px');
            $("#totalextraFInal").attr('title',  'Cash Payment is not allowed in this policy');
            $("#b_IsVoilated").val(1);
        }
        else
        {
            $("#totalextraFInal").css('display', 'none');
            $("#b_IsVoilated").val(0);
        }


    }



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
var mycount = 6;
$(document.body).on("click",".addexpense",function(){

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

  $("#countHidden").val(mycount++);
});


function addtrueexpense(){
   var flag = 0; 
   if(flag==1){
   	alert("all row inserted Successfully");
   	return false;
   }
   var categoryval =[];
   var datevalval  =[];
   var amountval   =[];
   var merchantval =[];
   var purpose     =[]; 
   var reimbval    =[];
   var tagval      =[];
   var violationstatus = []; 
   var i=k=j=x=l=m=y=s=vs=0;

    $(".category").each(function(){
         var cat = $(this).val();
         var catnew = cat.substring(0, cat.lastIndexOf("_"));
         categoryval[i] = catnew;
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


}

function addtravelexpence(){
   var flag = 0;  
   if(flag==1){
   	alert("all row inserted Successfully");
   	return false;
   }
   var Mybase_url  = '<?php echo base_url();?>';
   var categorytr          = $("#categorytr").val();
   var typetr              = $("#typetr").val();
   var datetr              = $(".dat12").val();
   var amounttr            = $(".amount111").val();
   var distancetr          = $("#distancetr").val();
   var purposetr           = $("#purposetr").val();
   var citytr              = $("#city").val();
   var gpstr               = $("#gpstr").val();
   var reimbursabeltr      = $("#reimbursabletr").val();
   var glcodetr            = $("#glcodetr").val();
   var customtag1          = $("#customtag1").val();
   var customtag2          = $("#customtag2").val();
   var violationstatustr   = $(".violationstatustr").val();
   var Report_Id           = $("#reportidtr").val();
   var rcid                = $("#ricogtr").val(); 
   var othercity           = $("#odrct").val();
   


   $(".date_"+rcid).val(datetr);
   $("#amount_"+rcid).val(amounttr);
  
   $("#purpose_"+rcid).val(purposetr);
   if(reimbursabeltr==1)
   {
     $("#reimb_"+rcid).attr('checked', 'checked');
   }

   var mynote=[];
   var i=0;
   $("input[name='notest']").each(function () {
  //alert(this.value);
    mynote[i]=this.value;
    i++;


  });

 //console.log(mynote);
   // console.log(typetr);
   // console.log(datetr);
   // console.log(amounttr);
   // console.log(distancetr);
   // console.log(purposetr);
   // console.log(citytr);
   // console.log(reimbursabeltr);
   // console.log(glcodetr);
   // console.log(customtag1);
   // console.log(customtag2);
   // console.log(violationstatustr);



//var Report_Id   = parseInt($("#myreportId").html());
//var Report_Id=2;
 if(Report_Id !='NaN'){
 	var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'distanceval':distancetr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr, 'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'othercityval':othercity};
 }else{
 	Report_Id   = 0; 
 	var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'distanceval':distancetr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr,  'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'othercityval':othercity};
 }
 console.log(mydata);
 $.ajax({
        url: Mybase_url+'employee/dashboard2/expencetravel/',
        type:'POST',
        //dataType:'json',
        data: mydata,
        success: function(data){
        	console.log(data); 
        	flag = 1;
        	alert("Added Successfully");
           $('#checkboxPop`').hide();

        }
      });


}



function addlodgingexpence(){
   var flag = 0;  
   if(flag==1){
    alert("all row inserted Successfully");
    return false;
   }
    $(".amount1111").attr('id', 'amountl1');
   var Mybase_url  = '<?php echo base_url();?>';
   var categorytr          = $("#categorytr1").val();
   var typetr              = $("#typetr1").val();
   var datetr              = $(".dat121").val();
   var amounttr            = $(".amount1111").val();
   var hoteltr             = $("#hoteltr1").val();
   var purposetr           = $("#purposetr1").val();
   var citytr              = $("#city1").val();
   var gpstr               = $("#gpstr1").val();
   var reimbursabeltr      = $("#reimbursabletr1").val();
   var glcodetr            = $("#glcodetr1").val();
   var customtag1          = $("#customtag11").val();
   var customtag2          = $("#customtag21").val();
   var violationstatustr   = $(".violationstatustr1").val();
   var checkintr           = $(".dat121").val();
   var checkouttr          = $(".dat122").val();
   var bookingtr           = $("#bookingtr1").val();
   var Report_Id           = $("#reportidtr1").val();
   var rcid                = $("#ricogtr1").val(); 
  var othercity            = $("#odrct1").val();

  // alert(amounttr);
 
   $(".date_"+rcid).val(datetr);
    $("#amount_"+rcid).val(amounttr);

   
   $("#purpose_"+rcid).val(purposetr);
   if(reimbursabeltr==1)
   {
     $("#reimb_"+rcid).attr('checked', 'checked');
     totalval=parseInt($("#TotalamountRembasment").html());
     var amount = parseInt($("#amount_"+rcid).val());
     totalval  = totalval + amount; 

     $("#TotalamountRembasment").html(totalval);

   }

   var mynote=[];
   var i=0;
   $("input[name='notesd']").each(function () {
  //alert(this.value);
    mynote[i]=this.value;
    i++;


  });

 //console.log(mynote);
   // console.log(typetr);
   // console.log(datetr);
   // console.log(amounttr);
   // console.log(distancetr);
   // console.log(purposetr);
   // console.log(citytr);
   // console.log(reimbursabeltr);
   // console.log(glcodetr);
   // console.log(customtag1);
   // console.log(customtag2);
   // console.log(violationstatustr);



//var Report_Id   = parseInt($("#myreportId").html());

 if(Report_Id !='NaN'){
  var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'hotelval':hoteltr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr, 'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'checkinval':checkintr,'checkoutval':checkouttr,'bookingval':bookingtr,'othercityval':othercity};
 }else{
  Report_Id   = 0; 
  var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'hotelval':hoteltr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr,  'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'checkinval':checkintr,'checkoutval':checkouttr,'bookingval':bookingtr,'othercityval':othercity};
 }
// console.log(mydata);
 $.ajax({
        url: Mybase_url+'employee/dashboard2/expencelodging/',
        type:'POST',
        dataType:'json',
        data: mydata,
        success: function(data){
         // console.log(data);
          //console.log(data.a_ExpPlcyMapId);
         //alert(rcid); 
          $("#check_"+rcid).val(data.a_ExpPlcyMapId);
          flag = 1;
          alert("Added Successfully");
          $('#checkboxPop1').hide();
        }
      });


}

function addairtravelingexpence(){
   var flag = 0;  
   if(flag==1){
    alert("all row inserted Successfully");
    return false;
   }
   var Mybase_url  = '<?php echo base_url();?>';
   var categorytr          = $("#categorytr12").val();
   var typetr              = $("#typetr12").val();
   var datetr              = $(".dat125").val();
   var amounttr            = $(".amount11112").val();
   var carriertr           = $("#carriertr12").val();
   var purposetr           = $("#purposetr12").val();
   var citytr              = $("#city12").val();
   var gpstr               = $("#gpstr12").val();
   var reimbursabeltr      = $("#reimbursabletr12").val();
   var glcodetr            = $("#glcodetr12").val();
   var customtag1          = $("#customtag112").val();
   var customtag2          = $("#customtag212").val();
   var violationstatustr   = $(".violationstatustr12").val();
   var starttr             = $(".dat131").val();
   var returntr            = $(".dat135").val();
   var bookingtr           = $("#bookingtr12").val();
   var fromtr              = $("#from12").val();
   var totr                = $("#to12").val();
   var Report_Id           = parseInt($("#myreportId").html());
   var rcid                = $("#ricogtr12").val(); 
   var othercity           = $("#odrct12").val();
   $(".amount11112").attr('id', 'hello');
   $(".date_"+rcid).val(datetr);
  //alert($(".date_"+rcid));
  // alert($(".amount"+rcid));

   var sheamnt=$("#amount_"+rcid).val(amounttr);

  // alert(sheamnt);
   $("#merchant_"+rcid).val(carriertr);
   $("#purpose_"+rcid).val(purposetr);
   if(reimbursabeltr==1)
   {
     $("#reimb_"+rcid).attr('checked', 'checked');
   }
   

   var mynote=[];
   var i=0;
   $("input[name='notesat']").each(function () {
  //alert(this.value);
    mynote[i]=this.value;
    i++;


  });

 //console.log(mynote);
   // console.log(typetr);
   // console.log(datetr);
   // console.log(amounttr);
   // console.log(distancetr);
   // console.log(purposetr);
   // console.log(citytr);
   // console.log(reimbursabeltr);
   // console.log(glcodetr);
   // console.log(customtag1);
   // console.log(customtag2);
   // console.log(violationstatustr);



//var Report_Id   = parseInt($("#myreportId").html());

 if(Report_Id !='NaN'){
  var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'carrierval':carriertr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr, 'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'startval':starttr,'returnval':returntr,'bookingval':bookingtr, 'fromval' :fromtr, 'toval':totr,'othercityval':othercity};
 }else{
  Report_Id   = 0; 
  var mydata  = {'categoryval':categorytr, 'typeval':typetr, 'datevalval':datetr, 'amountval':amounttr, 'carrierval':carriertr, 'purposeval':purposetr, 'cityval':citytr, 'gpsval':gpstr, 'reimbval': reimbursabeltr,  'glcodeval': glcodetr, 'tagval1':customtag1, 'tagval2':customtag2, 'Report_Id':Report_Id,'violationstatus':violationstatustr,'notesval':mynote,'startval':starttr,'returnval':returntr,'bookingval':bookingtr,'fromval' :fromtr, 'toval':totr,'othercityval':othercity};
 }
 //console.log(mydata);
 $.ajax({
        url: Mybase_url+'employee/dashboard2/expenceAirtaveling/',
        type:'POST',
        //dataType:'json',
        data: mydata,
        success: function(data){
          //console.log(data); 
          flag = 1;
          alert("Added Successfully");
           $('#checkboxPop2').hide();
        }
      });


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
 
 var amoutcount= amountval.length;
 if(amoutcount>16)
 {
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
            if($("#amount_5").val()!='')
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
            flag = 1;
            alert("Added Successfully");
        }
      });
}
else
{
   alert('Please Enter Value Properly');
 
}

}
</script>
<script>
	$(document).ready(function() {
		$('.category').change(function(){
        var haij=    $(this).attr('value');
        //console.log(haij);
        var ispopup1 = haij.substring(haij.lastIndexOf("-") + 1);
        //console.log(ispopup1);

         //var ispopup121 = haij.substring(haij.lastIndexOf("@") + 1);
        //console.log(ispopup121);
       

        var ispopup12 = ispopup1.substring(0, ispopup1.lastIndexOf("@"));
       console.log(ispopup12);

        var ispopup = ispopup1.substring(0, ispopup1.lastIndexOf("*"));
        //console.log(ispopup);

        //var ammount=  ispopup1.substring(ispopup1.lastIndexOf("@")+1);
        //console.log(ammount);

        var ammount1=  ispopup.substring(ispopup.lastIndexOf("@"));
       // console.log(ammount1);
          var ammount122=  parseInt(ispopup.substring(ispopup.lastIndexOf("@")+1));
       // console.log(ammount122);


         //var ammount2=  parseInt(ammount1.substring(ammount1.lastIndexOf("*")));
        //console.log(ammount1);


        var isrocid = haij.substring(haij.lastIndexOf("*") + 1);
       // alert(isrocid);
        if(ispopup12=='Ground Travel')
        {  
         $(".amount111").attr('id', 'amount_'+isrocid);
         $(".violationstatustr").attr('id', 'violationstatus_'+isrocid);
         $('#ricogtr').val(isrocid)
         $('#checkboxPop').show();   
        }
      else if(ispopup12=='Lodging') 
       {
        $(".amount1111").attr('id', 'amount_'+isrocid);
        $('#ricogtr1').val(isrocid)
        $(".violationstatustr1").attr('id', 'violationstatus_'+isrocid);
		    $('#checkboxPop1').show();
         //alert('hello');
       }

       else if(ispopup12=='Air Travel') 
       {
        $(".amount11112").attr('id', 'amount_'+isrocid);
        $(".violationstatustr12").attr('id', 'violationstatus_'+isrocid);
        $('#ricogtr12').val(isrocid)
        $('#checkboxPop2').show();
         //alert('hello');
       }
	
          });   
		
	});
</script>
<script>
	$("#delrept").click(function(){
		var myid  = parseInt($("#myreportId").html());
		var Mybase_url = '<?php echo base_url();?>';
		if(isNaN(myid)){
			$("#delrept").attr('display', 'none');	
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
 
 
</script>

<script>
 $(document).ready(function(){
 $(".link").click(function(){
  //$(".link2").click(function(){
    $(".popupsecond").fadeIn();
	$(".overlayNew").fadeIn();
  });
  $(document.body).on("click",".close_icon",function(){
  
  $(".popupsecond").fadeOut();
  $(".overlayNew").fadeOut();
  });
});
 

 function cityshe()

 { 
    var citylist= $("#city").val();
    if(citylist==-1)
    {  
        $("#lblothercity").css({'display': 'block'});
    }
    else
    {
       $("#lblothercity").css({'display': 'none'});
    }



 }
  function cityshe1()

 { 
    var citylist= $("#city1").val();
    if(citylist==-1)
    {  
        $("#lblothercity1").css({'display': 'block'});
    }
     else
    {
       $("#lblothercity1").css({'display': 'none'});
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

$(document).ready(function($) {

  $("#check_1").click(function() {
  $("#amounttr").attr('id', 'amount_1');

  }); 
    
});


function copymore()
{ //alert('hii');
  var addm=$( ".helloer" ).clone();
  var har=addm.attr('class', 'helloer1');
  var harn = addm.attr('datepicker-example1s5','datepicker-example1s11')
  //console.log(harn);
  //console.log(har);
   //".myyclono tbody tr:last-child").empty();
  //$("#wantremove").empty();
  $(".myyclono tbody tr:last-child").after(har);
}



function updatesingle(valuecount)
{ 
var Mybase_url = '<?php echo base_url();?>'
var myperid=valuecount;
var islastid=$("#getrtrnid_"+myperid).val();
//alert(myperid);
//alert(islastid);

if(islastid!='')
{
   var catval      = $("#category_"+myperid).val();
   var dateval     = $(".date_"+myperid).val();
   var amountval   = $("#amount_"+myperid).val();
   var merchantval = $("#merchant_"+myperid).val();
   var purposeval  = $("#purpose_"+myperid).val();
   var reimbval    = $("#reimb_"+myperid).val();
   var tagval      = $("#tag_"+myperid).val();
   var voilaval    = $("#violationstatus_"+myperid).val();
    var mydata={'catval1':catval,'dateval1':dateval,'amountval1':amountval,'merchantval1':merchantval,'purposeval1':purposeval,'reimbval1':reimbval,'tagval1':tagval,'voilaval1':voilaval,'rowid':islastid};

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

function deletesingle(valuecount1)
{
  var Mybase_url = '<?php echo base_url();?>'
var myperid=valuecount1;
var islastid=$("#getrtrnid_"+myperid).val();
      $.ajax({
        url: Mybase_url+'employee/dashboard2/deleteexpsingle/',
        type:'POST',
        dataType:'json',
        data: {'row_id':islastid},
        success: function(data){
        alert('Delete successfully');
        $("#category_"+myperid).val('');
        $(".date_"+myperid).val('');
        $("#amount_"+myperid).val('');
        $("#merchant_"+myperid).val('');
        $("#purpose_"+myperid).val('');
        $("#reimb_"+myperid).val('');
        $("#tag_"+myperid).val('');
        $("#violationstatus_"+myperid).val('');
         }


    });

}

</script>
