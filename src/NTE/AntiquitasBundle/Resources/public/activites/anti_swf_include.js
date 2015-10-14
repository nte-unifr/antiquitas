// <!--  *        version 29 mars 2004    focus on flash obj déplacement dans le else                   *  -->
// <!--  *        version 21 janvier 2004    ajouter level des folders + focus on flash obj             *  -->
// <!--  *        version 08 janvier 2004    amélioration redirection http si pas de player             *  -->
// <!--  *        version 20 novembre 2003    suppresion de undefined car bug avec IE5                  *  -->
// <!--  *        version 03 novembre 2003   scripts a  l exterieur  avec cookies    pas de cookie      *  -->
// <!--  *        version 01 novembre 2003   scripts a  l exterieur                                     *  -->
// <!--  *        version 30 octobre 2003   suivi du flux des configurations utilisateurs               *  -->
// <!--  *        version 8 octobre 2003             scroller IE6                                       *  -->
// <!--  *        version TOCToLoad path parameter, scroller IE6, pageNo target parameter               *  -->
// <!--  *                                                                                              *  -->
// <!--  *                                    HEADER MARKETING ONLINE 2003                              *  -->
// *** Fonction d'extraction des parametres ***
function iniParam(){
   var strCurrentURL = window.location.href;
   strPassOn     = "";
   var page;
   var parameters = new Array();

   intPosAnchor  = strCurrentURL.indexOf("#"); //For bookmarks/anchors
   //alert("intPosAnchor:   "+intPosAnchor)
    
   if ( intPosAnchor > -1 ) {
      //Anchors/Bookmarks.  Start from "#".  If it exists, will always before "?"
      strPassOn = strCurrentURL.substring(intPosAnchor+2);
      // alert("intPosAnchor2:   "+intPosAnchor)
   }
   // check if parameter via # or ?
  
   if ( intPosAnchor > -1 ) {
      //Anchors/Bookmarks.  Start from "#".  If it exists, will always before "?"
      parameters[0] = strPassOn;  	  
   }else{
      // Appel de la fonction et création du tableau des paramètres
	  var urlParam = TJSExtraireParam();   
      parameters[0] = urlParam["page"];  // page     
	  parameters[1] = urlParam["ts"];   // txt size 
	  parameters[2] = urlParam["tc"];    // txt color 
	  //document.write("urlParam   "+urlParam["page"])
	 // alert("urlParam page:   "+urlParam["page"]+" ts "+parameters[1]+"    tc"+parameters[2])
   }
  
   if(parameters[0] >= 0) {    //|| page == undefined){
      page = parameters[0];  
   }else{
	  parameters[0]=0;
	  page  = 0;
   }
   return parameters;
}
//  -------------------------------------------
function TJSExtraireParam() {
   url = window.location.href;
   var exp=new RegExp("[&?]+","g");
   var exp2=new RegExp("[=]+","g");
   var tabNom=url.split(exp);
   var tabParam=new Array();
   if (tabNom!=null) {
      for (var i=1;i<tabNom.length;i++){
	     var tabTemp=tabNom[i].split(exp2);
		 tabParam[tabTemp[0]]=tabTemp[1];
      }
   }
   return tabParam;
}
// -------------------------------------------
function buildString(configParam){
   case1 = false;  
   var  urlPath = window.location.href;
   var  page = configParam[0];   // page
   var ts = configParam[1];      // txt size 
   var tc = configParam[2];      // txt color 
   var strData = "";
	 var flashPath ="container.swf";
	 var levelJLT = parseInt(this.levelFolder);
	 if(!levelJLT){
	 // default value for old version
	    levelJLT=1;
	 }
   // avec with tocToLoad path	 
	 for(i=1;i<=levelJLT;i++){
	    flashPath = "../"+flashPath;
	 }
   //
   var swfFile = flashPath+"?page="+page;
   // document.write("swfFile   "+swfFile);
   strData += '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
   strData += ' codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"';
   strData += ' width="782" height="576" id="container"'+swfFile+'"ALIGN="middle">';
   strData += ' <PARAM NAME=movie VALUE="'+swfFile+'"/> <PARAM NAME=quality VALUE=high /> <PARAM NAME=bgcolor VALUE=#FFFFFF/>'
   strData += ' <PARAM NAME="scale" value="exactfit" />'
   
   strData += '<EMBED src="'+swfFile+'"quality=high bgcolor=#FFFFFF  WIDTH="782" HEIGHT="576"  NAME="container" ALIGN="middle" TYPE="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer></EMBED>';
   strData += '</OBJECT>';
   // alert("strData:   "+strData)
   case1 = true;
   return strData;
    
   
}
// -----------------------------------------
function writeSWF(){
   configParam = new Array();
   // cookies or url?get cookies ne marchent pas en local un cookie pour chaque page html ???
   //readCookie(); 
   //cooked = 0; 
   //if(cooked==1){
      //configParam[0]=page;
	  //configParam[1]=ts;
	  //configParam[2]=tc;
   //}else{   	
      configParam = iniParam();
   //}
   var strData = buildString(configParam);
   // load swf 2 cases
   // case 1 support javascript
   if(case1 == true){
      //alert("case 1");
      document.write(strData);
   }else{
      // alert("case 2")			
      document.write('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="100%" HEIGHT="100%" id="../container.swf" ALIGN="center"> <PARAM NAME=movie VALUE="../container.swf"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#FFFFFF> <EMBED src="../container.swf"  quality=high bgcolor=#FFFFFF  WIDTH="100%" HEIGHT="100%" NAME="MO_Frame_A" ALIGN="center" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></OBJECT>');
   }
}
// ---------------------- cookies not used --------------------
function readCookie(){   
   cooked = getCookie("cooked");
   page = getCookie("page");
   ts = getCookie("ts");
   tc = getCookie("tc");
   //document.write("ce texte est ecrit avec un javascript externe:  "+page);
}
function getCookie(name) {
    var bites = document.cookie.split("; "); // break cookie into array of bites
    for (i=0; i < bites.length; i++) {
      nextbite = bites[i].split("="); // break into name and value
      if (nextbite[0] == name) // if name matches
        return unescape(nextbite[1]); // return value
    }
    return null; // if no match return null
}
function updateCookie(){   
   document.cookie = "cooked="+1;
   for(i=0;i<updateCookie.arguments.length;i++) {
      ckThing = updateCookie.arguments[i] + '=' + updateCookie.arguments[i+1] 
      document.cookie = ckThing;
	  i++
   }
  // document.cookie = "cooked="+1;
  // document.cookie = "page="+page;
   //document.cookie = "tc="+tc;
  // document.cookie = "ts="+ts;
}
// ******** Function for scroller to flash ***********
function go(){  
  if(flashVersion>5){     
   if (event.wheelDelta >= 120)	{
   movedVal+=1;
   Marketing_Online.SetVariable("moletteDir",0);
   }else if (event.wheelDelta <= -120 )  	{
      movedVal-=1;
      Marketing_Online.SetVariable("moletteDir",1);
   }
   Marketing_Online.SetVariable("moletteMoved",movedVal);
 }
}
function test(){
  document.write("ce texte est ecrit avec un javascript externe");
}

