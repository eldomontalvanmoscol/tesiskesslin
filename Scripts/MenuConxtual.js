//MENU CONTEXTUAL
function MenuContextual(event){	
	var AnchoPag=document.documentElement.clientWidth;
	var AltoPag=document.documentElement.clientHeight;

	var AltDiv=250; //alto menu
	var AncDiv=200; //ancho menu
	
	//izquierda
	if((AnchoPag-AncDiv)>x){		
		var PIzq=x;
	}else{y
		var PIzq=x-AncDiv;
	}
	
	//alto
	if((AltoPag-AltDiv)>y){		
		var PTop=y;
	}else{
		var PTop=y-AltDiv;
	}
	
	PosIz=PIzq;	//posicion izquierda
	PosTo=parseFloat(PTop+25);	//posicion superior	
	
	//posicion y tamaño
	jQuery('#MenuContex').css('display','inline');
	jQuery('#MenuContex').width('200px');	
	jQuery('#MenuContex').height('200px');
	jQuery('#MenuContex').css('top',PosTo+'px');
	jQuery('#MenuContex').css('left',PosIz+'px');
	
	//Ventana("MContex","Controles/MenuContextual/MenuContextual.php","Menu Contextual","","post","200px","200px",PosTo+'px',PosIz+'px',0);
	return false;
}
document.oncontextmenu=MenuContextual;

//CIERRA MENU CONTEXTUAL
jQuery(document).bind('click', function(event) {
	jQuery('#MenuContex').css('display','none');
});
