<?php

require "include.php";
define('ISADMIN',false);

$theme_stylesheet = (isset($config['theme_stylesheet']) && file_exists('style/'.$config['theme_stylesheet']))?$config['theme_stylesheet']:'blue.css';

ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Antiquitas2</title>
<link rel="stylesheet" type="text/css" href="style/common.css" />
<link rel="stylesheet" type="text/css" href="style/<?php echo $theme_stylesheet; ?>" />
<link rel="stylesheet" type="text/css" href="templates/tplstyle.css" />
<link rel="stylesheet" type="text/css" media="print" href="style/print.css" />
<script type="text/javascript">
is_admin = false;
</script>
<script type="text/javascript" src="lib/lib.js"></script>
<script type="text/javascript" src="lib/loupe.js"></script>
<script type="text/javascript" src="lib/coinManip.js"></script>
</head>
<body>
<div id="content">
<a id="homelink" href="index.php"><?php echo getImage('home'); ?></a>
<?php
$newlang = CURLANG=='fr'?'de':'fr';
$linkparams = '';
foreach(array('act','sec','ex') as $key){
	if(isset($params[$key]))	$linkparams .= '&'.$key.'='.urlencode($params[$key]);
}
//echo '<a id="langlink" href="index.php?usrlang='.$newlang.$linkparams.'">'.getImage($newlang).'</a>';
echo '<a id="printlink" onclick="window.print();">'.getImage('print').'</a>';
