function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}

//  add department start 

/*$(function(){

AddNewRow();	
})*/
function AddNewRow()
{
	//alert("test");
$('#tblDept tbody').append(
"<tr><td><input type=text name='dept_name_search' class='dept_name' id='dept_name_search_0'><input type=text name=flag value=1 id=flag_0 ></td><td><input type=button value=Delete onclick=RemoveRow(this);></td></tr>");
}
function RemoveRow(input)
{
var per=$(input).parents('tr');
$(per).remove();

}

function add_department(){
	  var Mybase_url = base_url();
var arr=new Array();
$('#tblDept tbody tr').each(function(row,tr){
arr[row]={
	t_DepartmantName:$(tr).find('td:first input[type=text]').val() ,
  flag:$(tr).find('td:first input[type=hidden]').val() 

};
if($('td:first input[type=text]').val()==''){
	alert('Please Enter Department name');
	return false;
	}
	else{
		//alert('yes');
		$('#form211 input[type="button"]').addClass('tabRun');
		}
})
   var savedata = JSON.stringify(arr);
   if(savedata.length < 0){
    $('#department').css("border","solid 1px red");
       $('#department').focus();
     return false ;
   }
 $.ajax({
        url: Mybase_url+'business/dashboard/department_add/',
        type:'POST',
        data: {'t_PolicyName':arr},
        success: function(data){
          $('#departent').html('Department added Successfully!');
          getdepartment();
        }
      });
}

// end Department add

// start add category
/*$(function(){
AddNewRow_category();
})*/

function AddNewRow_category()
{
	add_cat_glcod
$('#tblCategory tbody').append("<tr><td><input type=text></td><td><input type=text></td><td><input type=button value=Delete onclick=RemoveRowcategory(this);></td></tr>");

}
function RemoveRowcategory(input)
{
var per=$(input).parents('tr');
$(per).remove();

}

