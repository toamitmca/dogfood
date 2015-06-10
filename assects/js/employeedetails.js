// ###################### SHEETESH 24 NOV ######################
$(document).ready(function(){
  $("#search_name").empty();
});

$("#email1").on('keyup' , function(){


  var emailId = $("#email1").val();
    var MybaseUrl = "<?php echo base_url();?>";
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    //console.log(emailId);
    if(emailId==''){
      return false;
    }
    if(filter.test(emailId)){
      $(".loadingemail").css('display', 'block');
      $("#email1").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard2/checkemail',
        type: 'POST',
        dataType: 'json',
        data: {'email':emailId},
        success:function(data){
          //console.log(data);
          if(data.emailcorrect >0){
            $("#email1").after('<span>Already have an account with this mail id</span>');
            $("#email1").parent().find('span').not("span:first").remove();
            $(".loadingemail").css('display', 'none');
          }else{
            $(".loadingemail").css('display', 'none');
          }
          
        }
      });
    
    }else{
      $("#email1").after('<span>Please Enter Valid Email</span>');
      $("#email1").parent().find('span').not("span:first").remove();
    }
    
});



$("#employee_id").on('keyup' , function(){
      var  empID = $("#employee_id").val();
      var MybaseUrl = "<?php echo base_url();?>"
      console.log(empID);
      $(".loadingemail").css('display', 'block');
      $("#employee_id").parent().find('span').remove();
      $.ajax({
        url: MybaseUrl+'business/dashboard2/empidcheck',
        type: 'POST',
        dataType: 'json',
        data: {'empid':empID},
        success:function(data){
          //console.log(data);
          if(data.empcode >0){
            $("#employee_id").after('<span>This Employee Id Already Exist Try Another</span>');
            $("#employee_id").parent().find('span').not("span:first").remove();
            $(".loadingemail").css('display', 'none');
          }else{
            $(".loadingemail").css('display', 'none');
          }
          
        }
      });
    
    
});


  function getstate (){
    $("#state_id").empty();
    $("#state_id").html("<option value=''>Select a State</option>");
    var countryId=$("#country").val();
    console.log(countryId);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/getStateDropDown",
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
  }


  function getcity()
  {
    $("#city_id1").empty();
    $("#city_id1").html("<option value=''>Select a City</option>");
    var stateId=$("#state_id").val();
    console.log(stateId);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/getCityDropDown",
      type: 'POST',
      data: { id : stateId },
      async: true,
        dataType: "json",
      success: function (data) {
            console.log(data);

              $.each(data,function (index,value){
        $("#city_id1").append("<option value='"+value.a_CityId+"'>"+value.t_CityName+"</option>");
        });
           }
      });
  }
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







 function getpolicy()
  { var busid=$("#business").val();
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/emppolicy",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
          success: function (data) {
          console.log(data);
          if(data!='Something Went Wrong')
          {
          $("#policy").empty();
          $("#policy").append("<option >Select Policy</option>");
          $.each(data,function (index,value){
          $("#policy").append("<option value="+value.a_PolicyId+">"+value.t_PolicyName+"</option>");
          });
        }
        else 
        {
          $("#policy").empty();
          $("#policy").append("<option >Select Policy</option>");
          $("#policy").append("<option >No Policy</option>"); 
        }
           
        }
      });
  }
 function getdepartment()
  { var busid=$("#business").val();
    console.log(busid);
    $.ajax({
      url: "<?php echo base_url();?>ssa/superadmin/empdepartment",
      type: 'POST',
      data: { busid : busid },
      async: true,
      dataType: "json",
      success: function (data) {
              console.log(data);
               if(data!='Something Went Wrong')
               {
              $("#department").empty();
              $("#department").append("<option >Select Department</option>");
              $.each(data,function (index,value1){
              $("#department").append("<option value="+value1.a_DeptId+">"+value1.t_DeptName+"</option>");
              });
            }
            else 
            {
              $("#department").empty();
              $("#department").append("<option >Select Department</option>");
              $("#department").append("<option >No Department</option>");

            }
            }
          });
        }
// ########################################################## sheetesh END #########################