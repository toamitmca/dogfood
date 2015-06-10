<style>
.pink {border: 1px solid red;border: 10px solid green;}.atthFile{display: none;} 
.imgList{width:40px; height:40px;}
</style>
<script src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>


<div class="overlayNew"></div>
	
<form id="imageform111" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>employee/dashboard/ajaxImageUpload' style="clear:both">
	<div class="popupsecond">
		<a class="close_icon"></a>
		<h2>Select Your File</h2>
		<input type="text" name="hidden" value="" id="check">
		<label class="btn" for="photoimg">Select Your File</label>
		<input type="file" name="photos[]" id="photoimg" multiple="true" style="display:none;"/>
		<div style="margin-top:10px;">
			<div id='preview'></div>
		</div>
	</div>
</form>


<div class="overlay">
  <div class="popup"> <a class="close_icon"></a>
    <div class="buttonWrap"> <a href="" class="loadbtn bluebg">Save</a></div>
    <div>
      <div class="colRow">
        <label>Type</label>
        <select>
          <option>Money Spent</option>
        </select>
      </div>
      <div class="colRow">
        <label>Date</label>
        <input id="datepicker-example1s1" class="dat" type="text">
      </div>
      <div class="colRow">
        <label>Amount</label>
        <input type="text" value="">
      </div>
      <div class="colRow">
        <label>Category</label>
        <select>
          <option>Travel</option>
        </select>
      </div>
      <div class="colRow">
        <label>Distance</label>
        <input type="text" value="">
      </div>
      <div class="colRow">
        <label>City</label>
        <input type="text" value="">
      </div>
      <div class="colRow">
        <label>Purpose</label>
        <input type="text" value="">
      </div>
      <div class="colRow">
        <label>GPS Calculated Yes</label>
      </div>
      <div class="colRow">
        <label>Reimbursabe</label>
        <select>
          <option>Yes</option>
        </select>
      </div>
      <div class="colRow">
        <label>GL Code</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="colRow">
        <label>Custom Tag1</label>
        <select>
          <option>Yes</option>
        </select>
      </div>
      <div class="colRow">
        <label>Custom Tag2</label>
        <select>
          <option>Yes</option>
        </select>
      </div>
    </div>
    <hr />
    <div class="notes">
      <table>
        <thead>
          <tr>
            <td><a><a class="add addnotes">Notes</a></a></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a>First Note comes here</a></td>
            <td><a><span class="size_small">25-12-14,</span> by Manish Gupta</a></td>
            <td><a class="del"></a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="buttonWrap"> <br />
      <label class="loadbtn bluebg" for="atthFile" >Attach ss</label>
      <input type="file" name="file">
    </div>
    <hr />
    <label>Policy Violations</label>
    <a href="#" class="bug"></a> </div>
</div>
<section class="main_caintainer">
  <?php $date= date("Y-m-d"); ?>
  <div class="rightSide empwrap" style=" width: 99% !important;">
  <div class="right_top" ><span class="buttonWrap"><a href="" class="loadbtn">Back to List</a> <a href="" class="loadbtn bluebg">New Report</a> </span>
    <div class="fix"></div>
  </div>
  <div class="formPreExp">
    <div class="col">
      <label>Report Name</label>
      <input type="text" name="report_name" id="report_name" />
    </div>
    <div class="col">
    	<label>Report Id</label>
      	<input type="text" name="text" value="" id="reportId">
    </div>
    <div class="col">
      <label>Report Type</label>
      <select name="report_type" id="report_type">
        <option value="">--Select Report Type--</option>
        <option value="0">Pre Expenses Request</option>
      </select>
    </div>
    <div class="col">
      <label>Status</label>
      <select name="status" id="status">
        <option value="Open">Open</option>
        <option value="Close">Close</option>
      </select>
    </div>
    <input type="hidden" name="departmentId" value="2">
    <div class="col">
      <label>Chaim Period Form</label>
      <input id="datepicker-example1" name="chaim_period_form" class="dat" type="text">
    </div>
    <div class="col">
      <label>Cash Advance <span class="WebRupee">Rs</span></label>
      <input type="text" name="cash_advance" id="cash_advance" />
    </div>
    <div class="col">
      <label>Chaim Period To</label>
      <input id="datepicker-example1s" name="chaim_period_to" class="dat" type="text">
    </div>
    <div class="col">
      <label>Amount Reported </label>
      <span class="amount" style="float:right;"> <span class="WebRupee">Rs</span> 345.00</span></div>
    <div class="col">
      <label>Description</label>
      <input type="text" name="description" id="description" />
    </div>
    <div class="col">
      <label>Amount Requested</label>
      <span class="blue amount" style="float:right;"> <span class="WebRupee">Rs</span> 345.00</span></div>
  </div>
  <div class="notes" id="deep">
    <table>
      <tr>
        <td><a class="add">Notes</a></td>
        <td><a href="#" class="bug"></a></td>
        <td><label class="link" for="atthFile" ></label>
          <!--<input type="file" id="atthFile" name="atthFile[]" onchange="uploadmedia_image(this);" multiple="multiple" class="atthFile">--></td>
      </tr>
      <tr class="ntd">
        <td><input type="text" name="notes[]" id="notes" class="notesnotcheck"></td>
        <td><span class="size_small"><?php echo $date; ?>, </span> by Manish Gupta</td>
        <td></td>
      </tr>
    </table>
  </div>
  <div class="right_top" style=" margin-top: 14px; padding-bottom: 8px !important; border-bottom: 2px solid #807f82;">
  <span class="buttonWrap"> <a href="" class="loadbtn">Delete Report</a>
  <input type="button" class="loadbtn" name="" value="Save" id="saveReport">
  <input type="button" class="loadbtn bluebg" value="Submit">
  </span>
  <div class="fix"></div>
 //deepesh form  	