function add_category(){
var Mybase_url = base_url();
var arrcat=new Array();
$('#tblCategory tbody tr').each(function(row,tr){
arrcat[row]={ "t_category_name":$(tr).find('td:nth-child(1) input[type=text]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
};


if($('#tblCategory tbody tr td:nth-child(1) input[type="text"]').val()==''){
  alert('Please Enter Department name');
  return false;
  }
  else{
    //alert('yes');
    $('#form3 input[type="button"]').addClass('tabRun');
    }

})
 $.ajax({
        url: Mybase_url+'business/dashboard2/sending_cat_add/',
        type:'POST',
        data: {'t_PolicyName':arrcat},
        success: function(data){
      $('#spand_cat').html('Spending category added successfully!');
          getspendcat();
        }
      });

 // alert(JSON.stringify(arr));

}

//  end add category  

// Start  add custom Tag






function RemoveRow_customtag(input)
{
var per=$(input).parents('tr');
$(per).remove();

}

function add_customtag_one(){
	  var Mybase_url = base_url();
var arrcustomtag=new Array();
$('#tblcustomtag_one tbody tr').each(function(row,tr){
arrcustomtag[row]={ "t_customtag":$(tr).find('td:nth-child(1) input[type=text]').val() ,"flag":$(tr).find('td:nth-child(2) input[type=hidden]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
};

if($('#tblcustomtag tbody tr td:nth-child(1) input[type="text"]').val()==''){
  alert('Please Enter Department name');
  return false;
  }
  else{
    $('#form4 input[type="button"]').addClass('tabRun');
    }
})
 $.ajax({
        url: Mybase_url+'business/dashboard/customtag_add/',
        type:'POST',
        data: {'t_PolicyName':arrcustomtag ,'c_tag':'1'},
        success: function(data){
         // console.log(data);
          getcustomtag_one();
          $('#custom_tag_msg').html('custom tag1  added Successfully!');
        }
      });
}
function add_customtag_two(){
    var Mybase_url = base_url();
var arrcustomtag_two=new Array();
$('#tblcustomtag_two tbody tr').each(function(row,tr){
arrcustomtag_two[row]={ "t_customtag":$(tr).find('td:nth-child(1) input[type=text]').val()  ,"flag":$(tr).find('td:nth-child(2) input[type=hidden]').val() ,"t_glcode":$(tr).find('td:nth-child(2) input[type=text]').val()
};

if($('#tblcustomtag tbody tr td:nth-child(1) input[type="text"]').val()==''){
  alert('Please Enter Department name');
  return false;
  }
  else{
    $('#form4 input[type="button"]').addClass('tabRun');
    }
})
 $.ajax({
        url: Mybase_url+'business/dashboard/customtag_add/',
        type:'POST',
        data: {'t_PolicyName':arrcustomtag_two ,'c_tag':'2'},
        success: function(data){
          $('#custom_tag_msg').html('custom tag2  added Successfully!');
         // console.log(data);
         getcustomtag_two();
        }
      });
}







function save_rembr(){
	 var Mybase_url = base_url(); 
	var manul = $('#remenber_mt').val();
  console.log(manul);
	if(manul=="") {
		$('#remenber_mt').css("border","solid 1px red");
       $('#remenber_mt').focus();
     return false ;

	}
	//alert(manul);
   $.ajax({
        url: Mybase_url+'business/dashboard/addRemember/',
        type:'POST',
        data: {'remenbmt':manul},
        success: function(data){
          console.log(data);
          if(data!=''){
            $("#form5").css('display','none');
            //$("#displayMsg")
            $("#displayMsg").append('Created Successfully').delay(2000).fadeOut();
          }

        }
      });
}



function add_cat_glcod(id){
  //alert(id);
  var val=$("#gl_code"+id).val();
  console.log(val);
$("#rem11"+id).append(
"<td><input type=text value="+val+" id='glcodesave"+id+"'></td><td><input type=button value=Save id='hidebutton"+id+"' onclick=cat_save("+id+");></td>"
  );
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
      app+="<input type='hidden' name='gl_code' id='gl_code"+id+"' value='"+newglcod+"'>"+newglcod;
      app+="</p>";
      app+="</label>";
      app+="</span>";
      app+="<span id='rem11"+id+"'</span>";
      
      // app+="</td>";

  $("#appendCat"+id).html(app);
 
$.ajax({
        url: Mybase_url+'business/dashboard/editspcatglcod/',
        type:'POST',

        data: {'act_mode':'sp_cat','newglcode':newglcod,'id':id},
        success: function(data){
          console.log(data);
        }
      });
}


// End  add custom Tag   
function add_ctag_glcod(id){
  var val=$("#gl_code1"+id).val();
  console.log(val);
$("#remtag11"+id).append(
"<td><input type=text value="+val+" id='tagglcodesave"+id+"'></td><td><input type=button id='hidebuttontag"+id+"' value=Save onclick=tag_save("+id+");></td>"
  );
 $("#remtag"+id).remove();
 }
function tag_save(id){
  var Mybase_url = base_url(); 
  var newglcodtag = $("#tagglcodesave"+id).val();
  var tagname = $("#tag_"+id).val();
  console.log(newglcodtag);
  $("#hidebuttontag"+id).remove();
  var app="<span id='remtag"+id+"'>";
      app+="<label class='remove_attr' onclick=add_ctag_glcod("+id+")>";
      app+="<p id="+id+">";
      app+="<input type='hidden' name='gl_code1' id='gl_code1"+id+"' value='"+newglcodtag+"'>"+newglcodtag;
      app+="</p>";
      app+="</label>";
      app+="</span>";
      app+="<span id='remtag11"+id+"'</span>";
      
      // app+="</td>";

  $("#appendCust"+id).html(app);
 // console.log(tagname);
 // console.log(newglcodtag);
// console.log(id);

$.ajax({
        url: Mybase_url+'business/dashboard/editsptext/',
        type:'POST',

        data: {'act_mode':'custon_tag','newglcode':newglcodtag,'id':id},
        success: function(data){
          console.log(data);
          //$("#displayMsg").html().fadeIn().delay(2000).fadeOut();
        }
      });

}

// edit cat glcode start

// End edit cat glcode search

