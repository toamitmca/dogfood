

<footer class="footer">
<!-- <ul>
<li><a href="#">Home</a></li>
<li><a href="#">About us</a></li>
<li><a href="#">Profile</a></li>
<li><a href="#">Business</a></li>
<li><a href="#">Contact us</a></li>
</ul>
<p>Copyright © 2014 Tru Expenses. All Rights Reserved</p></footer> -->
</div>

</div>
</section>
<div class="fix"></div>

<script type="text/javascript" src="<?php echo base_url();?>assects/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/core.js"></script>
<script type="text/javascript">
	$('.alert').on("click",function(){
		var ok = confirm('Do you really want to update this record');
		if(ok){
			return true;
		}else{
			return false;
		}
		
	});

	function isNumber(evt) { 
        //Call this function  =  onkeypress="return isNumber(event)"
     var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
      alert('Please Enter onlye Numeric key')
        return false;
     }else{
      return true;  
    }
}
</script>

