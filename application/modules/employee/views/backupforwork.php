<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<input type="hidden" name="monthlyexp" id="monthlyexp" value="<?php echo $policyname->n_MaxRptAmt;?>">

<script>
var h_CurrentRow;
function fn_SetHiddenValue(input)
{
h_CurrentRow=$(input).parents('tr');
}
function fn_SaveExtraExpense()
{
var Row1=h_CurrentRow;
 if($(Row1).find('td:nth-child select option:selected').text()=='lorem_age')
 {
 $(Row1).find('td:nth-child(3) input[type=hidden]').val(
'{ t_Name:'+$().val()+',type:'+$().val()+'

}'
	);	
 }

}

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
			alert(cl_Hidden.val());
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
		alert($(per).find('input[type=file]').attr('id'));
		alert($("#popupFile input[type=text][id=check]").val());
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

<section class="main_caintainer">
<?php $date= date("Y-m-d"); ?>
<div class="rightSide empwrap" style=" width: 99% !important;">
<div class="right_top" ><span class="buttonWrap"><a href="" class="loadbtn">Back to List</a>
<a href="" class="loadbtn bluebg">New Report</a> </span>
<div class="fix"></div></div>
<div id="sucessmsg"> </div>
<div class="formPreExp">
<div class="col"><label>Report Name</label> 
<input type="text" name="report_name" id="report_name" /></div>
<div class="col">
	<p><span id="myreportIdfirst" style="display:none;">Report Id  &nbsp;</span> <label id="myreportId"></label></p>
</div>

	<div class="col">
		<label>Report Type</label> 
		<select name="report_type" id="report_type">
			<option value="">--Select Report Type--</option>
			<option value="0">Pre Expenses Request</option>
			<option value="1">Expenses Request</option>
		</select>
	</div>

<div class="col">
	<label>Status</label>
	<input type="text" name="status" id="status" value="open" readonly="readonly">
</div>

<input type="hidden" name="departmentId" value="2">
<div class="col"><label>Claim Period Form</label> 
<input type="text" name="chaim_period_form" id="datepicker-example1" class="dat33 datepicker_all" ></div>

<div class="col"><label>Claim Period To</label> 
<input id="datepicker-example1s" name="chaim_period_to" class="dat33" type="text"></div>
<div class="col"><label>Cash Advance <span class="WebRupee">Rs</span></label>
<input type="text" name="cash_advance" id="cash_advance" onkeypress="return isNumber(event)"; onkeyup = "return calculateTotalAmount();" /></div>

<div class="col">
	<p><span>Amount Reported </span> 
	<span class="amountg"><span class="WebRupee">Rs</span><span id="TotalAmountRepoted">00.00</span></span></p>
</div>

<div class="col"><label>Description</label>

<input type="text" name="description" id="description" /></div>

<div class="col">
	<p><span>Amount Requested</span>
	<span class="amountg">
	<span class="WebRupee">Rs</span> <span id="TotalamountRembasment">00.00</span></span></p>
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

  <tr class="ntd">
    <td><input type="text" name="notes[]" id="notes" placeholder="Input Your Message" class="notesnotcheck"></td>
    <td><span class="size_small"><?php echo $date; ?>, </span> by Me</td>
    <td></td>
  </tr>
</table>

</div>
<div class="right_top" style="margin-top: 0px; padding-bottom: 8px !important; padding-top: 8px !important; border-top: 0px solid #999; border-bottom:0;"><span class="buttonWrap">
<span>
<input type="button" id="delrept" class="loadbtn loadbtn2" value="Delete Report" > 
<input type="button" class="loadbtn" name="" value="Save" id="saveReport" onclick="return savereportexp(); " >
<input type="button" id="deletereport" class="loadbtn loadbtn2" value="Submit" onclick="return  submitexpense();">

