// JavaScript Document
redondeadoNum=function(numero, decimales) {
	factor = Math.pow(10, decimales);
	Respuesta=String((Math.round(numero*factor)/factor));	
	ArragloResp=Respuesta.split(".");
	Dec=ArragloResp[1];
	if(Dec.length<decimales){		
		for(i=Dec.length;i<decimales;i++){
			Dec+="0";						
		}		
		Final=String(ArragloResp[0]+'.')+String(Dec);		
	}else
		Final=Respuesta;	
	return Final; 		
}
