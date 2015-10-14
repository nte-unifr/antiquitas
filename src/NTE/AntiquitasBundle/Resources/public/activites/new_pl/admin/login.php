<?php
require "../include.php";
$imglib->setAdmin();
define('ISADMIN',true);

if(isset($_GET['logout'])){
	session_destroy();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Antiquitas2 - Login</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<style type="text/css">
body {
	background-color: #006699;
	font-family: Arial;
	font-size: 13px;
	text-align: right;
}

#loginform {
	background-color: #fff;
	border: 2px outset #000;
	width: 300px;
	padding: 30px;
	margin: 100px auto 0;
}
h1 {
	padding: 0 20px;
	font-size: 30px;
	color: Grey;
	font-weight: bold;
	text-align: right;
}
	</style>	
</head>
<body>
<form action="index.php" method="POST">
<h1>Antiquitas2</h1>
<div id="loginform">
<center><p><?php echo (isset($_GET['loginerr']))?lang('loginerror'):lang('loginprompt'); ?></p></center>
<p><?php echo lang('username'); ?>: <input type="text" name="username"/></p>
<p><?php echo lang('password'); ?>: <input type="password" name="password"/></p>
<center><p><input type="submit" value="<?php echo lang('enter'); ?>"/></p></center>
</div>
</form>
</body>
