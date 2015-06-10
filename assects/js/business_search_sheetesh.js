// ############################### SHEETESH WORK START FROM HERE  24 NOV ####################
function base_url(){
  var pathArray = window.location.href.split( '/');
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}
function busines_searchmy(){
  
var b_status = $('#status').val();
var p_bulling_type = $('#bulling_type').val();
var search_data = $('#b_search').val();

var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'search','business_name':search_data ,'p_ststus':b_status,'p_bullingtype':p_bulling_type},
        success: function(data1){
          console.log(data1);
          $('#getsearchvalue').empty();
         
          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{
         $.each(data1, function(key, values){
 var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });
             }

        }
      });
    }




function busines_searchmyadmin(){
var search_data = $('#b_searchssa').val();
var bulling_typessa = $('#bulling_typessa').val();
var statusssa = $('#statusssa').val();

var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'search','business_name': search_data,'p_ststus':statusssa,'p_bullingtype':bulling_typessa},
        success: function(data1){
          $('#getsearchvalue').empty();
         
          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{
         $.each(data1, function(key, values){
 var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/businessadminlist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
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

function bystatus_searchmy(){
var search_data = $('#status').val();
var p_bulling_type = $('#bulling_type').val();
var p_businessname = $('#b_search').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: {'act_mode':'by_status','business_name':p_businessname,'p_ststus':search_data,'p_bullingtype':p_bulling_type},
        success: function(data1){
          $('#getsearchvalue').empty();

          if(data1=='Something Went Wrong'){
var searchvalue2="<li>Record not found</li>";

            $('#getsearchvalue').append(searchvalue2);

          }
else{
              $.each(data1, function(key, values){
              //console.log(values);
              var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
              $('#getsearchvalue').append(searchvalue1);
              });
}
        }
      });
    }

function bystatus_searchmyadmin(){
var p_status = $('#statusssa').val();
var p_bullingtype = $('#bulling_typessa').val();
var p_businessname = $('#b_searchssa').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: {'act_mode':'by_status','business_name':p_businessname,'p_ststus': p_status ,'p_bullingtype':p_bullingtype},
         success: function(data1){
          if(data1!='Something Went Wrong')
          {

          $('#getsearchvalue').empty();
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/businessadminlist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });
        }
        else 
        {

          $("#getsearchvalue").html('Sorry..! Record Not Found');
        }

      }

      });
    }





    // end by status search   return bybulling_search()

    // Start By bulling search


function bybulling_searchmy(){
var search_status = $('#status').val();
var p_bulling_type = $('#bulling_type').val();
var p_businessname = $('#b_search').val();
var Mybase_url = base_url();

$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_bulling',  'business_name': p_businessname, 'p_ststus':search_status ,'p_bullingtype':p_bulling_type},
        success: function(data1){
          if(data1 !='Something Went Wrong')
          {
        
          $('#getsearchvalue').empty();
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/business_edit/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });
        }
        else 
        {
          var t="<li>Record not found</li>";
          $("#getsearchvalue").append(t);
        }
        
      }
     
      });
    }



function bybulling_searchmyadmin(){
var search_data = $('#bulling_typessa').val(); 
var b_name = $('#b_searchssa').val();
var statusssa = $('#statusssa').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_bulling', 'business_name':b_name , 'p_ststus':statusssa , 'p_bullingtype': search_data},
        success: function(data1){
          if(data1!='Something Went Wrong')
          {

          $('#getsearchvalue').empty();
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li><a href="'+Mybase_url+'ssa/business/businessadminlist/'+values.a_BusinessId+'">'+values.t_BusinessName+'</a></li>';
          $('#getsearchvalue').append(searchvalue1);
          });
        }
        else 
        {

          $("#getsearchvalue").html('Sorry..! Record Not Found');
        }

      }

      });
    }


// ############################### SHEETESH WORK END  HERE  24 NOV ####################
// ############################################# SHEETESH WORK START ########################



// ######################################## SHEETESH WRK END ##################################

//############################################ Rahul  WORK START HERE 30 NOV#####

function searchEmpbus(){
var busid = $('#businesslisting').val();

if(busid >0){
$("#employeelisting").show();
}


var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/claimreport/myClaimEmp/',
        type:'POST',
         dataType:'json',
          data: {'busid': busid},
          success: function(data){
          //console.log(data);
          if(data!='Something Went Wrong')
          {

          $('#employeelisting').empty();
          $('#employeelisting').append('<option value="">Select Employee</option>')
          $.each(data, function(key, values){
          //console.log(values);
          var searchvalue1 = '<option value="'+values.a_EmpId+'">'+values.t_EmpFirstName+'</option>';
          $('#employeelisting').append(searchvalue1);
          });
        }
        else
        {  $('#employeelisting').empty();
          var searchvalue1 = '<option value="">Sorry No Employee</option>';
          $('#employeelisting').append(searchvalue1);

        }

      }

      });
    }
function searchEmpReportsssa(){
var busid = $('#employeelisting').val();
var list='';
var Mybase_url = base_url();
$.ajax({
          url: Mybase_url+'ssa/claimreport/myClaimreportByEmp/',
          type:'POST',
          dataType:'json',
          data: {'busid': busid },
          success: function(data){
          
            $('#appendReport1 li').remove();
          if(data=="Something Went Wrong")
          {

var list = "<li>Sorry No Report</li>";
          $('#appendReport1').append(list);
         }
        else
        {
   $.each(data , function(key,values){
     var from = values.d_ClaimFrom.substr(0,10);
     var foryer= values.d_ClaimFrom.substr(0,4);
     var formonth= values.d_ClaimFrom.substr(5,2);
     var formdat= values.d_ClaimFrom.substr(8,2);

    var to = values.d_ClaimTo.substr(0,10);


    var toyer= values.d_ClaimTo.substr(0,4);
    var tomonth= values.d_ClaimTo.substr(5,2);
    var tomdat= values.d_ClaimTo.substr(8,2);


    var createdyer= values.d_CreatedOn.substr(0,4);
    var createdmonth= values.d_CreatedOn.substr(5,2);
    var createdmdat= values.d_CreatedOn.substr(8,2);


      var list1='';
           list1 += "<li onclick='return reportload("+values.a_ReportId+","+values.n_BusinessId+","+values.n_DeptId+","+values.n_CreatedBy+","+values.n_PolicyId+");'><div class='colL2'>";
           list1 += "<h5>"+values.t_ReportName+"</h5>";
           list1 += "<span class='date'>"+formdat+"/"+formonth+"/"+foryer+" - "+tomdat+"/"+tomonth+"/"+toyer+"</span>";
           list1 += "<span class='price'><span class='WebRupee'>Rs </span>"+values.n_AmountReq+"</span>";
           list1 += "<h4 class='colour'>"+values.t_EmpFirstName+" "+values.t_EmpLastName+"</h4>";
           list1 += "<span>"+createdmdat+"/"+createdmonth+"/"+createdyer+"</small></span></span></div></li>";
           $('#appendReport1').append(list1);
            });


        }
          }
      });
    }


function reportload(report,business,department,createdby,policy){

var Mybase_url = base_url();
                   $.ajax({
                    url: Mybase_url+'ssa/claimreport/ssareport/',
                    //dataType:'json',
                    type:'POST',
                    data: {'report':report ,'business':business ,'department':department,'createdby':createdby,'policy':policy },
                    success: function(data1){
                    
                $('#loadreport').html(data1);
                    }
                    });
}

  //  ############# Rahul Yadav ##########