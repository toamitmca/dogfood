function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}
/*function busines_search(){
var search_data = $('#b_search').val();
//alert(search_data);
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_name','send_data': search_data},
        success: function(data1){
          $('#getsearchvalue').empty();
          console.log(data1);
          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{
          $.each(data1, function(key, values){
 var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          //console.log(values);
          //values.a_BusinessId
          $('#getsearchvalue').append(searchvalue1);
          });
             }
          // console.log(data1);
        }
      });
    }*/




function policy_search(){
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#bulling_type').val();
//alert(search_data);
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'search','business_name':p_buainessname ,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          $('#getsearchvalue').empty();
          console.log(data1);
          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{

       

          $.each(data1, function(key, values){

 var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/policy/policylist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';

          //console.log(values);
          //values.a_BusinessId
         
          $('#getsearchvalue').append(searchvalue1);
          });
             }
          // console.log(data1);
        }
      });
    }

    // by status search  start
/*
function bystatus_search(){
var search_data = $('#status').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: {'act_mode':'by_status', 'send_data': search_data},
        success: function(data1){
          $('#getsearchvalue').empty();
if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
else{


          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });

}
           console.log(data1);
        }
      });
    }
*/




function policybystatus_search(){
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#bulling_type').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: {'act_mode':'by_status','business_name':p_buainessname,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){

          console.log(data1);
          $('#getsearchvalue').empty();

if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{


          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/policy/policylist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });

}
           console.log(data1);
        }
      });
    }

    // end by status search   return bybulling_search()

    // Start By bulling search


/*function bybulling_search(){
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#bulling_type').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_bulling', 'business_name': p_buainessname ,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          $('#getsearchvalue').empty();
if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }

else{
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });
}

           console.log(data1);
        }
      });
    }*/


function policybybulling_search(){
//var search_data = $('#bulling_type').val();
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#bulling_type').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_bulling', 'business_name':p_buainessname,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          $('#getsearchvalue').empty();

if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{



          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/policy/policylist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });

          }
           console.log(data1);
        }
      });
    }

function inactive() {

	var retVal = confirm("Do you want to continue ?");
   if( retVal == true ){
   	var data = $('#').val();
      alert("User wants to continue!");
	  //return true;
   }else{
      alert("User does not want to continue!");
	  return false;
   }
}
    // End by bulling search

// #################   Start  ssa admin policy  edit and save  ################ 

       

        




// ##################### End ssa admin policy save ##############################


function add_category(){
var Mybase_url = base_url();
var  businessid = $('#businessid11').val();
var id = $('#policyId').val();
var arrcat=new Array();
$('#tblCategory tbody tr').each(function(row,tr){
arrcat[row]={ "cat_id":$(tr).find('td:nth-child(1) input[type=hidden]').val() ,
"sp_cat_single_exp_limit":$(tr).find('td:nth-child(4) input[type=text]').val() ,
"sp_cat_single_daily_limit":$(tr).find('td:nth-child(5) input[type=text]').val() ,
"sp_cat_single_month_limit":$(tr).find('td:nth-child(6) input[type=text]').val()
};

})
  // var savedatacat = JSON.stringify(arr);
  // alert(savedatacat);

 $.ajax({
       url: Mybase_url+'ssa/policy/ssapolicycategory/',
        type:'POST',
        data: { 'a_mode':'Insert', 'policyId':id,'a_BusinessId':businessid, 't_PolicyName':arrcat},
        success: function(data){
          console.log(data);
        }
      });

 // alert(JSON.stringify(arr));

}




function add_categoryupdate(){
var Mybase_url = base_url();
var  businessid = $('#businessid11').val();
var id = $('#policyId').val();
var arrcat=new Array();
$('#tblCategoryedit tbody tr').each(function(row,tr){
arrcat[row]={ "cat_id":$(tr).find('td:nth-child(1) input[type=hidden]').val() ,
"sp_cat_single_exp_limit":$(tr).find('td:nth-child(4) input[type=text]').val() ,
"sp_cat_single_daily_limit":$(tr).find('td:nth-child(5) input[type=text]').val() ,
"sp_cat_single_month_limit":$(tr).find('td:nth-child(6) input[type=text]').val()
};

})
  // var savedatacat = JSON.stringify(arr);
  // alert(savedatacat);   password

 $.ajax({
       url: Mybase_url+'ssa/policy/ssapolicycategory/',
        type:'POST',
        data: { 'a_mode':'update', 'policyId':id,'a_BusinessId':businessid, 't_PolicyName':arrcat},
        success: function(data){
          console.log(data);
        }
      });

 // alert(JSON.stringify(arr));

}



// report search on system admin 
function reportsearch(){
 var businessid= $('#businessid').val();
//alert(businessid);

var Mybase_url = base_url();
console.log(businessid);
$.ajax({
        url: Mybase_url+'ssa/claimreport/searchreport',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_name','businessid':businessid },
        success: function(data1){
           console.log(data1);
           
          $('#empty1111').empty();

          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not "vg" Found </li>';

         $('#empty1111').html(searchvalue);
          }
          else{
          $.each(data1, function(key, values){
         // var searchvalue1 = '<li><a class="colL2" href="'+Mybase_url+'ssa/business/business_edit/'+values.t_ReportName+'">'+values.t_ReportName+'</a></li>';

        var searchvalue1 ='<div class="colL2" id="appendReport"><h5><a href="'+Mybase_url +'ssa/claimreport/detailReports/'+values.a_ReportId+'/'+values.n_BusinessId+'">'+values.t_ReportName+'</a></h5><span class="date">'+values.d_ClaimFrom+' '+values.d_ClaimTo+'</span><span class="iconerror"></span><span class="price"><span class="WebRupee">Rs</span>'+values.n_CashAdvance+'</span><h4>'+values.t_EmpFirstName+'  '+values.t_EmpLastName+'</h4><span class="submitt">Submitted<small></small></span><a href="'+Mybase_url+'ssa/claimreport/detailReports/'+values.a_ReportId+'/'+values.n_BusinessId+'" class="aprove">aprove</a><a href="'+Mybase_url+'ssa/claimreport/detailReports/'+values.a_ReportId+'"class="iconlink"></a></div>';

        $('#empty1111').append(searchvalue1);

         // $('#empty1111').html(searchvalue1);
          });
             }
          // console.log(data1);
        }
      });
}


//end 

function addnewcat11111(data){
  var Mybase_url = base_url();
  console.log(data);
  var businessid =$('#BusinessId22222').val();
  var policyid = $('#policyId').val();
var  single_limit = $("#sp_cat_single_exp_limit"+data).val();
var daly = $("#sp_cat_single_daily_limit"+data).val();
var monthely =$("#sp_cat_single_month_limit"+data).val();

$.ajax({
       url: Mybase_url+'ssa/policy/addnewspcatinpolocy/',
        type:'POST',
        data: { 'businessid':businessid, 'policyid':policyid,'spcatid':data ,'singlelimt':single_limit,'dalylimit':daly,'monthely':monthely },
        success: function(data){
          console.log(data);
     /*if(data==1){

$('#password').val('');
$('#cpassword').val('');
$('#msg').html('password update successfully');

     }*/

        }
      });


// alert(data);
 }




  //  ############# Rahul Yadav ##########