<!--<script type="text/javascript">
	$(document).ready(function(e) {
        $(".on_button").click(function(){
			//var $(this).attr("name");
			if($(this).hasClass("off_button")){
			//alert("no");
			$(this).attr("name","on");
			}
			else{
				$(this).attr("name","off");
				//alert("yes");
				}			
			$(this).toggleClass("off_button");
		});
	});
</script>-->

<section class="main_caintainer">
  <?php $this->load->view('policy/leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">
      			<a href="<?php echo base_url(); ?>ssa/policy/policylist" class="loadbtn bluebg">Back to</a></span>
        	<div class="fix"></div>
      </div>
      <div class="tabcontent" id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top"><span class="buttonWrap">
            <h4>Assigned</h4>
            </span>
            <input type="hidden" name="First" id="First">
            <h2>Policy Name
              	<input type="text" name="t_PolicyName" value="" id="t_PolicyName">
                <input type="hidden" name="pname" value="" id="policyId">
            </h2>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
        <div class="col">
          <?php //p($business); ?>
            <label>Business</label>
            <select name="n_business" id="businessid11" >
            <option value="-1">Select Business</option>
 <?php foreach ($business as  $value): ?>
 <option value="<?php echo $value->a_BusinessId ?>">  <?php  echo $value->t_BusinessName ?></option>
<?php endforeach ?>
            </select>

          </div>
          <div class="col">
            <label>Max Report Amount R</label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" value="" />
          </div>
          <div class="col">
            <label>Report Due By</label>
            <select name="d_RptDueDt" style="width:24%;display:inline-block;" id="d_RptDueDt" >
              <option value='monthly'  >Monthly</option>
              <option value='yearly'   >Yearly</option>
            </select>
            <select name="d_RptDueDt1" style="width:23%;display:inline-block;float:right;" id="d_RptDueDt1">
              <option value='1'  >1</option>
              <option value='2'  >2</option>
              <option value='3'  >3</option>
              <option value='4'  >4</option>
              <option value='5'  >5</option>
              <option value='7'  >7</option>
              <option value='8'  >8</option>
              <option value='9'  >9</option>
              <option value='10' >10</option>
              <option value='11' >11</option>


            </select>
          </div>
          <div class="col">
            <label>Max Expense Amount R</label>
            <input type="text" name="n_MaxExpAmt" value=""  id="n_MaxExpAmt"/>
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1' >Yes</option> 
              <option value='0'  >No</option>
            </select>
          </div>
          <div class="col">
            <label>Receipt Required</label>
            <select name="b_RecpReq" id="b_RecpReq">
              <option value='1' >Yes</option>
              <option value='0' >No</option>
            </select>
          </div>
          <div class="col">
            <label>Above R</label>
            <input type="text" name="n_AboveAmt" value="" id="n_AboveAmt" >
          </div>
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="">
          </div>
          <div class="col">
            <label>days after expense incurred</label>
          </div>

          <div class="right_top">
          	<span class="buttonWrap">

            	<a class="loadbtn bluebg myloading" id="saveGeneral" onclick="return ssapolicygeneral();">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

          <div class="right_top">
            <h2>Mileage</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><a href="" class="loadbtn bluebg ">Save Mileage</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
          <div class="right_top">
            <h2>Period Spending Limits</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Period Limits</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
          <div class="right_top">
            <h2>Spending Categories Restrictions</h2>
            
            <span class="buttonWrap"> </span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="form2">
        <div class="right_top">
          <div class="right_top"> <span class="buttonWrap"></span>
            <div class="fix"></div>
            <div class="right_top"> <span class="buttonWrap">
              <h4>Assigned</h4>
              </span>
              <h2>Milage Name</h2>
             </div>
          </div>
          <div class="col">
           
          </div>
          <div class="formPreExp">
            <div class="col">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">
              <label>Max Report Mileage R</label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="" />
            </div>
            <div class="col">
              <label>Mileage Rate R</label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="" />
            </div>
             <div class="col">
            <label>Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1'>min</option>
              <option value='2'>hrs</option>
              <option value='3'>weekly</option>
            </select>
            </div>
            <div class="col">
              <label>Max Expense Mileage R</label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1'>Yes</option>
                <option value='0' >No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg mileage" onclick="return ssapolicymilige();">Save Peroid Limits</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Period Spending Limits</h2>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg peiod_spending">Save Period Limits</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap">cxvxcvxcvxcvx</span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
      </div>


      
      <div class="tabcontent" id="form3">
        <div class="right_top"> <span class="buttonWrap">
          <h4>Assigned</h4>
          </span>
          <h2>Policy Name1</h2>
          <div class="fix"></div>
        </div>
        <div class="col">
          <div class="genHead blue">Provide Spending Limits</div>
        </div>
        <div class="formPreExp">
          <div class="col">
          <input type="hidden" name="Third" id="Third">
            <label>Daily Spending Limit R</label>
            <input type="text" name="n_DailyExpLmt" value="" id="n_DailyExpLmt"/>
          </div>
          <div class="col">
            <label>Monthly Spending Limit R</label>
            <input type="text" name="n_MonthlyExpLmt" value=""  id="n_MonthlyExpLmt"/>
          </div>
          <div class="right_top"> <span class="buttonWrap"><a class="loadbtn bluebg peiod_spending" onclick="return ssapolicyspndlmt();">Save Peroid Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span id="errormsg"></span>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
     <table border="1" id="tblCategory1" class="tblCategory1">
            <thead>
              <tr>
                <th>Category add</th><th>GLcode add</th>

                <th><input type="button" onclick="AddNewRow_categorybusiness();" class="loadbtn " value="Add New"></th>
               <!--  <th>&nbsp;</th> -->
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>

                 <div class="fix"></div>
               <div><span class="buttonWrap"><input type="button" id="spend_cat_save" name="save" value="Save" class="loadbtn bluebg"></span></div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="form4">
        <div class="right_top">
          <h2>Policy Name 1</h2>
          <span class="buttonWrap">
          <h2>Assigned</h2>
          </span>
          <div class="fix"></div>
        </div>
        <h2 class="genHead blue">Period Categories Restrictions</h2>
        <div class="Expenses policy">
        <table>
            <tr>
                  <th>&nbsp;</th>
                  <th>Spending Categories</th>
                  <th>Single Expenses Limit (in <span class="WebRupee" >Rs</span>)</th>
                  <th>Daily Limit(in <span class="WebRupee" >Rs</span>)</th>
                  <th>Monthly Limit(in <span class="WebRupee" >Rs</span>)</th>
            </tr>
            <tr id="apeendTextField"></tr>
        </table>
        

           <div class="buttonWrapInner"><a class="loadbtn bluebg cat_restriction" onclick="return add_category();">Save Categories Restrictions</a>
            <div class="fix"></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<div class="fix"></div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/policy.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/business.js"></script>

<script type="text/javascript">
var Mybase_url="<?php echo base_url(); ?>";
$("#businessid11").on('change',function(){
  var businessId=$("#businessid11").val();
  console.log(businessId);
  $.ajax({
        url: Mybase_url+'ssa/policy/spendigcat/',
        type:'POST',
        dataType:'json',
        data: {'businessId' : businessId},
        success: function(data){
          console.log(data);
          $.each(data,function (index,value){
                
                var appendField="<input type='hidden' class='spncat' name='spncat[]' id='spncat"+i+"' value='"+value.a_SpndngCatId+"'/>";
                    appendField+="<td><input type='button' class='on_button' name='on' id="+i+" /></td>";
                    appendField+="<td>"+value.t_SpndName+"</td>";
                    appendField+="<td><input type='text' class='sp_cat_single_exp_limit' name='sp_cat_single_exp_limit[]' id='sp_cat_single_exp_limit"+i+"' /></td>";
                    appendField+="<td><input type='text' class='sp_cat_single_daily_limit' name='sp_cat_single_daily_limit[]' id='sp_cat_single_daily_limit"+i+"' /></td>";
                    appendField+="<td><input type='text' class='sp_cat_single_month_limit' name='sp_cat_single_month_limit[]' id='sp_cat_single_month_limit"+i+"' /></td>";
                    appendField+="</tr>";

                $("#apeendTextField").append(appendField);
              });
        }
      });
});
var i=k=0;
var catName=[];
var catCode=[];
    $("#spend_cat_save").on('click',function(){
    var policyId  = $("#policy_id").val();
    var businessId=$("#").val();
    var lastId = $("#lastId").val();
    if((lastId=='') && (policyId!='')){
        lastId=policyId;
        action="update";
    }else{
        lastId=lastId;
        action="insert";
    }
    $(".catName").each(function(){
        catName[i] = $(this).val();
        i++;
    });
    $(".catCode").each(function(){
        catCode[k] = $(this).val();
        k++;
    });
    var catValue  = JSON.stringify(catName);
    var catCodeValue     = JSON.stringify(catCode);
    $.ajax({
        url: Mybase_url+'business/dashboard/SpendcategoryAdd/',
        type:'POST',
        dataType:'json',
        data: {'lastId':lastId,'businessId' : businessId ,'action' : action ,'catValue':catValue, 'catCode':catCode},
        success: function(data){
          $.each(data,function (index,value){
                
                var appendField="<input type='hidden' class='spncat' name='spncat[]' id='spncat"+i+"' value='"+value.a_SpndngCatId+"'/>";
                    appendField+="<td><input type='button' class='on_button' name='on' id="+i+" /></td>";
                    appendField+="<td>"+value.t_SpndName+"</td>";
                    appendField+="<td><input type='text' class='sp_cat_single_exp_limit' name='sp_cat_single_exp_limit[]' id='sp_cat_single_exp_limit"+i+"' /></td>";
                    appendField+="<td><input type='text' class='sp_cat_single_daily_limit' name='sp_cat_single_daily_limit[]' id='sp_cat_single_daily_limit"+i+"' /></td>";
                    appendField+="<td><input type='text' class='sp_cat_single_month_limit' name='sp_cat_single_month_limit[]' id='sp_cat_single_month_limit"+i+"' /></td>";
                    appendField+="</tr>";

                $("#apeendTextField").append(appendField);
              });
        }
      });
  });
</script>
</body></html>