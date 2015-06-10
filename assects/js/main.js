/* var used for maintain status */
var wh,ww;
var wha;
var cc,carewidth,careheight,j=0,ccu=0;;
/* window size function */
function wsize(){
var winW = 630, winH = 460;
if (document.body && document.body.offsetWidth) {
 winW = document.body.offsetWidth;
 winH = document.body.offsetHeight;
}
if (document.compatMode=='CSS1Compat' &&
    document.documentElement &&
    document.documentElement.offsetWidth ) {
 winW = document.documentElement.offsetWidth;
 winH = document.documentElement.offsetHeight;
}
if (window.innerWidth && window.innerHeight) {
 winW = window.innerWidth;
 winH = window.innerHeight;
 }
wh=winH;
ww=winW;
 }
 
 function wsize(){
	 }
	 
	 function ssize(){
		 }
/* window size function */


/* window size function End*/
$(document).ready(function(){
	wsize();
	ssize();
	});
$( window ).resize(function(){
	wsize();
	ssize();
	});
	
$(document).ready(function(){
//$('.nav ul li:first a').addClass('active');
$(function(){
var url = window.location.href; 
$(".nav ul li a").each(function() {
    if(url == (this.href)){ 
        $(this).addClass("active");
    }
});
});


$(function(){

var url = window.location.href; 
$("#getsearchvalue li a").each(function() {
    if(url == (this.href)) { 
        $(this).addClass("selectedLeft");
    }
});
});

$(function(){

var url = window.location.href; 
$(".leftSide .leftmenu li a").each(function() {
    if(url == (this.href)) { 
        $(this).addClass("selectedLeft");
    }
});
});



var headH = $(".header").height();
var getH = $(".rightSide").height();
//alert(getH);
$(".leftSide").height(getH);
$(".dscp").click(function(){
		$(this).next("p").slideToggle();
	});
	
$("#prentCheck").click(function(){
	
	if($(this).prop("checked")){
		$(this).parents("table").find("td input[type='checkbox']").prop("checked",true);
		}
		else{
			$(this).parents("table").find("td input[type='checkbox']").prop("checked",false);
			}
});

var getHtmlexp = $(".exp table tr:last-child").html();
//alert(getHtmlexp);

var getnotes =$(".popup > .notes table tbody tr").html();
$(".addnotes").click(function(){
//	alert(getnotes);
$(".popup > .notes table tbody").fadeIn();
$(".popup > .notes table tbody tr:last").after('<tr>'+getnotes+'</tr>');
if($('.popup > .notes table tbody tr').length=='0'){
	$(".popup > .notes table tbody").append('<tr>'+getnotes+'</tr>');
}
else{
	//alert('no');
	}
});
$(document.body).on("click",".del",function(){

$(this).parent().parent().remove();
});

$(".pops").change(function(){
$(".overlay").slideToggle();
$("body").css("overflow","hidden");
});
$(".close_icon").click(function(){
$(".overlay,.popupsecond").slideUp();
$("body").css("overflow","visible");
});
});


$(document).ready(function(){
$('.nav ul li > ul').addClass('subMenu');
$('.subMenu').parent().addClass('.liArrow');

$(".addreport").click(function(){
$(".overlay2").slideToggle();
$("body").css("overflow","hidden");
});
$(".close_icon").click(function(){
$(".overlay2").slideUp();
$("body").css("overflow","visible");
});
});

$(document).ready(function(e){
	$(".right_topss1").click(function(){
		//$(this).children().toggleClass('secIcon2');
		$(this).next().css('display','table');
		//$('.tabS').toggle();
	});
	$(".right_topss1").dblclick(function(){		
		//$(this).children().toggleClass('secIcon2');
		$(this).next().css('display','none');
		//$('.tabS').toggle();
	});		

	$(document.body).off().on("click",".on_button",function(event){
	if($(this).hasClass('off_button')){
		//alert('yes');
		$(this).removeClass('off_button')
		//$(this).addClass("chk");	
	}	
	 else {
		//alert('no');
		$(this).addClass('off_button');
		$(this).parents('tr').find("input[type='text']").val('');
	
	}


	});

});

/*$(document).ready(function(e){
$(".right_topss1").click(function(){
//	alert('yes');
$(this).children().toggleClass('secIcon2');
$(this).next().toggle();
});
});*/

	//$(document).ready(function(){
//		$('#changePass').click(function(){
//			$(this).next().next().toggleClass('changePass2');
//		});
//	});