// ------------------- detect flash plugin ----------------------
// Flash Version Detector  v1.1.5
// http://www.dithered.com/javascript/flash_detect/index.html
// code by Chris Nott (chris@NOSPAMdithered.com - remove NOSPAM)
// with VBScript code from Alastair Hamilton
// modif JLT

function getFlashVersion() {
	var agent = navigator.userAgent.toLowerCase(); 
	
   // NS3 needs flashVersion to be a local variable
   if (agent.indexOf("mozilla/3") != -1 && agent.indexOf("msie") == -1) {
      flashVersion = 0;
   }
   
	// NS3+, Opera3+, IE5+ Mac (support plugin array):  check for Flash plugin in plugin array
	if (navigator.plugins != null && navigator.plugins.length > 0) {
		var flashPlugin = navigator.plugins['Shockwave Flash'];
		if (typeof flashPlugin == 'object') { 
			if (flashPlugin.description.indexOf('14.') != -1) flashVersion = 14;
			else if (flashPlugin.description.indexOf('13.') != -1) flashVersion = 13;
			else if (flashPlugin.description.indexOf('12.') != -1) flashVersion = 12;
			else if (flashPlugin.description.indexOf('11.') != -1) flashVersion = 11;
			else if (flashPlugin.description.indexOf('10.') != -1) flashVersion = 10;
			else if (flashPlugin.description.indexOf('9.') != -1) flashVersion = 9;
			else if (flashPlugin.description.indexOf('8.') != -1) flashVersion = 8;
			else if (flashPlugin.description.indexOf('7.') != -1) flashVersion = 7;
			else if (flashPlugin.description.indexOf('6.') != -1) flashVersion = 6;
			else if (flashPlugin.description.indexOf('5.') != -1) flashVersion = 5;
			else if (flashPlugin.description.indexOf('4.') != -1) flashVersion = 4;
			else if (flashPlugin.description.indexOf('3.') != -1) flashVersion = 3;
		}
	}

	// IE4+ Win32:  attempt to create an ActiveX object using VBScript
	else if (agent.indexOf("msie") != -1 && parseInt(navigator.appVersion) >= 4 && agent.indexOf("win")!=-1 && agent.indexOf("16bit")==-1) {
	   document.write('<scr' + 'ipt language="VBScript"\> \n');
		document.write('on error resume next \n');
		document.write('dim obFlash \n');
		document.write('set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.14") \n');
		document.write('if IsObject(obFlash) then \n');
		document.write('flashVersion = 14 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.13") end if \n');
		document.write('if flashVersion < 14 and IsObject(obFlash) then \n');
		document.write('flashVersion = 13 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.12") end if \n');
		document.write('if flashVersion < 13 and IsObject(obFlash) then \n');
		document.write('flashVersion = 12 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.11") end if \n');
		document.write('if flashVersion < 12 and IsObject(obFlash) then \n');
		document.write('flashVersion = 11 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.10") end if \n');
		document.write('if flashVersion < 11 and IsObject(obFlash) then \n');
		document.write('flashVersion = 10 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.9") end if \n');
		document.write('if flashVersion < 10 and IsObject(obFlash) then \n');
		document.write('flashVersion = 9 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.8") end if \n');
		document.write('if flashVersion < 9 and IsObject(obFlash) then \n');
		document.write('flashVersion = 8 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.7") end if \n');
		document.write('if flashVersion < 8 and IsObject(obFlash) then \n');
		document.write('flashVersion = 7 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.6") end if \n');
		document.write('if flashVersion < 7 and IsObject(obFlash) then \n');
		document.write('flashVersion = 6 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.5") end if \n');
		document.write('if flashVersion < 6 and IsObject(obFlash) then \n');
		document.write('flashVersion = 5 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.4") end if \n');
		document.write('if flashVersion < 5 and IsObject(obFlash) then \n');
		document.write('flashVersion = 4 \n');
		document.write('else set obFlash = CreateObject("ShockwaveFlash.ShockwaveFlash.3") end if \n');
		document.write('if flashVersion < 4 and IsObject(obFlash) then \n');
		document.write('flashVersion = 3 \n');
		document.write('end if');
		document.write('</scr' + 'ipt\> \n');
  }
		
	// WebTV 2.5 supports flash 3
	else if (agent.indexOf("webtv/2.5") != -1) flashVersion = 3;

	// older WebTV supports flash 2
	else if (agent.indexOf("webtv") != -1) flashVersion = 2;

	// Can't detect in all other cases
	else {
		flashVersion = flashVersion_DONTKNOW;
	}

	return flashVersion;
}

