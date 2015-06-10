<?php 
	//p($policyname); 
	//n_MaxRptAmt
?>
<style>.pink {border: 1px solid red;border: 10px solid green;}.atthFile{display: none;} .imgList{width:40px; height:40px;}</style>
<script src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<script>
	$(document).ready(function(e) {
		$('.addreport').click(function(){
        	$('#checkboxPopReport').fadeIn()
		});
		
		$('.close_icon').click(function(){
			$('#checkboxPopReport').fadeOut();
		});
$('#expensesave tr td:nth-child(1) input[type="checkbox"]').click(function(){

        var getCheckbox = $(this).prop('checked');

        if($(this).is(':checked')){
            alert('yes');
            var getHtml = $(this).parents('tr').clone();
            //alert(getHtml);
            $('#expensesave tr td').each(function(){
            var getId = $(this).find('span').attr('class');
            var getHtml = $(this).find('span').html();
           // alert(getId);
            $('#'+getId).css("border","solid 1px red");
            $('#'+getId).val(getHtml);

        });
        }

        else{
            alert('no');
        }

        });


    });
</script>

<div class="overlay2">
    <div class="popup2">
        <a class="close_icon"></a>
        <div class="col">
            <label>Type</label>
            <Select></Select>
        </div>

        <div class="col">
            <label>Category</label>
            <Select id="data_category_2" >
                <option>select</option>
                <option>one</option>
            </Select>
        </div>

        <div class="col">
            <label>Date</label>
            <input type="text" id="data_date_2"  >
        </div>

        <div class="col">
            <label>Amount</label>
            <input type="text" id="data_amount_2"  >
        </div>

        <div class="col">
            <label>Merchant</label>
            <input type="text" id="data_merchant_2"  >
        </div>

        <div class="col">
            <label>Purpose</label>
            <input type="text" id="data_purpose_2"  >
        </div>

        

    </div>
</div>




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

<div class="overlay2" style="display: none;" id="checkboxPopReport">
<div class="popup2">
<a class="close_icon"></a>
<div class="notes notesreport">
<table>
  <tbody>
  <tr></tr>
<?php foreach($report as $reportvalue) { ?>


  <tr>
  	<td><input type="checkbox"  /></td>
    <td><a><?php echo $reportvalue->t_ReportName; ?></a></td>
    <td><a class="dateColor"><span class="size_small"> <?php echo date('d M,Y' , strtotime($reportvalue->d_ClaimFrom));  ?></span>&nbsp; <span class="size_small"> <?php echo date('d M,Y' , strtotime($reportvalue->d_ClaimTo)); ?>,</span></a></td>
    <td><a class="priceColor"> &#x20B9; <?php echo $reportvalue->n_CashAdvance; ?></a></td>
    <td><a><?php echo $reportvalue->n_status; ?></a></td>
  </tr>
  <?php } ?>
 
</tbody></table>
</div>
</div>
</div>

<!--POPUP FORM ENDS HERE -->


<div class="rightSide rightFullW">
<div class="Expenses exp">
<div><a class="headexp">Expenses</a>

	 <span class="buttonWrap">
	 	<a href="" class="loadbtn">Add Expenses</a>
	 	<a class="loadbtn details">Details</a>
		<a class="loadbtn addreport">Add To Report</a>
		<a class="loadbtn">Add New Report</a>
	 </span>
	 <div class="fix"></div>

</div>


<h2  style="float:left"></h2>
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

<?php $i=1;  foreach($expence as $expvalue) { ?>
<tr>
    <td><input type="checkbox" id="check_1" class="chk_box" value="112" ></td>
    <td><img src="<?php echo base_url();?>assects/images/icons/RupeesIcon.png"/></td>
    <td>
      <select  name="category[]" id="category_<?php echo $i; ?>" class="category">
            <option value="100">Select</option>
            <?php if(!empty($policyAssign)){
                foreach ($policyAssign as $key => $value) {?>
                    <option value = "<?php echo $value->a_SpndngCatId?>" <?php if($value->a_SpndngCatId==$expvalue->n_CategoriesID) {?> selected="selected" <?php } ?> ><?php echo $value->t_SpndName; ?></option>
             <?php   }
                }else{ echo "No Records Founds"; } ?>
        </select>

    </td>
    <td><input id="datepicker-example1s5"  class="dat date_all date_<?php echo $i; ?>" name="date[]" type="text" value="<?php echo  date('d M,Y' , strtotime($expvalue->d_Date)); ?>"></td>
    <td><input type="text" class="amount1" id="amount_<?php echo $i; ?>" name="amount[]" onkeypress="return isNumber(event)"; onkeyup="return calculateTotalAmount();" value="<?php echo $expvalue->t_Amount; ?>"></td>
    <td><input type="text" name="merchant[]" class="merchant" value="<?php echo $expvalue->t_Merchant; ?>" id="merchant_<?php echo $i; ?>"></td>
    <td><input type="text" name="purpose[]" class="purpose" value="<?php echo $expvalue->t_Purpose;?>" id="purpose_<?php echo $i; ?>"></td>
    <td><input type="checkbox" name="reimb[]" class="reimb" <?php if($expvalue->b_IsReimburs==1){ ?> checked="checked" <?php } ?>id="reimb_<?php echo $i; ?>" onclick="return checkReimb();" ></td>
    <td>
      <select name="tag[]" class="tag" id="tag_1">
        <option value="1"<?php if($expvalue->n_CustomTag1==1){ ?> selected="selected"; <?php  } ?> >Yes</option>
        <option value="0">No</option>
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
  <?php $i++; } ?>
  

<!--end of the form -->

<div class="buttonWrapInner">


<div class="fix"></div> </div>
</form>

</div>

</div>

<script>
    $(document).ready(function(e) {
        
        $('.details').parent().click(function(){
            //alert('yes');
        $('#checkboxPopdetails').fadeIn();
        });

        $('.close_icon').click(function() {
          $('#checkboxPopdetails').fadeOut();
        });

});
</script>