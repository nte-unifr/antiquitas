var coinManip = {
	container: false,
	imgele: false,
	buttons: false,
	btn_zoom: false,
	btn_rotate_left: false,
	btn_rotate_right: false,
	btn_flip: false,
	btn_ruler: false,
	img1_small: false,
	img1: false,
	img2_small: false,
	img2: false,
	is_zoomed: false,
	is_flipped: false,
	ruler_on: false,
	rotation: 0,
	pos_x: false,
	pos_y: false,
	start_x: false,
	start_y: false,
	marker: false,
	filespath: false,
	instructions: false,

	init: function(containerid, img1, img2, lengthmod, img1_small, img2_small) {
		this.container = document.getElementById(containerid);
		if(!this.container || !img1 || !img2)	return false;
		
		var icopath = (is_admin?'../':'')+'images/';
		this.filespath = (is_admin?'../':'')+'files/';
		
		this.buttons = document.createElement('div');
		this.buttons.id = 'coinManip_buttons';
		this.container.appendChild(this.buttons);
		
		this.img1 = img1;
		if(typeof(img1) == 'object' && (img1 instanceof Array)){
			this.img1 = img1;
		}else{
			this.img1 = new Array();
			this.img1.push(img1);
		}
		this.img2 = img2;
		if(typeof(img2) == 'object' && (img2 instanceof Array)){
			this.img2 = img2;
		}else{
			this.img2 = new Array();
			this.img2.push(img2);
		}		
		
		if(img1_small && img2_small){
			this.img1_small = img1_small;
			this.img2_small = img2_small;
			this.btn_zoom = this.createBtn(icopath+'zoom_in.png', 'Zoom');
			this.btn_zoom.onclick = function(){
				coinManip.zoom();
			};
			this.buttons.appendChild(this.btn_zoom);
		}
		
		this.btn_flip = this.createBtn(icopath+'flip.png');
		this.btn_flip.onclick = function(){
			coinManip.flip();
		};
		this.buttons.appendChild(this.btn_flip);
		
		if(this.img2.length > 1 || this.img2.length > 1){
			this.btn_rotate_left = this.createBtn(icopath+'rotate_left.png', 'Rotate left');
			this.btn_rotate_left.onclick = function(){
				coinManip.rotate_left();
			};
			this.btn_rotate_right = this.createBtn(icopath+'rotate_right.png', 'Rotate right');
			this.btn_rotate_right.onclick = function(){
				coinManip.rotate_right();
			};
			this.buttons.appendChild(this.btn_rotate_left);
			this.buttons.appendChild(this.btn_rotate_right);
		}
				
		var imgdiv = document.createElement('div');
		this.imgele = document.createElement('img');
		this.imgele.id = 'coinManip_image';
		this.imgele.onclick = function(){
			coinManip.imgclick();
		};
		imgdiv.appendChild(this.imgele);

		if(lengthmod && lengthmod > 0){
			this.lengthmod = lengthmod;
			this.btn_ruler = this.createBtn(icopath+'ruler.png', 'Ruler');
			this.btn_ruler.onclick = function(){
				coinManip.ruler();
			};
			this.buttons.appendChild(this.btn_ruler);
			
			this.marker = document.createElement('span');
			this.marker.innerHTML = 'X';
			this.marker.id = 'coinManip_marker';
			this.marker.style.position = 'absolute';
			this.marker.style.zIndex = '110';
			this.marker.style.display = 'none';
			this.marker.style.fontWeight = 'bold';
			this.marker.style.color = 'red';
			imgdiv.appendChild(this.marker);
			
			
			this.imgele.onmousemove = function(e){
				if (!e){var e = window.event;} 
				if (e.pageX || e.pageY){ 
					coinManip.pos_x = e.pageX; 
					coinManip.pos_y = e.pageY; 
				}else{
					if (e.clientX || e.clientY){ 
						coinManip.pos_x = e.clientX; 
						coinManip.pos_y = e.clientY; 
					} 
				}			
			};
			
		}
		
		this.container.appendChild(imgdiv);
		
		this.instructions = document.createElement('div');
		this.container.appendChild(this.instructions);
		
		this.reset();

	},
	
	reset: function(){
		this.is_flipped = false;
		if(this.ruler_on)	this.ruler();
		this.rotation = 0;
		if(this.img1_small){
			this.is_zoomed = false;
			this.setImage(this.img1_small);
		}else{
			this.is_zoomed = true;
			this.setImage(this.img1[0]);			
		}
	},
	
	createBtn: function(src, alt){
		var thebtn = document.createElement('img');
		thebtn.style.cursor = 'pointer';
		thebtn.src = src;
		if(alt)	thebtn.title = alt;
		return thebtn;
	},
	
	setImage: function(filename){
		this.imgele.src = this.filespath+filename;
	},
	
	ruler: function(){
		if(!this.btn_ruler) return false;
		if(this.ruler_on){
			this.btn_ruler.className = '';
			this.imgele.style.cursor = 'default';
			this.start_x = false;
			this.marker.style.display = 'none';
			this.ruler_on = false;
			this.instructions.innerHTML = "";
		}else{
			if(!this.is_zoomed)	this.zoom();
			this.btn_ruler.className = 'active';
			this.imgele.style.cursor = 'crosshair';
			this.ruler_on = true;
			this.instructions.innerHTML = "Cliquez sur deux points sur la pi&egrave;ce<br/>pour mesurer la distance entre ces points.";
		}
	},
	
	rotate_left: function(){
		this.rotation = this.rotation-1;
		this.rotate_apply();
	},
	
	rotate_right: function(){
		this.rotation = this.rotation+1;
		this.rotate_apply();
	},
	
	rotate_apply: function(){
		if(!this.is_zoomed)	this.zoom();
		if(this.flipped){
			if(this.rotation < 0)	this.rotation = this.img2.length - 1;
			if(this.img2[this.rotation]){
				this.setImage(this.img2[this.rotation]);
			}else{
				this.setImage(this.img2[0]);
				this.rotation = 0;
			}
		}else{
			if(this.rotation < 0)	this.rotation = this.img1.length - 1;
			if(this.img1[this.rotation]){
				this.setImage(this.img1[this.rotation]);
			}else{
				this.setImage(this.img1[0]);
				this.rotation = 0;
			}			
		}
	},
	
	imgclick: function() {
		if(this.ruler_on){
			if(this.start_x){
				var distance = Math.sqrt(Math.pow(this.pos_y - this.start_y,2) + Math.pow(this.pos_x - this.start_x,2));
				alert(Math.round(distance/this.lengthmod)+'mm');
				this.start_x = false;
				this.marker.style.display = 'none';
			}else{
				this.marker.style.top = (this.pos_y-8)+'px';
				this.marker.style.left = (this.pos_x-4)+'px';
				this.start_x = this.pos_x;
				this.start_y = this.pos_y;
				this.marker.style.display = 'block';
			}
		}
	},
	
	zoom: function(){
		if(this.is_zoomed){
			this.setImage(this.is_flipped?this.img2_small:this.img1_small);
			this.rotation = 0;
			this.is_zoomed = false;
			this.btn_zoom.src = (is_admin?'../':'')+'images/zoom_in.png';
			if(this.ruler_on)	this.ruler();
		}else{
			this.setImage(this.is_flipped?this.img2[0]:this.img1[0]);
			this.is_zoomed = true;
			this.btn_zoom.src = (is_admin?'../':'')+'images/zoom_out.png';
		}
	},
	
	flip: function(){
		this.is_flipped = !this.is_flipped;
		if(this.is_zoomed){
			if(this.is_flipped){
				this.setImage(this.img2[this.rotation]?this.img2[this.rotation]:this.img2[0]);
			}else{
				this.setImage(this.img1[this.rotation]?this.img1[this.rotation]:this.img1[0]);
			}
		}else{
			this.setImage(this.is_flipped?this.img2_small:this.img1_small);
		}
	}
}
