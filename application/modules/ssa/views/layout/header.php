<?php $data = checklogin();?>
<?php //var_dump($data);?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>True Expense</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/pase.css" />
<link rel="icon" href="<?php echo base_url();?>assects/images/favicon.png" />
<script type="text/javascript" src="<?php echo base_url();?>assects/js/pase.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/css/default.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assects/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<script type="text/javascript" src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/main.js"></script>
<style>
@media print
  { 
   .leftSide{ display: none;}
   .header{display: none;}
   .right_top{display: none;}
  	}
body{margin: 0 5%; box-shadow: 0 0 1px 1px #bbb; border: none;}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assects/js/business_search.js"></script>


</head>
<?php /*$datetime1=explode (' ', $data['lastlogin']);
 $lastlogindate=$datetime1[0];
 $last_logintime= date("F j, Y, g:i a", $datetime1[1]);
echo  date("d-M-Y g:i A", strtotime($data['lastlogin']));
p($this->session->all_userdata());*/

/*if($lastlogindate =="0000-00-00"){

	$data['lastlogin']= date("Y-m-d H:i:s");
	

	$datetime=explode (' ', $data['lastlogin']);
    $lastlogindate= $datetime[0];
    $last_logintime=date('g:ia',$datetime1[1]);
}*/

// $formated_date = date("d-M-Y", strtotime($lastlogindate)); ?>
<body>
<header class="header">
<a href="#" class="logo"><img src="<?php echo base_url();?>assects/images/logo.png" /></a>
<div class="headright">
<div class="topright">
    <div class="login_top">
        <p><b>Welcome</b> <?php if(!empty($data['firstName'])){ echo $data['firstName'].' '.$data['lastName']; }  ?>
            <span style="display:inline-block;">[<a href="<?php echo base_url();?>admin/logout/">Logout</a>]</span>
            <span>Last Login: <?php echo  date("d-M-Y g:i A", strtotime($data['lastlogin']));?></span></p>
    </div>
</div>
<nav class="nav">
<?php echo mymenu(1);?>
<span class="iconRight" style="display: none;">
    <a href="#" class="quest_icon" title="Help"></a>
    <a href="<?php echo base_url();?>admin/logout" class="ficon" title="Logout"></a>
</span>

</nav>
</div>

</header>