</span>
<span class="loading" style="display: none;">
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
<tr>
    <td><input type="checkbox" id="check_1"></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
    	<select  name="category[]" id="category_1" class="category">
            <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->n_SingleExpLmt; ?>"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>

    </td>
    <td><input id="datepicker-example1s5"  class="dat date" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_1" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();"></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_1"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_1"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_1" onclick="return checkReimb();" ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_1">
	    	<option>Yes</option>
    		<option>No</option>
    	</select>
    </td>
    <td>
    
        
		<a href="#" class="comon" id="bug_1"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_1" class="atthFile" >
    	<a href="#" class="save"></a>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_1">
    	<a class="del"></a>
    	<div class="imgName_1">
    		
    	</div>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2"></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  class="category" name="category[]" id="category_2">
            <option value = "0" >Select</option>
            <option value = "1" >Meal</option>
            <option value = "2" >Air Travel</option>
            <option value = "3" >Taxi</option>
            <option value = "4" >Car Rental</option>
            <option value = "5" >lodging</option>
            <option value = "6" >Internet</option>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_2 datepicker_all" name="date_1" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_2" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_2"></td>
    <td><input type="text" value="" name="purpose[]" class="purpose" id="purpose_2"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_2" onclick="return checkReimb();" ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_2">
	    	<option value="yes">Yes</option>
    		<option value="No">No</option>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_2"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_2" class="atthFile" >
    	<a href="#" class="save"></a>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="hidden" value="" class='violationstatus' id="violationstatus_2">
		<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_3"></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  class="category" name="category[]" id="category_3">
            <option value = "0">Select</option>
            <option value = "1">Meal</option>
            <option value = "2">Air Travel</option>
            <option value = "3">Taxi</option>
            <option value = "4">Car Rental</option>
            <option value = "5">lodging</option>
            <option value = "6">Internet</option>           
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_3 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_3" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_3"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_3"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_3" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_3">
	    	<option value="Yes">Yes</option>
    		<option value="No">No</option>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_3"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_3" class="atthFile" >
    	<a href="#" class="save"></a>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_3">
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_4"></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select class="pops" class="category" name="category[]" id="category_4">
            <option value = "0" >Select</option>
            <option value = "1" >Meal</option>
            <option value = "2" >Air Travel</option>
            <option value = "3" >Taxi</option>
            <option value = "4" >Car Rental</option>
            <option value = "5" >lodging</option>
            <option value = "6" >Internet</option>  
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_4 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount1" id="amount_4" name="amount_4" onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_4"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="" id="purpose_4"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" id="reimb_4" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_4">
	    	<option value="Yes">Yes</option>
    		<option value="No">No</option>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_4"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_4" class="atthFile" >
    	<a href="#" class="save"></a>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_4">
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_5"></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  name="category[]" class="category" id="category_5">
            <option value = "0" >Select</option>
            <option value = "1" >Meal</option>
            <option value = "2" >Air Travel</option>
            <option value = "3" >Taxi</option>
            <option value = "4" >Car Rental</option>
            <option value = "5" >lodging</option>
            <option value = "6" >Internet</option>  
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_5 datepicker_all" name="date[]" type="text"></td>
    <td><input type="text" class="amount1" value="" id="amount_5" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
    <td><input type="text" name="merchant[]" class="merchant" value="" id="merchant_5"></td>
    <td><input type="text" class="purpose" name="purpose[]" value="" id="purpose_5"></td>
    <td><input type="checkbox" class="reimb" name="reimb[]" id="reimb_5" onclick="return checkReimb();"  ></td>
    <td>
    	<select name="tag[]" class="tag" id="tag_5">
	    	<option value="Yes">Yes</option>
    		<option value="No">No</option>
    	</select>
    </td>
    <td>
    	<a href="#" class="comon" id="bug_5"></a> 
    	<label class="link" onclick="fn_GetImagePath(this);"></label>
    	<input type="file" name="atthFile[]" id="atthFile_5" class="atthFile" >
    	<a href="#" class="save"></a>
    	<input type="hidden" id="t_FileName" >
    	<input type="hidden" name="violationstatus" value="" class='violationstatus' id="violationstatus_5">
    	<a class="del"></a>
    </td>
    
  </tr>
 
  
