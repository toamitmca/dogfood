<?php 
/*Rhaul Yadav created on  15/12/2014  */

$data= checklogin();
    $businessid= $data['n_BusinessId']
 ?>

<script type="text/javascript">
    $(document).ready(function() {
      var getVal =$('#d_RptDueDt').find("option:selected").val();
      if(getVal=='0'){
          $(".none").hide();

                }
            $("#d_RptDueDt").change(function(){
                var getVal =$(this).find("option:selected").val();
        if(getVal=="specific_dt"){
          $(".none").hide();
                    $("#specific_dt").show();
                }


  if(getVal=='weekely'){
          $(".none").hide();
                    $("#weekely").show();
                }

         if(getVal=='0'){
          $(".none").hide();

                }

            });

    });
</script>
<script type="text/javascript">
$(document).ready(function(){
  var busid ="<?php echo $businessid;?>";
console.log(busid);
  var baseurl="<?php echo base_url();?>";
  $.ajax({
    url:baseurl+'/ssa/policy/currency_formate',
    type:'POST',
    dataType:'json',
    data:{'act_mode':'ssadmin','businessid':busid},
 success:function(data){
                          console.log(data);
                          if(data.n_CurrencyId==12){

                          $(".currency").html("&#x20B9;");
                          }
                          if(data.n_CurrencyId==13){
                          $(".currency").html("&#x24;");
                          }

  }
  });
});
</script>
<!-- End 15/12/2014 -->
<section class="main_caintainer">
  <?php $this->load->view('leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">
      			<a href="" class="loadbtn bluebg">Back to</a></span><span class="buttonWrap"><!-- <a href="" class="loadbtn bluebg">New Policy</a> --></span>
        	<div class="fix"></div>
      </div>
      <div id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top"><span class="buttonWrap">
            <!-- <h4>Assigned</h4> -->
            </span>
            <input type="hidden" name="First" id="First">
            <input type="hidden" name="singlepolicy" id="bussinglepolicyid" value="">
            <input type="hidden" name="lastId" id="lastId" value="">
            <input type="hidden" name="businessid" id="businessis_bus" value="<?php echo $businessid; ?>">

            <h2 onclick="return businesscheck_policy();">Policy Name

              	<input type="text" name="t_PolicyName" value="<?php echo set_value('policyName');?>" id="t_PolicyName"    onkeyup="return businesscheck_policy();" >
            </h2>
            <span id="countpolicy" class="message" ></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
          <div class="col">
            <label>Max Report Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" />
          </div>
          <div class="col">

            <label>Report Due By</label>
            <select name="d_RptDueDt" style="display:inline-block;" id="d_RptDueDt" >
             <option value="0" selected="selected">Select report due by</option>
              <option value="lastday">Last day of month</option>
               <option value="firstday">First day of month</option>
              <option value="specific_dt">Monthly</option>
              <option value="weekely">Weekly</option>
            </select>

<!-- created on 15/12/2024 by Rahul Yadav -->


<span class="none" id="specific_dt" style="display: inline-block;width: 25%;">

<select name="d_RptDueDt" id="specific_dt_data" style="width:100%;">
<option value="">Select</option>
        <option value='1'  >1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
              <option value='7'>7</option>
              <option value='8'>8</option>
              <option value='9'>9</option>
              <option value='10'>10</option>
              <option value='11'>11</option>
              <option value='12'>12</option>
              <option value='13'>13</option>
              <option value='14'>14</option>
              <option value='15'>15</option>
              <option value='16'>16</option>
              <option value='17'>17</option>
              <option value='18'>18</option>
              <option value='19'>19</option>
              <option value='20'>20</option>
              <option value='21'>21</option>
              <option value='22'>22</option>
              <option value='23'>23</option>
              <option value='24'>24</option>
              <option value='25'>25</option>
              <option value='26'>26</option>
              <option value='27'>27</option>
              <option value='28'>28</option>
              <option value='29'>29</option>
              <option value='30'>30</option>
              <option value='31'>31</option>



</select>
 </span>
<span class="none" id="firstday">
<?php $dt= date("Y-m-d"); 
//echo $dt;
$firstdat= explode("-",$dt);
$year=$firstdat[0];
$month=$firstdat[1];
$date=1;
$fdat="$date-$month-$year";

 // echo  date("d-M-Y", strtotime($data['Last_login']));
?>
<input type="text" class="datepicker_all" name="firstday" id="d_RptDueDt" value="<?php echo  date("d M,Y", strtotime($fdat)); ?>">
</span>

<span class="none" id="lastday">

<?php $dt= date("Y-m-d");
$firstdat= explode("-",$dt);
$year=$firstdat[0];
$month=$firstdat[1];
$date=1;

function ladtdate($month, $year){
  if($month=1 || $month=3 || $month=5 || $month=7 || $month=8 || $month=10 || $month=12){
    return 31;
           }
  if($month=4 || $month=6|| $month=9|| $month=11){
     return 30;
          }
  if($month=2){
      $yer= $year%4;
        if($yer==0){
     return 29;
         }
       else{
       return 28;
            }
         }
}
$datel =ladtdate($month,$year);
$fdat="$datel-$month-$year";
//echo  $fdat;
?>
<!-- <input type="text" class="datepicker_all" name="lastday" id="d_RptDueDt" value="<?php // echo  date("d M,Y", strtotime($fdat)); ?>"> -->
</span>

<span class="none" id="weekely" style="display: inline-block;width: 25%;" >
<select name="d_RptDueDt" id="weekely_data" style="width:100%;">
<option value="">Select</option>
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
</select>
</span>

         </div>
          <div class="col">
            <label>Max Expense Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxExpAmt" value=""  id="n_MaxExpAmt"/>
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select style="" name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1'>Yes</option>
              <option value='0'>No</option>
            </select>
          </div>
          <div class="col">
            <label>Receipt Required</label>
            <select style="" name="b_RecpReq" id="b_RecpReq">
              <option value='1'>Yes</option>
              <option value='0'>No</option>
            </select>
          </div>
          <div class="col">
            <label>Above <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_AboveAmt" value="" id="n_AboveAmt">
          </div>
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="">
          </div>
          <div class="col">
            <label class="lbl">days after expense incurred</label>
          </div>

          <div class="right_top">
          	<span class="buttonWrap">
            <!-- 	<a class="loadbtn bluebg myloading" id="saveGeneraladd">Save General</a> -->
            <a class="loadbtn bluebg myloading" onclick="return addpolicy_blu(); ">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

         
        </div>
      </div>
      <div id="form2">
        <div class="right_top">
          <div class="right_top"> <span class="buttonWrap"></span>
            <div class="fix"></div>
                   
              
              <h2>Milage Name</h2>
              <div class="fix"></div>
           
          </div>
          <div class="col">
            <!--<label style="text-align:left;">Mileage</label>-->
          </div>
          <div class="formPreExp">
            <div class="col">
              <input type="hidden" name="Second" id="Second">
              
              <label>Max Report Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="<?php echo set_value('n_MaxRptMilage');?>" />
            </div>
            <div class="col">
              <label>Mileage Rate <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="<?php echo set_value('n_MilageRate');?>" />
            </div>
            <span>
            <label class="milage-per">Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1'>KM</option>
              <option value='2'>MI</option>
              </select>
            </span>
            <div class="col">
              <label>Max Expense Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="<?php echo set_value('n_MaxExpMil');?>" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select style="width:30%;" name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1'>Yes</option>
                <option value='0'>No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg " onclick="return addpolicy_blu();">Save Milage</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
      
      </div>
      <div id="form3">
        <div class="right_top"> <span class="buttonWrap">
        
          </span>
          <h2>Period Spending Limits</h2>
          <div class="fix"></div>
        </div>
        <div class="col">
          <!--<label style="text-align:left;">Provide Spending Limits</label> -->
        </div>
        <div class="formPreExp">
          <div class="col">
          <input type="hidden" name="Third" id="Third">
            <label>Daily Spending Limit <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_DailyExpLmt" value="" id="n_DailyExpLmt"/>
          </div>
          <div class="col">
            <label>Monthly Spending Limit <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MonthlyExpLmt" value=""  id="n_MonthlyExpLmt"/>
          </div>
          <div class="right_top"><span class="buttonWrap"><a class="loadbtn bluebg " onclick="return addpolicy_blu();">Save Peroid Limits</a></span>
             <div class="fix"></div>
          </div>
        </div>
        
      </div>
      <div id="form4">
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap">
           
          </span>
          <div class="fix"></div>
        </div>
        
        <div class="Expenses policy">
          <table border="1">
            <tr>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in<span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Daily Limit(in <span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Monthly Limit(in <span class="WebRupee" ><span class="currency"></span></span>)</th>
			</tr>

    <?php  $i=0;
          foreach ($cat as $key => $value) { ?>
          <tr>
              <input type="hidden" class="spncat" name="spncat[]" id="spncat<?php echo $i; ?>" value="<?php echo $value->a_spndngcatId; ?>" />
              <td>
              	<input type="button" class="on_button" name="on" id="<?php echo $i; ?>" />
              </td>
              <td><?php   echo  $value->t_SpndName; ?></td>
              <td><input type="text" class="sp_cat_single_exp_limit"name="sp_cat_single_exp_limit[]" id="sp_cat_single_exp_limit<?php echo $i; ?>" /></td>
              <td><input type="text" class="sp_cat_single_daily_limit" name="sp_cat_single_daily_limit[]" id="sp_cat_single_daily_limit<?php echo $i; ?>" /></td>
              <td><input type="text" class="sp_cat_single_month_limit" name="sp_cat_single_month_limit[]" id="sp_cat_single_month_limit<?php echo $i; ?>" /></td>
          </tr>
   <?php $i++; } ?>
          </table>
          <div class="buttonWrapInner"><a class="loadbtn bluebg cat_restrictionadd">Save Categories Restrictions</a>
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
<script type="text/javascript">


function businesscheck_policy(){
          var busid=$('#businessis_bus').val();
          var policyname = $('#t_PolicyName').val();
          //alert(policyname);
       var Mybase_url = base_url11();
       console.log(busid);
       console.log(policyname);
       $.ajax({
       url: Mybase_url+'business/dashboard/policycheck/',
        type:'POST',
        dataType:'json',
        data: {'businessid':busid , 'policyname':policyname},
        success: function(data){
           console.log(data);
          console.log(data.nom);
                if(data.nom ==="0"){
                $('#countpolicy').html('');
                $('#bussinglepolicyid').val('1');
                }
                else{
                $('#countpolicy').html('Policy exists for the business');
               $('#bussinglepolicyid').val('0');
               $('#one_p').val('');
                }
        }
      });
}

/*function  savegeneral_businessadmin(){
 //alert("hi");
  var Mybase_url = base_url();
  // form submit starts here
  var specific_dt_data        = $("#specific_dt_data").val();
  var weekely_data    = $("#weekely_data").val();
  var policyId        = $("#policy_id").val();
  var t_PolicyName    = $("#t_PolicyName").val();
  var n_MaxRptAmt     = $("#n_MaxRptAmt").val();
  var d_RptDueDt      = $("#d_RptDueDt").val();
  var d_RptDueDt1     = $("#d_RptDueDt1").val();
  var n_MaxExpAmt     = $("#n_MaxExpAmt").val();
  var b_CashAdAllowed = $("#b_CashAdAllowed").val();
  var b_RecpReq       = $("#b_RecpReq").val();
  var n_AboveAmt      = $("#n_AboveAmt").val();
  var singlepolicy    = $("#bussinglepolicyid").val();
    var expense_submitted      = $("#expense_submitted").val();

  var action="";
  if(policyId!=null){
    action="update";
    policyId=policyId;
  }else{
    action="insert";
    policyId="";
  }


  if(t_PolicyName==""){
    $("#t_PolicyName").css('border','1px solid red');
    $("#t_PolicyName").focus();
    return false;
  }else{
    $("#t_PolicyName").css('border','1px solid green');
    // ajax call will come here
    if(singlepolicy==1){

                    $.ajax({
                    url: Mybase_url+'business/dashboard/policyajaxgenral/',
                    type:'POST',
                    dataType:'json',
                    data: {'t_PolicyName':t_PolicyName, 'policyId' : policyId ,'action' :action ,'n_MaxRptAmt':n_MaxRptAmt, 'd_RptDueDt':d_RptDueDt,'d_RptDueDt1':d_RptDueDt1, 'specific_dt':specific_dt_data,'weekely':weekely_data , 'n_MaxExpAmt': n_MaxExpAmt, 'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq, 'n_AboveAmt':n_AboveAmt,'expense_submitted':expense_submitted},
                    success: function(data){
                    console.log(data);
                    if(data !=""){
                    $("#lastId").val(data.p_a_PolicyId);
                    console.log(data.p_a_PolicyId);
                    }
                    }
                    });
              }
              else{
                alert('policy not save');
              }
    }
  // form submit ends here


}
*/
function addpolicy_blu(){
//alert('hello1');
var singlepolicy    = $("#bussinglepolicyid").val();
if(singlepolicy==1){
  var lastId=$('#lastId').val();
   var t_PolicyName= $("#t_PolicyName").val();
 // var policyId        = $("#policy_id").val();
   var n_MaxRptAmt= $("#n_MaxRptAmt").val();
  var d_RptDueDt= $("#d_RptDueDt").val();
  var specific_dt_data= $("#specific_dt_data").val();
  var weekely_data= $("#weekely_data").val();
 
  var n_MaxExpAmt= $("#n_MaxExpAmt").val();
  var b_CashAdAllowed = $("#b_CashAdAllowed").val();
  var b_RecpReq = $("#b_RecpReq").val();
  var n_AboveAmt      = $("#n_AboveAmt").val();
  var expense_submitted      = $("#expense_submitted").val();

   var n_MaxRptMilage  = $("#n_MaxRptMilage").val();
  var n_MilageRate    = $("#n_MilageRate").val();
  var n_PerMeasuremnt = $("#n_PerMeasuremnt").val();
  var n_MaxExpMil     = $("#n_MaxExpMil").val();
  var b_IsGPSReq      = $("#b_IsGPSReq").val();

 var n_DailyExpLmt   = $("#n_DailyExpLmt").val();
  var n_MonthlyExpLmt = $("#n_MonthlyExpLmt").val();
 /*   alert('hello2');
 if(t_PolicyName ==""){

 alert('Please enter policy name.');
  return false;
 }
else{

  return true;
  alert('hi');
}

if(n_MaxRptAmt =="")){
alert('Please enter Max Expense Amount. ');
return false;
}



if(b_RecpReq ==1){
  if(n_AboveAmt ="")){
  alert('Please enter  Receipt Required Amount Above .');
  return false;
  }

}

if(expense_submitted =="")){
alert('Flag Expense submitted. ');
return false;
}*/


  if(lastId==""){
    var act_mode ='insert';
    var n_PolicyId="";
  }
  else{
   var act_mode='update';
   var  n_PolicyId=lastId;
  }
var Mybase_url ="<?php echo base_url(); ?>";
                $.ajax({
                url: Mybase_url+'business/dashboard/new_policy_add_onblur/',
                 type:'POST',
                 dataType:'json',
                data: {'act_mode':act_mode ,'n_PolicyId':n_PolicyId ,'t_PolicyName':t_PolicyName, 'specific_dt':specific_dt_data, 'weekely':weekely_data ,'n_MaxRptAmt':n_MaxRptAmt,'d_RptDueDt':d_RptDueDt,'n_MaxExpAmt':n_MaxExpAmt,'b_CashAdAllowed':b_CashAdAllowed ,'b_RecpReq':b_RecpReq ,'n_AboveAmt':n_AboveAmt ,'expense_submitted':expense_submitted ,'n_MaxRptMilage':n_MaxRptMilage ,'n_MilageRate':n_MilageRate ,'n_PerMeasuremnt':n_PerMeasuremnt ,'n_MaxExpMil':n_MaxExpMil ,'b_IsGPSReq':b_IsGPSReq ,'n_DailyExpLmt':n_DailyExpLmt,'n_MonthlyExpLmt':n_MonthlyExpLmt},
                success: function(data1){
                console.log(data1);
                if(data1.policyid !=''){
                $('#lastId').val(data1.policyid);
                }
                alert('Policy added successfully!.');
                }
                });
}
}
</script>
</body></html>