/* Mostrar mensaje con tiempo de inicio y final, Argumentos:
 * 1.-id   - Id: texto ejm:'btnDocRelacionado'
 * 2.-Msg  - mensaje: html ejm:'Debe elegir un presupuesto<br/> para crear una orden de trabajo.'
 * 3.-TIn  - tiempo de inicio: int ejm:500
 * 4.-TOut - duracion del mensaje:int ejm:1000(1 segundo)
 * 5.-fadein transicion inicial(animacion) -> opcional defecto 300
 * 6.-fadeout transicion final(animacion)  -> opcional defecto 300
 * objeto: MsgWithTimer = function(Id,Msg,TIn,TOut,FadeIn,FadeOut) -> args (1,2,3,4,5,6)
 * ejemplo:
 * mensaje = new MsgWithTimer('btnDocRelacionado','Debe elegir un presupuesto<br/> para crear una orden de trabajo.',500,6000,200,400);
 * mensaje.Temporiza();
 */
MsgWithTimer = function(Id,Msg,TIn,TOut,FadeIn,FadeOut){//objeto
	this.PosX    = 0;
	this.PosY    = 0;
	this.Id      = Id;
	this.IdDiv   = 'Msg_'+Id;
	this.Msg     = Msg||'';
	this.TIn     = TIn||500;
	this.TOut    = TOut||800;
	this.FadeIn  = FadeIn||300;
	this.FadeOut = FadeOut||300;
	this.ancho   = 0;
	var _this    = this;//objeto

	this.Constructor = function(){
		this.ancho = jQuery('#'+this.Id).width();
		this.PosX  = jQuery('#'+Id).offset().left;
		this.PosY  = jQuery('#'+Id).offset().top;
		//alert(this.ancho);
	}
	
	this.Temporiza = function(){
		this.TOut = parseFloat(this.TIn)+parseFloat(this.TOut);
		if(jQuery('#'+this.Id).length > 0){//si el div ya esta creado se elimina
			this.RemoverDiv(1);
			this.removerFlecha(1);
		}
		setTimeout(function(){_this.Div('none');},this.TIn);//inicio
		setTimeout(function(){_this.RemoverDiv();_this.removerFlecha();},this.TOut);//termino
	}
	
	this.Sobre = function(){
		jQuery('#'+this.Id).mouseover(function(){_this.Div2('block');});
		jQuery('#'+this.Id).mouseout(function(){_this.RemoverDiv();});
	}
	
	this.Div = function(d){//div del mensaje argumento para css:display
		var display = display||'block';
		var y = this.PosY+34;
		var x = this.PosX-5;
		x = ((x-5)+'px').toString();
	    y = (y+'px').toString();
		
		jQuery('#'+this.Id).css({'cursor':'default'});
		this.flecha('none');
		jQuery('#'+this.Id).after('<div id="'+this.IdDiv+'" onclick="'+_this.RemoverDiv(1)+'" style="background:#BDE5F8;position:absolute;top:'+y+';left:'+x+';padding:7px;z-index:8000;color:#00529B;border-top:1px solid #4B8DF8;border-right:1px solid #4B8DF8;border-left:1px solid #4B8DF8;border-bottom:1px solid #4B8DF8;display:'+display+';overflow:hidden;white-space:nowrap;"><img id="img_'+this.IdDiv+'" style="display:inline-block;vertical-align:top;"/><div style="display:inline-block;margin-left:5px;vertical-align:middle;">'+this.Msg+'</div></div>');
		this.Estilo(d);//estilo del div
		jQuery('#'+this.IdDiv).fadeIn(300);
		jQuery('#msg_flecha').fadeIn(290);
	}
	
	this.Div2 = function(d){//div del mensaje argumento para css:display
		jQuery('#'+this.Id).css({'cursor':'default'});
		//this.flecha('none');
		jQuery('#'+this.Id).after('<div id="'+this.IdDiv+'" style="background:#BDE5F8;position:absolute;padding:7px;z-index:8000;color:#00529B;border-top:1px solid #4B8DF8;border-right:1px solid #4B8DF8;border-left:1px solid #4B8DF8;border-bottom:1px solid #4B8DF8;display:'+d+';overflow:hidden;white-space:nowrap;"><img id="img_'+this.IdDiv+'" style="display:inline-block;vertical-align:top;"/><div style="display:inline-block;margin-left:5px;vertical-align:middle;">'+this.Msg+'</div></div>');
		jQuery('#'+this.IdDiv).fadeIn(300);
		//jQuery('#msg_flecha').fadeIn(300);
	}
	this.Estilo = function(display){//agrega imagen
		var display = display||'block';
		jQuery('#img_'+this.IdDiv).attr({'src':'ImgSys/info.png','width':'32'});
	}
	this.flecha = function(d){//d:display css
		var x = this.PosX-9+(this.ancho/2);
		x	  = (x+'px').toString();
		
		jQuery('#'+this.Id).after('<div id="msg_flecha" style="position:absolute;z-index:8002;left:'+x+';display:'+d+';"><img src="ImgSys/arrow_mini.png" width="18" /></div>');
	}
	this.removerFlecha = function(t){
		var t = t||'slow';
		jQuery('#msg_flecha').fadeOut(t);
	}
	this.RemoverDiv = function(t){
		var t = t||'slow';
		jQuery('#'+this.IdDiv).fadeOut(t);
	}
	this.alerta = function(a){
		alert('hola desdde skynet... '+a);
	}
	this.consola = function(){
		console.log('posx '+this.PosX+' posy '+this.PosY);	
	}
	//constructor
	this.Constructor();
}