// ----------------------------------------------------
//               WRITE HTML Here
// ----------------------------------------------------
    movedVal = 0;
	//updateCookie('page',1,'ts',12,'tc','false');
	
	var flashVersion = 0;
	flashVersion_DONTKNOW = -1;
	getFlashVersion();
	if(flashVersion<7){
	alert("veuillez installer le plugin flash version 7 ou superieure :       version trouvee = "+flashVersion);
	// LocalHost for CDRom
	 if(window.location.host == ""){  
		 document.write("<table align = 'center' width = '700'><tr><td><br/><br/><h3>Strategic Marketing Online</h3><br/><br/><h5>Vouz trouverez ci-dessous les instructions pour installer le plugin flash et configurer votre navigateur </h5><br/><h5>Instructions pour installer le plugin flash <a href='../../../info/FlashPlayers/installFr.htm' target='_blank'>(installFr.htm)</a></h5></tr></td></table>");
		//var daURL="../../../info/FlashPlayers/"		
        //window.location.replace(daURL);    
		window.location.replace("../../../info/FlashPlayers/installFr.htm"); 
		 }else{		 
		 document.write("<table align = 'center' width = '700'><tr><td><br/><br/><h3>Strategic Marketing Online</h3><br/><br/><h4>Vouz trouverez chez Macromedia les instructions pour installer le plugin flash et configurer votre navigateur <br/><br/> <a href='http://www.macromedia.com/go/getflashplayer' target='_blank'>installer le plugin flash</a></h4></tr></td></table>");
		 //var daURL="http://www.macromedia.com/go/getflashplayer"		
		 //window.location.replace(daURL); 
		 writeSWF(); 
		 }
	}else{
	// 
	    writeSWF();
	    //this.window.document.Antiquitas-activite.focus();
	}
	
	// document.write("ce texte est ecrit avec un javascript externe");
	// test();
//





