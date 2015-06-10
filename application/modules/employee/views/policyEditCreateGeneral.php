
<?php $user_id= checklogin();
    $businessid= $user_id['business_id']
 ?>

<script type="text/javascript">
$(document).ready(function(){
appendnewcatbusiness();

  var busid ="<?php echo $businessid; ?>";
 //console.log(busid);
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



<?php 

$sessionVar = $this->session->userdata('roleAccess');
$editPolicy=$sessionVar['Edit policy'];
// echo $editPolicy;
// exit();
?>

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
        }     $(this).toggleClass("off_button");
    }); 
    
    });
</script>-->
<?php 

$i=0;
foreach ($policy as $key => $value) {
       $policyId          = $value->a_PolicyId;
       $policyName        = $value->t_PolicyName;
       $maxRptAmt         = $value->n_MaxRptAmt;
       $rptDueDt          = $value->d_RptDueDt;
       $rptDueDt1         = $value->d_RptDueDt1;
       $maxExpAmt         = $value->n_MaxExpAmt;
       $cashAdAllowed     = $value->b_CashAdAllowed;
       $recpReq           = $value->b_RecpReq;
       $aboveAmt          = $value->n_AboveAmt;
       $days              = $value->n_Days;
       $maxRptMilage      = $value->n_MaxRptMilage;
       $milageRate        = $value->n_MilageRate;
       $perMeasuremnt     = $value->n_PerMeasuremnt;
       $maxExpMil         = $value->n_MaxExpMil;
       $isGPSReq          = $value->b_IsGPSReq;
       $monthlyExpLmt     = $value->n_MonthlyExpLmt;
       $dailyExpLmt       = $value->n_DailyExpLmt;
       $createdOn         = $value->d_CreatedOn;
       $modifiedOn        = $value->d_ModifiedOn;
       $reportDueBy       = $value->n_ReportDueBy;
       $flagExpSubmitted  = $value->t_flagExpSubmitted;
       $milRateUnitValue  = $value->n_MilRateUnitValue;
       $rptDueByValue     = $value->n_RptDueByValue;

       $array[$i]['dailyExpLmtMap']     = $value->dailyExpLmtMap;
       $array[$i]['monthlyExpLmtMap']   = $value->monthlyExpLmtMap;
       $array[$i]['n_SingleExpLmt']     = $value->n_SingleExpLmt;
       $array[$i]['n_SpndngCatId']      = $value->n_SpndngCatId;
       $array[$i]['t_SpnCatName']       = $value->t_SpnCatName;
  $i++;
}

// echo $maxExpAmt;
// p($array);
//   echo "<pre>";
//   print_r($cat);
    //exit();
?>

<script type="text/javascript">
  

  $(document).ready(function() {
       var dataselected="<?php echo $rptDueDt;?>";
       console.log(dataselected);
if(dataselected=='specific_dt'){
  $("#weekely11").hide();
                    $("#specific_dt").show();

}
else if(dataselected=='weekely'){

                     $("#weekely11").show();
                     $("#specific_dt").hide();
}
else{
  $(".none").hide();
}

      var getVal =$('#d_RptDueDt').find("option:selected").val();
          $("#d_RptDueDt").change(function(){
            var getVal =$(this).find("option:selected").val();

            if(getVal=='specific_dt'){
                  $("#weekely11").hide();
                  $("#specific_dt").show();
                     $('#specific_dt_data').val('');
                     $('#weekely_data').val('');

            }

            else if(getVal==='weekely'){
              //alert('hello');
              $("#weekely11").show();
              $("#specific_dt").hide();
                     $("#specific_dt_data").val('');
                     $('#weekely_data').val('');

                         }
            else{
               $(".none").hide();
               $("#specific_dt_data").val('');
               $('#weekely_data').val('');

            }

           });

    });





</script>








