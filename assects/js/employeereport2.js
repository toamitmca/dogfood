/*$(document).ready(function(){ 

function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}

/*$(".leftmenu li a:first").addClass("selected");
$(".leftmenu li a").click(function(){	
	var getRel=$(this).attr("rel");
	console.log(getRel);
	$(".leftmenu li a").removeClass("selected");
	$(this).addClass("selected");
	$(".tabcontent").slideUp();
	$("#"+getRel).slideDown();
});*/


$("#save_expenses").click(function(){
   var category  =  $("#category").val();
   var totalLoop =  $("#amount").val();
   var category  = []; 
   var amount    = [];
   var merchant  = [];
   var purpose   = [];



    $.each($('table tr #amount'), function() {
        if($(this).val()!= ""){
          amount.push($(this).val());  
        }
    });

    $.each($('table tr #merchant'), function() {
        if($(this).val()!= ""){
          merchant.push($(this).val());  
        }
    });

    $.each($('table tr #purpose'), function() {
        if($(this).val()!= ""){
          purpose.push($(this).val());  
        }
    });

    $.each($('table tr #category option:selected'), function() {
        if($(this).val()!= ""){
          category.push($(this).val());  
        }
    });
   });


 

    // ajax call will come here
     /* $.ajax({
        url: Mybase_url+'employee/dashboard2/expencepolicymapsubmit/',
        type:'POST',
        //dataType:'json',
        data: {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha},
        success: function(data){
         console.log("Yes it is");
          console.log(data);
       
        }
      });*/
              
    // ajax call ends here
  // form submit ends here
//});


// end of document
//});
*/