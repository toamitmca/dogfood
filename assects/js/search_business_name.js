function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}
function searchByName()
{
    var searchValue=$("#search_name").val();
    var Mybase_url = base_url();
    //console.log(searchValue);
    if(searchValue!=''){
  
        $("#myloading").css('display','block');
        $.ajax({
              url: Mybase_url+"business/dashboard2/searchBusinessName",
              type: 'POST',
              data: { name : searchValue },
              dataType:'json',
              success: function (data) {
                    
                  if(data.error =="User could not be found"){
                        $("#leftMenu").html("NO Result Found");
                  } else{
                    
$("#leftMenu").empty();
                  $.each(data, function(index, value) {
                      //console.log(value.t_FirstName);
                      var searchvalue1 = '<li><a href="'+Mybase_url+'business/dashboard/businessLeft/'+value.a_BusinessId+'">'+value.t_FirstName+' '+value.t_LastName+'</a></li>';
                      //console.log(searchvalue1);
                      $("#leftMenu").append(searchvalue1);
                  });

                  }

                }

            });
    }
    else 
    {
        $("#leftMenu").html('Please Enter Valid name');

    }
}