<section class="main_caintainer">
  <?php $this->load->view('leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
     
      <div id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top">
          <span class="buttonWrap_back">
            <!-- <a href="" class="loadbtn bluebg">Back to</a> --></span><span class="buttonWrap"> 
			<!--<a href="<?php echo base_url(); ?>business/dashboard/policyadd" id="addpolicynew" class="loadbtn bluebg">New Policy</a>
			-->
			</span> 
          <span class="buttonWrap">
             <?php 
                  $policy_asign=$assign;
 

                ?>
			<!--
            <h4> <?php if( $asignp ==1){ echo "Assigned";} ?></h4>-->
            </span>
           
            <input type="hidden" name="businessid" id="policy_check_ambigus" value="<?php echo $policy_asign; ?>">
            <input type="hidden" name="businessid" id="Businessbus" value="<?php echo $buspolicy; ?>">
            <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyId; ?>">
            <input type="hidden" name="First" id="First">
            <h2>Policy Name
                <input type="text" name="t_PolicyName" value="<?php echo $policyName;?>" id="t_PolicyName">
            </h2>
            <span id="policymsg" class="msgerr"></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
          <div class="col">
            <label>Max Report Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" value="<?php echo $maxRptAmt;?>"/>
          </div>
          <div class="col">
            <label>Report Due By</label>
            <!-- <select name="d_RptDueDt" style="width:25%;display:inline-block;" id="d_RptDueDt" >
              <option value='monthly' <?php// if($rptDueDt=='monthly'){echo "selected";}?>>Monthly</option>
              <option value='yearly' <?php // if($rptDueDt=='yearly'){echo "selected";}?>>Yearly</option>
            </select> -->

<select name="d_RptDueDt" style="display:inline-block;" id="d_RptDueDt">
               <option value="lastday" <?php if($rptDueDt=='lastday'){ echo 'selected="lastday"';} ?>>Last day of month</option>
               <option value="firstday" <?php if($rptDueDt =='firstday'){ echo 'selected="firstday"';} ?>>First day of month</option>
              <option value="specific_dt" <?php if($rptDueDt =='specific_dt'){ echo 'selected="specific_dt"';} ?>>Specific day of month</option>
              <option value="weekely" <?php if($rptDueDt =='weekely'){ echo 'selected="weekely"';} ?>>Weekely -Day</option>
            </select>
<span class="none" id="weekely11">
<select name="weekel" id="weekely_data">
<option value="">Select</option>
<option value="Sunday" <?php if($rptDueDt1 =='Sunday'){ echo 'selected="selected"';} ?>>Sunday</option>
<option value="Monday" <?php if($rptDueDt1 =='Monday'){ echo 'selected="selected"';} ?>>Monday</option>
<option value="Tuesday" <?php if($rptDueDt1 =='Tuesday'){ echo 'selected="selected"';} ?>>Tuesday</option>
<option value="Wednesday" <?php if($rptDueDt1 =='Wednesday'){ echo 'selected="selected"';} ?>>Wednesday</option>
<option value="Thursday" <?php if($rptDueDt1 =='Thursday'){ echo 'selected="selected"';} ?>>Thursday</option>
<option value="Friday" <?php if($rptDueDt1 =='Friday'){ echo 'selected="selected"';} ?>>Friday</option>
<option value="Saturday" <?php if($rptDueDt1 =='Saturday'){ echo 'selected="selected"';} ?>>Saturday</option>
</select>
</span>

<span class="none" id="specific_dt">

<select name="d_RptDueDt" id="specific_dt_data">
<option value="">Select</option>
       <option value='1' <?php if($rptDueDt1 =='1'){ echo 'selected="selected"';} ?> >1</option>
              <option value='2' <?php if($rptDueDt1 =='2'){ echo 'selected="selected"';} ?>>2</option>
              <option value='3' <?php if($rptDueDt1 =='3'){ echo 'selected="selected"';} ?>>3</option>
              <option value='4' <?php if($rptDueDt1 =='4'){ echo 'selected="selected"';} ?>>4</option>
              <option value='5' <?php if($rptDueDt1 =='5'){ echo 'selected="selected"';} ?>>5</option>
              <option value='6' <?php if($rptDueDt1 =='6'){ echo 'selected="selected"';} ?>>6</option>
              <option value='7' <?php if($rptDueDt1 =='7'){ echo 'selected="selected"';} ?>>7</option>
              <option value='8' <?php if($rptDueDt1 =='8'){ echo 'selected="selected"';} ?>>8</option>
              <option value='9' <?php if($rptDueDt1 =='9'){ echo 'selected="selected"';} ?>>9</option>
              <option value='10' <?php if($rptDueDt1 =='10'){ echo 'selected="selected"';} ?>>10</option>
              <option value='11' <?php if($rptDueDt1 =='11'){ echo 'selected="selected"';} ?>>11</option>
              <option value='12' <?php if($rptDueDt1 =='12'){ echo 'selected="selected"';} ?>>12</option>
              <option value='13' <?php if($rptDueDt1 =='13'){ echo 'selected="selected"';} ?>>13</option>
              <option value='14' <?php if($rptDueDt1 =='14'){ echo 'selected="selected"';} ?>>14</option>
              <option value='15' <?php if($rptDueDt1 =='15'){ echo 'selected="selected"';} ?>>15</option>
              <option value='16' <?php if($rptDueDt1 =='16'){ echo 'selected="selected"';} ?>>16</option>
              <option value='17' <?php if($rptDueDt1 =='17'){ echo 'selected="selected"';} ?>>17</option>
              <option value='18' <?php if($rptDueDt1 =='18'){ echo 'selected="selected"';} ?>>18</option>
              <option value='19' <?php if($rptDueDt1 =='19'){ echo 'selected="selected"';} ?>>19</option>
              <option value='20' <?php if($rptDueDt1 =='20'){ echo 'selected="selected"';} ?>>20</option>
              <option value='21' <?php if($rptDueDt1 =='21'){ echo 'selected="selected"';} ?>>21</option>
              <option value='22' <?php if($rptDueDt1 =='22'){ echo 'selected="selected"';} ?>>22</option>
              <option value='23' <?php if($rptDueDt1 =='23'){ echo 'selected="selected"';} ?>>23</option>
              <option value='24' <?php if($rptDueDt1 =='24'){ echo 'selected="selected"';} ?>>24</option>
              <option value='25' <?php if($rptDueDt1 =='25'){ echo 'selected="selected"';} ?>>25</option>
              <option value='26' <?php if($rptDueDt1 =='26'){ echo 'selected="selected"';} ?>>26</option>
              <option value='27' <?php if($rptDueDt1 =='27'){ echo 'selected="selected"';} ?>>27</option>
              <option value='28' <?php if($rptDueDt1 =='28'){ echo 'selected="selected"';} ?>>28</option>
              <option value='29' <?php if($rptDueDt1 =='29'){ echo 'selected="selected"';} ?>>29</option>
              <option value='30' <?php if($rptDueDt1 =='30'){ echo 'selected="selected"';} ?>>30</option>
              <option value='31' <?php if($rptDueDt1 =='31'){ echo 'selected="selected"';} ?>>31</option>

</select>
<!-- <input type="text" class="datepicker_all" name="specific_dt" id="d_RptDueDt" value=""> -->
</span>

<!-- <span class="none" id="firstday"> -->
<?php $dt= date("Y-m-d"); 
//echo $dt;
$firstdat= explode("-",$dt);
$year=$firstdat[0];
$month=$firstdat[1];
$date=1;
$fdat="$date-$month-$year";

 // echo  date("d-M-Y", strtotime($data['Last_login']));
?>
<!-- <input type="text"  name="firstday" id="d_RptDueDt" value="<?php  //echo  date("d M,Y", strtotime($fdat)); ?>"> -->
<!-- </span> -->

<!-- <span class="none" id="lastday"> -->

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





            <!-- <select name="d_RptDueDt1" style="width:15%;display:inline-block;float:right;" id="d_RptDueDt1">
              <option value='0' <?php if($rptDueDt1=='0'){echo "selected";}?>>0</option>
              <option value='1' <?php if($rptDueDt1=='1'){echo "selected";}?>>1</option>
              <option value='2' <?php if($rptDueDt1=='2'){echo "selected";}?>>2</option>
              <option value='3' <?php if($rptDueDt1=='3'){echo "selected";}?>>3</option>
              <option value='4' <?php if($rptDueDt1=='4'){echo "selected";}?>>4</option>
              <option value='5' <?php if($rptDueDt1=='5'){echo "selected";}?>>5</option>
              <option value='6' <?php if($rptDueDt1=='6'){echo "selected";}?>>6</option>
            </select> -->
          </div>
          <div class="col">
            <label>Max Expense Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxExpAmt" id="n_MaxExpAmt" value="<?php echo $maxExpAmt;?>"/>
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select style="" name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1' <?php if($rptDueDt1=='0'){echo "selected";}?>>Yes</option>
              <option value='0' <?php if($rptDueDt1=='0'){echo "selected";}?>>No</option>
            </select>
          </div>
          <div class="col">
            <label>Receipt Required</label>
            <select style="" name="b_RecpReq" id="b_RecpReq">
              <option value='1' <?php if($recpReq=='0'){echo "selected";}?>>Yes</option>
              <option value='0' <?php if($recpReq=='0'){echo "selected";}?>>No</option>
            </select>
          </div>



          <div class="col">
            <label>Above <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_AboveAmt" id="n_AboveAmt" value="<?php echo $aboveAmt;?>">
          </div>
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="<?php echo $flagExpSubmitted;?>">
          </div>
          <div class="col">
            <label>days after expense incurred</label>
          </div>

          <div class="right_top">
            <span class="buttonWrap">
              <a class="loadbtn bluebg myloading" id="saveGeneral">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

         
        </div>
      </div>
      <div id="form2">
        <div >
          <div class="right_top">
            <div > <span class="buttonWrap">
             <!--<h4> <?php if($asignp==1){echo "Assigned";} ?></h4>-->
              </span>
              <h2>Milage Name</h2>
              <div class="fix"></div>
            </div>
          </div>
          
          <div class="formPreExp">
            <div class="col">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">

              <label>Max Report Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="<?php echo $maxRptMilage;?>" />
            </div>
            <div class="col">
              <label>Mileage Rate <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="<?php echo $milageRate;?>" />
            </div>
            <span>
            <label class="milage-per">Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1' <?php if($perMeasuremnt=='1'){echo "selected";}?>>KM</option>
              <option value='2' <?php if($perMeasuremnt=='2'){echo "selected";}?>>MI</option>
              </select>
            </span>
            <div class="col">
              <label>Max Expense Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="<?php echo $maxExpMil;?>" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select style="" name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1' <?php if($isGPSReq=='0'){echo "selected";}?>>Yes</option>
                <option value='0' <?php if($isGPSReq=='0'){echo "selected";}?>>No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg mileage">Save Milage</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        
      </div>
      <div id="form3">
        <div class="right_top"> <span class="buttonWrap">
          <!--<h4> <?php if($asignp==1){echo "Assigned";} ?></h4>-->
          </span>
          <h2>Period Spending Limits</h2>
          <div class="fix"></div>
        </div>
        
        <div class="formPreExp">
          <div class="col">
          <input type="hidden" name="Third" id="Third">
            <label>Daily Spending Limit <span class="WebRupee" ><span class="currency">Rs</span></span></label>
            <input type="text" name="n_DailyExpLmt" value="<?php echo $dailyExpLmt;?>" id="n_DailyExpLmt"/>
          </div>
          <div class="col">
            <label>Monthly Spending Limit <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MonthlyExpLmt" value="<?php echo $monthlyExpLmt;?>"  id="n_MonthlyExpLmt"/>
          </div>
          <div> <span class="buttonWrap"><a class="loadbtn bluebg peiod_spending" >Save Spending Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        
      </div>
      <div id="form4">
        <div class="right_top">
          <h2>Period Categories Restrictions</h2>
          <span class="buttonWrap">
           <!--<h4> <?php if($asignp==1){echo "Assigned";} ?></h4>-->
          </span>
          <div class="fix"></div>
        </div>

        <div class="Expenses policy">

<!-- This code commented by Rahul Yadav  its create problom button on of   -->


         <!--  <table border="1">
            <tr>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in <span class="WebRupee" >Rs</span>)</th>
              <th>Daily Limit(in <span class="WebRupee" >Rs</span>)</th>
              <th>Monthly Limit(in <span class="WebRupee" >Rs</span>)</th>
            </tr>

    <?php //  $i=0; 
    //if( // !empty($cat)){
   
           
      /*
       foreach ($cat as $key1 => $value1) { 
           $n_SingleExpLmt='';
            $monthlyExpLmtMap='';
            $dailyExpLmtMap='';
*/
        ?>
     
        <tr>
            <input type="hidden" class="spncat" name="spncat[]" id="spncat<?php // echo $i; ?>" value="<?php // echo $value1->a_spndngcatId; ?>" />
            <td><input type="button" class="on_button off_button" name="on" id="<?php // echo $i; ?>" /></td>
            <td><?php  // echo  $value1->t_SpndName; ?></td>
            

    <?php/* foreach ($array as $key2 => $value2) {
          if($value1->a_spndngcatId==$value2['n_SpndngCatId']){
              $n_SingleExpLmt=$value2['n_SingleExpLmt'];
              $monthlyExpLmtMap=$value2['monthlyExpLmtMap'];
              $dailyExpLmtMap=$value2['dailyExpLmtMap'];
               break;
          }*/
         
    //   }?>

            <td><input type="text" value="<?php // echo $n_SingleExpLmt; ?>" class="sp_cat_single_exp_limit"name="sp_cat_single_exp_limit[]" id="sp_cat_single_exp_limit<?php // echo $i; ?>" /></td>
            <td><input type="text" value="<?php // echo $dailyExpLmtMap; ?>" class="sp_cat_single_daily_limit" name="sp_cat_single_daily_limit[]" id="sp_cat_single_daily_limit<?php // echo $i; ?>" /></td>
            <td><input type="text" value="<?php // echo $monthlyExpLmtMap; ?>" class="sp_cat_single_month_limit" name="sp_cat_single_month_limit[]" id="sp_cat_single_month_limit<?php // echo $i; ?>" /></td>
      </tr> 
   <?php //$i++; } 
   // }else{echo "No result";}?>
         
          </table> -->
          <!-- <div class="buttonWrapInner"><a class="loadbtn bluebg cat_restriction">Save Categories Restrictions</a> -->
          <span id="msg"> </span>
<!-- <h2 onclick="return appendnewcatbusiness();"> rahul</h2> -->
<table id="tblCategoryeditbus" border="1">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in <span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Daily Limit(in <span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Monthly Limit(in <span class="WebRupee" ><span class="currency"></span></span>)</th>
            </tr>
            </thead>
                    <tbody>
               </tbody>
          </table>
          <div class="buttonWrapInner"><a class="loadbtn bluebg " onclick="return add_categoryupdatebusiness();">Save Categories Restrictions</a></div>


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
  

  $(document).ready(function(){

  var access="<?php echo $editPolicy; ?>";
  console.log(access);
  if(access=="No"){
   //$("input[type='text']").prop('disabled','disabled');
   //$("select").prop('disabled','disabled');
   $(".loadbtn").hide();
  }
  
});


$(document).ready(function(){

  var policycheck="<?php echo $policy_asign; ?>";
  console.log(policycheck);
  if(policycheck==1){
   //$("input[type='text']").prop('disabled','disabled');
   //$("select").prop('disabled','disabled');
   $(".loadbtn").hide();
   $('#addpolicynew').show();
  // $('#policymsg').html('This policy cannot be updated . It is already being used by an employee ');
  }

});




</script>
</body></html>