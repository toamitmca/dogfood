<?php $data = checklogin();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>True Expense</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/pase.css" />
<script type="text/javascript" src="<?php echo base_url();?>assects/js/pase.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/default.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<script type="text/javascript" src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<style>
body{margin: 0 5%; box-shadow: 0 0 1px 1px #bbb; border: none;}
</style>
</head>

<body>
<header class="header">
<a href="#" class="logo"><img src="<?php echo base_url();?>assects/images/logo.png" /></a>
<div class="headright">
<div class="topright"><div class="login_top"><p><a href="<?php echo base_url();?>ssa/admin/logout/">Logout</a></span></p></div></div>
<nav class="nav">
<?php echo mymenu1(2);?>
<span class="iconRight"><a href="#" class="quest_icon"></a> <a href="#" class="ficon"></a></span>
</nav>
</div>
</header>
