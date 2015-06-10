<section class="main_caintainer">
<div class="leftSide">
<div class="colL colL2">
<?php
//echo $this->session->userdata['roleAccess']['Reimburse'];
 //p($this->session->all_userdata()); ?>
<input type="text" name="empname" class="my_date" id="byempname" value="" placeholder="Search employee name" onkeyup="return repert_advanse_search();">
<!-- <select name="employee_name" id="employee_name">
                      <option value=''>Select An Employee Name</option>
                      <?php if(!empty($sideEmpName)){
                        foreach ($sideEmpName as $key => $value) { ?>
                      <option value="<?php echo $value->a_EmpId?>"><?php echo $value->t_EmpFirstName.' '.$value->t_EmpLastName?></option>
                   <?php  }}else{ echo "No Records Found";} ?>
                  </select> -->
<span class="iconsel" id="advancesearch"></span>

<span class="s_advansesearch">
<!-- <input type="text" name="empname" id="byempname" value="" placeholder="Search employee name" onkeyup="return reportby_businessid();"> -->

<Select id="report_status" onchange="return repert_advanse_search();">
<option value="">Select</option>
<option value="0">Submitted</option>
<?php if($this->session->userdata['roleAccess']['Reimburse']=='yes'){ ?>
<option value="1">Approved</option>
<?php }?>
</Select>
<input type="text" name="bubmited" id="b_submited" class="datepicker_all my_date" placeholder="Submited date" onblur="return repert_advanse_search();">
<p style="margin:0;"> By claim period</p>
<input type="text" name="from_claimperiod" id="from_claim" placeholder="From Claim period" class="datepicker_all my_date" onblur="return repert_advanse_search();">
<input type="text" name="to_claimperiod" id="to_claim" placeholder="To Claim period" class="datepicker_all my_date" onblur="return repert_advanse_search();">

</span>






</div>
<div id="noRecord">
<ul id="appendReport">
<?php 

if(isset($myaccess)) {
   foreach ($myaccess as $key => $valueaccess) {
       $assignrole[]  = $valueaccess->n_RoleAccessId;
       $amountrange[] = $valueaccess->n_AmtRange;
   }
   } else
   {
      $assignrole='';
      $amountrange='';
   } ?>

<?php
//p($assignrole);
//p($sideReport);


 if(!empty($sideReport)){
  if(in_array(5, $assignrole))
  { //print_r($sideReport);
    //echo "1";
  foreach ($sideReport as $key1 => $value1) {

      $amnt= $amountrange[0];
//echo "2";
    if( $value1->n_AmountReq<=$amnt or $amnt=="-1")
    { //echo "3";

      if( $value1->b_Approved==1 )
      {
        //echo "4";
         if(in_array(8, $assignrole))
         { 

         // echo "5";
          ?>


<li class="colL2"><h5><a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_DeptId;?>"><?php echo $value1->t_ReportName; ?></a></h5>
<span class="date"><?php echo date('d M, Y', strtotime($value1->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value1->d_ClaimTo)); ?></span> 
<span class="price"><span class="WebRupee">Rs</span> <?php echo $value1->n_AmountReq; ?></span>
<h4 class="colour"><?php echo $value1->t_EmpFirstName.' '.$value1->t_EmpLastName; ?>
<?php if($value1->b_IsVoilated==1){?>
<span class="iconerror"></span></h4>
<?php }?>
<span class="submitt">Approved<small><?php echo date('d M, Y', strtotime($value1->d_CreatedOn)); ?></small></span>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_DeptId;?>" class="aprove">Reimburse</a></li>
<?php    }
       }
       else {
        /*echo "6";*/
    ?>
<li class="colL2"><h5><a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_DeptId;?>"><?php echo $value1->t_ReportName; ?></a></h5>
<span class="date"><?php echo date('d M, Y', strtotime($value1->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value1->d_ClaimTo)); ?></span> 
<span class="price"><span class="WebRupee">Rs</span> <?php echo $value1->n_AmountReq; ?></span>
<h4 class="colour"><?php echo $value1->t_EmpFirstName.' '.$value1->t_EmpLastName; ?>
<?php if($value1->b_IsVoilated==1){?>
<span  rel="popover" title="click on"  class="iconerror" onclick="return vilation_show(<?php echo $value1->a_ReportId ?>)"></span></h4>
<ul id="vilation<?php echo $value1->a_ReportId ?>" class="reportshow" ></ul>
<?php }?>
<span class="submitt">Submitted<small><?php echo date('d M, Y', strtotime($value1->d_submitedon)); ?></small></span>
<a href="<?php echo base_url();?>business/dashboard/detailReports/<?php echo $value1->a_ReportId;?>/<?php echo $value1->n_DeptId;?>" class="aprove">approve</a></li>
<?php  }  }
//sheetesh
}
}
}




