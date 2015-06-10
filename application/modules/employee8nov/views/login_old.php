<!doctype html>
<html>
<head>
<style>
.loginwrap {width: 100%; height: 100%;padding: 6% 0 0 0; background: url(../application/assets/images/loginbg.jpg); text-align: center;background-size: 100% 100%;}
.lmain{width: 22%; margin: auto;background: #fff;padding-bottom: 1%;display: block;border-radius: 3px;box-shadow: 0px 2px 10px 1px #F1F1F1;border: 1px solid  #107474;}
.lmain h1{margin: 0; padding: 3% 0 3%;background: #eee;color: #107474;font-family: 'News Cycle', sans-serif;position: relative;font-size: 20px;font-weight: bold;border-bottom: 1px solid #107474;}
.innerlogin { padding:6%;}
.lmain label{ display: block; font-family: 'News Cycle', sans-serif; padding: 5px 2px; text-align: left;}
.lmain input[type="text"],input[type="password"]{-moz-appearance: none;-webkit-appearance: none;appearance: none;display: inline-block;width: 100%;height: 36px;padding: 0 8px;margin: 0;background: #fff;border: 1px solid #d9d9d9;border-top: 1px solid #c0c0c0;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;-moz-border-radius: 1px;-webkit-border-radius: 1px;border-radius: 1px;font-size: 15px;color: #404040; border-radius: 3px; box-shadow: 0 0 1px #ddd inset;}
.submitLogin{border: 1px solid #178d8d; border-radius: 3px; color: #fff; width: 100%; padding:3% 0; margin-top:5%; font-family: 'News Cycle', sans-serif; font-size:1em;text-shadow: 0 1px rgba(0,0,0,0.3); border: 1px solid #178d8d;background-color: #178d8d; cursor: pointer;}
.submitLogin:hover{ background: #107474;}

.errordiv { display: block; }
.error {list-style-type: none; text-align: left;font-family: 'News Cycle', sans-serif;font-size: 12px;color: rgb(211, 56, 7); line-height:22px; }
.error p{ display: none;}
</style>
</head>
<body>
<div class="loginwrap">
<figure><img src="<?php echo base_url();?>assects/images/logo.png"></figure>

<div id="login_form" class="lmain">
	<h1>Login Admin</h1>
	<div class="innerlogin">
		<form action="<?php echo base_url();?>ssa/admin/index/" method="post">
			<?php 
				if(validation_errors()){
				    echo '<div class="errordiv">';
			      		echo validation_errors('<li class="error">');
			      	echo '</div>';
			     }
 
			    echo $this->session->flashdata('message');

			?>
			<label>Email</label><input type="text" name="email" value="<?php echo set_value('email');?>">
			<label>Password</label><input type="password" name="password" value="">
			<input type="submit" name="submit" value="Login">
		</form>
	</div>
</div>
</body>
