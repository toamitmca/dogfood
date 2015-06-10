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
<?php
$i=0;
if(!empty($policy)){
  foreach ($policy as $key3 => $value3) {
     $array[$i]['dailyExpLmtMap']     = $value3->n_DailyExpLmt;
     $array[$i]['monthlyExpLmtMap']   = $value3->n_MonthlyExpLmt;
     $array[$i]['n_SingleExpLmt']     = $value3->n_SingleExpLmt;
     $array[$i]['n_SpndngCatId']      = $value3->a_SpndngCatId;
     $array[$i]['t_SpnCatName']       = $value3->t_SpndName;
    $i++;
  }
  
}
// p($policy);
// p($get_allcat);
// exit();
 ?>
<section class="main_caintainer">
  <?php $this->load->view('policy/leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">
      			<a href="<?php echo base_url(); ?>ssa/policy/policylist" class="loadbtn">Back to</a></span><span class="buttonWrap"><a href="<?php echo base_url(); ?>ssa/policy/policyadd" class="loadbtn">New Policy</a></span>

          <div class="fix"></div>
           <span id="message"> </span>
      </div>
      <div class="tabcontent" id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top"><span class="buttonWrap">
            <h4>Assigned</h4>
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
            <label>Business Name:
 <?php foreach ($business as  $value): ?>
 <?php if($value->a_BusinessId === $policyname->n_BusinessId) { echo $value->t_BusinessName;} ?>
<?php endforeach ?>


</label>

          </div>
          <div class="col">
            <label>Max Report Amount R</label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" value="<?php echo $policyname->n_MaxRptAmt;?>" />
          </div>
          <div class="col">
            <label>Report Due By</label>
            <select name="d_RptDueDt" style="width:25%;display:inline-block;" id="d_RptDueDt" >
              <option value='monthly' <?php if($policyname->d_RptDueDt =='monthly'){ echo 'selected="selected"';} ?> >Monthly</option>
              <option value='yearly'  <?php if($policyname->d_RptDueDt =='yearly'){ echo 'selected="selected"';} ?> >Yearly</option>
            </select>
            <select name="d_RptDueDt1" style="width:15%;display:inline-block;float:right;" id="d_RptDueDt1">
              <option value='0' <?php if($policyname->d_RptDueDt =='0'){ echo 'selected="selected"';} ?> >0</option>
              <option value='1' <?php if($policyname->d_RptDueDt =='1'){ echo 'selected="selected"';} ?> >1</option>
              <option value='2' <?php if($policyname->d_RptDueDt =='2'){ echo 'selected="selected"';} ?> >2</option>
              <option value='3' <?php if($policyname->d_RptDueDt =='3'){ echo 'selected="selected"';} ?> >3</option>
              <option value='4' <?php if($policyname->d_RptDueDt =='4'){ echo 'selected="selected"';} ?> >4</option>
              <option value='5' <?php if($policyname->d_RptDueDt =='5'){ echo 'selected="selected"';} ?> >5</option>
              <option value='6' <?php if($policyname->d_RptDueDt =='6'){ echo 'selected="selected"';} ?> >6</option>
            </select>
          </div>
          <div class="col">
            <label>Max Expense Amount R</label>
            <input type="text" name="n_MaxExpAmt" value="<?php echo $policyname->n_MaxExpAmt;?>"  id="n_MaxExpAmt"/>
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1'<?php if($policyname->d_RptDueDt =='1'){ echo 'selected="selected"';} ?>  >Yes</option>
              <option value='0' <?php if($policyname->d_RptDueDt =='0'){ echo 'selected="selected"';} ?> >No</option>
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
            <label>Above R</label>
            <input type="text" name="n_AboveAmt" value=" <?php echo $policyname->n_AboveAmt;?>" id="n_AboveAmt" >
          </div>
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="expense_submitted" id="expense_submitted" value="<?php echo $policyname->t_flagExpSubmitted;?>">
          </div>
          <div class="col">
            <label>days after expense incurred</label>
          </div>

          <div class="right_top">
          	<span class="buttonWrap">

            	<a class="loadbtn bluebg myloading" id="saveGeneral" onclick="return ssapolicygeneralupdat();">Save General</a>
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
            <span class="buttonWrap"></span>
            <div class="formPreExp">

<div class="Expenses">


    <?php
//if($policy !=='Something Went Wrong'){

/*$diff['name'] = array();
$diff['id'] = array();
foreach ( $get_allcat as $v1 ) {
    $flag = 0;
    foreach ( $policy as $v2 ) {
      $flag |=  ($v1->t_SpndName == $v2->t_SpndName);
      if ( $flag ) break;
    }
    if ( !$flag ) array_push( $diff['name'], $v1->t_SpndName ); //array_push( $diff['id'], $v1->a_SpndngCatId);
  }
  foreach ( $get_allcat as $v1 ) {
    $flag = 0;
    foreach ( $policy as $v2 ) {
      $flag |=  ($v1->a_SpndngCatId == $v2->a_SpndngCatId);
      if ( $flag ) break;
    }
    if ( !$flag ) array_push( $diff['id'], $v1->a_SpndngCatId ); //array_push( $diff['id'], $v1->a_SpndngCatId);
  }
$c = array_combine($diff['id'], $diff['name']);

    $i=0;*/
    $i=0; ?>
          </tbody>

          </table></div>


              <div ><span class="buttonWrap"><a href="" class="loadbtn bluebg">next</a></span>
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
              <div class="fix"></div>
            </div>
          </div>
          <div class="col">

          </div>
          <div class="formPreExp">
            <div class="col">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">
              <label>Max Report Mileage R</label>
              <input type="text" name="n_MaxRptMilage" id="n_MaxRptMilage" value="<?php echo $policyname->n_MaxRptMilage;?>" />
            </div>
            <div class="col">
              <label>Mileage Rate R</label>
              <input type="text" name="n_MilageRate" id="n_MilageRate" value="<?php echo $policyname->n_MilageRate;?>" />
            </div>
            <div class="col">
           <label>Per</label>
            <select name="n_PerMeasuremnt" id="n_PerMeasuremnt">
              <option value='1' <?php if($policyname->n_PerMeasuremnt==1){ echo 'selected="selected"';} ?> >min</option>
              <option value='2' <?php if($policyname->n_PerMeasuremnt==2){ echo 'selected="selected"';} ?> >hrs</option>
              <option value='3' <?php if($policyname->n_PerMeasuremnt==3){ echo 'selected="selected"';} ?> >weekly</option>
            </select>
            </div>

            <div class="col">
              <label>Max Expense Mileage R</label>
              <input type="text" name="n_MaxExpMil" id="n_MaxExpMil" value="<?php  echo $policyname->n_MaxExpMil;?>" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select name="b_IsGPSReq" id="b_IsGPSReq">
                <option value='1' <?php if($policyname->b_IsGPSReq==1){ echo 'selected="selected"';} ?>>Yes</option>
                <option value='0' <?php if($policyname->b_IsGPSReq==0){ echo 'selected="selected"';} ?>>No</option>
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
          <span class="buttonWrap"></span>





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
          <h2><?php echo $policyname->t_PolicyName;?></h2>
          <div class="fix"></div>
        </div>
        <div class="col">
          <label style="text-align:left;">Provide Spending Limits</label>
        </div>
        <div class="formPreExp">
          <div class="col">
          <input type="hidden" name="Third" id="Third">
            <label>Daily Spending Limit R</label>
            <input type="text" name="n_DailyExpLmt" value="<?php  echo $policyname->n_DailyExpLmt;?>" id="n_DailyExpLmt"/>
          </div>
          <div class="col">
            <label>Monthly Spending Limit R</label>
            <input type="text" name="n_MonthlyExpLmt" value="<?php  echo $policyname->n_MonthlyExpLmt;?>"  id="n_MonthlyExpLmt"/>
          </div>
          <div class="right_top"> <span class="buttonWrap"><a class="loadbtn bluebg peiod_spending" onclick="return ssapolicyspndlmt();">Save Peroid Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap"></span>

           <table id="" border="1" class="tblCategory1 tblCategor">
          <tbody>
          <tr> <th> Spending Cat</th> <th> GL Code</th></tr>
          <?php
             if($get_spcatglcode  !== 'Something Went Wrong'){
            foreach ($get_spcatglcode as $dcat_name) { ?>
          <tr> <td> <input type="text" name="" id="cat_<?php echo $dcat_name->a_SpndngCatId; ?>" readonly="readonly" value="<?php  echo $dcat_name->t_SpndName; ?>">  </td>

          <td> <span id="rem<?php echo $dcat_name->a_SpndngCatId; ?>"> <label onclick="return add_cat_glcod(<?php echo  $dcat_name->a_SpndngCatId; ?>);"><?php  echo $dcat_name->t_GLCode; ?></label></span>
          <span id="rem11<?php echo $dcat_name->a_SpndngCatId; ?>" > </span></td></tr>
          <?php  }  } else{
         echo "Record not found";

            } ?>
          </table>

<h2> Add more</h2>

          <span id="errormsg"></span>
<div class="formPreExp">
     <table border="1" id="tblCategory1" class="tblCategory1">
            <thead>
              <tr>
                <th>Category add</th><th>GLcode add</th>
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
      <div class="tabcontent" id="form4">
        <div class="right_top">
          <h2>Policy Name 1</h2>
          <span class="buttonWrap">
          <h2>Assigned</h2>
          </span>
          <div class="fix"></div>
        </div>
        <h2 class="genHead blue">Period Categories Restrictions</h2>
        <span id="msg"></span>
        <div class="Expenses policy">
          <table id="tblCategoryedit" border="1">
            <tr>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in <span class="WebRupee" >Rs</span>)</th>
              <th>Daily Limit(in <span class="WebRupee" >Rs</span>)</th>
              <th>Monthly Limit(in <span class="WebRupee" >Rs</span>)</th>
            </tr>
                    <tbody>

