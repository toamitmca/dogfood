<?php 
	//p($policyname); 
	//n_MaxRptAmt
?>
<style>.pink {border: 1px solid red;border: 10px solid green;}.atthFile{display: none;} .imgList{width:40px; height:40px;}</style>
<script src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>


<div class="overlayNew"></div>
	
<form id="imageform111" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>employee/dashboard/ajaxImageUpload' style="clear:both">
	<div class="popupsecond">
		<a class="close_icon getfilename"></a>
		<h2>Select Your File</h2>
		<input type="text" name="hidden" value="" id="check">
		<label class="btn" for="photoimg">Select Your File</label>
		<input type="file" name="photos[]" id="photoimg" multiple="true" style="display:none;"/>
		<div style="margin-top:10px;">
			<div id='preview'></div>
		</div>
	</div>
</form>

<style>
.overlay2{position:fixed; width:100%; height:100%; background:rgba(0,0,0,.8); left:0; top:0; z-index:99; display: none;}
.popup2{width:50%; height:200px; max-height:350px; position:absolute; left:0; right:0; top:0; bottom:0; margin:auto; background:#fff; box-shadow:0 0 4px #000; border-radius: 2px; border: 2px solid #ccc; padding:15px; overflow-y:auto; overflow-x: hidden; }
.close_icon{top: 0px;right: 0px; cursor: pointer;}
.notesreport table tr td { width:auto !important; font-size:14px;}
</style>



<!--POPUP FORM STARTS HERE -->

<div class="overlay2" style="display: none;">
<div class="popup2">
<a class="close_icon"></a>
<div class="notes notesreport">
<table>
  <tbody>
  <tr></tr>
  <tr>
    <td><a>Report Name</a></td>
    <td><a><span class="size_small">23-Dec-14,</span>&nbsp; <span class="size_small">25-Dec-14,</span></a></td>
    <td><a>R 245.00</a></td>
    <td><a>Open</a></td>
  </tr>
  <tr>
    <td><a>Report Name</a></td>
    <td><a><span class="size_small">23-Dec-14,</span>&nbsp; <span class="size_small">25-Dec-14,</span></a></td>
    <td><a>R 245.00</a></td>
    <td><a>Open</a></td>
  </tr>
  <tr>
    <td><a>Report Name</a></td>
    <td><a><span class="size_small">23-Dec-14,</span>&nbsp; <span class="size_small">25-Dec-14,</span></a></td>
    <td><a>R 245.00</a></td>
    <td><a>Rejected</a></td>
  </tr>
  
</tbody></table>
</div>
</div>
</div>

<!--POPUP FORM ENDS HERE -->

<div class="Expenses exp">
<div><a class="headexp">Expenses</a>

	 <span class="buttonWrap">
	 	<a href="" class="loadbtn">Add Expenses</a>
	 	<a class="loadbtn">Details</a>
		<a class="loadbtn addreport">Add To Report</a>
		<a class="loadbtn ">Add New Report</a>
	 </span>
	 <div class="fix"></div>

</div>

<form action="<?php echo base_url();?>employee/dashboard/expenseSave" method="post" enctype="multipart/form-data">

<table border="1">
<input type="text" name="monthlyexp" id="monthlyexp" value="<?php echo $policyname->n_MaxRptAmt ;?>">
 <tr>
    <th><input type="checkbox" id="prentCheck" name="prentCheck" ></th>
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
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2" checked></td>
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
    <td><input id="datepicker-example1s5"  class="dat date_2" name="date_1" type="text"></td>
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
    	<a href="#" class="" id="bug_2"></a> 
    	<label class="link" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_2" class="atthFile" >
    	<input type="hidden" name="hidden" value="" class='violationstatus' id="violationstatus_2">
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>
 
  <tr>
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2" checked></td>
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
    <td><input id="datepicker-example1s5"  class="dat date_2" name="date_1" type="text"></td>
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
    	<a href="#" class="" id="bug_2"></a> 
    	<label class="link" ></label>
    	<input type="file" name="atthFile[]" id="atthFile_2" class="atthFile" >
    	<input type="hidden" name="hidden" value="" class='violationstatus' id="violationstatus_2">
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>

  <tr>
    <td><input type="checkbox" maxlength="checkbox[]" id="check_2" checked></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
        <select  class="category" name="category[]" id="category_2">
            <option value = "" >Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->n_SingleExpLmt; ?>"><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
         </select>
    </td>
    <td>
    	<span class="data_date_2">12-12-12</span>
    </td>
    <td>
    	<input type="text" value="" class="amount1" id="amount_2" name="amount[]" onkeyup="return calculateTotalAmount();" >
    	<span class="data_amount"></span>
    </td>
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
    	<input type="hidden" name="hidden" value="" class='violationstatus' id="violationstatus_2">
    	<a href="#" class="save"></a>
    	<a class="del"></a>
    </td>
    
  </tr>



  
</table>



<!--end of the form -->

<div class="buttonWrapInner">

<input type="submit" name="submit" id="save_expenses" class="loadbtn bluebg" value="Save Expensess">
</form>
<a href="" class="loadbtn">Copy</a>
<div class="fix"></div> </div>
</div>

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
	/*$('.getfilename').click(function(){
		var whichId  = $("#check").val();
		var idext    = whichId.split("_");
		var rowId    = idext['1'];
		var imgArray = [];
		//console.log(whichId);

		$('#preview img').each(function(index, val) {
			 imgArray = $(this).attr('src')); 
		});
		
		//console.log(imgArray.length);
		//imgArray[+$rowId+]  = push();  
	});*/
</script>
<script>
var category=[];
$(".bluebg").click(function(){
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

 Report_Id   = 0; 
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
        	console.log("Deepesh singh");
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
<script>
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
</script>
<script>
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
</script>