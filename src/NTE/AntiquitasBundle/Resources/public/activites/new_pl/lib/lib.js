

function startTinyMce(){
	if(tinyMCE){
		if(document.getElementById("palettebtn"))	document.getElementById("palettebtn").style.display = 'none';
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "paste",
			paste_create_linebreaks : false,
			paste_create_paragraphs : true,
			theme_advanced_toolbar_location : 'top',
			theme_advanced_buttons1 : "bold,italic,underline,removeformat,|,pastetext,undo,redo,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,sub,sup,|,charmap,|,code",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_blockformats : "p,address,pre,h3,h4,h5,h6"
		});
	}

}

function submit_reorder(){
	// used for the admin reorder page
	var neworder = document.getElementById("neworder");
	neworder.value = '';
	var listnodes = document.getElementById("tosort").getElementsByTagName("li");
	for(i=0;i<listnodes.length;i++){
		if(neworder.value != "") neworder.value += ",";
		neworder.value += listnodes[i].id.substr(4);
	}
	return true;
}

function imageLoupe(smallimg,bigimg,smallsize){
	var smallsize = smallsize.split('x');
	document.write('<center><div style="background-image: url('+(is_admin?'../':'')+'files/'+smallimg+'); width: '+smallsize[0]+'px; height: '+smallsize[1]+'px;"><img id="loupeobj" onLoad="initLoupe(this.id);" width="'+smallsize[0]+'" height="'+smallsize[1]+'" src="'+(is_admin?'../':'')+'files/'+bigimg+'" alt=""/></div></center>');
}
