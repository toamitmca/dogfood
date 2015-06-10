<style>.pink {border: 1px solid red;border: 10px solid green;}.atthFile{display: none;} .imgList{width:40px; height:40px;}</style>
<script src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<script>
	$(document).ready(function() {
		$(document.body).on("click",".link",function(){
			var getId= $(this).next().attr('id');
			$('.popupsecond').attr('id', getId);
			$("#check").val(getId);
			$('.overlayNew').fadeIn();
			$('.popupsecond').fadeIn();
		});
		$('.close_icon').click(function(){
			$('.overlayNew').fadeOut();
			$('.popupsecond').fadeOut();
		});
	});
</script>



<div class="overlayNew"></div>
<form id="imageform111" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>employee/dashboard/ajaxImageUpload' style="clear:both">
	<div class="popupsecond">
		<a class="close_icon"></a>
		<h2>Select Your File</h2>
		<input type="text" name="hidden" value="" id="check">
		<input type="text" name="nametest" value="">
		<label class="btn" for="photoimg">Select Your File</label>
		<input type="file" name="photos[]" id="photoimg" multiple="true" style="display:none;"/>
		<div style="margin-top:10px;">
			<div id='preview'></div>
		</div>
	</div>
</form>

<div class="overlay">
<div class="popup">
<a class="close_icon"></a>

<div class="buttonWrap">
<a href="" class="loadbtn bluebg">Save</a></div>
<div>
<div class="colRow"><label>Type</label> <select><option>Money Spent</option></select></div>
<div class="colRow"><label>Date</label> <input id="datepicker-example1s1" class="dat" type="text"></div>
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
    <td><a><span class="size_small">25-12-14,</span> by Manish Gupta</a></td>
    <td><a class="del"></a></td>
  </tr>
</tbody></table>
</div>
<div class="buttonWrap">
<br />
<label class="loadbtn bluebg" for="atthFile" >Attach</label> <input type="file" id="atthFile">
</div>
<hr />
<label>Policy Violations</label> <a href="#" class="bug"></a>
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
<div class="col"></div>

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
	<select name="status" id="status">
		<option value="Open">Open</option>
		<option value="Close">Close</option>
	</select>
</div>

 <input type="hidden" name="departmentId" value="2">
<div class="col"><label>Chaim Period Form</label> 
<input id="datepicker-example1" name="chaim_period_form" class="dat" type="text"></div>
<div class="col"><label>Cash Advance <span class="WebRupee">Rs</span></label>
<input type="text" name="cash_advance" id="cash_advance" /></div>
<div class="col"><label>Chaim Period To</label> 
<input id="datepicker-example1s" name="chaim_period_to" class="dat" type="text"></div>

<div class="col">
	<label>Amount Reported </label> 
	<span class="amount" style="float:right;"><span class="WebRupee">Rs</span><span id="TotalAmountRepoted">00.00</span></span>
</div>

<div class="col"><label>Description</label>

<input type="text" name="description" id="description" /></div>

<div class="col">
	<label>Amount Requested</label>
	<span class="blue amount" style="float:right;">
	<span class="WebRupee">Rs</span> <span id="TotalamountRembasment">00.00</span></span>
</div>

</div>
<div class="notes" id="deep">
<table>
  <tr>
    <td><a class="add">Notes</a></td>
    <td><a href="#" class="bug"></a></td>
    <td><label class="link"  ></label>
    <input type="file" id="atthFile_1" name="atthFile" class="atthFile" ></td>
  </tr>
  <tr class="ntd">
    <td><input type="text" name="notes[]" id="notes" class="notesnotcheck"></td>
    <td><span class="size_small"><?php echo $date; ?>, </span> by Manish Gupta</td>
    <td></td>
  </tr>
</table>

</div>
<div class="right_top" style=" margin-top: 14px; padding-bottom: 8px !important; border-bottom: 2px solid #807f82;"><span class="buttonWrap">
<input type="button" id="delrept" class="loadbtn loadbtn2" value="Delete Report" disabled> 
<input type="button" class="loadbtn" name="" value="Save" id="saveReport" >
<input type="button" id="" class="loadbtn loadbtn2" value="Submit" disabled>

</span>

<div class="fix"></div>

<div class="Expenses exp">
<div><a class="headexp">Expenses</a>

 <span class="buttonWrap"><a href="" class="loadbtn">Import Expenses</a>
 <a class="loadbtn addexpense">Add Expenses</a></span><div class="fix"></div>
</div>
<input type="text" name="hidden" value="5" id="countHidden">
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
    <th>Tag1</th>
    <th style="width:140px;">&nbsp;</th>
