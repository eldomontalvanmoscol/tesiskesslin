/*Observaciones funcion Ventana(NumW,RutaW,Tit,AnchoW,AltoW,ArribaW,IzquierdaW);
-------------------------------------
NumW		//Id o nombre de la ventana. Tiene que ser un valor unico
RutaW		//Ruta del archivo que cargara. 
Tit			//Titulo de la ventana
AnchoW		//Ancho
AltoW		//Alto
ArribaW		//Posicion respecto al lado superior
IzquierdaW	//Posicion respecto al lado izquierdo
*/

Ventana=function(NumW,RutaW,Tit,ParamW,MethodW,AnchoW,AltoW,ArribaW,IzquierdaW,TipoW){
	
	var NDiv=''+NumW+'';
	var BodyW='CuerpoW'+NumW;
	var HeadW='HeadW'+NumW;
	var TitleW='TituloW'+NumW;
	
	new Ajax.Updater(BodyW,RutaW,{
		parameters:ParamW,
		evalScripts:true,
		method:MethodW
	}); 
	
	//alineamiento horizontal:identificamos si alineamos a la izquierda o derecha(-)	
	if(IzquierdaW.indexOf("-")!=-1){	//buscamos si existe el carcter -
		Valor=IzquierdaW.replace(/-/g,"");	//eliminamos el simbolo negativo en caso exista
		var Horiz='right:'+Valor;
	}else{
		var Horiz='left:'+IzquierdaW;
	}	
	
	//alineamiento vertical:
	if(ArribaW.indexOf("-")!=-1){	//buscamos si existe el carcter -
		ValorV=ArribaW.replace(/-/g,"");	//eliminamos el simbolo negativo en caso exista
		var VertW='bottom:'+ValorV;
	}else{
		var VertW='top:'+ArribaW;
	}	
	
	//VENTANA O POP UP
	if(TipoW==0){	
		var CabWin='';
	}else{
		var CabWin='<table width="100%" border="0" cellspacing="0" cellpadding="2"><tr style="color:#FFF;"><td width="24"><img src="ImgSys/logo16.gif" width="16" height="16"/></td><td id='+TitleW+' onMouseOver=MueveVentana("'+NDiv+'","'+HeadW+'") ondblclick=Maximiza("'+NDiv+'","'+AnchoW+'","'+AltoW+'") style="cursor:move;">Titulo</td><th width="16" onclick=Maximiza("'+NDiv+'","'+AnchoW+'","'+AltoW+'")>[]</th><th id="Cerrar'+TitleW+'" class="CloseNDiv" width="16" onclick=$("'+NDiv+'").remove() >X</th></tr></table>';
	}	


$('Body').insert('<div id='+NDiv+' class="ClassWin" style="position:absolute; display:none; '+VertW+'; '+Horiz+'; width:'+AnchoW+'; height='+AltoW+';padding: 2px;" onmousedown=CapasW("'+NDiv+'") align="center"><div id='+HeadW+'  style="color:CaptionText; font-weight: bold; cursor:default;" onmousedown=CapasW("'+NDiv+'") >'+CabWin+'</div><div id='+BodyW+' class="panel" style="color:#000000; overflow:auto; width:100%;" align="left;"></div></div>');
	if(TipoW!=0){
		$(TitleW).update(Tit);
	}
	VerWin(NDiv);
}
	
VerWin=function(W){ 
	CapasW(W);
    $(W).toggle();	//$(W).remove();
	//document.getElementById('LightModal').style.display='block';
}

zzindex=1000; //1000
MueveVentana=function(NDiv,HeadW){
	
	//alert("wew");
	//alert(NDiv);
	//alert(HeadW);
	new Draggable(NDiv, {handle:HeadW,constraint:false});
	//CapasW(NDiv);
}

CapasW=function(CapW){
	 zzindex ++;
	$(CapW).style.zIndex=zzindex;
}


var Max=1;
Maximiza=function(W,AnchoW,AltoW){
	if(Max==1){
		$(W).style.width='100%';		
		$(W).style.height='100%';
		$('CuerpoW'+W).style.height='95%';

		$(W).style.top='0px';
		$(W).style.left='0px';
		Max=0;
	}else{
		$(W).style.width=AnchoW;
		$(W).style.height=AltoW;

		Max=1;
	}

}

/*//<th width="16" onclick=Minimiza("'+NDiv+'","'+BodyW+'") >-</th>
var Min=1;
Minimiza=function(NDiv,BodyW){	
	if(Min==1){
		$(BodyW).toggle();				//ocultamos capa de datos
		$(NDiv).setStyle({		
			width:'180px',			 
			height:'20px',		//reducimos alto ventana principal		
			top :'',			//situamos a lado izquierdo	
			left:'0px',			//situamos abajo	
			bottom:'0px'		//situamos abajo						 
		});
		
		Min=0;
	}else{		
		$(BodyW).toggle();	
		$(NDiv).setStyle({		
			width:'700px',			 
			height:'400px',		//reducimos alto ventana principal	
			bottom:'',		//situamos abajo
			top :'0px',			//situamos a lado izquierdo	
			left:'0px'			//situamos abajo									 
		});		
		Min=1;
	}
}*/