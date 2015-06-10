
<section class="main_caintainer">
<div class="leftSide">
<ul class="leftmenu">

<input style="width:30%;" type="text" value="Employee name" id="empname"><input type="submit"value="Search" id="search">
<?php echo form_open_multipart('super_state_admin/business_admin_employee_panel', array('cid' => 'designationadd', 'class' => 'batchadd1'));?>

<li>First Name Last Name1</li>
<li>First Name Last Name2</li>
<li>First Name Last Name3</li>
<li>First Name Last Name4</li>
</ul>
</div>

<div class="rightSide">
<div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Add Employee</a></span>
<div class="fix"></div></div>
<div class="col"><label>Status</label> 
<select style="width:30%;" name="status">
<option value=''>Active</option>
<option value='1'>Inactive </option>
</select>
</div>
<div class="col"><label>Lasted updated by user Name</label></div>
<div class="formPreExp">
<div class="col"><label>First Name</label> <input type="text" name="fname" /></div>
<div class="col"><label>Last Name</label> <input type="text" name="lname" /></div>
<div class="col"><label>Assinged Policy</label> 
<select style="width:30%;" name="policy">
<option value=''>Policy</option>
<option value='1'>Policy </option>
<option value='2'>Policy </option>
</select>
</div>
<div class="col"><label>Department</label> 
<select style="width:30%;" name="department" >
<option value=''>Department</option>
<option value='1'>Department</option>
<option value='2'>Department</option>
<option value='3'>Department</option>
<option value='4'>Department</option>
</select>
</div>
<div class="col"><label>Employee Id</label> <input type="text" name="eid" /></div>
<div class="col"><label>DOB</label>
<input type="text" id="datepicker-example1s3" name="dob" />
</div> 
<div class="col"><label>Office Phone </label><input type="text" name="office_phone"></div>
<div class="col"><label>Mobile Phone </label><input type="text" name="mobile_phone"></div>
<div class="col"><label>Address Line1</label> <input type="text" name="aline1"   /></div>
<div class="col"><label>Address Line2</label> <input type="text" name="aline2" /></div>
<div class="col"><label>Address Line3</label> <input type="text" name="aline3" /></div>
<div class="col"><label>City</label> <select style="width:30%;" name="city">
<option value=''>City</option>
<option value='1'>Delhi</option>
<option value='2'>Lucknow</option>
<option value='3'>Pune</option>
<option value='4'>Mumbai</option>
<option value='5'>Chandighar</option>
<option value='6'>Kolkata</option>
<option value='7'>Chennai</option>
<option value='8'>Hydrabad</option>
<option value='9'>ShreeNagar</option>
<option value='10'>Moradabad</option>
<option value='11'>Gwalior</option>
<option value='12'>Agra</option>
<option value='13'>Ajra</option>
<option value='14'>Alipurduar</option>
<option value='15'>Baleshwar</option>
<option value='16'>Delhi</option>
<option value='17'>Bandipore</option>
</select>
</div>
<div class="col"><label>State</label> 
<select style="width:30%;" name="state">
<option value=''>State</option>
<option value='1'>Andhra Pradesh</option>
<option value='2'>Arunachal Pradesh</option>
<option value='3'>Assam</option>
<option value='4'>Bihar</option>
<option value='5'>Chhattisgarh</option>
<option value='6'>Gujarat</option>
<option value='7'>Haryana</option>
<option value='8'>Himachal Pradesh</option>
<option value='9'>Jammu & Kashmir</option>
<option value='10'>Kerala</option>
<option value='11'>Madhya Pradesh</option>
<option value='12'>Punjab</option>
<option value='13'>Rajasthan</option>
<option value='14'>Sikkim</option>
<option value='15'>Uttar Pradesh</option>
<option value='16'>Delhi</option>
<option value='17'>Uttrakhand</option>
</select>
</div>
<div class="col"><label>PIN Code</label> <input type="text"  name="pincode" /></div>
<div class="col"><label>Country</label> <select style="width:30%;" name="country">
<option value=''>India</option>
<option value='1'>Afghanistan </option>
<option value='2'>Australia </option>
<option value='3'>Austria </option>
<option value='4'>China</option>
<option value='5'>Denmark</option>
<option value='6'>Egypt</option>
<option value='7'>France</option>
<option value='8'>Germany</option>
<option value='9'>Israel</option>
<option value='10'>America</option>
<option value='11'>Russia</option>
<option value='12'>Turkey</option>
</select>
</div>
<div></div>
<div class="right_top"><!-- <span class="buttonWrap"><a href="" class="loadbtn bluebg">Save</a></span> -->
<input type="submit"  class="buttonWrap" value="Save" name="save" />
<div class="fix"></div>
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
</section>
<div class="fix"></div>
</body>
</html>
