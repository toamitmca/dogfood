<section class="main_caintainer">
<div class="leftSide">
<ul class="leftmenu">

<?php



foreach ($policyasign as $key ) {
$saign[]=$key->n_PolicyId;
}
//p($saign);
 //exit; ?>
<?php if($policyList !=="Something Went Wrong"){ 
	foreach ($policyList as $key => $policyList1) { ?>
<?php	if( $policyList1->d_ModifiedOn !=="0000-00-00 00:00:00"){ ?>
	<label style="font-size:12px;margin:12px;">Last Updated<?php echo date('d M, Y', strtotime($policyList1->d_ModifiedOn))."by ".$policyList1->t_name;?></label>
<?php }?>


	<li><div class="right_top"><a href="<?php echo base_url(); ?>business/dashboard/editPolicy/<?php echo $policyList1->a_PolicyId; ?>">

<?php
if(!empty($saign)){

if (in_array($policyList1->a_PolicyId , $saign)) { ?>
   <span class="buttonWrap">Assigned</span>
<?php }
}
?>
<h2><?php echo $policyList1->t_PolicyName; ?></h2></a></div>
</li>
<?php 	}
}else{ ?>
<a href="<?php echo base_url(); ?>business/dashboard/policyadd" class="loadbtn bluebg"> Add New Policy</a>
<?php	}?>
</ul>
</div>
<div class="rightSide"><div class="formPreExp">
<span class="buttonWrap"><a href=" <?php echo base_url(); ?>business/dashboard/policyadd" class="loadbtn bluebg">New Policy</a></span>



<div class="right_top">
			<h2>Policy Listing</h2>
		    <div class="fix"></div></div>


<div class="Expenses">
<span id="pmsg"></span>
<table border="1" style="width:100%;" id="plist">
<tbody>
<tr><th>Sr.No</th><th style="width:135px;">Policy Name</th> <th>Created on </th> <th>Action</th></tr>
<?php
if(($policyList !=="Something Went Wrong")){
 $i=1;
foreach ($policyList as  $value) {?>
<tr id="plidttr<?php echo $value->a_PolicyId;  ?>">
<td><a href="<?php echo base_url(); ?>business/dashboard/editPolicy/<?php echo $value->a_PolicyId; ?>"><?php echo $i; ?></a></td>
<td><a href="<?php echo base_url(); ?>business/dashboard/editPolicy/<?php echo $value->a_PolicyId; ?>">
<?php echo $value->t_PolicyName; ?></a></td> 

<td><a href="<?php echo base_url(); ?>business/dashboard/editPolicy/<?php echo $value->a_PolicyId; ?>">
<?php echo  date("d M,Y", strtotime($value->d_CreatedOn));?></a></td>
<td>
<!-- <a href="<?php echo base_url(); ?>business/dashboard/editPolicy/<?php echo $value->a_PolicyId; ?>" class="edit" for="atthFile"></a> -->
         <p name="delete" onclick="return ssapolicydeleteeditbus(<?php echo $value->a_PolicyId;  ?>);" class="del alert" ></p>
</td> 
</tr>
<?php $i=$i+1; } }
else{
echo 'Record not found';
}
  ?>
</tbody>
</table>
</div>
</div>
</section>
<div class="fix"></div>
</div>
</div>
<!-- For policy Delete- Created by Rahul Yadav 16/12/2014 -->

<script type="text/javascript">


function ssapolicydeleteeditbus(id){

               var Mybase_url = "<?php  echo base_url();?>";
                   $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicydelete/',
                    dataType:'json',
                    type:'POST',
                    data: {'policyid':id },
                    success: function(data1){
                    console.log(data1);
                    if(data1=="Reimbursed"){
                    console.log(id);
                    ssapolicydelbus(id);
                  $("#plidttr"+id).remove();
            }
            else{
          $('#pmsg').html('This policy not delette');
            }
                    }
                    });



}
function ssapolicydelbus(id){

var Mybase_url="<?php  echo base_url();?>";
                   $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicydel/',
                    dataType:'json',
                    type:'POST',
                    data: {'policyid':id },
                    success: function(data1){
                    console.log(data1);
                  //  ssapolicydel(id);
                    }
                    });

}
</script>
</body>
</html>
