<section class="main_caintainer">
  <?php  $this->load->view('leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">


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
            <h2>Policy Name:
              	<?php echo $policyname->t_PolicyName;?>
            </h2>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp formPreE">
         <div class="col">
         <input type="hidden" name="n_id" id="BusinessId22222" value="<?php echo $policyname->n_BusinessId; ?>">
          <?php //p($business); ?>
       <p>     <span>Business Name :</span>
<label> <?php foreach ($business as  $value): ?>
 <?php if($value->a_BusinessId === $policyname->n_BusinessId) { echo $value->t_BusinessName;} ?>
<?php endforeach ?></label></p>

          </div>
          <div class="col">
            <p><span>Max Report Amount R :</span>
          <label><?php echo $policyname->n_MaxRptAmt;?></label></p>
          </div>
          <div class="col">
           <p><span>Report Due By : </span><label><?php echo $policyname->d_RptDueDt; ?> <?php echo $policyname->d_RptDueDt; ?> </label></p>
            
            <!-- <select name="d_RptDueDt1" style="width:15%;display:inline-block;float:right;" id="d_RptDueDt1">
              <option value='0' <?php // if($policyname->d_RptDueDt =='0'){ echo 'selected="selected"';} ?> >0</option>
              <option value='1' <?php //if($policyname->d_RptDueDt =='1'){ echo 'selected="selected"';} ?> >1</option>
              <option value='2' <?php //if($policyname->d_RptDueDt =='2'){ echo 'selected="selected"';} ?> >2</option>
              <option value='3' <?php //if($policyname->d_RptDueDt =='3'){ echo 'selected="selected"';} ?> >3</option>
              <option value='4' <?php //if($policyname->d_RptDueDt =='4'){ echo 'selected="selected"';} ?> >4</option>
              <option value='5' <?php //if($policyname->d_RptDueDt =='5'){ echo 'selected="selected"';} ?> >5</option>
              <option value='6' <?php //if($policyname->d_RptDueDt =='6'){ echo 'selected="selected"';} ?> >6</option>
            </select> -->
          </div>
          <div class="col">
            <p><span>Max Expense Amount R :</span> <label><?php echo $policyname->n_MaxExpAmt;?></label></p>

          </div>
          <div class="col">
          <p><span>Cash Advance Allowed :</span>
          <label><?php if($policyname->d_RptDueDt =='1'){ echo 'Yes';} ?>
              <?php if($policyname->d_RptDueDt =='0'){ echo 'No';} ?><label></p>
          </div>
          <div class="col">
            <p><span>Receipt Required :</span>
            <label>
              <?php if($policyname->b_RecpReq =='1'){ echo 'Yes';} ?>
              <?php if($policyname->b_RecpReq =='0'){ echo 'No';} ?>
           </label></p>
          </div>
          <div class="col">
            <p><span>Above R :</span>
            <label><?php echo $policyname->n_AboveAmt;?></label></p>
          </div>
          <div class="col">
          <p><span>Flag Expense submitted :</span>
          <label><?php echo $policyname->t_flagExpSubmitted;?></label>
          </div>
          <div class="col">
            <p><span>days after expense incurred :</span>
            <label></label></p>
          </div>

          <div class="right_top">
          	<span class="buttonWrap">

            	<!-- <a class="loadbtn bluebg myloading" id="saveGeneral" > Next</a> -->
            </span>
            <div class="fix"></div>
          </div>

          <div class="right_top">
            <h2>Mileage</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><!-- <span class="buttonWrap"><a href="" class="loadbtn bluebg "> Mileage</a> --></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
          <div class="right_top">
            <h2>Period Spending Limits</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><!-- <span class="buttonWrap"><a href="" class="loadbtn bluebg"> Period Limits</a> --></span>
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


              <div ><!-- <span class="buttonWrap"><a href="" class="loadbtn bluebg">next</a> --></span>
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
          <div class="formPreExp formPreE">
            <div class="col">
              <input type="hidden" name="Second" id="Second">
              <input type="hidden" name="lastId" id="lastId" value="">
              <p><span>Max Report Mileage R :</span>
              <label><?php echo $policyname->n_MaxRptMilage;?></label></p>
            </div>
            <div class="col">
            <p><span>Mileage Rate R :</span>
              <label><?php echo $policyname->n_MilageRate;?></label></p>
            </div>
            <div class="col">
         <p> <span>Per :</span>
            
              <label><?php if($policyname->n_PerMeasuremnt==1){ echo 'min';} ?> 
            <?php if($policyname->n_PerMeasuremnt==2){ echo 'hrs';} ?> 
             <?php if($policyname->n_PerMeasuremnt==3){ echo 'weekly';} ?> </label></p>
            </div>

            <div class="col">
             <p><span>Max Expense Mileage R :</span>
              <label><?php  echo $policyname->n_MaxExpMil;?></label></p>
            </div>
            <div class="col">
              <p><span>GPS Stamp Requird : </span>
              
                <label><?php if($policyname->b_IsGPSReq==1){ echo 'Yes';} ?>
                 <?php if($policyname->b_IsGPSReq==0){ echo 'No';} ?>
                 </label></p>
              
            </div>
            <div> <span class="buttonWrap"><!-- <a class="loadbtn bluebg mileage" >Peroid Limits</a> --></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Period Spending Limits</h2>
          <span class="buttonWrap"></span>
          <div class="formPreExp formPreE">
            <div><span class="buttonWrap"><!-- <a href="" class="loadbtn bluebg peiod_spending"> Period Limits</a> --></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap"></span>





          <div class="formPreExp">
            <div><span class="buttonWrap"><!-- <a href="" class="loadbtn bluebg">Categories Restriction</a> --></span>
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
          <p><span>Daily Spending Limit R :</span>
            <label><?php  echo $policyname->n_DailyExpLmt;?></label></p>
          </div>
          <div class="col">
          <p><span>Monthly Spending Limit R :</span>
          <label><?php  echo $policyname->n_MonthlyExpLmt;?></label></p>
          </div>
          <div class="right_top"> <span class="buttonWrap"><!-- <a class="loadbtn bluebg peiod_spending" onclick="return ssapolicyspndlmt();">Save Peroid Limits</a> --></span>
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




<!-- end add more -->
          <div class="formPreExp">
            <div><span class="buttonWrap"><!-- <a href="" class="loadbtn bluebg" >Categories Restriction</a> --></span>
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
        <div class="Expenses policy">
          <table id="tblCategoryedit" border="1">
            <tr>
              <th>&nbsp;</th>
             <!--  <th>&nbsp;</th> -->
              <th>Spending Categories</th>
              <th>Single Expenses Limit (in <span class="WebRupee" >Rs</span>)</th>
              <th>Daily Limit(in <span class="WebRupee" >Rs</span>)</th>
              <th>Monthly Limit(in <span class="WebRupee" >Rs</span>)</th>
            </tr>
                    <tbody>



<?php  $i=0; 

//p($get_allcat);
//p($policy);
//exit;

    if(!empty($get_allcat)){
       foreach ($policy as  $value1) { ?>
        <tr>
            <td><input type="hidden" class="spncat" name="spncat[]" id="spncat<?php echo $i; ?>" value="<?php echo $value1->a_SpndngCatId; ?>" /></td>
            <!-- <td><input type="button" class="on_button" name="on" id="<?php // echo $i; ?>" /></td> -->
               <td><?php   echo  $value1->t_SpndName; ?></td>

            <td><?php echo $value1->n_SingleExpLmt; ?></td>
            <td><?php echo $value1->n_DailyExpLmt; ?></td>
            <td><?php echo $value1->n_MonthlyExpLmt; ?></td>
      </tr> 
   <?php $i++; } }
    else{echo "No result";}?>
          </tbody>
          </table>






          <div class="buttonWrapInner"><!-- <a class="loadbtn bluebg cat_restriction" > Categories Restrictions</a> -->
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