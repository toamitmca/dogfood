
<!-- created by Rahul yadav  15/12/2014 -->


<script type="text/javascript">

//$('#t_PolicyName').prop('disabled',true);
 



    $(document).ready(function() {
    $("#t_PolicyName").attr("disabled", "disabled");
    $("#countpolicy1").html("Please select business name");
    $( "#businessid11" ).change(function() {
  var busid =$(this).find("option:selected").val();
if(busid =='-1'){
  $("#countpolicy1").html("Please select business name");
$('#t_PolicyName').prop("disabled","disabled");

}
else{
  $("#countpolicy1").html('');
$('#t_PolicyName').removeAttr("disabled");
}

    });

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

        if(getVal=='firstday'){
          $(".none").hide();
                    $("#firstday").show();
                }

        if(getVal=='lastday'){
          $(".none").hide();
                    $("#lastday").show();
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
<section class="main_caintainer">
  <?php $this->load->view('policy/leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>

      		<span class="buttonWrap_back">
      			<a href="<?php echo base_url(); ?>ssa/policy/policylist" class="loadbtn bluebg">Back to</a></span>
        	<span id="msg"></span>
          <div class="fix"></div>
      </div>
      <div id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top"><span class="buttonWrap">
           <!--  <h4>Assigned</h4> -->
            </span>
            <input type="hidden" name="First" id="First">
            <input type="hidden" name="singlepolicy" id="singlepolicyid" value="">
            <h2>Policy Name
              	<input type="text" name="t_PolicyName" value="" id="t_PolicyName"  onkeyup="return check_policy(-1);" >
                <input type="hidden" name="pname" value="" id="policyId">
                <input type="hidden" name="ontime_insert" id="ontime_insert" value="1">
                            </h2>
                            <span id="countpolicy1" class="msgerr"></span>
                            <span id="countpolicy" class="msgerr"></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
        <div class="col">
            <label>Business</label>
            <select name="n_business" id="businessid11"   onchange="return get_myspncat_bybusiness();" >
            <option value="-1">Select Business</option>
 <?php foreach ($business as  $value): ?>
 <option value="<?php echo $value->a_BusinessId ?>">  <?php  echo $value->t_BusinessName ?></option>
<?php endforeach ?>
            </select>
          </div>
          <div class="col">
            <label>Max Report Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" value="" />
          </div>
          <div class="col datecolpolicy">
            <label>Report Due By</label>
            <select name="d_RptDueDt" style="display:inline-block;" id="d_RptDueDt" >
              <option value="0" selected="selected">Select report due by</option>
               <option value="lastday">Last day of month</option>
               <option value="firstday">First day of month</option>
              <option value="specific_dt">Monthly</option>
              <option value="weekely">Weekly</option>
            </select>

<span class="none" id="weekely" >
<select name="d_RptDueDt" id="weekely_data">
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
<span class="none" id="specific_dt">
<select name="d_RptDueDt" id="specific_dt_data">
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
<!-- <input type="text" class="datepicker_all" name="specific_dt" id="d_RptDueDt" value=""> -->
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
<!-- <input type="text"  name="firstday" id="d_RptDueDt" value="1" readonly> -->
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
<!-- <input type="text"  name="lastday" id="d_RptDueDt" value="<?php echo  $datel; ?>" readonly> -->
</span>
            
          </div>
          <div class="col">
            <label>Max Expense Amount <span class="WebRupee" ><span class="currency"></span></span></label>
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
            <label>Above <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_AboveAmt" value="" id="n_AboveAmt" >
          </div><br />
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="">
           
          </div>
          <div class="col">
            <label class="lbl">days after expense incurred</label>
          </div>
          <div >
          	<span class="buttonWrap">

            	<a class="loadbtn bluebg myloading tabRun" id="" onclick="return addpolicy_blu();">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

         <!-- 

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
          </div>-->
        </div>
      </div>
      <div id="form2">
        <div>
          <div class="right_top"> <span class="buttonWrap"></span>
            <div class="fix"></div>
           
              <h2>Milage Name</h2>
           
          </div>
          <div class="col">

          </div>
          <div class="formPreExp">
          <div class="milage-name">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">
              <label>Max Report Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="" />
            </div>
            <div class="milage-name">
              <label>Mileage Rate <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="" />
            </div>
             <div class="milage-name per">
            <label>Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1'>KM</option>
              <option value='2'>MI</option>
              </select>
            </div>
            <div class="col">
              <label>Max Expense Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1'>Yes</option>
                <option value='0' >No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg  tabRun" onclick="return addpolicy_blu();">Save Milage </a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        
       <!-- <div class="right_top">
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
          <span class="buttonWrap"></span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>-->
      </div>
      <div id="form3">
        <div class="right_top"> <span class="buttonWrap">
         
          </span>
          <h2>Provide Spending Limits</h2>
          <div class="fix"></div>
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
          <div class="right_top"> <span class="buttonWrap"><a class="loadbtn bluebg peiod_spending tabRun" onclick="return addpolicy_blu();">Save Peroid Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        <div >
          <h2>Spending Categories Restrictions</h2>
          <span id="errormsg"></span>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
<table border="1" class="businessTab1" id="1businessTab12">
<thead>
          <tr> <th> Spending Cat</th> <th> GL Code</th><td>Action </td></tr>
          </thead>
           <tbody>
           </tbody>
           </table>


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
               <div><span class="buttonWrap"><input type="button" id="spend_cat_save" name="save" value="Save" class="loadbtn bluebg" onclick="return add_policycategory(); "></span></div>
          </div>
        </div>
      </div>
      <div id="form4">
        <div class="right_top">
          <h2>Period Categories Restrictions</h2>
          <span class="buttonWrap">
          
          </span>
          <div class="fix"></div>
        </div>
        
        <div class="Expenses policy">
        <table id="tblCategory_spcat">
        <thead>
            <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Spending Categories</th>
                  <th>Single Expenses Limit (in <span class="WebRupee" ><span class="currency"></span></span>)</th>
                  <th>Daily Limit(in <span class="WebRupee" ><span class="currency"></span></span>)</th>
                  <th>Monthly Limit (in <span class="currency WebRupee"></span></span>)</th>
            </tr>
            </thead>
            <tbody> </tbody>
            
        </table>
        <!-- <table id="tblCategory"></table> -->

           <div class="buttonWrapInner"><a class="loadbtn bluebg cat_restriction" onclick="return add_categoryadmin();">Save Categories Restrictions</a>
            <div class="fix"></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<div class="fix"></div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/policy2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/business.js"></script>

<script type="text/javascript">
function currency_change(busid){
 // console.log(busid);
 // alert(busid);
  var baseurl="<?php echo base_url();?>";
  $.ajax({
    url: baseurl+'/ssa/policy/currency_formate',
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

}


/*function ssapolicygeneral(){

//alert('hell');


          var id = $('#policyId').val();
          var businessid = $('#businessid11').val();
          var specific_dt = $('#specific_dt_data').val();
          var weekely = $('#weekely_data').val();
          var polcy_name = $('#t_PolicyName').val();
           var n_MaxRptAmt = $('#n_MaxRptAmt').val();
           var d_RptDueDt = $('#d_RptDueDt').val();
           var d_RptDueDt1 = $('#d_RptDueDt1').val();
           var n_MaxExpAmt = $('#n_MaxExpAmt').val();
           var b_CashAdAllowed = $('#b_CashAdAllowed').val();
           var b_RecpReq = $('#b_RecpReq').val();
            var n_AboveAmt = $('#n_AboveAmt').val();
            var expense_submitted = $('#expense_submitted').val();
            var singlepolicy = $('#singlepolicyid').val();
            var on_insert = $('#ontime_insert').val();
             var Mybase_url = base_url();

          if(polcy_name==""){

      $('#t_PolicyName').css("border","solid 1px red");
       $('#t_PolicyName').focus();
       return false;

      }else{

      $('#t_PolicyName').css("border",""); 
      }


        if(singlepolicy ==1){
         

                          $.ajax({
                          url: Mybase_url+'ssa/policy/ssapolicygeneral/',
                          type:'POST',
                          dataType:'json',
                          data: {'act_mode1':'Insert' ,'businessid':businessid,'id':id,'polcy_name':polcy_name,'n_MaxRptAmt':n_MaxRptAmt,'d_RptDueDt':d_RptDueDt,'specific_dt':specific_dt, 'weekely':weekely , 'd_RptDueDt1':d_RptDueDt1,'n_MaxExpAmt':n_MaxExpAmt,
                          'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq,'n_AboveAmt':n_AboveAmt,'expense_submitted':expense_submitted},
                          success: function(data){
                          console.log(data);
                          console.log("gg"+data.lastid);
                          $('#policyId').val(data.lastid);

                       $('#t_PolicyName').val('');
                       $('#n_MaxRptAmt').val('');
                        $('#d_RptDueDt').val('');
                       $('#d_RptDueDt1').val('');
                      $('#n_MaxExpAmt').val('');
                      $('#b_CashAdAllowed').val('');
                     $('#b_RecpReq').val('');
                     $('#n_AboveAmt').val('');
                     $('#expense_submitted').val('');



                          
  $('#msg').html('General save sucessfully!');
                          }
                          });




                      }
          else{
alert('Policy Not Save');
          }

        }
*/





     /*   function ssapolicyspndlmtadd(){
            var id = $('#policyId').val();
          var n_DailyExpLmt = $('#n_DailyExpLmt').val();
           var n_MonthlyExpLmt = $('#n_MonthlyExpLmt').val();
            var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
if(singlepolicy ==1){

                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicyspndlmt/',
                    type:'POST',
                    data: {'id':id,'n_DailyExpLmt':n_DailyExpLmt,'n_MonthlyExpLmt':n_MonthlyExpLmt},
                    success: function(data1){
                    console.log(data1);
                    $('#msg').html('Spending limit save sucessfully!');

                   $('#n_DailyExpLmt').val('');
                  $('#n_MonthlyExpLmt').val('');




                    }
                    });
              }
      else{
alert('Policy not save');
      }
        }*/

      /*  function ssapolicymiligeadd(){
            var id = $('#policyId').val();
          var n_MaxRptMilage = $('#n_MaxRptMilage').val();
           var n_MilageRate = $('#n_MilageRate').val();
           var n_PerMeasuremnt = $('#n_PerMeasuremnt').val();
           var n_MaxExpMil = $('#n_MaxExpMil').val();
           var b_IsGPSReq = $('#b_IsGPSReq').val();
           var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
           if(singlepolicy ==1){
                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicylmilige/',
                    type:'POST',

                    data: {'id':id,'n_MaxRptMilage':n_MaxRptMilage,'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil':n_MaxExpMil,'b_IsGPSReq':b_IsGPSReq },
                    success: function(data1){
                    console.log(data1);


            $('#n_MaxRptMilage').val('');
            $('#n_MilageRate').val('');
            $('#n_PerMeasuremnt').val('');
           $('#n_MaxExpMil').val('');
            $('#b_IsGPSReq').val('');
                   $('#msg').html('Mileage save sucessfully!');
                    }
                    });
                  }
                  else{
                    alert('Policy Not save');
                  }
  }*/

function add_categoryadmin(){
var Mybase_url = base_url();
var  businessid = $('#businessid11').val();
 var singlepolicy = $('#singlepolicyid').val();
var id = $('#policyId').val();
var arrcat=new Array();
$('#tblCategory_spcat tbody tr').each(function(row,tr){
arrcat[row]={ "cat_id":$(tr).find('td:nth-child(1) input[type=hidden]').val() ,
"sp_cat_single_exp_limit":$(tr).find('td:nth-child(4) input[type=text]').val() ,
"sp_cat_single_daily_limit":$(tr).find('td:nth-child(5) input[type=text]').val() ,
"sp_cat_single_month_limit":$(tr).find('td:nth-child(6) input[type=text]').val()
};

})
   if(singlepolicy ==1){

            $.ajax({
            url: Mybase_url+'ssa/policy/ssapolicycategory/',
            type:'POST',
            data: { 'a_mode':'Insert', 'policyId':id,'a_BusinessId':businessid, 't_PolicyName':arrcat},
            success: function(data){
            console.log(data);
            $('#msg').html('Spending category lmits save sucessfully!');
            }
            });
      }

      else{
alert('Policy category not save');

      }


}

function addpolicy_blu(){

var singlepolicy    = $("#singlepolicyid").val();
if(singlepolicy==1){
  var lastId=$('#policyId').val();
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
 var businessid =$('#businessid11').val();
  if(lastId==""){
    var act_mode ='insert';
    var n_PolicyId="";
  }
  else{
   var act_mode='update';
   var  n_PolicyId= lastId;
  }
var Mybase_url ="<?php echo base_url(); ?>";
                $.ajax({
                url: Mybase_url+'ssa/policy/policy_add_business/',
                 type:'POST',
                 dataType:'json',
                data: {'act_mode':act_mode ,'n_PolicyId':n_PolicyId ,'t_PolicyName':t_PolicyName, 'specific_dt':specific_dt_data, 'weekely':weekely_data ,'n_MaxRptAmt':n_MaxRptAmt,'d_RptDueDt':d_RptDueDt,'n_MaxExpAmt':n_MaxExpAmt,'b_CashAdAllowed':b_CashAdAllowed ,'b_RecpReq':b_RecpReq ,'n_AboveAmt':n_AboveAmt ,'expense_submitted':expense_submitted ,'n_MaxRptMilage':n_MaxRptMilage ,'n_MilageRate':n_MilageRate ,'n_PerMeasuremnt':n_PerMeasuremnt ,'n_MaxExpMil':n_MaxExpMil ,'b_IsGPSReq':b_IsGPSReq ,'n_DailyExpLmt':n_DailyExpLmt,'n_MonthlyExpLmt':n_MonthlyExpLmt,'businessid':businessid},
                success: function(data1){
                console.log(data1);
                if(data1.policyid !==''){
                $('#policyId').val(data1.policyid);
                }
                alert('Policy added successfully!.');
                }
                });
}
}

</script>

</body></html>