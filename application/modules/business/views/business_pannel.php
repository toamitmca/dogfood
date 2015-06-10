<?php
$sessionVar = $this->session->userdata('roleAccess');
$editPolicy=$sessionVar['Edit policy'];
$userId = checklogin();
?>
<section class="main_caintainer">
  <?php $this->load->view('business_left'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">
      			<a href="" class="loadbtn">Back to</a></span><span class="buttonWrap"><!-- <a href="" class="loadbtn">New Policy</a> --></span>
        	<div class="fix"></div>
      </div>
      <div id="form1" style="display:block">
        <div class="right_top">
		<h2>General</h2>
          <span class="buttonWrap">
            <h4>Assigned</h4>
            </span>
                        <div class="fix"></div>
        </div>
<div class="formPreExp formPreExp2">
  <div class="col">
    <p><span>Business Name :</span> <label><?php echo $state->t_BusinessName;?></label></p>
    <input type="hidden" name="n_BusinessId" value="<?php echo $state->a_BusinessId;?>" >
  </div>
  <div class="col">
   <p><span>Status :</span>
      <label> <?php if($state->n_Status==1){ echo "Close";} ?> 
       <?php if($state->n_Status==2){ echo "Open";} ?> 
      </label>
   </p>
  </div>
  <div class="col">
   <p><span> Address Line1:</span>
    <label><?php $business_add= $state->t_Address;
    $bus_add=  explode('___', $business_add, 2);
        ?>
    <?php echo  $bus_add[0];?>
    </label></p>
  </div>
  <div class="col">
   <p><span> Address Line2:</span>
   <label><?php echo $bus_add[1];  ?>
   </label></p>
  </div>
  <div class="col">
    <p><span>Country :</span>
    <label><?php echo $countryName; ?></label></p>
  </div>
  <div class="col">
    <p><span>State :</span>
    <label><?php echo $stateName; ?></label></p>
  </div>
<div class="col">
  <p><span>City :</span><label><?php echo $cityName; ?></label></p>
   
</div>
<div class="col">
  <p><span>Default Currency :</span><label><?php if(!empty($currencyName)) {echo $currencyName;} ?> </label></p>
 </div>
<div class="col">
  <p><span>Expenses in other currency:</span><label><?php if($state->b_ExpOtherCtry==1){echo "Yes";}else{echo "No";} ?></label></p>
</div>
<div class="col">
 <p><span> Date Format : </span>
    <label> <?php if($state->t_DateFormat=='DMY'){ echo "DMY";} ?>
     <?php if($state->t_DateFormat=='YMD'){ echo "YMD";} ?>
     <?php if($state->t_DateFormat=='YMD'){ echo "MDY";} ?>
</label></p>
</div>
<div class="col">
 <p><span>Distance Measure :</span><label><?php if(!empty($disName)) {echo $disName; }?></label></p>
</div>
<div class="right_top">
  <h2>Applicant Information</h2><span class="buttonWrap"></span>
<div class="formPreExp">
<div class="col">
  <p><span>First Name : </span> <label><?php echo ucfirst($state->FNAME);?></label></p>
 </div>
  <div class="col">
    <p><span>Last Name : </span> <label><?php echo ucfirst($state->LNAME);?></label></p>
  </div>
<div class="col">
  <p><span>Email :</span><label><?php echo $state->EMAIL;?></label></p>
 </div>
</div>
</div>
</div>
          </div>
     <div id="form211">
      	<div class="right_top">
            <h2>Department</h2>
            <h2 id="departent" style="color:#008000"></h2>
            <span class="buttonWrap"></span>
            <div class="">
<table id="tblDept" class="businessTab1">
            <thead>
          <tr>
              <th><p>Department Name </p></th>
              <th><input type="button"  value="Add New" class="buttonRight" ></th>
          </tr>
          </thead>
          <tbody>
          <?php
         // p($dpt_mt);
             if(!empty($dpt_mt)){
             foreach ($dpt_mt as $d_name) {
               ?>
          <tr id="dpt<?php echo $d_name->a_DeptId; ?>"> <td><p><?php echo $d_name->t_DeptName;?></p></td> 
          <td><input type="button" name="Delete" value="Delete" onclick="return dpt_delete(<?php echo $d_name->a_DeptId ?>);"></td>
          </tr>
          <?php  }
             }
             else{echo ' No Department Yet Created';}
           ?>
           </tbody>
          </table>
<span id="email1_msg" style="position: absolute;top: -7px; right: 20px;"> </span>
            <div><span class="buttonWrap"><input type="button" name="save" value="Save" class="loadbtn bluebg" onclick="return add_department();"></span>
                <div class="fix"></div>
            </div>
            </div>
            </div>

        <div class="right_top">
            <h2>Spending Category </h2>
            <h2 id="spand_cat" style="color:#008000"></h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><!-- <a class="loadbtn bluebg" rel="form3">Save Categories</a> --></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
            </div>
  <div class="right_top">
                <div class="fix"></div>
</div>
      <div id="form3">
      	  <table border="1" id="tblCategory" class="businessTab1">
            <thead>
              <tr>
                <th>Category add</th>
                <th>Gl code</th>
                <th><input type="button" onclick="AddNewRow_category();" class="loadbtn bluebg "  value="Add New"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
<span class="buttonWrap"><input type="button" name="save" value="Save" class="loadbtn bluebg" onclick="return add_category();"></span>
             <table border="1" id="spnd_cat_general" class="businessTab1">
          <thead><tr> <th> Spending Cat</th> <th> GL Code</th><th> Action</th></tr></thead><tbody>
          <?php
            if($sp_cat  != 'Something Went Wrong'){
            foreach ($sp_cat as $dcat_name) { ?>
          <tr id="spcat<?php echo $dcat_name->a_SpndngCatId ?>"> <td><p><?php  echo $dcat_name->t_SpndName; ?></p></td>
          <td id="appendCat<?php echo $dcat_name->a_SpndngCatId; ?>">
          <span id="rem<?php echo $dcat_name->a_SpndngCatId; ?>">
          <label class="remove_attr" onclick="return add_cat_glcod(<?php echo  $dcat_name->a_SpndngCatId; ?>);">
          <p id="<?php echo $dcat_name->a_SpndngCatId; ?>">
          <input type="hidden" name="gl_code" id="gl_code<?php echo  $dcat_name->a_SpndngCatId; ?>" value="<?php  echo $dcat_name->t_GLCode; ?>"/>
          <?php  echo $dcat_name->t_GLCode; ?></p></label></span>
          <span id="rem11<?php echo $dcat_name->a_SpndngCatId; ?>" > </span></td> <td><input type="button" name="sp_cat_delete" onclick="return sp_cat_delet(<?php echo $dcat_name->a_SpndngCatId; ?>);" value="Delete"> </td></tr>
          <?php  }  } else{
echo "Record not found";
            } ?>

          </tbody>
          </table>

<!-- end cat listing -->

        <div class="right_top">

            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><!-- <a class="loadbtn bluebg" rel="form4">Save Custom Tag</a> --></span>
                <div class="fix">
                </div>
              </div>

           </div>
        </div>
    	  <div class="right_top">
           <h2>Custon Tag</h2>
           <h2 id="custom_tag_msg" style="color:#008000"></h2>

            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div ><span class="buttonWrap"><!-- <a class="loadbtn bluebg" rel="form5">Save Reimbursement</a> --></span>
                <div class="fix"></div>

              </div>
            </div>
          </div>
      </div>
      <div id="form4">
      		<table id="tblcustomtag_one" class="businessTab1">
            <thead>
              <tr>
                <th>Custom Tag 1</th>
                <th>GL Code</th>
                <th><input type="button"  class="loadbtn bluebg custam_tag_oneadd" value="Add New"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
            <input type="button" name="save" value="Save" class="loadbtn bluebg" onclick="add_customtag_one();">
   <!-- custom tah listing -->
          <table id="customtag_one1" class="businessTab1"> <thead>
          <tr> <th> Custom tag1</th> <th> GL Code</th> <th> Action</th></tr></thead><tbody>
          <?php
     

            if($custon_tag != 'Something Went Wrong'){
           foreach ($custon_tag as $tagl_name) {
            if($tagl_name->n_CustCatId ==1) {
              ?>
          <tr  id="ctag<?php echo  $tagl_name->a_CustTagId; ?>"> <td><p><?php  echo $tagl_name->t_CustText;   ?></p></td>
          <td id="appendCust<?php echo $tagl_name->a_CustTagId; ?>">
          <span id="remtag<?php echo $tagl_name->a_CustTagId; ?>">
          <label onclick="return add_ctag_glcod(<?php echo  $tagl_name->a_CustTagId; ?>);">
          <p id="<?php echo $tagl_name->a_CustTagId; ?>">
          <input type="hidden" name="gl_code1" id="gl_code1<?php echo $tagl_name->a_CustTagId; ?>" value="<?php  echo $tagl_name->t_CustValue; ?>"/>
          <?php  echo $tagl_name->t_CustValue;?></p></label>
          </span>
          <span id="remtag11<?php echo $tagl_name->a_CustTagId; ?>" ></span>
          </td><td> <input type="button" name="cust_tag_delete" value="Delete" onclick="return delete_ctag(<?php echo $tagl_name->a_CustTagId;?>);" > </td></tr>
          <?php  } } } else{ echo 'Record not found';}

           ?>
           </tbody>
          </table>
<!-- end custom tag listing  -->


<!-- custom tag two Start  -->

  <table id="tblcustomtag_two" class="businessTab1">
            <thead>
              <tr>
                <th>Custom Tag 2</th>
                <th>GL Code</th>
                <th><input type="button"  class="loadbtn bluebg custam_tag_twoadd" value="Add New"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
            <input type="button" name="save" value="Save" class="loadbtn bluebg" onclick="add_customtag_two();">
   <!-- custom tah listing -->

<table id="custom_tag_2" class="businessTab1">
        <thead> <tr> <th> Custom tag 2</th> <th> GL Code</th> <th>Action</th></tr></thead>
        <tbody>
          <?php  if($custon_tag != 'Something Went Wrong'){
           foreach ($custon_tag as $tagl_name) {
             if($tagl_name->n_CustCatId ==2) {


              ?>
          <tr id="ctag<?php echo $tagl_name->a_CustTagId; ?>"> <td><p><?php  echo $tagl_name->t_CustText;   ?></p></td>
          <td id="appendCust<?php echo $tagl_name->a_CustTagId; ?>">
          <span id="remtag<?php echo $tagl_name->a_CustTagId; ?>">
          <label onclick="return add_ctag_glcod(<?php echo  $tagl_name->a_CustTagId; ?>);">
          <p id="<?php echo $tagl_name->a_CustTagId; ?>">
          <input type="hidden" name="gl_code1" id="gl_code1<?php echo $tagl_name->a_CustTagId; ?>" value="<?php  echo $tagl_name->t_CustValue; ?>"/>
          <?php  echo $tagl_name->t_CustValue;   ?></p></label>
          </span>
          <span id="remtag11<?php echo $tagl_name->a_CustTagId; ?>" ></span>
          </td><td> <input type="button" name="cust_tag_delete" value="Delete" onclick="return delete_ctag(<?php echo $tagl_name->a_CustTagId;?>);" > </td></tr>

          <?php } }  } else{ echo 'Record not found';}
          //$i=$i+1;}
           ?>
           </tbody>
          </table>

<!-- custom tag two end  -->
      </div>
<div class="right_top">
<h2>Reimbursement</h2>
<span id="displayMsg"></span>
      <div id="form5">
      <label>Employee pament methood</label>
      <input type="button" name="save" value="Save" class="loadbtn bluebg" onclick="return save_rembr();">
      		<Select name="" id="remenber_mt">
                <option value="">Select</option>
                  <option value="1" <?php if($state->n_reimb==1) echo 'selected="selected"' ?> >Manual</option>
                  <option value="2" <?php if($state->n_reimb==2) echo 'selected="selected"' ?>>Payroll</option>

                </Select>
                <div style="clear:both"></div>
      </div>
</div>
    </form>
</div>
</section>
<div class="fix"></div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/business.js"></script>
<script type="text/javascript">

function getdepartment(){
var MybaseUrl="<?php echo base_url(); ?>";
$.ajax({
  url: MybaseUrl+'business/dashboard/getdepartment',
  type:'POST',
  dataType:'json',
  data: {'act_mode': 'value1'},
 success:function(data){
$('#tblDept tbody').empty();
$.each(data, function(data, val) {
   var display="<tr id=dpt"+val.a_DeptId+"> <td><p>"+val.t_DeptName+"</p></td>";
       display+="<td><input type=button name=Delete value=Delete onclick= 'return dpt_delete("+val.a_DeptId+");'></td></tr>";
//alert(display);
$('#tblDept tbody').append(display);
 });

  }
});
}

function getspendcat(){
var MybaseUrl="<?php echo base_url(); ?>";
$.ajax({
  url: MybaseUrl+'business/dashboard/getspendcat',
  type:'POST',
  dataType:'json',
  data: {'act_mode':'value1'},
 success:function(data1){
  if(data1 != 'Something Went Wrong'){
$('#spnd_cat_general tbody').empty();


$.each(data1, function(data1, val) {
        var display1="<tr id=spcat"+val.a_SpndngCatId+"> <td><p>"+val.t_SpndName+"</p></td>";
         display1+="<td id=appendCat"+val.a_SpndngCatId+">";
         display1+="<span id=rem"+val.a_SpndngCatId+">";
         display1+="<label class=remove_attr onclick=return add_cat_glcod("+val.a_SpndngCatId+");>";
         display1+="<p id="+val.a_SpndngCatId+">";
         display1+="<input type=hidden name=gl_code id=gl_code"+val.a_SpndngCatId+" value="+val.t_GLCode+"/>"+val.t_GLCode+"</p></label></span>";
         display1+="<span id=rem11"+val.a_SpndngCatId+"> </span></td> <td><input type=button name=sp_cat_delete onclick='return sp_cat_delet("+val.a_SpndngCatId+");' value=Delete> </td></tr>";
       //alert(display1);
        $('#spnd_cat_general tbody').append(display1);

  });
}

}
});
}
function getcustomtag_one(){
var MybaseUrl="<?php echo base_url(); ?>";
$.ajax({
  url: MybaseUrl+'business/dashboard/getcustomtag',
  type:'POST',
  dataType:'json',
  data: {'act_mode': 'value1'},
 success:function(data1){
if(data1 != 'Something Went Wrong'){
$('#customtag_one1 tbody').empty();
$.each(data1, function(data1, val) {

if(val.n_CustCatId ==1) {
         var dinplay="<tr id=ctag"+val.a_CustTagId+"> <td><p>"+val.t_CustText+"</p></td>";
           dinplay+="<td id=appendCust"+val.a_CustTagI+"d>";
           dinplay+="<span id=remtag"+val.a_CustTagId+">";
           dinplay+="<label onclick=return add_ctag_glcod("+val.a_CustTagId+");>";
           dinplay+="<p id="+val.a_CustTagId+">";
           dinplay+="<input type=hidden name=gl_code1 id=gl_code1"+val.a_CustTagId+" value="+val.t_CustValue+"/>"+val.t_CustValue+"</p></label></span>";
           dinplay+="<span id=remtag11"+val.a_CustTagId+" ></span>";
           dinplay+="</td><td> <input type=button name=cust_tag_delete value=Delete onclick='return delete_ctag("+val.a_CustTagId+");' > </td></tr>";

          // alert(dinplay);
          $('#customtag_one1 tbody').append(dinplay);
}

});

}
  }
});
}


function getcustomtag_two(){
var MybaseUrl="<?php echo base_url(); ?>";
$.ajax({
  url: MybaseUrl+'business/dashboard/getcustomtag',
  type:'POST',
  dataType:'json',
  data: {'act_mode': 'value1'},
 success:function(data1){
//console.log(data1);

if(data1 != 'Something Went Wrong'){
$('#custom_tag_2 tbody').empty();
$.each(data1, function(data1, val) {

if(val.n_CustCatId ==2) {
         var dinplay="<tr id=ctag"+val.a_CustTagId+"> <td><p>"+val.t_CustText+"</p></td>";
           dinplay+="<td id=appendCust"+val.a_CustTagI+"d>";
           dinplay+="<span id=remtag"+val.a_CustTagId+">";
           dinplay+="<label onclick=return add_ctag_glcod("+val.a_CustTagId+");>";
           dinplay+="<p id="+val.a_CustTagId+">";
           dinplay+="<input type=hidden name=gl_code1 id=gl_code1"+val.a_CustTagId+" value="+val.t_CustValue+"/>"+val.t_CustValue+"</p></label></span>";
           dinplay+="<span id=remtag11"+val.a_CustTagId+" ></span>";
           dinplay+="</td><td> <input type=button name=cust_tag_delete value=Delete onclick='return delete_ctag("+val.a_CustTagId+");' > </td></tr>";

           //alert(dinplay);
          $('#custom_tag_2 tbody').append(dinplay);
}

});

}
  }
});
}


function  getbusinesdepatrment(){
var MybaseUrl ="<?php echo base_url(); ?>";
$.ajax({
  url: MybaseUrl+'business/dashboard/get_dpt_ctag_spcat',
  type:'POST',
  dataType: 'json',
  data: {'act_mose': 'value1'},
 success:function(data){
}
});
}
var i=1;
$(document).ready(function() {

$(document.body).on('click','.buttonRight',function(){
  console.log(i);
  $('#tblDept tbody').append("<tr><td><input type=text name='dept_name_search' class='dept_name' id='dept_name_search_"+i+"'><input type=hidden name=flag value=1 id='flag_"+i+"' ></td><td><input type=button value=Delete onclick=RemoveRow(this);></td></tr>"
  );
  i++;
});
console.log(i);
$(document.body).on("keyup",".dept_name",function(){
//$(".dept_name").on('keyup',function() {  dept_name_search_3
          var deptName= $(this).val();
         var id= $(this).attr('id');
          var flagid=  id.slice(17, 19);
      var MybaseUrl = "<?php echo base_url();?>"
      console.log(deptName);
      $(".loadingemail").css('display', 'block');
      $("#dept_name_search").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard/deptNameCheck',
        type: 'POST',
        //dataType: 'json',
        data: {'deptName':deptName},
        success:function(data){
          console.log(data);
          if(data!=''){
            console.log(id);
            $('#flag_'+flagid).val('0');
            $("#"+id).after("<span id='"+id+"'>This Department Name Already Exist Try Another</span>");
          // $('#email1_msg').html('This Department Name Already Exist Try Another');
            $("#"+id).parent().find('span').not("span:first").remove();
            $(this).css("border","solid 1px red");
            $(".loadingemail").css('display', 'none');
          }else{
            $("span[id="+id+"]").remove();
            $(".loadingemail").css('display', 'none');
            $('#flag_'+flagid).val('1');
          }

        }
      });
   });
});