<form id="imageformm" method="post" enctype="multipart/form-data" action='' style="clear:both">
  <div class="Expenses exp">
    <div><a class="headexp">Expenses</a>
      <input type="text" name="text" id="mainlimit" value="5" id="" >
      <span class="buttonWrap"><a href="" class="loadbtn">Import Expenses</a> <a class="loadbtn addexpense">Add Expenses</a></span>
      <div class="fix"></div>
    </div>
    <table border="1">
    
      <tr>
        <th><input type="checkbox" id="prentCheck_<php echo $i; ?>" name="prentCheck" ></th>
        <th>Type</th>
        <th>Category</th>
        <th style="width:120px;">Date</th>
        <th>Amount</th>
        <th>Merchant</th>
        <th style="width:300px;">Purpose</th>
        <th>Reimb.</th>
        <th>Tag1</th>
        <th style="width:100px;">&nbsp;</th>
      </tr>
      <tr>
        <td><input type="checkbox" id="check_1" checked></td>
        <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png" /></td>
        <td><select class="pops_1" name="category" id="category">
            <option value="1">Select1</option>
            <option value="2">Select2</option>
            <option value="3">Select3</option>
            <option value="4">Select4</option>
            <option value="5">Money Spent</option>
          </select></td>
        <td><input id="datepicker-example1s5" class="dat_1" name="date_1" type="text"></td>
        <td><input type="text" value="" id="amount_1" name="amount_1"></td>
        <td><input type="text" value="" id="merchant_1"></td>
        <td><input type="text" value="" id="purpose_1"></td>
        <td><input type="checkbox" name="" id="reimb_1" ></td>
        <td><select name="" id="tag_1" class="tag_1">
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select></td>
        <td><a href="#" class="bug"></a>
         	 <label class="link" for="addfile_1"></label>
          	 <input type="file" id="addfile_1" class="atthFile">
          <a class="del"></a></td>
      </tr>
      <tr>
        <td><input type="checkbox" id="check_2" checked></td>
        <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png" /></td>
        <td><select class="pops_2" name="category" id="category">
            <option value="1">Select1</option>
            <option value="2">Select2</option>
            <option value="3">Select3</option>
            <option value="4">Select4</option>
            <option value="5">Money Spent</option>
          </select></td>
        <td><input id="datepicker-example1s5" class="dat_2" name="date_2" type="text"></td>
        <td><input type="text" value="" id="amount_2" name="amount_2"></td>
        <td><input type="text" value="" id="merchant_2"></td>
        <td><input type="text" value="" id="purpose_2"></td>
        <td><input type="checkbox" name="" id="reimb_2" ></td>
        <td><select name="" id="tag_2" class="tag_2">
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select></td>
        <td><a href="#" class="bug"></a>
          <label class="link" for="addfile_2"></label>
          <input type="file" id="addfile_2" class="atthFile" >
          <a class="del"></a></td>
      </tr>
      <tr>
        <td><input type="checkbox" id="check_3" checked></td>
        <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png" /></td>
        <td><select class="pops_3" name="category" id="category">
            <option value="1">Select1</option>
            <option value="2">Select2</option>
            <option value="3">Select3</option>
            <option value="4">Select4</option>
            <option value="5">Money Spent</option>
          </select></td>
        <td><input id="datepicker-example1s5" class="dat_3" name="date_3" type="text"></td>
        <td><input type="text" value="" id="amount_3" name="amount_3"></td>
        <td><input type="text" value="" id="merchant_3"></td>
        <td><input type="text" value="" id="purpose_3"></td>
        <td><input type="checkbox" name="" id="reimb_3" ></td>
        <td><select name="" id="tag_3" class="tag_3">
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select></td>
        <td><a href="#" class="bug"></a>
          <label class="link" for="addfile_3"></label>
          <input type="file" id="addfile_3" class="atthFile" >
          <a class="del"></a></td>
      </tr>
      <tr>
        <td><input type="checkbox" id="check_4" checked></td>
        <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png" /></td>
        <td><select class="pops_4" name="category" id="category">
            <option value="1">Select1</option>
            <option value="2">Select2</option>
            <option value="3">Select3</option>
            <option value="4">Select4</option>
            <option value="5">Money Spent</option>
          </select></td>
        <td><input id="datepicker-example1s5" class="dat_4" name="date_4" type="text"></td>
        <td><input type="text" value="" id="amount_4" name="amount_4"></td>
        <td><input type="text" value="" id="merchant_4"></td>
        <td><input type="text" value="" id="purpose_4"></td>
        <td><input type="checkbox" name="" id="reimb_4" ></td>
        <td><select name="" id="tag_4" class="tag_4">
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select></td>
        <td><a href="#" class="bug"></a>
          <label class="link" for="addfile_4"></label>
          <input type="file" id="addfile_4" class="atthFile" >
          <a class="del"></a></td>
      </tr>
      <tr>
        <td><input type="checkbox" id="check_5" checked></td>
        <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png" /></td>
        <td><select class="pops_5" name="category" id="category">
            <option value="1">Select1</option>
            <option value="2">Select2</option>
            <option value="3">Select3</option>
            <option value="4">Select4</option>
            <option value="5">Money Spent</option>
          </select></td>
        <td><input id="datepicker-example1s5" class="dat_5" name="date_5" type="text"></td>
        <td><input type="text" value="" id="amount_5" name="amount_5"></td>
        <td><input type="text" value="" id="merchant_5"></td>
        <td><input type="text" value="" id="purpose_5"></td>
        <td><input type="checkbox" name="" id="reimb_5" ></td>
        <td><select name="" id="tag_5" class="tag_5">
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select></td>
        <td><a href="#" class="bug"></a>
          <label class="link" for="addfile_2"></label>
          <input type="file" id="atthFile" class="atthFile" >
          <a class="del"></a></td>
      </tr>
      
     
     
    </table>
    <div class="buttonWrapInner"> 
      <!-- <a href="" class="loadbtn bluebg">Save Expensess</a> -->
      <input type="button" name="save" id="save_expenses" class="loadbtn bluebg" value="Save Expensess">
      <a href="" class="loadbtn">Copy</a>
      <div class="fix"></div>
    </div>
  </div>
  </form>
  
  <!--<div class="right_top" style=" margin-top: 14px; padding-bottom: 8px !important; border-bottom: 2px solid #807f82; height: 200px;"><span class="buttonWrap"><a href="" class="loadbtn">Import Expense</a><a href="" class="loadbtn">Export Expense</a> </span>
