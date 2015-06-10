<section class="main_caintainer">
  <?php $this->load->view('leftPolicy'); ?>
  <div class="rightSide">
    <form action="method">
      <div>
      		<span class="buttonWrap_back">
      			<a href="" class="loadbtn bluebg">Back to</a></span><span class="buttonWrap"><a href="" class="loadbtn bluebg">New Policy</a></span>
        	<div class="fix"></div>
      </div>
      <div class="tabcontent" id="form1" style="display:block">
        <div class="right_top"><span class="buttonWrap"></span>
          <div class="fix"></div>
          <div class="right_top"><span class="buttonWrap">
            <h4>Assigned</h4>
            </span>
            <h2>Policy Name
              	<input type="text" id="t_PolicyName" name="t_PolicyName" value="<?php echo set_value('policyName');?>">
            </h2>
            <div class="fix"></div>
          </div>
        </div>
        <div class="col">
          <label style="text-align:left;">General</label>
        </div>
        <div class="formPreExp">
          <div class="col">
            <label>Max Report Amount R</label>
            <input type="text" name="n_MaxRptAmt" id="n_MaxRptAmt" />
          </div>
          <div class="col">
            <label>Report Due By</label>
            <select name="d_RptDueDt" id="d_RptDueDt" style="width:25%;display:inline-block;">
              <option value='monthly'>Monthly</option>
              <option value='yearly'>Yearly</option>
            </select>
            <select name="left" style="width:15%;display:inline-block;float:right;">
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
            </select>
          </div>
          <div class="col">
            <label>Max Expense Amount R</label>
            <input type="text" name="n_MaxExpAmt" id="n_MaxExpAmt" value="" />
          </div>
          <div class="col">
            <label>Cash Advance Allowed</label>
            <select style="width:30%;" name="b_CashAdAllowed" id="b_CashAdAllowed">
              <option value='1'>Yes</option>
              <option value='0'>No</option>
            </select>
          </div>
          <div class="col">
            <label>Receipt Required</label>
            <select style="width:30%;" name="b_RecpReq" id="b_RecpReq">
              <option value='1'>Yes</option>
              <option value='0'>No</option>
            </select>
          </div>
          <div class="col">
            <label>Flag Expense submitted</label>
            <input type="text" name="" value="">
          </div>
          <div class="col">
            <label>days after expense incurred</label>
          </div>

          <div class="right_top">
          	<span class="buttonWrap">
            	<a class="loadbtn bluebg tabRun" id="saveGeneral">Save General</a>
            </span>
            <div class="fix"></div>
          </div>

          <div class="right_top">
            <h2>Mileage</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Mileage</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
          <div class="right_top">
            <h2>Period Spending Limits</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Period Limits</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
          <div class="right_top">
            <h2>Spending Categories Restrictions</h2>
            <span class="buttonWrap"></span>
            <div class="formPreExp">
              <div ><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
                <div class="fix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="form2">
        <div class="right_top">
          <div class="right_top"> <span class="buttonWrap"></span>
            <div class="fix"></div>
            <div class="right_top"> <span class="buttonWrap">
              <h4>Assigned</h4>
              </span>
              <h2>Milage Name</h2>
              <div class="fix"></div>
            </div>
          </div>
          <div class="col">
            <label style="text-align:left;">Mileage</label>
          </div>
          <div class="formPreExp">
            <div class="col">
              <label>Max Report Mileage R</label>
              <input type="text" name="n_MaxRptMilage" value="<?php echo set_value('n_MaxRptMilage');?>" />
            </div>
            <div class="col">
              <label>Mileage Rate R</label>
              <input type="text" name="n_MilageRate" value="<?php echo set_value('n_MilageRate');?>" />
            </div>
            <span>
            <label>Per</label>
            <select name="n_PerMeasuremnt">
              <option value='1'>min</option>
              <option value='2'>hrs</option>
              <option value='3'>weekly</option>
            </select>
            </span>
            <div class="col">
              <label>Max Expense Mileage R</label>
              <input type="text" name="n_MaxExpMil" value="<?php echo set_value('n_MaxExpMil');?>" />
            </div>
            <div class="col">
              <label>GPS Stamp Requird</label>
              <select style="width:30%;" name="b_IsGPSReq">
                <option value='1'>Yes</option>
                <option value='0'>No</option>
              </select>
            </div>
            <div> <span class="buttonWrap"><a class="loadbtn bluebg tabRun">Save Peroid Limits</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Period Spending Limits</h2>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Period Limits</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="form3">
        <div class="right_top"> <span class="buttonWrap">
          <h4>Assigned</h4>
          </span>
          <h2>Policy Name1</h2>
          <div class="fix"></div>
        </div>
        <div class="col">
          <label style="text-align:left;">Provide Spending Limits</label>
        </div>
        <div class="formPreExp">
          <div class="col">
            <label>Daily Spending Limit R</label>
            <input type="text" name="n_DailyExpLmt" value="" />
          </div>
          <div class="col">
            <label>Monthly Spending Limit R</label>
            <input type="text" name="n_MonthlyExpLmt" value="" />
          </div>
          <div class="right_top"> <span class="buttonWrap"><a class="loadbtn bluebg tabRun">Save Peroid Limits</a></span>
            <div class="fix"></div>
          </div>
        </div>
        <div class="right_top">
          <h2>Spending Categories Restrictions</h2>
          <span class="buttonWrap"></span>
          <div class="formPreExp">
            <div><span class="buttonWrap"><a href="" class="loadbtn bluebg">Save Categories Restriction</a></span>
              <div class="fix"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="form4">
        <div class="right_top">
          <h2>Policy Name 1</h2>
          <span class="buttonWrap">
          <h2>Assigned</h2>
          </span>
          <div class="fix"></div>
        </div>
        <h2 class="genHead blue">Period Categories Restrictions</h2>
        <div class="Expenses policy">
          <table border="1">
            <tr>
              <th>&nbsp;</th>
              <th>Spending Categories</th>
              <th>Single Expenses Limit</th>
              <th>Daily Limit</th>
              <th>Monthly Limit</th>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/Off_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url();?>assects/images/icons/On_4.png" /></td>
              <td>Meals <span class="WebRupee">Rs</span></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
              <td><input type="text"></td>
            </tr>
          </table>
          <div class="buttonWrapInner"><a class="loadbtn bluebg tabRun">Save Categories Restrictions</a>
            <div class="fix"></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<div class="fix"></div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/policy.js"></script>

</body></html>