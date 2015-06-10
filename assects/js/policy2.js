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
/*$("#saveGeneral").click(function(){
  var Mybase_url = base_url(); 
  // form submit starts here
  var t_PolicyName    = $("#t_PolicyName").val();
  var n_MaxRptAmt     = $("#n_MaxRptAmt").val();
  var d_RptDueDt      = $("#d_RptDueDt").val();
  var d_RptDueDt1     = $("#d_RptDueDt1").val();
  var n_MaxExpAmt     = $("#n_MaxExpAmt").val();
  var b_CashAdAllowed = $("#b_CashAdAllowed").val();
  var b_RecpReq       = $("#b_RecpReq").val();
  var n_AboveAmt      = $("#n_AboveAmt").val();

//console.log(n_AboveAmt);

  if(t_PolicyName==""){
    $("#t_PolicyName").css('border','1px solid red');
    $("#t_PolicyName").focus();
    return false;
  }else{
    $("#t_PolicyName").css('border','1px solid green');
    // ajax call will come here
      $.ajax({
        url: Mybase_url+'ssa/policy/policyajaxgenral/',
        type:'POST',
        dataType:'json',
        data: {'t_PolicyName':t_PolicyName, 'n_MaxRptAmt':n_MaxRptAmt, 'd_RptDueDt':d_RptDueDt,'d_RptDueDt1':d_RptDueDt1,'n_MaxExpAmt': n_MaxExpAmt, 'b_CashAdAllowed':b_CashAdAllowed,'b_RecpReq':b_RecpReq, 'n_AboveAmt':n_AboveAmt},
        success: function(data){
          console.log(data);
          if(data !=""){
            $("#lastId").val(data.p_a_PolicyId);
          }
        }
      });

    // ajax call ends here
    $(this).addClass('tabRun');
    return true;    
  }
  // form submit ends here
  
});*/




