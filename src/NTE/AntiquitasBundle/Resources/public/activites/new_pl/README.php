<?php
/*

FOLDERS
files/ contains all files (images) used in exercices
images/ contains all images (icons) that are not item-specific (like delete icons, etc)
help/ can be used to place html content used in tools
templates/ contains all the available question display templates
style/ contains all the available frontend stylesheets

FILES
config.php contains basic settings and db info
include.php establishes connexion and declares the core functions (such as lang)
* the admin has its own include.php (which mostly handles authentification), but it also calls the root include.php
bg_select.php, bg_tplselect.php, bg_upload.php and functions.plFileHandler.php are used by the plFileHandler javascript to display popup selectors in the admin
lib/classes/ contains the classes for different entities, all based on class.dbobject.php, so it's best to check the dbobject class before modifying the others
lib/functions.form.php contains the different form input functions


FUNCTIONS

lang($key) returns the array entry corresponding to $key in lang/fr.php or lang/de.php (according to current language)

getImage($key)	displays any image defined in lib/imglib.php, with path correction for admin or frontend. (see imglib.php for more info)
 
*/
?>
