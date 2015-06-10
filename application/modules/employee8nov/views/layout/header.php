<?php $data = checklogin();//p($data);?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>True Expense</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/default.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<style>
body{margin: 0 5%; box-shadow: 0 0 1px 1px #bbb; border: none;}
</style>
</head>

<body>
<header class="header">
<a href="#" class="logo"><img src="<?php echo base_url();?>assects/images/logo.png" /></a>
<div class="headright">
<div class="topright"><div class="login_top"><p>Welcome <?php echo 'Super Admin'; ?> <span>Last Login: <?php echo $data['d_modifiedon']; ?></span><span><a href="<?php echo base_url();?>ssa/admin/logout/">Logout</a></span></p></div></div>
<nav class="nav">
<ul>
<li><a href="admin_view_report.php" class="active">Claim Reports</a>
<ul class="submenu" style="display: none;">
<li>Expense Claim Report</li>
<li>Expense Claim Report</li>
</ul>
</li>
<li><a href="policy.php">Policy</a></li>
<li><a href="<?php echo base_url();?>ssa/business/">Business</a></li>
<li><a href="employee_1.php">Employee</a></li>
<li><a href="<?php echo base_url();?>ssa/superadmin/">Admins</a></li>
<li><a href="#">Profile</a></li>
<li><a href="#">Spending Analysis</a></li>
<li><a href="<?php echo base_url();?>ssa/admin/setting/">Settings</a></li>
</ul>
<span class="iconRight"><a href="#" class="quest_icon"></a> <a href="#" class="ficon"></a></span>
</nav>
</div>
</header>