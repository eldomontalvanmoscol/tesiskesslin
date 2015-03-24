// JavaScript Document
//FUNCION PARA VALIDAR LOS MAESTROS DEL SISTEMA, NO PERMITIENDO SIMBOLOS EXTRAÑOS	
/* no permitidos
42		*			34		"		35 		#						37		%			38		&		39		'
180		´			123		{		125		}			91		[			93		]			191		¿		63		?
43		+			176		°		161		¡			33		!			61		=		    95		_ 
172		¬			94		^		96      `			126		~
168		¨	

//Permitidos				
40		(			41		)			
47		/			92		\				
45		-			46		.	
58		:			59		;
44		,			36		$
37		%		//revisar luego implicancias---YA NO PERMITIDO
95	_
*/

validarTextoM=function(e) {	 	
			tecla = (document.all) ? e.keyCode : e.which;
			//alert(tecla)
			
			if ( tecla==42 || tecla==34 || tecla==35 || tecla==37 ||  tecla==38 || tecla==39  || tecla==180 || tecla==123 || tecla==125 || tecla==91  
			|| tecla==93 || tecla==191 || tecla==43 ||  tecla==176 || tecla==33 || tecla==63 || tecla==61 || tecla==161 || tecla==168   || tecla==172 
			|| tecla==126  || tecla==94 || tecla==96  ) 
			{	return false; 	}//no permitir ingresar tecla  42: * 		//SON VALORES USADOS EN EL SISTEMA PARA PRESENTACIONES
			else   
			{return true;	}
			
}
/*
-		45
_		95
*/
//FUNCION PARA CONDICIONES ADMITIR % 37 +43 =61
validarTextoM2=function(e) {	 	
			tecla = (document.all) ? e.keyCode : e.which;
			//alert(tecla)
			
			if ( tecla==42 || tecla==34 || tecla==35  ||    tecla==38 || tecla==39  || tecla==180 || tecla==123 || tecla==125 || tecla==91  
			|| tecla==93 || tecla==191  ||  tecla==176 || tecla==33 || tecla==63 || tecla==161 || tecla==168   || tecla==172 
			|| tecla==126  || tecla==94 || tecla==96  ) 
			{	return false; 	}//no permitir ingresar tecla  42: * 		//SON VALORES USADOS EN EL SISTEMA PARA PRESENTACIONES
			else   
			{return true;	}
			
}

//FUNCION QUE VALIDA EL INGRESO DE CARACATERES EN LO MAESTROS ONCHANGE
ValidaCampoT=function(Tabla,Campo,NombreInput){
	
	//var texto=$F(NombreInput);
	var texto=jQuery('#'+NombreInput+'').val();
	var tam=texto.length;
	var i=0;
	var correcto=true;
	while(i<tam && correcto==true){
		//alert(texto[i])
		if(Evaluar(texto[i]))
		{correcto=true;
		}else{
		correcto=false;
		}
		i++;
	}
	if(correcto==true){
	ValidaCampo(Tabla,Campo,NombreInput);
	}else{
		alert("Ingrese nuevamente el campo, sin caracteres especiales.");
		jQuery('#'+NombreInput+'').val("");
		jQuery('#'+NombreInput+'').focus();
		
	}
}

ValidaCampoT2=function(NombreInput){
	
	//var texto=$F(NombreInput);
	var texto=jQuery('#'+NombreInput+'').val();
	var tam=texto.length;
	var i=0;
	var correcto=true;
	while(i<tam && correcto==true){
		//alert(texto[i])
		if(Evaluar(texto[i]))
		{correcto=true;
		}else{
		correcto=false;
		}
		i++;
	}
	if(correcto==false){
		alert("Ingrese nuevamente el campo, sin caracteres especiales.");
		jQuery('#'+NombreInput+'').val("");
		jQuery('#'+NombreInput+'').focus();
		
	}
}


Evaluar=function(val){
		//alert(val) //se quito '%'
		var array=['¬','°','\'','"','#','&','*','¨','^','~','´','|','`'];
		var band=true;
		var j=0;
		while(j<13  && band==true){
			//alert(val+' '+array[j]);
			if(val===array[j]){
				band=false;
				
			}
			j++;
		}
	
		return band;
	
	
}