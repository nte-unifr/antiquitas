<?php

// initializes the image library
/* 	all images to be used anywhere (except exercice-specific images) should be declared here, using :
$imglib->addImage('key','filename','alt_fr','alt_de');
* eg.: if I wish to use 'cross.png' as a delete icon, I could write:
$imglib->addImage('delete','cross.png','Supprimer','Loeschen');
* and then call it anywhere (whether in admin or frontend) using :
getImage('delete');
* This way, if we decide to change all delete icons, we change them only here
*/

$imglib = new imglib();
$imglib->addImage('correct','tick.png','Bien!','Gut!');
$imglib->addImage('wrong','cross.png','Faux!','Falsch!');
$imglib->addImage('delete','cross.png','Supprimer','Loeschen');
$imglib->addImage('print','printer.png','Imprimer','Druecken');
$imglib->addImage('add','Add_16x16.png','');
$imglib->addImage('home','home.png','Acceuil');
$imglib->addImage('edit','Edit_16x16.png','Modifier','Bearbeiten');
$imglib->addImage('reorder','Refresh_16x16.png','');
$imglib->addImage('de','de.gif','DE');
$imglib->addImage('fr','fr.gif','FR');
$imglib->addImage('help','information.png','Help');
$imglib->addImage('tools','tools.png','Outils');
$imglib->addImage('rightarrow','rightarrow.gif','');
$imglib->addImage('session','folder_user.png','');

function getImage($key){
	// used as a shortcut in order not to go through the $imglib object all the time
	global $imglib;
	return $imglib->getImage($key);
}
