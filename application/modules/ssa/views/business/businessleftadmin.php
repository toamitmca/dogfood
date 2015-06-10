 <div class="leftSide">

    <ul class="leftmenu colL">
     <input list="browsers" type="text" name="busiinesssearch"  autocomplete="off" id="b_searchssa" onkeyup="return busines_searchmyadmin();" placeholder="Search Business " class="" >
     <span class="iconsel" id="adsearchadmin"></span>
     <select name="status" id="statusssa" class="advancesearchadmin" onchange="return busines_searchmyadmin();" style="display:none">
         <option value=""> Select</option>
        <option value="2">Open</option>
        <option value="1">Close</option>
    </select>
<select name="bulling_type" id="bulling_typessa" class="advancesearchadmin" onchange="return busines_searchmyadmin();" style="display:none">
         <option value=""> Select</option>
         <option value="40">Monthly Per Employee</option>
         <option value="41">Per Report</option>
         <option value="42">Trial</option>
    </select>
</ul>
<div class="leftmenu newCol">
        <div class="searchList">
        <ul id="getsearchvalue">
<?php foreach ($bname as  $value) {  ?>
<li><a href="<?php echo base_url(); ?>ssa/business/businessadminlist/<?php echo $value->a_BusinessId; ?>"> <?php echo $value->t_BusinessName; ?></a></li>
 <?php }  ?>
         </ul>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/assects/js/business_search_sheetesh.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $("#optionssa").change(function(){
                var getVal =$(this).find("option:selected").val();
				if(getVal=='1'){
					$(".none").hide();
                    $("#b_searchssa").show();
                }
				else{
					
					}
				if(getVal=='2'){
					$(".none").hide();
                    $("#statusssa").show();
                }
				else{}
				if(getVal=='3'){
					$(".none").hide();
                    $("#bulling_typessa").show();
                }
				else{
					}
					if(getVal=='0'){
					$(".none").hide();
                    
                }
				
            });
        
    });

/*Rahul Yadav  16/12/2014*/

$(document).ready(function(){
  $("#adsearchadmin").click(function(){
 $('#b_searchssa').val('');
   $('#statusssa').val('');
   $('#bulling_typessa').val('');

    $('.advancesearchadmin').toggle();
  });
});


</script>