/*$(".mileage").click(function(){

  var Mybase_url = base_url(); 
  // form submit starts here
  var lastId          = $("#lastId").val();
  var n_MaxRptMilage  = $("#n_MaxRptMilage").val();
  var n_MilageRate    = $("#n_MilageRate").val();
  var n_PerMeasuremnt = $("#n_PerMeasuremnt").val();
  var n_MaxExpMil     = $("#n_MaxExpMil").val();
  var b_IsGPSReq      = $("#b_IsGPSReq").val();
if(n_MaxRptMilage==""){
    $("#n_MaxRptMilage").css('border','1px solid red');
    $("#n_MaxRptMilage").focus();
    return false;
  }else{
    $("#n_MaxRptMilage").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
   $.ajax({
        url: Mybase_url+'ssa/policy/policyajaxmileage/',
        type:'POST',
        //dataType:'json',
        data: {'lastId':lastId, 'n_MaxRptMilage':n_MaxRptMilage, 'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil': n_MaxExpMil, 'b_IsGPSReq':b_IsGPSReq},
        success: function(data){
          console.log(data);
        }
      });
              
    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });*/
  // form submit ends here
 

 /*$(".peiod_spending").click(function(){

  var Mybase_url = base_url();
  // form submit starts here
  var lastId          = $("#lastId").val();
  var n_DailyExpLmt   = $("#n_DailyExpLmt").val();
  var n_MonthlyExpLmt = $("#n_MonthlyExpLmt").val();

if(n_DailyExpLmt==""){
    $("#n_DailyExpLmt").css('border','1px solid red');
    $("#n_DailyExpLmt").focus();
    return false;
  }else{
    $("#n_DailyExpLmt").css('border','1px solid green');
    $(this).addClass('tabRun');
    // ajax call will come here
   $.ajax({
        url: Mybase_url+'ssa/policy/policyajaxspendinglimits/',
        type:'POST',
        //dataType:'json',
        data: {'lastId':lastId, 'n_DailyExpLmt':n_DailyExpLmt, 'n_MonthlyExpLmt':n_MonthlyExpLmt},
        success: function(data){
          console.log(data);
        }
      });
              
    // ajax call ends here
    //$(".tabcontent").slideUp();
    //$(this).parents(".tabcontent").next().slideDown();
    //return true;    
  }
  });
*/

 
 var arrayCheck=[];
 $(document).ready(function(){
var z=0;
$(".on_button").click(function(){
 id=$(this).attr('id');
  
  if($(this).hasClass('off_button')){
    
      arrayCheck[z]=$("#spncat"+id).val();
      console.log(arrayCheck);
          $("input[id=spncat"+id+"]").prop('disabled', true);
          $("input[id=sp_cat_single_exp_limit"+id+"]").prop('disabled', true);
          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', true);
          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', true);
  }
  else{
          $("input[id=spncat"+id+"]").removeAttr('disabled');
          $("input[id=sp_cat_single_exp_limit"+id+"]").removeAttr('disabled');
          $("input[id=sp_cat_single_daily_limit"+id+"]").prop('disabled', false);
          $("input[id=sp_cat_single_month_limit"+id+"]").prop('disabled', false);
  }
  z++;
});  

$(".cat_restriction").click(function(){

console.log(arrayCheck);
  var Mybase_url = base_url(); 
  // form submit starts here
  var lastId = $("#lastId").val();
  var single=[];
  var daily=[];
  var month=[];
  var catId=[];
 
  var id;
  var i=k=j=x=0;
var checkOnOff;
  //console.log(arrayCheck);
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
 //  console.log(catId);
 //  console.log(single);
 //  console.log(daily);
 //  console.log(month);
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
        url: Mybase_url+'ssa/policy/policyajaxperiodcategories/',
        type:'POST',
        //dataType:'json',
        data: {'lastId':lastId,'disableValue':disableValue, 'singleExp':singleExp, 'daily':daily, 'month':month, 'catId':catId},
        success: function(data){
        //  console.log(data);
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
 

$(document.body).on("click",".tabRun",function(){
  $(".tabcontent").slideUp();
  $(this).parents(".tabcontent").next().slideDown();
});


// end of document
});



  function sub_spncat(){
    var spending_sscat = $("#spending_sscat").val();
    var gl_mycode = $("#gl_mycode").val();
   // console.log
  
    $.ajax({
        url: '<?php echo base_url();?>ssa/business/state/',
        type: 'POST',
        dataType: 'json',
        data: {'countryId': countryId},
        success: function(data){
     //   console.log(data); 
        $("#msg").afte('Are Bhai Add Hogya q pareshan Ho Rha hai')
         }


      });

  }

  function add_policycategory(){
    var mybusid=$("#businessid11").val();
    var Mybase_url = base_url();
    var arrcat=new Array();
        $('#tblCategory1 tbody tr').each(function(row,tr){
        arrcat[row]={ "t_category_name":$(tr).find('td:nth-child(1) input[type=text]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
        };
   if($('#tblCategory1 tbody tr td:nth-child(1) input[type="text"]').val()==''){
   alert('Please Enter category name');
   return false;
   }
     else{

    $('#form3 input[type="button"]').addClass('tabRun');
    }

    })
  
 $.ajax({
        url: Mybase_url+'ssa/policy/sending_cat_add/',
        type:'POST',
        data: {'t_PolicyName':arrcat , 'bus_myid':mybusid},

        success: function(data){
         // console.log(data);
        }

      });
 
 getallcatbusinessa_addtime(mybusid)
 get_myspncat_bybusiness_refress(mybusid);
 get_myspncat(mybusid);

}









function add_policycategoryonupdate(){
    var mybusid=$("#businessid11").val()
    var Mybase_url = base_url(); 
    //console.log(mybusid);
        var arrcat=new Array();
        $('#tblCategory1 tbody tr').each(function(row,tr){
        arrcat[row]={ "t_category_name":$(tr).find('td:nth-child(1) input[type=text]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
        };
   if($('#tblCategory1 tbody tr td:nth-child(1) input[type="text"]').val()==''){
   alert('Please Enter category name');
   return false;
   }
     else{
  
    $('#form3 input[type="button"]').addClass('tabRun');
    }

    })


 $.ajax({
        url: Mybase_url+'ssa/policy/sending_cat_add/',
        type:'POST',
        data: {'t_PolicyName':arrcat , 'bus_myid':mybusid},

        success: function(data){
        alert('Add successfully!.');
       appendnewcat();
       getallcatbusiness();

        }

      });
 
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


function get_myspncat(busid)
{
 var Mybase_url = base_url();

  $.ajax({
        url: Mybase_url+'ssa/policy/get_policy/',
        type:'POST',
        data: {'bus_myid':busid},
        dataType : 'json',
        success: function(data){
         // console.log(data);
          $("#tblCategory").empty();
          var i=0
          $.each(data, function(index, val) {
              var display = '<tr><td><input type="hidden" value="'+val.a_SpndngCatId+'" id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="on_button"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit"></td></tr>';
         //alert(display);
        $("#tblCategory").append(display);
              i++;

          });

        }
        });
}

function get_myspncat_bybusiness_refress(mybusid)
{
  var busid = mybusid;
 var Mybase_url = base_url();
  $.ajax({
        url: Mybase_url+'ssa/policy/get_policy/',
        type:'POST',
        data: {'bus_myid':busid},
        dataType : 'json',
        success: function(data){
         // console.log(data);
          $("#tblCategory").empty();

if(data=='Something Went Wrong'){
            var searchvalue = '<tr><td>Data Not Found </td></tr>';

 $('#tblCategory').append(searchvalue);
          }

else{
          var i=0
          $.each(data, function(index, val) {
          var display = '<tr><td><input type="hidden" value="'+val.a_SpndngCatId+'" id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="on_button"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit"></td></tr>';
         //alert(display);
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
    check_policy(busid);
    currency_change(busid);
   getallcatbusinessaddtime(busid);
  $.ajax({
        url: Mybase_url+'ssa/policy/get_policy/',
        type:'POST',
        data: {'bus_myid':busid},
        dataType : 'json',
        success: function(data){

          
          $("#tblCategory_spcat tbody").empty();

if(data=='Something Went Wrong'){
            var searchvalue = '<tr><td>Data Not Found </td></tr>';
 $('#tblCategory_spcat tbody').append(searchvalue);
          }
else{
          var i=0
          $.each(data, function(index, val) {
          var display = '<tr><td><input type="hidden" value="'+val.a_SpndngCatId+'" id="spncat'+i+'" name="spncat[]" class="spncat"></td><td><input type="button" id="'+i+'" name="on" class="on_button"></td><td>'+val.t_SpndName+'</td><td><input type="text" id="sp_cat_single_exp_limit'+i+'" name="sp_cat_single_exp_limit[]" class="sp_cat_single_exp_limit"></td><td><input type="text" id="sp_cat_single_daily_limit'+i+'" name="sp_cat_single_daily_limit[]" class="sp_cat_single_daily_limit"></td><td><input type="text" id="sp_cat_single_month_limit'+i+'" name="sp_cat_single_month_limit[]" class="sp_cat_single_month_limit"></td></tr>';
          // alert(display);
        $("#tblCategory_spcat tbody").append(display);
              i++;

           });
        }

        }
        });

}

function check_policy(busid){
      var Mybase_url = base_url();
       if(busid =="-1"){
      var businessid =$('#businessid11').val();
       }
       else{
       var  businessid =busid;
       }


       var policyname= $('#t_PolicyName').val();
      
//console.log(policyname);
       $.ajax({
       url: Mybase_url+'ssa/policy/policycheck/',
        type:'POST',
        dataType:'json',
        data: {'businessid':businessid ,'policyname':policyname},
        success: function(data){
           //console.log(data);
         // console.log(data.nom);
                if(data.nom ==="0"){
                $('#countpolicy').html('');
                $('#singlepolicyid').val('1');
                }
                else{
                $('#countpolicy').html('Policy name exists for the business');
               $('#singlepolicyid').val('0');
                }
        }
      });

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
        //  console.log(data);
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



function appendnewcat(){

  var Mybase_url = base_url();
  var  businessid = $('#BusinessId22222').val();
  var spcatid= $('#policyId').val();
  $.ajax({
    url: Mybase_url+'ssa/policy/getaddcat/', 
    type:'POST',
    dataType: 'json',
    data: {'businessid':businessid,'policyid':spcatid},
   success: function(data){
         // console.log(data);
          //$("#tblCategoryedit").empty();
          $('#tblCategoryedit tbody tr').remove();
var i=0;
var sl;
var dl;
var ml;
if(data=="Something Went Wrong"){

  var display = '<tr><td>Record Not Found </td></tr>';
$('#tblCategoryedit tbody').append(display);

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
        $('#tblCategoryedit tbody').append(display);
              i++;

           });
}
}
  });
}

function ssdelete(id){
  var Mybase_url = base_url(); 
  var  businessid= $('#BusinessId22222').val();
//console.log(id);
$.ajax({
       url: Mybase_url+'ssa/policy/ssacatdelete/',
        type:'POST',
        data: { 'businessid':businessid, 'catid':id},
        success: function(data){
         // console.log(data);
          $("#remtr"+id).remove();
        }
      });
}

 
function ssaadd_cat_glcod(id){
  var val1=$("#gl_code"+id).val();
  //alert(id);
  console.log(val1);
$("#app"+id).append(
"<td><input type=text value="+val1+" id='glcodesave"+id+"'></td><td><input type='button' value='Save' id='hidebutton"+id+"' onclick=cat_save("+id+");></td>");
$("#rem"+id).remove();
 }

function cat_save(id){
var Mybase_url = base_url();
  var newglcod = $("#glcodesave"+id).val();
  var catname = $("#cat_"+id).val();
  $("#hidebutton"+id).remove();
  var app="<span id='rem"+id+"'>";
      app+="<label class='remove_attr' onclick=add_cat_glcod("+id+")>";
      app+="<p id="+id+">";
      app+="<input type='hidden' name='gl_code' id=gl_code value='"+newglcod+"'>"+newglcod;
      app+="</p>";
      app+="</label>";
      app+="</span>";
      app+="<span id='rem111"+id+"'</span>";

     

  $("#appendCat"+id).html(app);
 
$.ajax({
        url: Mybase_url+'business/dashboard/editspcatglcod/',
        type:'POST',

        data: {'act_mode':'sp_cat','newglcode':newglcod,'id':id},
        success: function(data){
        //  console.log(data);
        }
      });
}

function getallcatbusiness(){
  

  var Mybase_url = base_url();
  var  businessid = $('#BusinessId22222').val();
    $.ajax({
    url: Mybase_url+'ssa/policy/getallcatbusiness/', 
    type:'POST',
    dataType: 'json',
    data: {'businessid':businessid },
   success: function(data){
        //  console.log(data);

                   $('#1businessTab12 tbody tr').remove();
if(data=="Something Went Wrong"){

  var display = '<tr><td>Record Not Found </td></tr>';
$('#1businessTab12 tbody').append(display);

}

else{

$.each(data, function(index, val) {

      var disp='<tr id="remtr'+val.a_SpndngCatId+'">';
          disp+='<td><p>'+val.t_SpndName+'</p></td>';
            disp+='<td id="appendCat'+val.a_SpndngCatId+'">';
            disp+='<span id="rem'+val.a_SpndngCatId+'">';
            disp+='<label class="remove_attr" onclick="return ssaadd_cat_glcod('+val.a_SpndngCatId+');">';
            disp+='<p id="'+val.a_SpndngCatId+'">';
            disp+='<input type="hidden" name="gl_code" id="gl_code'+val.a_SpndngCatId+'" value="'+val.t_GLCode+'"/>';
            disp+='<input type="text" value="'+val.t_GLCode+'">';
            disp+='</p></label></span>';
            disp+='<span id="app'+val.a_SpndngCatId+'"></span></td>';
            disp+='<td><input type="button" name="delete" value="Delete"onclick="return ssdelete('+val.a_SpndngCatId+');">';
            disp+='</td></tr>';
        $('#1businessTab12 tbody').append(disp);
           });
}
   }
    });


}




function getallcatbusinessaddtime(id){
  

  var Mybase_url = base_url();
  var  businessid = id;
    $.ajax({
    url: Mybase_url+'ssa/policy/getallcatbusiness/', 
    type:'POST',
    dataType: 'json',
    data: {'businessid':businessid },
   success: function(data){
         // console.log(data);

                   $('#1businessTab12 tbody tr').remove();
if(data=="Something Went Wrong"){

  var display = '<tr><td>Record Not Found </td></tr>';
$('#1businessTab12 tbody').append(display);

}

else{

$.each(data, function(index, val) {

      var disp='<tr id="remtr'+val.a_SpndngCatId+'">';
          disp+='<td><p>'+val.t_SpndName+'</p></td>';
            disp+='<td id="appendCat'+val.a_SpndngCatId+'">';
            disp+='<span id="rem'+val.a_SpndngCatId+'">';
            disp+='<label class="remove_attr" onclick="return ssaadd_cat_glcod('+val.a_SpndngCatId+');">';
            disp+='<p id="'+val.a_SpndngCatId+'">';
            disp+='<input type="hidden" name="gl_code" id="gl_code'+val.a_SpndngCatId+'" value="'+val.t_GLCode+'"/>';
            disp+='<input type="text" value="'+val.t_GLCode+'">';
            disp+='</p></label></span>';
            disp+='<span id="app'+val.a_SpndngCatId+'"></span></td>';
            disp+='<td><input type="button" name="delete" value="Delete"onclick="return ssdelete('+val.a_SpndngCatId+');">';
            disp+='</td></tr>';
        $('#1businessTab12 tbody').append(disp);
           });
}
   }
    });


}

// add policy  system admin


// end add policy


  function ssapolicymilige(){
            var id = $('#policyId').val();
          var n_MaxRptMilage = $('#n_MaxRptMilage').val();
           var n_MilageRate = $('#n_MilageRate').val();
           var n_PerMeasuremnt = $('#n_PerMeasuremnt').val();
           var n_MaxExpMil = $('#n_MaxExpMil').val();
           var b_IsGPSReq = $('#b_IsGPSReq').val();
          // var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicylmilige/',
                    type:'POST',

                    data: {'id':id,'n_MaxRptMilage':n_MaxRptMilage,'n_MilageRate':n_MilageRate,'n_PerMeasuremnt':n_PerMeasuremnt,'n_MaxExpMil':n_MaxExpMil,'b_IsGPSReq':b_IsGPSReq },
                    success: function(data1){
                   // console.log(data1);
                    }
                    });
  }



        
 function ssapolicyspndlmt(){
            var id = $('#policyId').val();
          var n_DailyExpLmt = $('#n_DailyExpLmt').val();
           var n_MonthlyExpLmt = $('#n_MonthlyExpLmt').val();
           // var singlepolicy = $('#singlepolicyid').val();
           var Mybase_url = base_url();
                    $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicyspndlmt/',
                    type:'POST',
                    data: {'id':id,'n_DailyExpLmt':n_DailyExpLmt,'n_MonthlyExpLmt':n_MonthlyExpLmt},
                    success: function(data1){
                  //  console.log(data1);
                    }
                    });
            }

function ssapolicydeleteedit(id){
               var Mybase_url = base_url();
                   $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicydelete/',
                    dataType:'json',
                    type:'POST',
                    data: {'policyid':id },
                    success: function(data1){
                 //   console.log(data1);
                    if(data1=="Reimbursed"){
                    console.log(id);
                    ssapolicydel(id);
                  $("#plidttr"+id).remove();
            }
            else{
          $('#pmsg').html('This policy not delette');
            }
                    }
                    });
}

function ssapolicydel(id){

var Mybase_url = base_url();
                   $.ajax({
                    url: Mybase_url+'ssa/policy/ssapolicydel/',
                    dataType:'json',
                    type:'POST',
                    data: {'policyid':id },
                    success: function(data1){
                  //  console.log(data1);
                  //  ssapolicydel(id);
                    }
                    });

}






function getallcatbusinessa_addtime(busid){
  

  var Mybase_url = base_url();
  var  businessid = busid;
    $.ajax({
    url: Mybase_url+'ssa/policy/getallcatbusiness/', 
    type:'POST',
    dataType: 'json',
    data: {'businessid':businessid },
   success: function(data){
        //  console.log(data);

                   $('#1businessTab12 tbody tr').remove();
if(data=="Something Went Wrong"){

  var display = '<tr><td>Record Not Found </td></tr>';
$('#1businessTab12 tbody').append(display);

}

else{

$.each(data, function(index, val) {

      var disp='<tr id="remtr'+val.a_SpndngCatId+'">';
          disp+='<td><p>'+val.t_SpndName+'</p></td>';
            disp+='<td id="appendCat'+val.a_SpndngCatId+'">';
            disp+='<span id="rem'+val.a_SpndngCatId+'">';
            disp+='<label class="remove_attr" onclick="return ssaadd_cat_glcod('+val.a_SpndngCatId+');">';
            disp+='<p id="'+val.a_SpndngCatId+'">';
            disp+='<input type="hidden" name="gl_code" id="gl_code'+val.a_SpndngCatId+'" value="'+val.t_GLCode+'"/>';
            disp+='<input type="text" value="'+val.t_GLCode+'">';
            disp+='</p></label></span>';
            disp+='<span id="app'+val.a_SpndngCatId+'"></span></td>';
            disp+='<td><input type="button" name="delete" value="Delete"onclick="return ssdelete('+val.a_SpndngCatId+');">';
            disp+='</td></tr>';
        $('#1businessTab12 tbody').append(disp);
           });
}
   }
    });


}






        // End policy add