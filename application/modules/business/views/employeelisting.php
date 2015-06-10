<?php 
$sessionVar = $this->session->userdata('roleAccess');
// p($sessionVar);
// exit();
$editEmployee=$sessionVar['Manage Employees'];
?>
<section class="main_caintainer">
 <div class="leftSide" >
   <ul class="leftmenu colL colL2">
  <input type="text" name="search_name" placeholder="---Employee Name---" id="search_name">
  <span class="iconsel"></span>
  </ul>
   <ul class="leftmenu" id="leftSide">
        <span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
        <?php if(!empty($side)){?>
        <?php foreach ($side as $key3 => $value3) {?>
          <li><a href="<?php echo base_url(); ?>business/dashboard/edit_employee/<?php echo $value3->a_EmpId; ?>" class="" ><?php echo $value3->t_EmpFirstName.' '.$value3->t_EmpLastName ;?></a></li>
      <?php }}else{
        echo "No records found"; 
        } ?>
    </ul>
  </div>
<div class="rightSide">
<span class="buttonWrap"><a href="<?php echo base_url(); ?>business/dashboard/add_employee/" class="loadbtn bluebg newbtn">Add New Employee</a></span>
	<div class="right_top">
			<h2>Employee Listing</h2>
			<span class="buttonWrap"></span>
		    <div class="fix">
	</div>
</div>
<?php 
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>

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
    if(!empty($side)){
    foreach ($side as $key => $value) {
      
   ?>
   <tr>
    <td><?php echo $i;?></td>
	<td><a href="<?php  echo base_url();?>business/dashboard/edit_employee/<?php echo $value->a_EmpId;?>"><?php echo ucfirst($value->t_EmpFirstName).' '.$value->t_EmpLastName;?></a></td>
    <td><a href="<?php  echo base_url();?>business/dashboard/edit_employee/<?php echo $value->a_EmpId;?>"><?php echo $value->t_EmaiId; ?></a></td>
    <td><?php echo  date("d M,Y", strtotime($value->d_CreatedOn));?></td>
    <td><?php if($value->b_Deleted==2) { echo "Blocked"; } else { echo "Active"; } ?>
</td>
    <td>
    	<a class="edit" href="<?php echo base_url();?>business/dashboard/edit_employee/<?php echo $value->a_EmpId; ?>"></a>
    	<a class="alert" href="<?php echo base_url();?>business/dashboard/delete_employee/<?php echo $value->a_EmpId; ?>"></a>
<?php if($value->b_Deleted==2) { ?>
      <a class="active_button alert" href="<?php echo base_url();?>business/dashboard/activate_employee/<?php echo $value->a_EmpId; ?>">Active</a>
      <?php } else { ?>
      <a class="inactive alert" href="<?php echo base_url();?>business/dashboard/inactivate_employee/<?php echo $value->a_EmpId; ?>">Blocked</a>
      <?php } ?>
    </td>
  </tr>
  <?php  $i++; }
		}else{
      echo "No records Found";
    }
  ?>
  
  
</tbody></table>
	
</div>
</div>


</section>
<div class="fix"></div>

<script type="text/javascript" >

$(document).ready(function(){

  var access="<?php echo $editEmployee; ?>";
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
        url: "<?php echo base_url();?>business/dashboard/searchName",
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
              list +="<a href=<?php echo base_url(); ?>business/dashboard/edit_employee/"+value.a_EmpId+">"+value.t_EmpFirstName+' '+value.t_EmpLastName+"</a>";
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