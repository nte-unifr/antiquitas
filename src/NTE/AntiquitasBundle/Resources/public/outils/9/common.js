//variables and functions used in all exercices
dom = (document.getElementById) ? true : false;
ie4 = (document.all && !dom) ? true : false;
ns5 = ((navigator.userAgent.indexOf("Gecko")>-1) && dom) ? true: false;
ie5 = ((navigator.userAgent.indexOf("MSIE")>-1) && dom) ? true : false;
ns4 = (document.layers && !dom) ? true : false;
nodyn = (!ns5 && !ns4 && !ie4 && !ie5) ? true : false;

var currentField=0;
//les options de la fenetre
var toolsWindowOptions = "toolbar=no,location=no,directories=no,status=yes" 
	+ ",menubar=no,scrollbars=yes,resizable=yes" 
	+ ",width=770,height=540";
var toolsWindow;

function myInit(){
  focus();
	MM_preloadImages('../../Images/answer_null.gif','../../Images/answer_bad.gif','../../Images/answer_good.gif','#1');
	window.name="name_mainWindow";
} 

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function OpenToolsWindow(theFile) {
var done = false;
	if ((toolsWindow == null) || (toolsWindow.closed)){ 
		toolsWindow = this.open(theFile, "toolsWindow", toolsWindowOptions);
		done = true;
	} 
	if (done==false) {
		toolsWindow.location.replace(theFile);
	}
	toolsWindow.focus(); 
}

function aleatoire() {
	rnd = Math.round(Math.random() * (otherExamples.length-1));
	exampleToOpen = '../'+otherExamples[rnd]+'/partie1.html';
	location.href=exampleToOpen;
}

function hidelayer(lay) {
	if (ie4 || ie5) {
		document.all[lay].style.visibility = "hidden";
	}
	if (ns4) {
		document.layers[lay].visibility = "hide";
	}
	if (ns5) {
		document.getElementById([lay]).style.visibility = "hidden";
	}
}

function showlayer(lay) {
	if (ie4 || ie5) {
		document.all[lay].style.visibility = "visible";
	}
	if (ns4) {
		document.layers[lay].visibility = "show";
	}
	if (ns5) {
		document.getElementById([lay]).style.visibility = "visible";
	}
}
