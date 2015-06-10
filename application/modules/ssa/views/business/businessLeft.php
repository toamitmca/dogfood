 <div class="leftSide">
    <ul class="leftmenu colL">
    <input list="browsers" type="text" name="busiinesssearch"  autocomplete="off" id="b_search" onkeyup="return busines_searchmy();" placeholder="Search Business ">
    <span class="iconsel" id="advancesearch"></span>
   <select name="status" id="status" onchange="return busines_searchmy();" class="none advancesearch" >
         <option value=""> Select</option>
            <option value='2' <?php echo set_select('status', '2'); ?> >Open</option>
            <option value='1' <?php echo set_select('status', '1'); ?>  >Close</option>
            <option value='3' <?php echo set_select('status', '3'); ?> >Open-Trial</option>
            <option value='4' <?php echo set_select('status', '4'); ?> >Blocked</option>
            <option value='5' <?php echo set_select('status', '5'); ?> >Closed-Payment Pending</option>
    </select>
<select name="bulling_type" id="bulling_type" onchange="return busines_searchmy();" class="none advancesearch" >
         <option value=""> Select</option>
         <option value="40">Monthly Per Employee</option>
         <option value="41">Per Report</option>
         <option value="42">Trial</option>
    </select>

</ul>
<div class="leftmenu newCol">
       <div class="searchList">
        <ul id="getsearchvalue">
	
<?php 
if($bname){
	foreach ($bname as  $value) 
	{  
		?>
		<li>
		<a href="<?php echo base_url(); ?>ssa/business/business_edit/<?php echo $value->a_BusinessId; ?>"> <?php echo $value->t_BusinessName; ?></a>
		</li>
		<?php 
	} 
} 
?>
         </ul>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assects/js/business_search_sheetesh.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $("#option").change(function(){
                var getVal =$(this).find("option:selected").val();
				if(getVal=='1'){
					$(".none").hide();
                    $("#b_search").show();
                }
				else{

					}
				if(getVal=='2'){
					$(".none").hide();
                    $("#status").show();
                }
				else{}
				if(getVal=='3'){
					$(".none").hide();
                    $("#bulling_type").show();
                }
				else{
					}
					if(getVal=='0'){
					$(".none").hide();

                }

            });

    });
$(document).ready(function(){
  $("#advancesearch").click(function(){
     $('#status').val('');
   $('#statusssa').val('');
   $('#bulling_type').val('');
    $('.advancesearch').toggle();
  });
});

</script>