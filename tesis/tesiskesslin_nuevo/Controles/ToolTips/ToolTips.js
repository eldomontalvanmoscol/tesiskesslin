// JavaScript Document
	 
function Leyenda(elem,text,Tipo,AnchoTT){	//pinta mensaje donde se situe el cursor. Tipo: 0:Error,1:Simple, 2:Info,3:Exito ,4:Peligro
	
	if(AnchoTT==''){var Width='';}else{var Width='width:'+AnchoTT+';';}
	
	$('Body').insert('<div id="ToolTips" style="display:none; '+Width+'"></div>');
	//jQuery('Body').append('<div id="ToolTips" style="display:none; '+Width+'"></div>');
	$('ToolTips').show();
	$('ToolTips').update(text);	
	var Posi=$(elem).cumulativeOffset();	//obtiene la posicion relativa de un elemento.		
	
	//verificamos si esta al filo del navegador y posicionamos el div
	var AnchoPag=document.documentElement.clientWidth;
	var AltoPag=document.documentElement.clientHeight;
	//alert(AnchoPag);
	var AltDiv=$('ToolTips').offsetHeight;
	var AncDiv=$('ToolTips').offsetWidth;
	
	//izquierda
	if((AnchoPag-AncDiv)>Posi[0]){		
		var PIzq=Posi[0];
	}else{
		var PIzq=Posi[0]-AncDiv;
	}
	//derecha
	if((AltoPag-AltDiv)>Posi[1]){		
		var PTop=Posi[1];
	}else{
		var PTop=Posi[1]-AltDiv;
	}
	
	$('ToolTips').style.left=PIzq+'px';	//posicion izquierda
	$('ToolTips').style.top=parseFloat(PTop+30)+'px';	//posicion superior	
	
	//si sale del objeto cierra el tooltips	
	Event.observe(elem, 'mouseout', CloseLeyenda);		
}

function CloseLeyenda(){
	$('ToolTips').remove();	
}