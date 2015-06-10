 <div class="leftSide">
    <ul class="leftmenu colL">
     <input list="browsers" type="text" name="busiinesssearch"  autocomplete="off" id="b_search" onkeyup="return searchByBusinessEmp();" placeholder="Search Business "  >
     <span class="iconsel" id="adsearchadmin"></span>
<select name="status" id="status" onchange="return searchByBusinessEmp();" class="none advancesearchadmin">
         <option value=""> Select</option>
        <option value="2">Open</option>
        <option value="1">Close</option>
    </select>
<select name="bulling_type" id="billing_type" onchange="return searchByBusinessEmp();" class="none advancesearchadmin">
        <option value="">select</option>
         <option value="40">Monthly Per Employee</option>
        <option value="41">Per Report</option>
         <option value="42">Trial</option>
    </select>
</ul>
<div class="leftmenu newCol">
       <div class="searchList">
        <ul id="getsearchvalue">
<?php foreach ($policy as  $value) {  ?>
<li onclick="return getemploye(<?php echo $value->a_BusinessId; ?>);" ><a href="#"> <?php echo $value->t_BusinessName; ?></a></li>
 <?php }  ?>
         </ul>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
            $("#option").change(function(){
                var getVal =$(this).find("option:selected").val();
				if(getVal=='1'){
					$(".none").hide();
                    $("#b_search").show();
                }
				if(getVal=='2'){
					$(".none").hide();
                    $("#status").show();
                }
				if(getVal=='3'){
					$(".none").hide();
                    $("#billing_type").show();
                }
					if(getVal=='0'){
					$(".none").hide();

               }
           });
    });
$(document).ready(function(){
  $("#adsearchadmin").click(function(){
    $('#b_search').val('');
   $('#status').val('');
   $('#billing_type').val('');
    $('.advancesearchadmin').toggle();
  });
});
</script>