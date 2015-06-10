<?php include("include/header.php"); ?>

<section class="main_caintainer">

<div class="rightSide empwrap">
<div class="right_top"><h1>Employee</h1>  <span class="buttonWrap"><a href="" class="loadbtn">Back to List</a><a href="" class="loadbtn bluebg">New Report</a></span>
<div class="fix"></div></div>

<div class="formPreExp">
 <form action="javascript:void(0)" method="post">
<div class="col"><label>Report Name</label> <input type="text" /></div>
<div class="col"><label>Report Type</label> <select><option>Pre Expenses Request</option>
<option></option>
 </select></div>
<div class="col"><label>Chaim Period Form</label> <input id="datepicker-example1" class="dat" type="text"></div>
<div class="col"><label>Chaim Period To</label> <input id="datepicker-example1s" class="dat" type="text"></div>
<div class="col"><label>Cash Advance <span class="WebRupee">Rs</span></label> <input type="text" /></div>
<div class="col"><label>Pre-Expenses Amount <span class="WebRupee">Rs</span></label> <input type="text" /></div>
<div class="col"><label>Description</label> <input type="text" /></div>
<div class="col"><label>Amount Reported</label> <input type="text" /></div>
<div class="col colR"><label>Amount Requested</label> <input type="text" /></div>
</form>
</div>
<div class="notes">
<table>
  <tr>
    <td><a href="#" class="add">Notes</a></td>
    <td><a href="#" class="bug"></a></td>
    <td><label class="link" for="atthFile" ></label> <input type="file" id="atthFile" class="atthFile" ></td>
  </tr>
  <tr>
    <td>First Note comes here</td>
    <td>25/12/14, by Manish Gupta</td>
    <td><a href="#" class="del"></a></td>
  </tr>
  <tr>
    <td>First Note comes here</td>
    <td>25/12/14, by Manish Gupta</td>
    <td><a href="#" class="del"></a></td>
  </tr>

    <tr>
    <td>First Note comes here</td>
    <td>25/12/14, by Manish Gupta</td>
    <td><a href="#" class="del"></a></td>
  </tr>
</table>
<div class="buttonWrapInner"><a href="" class="loadbtn">Delete Report</a><a href="" class="loadbtn">Save</a><a href="" class="loadbtn bluebg">Submit</a>
<div class="fix"></div> </div>
</div>
<div class="Expenses exps exp">
<div><a class="headexp">Expenses</a></div>
<table border="1">
    <tr>
    <th>&nbsp;</th>
    <th>Type</th>
    <th>Category</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Merchant</th>
    <th>City</th>
    <th>Purpose</th>
    <th>Reimb.</th>
    <th>Tag1</th>
    <th>&nbsp;</th>
    
  </tr>
  <tr>
    <td><input type="checkbox"></td>
    <td><select><option>Money Spent</option></select></td>
    <td><select><option>Money Spent</option></select></td>
    <td><input id="datepicker-example1s1" class="dat" type="text"></td>
    <td><input type="text" value=""></td>
    <td><input type="text" value=""></td>
    <td><select><option>Mumbai</option></select></td>
    <td><input type="text" value=""></td>
    <td><select><option selected>yes</option><option>no</option></select></td>
    <td><select><option>yes</option><option>no</option></select></td>
    <td><a href="#" class="bug"></a> <label class="link" for="atthFile" ></label> <input type="file" id="atthFile" class="atthFile" ></td>
  </tr>
  <tr>
    <td><input type="checkbox"></td>
    <td><select><option>Money Spent</option></select></td>
    <td><select><option>Money Spent</option></select></td>
    <td><input id="datepicker-example1s2" class="dat" type="text"></td>
    <td><input type="text" value=""></td>
    <td><input type="text" value=""></td>
    <td><select><option>Mumbai</option></select></td>
    <td><input type="text" value=""></td>
    <td><select><option selected>yes</option><option>no</option></select></td>
    <td><select><option>yes</option><option>no</option></select></td>
    <td><a href="#" class="bug"></a> <label class="link" for="atthFile" ></label> <input type="file" id="atthFile" class="atthFile" ></td>
  </tr>
  <tr>
    <td><input type="checkbox"></td>
    <td><select><option>Money Spent</option></select></td>
    <td><select><option>Money Spent</option></select></td>
    <td><input id="datepicker-example1s3" class="dat" type="text"></td>
    <td><input type="text" value=""></td>
    <td><input type="text" value=""></td>
    <td><select><option>Mumbai</option></select></td>
    <td><input type="text" value=""></td>
    <td><select><option selected>yes</option><option>no</option></select></td>
    <td><select><option>yes</option><option>no</option></select></td>
    <td><a href="#" class="bug"></a> <label class="link" for="atthFile" ></label> <input type="file" id="atthFile" class="atthFile" ></td>
  </tr>
  <tr>
    <td><input type="checkbox"></td>
    <td><select><option>Money Spent</option></select></td>
    <td><select><option>Money Spent</option></select></td>
    <td><input id="datepicker-example1s4" class="dat" type="text"></td>
    <td><input type="text" value=""></td>
    <td><input type="text" value=""></td>
    <td><select><option>Mumbai</option></select></td>
    <td><input type="text" value=""></td>
    <td><select><option selected>yes</option><option>no</option></select></td>
    <td><select><option>yes</option><option>no</option></select></td>
    <td><a href="#" class="bug"></a> <label class="link" for="atthFile" ></label> <input type="file" id="atthFile" class="atthFile" ></td>
  </tr>
  
</table>
<div class="buttonWrapInner"><a href="" class="loadbtn">Submit</a><a href="" class="loadbtn bluebg">Save Expensess</a><a href="" class="loadbtn">Copy</a>
<div class="fix"></div> </div>
</div>
<div class="report">
<h1>Action Log</h1>
<p>Last Update 25/12/2014, by Manish Gupta</p>

<?php include("include/footer.php"); ?>