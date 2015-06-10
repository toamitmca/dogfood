$(document).ready(function(){ 

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
/*
$("#saveReport").click(function(){

  var Mybase_url = base_url(); 
  // form submit starts here
  var report_name         = $("#report_name").val();
  var report_type         = $("#report_type").val();
  var status              = $("#status").val();
  var chaim_period_form   = $("#datepicker-example1").val();
  var cash_advance        = $("#cash_advance").val();
  var chaim_period_to     = $("#datepicker-example1s").val();
  var description         = $("#description").val();
 // var notes               = $(".notes").val();

  var kancha = [];
  var count = 0;
  
   $.each($('#deep .notesnotcheck'), function() {
        kancha.push($(this).val());
    });

  console.log(kancha);
  //console.log($(".notesnotcheck").val());
 


  if(report_name==""){
    $("#report_name").css('border','1px solid red');
    $("#report_name").focus();
    return false;
  }else{
    $("#report_name").css('border','1px solid green');
  }
  if(report_type==""){
    $("#report_type").css('border','1px solid red');
    $("#report_type").focus();
    return false;
  }else{
    $("#report_type").css('border','1px solid green');
}

    // ajax call will come here
      $.ajax({
        url: Mybase_url+'employee/dashboard2/reportsubmit/',
        type:'POST',
        //dataType:'json',
        data: {'report_name':report_name, 'report_type':report_type, 'status':status,'chaim_period_form':chaim_period_form,'cash_advance': cash_advance, 'chaim_period_to':chaim_period_to,'description':description,'kancha':kancha},
        success: function(data){
         console.log("Yes it is");
          console.log(data);
          /*if(data !=""){
            $("#lastId").val(data.p_a_PolicyId);
          }*/
    //    }
    //  });
              
    // ajax call ends here
  // form submit ends here
//});

$("#save_expenses").click(function(){
   var category  =  $("#category").val();
   var totalLoop =  $("#amount").val();
   var category  = []; 

});


// end of document
});
