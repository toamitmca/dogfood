<?php $data= checklogin();
    $businessid= $data['n_BusinessId']
 ?>

<script type="text/javascript">

$(document).ready(function(){
  var busid ="<?php echo $businessid; ?>";
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
  <?php $this->load->view('leftPolicy');?>
  <div class="rightSide">
  <div> <span class="buttonWrap_back"><a href="" class="loadbtn bluebg">Back to</a></span> <span class="buttonWrap"><a href="" class="loadbtn bluebg">New Policy</a></span>
    <div class="fix"></div>
  </div>
  <div class="right_top">

  <div class="right_top"> <span class="buttonWrap"></span>
    <div class="fix"></div>
    <div class="right_top">
      <span class="buttonWrap"><h4>Assigned</h4></span>
      <h2>Milage Name</h2>
      <div class="fix"></div>
    </div>
  </div>
  <div class="col">
    <label style="text-align:left;">Mileage</label>
  </div>
  <div class="formPreExp">
  <div class="col">
    <label>Max Report Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
    <input type="text" name="n_MaxRptMilage" value="<?php echo set_value('n_MaxRptMilage');?>" />
  </div>
  <div class="col">
    <label>Mileage Rate <span class="WebRupee" ><span class="currency"></span></span></label>
    <input type="text" name="n_MilageRate" value="<?php echo set_value('n_MilageRate');?>" />
  </div>
  <span>
	  <label>Per</label>
	  <select name="n_PerMeasuremnt">
	    <option value='1'>min</option>
	    <option value='2'>hrs</option>
	    <option value='3'>weekly</option>
	  </select>
  </span>
  <div class="col">
    <label>Max Expense Mileage <span class="WebRupee" ><span class="currency"></span></span></label>
    <input type="text" name="n_MaxExpMil" value="<?php echo set_value('n_MaxExpMil');?>" />
  </div>
  <div class="col">
    <label>GPS Stamp Requird</label>
    <select style="width:30%;" name="b_IsGPSReq">
      <option value='1'>Yes</option>
      <option value='0'>No</option>
    </select>
  </div>
   <input type="submit" name="submit" value="Add Milage" class="loadbtn bluebg">
   </div>
   </div>
   
   
   </div>
  
</section>
<div class="fix"></div>
</body></html>