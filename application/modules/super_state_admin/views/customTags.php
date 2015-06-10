<!DOCTYPE html>
<html>

<body>


<script>    
    function addRow() 
    {
        var form = document.getElementsByTagName('tdiv',)[0],
        input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 't1');
        form.appendChild(input);
    };
</script>





<section class="main_caintainer">
<div class="leftSide">
<ul class="leftmenu">
<li><a href="#">General</a></li>
<li><a href="#">Departments</a></li>
<li><a href="#">Spending Categories</a></li>
<li><a href="#">Custim Tags</a></li>
<li><a href="#">Reimbursement Option</li>
</ul>
</div>
<div class="rightSide">
<div class="right_top"><h2>Business Name</h2> 
<div class="col"><label>Status Open</label> 
</div>
<div class="col"><label style="font-size:12px">Lasted updated by: User Name</label></div>
</div></div>
<div class="rightSide"><div class="formPreExp">
<div class="col"><label style="text-align:left;">Custom Tag 1</label></div>


<div align="right"><span class="buttonWrap"><input type="submit" class="loadbtn bluebg" id="addtag1" value="add Tag1" onclick="addRow();"></span>
</div>


<div name ="tdiv" class="col"><input type="text" placeholder="Text" name="t1"/><input type="text" placeholder="Text2" id="t2" /></div>


<div class="col"><input type="text" placeholder="GL code" id="t3" /><input type="text" placeholder="A7498465468" id="t4" /></div>
<span class="buttonWrap"><a href="" class="loadbtn bluebg">Save</a></span>
<div class="fix"></div>

<div class="formPreExp">
<div class="col"><label style="text-align:left;">Custom Tag 2</label></div>
<div align="right"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Add Tag 2</a></span>
</div>
<div class="col"><input type="text" placeholder="Text" id="t5" /><input type="text" placeholder="Text2" id="t6" /></div>
<div class="col"><input type="text" placeholder="GL code" id="t7"/><input type="text" placeholder="A731681" id="t8"/></div>
<span class="buttonWrap"><a href="" class="loadbtn bluebg">Save</a></span>
<div class="fix"></div>

<div class="formPreExp">
<div class="right_top"><h2>Reimbursement Option</h2><span class="buttonWrap"></span>
<div class="fix"></div>








<!--<h2 class="genHead">Milage</h2>

<div class="right_top">&nbsp;</div>
<h2 class="genHead">Period Spending Limits</h2>

<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Spending Limits</a></span>
<div class="fix"></div></div>
<h2 class="genHead">Period Category Restrictions</h2>
<div class="right_top"><span class="buttonWrap"><a href="" class="loadbtn bluebg">Period Category Restrictions</a></span>
<div class="fix"></div></div>-->

</div>
</section>
<div class="fix"></div>
</body>
</html>
