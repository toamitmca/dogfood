<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->config->item('project_name');?></title>
<style>
body{
	margin:0;
	padding:0;
}
.admin-section{
		width:900px;
		margin:100px auto;
		height:auto;

}
.admin-detail{
		width:100%;
		flaot:left;
		height:auto;
}
.admin-logo{
	width:100%;
	flaot:left;
	height:auto;
	text-align:center;
}
.admin-page-link{
	width:100%;
	flaot:left;
	height:auto;
	text-align:center;
	margin-top:20px;
}
.admin-page-link a{
	text-decoration:none;
	padding:10px 10px;
	margin:0px 10px;
	background: #1CBABB;
	  color: #fff;
	  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	  font-size: 14px;
}
</style>
</head>

<body>

<div class="admin-section">
	<div class="admin-detail">
    	<div class="admin-logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assects/images/logo.png" /></a></div>
        
        <div class="admin-page-link">
        	<a href="<?php echo base_url();?>ssa/admin">Login to system admin portal</a>
            <a href="<?php echo base_url();?>business">Login to business admin portal</a>
            <a href="<?php echo base_url();?>employee">Login to employee portal</a>
        </div>
    
    
    </div>
</div>
</body>
</html>
