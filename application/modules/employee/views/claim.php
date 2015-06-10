<section class="main_caintainer">
<?php $data = checklogin(); ?>
<div class="leftSide" style="height: 0px;">
<div class="colL">
	<input type="text" name="byname1" id="byname" placeholder="Search by Report Name" onkeyup="return emprttbystatus();">
    <span class="iconsel" id="advancesearch"></span>

<select  name="status" id="status" onchange="return emprttbystatus();" class="s_advansesearch">
         <option value=""> Select Status</option>
        <option value="save">Save</option>
        <option value="submit">Submit</option>
        <option value="reject">Reject</option>
        <option value="Reimbursed">Reimbursed</option>
     </select>
    

<!---<input type="text" name="submitdate" id="submitdateid" class="datepicker_all s_advansesearch"  onblur="return emprttbystatus();" placeholder="Search by Submission Date" >-->
<span id="claim_periad" class="s_advansesearch"> <br/><label>Search by Claim Period</label>
<input type="text" name="fromclaim" id="fromclaimid" class="datepicker_all" onblur="return emprttbystatus();"  placeholder="claim from">
<input type="text" name="toclaim" id="toclaimid"  class="datepicker_all" onblur="return emprttbystatus();"  placeholder="claim to">
 </span>
</div>
<div id="noRecord">
<ul id="claimrpt">
<?php
	if($response == 'Something Went Wrong'){
		echo "Record not found";
	}else{


		foreach ($response as $key => $value) {
?>
<?php
		if($value->n_status =='save'){
       $status =1;
			$myval ="Saved";
		}elseif($value->n_status =='Reject'){
			$myval = "Rejected";
      $status =2;
		}elseif($value->n_status =='submit'){
			$myval ="Submitted";
      $status =3;
		}
		elseif($value->n_status =='Reimbursed'){
			$myval ="Reimbursed";
      $status =4;
		}
		///wire frame admin  Reimbursed
?>
<li> <div class="colL2">
<a href="<?php echo base_url(); ?>employee/dashboard2/editclaimhello/<?php echo $value->a_ReportId;?>/<?php echo $status; ?>"><h5><?php echo $value->t_ReportName; ?></h5>
<span class="date"><?php echo date('d M, Y', strtotime($value->d_ClaimFrom)); ?> - <?php echo date('d M, Y', strtotime($value->d_ClaimTo)); ?></span> 
<span class="price"><span class="WebRupee">Rs</span><?php echo $value->n_AmountReq; ?></span>
<h4><?php echo $data['firstname'].' '.$data['t_EmpLastName']; ?></h4>
<span class="submitt">
<?php echo strtoupper($myval); ?>

<small><?php if($myval=='Submitted') { echo date('d M, Y', strtotime($value->d_submitedon)); } else { echo date('d M, Y', strtotime($value->d_CreatedOn)); }?> </small>
</span>

<?php if($myval=='Saved') { ?>
<P class="aprove">SUBMITTED</P></a>
</div>

<?php } ?>
</li>
<?php
	}
}

?>
 </ul>
 </div>
 </div>
    <div class="rightSide">
    <div class="right_top">
    	<span class="buttonWrap">
    		<a class="loadbtn bluebg" href="<?php base_url();?>dashboard2/reportfirst2/">Add Claim Report</a></span>
<div class="fix"></div></div>
<div class="innerReport">
<div id="loadreport">


</div>
</div>



    </div>
</section>
<div class="fix"></div>
<script type="text/javascript">


/*Rahul yadav 12/12/2014 report search employee start */

function emprttbystatus(){
console.log('hi');

 var name =$('#byname').val();
 var status = $('#status').val();
 //alert(status);
var b_submit = $('#submitdateid').val();
 var claimfrom = $('#fromclaimid').val();
var claimto=$('#toclaimid').val();

$.ajax({
	url: "<?php echo base_url(); ?>employee/emprptsearch",
	type: 'POST',
	dataType: 'json',
	data: {'act_mode':'bystatus','name':name ,'status':status ,'b_submit':b_submit,'claimfrom':claimfrom,'claimto':claimto },
     success: function(data){
      
        console.log(data);
$('#claimrpt li').remove();
if(data=="Something Went Wrong"){
 var display ="<li><td>Record Not Found </td></li>";
 $('#claimrpt').append(display);
}
else{
 $.each(data, function(index, value) {
  var url ="<?php echo base_url();?>";
 var fname ="<?php echo $data['firstname'];?>";
 var lname ="<?php $data['t_EmpLastName'];?>";


var from = value.d_ClaimFrom.substr(0,10);
     var foryer= value.d_ClaimFrom.substr(0,4);
     var formonth= value.d_ClaimFrom.substr(5,2);
     var formdat= value.d_ClaimFrom.substr(8,2);

    var toyer= value.d_ClaimTo.substr(0,4);
    var tomonth= value.d_ClaimTo.substr(5,2);
    var tomdat= value.d_ClaimTo.substr(8,2);

    var createdyer= value.d_submitedon.substr(0,4);
    var createdmonth= value.d_submitedon.substr(5,2);
    var createdmdat= value.d_submitedon.substr(8,2);




 if(value.n_status =='save'){
  var status =1;
		 var	myval ="Saved";
		} if(value.n_status =='Reject'){
		var	myval = "Rejected";
    var status =1;
		}if(value.n_status =='submit'){
	    var	myval ="Submitted";
      var status =3;
		}
		if(value.n_status =='Reimbursed'){
		 var myval ="Reimbursed";
     var status =4;
		}
     var app="<li onclick='return reportaper("+value.a_ReportId+","+status+");'><div class=colL2>";
         app+="<h5>"+value.t_ReportName+"</a></h5>";
        app+="<span class='date'>"+formdat+"/"+formonth+"/"+foryer+" - "+tomdat+"/"+tomonth+"/"+toyer+"</span>";
        app+="<span class=price><span class=WebRupee>Rs</span>"+value.n_AmountReq+"</span>";
        app+="<h4>"+fname+"-"+lname+"</h4>";
        app+="<span class=submitt>"+myval+"";
        app+="<small>"+createdmdat+"/"+createdmonth+"/"+createdyer+"</small></span>";
        app+="<p class=aprove>"+myval+"</p></div></li>";

   $('#claimrpt').append(app);

});
 }
    }
});
}
$(document).ready(function() {
            $("#option").change(function(){
                var getVal =$(this).find("option:selected").val();
				if(getVal=='1'){
					$(".none").hide();
                    $("#ststus").show();
                }
				else{

					}
				if(getVal=='2'){
					$(".none").hide();
                    $("#submitdateid").show();
                }
			//	else{}
				if(getVal=='3'){
					$(".none").hide();
                    $("#claim_periad").show();
                }
				else{
					}
					if(getVal=='0'){
					$(".none").hide();
                }
            });
    });


function reportaper(reportid,sdata){
  var sdata=sdata;
//console.log(reportid);
var myurl ="<?php echo base_url();?>";

                   $.ajax({
                   url: myurl+'employee/dashboard2/editclaim/',
                    type:'POST',
                    data: {'reportid':reportid ,'sdata':sdata },
                    success: function(data1){
                    console.log(data1);
                   $('#loadreport').html(data1);
                    }
                    });
}
$(document).ready(function(){
    $('.s_advansesearch').hide();
  $("#advancesearch").click(function(){
    $('#byname').val('');
     $('#status').val('');
 $('#submitdateid').val('');
 $('#fromclaimid').val('');
 $('#toclaimid').val('');
    $('.s_advansesearch').toggle();
  });
});


</script>
</body>
</html>
