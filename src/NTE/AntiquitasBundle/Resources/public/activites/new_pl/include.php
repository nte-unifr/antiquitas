<?php
session_start();

$params = array_merge($_GET, $_POST);

require 'config.php';
require 'lib/console.php';

if($config['debug']){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

define('DBPREFIX', $config['dbprefix']);

// determine language
$langs = array('fr','de');
if(isset($params['usrlang']) && in_array($params['usrlang'],$langs))	$_SESSION['usrlang'] = $params['usrlang'];
$curlang = isset($_SESSION['usrlang'])?$_SESSION['usrlang']:$config['deflang'];
if(!in_array($curlang, $langs))	$curlang = 'fr';
define('CURLANG', $curlang);
define('USERVAR', $config['user_session_var']==''?'userid':$config['user_session_var']);
define('ESSAISVAR', $config['essais_session_var']==''?'essais':$config['essais_session_var']);

$lang = array();
require 'lang/'.CURLANG.'.php';

// THE FOLLOWING FUNCTION SHOULD BE USED TO CALL ALL STRINGS THAT ARE NOT ITEM-SPECIFIC
function lang($key){
	global $lang;
	return isset($lang[$key])?$lang[$key]:$key;
}

$dbcnx = mysql_connect($config['dbhost'],$config['dbuser'],$config['dbpass']);
if(!$dbcnx){
	exit('<p>Unable to connect to the database server at this time.</p>');
}
if(!mysql_select_db($config['dbname'])){
	if($config['debug'])	echo mysql_error();
	exit('<p>Unable to locate the database.</p>');
}

require "lib/functions.form.php";
require "lib/functions.misc.php";
require "lib/classes/class.imglib.php";
require "lib/imglib.php";
require "lib/classes/class.dbobject.php";
require "lib/classes/class.category.php";
require "lib/classes/class.activite.php";
require "lib/classes/class.section.php";
require "lib/classes/class.exercice.php";
require "lib/classes/class.question.php";
require "lib/classes/class.option.php";
require "lib/classes/class.outil.php";
require "lib/classes/class.feuser.php";
