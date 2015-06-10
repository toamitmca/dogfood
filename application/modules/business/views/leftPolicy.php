<script>
$(function() {
  $('.leftmenu li a[href*=#]:not([href=#])').click(function() {
	
 	var getHeaderH=$(".header").height();
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').delay(200).animate({
          scrollTop: target.offset().top
        }, 1000);
		
		//$('.leftmenu').delay(200).animate({"margin-top":target.offset().top-getHeaderH}, 1000);
        return false;
      }
    }
  });
  
  var offset = $(".leftmenu").offset().top;			
            var topPadding = 15;			
			//alert(offset)

	//$(window).on("scroll",function(){
//		//alert("yes");
//		var getHeader =$(".header").height();
//		
//		if ($(window).scrollTop() > offset) {
//
//                    $(".leftmenu").stop().animate({
//                        top: $(window).scrollTop() - offset
//                    });
//                } else {
//                    $(".leftmenu").stop().animate({
//                        top: 0
//                    });
//                };
//	});
  
  
});
</script>
<div class="leftSide">
<ul class="leftmenu">
	<li><a href="#form1" onclick="tab(this);" >General</a></li>
	<li><a href="#form2" onclick="tab(this);" >Mileage</a></li>
	<li><a href="#form3" onclick="tab(this);" >Spending Limit</a></li>
	<li><a href="#form4" onclick=" appendnewcatbusiness();  tab(this);" >Spending Categories Limits</a></li>
</ul>
</div>


<!--<div class="leftSide">
<ul class="leftmenu">
	<li><a href="<?php echo base_url();?>business/dashboard/policyadd/" id="form1" >General</a></li>
	<li><a href="<?php echo base_url();?>business/dashboard/mileage/" id="form2" >Mileage</a></li>
	<li><a href="<?php echo base_url();?>business/dashboard/spendinglimit/" id="form3" >Spending Limit</a></li>
	<li><a href="<?php echo base_url();?>business/dashboard/restriction/" id="form4" >Spending Categories Limits</a></li>
</ul>
</div>-->