<?php 

 $i=0; 
    if(!empty($get_allcat)){
       foreach ($get_allcat as $key1 => $value1) {
           $n_SingleExpLmt='';
            $monthlyExpLmtMap='';
            $dailyExpLmtMap=''; 
 $class='on_button';
        ?>
        <tr>
            <td><input type="hidden" class="spncat" name="spncat[]" id="spncat<?php echo $i; ?>" value="<?php echo $value1->a_SpndngCatId; ?>" /></td>
            <td><input type="button" class="<?php echo $class; ?>" name="on" id="<?php echo $i; ?>" /></td>
            <td><?php   echo  $value1->t_SpndName; ?></td>

    <?php if(!empty($policy)){

        foreach ($policy as $key2 => $value2) {
          if($value1->a_SpndngCatId==$value2->a_SpndngCatId){
              $n_SingleExpLmt=$value2->n_SingleExpLmt;
              $monthlyExpLmtMap=$value2->n_MonthlyExpLmt;
              $dailyExpLmtMap=$value2->n_DailyExpLmt;
             $class='of_button'; 
               break;
          }

        }}

        ?>

            <td><input type="text" value="<?php echo $n_SingleExpLmt; ?>" class="sp_cat_single_exp_limit"name="sp_cat_single_exp_limit[]" id="sp_cat_single_exp_limit<?php echo $i; ?>" /></td>
            <td><input type="text" value="<?php echo $dailyExpLmtMap; ?>" class="sp_cat_single_daily_limit" name="sp_cat_single_daily_limit[]" id="sp_cat_single_daily_limit<?php echo $i; ?>" /></td>
            <td><input type="text" value="<?php echo $monthlyExpLmtMap; ?>" class="sp_cat_single_month_limit" name="sp_cat_single_month_limit[]" id="sp_cat_single_month_limit<?php echo $i; ?>" /></td>
      </tr> 
   <?php $i++; } 
    }else{echo "No result";}?>
    <tr></tr>
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

</body></html>