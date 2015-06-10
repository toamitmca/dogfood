var mycount = 1;
$(document.body).on("click",".addexpense",function(){
$(".Expenses table tr:last").after('<tr>'
    +'<td><input type="checkbox" id="check_'+mycount+'"></td>'
    +'<td><img src="http://localhost/expense2/assects/images/icons/RupeesIcon.png"></td>'
    +'<td>'
    +'<select class="pops" name="category" id="category_'+mycount+'">'
    +'<option>Select</option>'
    +'<option>Select</option>'
    +'<option>Select</option>'
    +'<option>Select</option>'
    +'<option>Money Spent</option>'
    +'</select>'
    +'</td>'

    +'<td><input id="datepicker-example1s5" class="dat" name="date_'+mycount+'" type="text"></td>'
    +'<td><input type="text" value="" id="amount" name="amount_'+mycount+'"></td>'
    +'<td><input type="text" value="" id="merchant_'+mycount+'"></td>'
    +'<td><input type="text" value="" id="purpose_'+mycount+'"></td>'
    +'<td><input type="checkbox" name="" id="reimb_'+mycount+'"></td>'
    +'<td>'
    +'<select name="" id="tag_'+mycount+'">'
    +'<option>Yes</option>'
    +'<option>No</option>'
    +'</select>'
    +'</td>'
    +'<td><a href="#" class="bug"></a> '
    +'<label class="link" for="atthFile_'+mycount+'"></label>'
    +'<input type="file" id="atthFile_'+mycount+'" class="atthFile">'
    +'<a class="del"></a>'
    +'</td>'+
      '</tr>');
  $("#mainlimit").val(mycount++);
});

