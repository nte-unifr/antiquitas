<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Admin<?php if($adminsection) echo ' - '.lang($adminsection);?></title>
<link rel="stylesheet" type="text/css" href="../style/common.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="../templates/tplstyle.css" />
<script type="text/javascript">
	var is_admin = true;
</script>
<?php if($config['wysiwyg'])	echo '<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>'; ?>
<script type="text/javascript" src="../lib/lib.js"></script>
<script type="text/javascript" src="../lib/loupe.js"></script>
<script type="text/javascript" src="../lib/coinManip.js"></script>
<script type="text/javascript" src="../lib/plFileHandler.js"></script>
<?php if(isset($scriptaculous) && $scriptaculous) echo '
<script type="text/javascript" src="../lib/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../lib/scriptaculous/src/scriptaculous.js?load=effects,dragdrop"></script>'; ?>
</head>
<body<?php if($config['wysiwyg']) echo ' onload="startTinyMce();"'; ?>>
<div id="header">
	<h1>Antiquitas2 - admin</h1>
	<div id="topmenu"><ul>
		<li><a href="index.php"<?php if($adminsection == 'activites') echo ' class="active"';?>><?php echo lang('Activites'); ?></a></li>
		<li><a href="results.php"<?php if($adminsection == 'resultats') echo ' class="active"';?>><?php echo lang('Resultats'); ?></a></li>
		<li><a href="help.php"<?php if($adminsection == 'Help') echo ' class="active"';?>><?php echo lang('Help'); ?></a></li>
		<li><a href="../index.php"><?php echo lang('tofrontend'); ?></a></li>
		<li><a href="login.php?logout=1"><?php echo lang('logout'); ?></a></li>
	</ul></div><div style="clear: both;"></div>
</div>
<div id="content">
<?php