</tr>
<tr>
    <td><input type="checkbox" id="check_1" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
    	<!--category-->
        <?php //p($mycategory); ?>
    	<select  name="category[]" id="category_1" class="category">
            <option value="0">Select</option>
            <?php 
            	foreach ($mycategory as $key => $value) {
            		echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";
            	}
            ?>
            
        </select>

    </td>
    <td><input id="datepicker-example1s5"  class="dat date" name="date[]" type="text"></td>
    <td><input type="text" value="" id="amount_1" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();"></td>
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
    	<a href="#" class="" id="bug_1"></a> 
    	<label class="link"></label>
    	<input type="file" name="atthFile[]" id="atthFile_1" class="atthFile" >
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  class="category" name="category[]" id="category_2">
            <option value="0">Select</option>
            <?php 
            	foreach ($mycategory as $key => $value) {
            		echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";
            	}
            ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_2" name="date_1" type="text"></td>
    <td><input type="text" value="" id="amount_2" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
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
    	<a href="#" class="" id="bug_2"></a> 
    	<label class="link" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_2" class="atthFile" >
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_3" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  class="category" name="category[]" id="category_3">
           <option value="0">Select</option>
            <?php 
            	foreach ($mycategory as $key => $value) {
            		echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";
            	}
            ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_3" name="date[]" type="text"></td>
    <td><input type="text" value="" id="amount_3" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
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
    	<a href="#" class="" id="bug_3"></a> 
    	<label class="link"  ></label>
    	<input type="file" name="atthFile[]" id="atthFile_3" class="atthFile" >
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_4" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select class="pops" class="category" name="category[]" id="category_4">
            <option value="0">Select</option>
            <?php 
            	foreach ($mycategory as $key => $value) {
            		echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";
            	}
            ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_4" name="date[]" type="text"></td>
    <td><input type="text" value="" class="amount" id="amount_4" name="amount_4" onkeyup="return calculateTotalAmount();" ></td>
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
    	<a href="#" class="" id="bug_4"></a> 
    	<label class="link"  ></label>
    	<input type="file" name="atthFile[]" id="atthFile_4" class="atthFile" >
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
  <tr>
    <td><input type="checkbox" id="check_5" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  name="category[]" class="category" id="category_5">
            <option value="0">Select</option>
            <?php 
            	foreach ($mycategory as $key => $value) {
            		echo "<option value=".$value->n_DailyExpLmt.">".$value->catName."</option>";
            	}
            ?>
        </select>
    </td>
    <td><input id="datepicker-example1s5"  class="dat date_5" name="date[]" type="text"></td>
    <td><input type="text" class="amount" value="" id="amount_5" name="amount[]" onkeyup="return calculateTotalAmount();" ></td>
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
    	<a href="#" class="" id="bug_5"></a> 
    	<label class="link" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_5" class="atthFile" >
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
 
  
</table>
<div class="buttonWrapInner">
<!-- <a href="" class="loadbtn bluebg">Save Expensess</a> -->
<input type="button" name="save" id="save_expenses" class="loadbtn bluebg" value="Save Expensess">
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
</section>


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

$("#saveReport").click(function(){

  var Mybase_url = '<?php echo base_url();?>';
  // form submit starts here
  var report_name         = $("#report_name").val();
  var report_type         = $("#report_type").val();
  var status              = $("#status").val();
  var chaim_period_form   = $("#datepicker-example1").val();
  var cash_advance        = $("#cash_advance").val();
  var chaim_period_to     = $("#datepicker-example1s").val();
  var description         = $("#description").val();
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
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description};
	}else{
		  var myData  = {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha};
	}

  
    // ajax call will come here
      $.ajax({
        url: Mybase_url+'employee/dashboard2/reportsubmit/',
        type:'POST',
        //dataType:'json',
        data: myData,
        success: function(data){
          console.log("Yes it it for testing");
          console.log(data);
          if(data !=""){
            $("#sucessmsg").html('Report Generated Successfully')
            $(".loadbtn ").removeAttr("disabled");
          }
        }
      });
              
    // ajax call ends here
  // form submit ends here
});
</script>
<script type="text/javascript">
	

	function calculateTotalAmount(){
		
		var forcount = 1+parseInt($("#countHidden").val());	
		var total    = 0;
				
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
                }
                else{
                 $("#bug_"+i).removeClass("bug");   
                }
                //alert(amount);
			}
				
			total = total+amount;			
		}

		$("#TotalAmountRepoted").html(total);
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
    +'<a class="del"></a>'
    +'</td>'+
      '</tr>');
  $("#countHidden").val(mycount++);
});

var category=[];
$(".bluebg").click(function(){

  


  var categoryval=[];
  var datevalval=[];
  var amountval=[];
  var merchantval=[];
  var reimbval=[];
  var tagval=[];

  var i=k=j=x=l=m=0;


$(".category").each(function(){
        categoryval[i] = $(this).val();
        i++;
    });
    $(".dat").each(function(){
        datevalval[k] = $(this).val();
        k++;
    });
    $(".amount").each(function(){
        amountval[j] = $(this).val();
        j++;
    });
    $(".merchant").each(function(){
        merchantval[x] = $(this).val();
        x++;
    });
    $(".reimb").each(function(){
        reimbval[l] = $(this).val();
        l++;
    });

    $(".tag").each(function(){
        tagval[m] = $(this).val();
        m++;
    });

var Mybase_url = '<?php echo base_url();?>';
var categoryval = JSON.stringify(categoryval);
 var datevalval = JSON.stringify(datevalval);
 var amountval = JSON.stringify(amountval);
 var merchantval = JSON.stringify(merchantval);
 var reimbval = JSON.stringify(reimbval);
 var tagval = JSON.stringify(tagval);

 $.ajax({
        url: Mybase_url+'employee/dashboard2/expencepolicymapsubmit/',
        type:'POST',
        //dataType:'json',
        data: {'categoryval':categoryval, 'datevalval':datevalval, 'amountval':amountval,'merchantval':merchantval,'reimbval': reimbval, 'tagval':tagval},
        success: function(data){
         console.log("Yes it is");
          console.log(data);
       
        }
      });


  if(category==""){
    $("#category_1").css('border','1px solid red');
    $("#category_1").focus();
    return false;
  }else{
    $("#category_1").css('border','1px solid green');
  }

  if(amount==""){
    $("#amount_1").css('border','1px solid red');
    $("#amount_1").focus();
    return false;
  }else{
    $("#amount_1").css('border','1px solid green');
  }
  });

</script>