$(document).ready(function(){
// var access="";
//   console.log(access);
//   if(access=="No"){
//    $("input").prop('disabled','disabled');
//    $("select").prop('disabled','disabled');
//    $(".loadbtn").hide();
//    $(".remove_attr").removeAttr('onclick');
//   }
  $("#addNew").click(function(){
    var getHtml =$("#departDiv").html();
    $("#departDivNew").append(getHtml+' <input type="button" name="delete" value="Delete" class="del" />');
  });
  $(document.body).on("click",".del",function(){
    $(this).prev("input").remove();
    $(this).remove();
  });

 });

</script>
<script type="text/javascript">
    $(document).ready(function(){
		$(document).on("click",".tabRun",function(){
          $('.tabcontent').slideUp();
            $(this).parents('.tabcontent').next('div').slideDown();
        });
	    });
	$(document).ready(function(e) {
    $('a').click(function(){
		var getRel = $(this).attr("rel");
		$('.leftmenu li a').removeClass('selected');
		$(this).addClass('selected');
		$('.tabcontent').fadeOut();
		$('#'+getRel).fadeIn();
	});
	
	
});
</script>
<script type="text/javascript">

function catglcodeedit(id){
  console.log(id);

}
function dpt_delete(id){

  var MybaseUrl="<?php echo base_url(); ?>";
  $.ajax({
        url: MybaseUrl+'business/dashboard/delete_dpt',
        type: 'POST',
        //dataType: 'json',
        data: {'act_mode':'dptmt', 'id':id},
        success:function(data){
          $('#dpt'+id).remove();
          $('#departent').html('Department deleted Successfully!');
         // console.log(data);
        }
      });}

