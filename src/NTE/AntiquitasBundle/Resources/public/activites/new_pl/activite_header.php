<?php
if(!isset($config) || !isset($activite) || !isset($sections) || !isset($exercices))	exit;

// displays the header of an activity (activity title, tool menu, section menu and exercice menu

$old_theme = (isset($config['theme_stylesheet']) && $config['theme_stylesheet'] == 'old.css')?true:false;
if($old_theme){
	echo '<div id="acthead"><div id="acthead_left"></div><div id="acthead_right">';
}else{
	echo '<h2 id="acthead_middle">'.$activite->getvar('name').'</h2>';
}

$outils = $activite->get_outils();
if(count($outils)>0){
	echo '<div id="outilsmenu" onmouseout="document.getElementById(\'outils_rolldown\').style.display = \'none\';" onmouseover="document.getElementById(\'outils_rolldown\').style.display = \'block\';">';
	echo '<ul id="outils_rolldown">';
	foreach($outils as $outil){
		echo '<li><a href="'.$outil->getvar('url').'" target="_blank">'.$outil->getvar('name').'</a></li>';
	}
	echo '</ul><span>'.getImage('rightarrow').' '.lang('Outils').'</span></div>';
}

if($old_theme){
	echo '</div><div id="acthead_middle"><h2>'.$activite->getvar('name').'</h2></div></div>';
}

echo '<div id="actbody"><div id="sectionmenu">';
foreach($sections as $section){
	if($section->id == $current['sec']){
		echo '<a class="active">';
	}else{
		echo '<a href="index.php?act='.$activite->id.'&sec='.$section->id.'">';
	}
	echo $section->getvar('name').'</a>';
}
echo '</div>';
echo '<div class="exercice_outer">';
if(count($exercices) > 1){
	echo '<div id="exercicemenu">'.lang('Etapes').' &gt;&gt; ';
	foreach($exercices as $exercice){
		if($exercice->id == $current['ex']){
			echo '<a class="active"';
		}else{
			echo '<a';
		}
		echo ' href="index.php?act='.$activite->id.'&sec='.$exercice->sec_id.'&ex='.$exercice->id.'">'.$exercice->getvar('name').'</a>';
	}
	echo '</div>';	
}else{
	echo '<br/>';
}
