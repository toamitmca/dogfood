///  ##################################  ASK ME BEFORE USING THIS FILE ITS ME MEANS SHEETESH ###############################
// ##################################  Edit by Rahul ###############################
function searchByBusinessEmp(){
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#billing_type').val();

var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'search','business_name': p_buainessname ,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          $('#getsearchvalue').empty();
          console.log(data1);
          if(data1=='Something Went Wrong'){
            var searchvalue = '<li>Data Not Found </li>';

 $('#getsearchvalue').append(searchvalue);
          }
          else{

       

          $.each(data1, function(key, values){

 var searchvalue1 = '<li onclick="return getemploye ('+values.a_BusinessId+')"><a href="#">'+values.t_BusinessName+'</a></li>';

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

function searchByStatusEmp(){

var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#billing_type').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: {'act_mode':'by_status', 'business_name': p_buainessname ,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          if(data1!='Something Went Wrong')
          {
        
          $('#getsearchvalue').empty();
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li onclick="return getemploye ('+values.a_BusinessId+')"><a href="#">'+values.t_BusinessName+'</a></li>';
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


function searchByBillingEmp(){
var p_buainessname = $('#b_search').val();
var p_status = $('#status').val();
var p_bullingtype = $('#billing_type').val();
var Mybase_url = base_url();
$.ajax({
        url: Mybase_url+'ssa/business/business_search/',
        type:'POST',
         dataType:'json',
        data: { 'act_mode':'by_bulling', 'business_name': p_buainessname ,'p_ststus':p_status ,'p_bullingtype':p_bullingtype},
        success: function(data1){
          if(data1!='Something Went Wrong')
          {
        
          $('#getsearchvalue').empty();
          $.each(data1, function(key, values){
          //console.log(values);
          var searchvalue1 = '<li onclick="return getemploye ('+values.a_BusinessId+')"><a href="#">'+values.t_BusinessName+'</a></li>';
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



function getemploye(businessId){
  var Mybase_url = base_url();
$('.buttonWrap').empty();
$('.buttonWrap').html("<a href="+Mybase_url+'ssa/superadmin/add_employee/'+businessId+" class=loadbtn>Add Employee</a>");

var search_data = $('#status').val();

$.ajax({
         url: Mybase_url+'ssa/employee/getEmployee/',
         type:'POST',
         dataType:'json',
         data: {'busid':businessId},
         success: function(data1){
          console.log(data1);
          $('#hello').empty();
           var i=1;
           var activeClass;
           var currstatus;
           var list;
          $.each(data1, function(key, values){
          console.log(values);
          $('#hello').empty();
          list+="<tr>"
          list+="<td>"+i+ "</td>";
          list+="<td>"+values.t_EmpCode+"</td>";
          list+="<td>"+values.t_EmpFirstName+' '+values.t_EmpLastName+ " </td>";
          list+="<td>"+values.t_EmaiId+"</td>";
          list+="<td>"+values.t_BusinessName+"</td>";
          list+="<td>"+values.t_DeptName+"</td>";
          if(values.b_Deleted==0){currStatusp='Inactive';}else{currStatusp='Active';}
          list+="<td>"+currStatusp+"</td>";
          list+="<td><a href="+Mybase_url+"ssa/superadmin/edit_employee/" +values.a_EmpId+ " class='edit'  for='atthFile'></a>"; 
          list+="<a href="+Mybase_url+"ssa/employee/employee_delete/"+values.a_EmpId+" class='del alert'></a>"; 
          if(values.b_Deleted==0){activeClass='active_button';currstatus='Active';}else{activeClass='inactive';currstatus='Inactive';}
          list+="<a href="+Mybase_url+"ssa/employee/employee_status/"+values.a_EmpId+"/"+values.b_Deleted+" class="+activeClass+" for='atthFile1' >";
          list+=currstatus;
          list+="</a></td></tr>";
 

         
         /* var searchvalue1 = '<td>'+i+'</td><td>'+values.t_EmpCode; +'</td><td>'+values.t_EmpFirstName+' '+values.t_EmpLastName +'</td><td>'+values.t_EmaiId +'</td><td>'+values.t_BusinessName+'</td><td>'+values.t_DeptName+'</td><td>'+ if(values.b_Deleted==0) { +' "Inactive"'+ } else {+ ' "Active"'+ } +'</td><td><a href="'+Mybase_url+'ssa/superadmin/edit_employee/'+values.a_EmpId; +'" class="edit" for="atthFile"></a> 
          <a  href="'+Mybase_url+'ssa/employee/employee_delete/'+values.a_EmpId;+'" class="del alert"></a><a href="'+Mybase_url+'ssa/employee/employee_status/'+values.a_EmpId;+'/'+values.b_Deleted;+'"'+ if(values.b_Deleted==0){ ?>+'class="active_button"'+ } else { +' class="inactive"'+ }+' for="atthFile1">'+ if(values.b_Deleted==0){ +' "Active"'+} else{+' "Inactive" '+}+'</a></td>';*/
          $('#hello').append(list);
            i++;
          });
           //console.log(data1);
        }
      });
    }


    ///  ##################################  ASK ME BEFORE USING THIS FILE ITS ME MEANS SHEETESH ###############################