function sp_cat_delet(spid){

  var MybaseUrl="<?php echo base_url(); ?>";
  $.ajax({
        url: MybaseUrl+'business/dashboard/delete_dpt',
        type: 'POST',
        //dataType: 'json',
        data: {'act_mode':'spendcat', 'id':spid},
        success:function(data2){
           $('#spcat'+spid).remove();
          //console.log(data2);
           $('#spand_cat').html('Spending category deleted successfully!');

        }
      });
}
function delete_ctag(ctagid){
  var MybaseUrl="<?php echo base_url(); ?>";
  $.ajax({
        url: MybaseUrl+'business/dashboard/delete_dpt',
        type: 'POST',
        //dataType: 'json',
        data: {'act_mode':'custam_tag', 'id':ctagid},
        success:function(data2){
          $('#ctag'+ctagid).remove();
           $('#custom_tag_msg').html('custom  deleted Successfully!');
         // console.log(data2);

        }
      });
}


$(document).ready(function() {
var j=1;
var k=1;
$(document.body).on('click','.custam_tag_twoadd',function(){

$('#tblcustomtag_two tbody').append("<tr><td><input type=text class='custam_tag2' id='cus_two"+j+"'></td><td> <input type=hidden name=flag value=1 id='flag_two"+j+"' ><input type=text></td><td><input type=button value=Delete onclick=RemoveRow_customtag(this);></td></tr>");
j++;
});
$(document.body).on('click','.custam_tag_oneadd',function(){
$('#tblcustomtag_one tbody').append("<tr><td><input class='custam_tag1' id='cus_one"+k+"' type=text></td><td> <input type=hidden name=flag value=1 id='flag_one"+k+"' ><input type=text></td><td><input type=button value=Delete onclick=RemoveRow_customtag(this);></td></tr>");
 k++;
});

// one 
$(document.body).on("keyup",".custam_tag1",function(){
//$(".dept_name").on('keyup',function() {  dept_name_search_3
          var custontag1= $(this).val();
         var id= $(this).attr('id');
         console.log(id);
          var flag_one_id=id.slice(7,9);
          console.log(flag_one_id);
      var MybaseUrl = "<?php echo base_url();?>"
      console.log(custontag1);
      $("#dept_name_search").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard/delete_dpt',
        type: 'POST',
       // dataType:'json',
        data: {'act_mode':'custam_tag_onecheck','id':custontag1},
        success:function(data){
          console.log(data);
          if(data.noif>0){
            console.log(id);
            $('#flag_one'+flag_one_id).val('0');
            $("#"+id).after("<span id='"+id+"'>This Custam Tag  Already Exist Try Another</span>");
          // $('#email1_msg').html('This Department Name Already Exist Try Another');
            $("#"+id).parent().find('span').not("span:first").remove();
            $(this).css("border","solid 1px red");
            $(".loadingemail").css('display', 'none');
          }else{
            $("span[id="+id+"]").remove();
            $(".loadingemail").css('display', 'none');
            $('#flag_one'+flag_one_id).val('1');
          }

        }
      });
   });

// end one


$(document.body).on("keyup",".custam_tag2",function(){
//$(".dept_name").on('keyup',function() {  dept_name_search_3
          var custontag1= $(this).val();
         var id2= $(this).attr('id');
         console.log(id2);
          var flag_two_id=id2.slice(7,9);
          console.log(flag_two_id);
      var MybaseUrl = "<?php echo base_url();?>"
      console.log(custontag1);
      $("#dept_name_search").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard/delete_dpt',
        type: 'POST',
       // dataType:'json',
        data: {'act_mode':'custam_tag_twocheck','id':custontag1},
        success:function(data){
          console.log(data);
          if(data.noif2>0){
            console.log(id2);
            $('#flag_two'+flag_two_id).val('0');
            $("#"+id2).after("<span id='"+id2+"'>This Custam Tag  Name Already Exist Try Another</span>");
            $("#"+id2).parent().find('span').not("span:first").remove();
            $(this).css("border","solid 1px red");
            $(".loadingemail").css('display', 'none');
          }else{
            $("span[id="+id2+"]").remove();
            $(".loadingemail").css('display', 'none');
            $('#flag_two'+flag_two_id).val('1');
          }

        }
      });
   });



});
</script>

</body></html>
