window.popuper = {
	div: false,
	scontent: false,
	iframe: false,
	scrmask: false,
	passedUrl: false,
	divwidth: false,
	divheight: false,
	vcenter: false,
	closebtn: false,
	title: false,
	
	init: function(popupwidth, popupheight, toppos, containerid){

		var container = document.getElementById(containerid);
		if(!container)	container = document.getElementsByTagName("body").item(0);
		
		this.div = document.createElement('div');
		this.div.style.width = popupwidth+'px';
		this.div.style.position = 'absolute';
		this.div.style.backgroundColor = '#fff';
		this.div.style.zIndex = '120';
		this.div.style.border = '1px solid #000';
		this.div.style.display = 'none';
		this.divwidth = popupwidth;
		if(popupheight){
			this.div.style.height = popupheight+'px';
			this.div.style.overflow = 'auto';
			this.divheight = popupheight;
		}
		
		if(toppos){
			this.div.style.top = toppos+'px';
		}else if(popupheight){
			this.vcenter = true;
		}
		
		this.div.id = 'popuper_popup';
		
		this.scrmask = document.createElement('div');
		this.scrmask.id = 'plFileHandler_scrmask';
		this.scrmask.style.position = 'absolute';
		this.scrmask.style.top = 0;
		this.scrmask.style.left = 0;
		this.scrmask.style.width = '100%';
		this.scrmask.style.display = 'none';
		this.scrmask.style.zIndex = '101';
		this.scrmask.style.backgroundColor = '#000';
		this.scrmask.style.opacity = '0.6';
		this.scrmask.style.filter = 'alpha(opacity=60)';
		this.scrmask.onclick = function(){
			popuper.hide();
			return false;
		};
		
		document.getElementsByTagName("body").item(0).appendChild(this.scrmask);
		container.appendChild(this.div);

		this.closebtn = document.createElement('div');
		this.div.appendChild(this.closebtn);
		
		var closeimg = document.createElement('img');
		closeimg.style.cssFloat = 'right';
		closeimg.src = 'images/delete.png';
		closeimg.style.cursor = 'pointer';
		closeimg.onclick = function(){
			popuper.hide();
			return false;
		};
		this.closebtn.appendChild(closeimg);
		
		this.title = document.createElement('span');
		this.closebtn.appendChild(this.title);		

		this.iframe = document.createElement('iframe');
		this.iframe.style.width = popupwidth+'px';
		if(popupheight)	this.iframe.style.height = (popupheight - 20)+'px';
		this.iframe.style.padding = '0';
		this.iframe.style.margin = '0';
		this.iframe.style.border = '0';
		this.iframe.style.display = 'none';
		this.div.appendChild(this.iframe);
		
		this.scontent = document.createElement('div');
		this.scontent.style.textAlign = 'center';
		this.div.appendChild(this.scontent);
				
		window.onresize = function() {
			popuper.resize();
		};
	},

	getPageScroll: function(){
		// Merci Pierrick
		var yScroll;
		if (self.pageYOffset) {
			yScroll = self.pageYOffset;
		} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
			yScroll = document.documentElement.scrollTop;
		} else if (document.body) {// all other Explorers
			yScroll = document.body.scrollTop;
		}
		arrayPageScroll = new Array('',yScroll);
		return arrayPageScroll;
	},	

	getPageSize: function(){
		// Merci Pierrick
		var xScroll, yScroll;
		if (window.innerHeight && window.scrollMaxY) {	
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
		var windowWidth, windowHeight;
		if (self.innerHeight) {	// all except Explorer
			windowWidth = self.innerWidth;
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
		}	
		// for small pages with total height less then height of the viewport
		if(yScroll < windowHeight){
			pageHeight = windowHeight;
		} else { 
			pageHeight = yScroll;
		}
		// for small pages with total width less then width of the viewport
		if(xScroll < windowWidth){	
			pageWidth = windowWidth;
		} else {
			pageWidth = xScroll;
		}
		arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
		return arrayPageSize;
	},
	
	resize_mask: function(newheight){
		if(!newheight){
			var arrayPageSize = this.getPageSize();
			newheight = arrayPageSize[1];
		}
		this.scrmask.style.height = newheight+'px';
	},
	
	resize: function(){
		var arrayPageSize = this.getPageSize();
		this.resize_mask(arrayPageSize[1]);
		this.div.style.left = (arrayPageSize[0]-this.divwidth)/2 + 'px';
		
		if(this.vcenter && this.divheight){
			var arrayPageScroll = this.getPageScroll();
			var tmptop = (arrayPageSize[3] - this.divheight)/2 + arrayPageScroll[1];
			if(tmptop < 0 || tmptop > arrayPageSize[1])	tmptop = 0;
			this.div.style.top = tmptop+'px';
		}
	},
	
	show: function(){
		this.resize();
		this.scrmask.style.display = 'block';
		this.div.style.display = 'block';
	},
	
	hide: function(){
		this.iframe.style.display = 'none';
		this.div.style.display = 'none';	
		this.scrmask.style.display = 'none';
		this.scontent.style.display = 'none';
		this.iframe.src = '';
	},
	
	load: function(urlstring, title) {
		this.iframe.setAttribute('src',urlstring);
		this.iframe.style.display = 'block';
		this.title.innerHTML = ' '+title;
		this.show();
	},
	loadpic: function(url, title){
		this.scontent.innerHTML = '<div><br/><br/><img src="'+url+'" alt=""/></div><div><b>'+title+'</b></div>';
		this.scontent.style.display = 'block';
		this.show();
	}
}
