<section class="main_caintainer">
<script type="text/javascript" src="<?php echo base_url(); ?>assects/js/business_search_sheetesh.js"></script>

<?php $data = checklogin(); ?>
<div class="leftSide" style="height: 0px;">
<div class="colL">
	<!-- <select name="businesslisting" id="businesslisting" onchange="return searchEmpbus();"> -->
	<select name="businesslisting" id="businesslisting" onchange="return reportby_businessid();">

			<option value="-1">Select Business</option>
			<?php foreach ($business as $value) {  ?>
			<option value="<?php echo $value->a_BusinessId; ?>"> <?php echo $value->t_BusinessName; ?></option>
		<?php } ?>
			</select>
			<span class="iconsel" id="advancesearch"></span>

<span class="s_advansesearch">
<input type="text" name="empname" class="my_date" id="byempname" value="" placeholder="Search by employee name" onkeyup="return reportby_businessid();">

<Select id="report_status" onchange="return reportby_businessid();">
<option value="">Select</option>
<option value="0">Submitted</option>
<option value="1">Approved</option>
</Select>
<input type="text" name="bubmited" id="b_submited" class="datepicker_all my_date" placeholder="Search by Submitted date" onblur="return reportby_businessid();">
<p style="margin:0; padding:0;">Search By claim period</p>
<input type="text" name="from_claimperiod" id="from_claim" placeholder="From Claim period" class="datepicker_all my_date" onblur="return reportby_businessid();">
<input type="text" name="to_claimperiod" id="to_claim" placeholder="To Claim period" class="datepicker_all my_date" onblur="return reportby_businessid();">

</span>
 <!-- <select name="employeelisting" id="employeelisting" onchange="return searchEmpReportsssa();">
	<option>Select Employee</option>
    </select> -->
    </div>
   <div id="noRecord">
      <ul id="appendReport1">
				<?php
				if($response =='Something Went Wrong'){
				echo "Record not found";
				}
				else{
				foreach ($response as $key => $value){
				?>
				<li class="colL2"  onclick="return reportload(<?php echo $value->a_ReportId; ?>,<?php echo $value->n_BusinessId; ?>,<?php echo $value->n_DeptId; ?>,<?php echo $value->n_CreatedBy; ?>,<?php echo $value->n_PolicyId; ?>);">
				 <h5><?php echo $value->t_ReportName; ?></h5>

        <span class="date"><?php
                         $dClaimFrom = date('d m Y', strtotime($value->d_ClaimFrom));
           echo $dClaimFrom; ?> - <?php
                     $d_ClaimTo = date('d m Y', strtotime($value->d_ClaimTo));
           echo $d_ClaimTo; ?></span>


          <span class="price"><span class="WebRupee">Rs</span><?php echo $value->n_AmountReq; ?></span>
                   <h4 class="colour"><?php echo $value->t_EmpFirstName.' '.$value->t_EmpLastName; ?></h4>
                  <?php   if($value->b_IsVoilated==1){ ?>
                      <span class='iconerror'></span>
                   <?php } ?>
                   </h4>
                  <span class='submitt'>Submitted<small><?php  $createdon=  date('d/ m/ Y', strtotime($value->d_submitedon)); 
                echo  $createdon; ?></small></span>
               <?php   if($value->b_IsVoilated==0){ ?>
                    <a class='aprove'>Reimbursed</a></li>
                <?php  }
                  else{ ?>
                <a class='aprove'>approve</a></li>
                <?php  } ?>



					<?php
					}
					}
                 ?>
          </ul>
    </div>
 </div>
    <div class="rightSide" id="loadreport">
    <div class="right_top">
    	<span class="buttonWrap">
<div class="fix"></div></div>
    </div>
</section>
<div class="fix"></div>
<script type="text/javascript">

function reportby_businessid(){
var businessid = $('#businesslisting').val();
var empname = $('#byempname').val();
var status = $('#report_status').val();
var b_submited = $('#b_submited').val();
var to_claim = $('#to_claim').val();
var from_claim = $('#from_claim').val();

var list='';
var Mybase_url = base_url();
$.ajax({
          url: Mybase_url+'ssa/claimreport/claimreport_search/',
          type:'POST',
          dataType:'json',
          data: {'act_mode':'by_business','businessid':businessid,'empname':empname,'status':status,'b_submited':b_submited ,'to_claim':to_claim ,'from_claim':from_claim },
          success: function(data){
           $('#appendReport1 li').remove();

          if(data !="null")
          {
    $.each(data,function (index,value){
 var listReport="<li  onclick='return reportload("+value.a_ReportId+","+value.n_BusinessId+","+value.n_DeptId+","+value.n_CreatedBy+","+value.n_PolicyId+");' class=colL2><h5>";
                    listReport+="<a>"+value.t_ReportName+"</a>";
                    listReport+="</h5>";
                    listReport+="<span class='date'>"+value.d_ClaimFrom+"- "+value.d_ClaimTo+"</span>";
                    listReport+="<span class='price'><span class='WebRupee'>Rs</span>"+value.n_AmountReq+"</span>";
                    listReport+="<h4 class=colour>"+value.t_EmpFirstName+" "+value.t_EmpLastName;
                    if(value.b_IsVoilated==1){
                      listReport+="<span class='iconerror'></span>";
                    }
                    listReport+="</h4>";
                    listReport+="<span class='submitt'>Submitted<small>"+value.d_submitedon+"</small></span>";
                    if(value.b_Approved==1){
                    listReport+="<a class='aprove'>Reimbursed</a></li>";
                    }
                    else{
                   listReport+="<a class='aprove'>Aprove</a></li>";
                    }

           //console.log(listReport);
           $('#appendReport1').append(listReport);
            });
        }
        else
        {
          alert('reach3');
 var list = "<li>Sorry No Report</li>";
          $('#appendReport1').append(list);
        }
          }
      });
    }

$(document).ready(function() {
var getVal =$("#businesslisting option:selected").val();
				if(getVal==-1){
					$("#employeelisting").hide();
                }
				else{
                 $("#employeelisting").show();

				}
});
$(document).ready(function(){
	$('.s_advansesearch').hide();
  $("#advancesearch").click(function(){
    $('#byempname').val('');
 $('#report_status').val('');
 $('#b_submited').val('');
 $('#to_claim').val('');
 $('#from_claim').val('');
    $('.s_advansesearch').toggle();
  });
});



</script>