<div class="fix"></div>
</div>-->
  <div class="fix"></div>
</section>
<script>
/*
$(document).ready(function(e) {

$(".add").click(function(){
    $("table").append("<tr><td>ads</td><td>adsasd</td><td>asdad</td></tr>");
  });
});*/
</script>
</div>
</div>
<div class="fix"></div>
</section>

<script>
	$(document).ready(function(){
		//$(".link").click(function() {
//			$(".atthFile").on('change',function() {
//				
//				if($(this).val() !=''){
//					$(this).prev(".link").addClass('linkGreen');
//					// multiple file upload starts
//						//console.log($(this));
//					// multiple file upload ends 
//				}
//				else{
//					$(this).prev(".link").removeClass('linkGreen');
//				}
//			});
//		});
	});

</script> 
<script>
	$(document).ready(function(e) {
        $(".link").click(function(){
			var getFor=$(this).attr('for');
			$("#check").val(getFor);
			$('.overlayNew').fadeIn();
			$('.popupsecond').fadeIn();
			$('.popupsecond').attr('id',getFor);
			//alert(getFor);
			$splitId = getFor.split("_");
			//$splitId[1]
		});

		$('.close_icon').click(function(){ 
			$('.overlayNew').fadeOut();
			$('.popupsecond').fadeOut();
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
$(document).ready(function(e) {
$(".add").click(function(){
    $("table").append("<tr class='ntd'><td><input type='text' name='notes[]' id='notes' class='notesnotcheck'></td><td><span class='size_small'><?php echo $date; ?>,</span> by Manish Gupta</td><td><a class='del'></a></td></tr>");
  });
  $(document.body).on("click",".del",function(){
    $(this).parents("tr").remove();
});
});
</script> 


