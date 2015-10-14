<?php
require "../include.php";
$imglib->setAdmin();
define('ISADMIN',true);

if(isset($_POST['username']) && isset($_POST['password'])){
	if(isset($config['admin_logins'][$_POST['username']]) && $config['admin_logins'][$_POST['username']] == $_POST['password']){
		$_SESSION['antiquitas2_adminauth'] = 1;
		$_SESSION['antiquitas2_adminuser'] = $_POST['username'];
	}else{
		sleep(1);
	}
}

if(!isset($_SESSION['antiquitas2_adminauth']) || !$_SESSION['antiquitas2_adminauth']){
	if(isset($_POST['username'])){
		header('location: login.php?loginerr=1');
	}else{
		header('location: login.php');
	}
}

ob_start();

require "header.php";