</table>
<div class="buttonWrapInner">
<!-- <a href="" class="loadbtn bluebg">Save Expensess</a> -->
<input type="button" name="save" id="save_expenses" onclick="return addtrueexpense();" class="loadbtn bluebg" value="Save Expensess">
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
  if($("#myreportId").text() != ""){
  	alert("Already Saved report Id");
  	return false;
  }
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
          console.log(data);
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
          if(addtrueexpense()){
          	var myreportId = parseInt($("#myreportId").text());
          	window.location.replace(Mybase_url+"employee/dashboard2/editclaim/"+myreportId);
          }
        }
      });
              
    // ajax call ends here
  // form submit ends here
}

function submitexpense(){
  if($("#myreportId").text() ==""){
  alert("Yes");
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
          $("#myreportIdfirst").css('display', 'block');
          $('.loading').css('display', 'none');
          $("#saveReport").removeAttr('id');
          if(data !=""){
            $("#sucessmsg").html('Report Generated Successfully');
            alert("Report Subbmited Successfully");
            $(".loadbtn ").removeAttr("disabled");
          }
          addtrueexpense();
        }
      });
              
    // ajax call ends here
  // form submit ends here
	}else{
			alert("Update");
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
			        	console.log(data); 
			          $("#saveReport").attr('disabled','TRUE');
			          $("#myreportId").text(data.lastId);
			          $("#delrept").attr('disabled', 'false');
			          $("#myreportIdfirst").css('display', 'block');
			          $('.loading').css('display', 'none');
			          $("#saveReport").removeAttr('id');
			          if(data !=""){
			            $("#sucessmsg").html('Report Generated Successfully');
			            alert("Report Submitted Successfully");
			            $(".loadbtn ").removeAttr("disabled");
			          }
			          addtrueexpense();
			        }
			      });
	
		// update end will come here
	}
}
</script>

<script type="text/javascript">
	

	function calculateTotalAmount(){
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
                console.log(categoryval);
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
                //alert(amount);
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
		 	alert('Please Enter onlye Numeric key')
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
    +'<td><select  name="category" id="category_'+mycount+'"><option value="0">Select</option> <?php foreach ($mycategory as $key => $value) {echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";}?></select></td>'
    +'<td><input id="datepicker-example1s5" class="dat" name="date_'+mycount+'" type="text"></td>'
    +'<td><input type="text" value="" id="amount_'+mycount+'" name="amount_'+mycount+'" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();"></td>'
    +'<td><input type="text" value="" id="merchant_'+mycount+'"></td>'
    +'<td><input type="text" value="" id="purpose_'+mycount+'"></td>'
    +'<td><input type="checkbox" name="" id="reimb_'+mycount+'"></td>'
    +'<td>'
    +'<select name="" id="tag_'+mycount+'">'
    +'<option>Yes</option>'
    +'<option>No</option>'
    +'</select>'
    +'</td>'
    +'<td><a href="#" class="" id="bug_'+mycount+'"></a> '
    +'<label class="link"></label>'
    +'<input type="file" id="atthFile_'+mycount+'" class="atthFile">'
    +'<a href="#" class="save"></a>'
    +'<input type="hidden" id="t_FileName" >'
    +'<a class="del"></a>'
    +'</td>'+
      '</tr>');
  $("#countHidden").val(mycount++);
});


function addtrueexpense(){
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

    $(".category").each(function(row,tr){
        categoryvalarry[i] = $(tr).find('td:nth-child(3) input[type=hidden]').val();
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

</script>

<script>
	$(document).ready(function() {
		$('.category').change(function(){
			$('.overlay').show();
		});	
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
 
 
</script>

