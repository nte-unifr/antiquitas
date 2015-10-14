<?



// Taille maximale autorisée en octets pour le fichier a uploader
$taille=10240000;



//ENREGISTREMENT DU FICHIER SUR LE FTP

 

switch($action) {	
  case "add";
//CONNEXION AU FTP
    $ftp_server = "www.unifr.ch";
    $ftp_user = "villevey";
    $ftp_pass = "asd34f";

    $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");
 // Tentative de login
    if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) { 
      echo "Connecté avec $ftp_user@$ftp_server\n";
    } else {
      echo "Impossible de se connecter avec $ftp_user\n";
    }



    if ($userfile_size!=0) {
      $taille_ko=$userfile_size/1024;
    } else {
      $taille_ko=0;
    }
    if ($userfile=="none") {
      $message="Vous n'avez pas sélectionné de fichier.";
    }
    if ($userfile_size>$taille) {
      if($taille!=0) {
	$taille_max_ko=$taille/1024;
      }
      $message="Votre fichier est trop gros ($taille_max_ko ko max)";
    }
    if ($userfile!="none" && $userfile_size<$taille && $userfile_size!=0) {
      $userfile=stripslashes($userfile); 

//verification du type de fichier
       $formats = array('xml');
	  $formats2 = array('swf');
	  if(!in_array(strtolower(substr($userfile_name,-3)),$formats) && !in_array(strtolower(substr($userfile_name,-3)),$formats2)) { 			          
            		    
              $message="<BR>Seuls les fichiers .xml et .swf peuvent être uploadés!";		
	    
            }else {
             
            copy($userfile, $userfile_name) ;

          
       	$message="Fichier enregistré";
      }
    }
    printf ("$message<br>taille=%.2f ko.",$taille_ko);	
    break;

//AFFICHAGE DU FORMULAIRE

default;
echo "<h2><font face=arial>Upload de fichiers</font></h2>";
echo "Choisissez un fichier sur votre disque et cliquez sur Envoyer<br>
	<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"upload_loc.php3\" METHOD=\"post\">
	<input type=\"hidden\" name=\"action\" value=\"add\">
	<INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\">
	<INPUT NAME=\"userfile\" TYPE=\"file\" size=\"20\"><br>
	<input type=\"submit\" value=\"Envoyer\"></FORM>";
break;
}

?>
