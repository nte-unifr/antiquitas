<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

	<title>Untitled</title>

</head>

<body text="#000000" background="../images/fondmos.gif" link="003333" vlink="#006633" alink="#006633">

<?php

$query_string = "select * from naissances where auteur=' '";

#echo$ActionAuteur.$ActionProdige.$ActionLieu.$ActionDatation;

#echo$auteur.$prodige.$lieu.$datation;

If ($Action <> "") {

	$query_string = "SELECT * FROM naissances WHERE mot_cle_datation LIKE '%" . $datation . "%' AND mot_cle_lieux LIKE '%" . $lieu . "%' AND type_de_prodige LIKE '%" . $prodige . "%' AND auteur LIKE '%" . $auteur . "%'";

	$msg="multicrit&egrave;re";

}

else

	If ($ActionAuteur <> "" && $auteur <> "") {

		$query_string = "SELECT * FROM naissances WHERE auteur='" . $auteur . "'";

		$msg="de l'auteur "."\"<b>".$auteur."</b>\"";

	}

	else

		If ($ActionProdige <> "" && $prodige <> "") {

			$query_string = "SELECT * FROM naissances WHERE type_de_prodige LIKE '%" . $prodige . "%'";

			$msg="du type de prodige "."\"<b>".$prodige."</b>\"";

		}

		else

			If ($ActionLieu <> "" && $lieu <> "") {

				$query_string = "SELECT * FROM naissances WHERE mot_cle_lieux LIKE '%" . $lieu . "%'";

				$msg="du lieu "."\"<b>".$lieu."</b>\"";

			}

			else

				If ($ActionDatation <> "" && $datation <> "") {

					$query_string = "SELECT * FROM naissances WHERE mot_cle_datation LIKE '%" . $datation . "%'";

					$msg="de la date "."\"<b>".$datation."</b>\"";

				}

#echo$query_string;

?>

<h2 align="center">R&eacute;sultats de la recherche</h2>

<table width="100%" border="0">

  <tr>

    <td><font size="+1">Votre recherche 

      <?=$msg?>

      :</font> </td>

    <td>
      <div align="right"><a href="chercher.php">Nouvelle recherche</a></div>
    </td>

  </tr>

</table>

<p> 

<?php

// connexion et sélection de la base  
include("../../includes/site_config.php");
include("../../includes/site_db_connect.php");

# execute the query on a table in your database 

$query_result_handle = mysql_query($query_string);

# make sure that we recieved some data from our query

$num_of_rows = mysql_num_rows ($query_result_handle)

or die ("Il n'y a aucune fiche qui r&eacute;pond &agrave; vos crit&egrave;res. Essayez une <a href=\"chercher.php\">nouvelle recherche</a>");

#	print "The query: '$query_string' returned $num_of_rows rows of data."; 

$count=0;

while (list($texte_original,$texte_francais,$lieux,$date_du_texte,$type_de_prodige,$datation,$contexte_historique,$auteur,$reference) = mysql_fetch_row($query_result_handle)) {

$count++;

echo "<b>Fiche ".$count . "</b>";

?>

<table cellspacing="2" cellpadding="2" border="1">

  <tr valign="top"> 

    <td><i>R&eacute;f&eacute;rence</i> : <br>

      <?=$reference?>&nbsp;</td>

    <td><i>Type de prodige</i> : <br>

      <?=$type_de_prodige?>&nbsp;</td>

</tr>

  <tr valign="top"> 

    <td><i>Texte fran&ccedil;ais</i> : <br>

      <?=$texte_francais?>&nbsp;</td>

    <td><i>Texte original</i> : <br>

      <?=$texte_original?>&nbsp;</td>

</tr>

  <tr valign="top"> 

    <td><i>Date du texte</i> : <br>

      <?=$date_du_texte?>&nbsp;</td>

    <td><i>Lieu</i> : <br>

      <?=$lieux?>&nbsp;</td>

</tr>

</table>

<br>&nbsp;<?php

}

?>



</body>

</html>

