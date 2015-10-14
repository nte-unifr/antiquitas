<HTML>
<HEAD>
<TITLE>Rechercher un enregistrement</TITLE>
<script language="javascript">
function ferme() {
fenetre=this.window
fenetre.close()
}
</script>
</HEAD>
<BODY text="#000000" background="../images/fondmos.gif" link="003333" vlink="#006633" alink="#006633">
<?php
// connexion et sélection de la base  
include("../../../includes/site_db_connect.php");
?>

<table border="0" cellspacing="0" cellpadding="0" width="98%"><td width="86" valign="top"> 

<img src="../images/cle.gif" width="86" height="50">        

</td>

<td width="95%" valign="top"> 

<div align="center"><b><font face="Arial, Helvetica, sans-serif" color="#006633" size="+2"><i><br>Recherche</i></font></b></div>

    </td>

  </tr>

  <tr> 

    <td colspan="2"> 

      <hr>

    </td>

  </tr>

  <tr> 

    <td colspan="2">

<div align="center"><font size="+2">Base de donn&eacute;es sur les naissances <i>monstrueuses</i></font></div>

<br>Pour retrouver une information, utilisez <strong>un</strong> des crit&egrave;res 

ci-dessous et cliquez sur le bouton associ&eacute;: 

<p>

      <form ACTION="afficher.php" METHOD="POST">
        <table width="100%" border="0" bgcolor="#003333">

	<tr>

	  <td><b><font color="#FFFFFF">Auteur</font></b></td>

	  <td>

<select name="auteur">

		  <?php

# make a query on a table in your database 

	$query_string = "SELECT DISTINCT Auteur FROM naissances ORDER BY Auteur";

	$query_result_handle = mysql_query($query_string);

# make sure that we recieved some data from our query

	$num_of_rows = mysql_num_rows ($query_result_handle)

	or die ("The query: '$query_string' did not return any data");

	print "The query: '$query_string' returned $num_of_rows rows of data."; 

	print "<option value=\"\"></option>";

	while (list($row) = mysql_fetch_row($query_result_handle)) {

		print "<option value=\"".$row."\">".$row."</option>";

	}

?>

		</select>

		<input type="SUBMIT" name="ActionAuteur" value="Rechercher">

	  </td>

	</tr>

	<tr>

	  <td><b><font color="#FFFFFF">Type de prodige</font></b></td>

	  <td>

	<select name="prodige">

		<option value=""></option>

		<option value="naissances multiples">naissances multiples</option>

		<option value="malformation des membres">malformation des membres</option>

		<option value="les g&eacute;ants et les nains">les g&eacute;ants et les nains</option>

		<option value="mi-humain/mi-animal">mi-humain/mi-animal</option>

		<option value="parleur précoce">parleur précoce</option>

		<option value="naître les pieds en avant">naître les pieds en avant</option>

		<option value="naître avec des dents">naître avec des dents</option>

		<option value="changement d'une femme en un homme">changement d'une femme en un homme</option>

		<option value="androgyne/ hermaphrodite">androgyne/ hermaphrodite</option>

		<option value="divers">divers</option>

		<option value="plusieurs types de prodiges simultanés">plusieurs types de prodiges simultanés</option>

		</select>

	  <input type="SUBMIT" name="ActionProdige" value="Rechercher">

	  </td>	  

	</tr>

	<tr>

	  <td><b><font color="#FFFFFF">Lieu</font></b></td>

	  <td>

<select name="lieu">

		<option value=""></option>

		<option value="Rome">Rome</option>

		<option value="Environs de Rome">Environ de Rome</option>

		<option value="Italie">Italie</option>

		<option value="Territoire romain">Territoire romain</option>

		<option value="Bassin m&eacute;dit&eacute;rran&eacute;en">Bassin m&eacute;dit&eacute;rran&eacute;en</option>

		<option value="hors territoire romain">hors territoire romain</option>

		<option value="Lieu non cit&eacute;">Lieu non cit&eacute;</option>

		</select>

	  <input type="SUBMIT" name="ActionLieu" value="Rechercher">

	  </td>  

	</tr>

	<tr>

	  <td><b><font color="#FFFFFF">P&eacute;riode</font></b></td>

	  <td>

<select name="datation">

		<option value=""></option>

		<option value="VIII&egrave;me s. av. J-C">VIII&egrave;me s. av. J-C</option>

		<option value="VII&egrave;me s. av. J-C">VII&egrave;me s. av. J-C</option>

		<option value="VI&egrave;me s. av. J-C">VI&egrave;me s. av. J-C</option>

		<option value="V&egrave;me s. av. J-C">V&egrave;me s. av. J-C</option>

		<option value="IV&egrave;me s. av. J-C">IV&egrave;me s. av. J-C</option>

		<option value="III&egrave;me s. av. J-C">III&egrave;me s. av. J-C</option>

		<option value="II&egrave;me s. av. J-C">II&egrave;me s. av. J-C</option>

		<option value="Ier s. av. J-C">Ier s. av. J-C</option>

		<option value="Ier s. ap. J-C">Ier s. ap. J-C</option>

		</select>

	  <input type="SUBMIT" name="ActionDatation" value="Rechercher">

	  </td>

	</tr>

  </table>

  

  <br>

  Pour une recherche multicrit&egrave;re, s&eacute;lectionnez vos critr&egrave;res, 

  puis cliquez : 

  <input type="SUBMIT" name="Action" value="Rechercher">

 </form>

 <div align="center"> 

        <p>&nbsp;</p>

        <p><font face="Arial, Helvetica, sans-serif"><b><br>

          <a href=javascript:ferme()>Fermer la fen&ecirc;tre</a></b></font> </p>

      </div>



</table>

</BODY></HTML>

