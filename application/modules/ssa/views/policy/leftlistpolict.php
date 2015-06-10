<div class="leftSide">
    <ul class="leftmenu colL">
    <input list="browsers" type="text" name="busiinesssearch"  autocomplete="off" id="b_search" onkeyup="return policy_search();" placeholder="Search Business " class="" >
    <span class="iconsel" id="adsearch"></span>
<select name="status" id="status" onchange="return policy_search();" class="none advancesearch">
          <option value="">Select </option>
         <option value='2' <?php echo set_select('status', '2'); ?> >Open</option>
            <option value='1' <?php echo set_select('status', '1'); ?>  >Close</option>
            <option value='3' <?php echo set_select('status', '3'); ?> >Open-Trial</option>
            <option value='4' <?php echo set_select('status', '4'); ?> >Blocked</option>
            <option value='5' <?php echo set_select('status', '5'); ?> >Closed-Payment Pending</option>
    </select>
<select name="bulling_type" id="bulling_type" onchange="return policy_search();" class="none advancesearch">
        <option value="">Select</option>
        <option value="40">Monthly Per Employee</option>
        <option value="41">Per Report</option>
         <option value="42">Trial</option>
    </select>
</ul>
<div class="leftmenu newCol">
       <!--  <input list="browsers" type="text" name="busiinesssearch"  autocomplete="off" id="b_search" onkeyup="return policy_search();" placeholder="Search Business " class="none" > -->
        <div class="searchList">
        <ul id="getsearchvalue">
<?php foreach ($policy as  $value) {  ?>
<li><a href="<?php echo base_url(); ?>ssa/policy/policylist/<?php echo $value->a_BusinessId; ?>"> <?php echo $value->t_BusinessName; ?></a></li>
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
                    $("#bulling_type").show();
                }
						if(getVal=='0'){
					$(".none").hide();
                }
            });
    });

$(document).ready(function(){
  $("#adsearch").click(function(){
   $('#b_search').val('');
   $('#status').val('');
   $('#bulling_type').val('');
    $('.advancesearch').toggle();
  });
});


</script>