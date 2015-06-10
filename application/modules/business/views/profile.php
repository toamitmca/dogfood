<?php 
$status=array(  '0' =>array('a_statusId'=>1,'a_staName'=>'Active'),
          '1' =>array('a_statusId'=>0,'a_staName'=>'Inactive'),
          
          );
?>

<?php
//p($bprofile);
if(!empty($bprofile->tba_Address)){
  $address= explode('___', $bprofile->tba_Address);
}else{
  $address[0]='';
  $address[1]='';
  $address[2]='';
}



// p($address);
// exit();
//p($country);
 //echo $bprofile->b_Status;

 //exit();

 ?>
<section class="main_caintainer">
 <?php $this->load->view('profileleft'); ?>
  <div class="rightSide ">
  <div>
    
    <div class="fix"></div>
  </div>
  <?php
	if(validation_errors()){
		echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
	}

	if($this->session->flashdata('message')){ ?>
		<span style="color:red"><?php echo $this->session->flashdata('message'); ?> </span>
	<?php }
?>
  <form name="detail_informaton1" id="detail_informaton1" method="post" action="<?php echo base_url(); ?>business/dashboard/profile/"> 
  
  


  
    <input type="hidden" name="first_name" id="first_name" readonly="readonly" value="<?php echo $bprofile->d_ModifiedOn; ?>"/>
  
  <div class="formPreExp">
    <div class="col">
      <label>First Name</label>
      <input type="text" name="first_name" id="first_name" readonly="readonly"  value="<?php echo $bprofile->t_FirstName; ?>" />
    </div>
    <div class="col">
      <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" readonly="readonly" value="<?php echo $bprofile->t_LastName; ?>" />
    </div>
    <div class="col">
      <label>Department</label> 
	  
      <?php 
	  echo department('list',$bprofile->n_DeptId,1); ?>
    </div>

<div class="col">
      <label>Email Id</label>
      <input type="text" name="email_id" id="email_id" readonly="readonly"  value="<?php echo $bprofile->t_Email; ?>" />
    </div>

    <div class="col">
      <label>Employee Id</label>
      <input type="text" name="employee_id" id="employee_id"  value="<?php echo $bprofile->t_AdminCode; ?>" />
    </div>
    <div class="col">
      <label>DOB</label>
      <input type="text" name="date_of_birth" value="<?php echo date('d M, Y', strtotime($bprofile->d_DOB)); ?>" readonly="readonly" />
    </div> 
    <div class="col">
      <label>Office Phone </label>
      <input type="text" name="office_phone" id="office_phone" value="<?php echo $bprofile->t_Contact; ?>" />
    </div>
    <div class="col">
      <label>Mobile Phone </label>
      <input type="text" name="mobile_phone" id="mobile_phone"  value="<?php echo $bprofile->t_Mobile; ?>">
    </div>
    <div class="col">
      <label>Address Line1</label>
      <input type="text" name="address_line1" id="address_line1" value="<?php if(isset($address[0])) { echo $address[0]; } ?>"/>
    </div>
    <div class="col">
      <label>Address Line2</label>
      <input type="text" name="address_line2" id="address_line2" value="<?php if(isset($address[1])) { echo $address[1]; }  ?>"/>
    </div>
    <div class="col">
      <label>Address Line3</label>
      <input type="text" name="address_line3"  id="address_line3" value="<?php if(isset($address[2])) {echo $address[2];}  ?>" />
    </div>
    <div class="col">
      	<label>Country</label>
        <select name="country_id" id="country_id">
          <option value="">Select a Country</option>
          <?php foreach ($country as $key => $value) {
             if($value->a_CountryId==$bprofile->n_CountryId) {
              $selectCountry='selected';
              }else{
                $selectCountry='';
                }?>
              <option <?php echo $selectCountry; ?> value="<?php echo $value->a_CountryId; ?>"><?php echo $value->t_CountryName; ?></option>
          <?php } ?>
        </select>
    </div>

    <div class="col">
      <label>State</label> 
      <select name="state_id" id="state_id">
        <option value="">Select a State</option>
        <?php foreach ($state as $key5 => $value5) {
             if($value5->a_StateId==$bprofile->n_StateId) {
              $selectState='selected';
              }else{
                $selectState='';
                }?>
              <option <?php echo $selectState; ?> value="<?php echo $value5->a_StateId; ?>"><?php echo $value5->t_StateName; ?></option>
        <?php } ?>
      </select>

		</select>
		<span class="loading" style="display:none"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
	
    </div>
    <div class="col">
      <label>City</label>
      <select name="city_id" id="city_id">
          <option value="">Select a City</option>
          <?php foreach ($city as $key6 => $value6) {
             if($value6->a_CityId==$bprofile->n_CityId) {
              $selectCity='selected';
              }else{
                $selectCity='';
                }?>
              <option <?php echo $selectCity; ?> value="<?php echo $value6->a_CityId; ?>"><?php echo $value6->t_CityName; ?></option>
        <?php } ?>
        </select>
    </div>

  <div class="col">
    <label>PIN Code</label>
    <input type="text" name="pin_code" id="pin_code" value="<?php echo $bprofile->t_Pincode; ?> "/>
  </div>
   <div class="col">
    <label>Security Answer</label>
    <input type="text" name="seq_code" id="seq_code" value="<?php echo $bprofile->n_seqcode; ?> "/>
  </div>
  <div class="col">
    <label>Status</label>
    <input type="text" name="status" id="status" readonly="readonly" value="<?php if($bprofile->b_Status==1){ echo "Active"; } else { echo "Deactive"; }  ?>"/>
  </div>
  <div></div>
    <div class="right_top">
    <span class="buttonWrap">
      <input type="submit" class="loadbtn bluebg" name="submit" value="Update">
    </span>
    <div class="fix"></div>
  </div>


      </div>
    </form>
  </div>
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>

<script>
$("#country_id").on('change',function(){
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country_id").val();
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getStateDropDown",
      type: 'POST',
      data: { id : countryId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);
              $.each(data,function (index,value){
        $("#state_id").append("<option value='"+value.a_StateId+"'>"+value.t_StateName+"</option>");
        });
           }
      });
  });

	$("#state_id").on('change',function(){
    $("#city_id").empty();
    $("#city_id").html("<option value=''>Select a City</option>");
    var stateId=$("#state_id").val();
    console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>business/dashboard/getCityDropDown",
      type: 'POST',
      data: { id : stateId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);

              $.each(data,function (index,value){
        $("#city_id").append("<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  });

$(document).ready(function() {
var  checkflogin ="<?php echo $firstlogin->fpasschange; ?>"
var myurl ="<?php echo base_url();?>";
if(checkflogin==3){
 alert("Please change the  Security answer ");
 $.ajax({
                    url: myurl+'business/firstloginbusadmin',
                    type:'POST',
                    dataType:'json',
                    data: {'act_mode':'businessadminupdat'},
                    success: function(data1){
                    console.log(data1);
                                       }
                    });
}
 });
 
</script>
</body>
</html>
