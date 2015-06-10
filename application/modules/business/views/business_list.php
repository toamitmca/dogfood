<?php
$sessionVar = $this->session->userdata('roleAccess');
$editAdmin=$sessionVar['Manage Admins'];
 ?>
 
 
<section class="main_caintainer">
	<div class="leftSide" >
     <ul class="leftmenu colL colL2">
	<input type="text" name="search_name" placeholder=" Search Business Admins" id="search_name">
    <span class="iconsel"></span>
    </ul>
		<ul class="leftmenu" id="leftSide">
				<span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
				<?php if(!empty($side)){
					foreach ($side as $key3 => $value3) {			
					
					 if( $value3->a_BusnAdminId !== $current_user_id)  {
   ?>
					
					<li><a href="<?php echo base_url(); ?>business/dashboard/editbabapanel/<?php echo $value3->a_BusnAdminId; ?>" class="" ><?php echo $value3->t_FirstName.' '.$value3->t_LastName ;?></a></li>
			<?php } } }else{ echo "No records Founds"; }?>
		</ul>
	</div>
<div class="rightSide">
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url(); ?>business/dashboard/admin/" class="loadbtn bluebg">Add Admin</a>
		</span>
		<div class="right_top">
			<h2>Business Admin Listing</h2>
			<span class="buttonWrap"></span>
		    <div class="fix"></div>
		</div>
	</div>
<span class="message">
	<?php 
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
</span>
<div class="Expenses">
	<table border="1" style="width:100%;">
    <tbody>
    <tr>
    	<th>&nbsp;&nbsp;</th>
    	<th>Full Name</th>
    	<th>Email Id</th>
    	<th>Created On</th>
    	<th>Status</th>
    	<th></th>
    </tr>
   <?php 
    $i=1;
    if(!empty($list)){
    foreach ($list as $key => $value) {
     if( $value->a_BusnAdminId !== $current_user_id)  {
   ?>
   <tr>
    <td><?php echo $i;?></td>
	<td><a href="<?php  echo base_url();?>business/dashboard/editbabapanel/<?php echo $value->a_BusnAdminId;?>"><?php echo $value->t_FirstName.' '.$value->t_LastName;?></a></td>
    <td><a href="<?php  echo base_url();?>business/dashboard/editbabapanel/<?php echo $value->a_BusnAdminId;?>"><?php echo $value->t_Email; ?></a></td>
    <td><?php echo $value->d_CreatedOn; ?></td>
    <td><?php if($value->b_Status==0) { echo "Blocked"; } else { echo "Open"; } ?>
</td>
    <td>
    	<a class="edit" href="<?php echo base_url();?>business/dashboard/editbabapanel/<?php echo $value->a_BusnAdminId; ?>"></a>
    	<a class="alert" href="<?php echo base_url();?>business/dashboard/delete_employee/<?php echo $value->a_BusnAdminId; ?>"></a>
<?php if($value->b_Status==0) { ?>
      <a class="active_button " href="<?php echo base_url();?>business/dashboard/activateBusinessAdmin/<?php echo $value->a_BusnAdminId; ?>">Open</a>
      <?php } else { ?>
      <a class="inactive " href="<?php echo base_url();?>business/dashboard/inactivateBusinessAdmin/<?php echo $value->a_BusnAdminId; ?>">Blocked</a>
      <?php } ?>
    </td>
  </tr>
  <?php  $i++; }  }


		}else{
      echo "No records Found";
    }
  ?>


</tbody>
</table>
	</div>
</div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">

$(document).ready(function(){

  var access="<?php echo $editAdmin; ?>";
  console.log(access);
  if(access=="No"){
   $(".edit").hide();
   $(".active_button").hide();
   $(".inactive").hide();
   $(".loadbtn").hide();
  }
  
});


$("#search_name").on('keyup',function(){
	var searchValue=$("#search_name").val();
	//console.log(searchValue);
	if(searchValue!=''){
		searchValue=searchValue;
	}else{
			console.log("hi");
			// console.log(searchValue);
			searchValue="";
		}
		$("#myloading").css('display','block');
		$.ajax({
			  url: "<?php echo base_url();?>business/dashboard/searchBusName",
			  type: 'POST',
			  data: { name : searchValue },
			  async: true,
	    	  dataType: "json",
			  success: function (data) {
			  	$("#myloading").css('display','none');
	        	  console.log(data);
	        	if(data!=null){  
	        	   $("#leftSide").empty();
					$.each(data,function (index,value){
						var list ="<li>";
							list +="<a href=<?php echo base_url(); ?>business/dashboard/editbabapanel/"+value.a_BusnAdminId+">"+value.t_FirstName+' '+value.t_LastName+"</a>";
							list +="</li>";
						$("#leftSide").append(list);
					});
				}else{
				    $("#leftSide").html('<p>No Result Found</p>');
				     }
				    
				}
		    });
});
</script>
</body>
</html>
