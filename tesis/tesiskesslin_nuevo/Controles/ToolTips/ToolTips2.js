// JavaScript Document
	 
function Leyenda(elem,text,Tipo,AnchoTT){	//pinta mensaje donde se situe el cursor. Tipo: 0:Error,1:Simple, 2:Info,3:Exito ,4:Peligro

	if(AnchoTT==''){var Width='';}else{var Width='width:'+AnchoTT+';';}
	
	jQuery('#Body').html('<div id="ToolTips" style="display:none; '+Width+'"></div>');
	
	jQuery('#ToolTips').show();
	jQuery('#ToolTips').text(text);	
	
	//var Id=jQuery(elem).attr("id");
	
	var Posi=jQuery('#'+elem).offset();	//obtiene la posicion relativa de un elemento.		

	//verificamos si esta al filo del navegador y posicionamos el div
	var AnchoPag=document.documentElement.clientWidth;
	var AltoPag=document.documentElement.clientHeight;
	//alert(AnchoPag);
	var AltDiv=jQuery('#ToolTips').height();
	var AncDiv=jQuery('#ToolTips').width();
	
	//izquierda
	if((AnchoPag-AncDiv)>Posi.left){		
		var PIzq=Posi.left;
	}else{
		var PIzq=Posi.left-AncDiv;
	}
	//derecha
	if((AltoPag-AltDiv)>Posi.top){		
		var PTop=Posi.top;
	}else{
		var PTop=Posi.top-AltDiv;
	}
	
	//$('ToolTips').style.left=PIzq+'px';	//posicion izquierda
	//$('ToolTips').style.top=parseFloat(PTop+30)+'px';	//posicion superior	
	
	jQuery('#ToolTips').css("left",PIzq+"px");
	jQuery('#ToolTips').css("top",parseFloat(PTop)+'px');
	
	//si sale del objeto cierra el tooltips	
	//Event.observe(elem, 'mouseout', CloseLeyenda);
	jQuery('#'+elem).bind("mouseout",CloseLeyenda);		
}

function CloseLeyenda(){
	jQuery('#ToolTips').remove();	
}