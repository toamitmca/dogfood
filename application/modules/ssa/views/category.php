<?php 

?>
<section class="main_caintainer">
	<div class="leftSide" ></div>
	
<div class="rightSide">
	<div>
		<span class="buttonWrap">
			<a href="<?php echo base_url(); ?>ssa/superadmin/add_employee/" class="loadbtn bluebg">Add Employee</a>
		</span>
		<div class="fix"></div>
	</div>
	 <?php
  if(validation_errors()){
    echo '<div class="error">'.validation_errors().'<div class="fix"></div></div>';
  }
?>
	<form name="detail_informaton" id="detail_informaton" method="post" action=""> 
	




	
	
	<div class="formPreExp">
		<div class="col">
			<label>Category</label>
			<input type="text" name="category" id="category" value=""/>
		</div>
		<div class="col">
			<label>Category1</label>
				<input type="text" name="category1" id="category1" value="" />
		</div>
		
		
	
		
	</div>
<!--<h2 class="genHead">Milage</h2>

<div class="right_top">&nbsp;</div>
<h2 class="genHead">Period Spending Limits</h2>

<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Spending Limits</a></span>
<div class="fix"></div></div>
<h2 class="genHead">Period Category Restrictions</h2>
<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Category Restrictions</a></span>
<div class="fix"></div></div>-->
			</div>
		</form>
	
</section>
<div class="fix"></div>

<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">



function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}





</script>
</body>
</html>