else{ echo "No Records Found";} ?>
 </ul>
 </div>
 <?php echo $this->session->flashdata('message');?>
</div>
<?php  //$this->load->view('layout/footer2'); ?>
</section>
<div class="fix"></div>
<script type="text/javascript">
function repert_advanse_search(){
 // var searchValue=$("#employee_name").val();
  var empname = $('#byempname').val();
var status = $('#report_status').val();
var b_submited = $('#b_submited').val();
var to_claim = $('#to_claim').val();
var from_claim = $('#from_claim').val();
 /* console.log(searchValue);
  if(searchValue!=''){
    searchValue=searchValue;
  }else{
      //console.log("hi");
      // console.log(searchValue);
      searchValue="";
    }*/
  
    $.ajax({
        url: "<?php echo base_url();?>business/dashboard/searchReport_advanse",
        type: 'POST',
        data: {'act_mode':'by_business','empname':empname,'status':status,'b_submited':b_submited ,'to_claim':to_claim ,'from_claim':from_claim },
        async: true,
        dataType: "json",
        success: function (data) {
              console.log(data);
              $('#appendReport li').remove();
            if(data!=null){

              // $("#appendReport").empty(); 
		        $.each(data,function (index,value){
		            var listReport="<li class=colL2><h5>";
		                listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+">"+value.t_ReportName+"</a>";
		                listReport+="</h5>";
		                listReport+="<span class='date'>"+value.d_ClaimFrom+"- "+value.d_ClaimTo+"</span>";
		                listReport+="<span class='price'><span class='WebRupee'>Rs</span>"+value.n_AmountReq+"</span>";
		                listReport+="<h4 class=colour>"+value.t_EmpFirstName+" "+value.t_EmpLastName;
                    if(value.b_IsVoilated==1){
                      listReport+="<span class='iconerror'></span>";
                    }
                    listReport+="</h4>";
		                listReport+="<span class='submitt'>Submitted<small>"+value.d_submitedon+"</small></span>";
		                listReport+="<a href=<?php echo base_url(); ?>business/dashboard/detailReports/"+value.a_ReportId+" class='aprove'>approve</a></li>";

		            $("#appendReport").append(listReport);
		          });
		    }else{

          var list ="<li>Sorry No Report found</li>";
		      $("#appendReport").append(list);
		    }

        }
    });
}




function vilation_show(id){
  alert('dfhjksh');
    $.ajax({
        url:'<?php echo base_url();?>business/dashboard/get_vilation',
        type:'POST',
        dataType:'json',
        data:{'n_ReportId':id},
        success:function(data){

   $.each(data, function(index, val) {
    $("#vilation"+id).empty();
              var display ="<li>"+val.scat+"."+val.voi+"</li>";
              $("#vilation"+id).append(display);
         });
         }
      });

}








$(document).ready(function(){

$( ".iconerror" ).mouseover(function() {
  $(".reportshow" ).show();
});
$( ".iconerror" ).mouseout(function() {
  $(".reportshow" ).hide();
});



  $('.s_advansesearch').hide();
  $("#advancesearch").click(function(){
 $('#report_status').val('');
 $('#b_submited').val('');
 $('#to_claim').val('');
 $('#from_claim').val('');
    $('.s_advansesearch').toggle();
  });
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/core.js"></script>
</body>
</html>
