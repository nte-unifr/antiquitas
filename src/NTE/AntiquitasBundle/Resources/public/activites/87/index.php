<?php
include ("../../includes/site_config.php");
include ("../../includes/site_db_connect.php");


//demarrage d'une session
session_name('antiquitas');
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
	<title>Untitled</title>
</head>

<body>
<?php
echo insertContentEditActivite("87").catchContentActivite("87");
?>
</body>
</html>

<?php
// ACTIVITES
 
 /**
 * Fonction
 * $varName =  
 * return --> $returnValue
 */ 
// Fonction catchContent
function catchContentActivite($id){
    global $langage;
    global $table_activites;
		
    $sql = "SELECT * FROM " . $table_activites . " WHERE id='" . $id . "'";
    $result = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
    $data = mysql_fetch_array($result);
    $returnValue = $data['contenu'];
    return $returnValue;
} 



/**
 * Fonction qui affiche le contenu de la variable $varName en y ajoutant l'icone de modification
 * $varName = nom de la variable dont on veut prendre le contenu
 * return --> $edit
 */
function insertContentEditActivite($id){
    global $icone_admin_modifier_activite; 

    $content_id = $id; 
    // On verifie si la session admin est ouverte
    if (isset($_SESSION['password'])) {
        // On verifie si on est un superuser
        if ($_SESSION['admin_contenusite'] == "1") {
            $edit = "&nbsp;<a href=\"../../modifier_contenu.php?doctype=activites&champ=contenu&docid=" . $content_id . "\">".$icone_admin_modifier_activite."</a>&nbsp;";
        } 
    } 
    return $edit;
} 
?>