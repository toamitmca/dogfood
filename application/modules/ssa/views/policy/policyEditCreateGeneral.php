
<script type="text/javascript">
    $(document).ready(function() {
      appendnewcat();
       var dataselected="<?php echo $policyname->d_RptDueDt;?>";
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

$(document).ready(function(){
  var busid ="<?php echo $policyname->n_BusinessId;?>";
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
<section class="main_caintainer">
  <?php $this->load->view('policy/leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
          <span class="buttonWrap_back">
          
            <a href="<?php echo base_url(); ?>ssa/policy/policylist" class="loadbtn">Back to</a></span><span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/policy/policyadd" class="loadbtn">New Policy</a></span>
<span id="msg"></span>
          <div class="fix"></div>
           <span id="message"> </span>
      </div>
      <div id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div ><span class="buttonWrap">
          <?php if($asignp==1){  ?>
             <h4>Assigned</h4> <?php } ?>
            
            </span>
            <input type="hidden" name="First" id="First">
            <h2>Policy Name
                <input type="text" name="t_PolicyName" value="<?php echo $policyname->t_PolicyName;?>" id="t_PolicyName">
                <input type="hidden" name="pname" value="<?php echo $policyname->a_PolicyId;?>" id="policyId">
                <input type="hidden" name="bid" id="businessid11" value="<?php echo $policyname->n_BusinessId; ?>">
            </h2>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
         <div class="col">
         <input type="hidden" name="n_id" id="BusinessId22222" value="<?php echo $policyname->n_BusinessId; ?>">
          <?php //p($business); ?>
            <label class="bname">Business Name:
 <?php foreach ($business as  $value): ?>
 <?php if($value->a_BusinessId === $policyname->n_BusinessId) { echo $value->t_BusinessName;} ?>
<?php endforeach ?>


</label>

          </div>
          <div class="col">
            <label>Max Report Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" value="<?php echo $policyname->n_MaxRptAmt;?>" />
          </div>
          <div class="col datecolpolicy">
            <label>Report Due By</label>
            <select name="d_RptDueDt" style="display:inline-block;" id="d_RptDueDt">
               <option value="lastday" <?php if($policyname->d_RptDueDt =='lastday'){ echo 'selected="lastday"';} ?>>Last day of month</option>
               <option value="firstday" <?php if($policyname->d_RptDueDt =='firstday'){ echo 'selected="firstday"';} ?>>First day of month</option>
              <option value="specific_dt" <?php if($policyname->d_RptDueDt =='specific_dt'){ echo 'selected="specific_dt"';} ?>>Specific day of month</option>
              <option value="weekely" <?php if($policyname->d_RptDueDt =='weekely'){ echo 'selected="weekely"';} ?>>Weekely -Day</option>
            </select>

<span class="none" id="weekely11">
<select name="weekel" id="weekely_data">
<option value="">Select</option>
<option value="Sunday" <?php if($policyname->d_RptDueDt1 =='Sunday'){ echo 'selected="selected"';} ?>>Sunday</option>
<option value="Monday" <?php if($policyname->d_RptDueDt1 =='Monday'){ echo 'selected="selected"';} ?>>Monday</option>
<option value="Tuesday" <?php if($policyname->d_RptDueDt1 =='Tuesday'){ echo 'selected="selected"';} ?>>Tuesday</option>
<option value="Wednesday" <?php if($policyname->d_RptDueDt1 =='Wednesday'){ echo 'selected="selected"';} ?>>Wednesday</option>
<option value="Thursday" <?php if($policyname->d_RptDueDt1 =='Thursday'){ echo 'selected="selected"';} ?>>Thursday</option>
<option value="Friday" <?php if($policyname->d_RptDueDt1 =='Friday'){ echo 'selected="selected"';} ?>>Friday</option>
<option value="Saturday" <?php if($policyname->d_RptDueDt1 =='Saturday'){ echo 'selected="selected"';} ?>>Saturday</option>
</select>
</span>




<span class="none" id="specific_dt">

<select name="d_RptDueDt" id="specific_dt_data">
<option value="">Select</option>
       <option value='1' <?php if($policyname->d_RptDueDt1 =='1'){ echo 'selected="selected"';} ?> >1</option>
              <option value='2' <?php if($policyname->d_RptDueDt1 =='2'){ echo 'selected="selected"';} ?>>2</option>
              <option value='3' <?php if($policyname->d_RptDueDt1 =='3'){ echo 'selected="selected"';} ?>>3</option>
              <option value='4' <?php if($policyname->d_RptDueDt1 =='4'){ echo 'selected="selected"';} ?>>4</option>
              <option value='5' <?php if($policyname->d_RptDueDt1 =='5'){ echo 'selected="selected"';} ?>>5</option>
              <option value='6' <?php if($policyname->d_RptDueDt1 =='6'){ echo 'selected="selected"';} ?>>6</option>
              <option value='7' <?php if($policyname->d_RptDueDt1 =='7'){ echo 'selected="selected"';} ?>>7</option>
              <option value='8' <?php if($policyname->d_RptDueDt1 =='8'){ echo 'selected="selected"';} ?>>8</option>
              <option value='9' <?php if($policyname->d_RptDueDt1 =='9'){ echo 'selected="selected"';} ?>>9</option>
              <option value='10' <?php if($policyname->d_RptDueDt1 =='10'){ echo 'selected="selected"';} ?>>10</option>
              <option value='11' <?php if($policyname->d_RptDueDt1 =='11'){ echo 'selected="selected"';} ?>>11</option>
              <option value='12' <?php if($policyname->d_RptDueDt1 =='12'){ echo 'selected="selected"';} ?>>12</option>
              <option value='13' <?php if($policyname->d_RptDueDt1 =='13'){ echo 'selected="selected"';} ?>>13</option>
              <option value='14' <?php if($policyname->d_RptDueDt1 =='14'){ echo 'selected="selected"';} ?>>14</option>
              <option value='15' <?php if($policyname->d_RptDueDt1 =='15'){ echo 'selected="selected"';} ?>>15</option>
              <option value='16' <?php if($policyname->d_RptDueDt1 =='16'){ echo 'selected="selected"';} ?>>16</option>
              <option value='17' <?php if($policyname->d_RptDueDt1 =='17'){ echo 'selected="selected"';} ?>>17</option>
              <option value='18' <?php if($policyname->d_RptDueDt1 =='18'){ echo 'selected="selected"';} ?>>18</option>
              <option value='19' <?php if($policyname->d_RptDueDt1 =='19'){ echo 'selected="selected"';} ?>>19</option>
              <option value='20' <?php if($policyname->d_RptDueDt1 =='20'){ echo 'selected="selected"';} ?>>20</option>
              <option value='21' <?php if($policyname->d_RptDueDt1 =='21'){ echo 'selected="selected"';} ?>>21</option>
              <option value='22' <?php if($policyname->d_RptDueDt1 =='22'){ echo 'selected="selected"';} ?>>22</option>
              <option value='23' <?php if($policyname->d_RptDueDt1 =='23'){ echo 'selected="selected"';} ?>>23</option>
              <option value='24' <?php if($policyname->d_RptDueDt1 =='24'){ echo 'selected="selected"';} ?>>24</option>
              <option value='25' <?php if($policyname->d_RptDueDt1 =='25'){ echo 'selected="selected"';} ?>>25</option>
              <option value='26' <?php if($policyname->d_RptDueDt1 =='26'){ echo 'selected="selected"';} ?>>26</option>
              <option value='27' <?php if($policyname->d_RptDueDt1 =='27'){ echo 'selected="selected"';} ?>>27</option>
              <option value='28' <?php if($policyname->d_RptDueDt1 =='28'){ echo 'selected="selected"';} ?>>28</option>
              <option value='29' <?php if($policyname->d_RptDueDt1 =='29'){ echo 'selected="selected"';} ?>>29</option>
              <option value='30' <?php if($policyname->d_RptDueDt1 =='30'){ echo 'selected="selected"';} ?>>30</option>
              <option value='31' <?php if($policyname->d_RptDueDt1 =='31'){ echo 'selected="selected"';} ?>>31</option>

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
<!-- <input type="text"  name="lastday" id="d_RptDueDt" value="<?php //echo  date("d M,Y", strtotime($fdat)); ?>"> -->
<!-- </span> -->




          <!--   <select name="d_RptDueDt1" style="width:15%;display:inline-block;float:right;" id="d_RptDueDt1">
              <option value='0' <?php // if($policyname->d_RptDueDt =='0'){ echo 'selected="selected"';} ?> >0</option>
              <option value='1' <?php // if($policyname->d_RptDueDt =='1'){ echo 'selected="selected"';} ?> >1</option>
              <option value='2' <?php // if($policyname->d_RptDueDt =='2'){ echo 'selected="selected"';} ?> >2</option>
              <option value='3' <?php // if($policyname->d_RptDueDt =='3'){ echo 'selected="selected"';} ?> >3</option>
              <option value='4' <?php // if($policyname->d_RptDueDt =='4'){ echo 'selected="selected"';} ?> >4</option>
              <option value='5' <?php // if($policyname->d_RptDueDt =='5'){ echo 'selected="selected"';} ?> >5</option>
              <option value='6' <?php // if($policyname->d_RptDueDt =='6'){ echo 'selected="selected"';} ?> >6</option>
            </select>
           --></div>
          <div class="col">
            <label>Max Expense Amount <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MaxExpAmt" value="<?php echo $policyname->n_MaxExpAmt;?>"  id="n_MaxExpAmt"/>
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1'<?php if($policyname->b_CashAdAllowed =='1'){ echo 'selected="selected"';} ?>  >Yes</option>
              <option value='0' <?php if($policyname->b_CashAdAllowed =='0'){ echo 'selected="selected"';} ?> >No</option>
            </select>
          </div>
          <div class="col">
            <label>Receipt Required</label>
            <select name="b_RecpReq" id="b_RecpReq">
              <option value='1' <?php if($policyname->b_RecpReq =='1'){ echo 'selected="selected"';} ?>>Yes</option>
              <option value='0' <?php if($policyname->b_RecpReq =='0'){ echo 'selected="selected"';} ?>>No</option>
            </select>
          </div>
          <div class="col">
            <label>Above <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_AboveAmt" value=" <?php echo $policyname->n_AboveAmt;?>" id="n_AboveAmt" >
          </div><br />
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="<?php echo $policyname->t_flagExpSubmitted;?>">
          </div>
          <div class="col">
            <label class="lbl">days after expense incurred</label>
          </div>

          <div class="right_top">
            <span class="buttonWrap">

              <a class="loadbtn bluebg myloading tabRun"  onclick="return ssapolicygeneralupdat();">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

         
        </div>
      </div>
      <div id="form2">
        <div class="right_top">
          <div > <span class="buttonWrap"></span>
            <div class="fix"></div>
            <div class="right_top"> <span class="buttonWrap">
             <?php if($asignp==1){  ?>
             <h4>Assigned</h4> <?php } ?>
              </span>
              <h2>Mileage Name</h2>
              <div class="fix"></div>
            </div>
          </div>
          <div class="col">

          </div>
          <div class="formPreExp">
            <div class="milage-name">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">
              <label>Max Report Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="<?php echo $policyname->n_MaxRptMilage;?>" />
            </div>
            <div class="milage-name">
              <label>Mileage Rate <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="<?php echo $policyname->n_MilageRate;?>" />
            </div>
            <div class="milage-name per">
           <label>Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1' <?php if($policyname->n_PerMeasuremnt==1){ echo 'selected="selected"';} ?> >KM</option>
              <option value='2' <?php if($policyname->n_PerMeasuremnt==2){ echo 'selected="selected"';} ?> >MI</option>
              </select>
            </div>

            <div class="col">
              <label>Max Expense Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="<?php  echo $policyname->n_MaxExpMil;?>" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1' <?php if($policyname->b_IsGPSReq==1){ echo 'selected="selected"';} ?>>Yes</option>
                <option value='0' <?php if($policyname->b_IsGPSReq==0){ echo 'selected="selected"';} ?>>No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg mileage tabRun" onclick="return ssapolicymilige();">Save Milage</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
       
      </div>
      <div id="form3">
        <div class="right_top"> <span class="buttonWrap">
        <?php if($asignp==1){  ?>
             <h4>Assigned</h4> <?php } ?>
          </span>
          <h2>Spending Limits</h2>
          <div class="fix"></div>
        </div>
        <div class="col">
          <label style="text-align:left;"></label>
        </div>
        <div class="formPreExp">
          <div class="col">
          <input type="hidden" name="Third" id="Third">
            <label>Daily Spending Limit <span class="WebRupee" ><span class="currency"></span></span> </label>
            <input type="text" name="n_DailyExpLmt" value="<?php  echo $policyname->n_DailyExpLmt;?>" id="n_DailyExpLmt"/>
          </div>
          <div class="col">
            <label>Monthly Spending Limit <span class="WebRupee" ><span class="currency"></span></span></label>
            <input type="text" name="n_MonthlyExpLmt" value="<?php  echo $policyname->n_MonthlyExpLmt;?>"  id="n_MonthlyExpLmt"/>
          </div>
          <div class="right_top"> <span class="buttonWrap"><a class="loadbtn bluebg peiod_spending tabRun" onclick="return ssapolicyspndlmt();">Save Peroid Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap"></span>

<table border="1" class="businessTab1" id="1businessTab12">
<thead>
          <tr> <th> Spending Cat</th> <th> GL Code</th><td>Action </td></tr>
          </thead>
           <tbody>
          <?php
            if($get_spcatglcode !=="Something Went Wrong"){

            foreach ($get_spcatglcode as $dcat_name) { ?>
          <tr id="remtr<?php echo $dcat_name->a_SpndngCatId; ?>">
            <td><p><?php  echo $dcat_name->t_SpndName; ?></p></td>
            <td id="appendCat<?php echo $dcat_name->a_SpndngCatId; ?>">
                <span id="rem<?php echo $dcat_name->a_SpndngCatId; ?>">
                    <label class="remove_attr" onclick="return ssaadd_cat_glcod(<?php echo  $dcat_name->a_SpndngCatId; ?>);">
                      <p id="<?php echo $dcat_name->a_SpndngCatId; ?>">
                        <input type="hidden" name="gl_code" id="gl_code<?php echo  $dcat_name->a_SpndngCatId; ?>" value="<?php  echo $dcat_name->t_GLCode; ?>"/>
                       <input type="text" value="<?php  echo $dcat_name->t_GLCode; ?>"> 
                      </p>
                    </label>
                </span>
                <span id="app<?php echo $dcat_name->a_SpndngCatId; ?>"></span>
            </td>
            <td>
              <input type="button" name="delete" value="Delete"onclick="return ssdelete(<?php echo $dcat_name->a_SpndngCatId; ?>);">
            </td>
        </tr>
          <?php  }  } else{
echo "Record not found";
            } ?>
             </tbody>
          </table>
<!-- 
end -->

<h2 onclick="return getallcatbusiness();"> Add more</h2>

          <span id="errormsg"></span>
<div class="formPreExp">
     <table border="1" id="tblCategory1" class="tblCategory1">
            <thead>
              <tr>
                <th>Category </th><th>GLcode </th>
                <th><input type="button" onclick="AddNewRow_categorybusiness();" class="loadbtn " value="Add New"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
              <div class="fix"></div>
               <div><span class="buttonWrap"><input type="button" name="save" value="Save" class="loadbtn bluebg"  onclick="return add_policycategoryonupdate(); "></span>            </div>
          </div>
<!-- end add more -->
          <div class="formPreExp">
            <div><span class="buttonWrap"><!-- <a href="" class="loadbtn bluebg" >Save Categories Restriction</a> --></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="form4">
        <div class="right_top">
            <h2 class="genHead blue">Period Categories Restrictions</h2>
          <span class="buttonWrap">
         <?php if($asignp==1){  ?>
             <h4>Assigned</h4> <?php } ?>
          </span>
          <div class="fix"></div>
        </div>
        <div class="Expenses policy">
          <table id="tblCategoryedit" border="1">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in <span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Daily Limit (in  <span class="WebRupee" ><span class="currency"></span></span>)</th>
              <th>Monthly Limit (in  <span class="WebRupee" ><span class="currency"></span></span>)</th>
            </tr>
            </thead>
                    <tbody>
               </tbody>
          </table>
         <div class="buttonWrapInner"><a class="loadbtn bluebg cat_restriction" onclick="return add_categoryupdatessa();">Save Categories Restrictions</a>
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
<script type="text/javascript">


 function ssapolicygeneralupdat(){
          var id = $('#policyId').val();
          var businessid1 = -1;
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
             var Mybase_url = base_url();
            $.ajax({
        url: Mybase_url+'ssa/policy/ssapolicygeneral/',
        type:'POST',
         dataType:'json',
        data: {'act_mode1':'update' ,'businessid':businessid1,'id':id,'polcy_name':polcy_name,'n_MaxRptAmt':n_MaxRptAmt,'d_RptDueDt':d_RptDueDt, 'specific_dt':specific_dt, 'weekely':weekely ,'d_RptDueDt1':d_RptDueDt1,'n_MaxExpAmt':n_MaxExpAmt,
         'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq,'n_AboveAmt':n_AboveAmt,'expense_submitted':expense_submitted},
        success: function(data){
          console.log(data);
          $('#msg').html("General update successfully!.");

             }
      });

        }



function ssapolicymilige(){
            var id = $('#policyId').val();
          var n_MaxRptMilage = $('#n_MaxRptMilage').val();
           var n_MilageRate = $('#n_MilageRate').val();
           var n_PerMeasuremnt = $('#n_PerMeasuremnt').val();
           var n_MaxExpMil = $('#n_MaxExpMil').val();
           var b_IsGPSReq = $('#b_IsGPSReq').val();
          // var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicylmilige/',
                    type:'POST',

                    data: {'id':id,'n_MaxRptMilage':n_MaxRptMilage,'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil':n_MaxExpMil,'b_IsGPSReq':b_IsGPSReq },
                    success: function(data1){
                    console.log(data1);
                    $('#msg').html("Mileage update successfully!.");
                    }
                    });
  }

function ssapolicyspndlmt(){
  appendnewcat()
            var id = $('#policyId').val();
          var n_DailyExpLmt = $('#n_DailyExpLmt').val();
           var n_MonthlyExpLmt = $('#n_MonthlyExpLmt').val();
           // var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicyspndlmt/',
                    type:'POST',
                    data: {'id':id,'n_DailyExpLmt':n_DailyExpLmt,'n_MonthlyExpLmt':n_MonthlyExpLmt},
                    success: function(data1){
                    console.log(data1);
                     $('#msg').html("Spending Limit update successfully!.");
                    }
                    });
            }


function add_categoryupdatessa(){
var Mybase_url = base_url();
var  businessid = $('#businessid11').val();
var id = $('#policyId').val();
var arrcat=new Array();
$('#tblCategoryedit tbody tr').each(function(row,tr){
arrcat[row]={ "cat_id":$(tr).find('td:nth-child(1) input[type=hidden]').val() ,
"sp_cat_single_exp_limit":$(tr).find('td:nth-child(4) input[type=text]').val() ,
"sp_cat_single_daily_limit":$(tr).find('td:nth-child(5) input[type=text]').val() ,
"sp_cat_single_month_limit":$(tr).find('td:nth-child(6) input[type=text]').val()
};

})
  // var savedatacat = JSON.stringify(arr);
  // alert(savedatacat);   password

 $.ajax({
       url: Mybase_url+'ssa/policy/ssapolicycategory/',
        type:'POST',
        data: { 'a_mode':'update', 'policyId':id,'a_BusinessId':businessid, 't_PolicyName':arrcat},
        success: function(data){
          console.log(data);
          $('#msg').html('Spending Categories Limits updated successfully!.');
        }
      });

 // alert(JSON.stringify(arr));

}




</script>

</body></html>