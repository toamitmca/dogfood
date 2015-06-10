$(document).ready(function(){

function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}

$(".leftmenu li a:first").addClass("selected");
$(".leftmenu li a").click(function(){	
	var getRel=$(this).attr("rel");
	//console.log(getRel);
	$(".leftmenu li a").removeClass("selected");
	$(this).addClass("selected");
	$(".tabcontent").slideUp();
	$("#"+getRel).slideDown();
});

$("#saveGeneral").click(function(){
  //alert("hi");
  var Mybase_url = base_url(); 
  // form submit starts here
   var specific_dt = $('#specific_dt_data').val();
  var weekely =      $('#weekely_data').val();
  var policyId        = $("#policy_id").val();
  var t_PolicyName    = $("#t_PolicyName").val();
  var n_MaxRptAmt     = $("#n_MaxRptAmt").val();
  var d_RptDueDt      = $("#d_RptDueDt").val();
  var d_RptDueDt1     = $("#d_RptDueDt1").val();
  var n_MaxExpAmt     = $("#n_MaxExpAmt").val();
  var b_CashAdAllowed = $("#b_CashAdAllowed").val();
  var b_RecpReq       = $("#b_RecpReq").val();
  var n_AboveAmt      = $("#n_AboveAmt").val();
  var expense_submitted      = $("#expense_submitted").val();
  var policycheck      = $("#policy_check_ambigus").val();

  var action="";
  if(policyId!=null){
    action="update";
    policyId=policyId;
  }else{
    action="insert";
    policyId="";
  }
//console.log(n_AboveAmt);

  if(t_PolicyName==""){
    $("#t_PolicyName").css('border','1px solid red');
    $("#t_PolicyName").focus();
    return false;
  }else{
    $("#t_PolicyName").css('border','1px solid green');
    // ajax call will come here
              if(policycheck ==0){

                    $.ajax({
                    url: Mybase_url+'business/dashboard/policyajaxgenral/',
                    type:'POST',
                    dataType:'json',
                    data: {'t_PolicyName':t_PolicyName, 'policyId' : policyId ,'action' : action ,'n_MaxRptAmt':n_MaxRptAmt, 'd_RptDueDt':d_RptDueDt, 'specific_dt':specific_dt, 'weekely':weekely , 'd_RptDueDt1':d_RptDueDt1,'n_MaxExpAmt': n_MaxExpAmt, 'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq, 'n_AboveAmt':n_AboveAmt ,'expense_submitted':expense_submitted},
                    success: function(data){
                    //  console.log(data);
                  //  console.log(data.p_a_PolicyId);
                    if(data !=""){
                    $("#lastId").val(data.p_a_PolicyId);
                    }
                    }
                    });
              }
              else{
                alert('This policy assign . Not update');
              }

    // ajax call ends here
    $(this).addClass('tabRun');
    return true;
  }
  // form submit ends here

});




$("#saveGeneraladd").click(function(){
  //alert("hi");
  var Mybase_url = base_url();
  // form submit starts here
  var specific_dt_data        = $("#specific_dt_data").val();
  var weekely_data    = $("#weekely_data").val();
  var policyId        = $("#policy_id").val();
  var t_PolicyName    = $("#t_PolicyName").val();
  var n_MaxRptAmt     = $("#n_MaxRptAmt").val();
  var d_RptDueDt      = $("#d_RptDueDt").val();
  var d_RptDueDt1     = $("#d_RptDueDt1").val();
  var n_MaxExpAmt     = $("#n_MaxExpAmt").val();
  var b_CashAdAllowed = $("#b_CashAdAllowed").val();
  var b_RecpReq       = $("#b_RecpReq").val();
  var n_AboveAmt      = $("#n_AboveAmt").val();
  var singlepolicy    = $("#bussinglepolicyid").val();
    var expense_submitted      = $("#expense_submitted").val();

  var action="";
  if(policyId!=null){
    action="update";
    policyId=policyId;
  }else{
    action="insert";
    policyId="";
  }
//console.log(n_AboveAmt);

  if(t_PolicyName==""){
    $("#t_PolicyName").css('border','1px solid red');
    $("#t_PolicyName").focus();
    return false;
  }else{
    $("#t_PolicyName").css('border','1px solid green');
    // ajax call will come here
    if(singlepolicy==1){

                    $.ajax({
                    url: Mybase_url+'business/dashboard/policyajaxgenral/',
                    type:'POST',
                    dataType:'json',
                    data: {'t_PolicyName':t_PolicyName, 'policyId' : policyId ,'action' :action ,'n_MaxRptAmt':n_MaxRptAmt, 'd_RptDueDt':d_RptDueDt,'d_RptDueDt1':d_RptDueDt1, 'specific_dt':specific_dt_data,'weekely':weekely_data , 'n_MaxExpAmt': n_MaxExpAmt, 'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq, 'n_AboveAmt':n_AboveAmt,'expense_submitted':expense_submitted},
                    success: function(data){
                //    console.log(data);
                    if(data !=""){
                    $("#lastId").val(data.p_a_PolicyId);
               //     console.log(data.p_a_PolicyId);
                    }
                    }
                    });
              }
              else{
                alert('policy not save');
              }

    // ajax call ends here
    $(this).addClass('tabRun');
    return true;
  }
  // form submit ends here

});




$(".mileage").click(function(){

  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId        = $("#policy_id").val();
  var lastId          = $("#lastId").val();
  var n_MaxRptMilage  = $("#n_MaxRptMilage").val();
  var n_MilageRate    = $("#n_MilageRate").val();
  var n_PerMeasuremnt = $("#n_PerMeasuremnt").val();
  var n_MaxExpMil     = $("#n_MaxExpMil").val();
  var b_IsGPSReq      = $("#b_IsGPSReq").val();
  var policycheck      = $("#policy_check_ambigus").val();
//console.log(policyId);
  if((lastId=='') && (policyId!='')){
    lastId=policyId;
  }else{
    lastId=lastId;
  }

//  console.log(lastId);
if(n_MaxRptMilage==""){
    $("#n_MaxRptMilage").css('border','1px solid red');
    $("#n_MaxRptMilage").focus();
    return false;
  }else{
    $("#n_MaxRptMilage").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here

if(policycheck==0){

   $.ajax({
        url: Mybase_url+'business/dashboard/policyajaxmileage/',
        type:'POST',
        dataType:'json',
        data: {'lastId':lastId,'n_MaxRptMilage':n_MaxRptMilage, 'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil': n_MaxExpMil, 'b_IsGPSReq':b_IsGPSReq},
        success: function(data){
     //     console.log(data);
        }
      });
}

else{
alert('This policy assign . Not update');


}
    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });
  // form submit ends here


$(".mileageadd").click(function(){

  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId        = $("#policy_id").val();
  var lastId          = $("#lastId").val();
  var n_MaxRptMilage  = $("#n_MaxRptMilage").val();
  var n_MilageRate    = $("#n_MilageRate").val();
  var n_PerMeasuremnt = $("#n_PerMeasuremnt").val();
  var n_MaxExpMil     = $("#n_MaxExpMil").val();
  var b_IsGPSReq      = $("#b_IsGPSReq").val();
   var singlepolicy    = $("#bussinglepolicyid").val();
//console.log(policyId);
  if((lastId=='') && (policyId!='')){
    lastId=policyId;
  }else{
    lastId=lastId;
  }

 // console.log(lastId);
if(n_MaxRptMilage==""){
    $("#n_MaxRptMilage").css('border','1px solid red');
    $("#n_MaxRptMilage").focus();
    return false;
  }else{
    $("#n_MaxRptMilage").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
if(singlepolicy ==1){

            $.ajax({
            url: Mybase_url+'business/dashboard/policyajaxmileage/',
            type:'POST',
            //dataType:'json',
            data: {'lastId':lastId,'n_MaxRptMilage':n_MaxRptMilage, 'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil': n_MaxExpMil, 'b_IsGPSReq':b_IsGPSReq},
            success: function(data){
       //     console.log(data);
            }
            });
            }
  else{
    alert('policy not save');
  }

    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });





 $(".peiod_spending").click(function(){

  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId        = $("#policy_id").val();
  var lastId          = $("#lastId").val();
  var n_DailyExpLmt   = $("#n_DailyExpLmt").val();
  var n_MonthlyExpLmt = $("#n_MonthlyExpLmt").val();

if((lastId=='') && (policyId!='')){
    lastId=policyId;
  }else{
    lastId=lastId;
  }

if(n_DailyExpLmt==""){
    $("#n_DailyExpLmt").css('border','1px solid red');
    $("#n_DailyExpLmt").focus();
    return false;
  }else{
    $("#n_DailyExpLmt").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
   $.ajax({
        url: Mybase_url+'business/dashboard/policyajaxspendinglimits/',
        type:'POST',
        //dataType:'json',
        data: {'lastId':lastId, 'n_DailyExpLmt':n_DailyExpLmt, 'n_MonthlyExpLmt':n_MonthlyExpLmt},
        success: function(data){
     //     console.log(data);
        }
      });
              
    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });



$(".peiod_spendingadd").click(function(){
     appendnewcatbusiness();
  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId        = $("#policy_id").val();
  var lastId          = $("#lastId").val();
  var n_DailyExpLmt   = $("#n_DailyExpLmt").val();
  var n_MonthlyExpLmt = $("#n_MonthlyExpLmt").val();
  var singlepolicy    = $("#bussinglepolicyid").val();

if((lastId=='') && (policyId!='')){
    lastId=policyId;
  }else{
    lastId=lastId;
  }

if(n_DailyExpLmt==""){
    $("#n_DailyExpLmt").css('border','1px solid red');
    $("#n_DailyExpLmt").focus();
    return false;
  }else{
    $("#n_DailyExpLmt").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
if(singlepolicy==1){
                $.ajax({
                url: Mybase_url+'business/dashboard/policyajaxspendinglimits/',
                type:'POST',
                dataType:'json',
                data: {'lastId':lastId, 'n_DailyExpLmt':n_DailyExpLmt, 'n_MonthlyExpLmt':n_MonthlyExpLmt},
                success: function(data){
            //    console.log(data);
                }
                });
            }
            else{
              alert('policy not save');
            }

    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });







var arrayCheck=[];
$(document).ready(function(){
var z=0;
//$(".on_button").click(function(){
// id=$(this).attr('id');
//  
//  if($(this).hasClass('off_button')){
//    
//      arrayCheck[z]=$("#spncat"+id).val();
//      console.log(arrayCheck);
//          $("input[id=spncat"+id+"]").prop('disabled', true);
//          $("input[id=sp_cat_single_exp_limit"+id+"]").prop('disabled', true);
//          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', true);
//          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', true);
//  }
//  else{
//          $("input[id=spncat"+id+"]").removeAttr('disabled');
//          $("input[id=sp_cat_single_exp_limit"+id+"]").removeAttr('disabled');
//          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', false);
//          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', false);
//  }
//  z++;
//});  


$(".cat_restriction").click(function(){

//console.log(arrayCheck);
  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId  = $("#policy_id").val();
  var lastId = $("#lastId").val();
  var single=[];
  var daily=[];
  var month=[];
  var catId=[];
 
  var id;
  var i=k=j=x=0;
var checkOnOff;
var action="";
if((lastId=='') && (policyId!='')){
    lastId=policyId;
    action="update";
  }else{
    lastId=lastId;
    action="insert";
  }
  //console.log("hiii");
    $(".sp_cat_single_exp_limit").each(function(){
        single[i] = $(this).val();
        i++;
    });
    $(".sp_cat_single_daily_limit").each(function(){
        daily[k] = $(this).val();
        k++;
    });
    $(".sp_cat_single_month_limit").each(function(){
        month[j] = $(this).val();
        j++;
    });
    $(".spncat").each(function(){
        catId[x] = $(this).val();
        x++;
    });
  //alert(action);
 //  //var singleExp   = $("input[name=sp_cat_single_exp_limit[]]").val();
 //  //console.log(singleExp);
 var disableValue = JSON.stringify(arrayCheck);
 var singleExp = JSON.stringify(single);
 var daily = JSON.stringify(daily);
 var month = JSON.stringify(month);
 var catId = JSON.stringify(catId);


if(n_DailyExpLmt==""){
    $("#n_DailyExpLmt").css('border','1px solid red');
    $("#n_DailyExpLmt").focus();
    return false;
  }else{
    $("#n_DailyExpLmt").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
   $.ajax({
        url: Mybase_url+'business/dashboard/policyajaxperiodcategories/',
        type:'POST',
        //dataType:'json',
        data: {'lastId':lastId,'action' : action ,'disableValue':disableValue, 'singleExp':singleExp, 'daily':daily, 'month':month, 'catId':catId},
        success: function(data){
          
        }
      });

    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;
  }
  });
//period spending form end

 });

// ass single code 




$(document).ready(function(){
var z=0;
$(".on_button").click(function(){
 id=$(this).attr('id');
  
  if($(this).hasClass('off_button')){
    
      arrayCheck[z]=$("#spncat"+id).val();
     
          $("input[id=spncat"+id+"]").prop('disabled', true);
          $("input[id=sp_cat_single_exp_limit"+id+"]").prop('disabled', false);
          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', false);
          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', false);
  }
  else{
          $("input[id=spncat"+id+"]").removeAttr('disabled');
          $("input[id=sp_cat_single_exp_limit"+id+"]").removeAttr('disabled');
          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', false);
          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', false);
  }
  z++;
});  


$(".cat_restrictionadd").click(function(){
var singlepolicy    = $("#bussinglepolicyid").val();

  var Mybase_url = base_url(); 
  // form submit starts here
  var policyId  = $("#policy_id").val();
  var lastId = $("#lastId").val();
  var single=[];
  var daily=[];
  var month=[];
  var catId=[];
 
  var id;
  var i=k=j=x=0;
var checkOnOff;
var action="";
if((lastId=='') && (policyId!='')){
    lastId=policyId;
    action="update";
  }else{
    lastId=lastId;
    action="insert";
  }
  
    $(".sp_cat_single_exp_limit").each(function(){
        single[i] = $(this).val();
        i++;
    });
    $(".sp_cat_single_daily_limit").each(function(){
        daily[k] = $(this).val();
        k++;
    });
    $(".sp_cat_single_month_limit").each(function(){
        month[j] = $(this).val();
        j++;
    });
    $(".spncat").each(function(){
        catId[x] = $(this).val();
        x++;
    });
  alert(action);
 //  //var singleExp   = $("input[name=sp_cat_single_exp_limit[]]").val();
 //  //console.log(singleExp);
 var disableValue = JSON.stringify(arrayCheck);
 var singleExp = JSON.stringify(single);
 var daily = JSON.stringify(daily);
 var month = JSON.stringify(month);
 var catId = JSON.stringify(catId);



if(n_DailyExpLmt==""){
    $("#n_DailyExpLmt").css('border','1px solid red');
    $("#n_DailyExpLmt").focus();
    return false;
  }else{
    $("#n_DailyExpLmt").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
if(singlepolicy ==1){

      $.ajax({
      url: Mybase_url+'business/dashboard/policyajaxperiodcategories/',
      type:'POST',
      //dataType:'json',
      data: {'lastId':lastId,'action' : action ,'disableValue':disableValue, 'singleExp':singleExp, 'daily':daily, 'month':month, 'catId':catId},
      success: function(data){
      
      }
      });
}
else{
  alert('policy category not save')
}
    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;
  }
  });
//period spending form end

 });





$(document.body).on("click",".tabRun",function(){
  $(".tabcontent").slideUp();
  $(this).parents(".tabcontent").next().slideDown();
});


// end of document
});



  // function sub_spncat(){
  //   var spending_sscat = $("#spending_sscat").val();
  //   var gl_mycode = $("#gl_mycode").val();
  //   console.log
  
  //   $.ajax({
  //       url: '<?php echo base_url();?>ssa/business/state/',
  //       type: 'POST',
  //       dataType: 'json',
  //       data: {'countryId': countryId},
  //       success: function(data){
  //       console.log(data); 
  //       $("#msg").afte('Are Bhai Add Hogya q pareshan Ho Rha hai') 
  //        }
          
       
  //     });
        
  // }

//   function add_policycategory(){
//     var mybusid=$("#businessid11").val()
//     var Mybase_url = base_url(); 
//     console.log(mybusid);

// var arrcat=new Array();
// $('#tblCategory tbody tr').each(function(row,tr){
// arrcat[row]={ "t_category_name":$(tr).find('td:nth-child(1) input[type=text]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
// };


// if($('#tblCategory tbody tr td:nth-child(1) input[type="text"]').val()==''){
//   alert('Please Enter Department name');
//   return false;
//   }
//   else{
//     //alert('yes');
//     $('#form3 input[type="button"]').addClass('tabRun');
//     }

// })
//   // var savedatacat = JSON.stringify(arr);
//   // alert(savedatacat);

//  $.ajax({
//         url: Mybase_url+'ssa/policy/sending_cat_add/',
//         type:'POST',
//         data: {'t_PolicyName':arrcat , 'bus_myid':mybusid},
//         success: function(data){
//           console.log(data);
//         }
//       });

//  // alert(JSON.stringify(arr));

// }

$(function(){

AddNewRow_category(); 
})

 
function AddNewRow_category()
{
  //alert("test");
$('#tblCategory tbody').append(
"<tr><td><input type=text></td><td><input type=text></td><td><input type=button value=Delete onclick=RemoveRowcategory(this);></td></tr>"
  );

}


function spnd_check(){
var Mybase_url = base_url();
$( "input" )
.keyup(function() {
var value = $( this ).val();
var bid = $('#businessid11').val();
$.ajax({ 
url: Mybase_url+'ssa/policy/sp_catcheckbyid/',
type:'POST',
 //dataType : 'json',
data: { 'businessid':bid, 'cat_name':value},
success: function(data){
          
          if(data=="category_already_exit"){
          $('#errormsg').text('This category avalable in this business Please DELETE !');
          }
else  {

   $('#errormsg').text('');
}

        }

});
})
}


function AddNewRow_categorybusiness()
{

$('#tblCategory1 tbody').append(
"<tr><td><input type=text  class='catName' name='category_name' id='category_name' onkeyup='return spnd_check();'></td><td><input type='text' name='cat_code' id='cat_code' class='catCode'></td><td><input type=button value=Delete onclick=RemoveRowcategoryadmin(this);></td></tr>"
  );

}

function RemoveRowcategoryadmin(input)
{
var per=$(input).parents('tr');
$(per).remove();

}



function get_myspncat_bybusiness_refress(id)
{
  var busid = id;
 var Mybase_url = base_url(); 


//console.log(busid);
  $.ajax({
        url: Mybase_url+'ssa/policy/get_policy/',
        type:'POST',
        data: {'bus_myid':busid},
        dataType : 'json',
        success: function(data){
         
          $("#tblCategory").empty();

if(data=='Something Went Wrong'){
            var searchvalue = '<tr><td>Data Not Found </td></tr>';

 $('#tblCategory').append(searchvalue);
          }

else{
          var i=0
          $.each(data, function(index, val) {
          var display = '<tr><td><input type="hidden" value="'+val.a_SpndngCatId+'" id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="on_button"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit"></td></tr>';
        $("#tblCategory").append(display);
              i++;

           });
        }

        }
        });

}


function get_myspncat_bybusiness()
{
  var busid = $('#businessid11').val();
 var Mybase_url = base_url(); 

  $.ajax({
        url: Mybase_url+'ssa/policy/get_policy/',
        type:'POST',
        data: {'bus_myid':busid},
        dataType : 'json',
        success: function(data){
         
          $("#tblCategory").empty();

if(data=='Something Went Wrong'){
            var searchvalue = '<tr><td>Data Not Found </td></tr>';

 $('#tblCategory').append(searchvalue);
          }

else{
          var i=0
          $.each(data, function(index, val) {
          var display = '<tr><td><input type="hidden" value="'+val.a_SpndngCatId+'" id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="on_button"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit"></td></tr>';
        $("#tblCategory").append(display);
              i++;

           });
        }

        }
        });

}
function base_url11(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}






function appendnewcatbusiness(){

  var Mybase_url = base_url11();
  var  businessid = $('#Businessbus').val();
  var spcatid= $('#policy_id').val();
  $.ajax({
    url: Mybase_url+'ssa/policy/getaddcat/', 
    type:'POST',
    dataType: 'json',
    data: {'businessid':businessid,'policyid':spcatid},
   success: function(data){
        
          //$("#tblCategoryedit").empty();
          $('#tblCategoryeditbus tbody tr').remove();
var i=0;
var sl;
var dl;
var ml;
if(data=="Something Went Wrong"){

  var display = '<tr><td>Record Not Found </td></tr>';
$('#tblCategoryeditbus tbody').append(display);

}

else{

$.each(data, function(index, val) {
            if((val.n_SingleExpLmt==0) || (val.n_SingleExpLmt== null)) 
            { sl=''; }
            else{
            sl= val.n_SingleExpLmt;
            }

            if((val.n_DailyExpLmt==0) || (val.n_DailyExpLmt== null)) 
            { dl=''; }
            else{
            dl= val.n_DailyExpLmt;
            }
            if((val.n_MonthlyExpLmt==0) || (val.n_MonthlyExpLmt== null)) 
            { ml=''; }
            else{
            ml= val.n_MonthlyExpLmt;
            }
    var display = '<tr><td><input type="hidden" value='+val.a_SpndngCatId+' id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="'+val.ExpStatus+'"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit" value="'+sl+'"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit" value="'+dl+'"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit" value="'+ml+'"></td></tr>';
        $('#tblCategoryeditbus tbody').append(display);
              i++;

           });
}
}
  });
}


function add_categoryupdatebusiness(){
var Mybase_url = base_url11();
var  businessid = $('#Businessbus').val();
var id = $('#policy_id').val();
var arrcat=new Array();
$('#tblCategoryeditbus tbody tr').each(function(row,tr){
arrcat[row]={ "cat_id":$(tr).find('td:nth-child(1) input[type=hidden]').val() ,
"sp_cat_single_exp_limit":$(tr).find('td:nth-child(4) input[type=text]').val() ,
"sp_cat_single_daily_limit":$(tr).find('td:nth-child(5) input[type=text]').val() ,
"sp_cat_single_month_limit":$(tr).find('td:nth-child(6) input[type=text]').val()
};

})


 $.ajax({
       url: Mybase_url+'ssa/policy/ssapolicycategory/',
        type:'POST',
        data: { 'a_mode':'update', 'policyId':id,'a_BusinessId':businessid, 't_PolicyName':arrcat},
        success: function(data){

          $('#msg').html('category updated successfully.');
        }
      });

 // alert(JSON.stringify(arr));

}
