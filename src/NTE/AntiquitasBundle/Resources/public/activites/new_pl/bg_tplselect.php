<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Choisir le template</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<style type="text/css">

#tpllist a {
	display: block;
	clear: left;
	padding: 10px;
	margin-bottom: 10px;
	color: #000;
	text-decoration: none;
	cursor: pointer;
}
#tpllist a img {
	vertical-align: middle;
}
#tpllist a:hover {
	background-color: #AFD3FF;
}
	</style>
<script type="text/javascript">
function plFileHandler_return(returnValue){
	if(parent && parent.plFileHandler){
		parent.plFileHandler.do_return(returnValue);
	}else{
		if(plFileHandler)	plFileHandler.do_return(returnValue);
	}
}
</script>
	
</head>
<body>
<div id="tpllist">
<?php
foreach(array('Par d&eacute;faut'=>'default','Pr&eacute;sentation'=>'presentation','2 colonnes'=>'2columns','Objet flottant gauche'=>'float') as $tpl=>$tplfile){
	echo '<a onclick="plFileHandler_return(\''.$tplfile.'.php\'); return false;"><img src="images/'.$tplfile.'.gif"/> '.$tpl.'</a>';
}
?>
</div>
</body>
</html>
