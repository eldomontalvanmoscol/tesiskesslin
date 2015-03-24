// JavaScript Document
function ajax(){
var xmlhttp=false;
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
try{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}catch(E){
xmlhttp = false;
}
}

if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}


//PARA CAMBIAR LAS PAGINAS
function showPage(pag)
{
	//alert("page="+pag);
	var content=document.getElementById('contenido');
	var request=ajax();
	request.open("POST", "pages/response_ajax.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("page="+pag);	
	request.onreadystatechange=function()
	{ 	
		switch(request.readyState)
		{
			case 4:
			{
				content.innerHTML=request.responseText;		
				
if(pag=="registro.php")
{
//para subir la imagen en el registro
$(document).ready(function(){
	
	var preloader=document.getElementById('rpta');
	var button = $('#upload_button_l'), interval;
	new AjaxUpload('#upload_button_l', {
        action: 'pages/ajax_imagen.php',
		onSubmit : function(file , ext){
		if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
			// extensiones permitidas
			alert('Error: Solo se permiten imagenes');
			// cancela upload
			return false;
		} else {

preloader.innerHTML="<div style=\"width:200px;height:20px;color:#039;font-weight:bold;text-align:left;padding-top:6px;font-size:0.9em;\">Cargando...</div><div style=\"width:200px;height:20px;color:#039;font-weight:bold;text-align:left;\"><img src=\"img/cargando.gif\" width=\"25\" height=\"20\" /></div>";
			this.disable();
document.getElementById('rec_img').style.display="none";
document.getElementById('rec_img_loadding').style.display="block";
document.getElementById('rec_img_loadding_text').style.display="block";		
		}
		},
		onComplete: function(file, response){
			button.text('Cargar logo');
			// enable upload button
			this.enable();			
			// Agrega archivo a la lista

			$('#img_respuesta').appendTo('.files').text(file);
			var var_img=$('#img_respuesta');	
			document.getElementById('rec_img_loadding').style.display="none";
			document.getElementById('rec_img_loadding_text').style.display="none";	
			preloader.innerHTML="<div style=\"width:200px;height:20px;color:#ff0;font-weight:bold;text-align:left;font-size:0.9em\">Archivo subido: <b style=\"background:#FFC\">";
			document.getElementById('rec_img').style.display="block";
			document.getElementById('rec_img').src="img/empresas/logos/"+var_img.text();
			document.getElementById('rec_img').width="150";
			document.getElementById('rec_img').height="115";
			document.getElementById('ocu_imagen').value=var_img.text();
		}	
	});
	return false;
});
////////////////////////////////////////
//para subir audio en el registro
$(document).ready(function(){
	
	
		
	
	var preloader=document.getElementById('rpta_a');
	var button = $('#upload_button_a'), interval;
	new AjaxUpload('#upload_button_a', {
        action: 'pages/ajax_audio.php',
		onSubmit : function(file , ext){
		if (! (ext && /^(mp3)$/.test(ext))){
			// extensiones permitidas
			alert('Error: Solo se permiten archivos mp3');
			// cancela upload
			return false;
		} else {

preloader.innerHTML="<div style=\"width:200px;height:20px;color:#039;font-weight:bold;text-align:left;padding-top:6px;font-size:0.9em;\">Cargando...</div><div style=\"width:200px;height:20px;color:#039;font-weight:bold;text-align:left;\"><img src=\"img/cargando.gif\" width=\"25\" height=\"20\" /></div>";
			this.disable();
document.getElementById('rec_img_a').style.display="none";
document.getElementById('rec_img_loadding_a').style.display="block";
document.getElementById('rec_img_loadding_text_a').style.display="block";		
		}
		},
		onComplete: function(file, response){
			button.text('Cargar Audio');
			// enable upload button
			this.enable();			
			// Agrega archivo a la lista

			$('#img_respuesta_a').appendTo('.files').text(file);
			var var_audio=$('#img_respuesta_a');	
			
	document.getElementById('audio').style.display='none';
	document.getElementById('content_play').style.width='150px';
	document.getElementById('content_play').style.background='none';
	document.getElementById('rec_img_a').style.display='block';
	document.getElementById('rec_img_loadding_text_p').style.display="none";			
			
			document.getElementById('rec_img_loadding_a').style.display="none";
			document.getElementById('rec_img_loadding_text_a').style.display="none";	
			preloader.innerHTML="<div style=\"width:200px;height:20px;color:#ff0;font-weight:bold;text-align:left;font-size:0.9em\">Archivo subido: <b style=\"background:#FFC\">";
			document.getElementById('rec_img_a').style.display="block";
			document.getElementById('ocu_audio').value=var_audio.text();
			document.getElementById('audio').href="";
			document.getElementById('audio').href="img/empresas/audios/"+var_audio.text();
			document.getElementById('play_audio').style.display='block';
			

		}	
	});
	return false;
});
	}
						
			}
			break;
		}
	}	
}
///////////////////////////////

//para activar la reproducciondel del audio
function habilitarFuncionesMP3(){
	document.getElementById('audio').style.display='block';
	document.getElementById('content_play').style.width='250px';
	document.getElementById('content_play').style.background='#000';
	document.getElementById('rec_img_a').style.display='none';
	document.getElementById('rec_img_loadding_a').style.display="block";
	document.getElementById('rec_img_loadding_a').style.margin='10px 110px 0';
	document.getElementById('rec_img_loadding_text_p').style.display="block";	
	
$f("audio", "http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf", {

	// fullscreen button not needed here
	plugins: {
		controls: {
			fullscreen: false,
			height: 30,
			autoHide: false
		}
	},

	clip: {
		autoPlay: true,

		// optional: when playback starts close the first audio playback
		onBeforeBegin: function() {
			$f("player").close();
		}
	}

});		
		
}
//////////////////////////////////
//PARA CAMBIAR EN MENU A ACTIVO
function changeMenu(id)
{
	if(id==1)
	{
		document.getElementById("menu1").style.background="url(img/menu/nosotros_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}
	else if(id==2)
	{
		document.getElementById("menu2").style.background="url(img/menu/galeria_1.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}	
	else if(id==3)
	{
		document.getElementById("menu3").style.background="url(img/menu/guia_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}	
	else if(id==4)
	{
		document.getElementById("menu4").style.background="url(img/menu/padres_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}	
	else if(id==5)
	{
		document.getElementById("menu5").style.background="url(img/menu/foro_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}	
	else if(id==6)
	{
		document.getElementById("menu6").style.background="url(img/menu/contacto_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
		document.getElementById("menu7").style.background="url(img/menu/registrese.png)";
	}	
	else if(id==7)
	{
		document.getElementById("menu7").style.background="url(img/menu/registrese_1.png)";
		document.getElementById("menu2").style.background="url(img/menu/galeria.png)";
		document.getElementById("menu3").style.background="url(img/menu/guia.png)";
		document.getElementById("menu4").style.background="url(img/menu/padres.png)";
		document.getElementById("menu5").style.background="url(img/menu/foro.png)";
		document.getElementById("menu6").style.background="url(img/menu/contacto.png)";
		document.getElementById("menu1").style.background="url(img/menu/nosotros.png)";
	}	
}
///////////////////////////////
//PARA ENVIAR LOS DATOS DEL FORMULARIO DE CONTACTOS
function limpiar()
{
	document.getElementById('nom').value='';
	document.getElementById('nom').focus();
	document.getElementById('emp').value='';
	document.getElementById('tel').value='';
	document.getElementById('mail').value='';
	document.getElementById('comen').value='';	
}

function contactar()
{
//alert("nom="+document.getElementById('nom').value+"&emp="+document.getElementById('emp').value+"&tel="+document.getElementById('tel').value+"&mail="+document.getElementById('mail').value+"&comen="+document.getElementById('comen').value);
	var content=document.getElementById('contenido');
	var request=ajax();
	request.open("POST", "pages/request_ajax_contacto.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("nom="+document.getElementById('nom').value+"&emp="+document.getElementById('emp').value+"&tel="+document.getElementById('tel').value+"&mail="+document.getElementById('mail').value+"&comen="+document.getElementById('comen').value);	
	request.onreadystatechange=function()
	{ 	
		switch(request.readyState)
		{
			case 4:
			{
		if(request.responseText=="vacio")
		{
			$.fancybox({'opacity'	: true,'overlayColor'	: '#000','title':'Cont&aacute;ctenos - Fiesta Feliz Per&uacute;','padding':3,'href'	: "pages/msgError.php?mod=contacto&msg=Ingrese todos los campos"});	
		}
		else
		{
			$.fancybox({'opacity'	: true,'overlayColor'	: '#000','title':'Cont&aacute;ctenos - Fiesta Feliz Per&uacute;','padding':3,'href'	: "pages/msgOk.php?mod=contacto"});	
	document.getElementById('nom').value='';
	document.getElementById('emp').value='';
	document.getElementById('tel').value='';
	document.getElementById('mail').value='';
	document.getElementById('comen').value='';	
		}
		setTimeout(function(){$.fancybox.close({'onClosed':true});},5000);	
		document.getElementById('nom').focus();	
			}
			break;
		}
	}
}
//para la paginacion
function paginacion(modulo,page,tam)
{
	var request=ajax();
	if(modulo=="galeria")
	{
		var content=document.getElementById('imagenes_galeria');
		content.innerHTML='';
		document.getElementById('loadding').style.display='block';
		request.open("POST", "pages/request_ajax_paginacion.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("mod="+modulo+"&page="+page+"&tam="+tam);	
		request.onreadystatechange=function()
		{ 	
			switch(request.readyState)
			{
				case 4:
				{
					document.getElementById('pagina'+page).style.textDecoration='underline';
					document.getElementById('pagina'+page).style.color='#fff';				
					document.getElementById('loadding').style.display='none';	
					content.innerHTML=request.responseText;
				}
				break;
			}
		}	
	}
	else if(modulo=='articulos')
	{
		var content=document.getElementById('content-artic');
		content.innerHTML='';
		//document.getElementById('loadding').style.display='block';
		request.open("POST", "pages/request_ajax_paginacion.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("mod="+modulo+"&page="+page+"&tam="+tam);	
		request.onreadystatechange=function()
		{ 	
			switch(request.readyState)
			{
				case 4:
				{
					//document.getElementById('pagina'+page).style.textDecoration='underline';
					//document.getElementById('pagina'+page).style.color='#fff';				
					//document.getElementById('loadding').style.display='none';	
					content.innerHTML=request.responseText;
				}
				break;
			}
		}
	}
	else if(modulo=='cuentos')
	{
		var content=document.getElementById('content-artic');
		content.innerHTML='';
		//document.getElementById('loadding').style.display='block';
		request.open("POST", "pages/request_ajax_paginacion.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("mod="+modulo+"&page="+page+"&tam="+tam);	
		request.onreadystatechange=function()
		{ 	
			switch(request.readyState)
			{
				case 4:
				{
					//document.getElementById('pagina'+page).style.textDecoration='underline';
					//document.getElementById('pagina'+page).style.color='#fff';				
					//document.getElementById('loadding').style.display='none';	
					content.innerHTML=request.responseText;
				}
				break;
			}
		}
	}	
	else if(modulo=='tips')
	{
		var content=document.getElementById('content-artic');
		content.innerHTML='';
		//document.getElementById('loadding').style.display='block';
		request.open("POST", "pages/request_ajax_paginacion.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("mod="+modulo+"&page="+page+"&tam="+tam);	
		request.onreadystatechange=function()
		{ 	
			switch(request.readyState)
			{
				case 4:
				{
					//document.getElementById('pagina'+page).style.textDecoration='underline';
					//document.getElementById('pagina'+page).style.color='#fff';				
					//document.getElementById('loadding').style.display='none';	
					content.innerHTML=request.responseText;
				}
				break;
			}
		}
	}		
	else if(modulo=='juegos')
	{
		var content=document.getElementById('content-artic');
		content.innerHTML='';
		//document.getElementById('loadding').style.display='block';
		request.open("POST", "pages/request_ajax_paginacion.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("mod="+modulo+"&page="+page+"&tam="+tam);	
		request.onreadystatechange=function()
		{ 	
			switch(request.readyState)
			{
				case 4:
				{
					//document.getElementById('pagina'+page).style.textDecoration='underline';
					//document.getElementById('pagina'+page).style.color='#fff';				
					//document.getElementById('loadding').style.display='none';	
					content.innerHTML=request.responseText;
				}
				break;
			}
		}
	}
}

////////////////////
///FANCYBOX
$(document).ready(function()
{
	$("a#emp_rec").fancybox({
		'opacity'		: true,
		'overlayShow'	: true,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'overlayColor'  : '#000',
		'padding'		: 2
	});
});

///////////
//scripts para las provincias y distritos//

//defino una serie de varibles Array para cada país
var distritos_1=new Array("Elija su Distrito","Abancay","Chacoche","Circa","Huanipaca","Lambrama","Pichirhua","San Pedro de Cachora","Tamburco")
var distritos_2=new Array("Elija su Distrito","Arequipa","Alto Selva Alegre","Cayma","Cerro Colorado","Characato","Chiguata","Jacobo Hunter","La Joya","Mariano Melgar","Miraflores","Mollebaya","Paucaparta","Pocsi","Polobaya","Queque\xf1a","Sabandia","Sachaca","San Juan de Siguas","San Juan de Tarugani","Santa Isabel de Siguas","Santa Rita de Siguas","Socabaya","Tiabaya","Uchumayo","Vitor 1","Yanahuara","Yarabamba","Yura","Jose Luis Bustamante y Rivero")
var distritos_3=new Array("Elija su Distrito","Cajamarca","Asunci\xf3n","Chetilla","Cospan","Enca\xf1ada","Jesus","Llacanora","Los Ba\xf1os del Inca","Magdalena","Matara","Namora","San Juan")
var distritos_4=new Array("Elija su Distrito","Bellavista","Callao","Carmen de la Legua-Reynoso","Chucuito","La Perla","La Punta","Ventanilla")
var distritos_5=new Array("Elija su Distrito","Chachapoyas","Asunci\xf3n","Balsas","Cheto","Chiliquin","Chuquibamba","Granada","Huancas","La Jalca","Leimebamba","Levanto","Magdalena","Mariscal Castilla","Molinopampa","Montevideo","Olleros","Quinjalca","San Francisco de Daguas","San Isidro de Maino","Soloco","Sonche")
var distritos_6=new Array("Elija su Distrito","Chiclayo","Chongoyape","Eten","Eten Puerto","Jose Leonardo Ortiz","La Victoria","Lagunas","Monsef\xfa","Nueva Arica","Oyotun","Picsi","Pimentel","Reque","Santa Rosa","Sa\xf1a","Cayalti","Patapo","Pomalca","Pucal\xe1","Tum\xe1n")
var distritos_7=new Array("Elija su Distrito","Ayacucho","Acocro","Acos Vinchos","Carmen Alto","Chiara","Ocros","Pacaicasa","Quinua","San Jose de Ticllas","San Juan Bautista","Santiago de Pischa","Socos","Tambillo","Vinchos","Jesus Nazareno")
var distritos_8=new Array("Elija su Distrito","Acobambilla","Acoria","Ascenci\xf3n"," 	Conayca","Cuenca","Huachocolpa","Huancavelica","Huayllahuara","Izcuchaca","Laria","Manta","Mariscal C\xe1ceres","Moya","Nuevo Occoro","Palca","Pilchaca","Vilca","Yauli")
var distritos_9=new Array("Elija su Distrito","Carhuacallanga","Chacapampa","Chicche","Chilca","Chongos Alto","Chupuro","Colca","Cullhuas","El Tambo","Huacrapuquio","Hualhuas","Huancan","Huancayo","Huasicancha","Huayucachi","Ingenio","Pariahuanca"," 	Pilcomayo","Pucara","Quichuay","Quilcas","San Agust\xedn","San Jer\xf3nimo de Tun\xe1n","Saño","Santo Domingo de Acobamba","Sapallanga","Sicaya","Viques")
var distritos_10=new Array("Elija su Distrito","Amarilis","Chinchao","Churubamba","Hu\xe1nuco","Margos","Quisqui","San Francisco de Cayran","San Pedro de Chaulan"," 	Santa Mar\xeda del Valle","Yarumayo","Pillco Marca")
var distritos_11=new Array("Elija su Distrito","Cochabamaba","Colcabamba","Huanchay","Hu\xe1raz","Jangas","La Libertad","Olleros","Pampas","Pariacoto","Pira","Tarica","Independencia")
var distritos_12=new Array("Elija su Distrito","Ica","La Tingui\xf1a","Los Aquijes","Ocucaje","Pachac\xfatec","Parcona","Pueblo Nuevo","Salas","San Jos\xe9 de los Molinos","San Juan Bautista","Santiago","Subtanjalla","Tate","Yauca del Rosario")
var distritos_13=new Array("Elija su Distrito","Anc\xf3n","Carabayllo","Comas","Puente Piedra","Independencia","San Martin de Porres","Santa Rosa","Los Olivos","Otros")
var distritos_14=new Array("Elija su Distrito","Cercado de Lima","Barranco","Bre\xf1a","El Agustino","Jes\xfas Maria","La Victoria","Lince","Magdalena del Mar","Miraflores","Pueblo Libre","Rim\xe1c","San Isidro","San Lu\xeds","San Miguel","Santiago de Surco","Surquillo","San Borja")
var distritos_15=new Array("Elija su Distrito","Chaclacayo","La Molina","San Juan de Lurigancho","Santa Anita","Ate Vitarte")
var distritos_16=new Array("Elija su Distrito","Chorrillos","Pachacamac","San Juan de Miraflores","Villa Mar\xeda del Triunfo","Villa el Salvador","Lur\xedn")
var distritos_17=new Array("Elija su Distrito","Alto Nanay","Fernando Lores","Indiana","Las Amazonas","Mazan","Napo","Punchana","Putumayo","Torres Causana","Bel\xe9n","San Juan Bautista")
var distritos_18=new Array("Elija su Distrito","Carumas","Cuchumbaya","Moquegua","Samegua","San Crist\xf3bal","Torata")
var distritos_19=new Array("Elija su Distrito","Calzadda","Habana","Jepelacio","Moyobamba","Soritor","Yantalo")
var distritos_20=new Array("Elija su Distrito","Chaupimarca","Huachon","Huariaca","Huayllay","Ninacaca","Pallanchacra","Paucartambo","San Fco. de As\xeds de Yaruscayan","Simon Bolivar","Ticlacay\xe1n","Tinyahuarco","Vicco","Yanacancha")
var distritos_21=new Array("Elija su Distrito","Castilla","Catacaos","Cura Mori","El Tallan","La Arena","La Unión","Las Lomas","Piura","Tambo Grande")
var distritos_22=new Array("Elija su Distrito","Callaria","Campo Verde","Iparia","Masisea","Nueva Requena","Yarinacocha")
var distritos_23=new Array("Elija su Distrito","Tambopata","Inambari","Las Piedras 1","Laberinto")
var distritos_24=new Array("Elija su Distrito","Acora","Amantani","Atuncolla","Capachica","Chucuito","Coata","Huata","Ma\xf1azo","Paucarcolla","Pichacani","Plateria","Puno","San Antonio","Tiquillaca","Vilque")
var distritos_25=new Array("Elija su Distrito","Alto de la Alianza","Calana","Ciudad Nueva","Coronel Gregorio Albarrac\xedn Lanchipa","Incl\xe1n","Pach\xeda","Palca ","Pocollay","Quilahuani","Sama","Tacna","Tarata")
var distritos_26=new Array("Elija su Distrito","El Porvenir","Florencia de Mora","Huanchaco","La Esperanza","Laredo","Moche","Poroto","Salaverry","Simbal","Trujillo","Victor Larco Herrera")
var distritos_27=new Array("Elija su Distrito","Corrales","La Cruz","Pampas de Hospital","San Jacinto","San Juan de la Virgen","Tumbes")
var distritos_28=new Array("Elija su Distrito","Lima","Provincia")
//función que cambia las provincias del select de provincias en función del país que se haya escogido en el select de país.
function cambia_provincia(){
	//tomo el valor del select del pais elegido
	var provincias
	provincias = document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value
	//miro a ver si el pais está definido
	if (provincias != 0) {
		//si estaba definido, entonces coloco las opciones de la provincia correspondiente.
		//selecciono el array de provincia adecuado
		mis_distritos=eval("distritos_" + provincias)
		//calculo el numero de provincias
		num_distritos = mis_distritos.length
		//marco el número de provincias en el select
		document.formulario_guia.distritos.length = num_distritos
		//para cada provincia del array, la introduzco en el select
		document.formulario_guia.distritos.disabled='';
		for(i=0;i<num_distritos;i++){
		   document.formulario_guia.distritos.options[i].value=mis_distritos[i]
		   document.formulario_guia.distritos.options[i].text=mis_distritos[i]
		}	
	}else{
		//si no había provincia seleccionada, elimino las provincias del select
		document.formulario_guia.distritos.length = 1
		//coloco un guión en la única opción que he dejado
		document.formulario_guia.distritos.options[0].value = "0"
	    document.formulario_guia.distritos.options[0].text = "Elija su Distrito"
	}
	//marco como seleccionada la opción primera de provincia
	document.formulario_guia.distritos.options[0].selected = true
}


function cambia_provincia_buscar(){
	//tomo el valor del select del pais elegido
	var provincias
	provincias = document.formulario_buscar.provincias[document.formulario_buscar.provincias.selectedIndex].value
	//miro a ver si el pais está definido
	if (provincias != 0) {
		//si estaba definido, entonces coloco las opciones de la provincia correspondiente.
		//selecciono el array de provincia adecuado
		mis_distritos=eval("distritos_" + provincias)
		//calculo el numero de provincias
		num_distritos = mis_distritos.length
		//marco el número de provincias en el select
		document.formulario_buscar.distritos.length = num_distritos
		//para cada provincia del array, la introduzco en el select
		document.formulario_buscar.distritos.disabled='';
		for(i=0;i<num_distritos;i++){
		   document.formulario_buscar.distritos.options[i].value=mis_distritos[i]
		   document.formulario_buscar.distritos.options[i].text=mis_distritos[i]
		}	
	}else{
		//si no había provincia seleccionada, elimino las provincias del select
		document.formulario_buscar.distritos.length = 1
		//coloco un guión en la única opción que he dejado
		document.formulario_buscar.distritos.options[0].value = "0"
	    document.formulario_buscar.distritos.options[0].text = "Elija su Distrito"
	}
	//marco como seleccionada la opción primera de provincia
	document.formulario_buscar.distritos.options[0].selected = true
}


///////////////////////////////////////////
//para no tratar de escrtibir letras en un campo el cual solo se debe insertar numeros//
function noLetras() {
	if (event.keyCode < 48 || event.keyCode > 57 ) 
		event.returnValue = false;
}
////////////////////////////////////////////////////////////////////////////////////////
//para el buscador instantaneo
function salir_search(){
		document.getElementById('resultado').innerHTML='';
		document.getElementById('resultado').style.display='none';
}
function buscar_resul()
{
		if(document.getElementById('input_search').value.length>0 || document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value!=0  || document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].value!=0)
	
	{
	location.href="index.php?pag=3&key="+document.getElementById('input_search').value+"&search=ok";
	}
}
function search_res(){
	var content=document.getElementById('recep_busqueda');	
	document.getElementById('ocu_search').value=document.getElementById('input_search').value;
	if(document.getElementById('input_search').value.length>0 || document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value!=0  || document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].value!=0)
	{	
	  content.style.display='block';
var request=ajax();

request.open("POST", "pages/ajaxSearch_.php", true);
request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
request.send("input_search="+document.getElementById('input_search').value+"&input_prov="+document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value+"&input_dist="+document.formulario_guia.distritos[document.formulario_guia.distritos.selectedIndex].value+"&input_rubro="+document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].value);
request.onreadystatechange=function(){ 
switch(request.readyState){
case 4: {
	content.style.display='block';
	content.innerHTML=request.responseText;		 							
		}
        break;
	}
	
}	
		
	}
	else
	{
		content.style.display='none';
	}	
}
function buscar_alterno()
{
	
	if(document.getElementById('input_search').value.length>0 || document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value!=0  || document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].value!=0)
	{	
			var content=document.getElementById('resultado_search_max');
			content.innerHTML='';
			document.getElementById('loadding').style.display='block';	
var request=ajax();

request.open("POST", "pages/ajaxSearch.php", true);
request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
request.send("input_search="+document.getElementById('input_search').value+"&input_prov="+document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].value+"&input_dist="+document.formulario_guia.distritos[document.formulario_guia.distritos.selectedIndex].value+"&input_rubro="+document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].value);
request.onreadystatechange=function(){ 
switch(request.readyState){
		case 4: {
			document.getElementById('loadding').style.display='none';
			document.getElementById('frame_guia_search').style.height='auto';
			document.getElementById('content_resultado_max').style.display='block';
			document.getElementById('text_search_max').innerHTML=document.formulario_guia.provincias[document.formulario_guia.provincias.selectedIndex].text+" - "+document.formulario_guia.distritos[document.formulario_guia.distritos.selectedIndex].text+" - "+document.formulario_guia.rubro[document.formulario_guia.rubro.selectedIndex].text+" - "+document.getElementById('input_search').value;
			document.getElementById('content_resultado_max').style.display='block';
			document.getElementById('resultado_search_max').innerHTML=request.responseText;									
			
			
			}
	        break;
	}
	
}	
		
	}
	else
	{
		document.getElementById('resultado').innerHTML='';
		document.getElementById('resultado').style.display='none';
		document.getElementById('frame_guia_search').style.height='857px';
		document.getElementById('content_resultado_max').style.display='none';
	}	
}


function search_res_cab(){
		if( document.formulario_buscar.provincias[document.formulario_buscar.provincias.selectedIndex].value!=0  || document.formulario_buscar.rubro[document.formulario_buscar.rubro.selectedIndex].value!=0)
	{
location.href="index.php?pag=3&search=ok&id_prov="+document.formulario_buscar.provincias[document.formulario_buscar.provincias.selectedIndex].value+"&prov="+document.formulario_buscar.provincias[document.formulario_buscar.provincias.selectedIndex].text+"&dist="+document.formulario_buscar.distritos[document.formulario_buscar.distritos.selectedIndex].text+"&id_rubro="+document.formulario_buscar.rubro[document.formulario_buscar.rubro.selectedIndex].value+"&rubro="+document.formulario_buscar.rubro[document.formulario_buscar.rubro.selectedIndex].text;
	}
}

//////////////////////////////
function validaRegistro(){
	
	if(document.getElementById('raz_soc').value==''){
		alert("Debe ingresar la Raz\xf3n Social");
		document.getElementById('raz_soc').focus();
		return false;
		}
		else if(document.getElementById('nom_come').value==''){
		alert("Debe ingresar el Nombre Comercial");
		document.getElementById('nom_come').focus();
		return false;
		}
		else if(document.getElementById('desc').value==''){
		alert("Debe ingresar una descripci\xf3n.");
		document.getElementById('desc').focus();
		return false;
		}
		else if (document.formulario_guia_registro.provincias.selectedIndex==0){
		alert("Debe seleccionar una Provincia.");
		document.formulario_guia.provincias.focus();
		return false;
		}
		else if (document.formulario_guia_registro.distritos.selectedIndex==0){
		alert("Debe seleccionar un Distrito.");
		document.formulario_guia.distritos.focus();
		return false;
		}
		else if(document.formulario_guia_registro.contacto.value==''){
		alert("Debe ingresar el Nombre del Contacto");
		document.formulario_guia.contacto.focus();
		return false;
		}
		else if(document.formulario_guia_registro.telefono.value==''){
		alert("Debe ingresar el tel\xe9fono");
		document.formulario_guia.telefono.focus();
		return false;
		}
		else if(document.formulario_guia_registro.celular.value==''){
		alert("Debe ingresar el Celular");
		document.formulario_guia.celular.focus();
		return false;
		}
		else if(document.formulario_guia_registro.correo.value==''){
		alert("Debe ingresar el Email");
		document.formulario_guia.correo.focus();
		return false;
		}
		else if(document.formulario_guia_registro.sele.value==''){
		alert("Debe Seleccionar por lo menos un Rubro");
		document.formulario_guia.rubros.focus();
		return false;	
		
		}
		else
		{


	var request=ajax();
	//alert("raz_soc="+document.getElementById('raz_soc').value+"&ruc="+document.getElementById('ruc').value+"&nom_come="+document.getElementById('nom_come').value+"&ocu_imagen="+document.getElementById('ocu_imagen').value+"&desc="+document.getElementById('desc').value+"&mas_info="+document.getElementById('mas_info').value+"&provincias="+document.formulario_guia_registro.provincias.value+"&distritos="+document.formulario_guia_registro.distritos.value+"&dir="+document.getElementById('dir').value+"&ref="+document.getElementById('ref').value+"&contac="+document.getElementById('contac').value+"&tel="+document.getElementById('tel').value+"&cel="+document.getElementById('cel').value+"&mail="+document.getElementById('mail').value+"&next="+document.getElementById('next').value+"&web="+document.getElementById('web').value+"&sele="+document.getElementById('sele').value);
	request.open("POST", "pages/ajax_registro.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("raz_soc="+document.getElementById('raz_soc').value+"&ruc="+document.getElementById('ruc').value+"&nom_come="+document.getElementById('nom_come').value+"&ocu_imagen="+document.getElementById('ocu_imagen').value+"&desc="+document.getElementById('desc').value+"&mas_info="+document.getElementById('mas_info').value+"&provincias="+document.formulario_guia_registro.provincias.value+"&distritos="+document.formulario_guia_registro.distritos.value+"&dir="+document.getElementById('dir').value+"&ref="+document.getElementById('ref').value+"&contac="+document.getElementById('contac').value+"&tel="+document.getElementById('tel').value+"&cel="+document.getElementById('cel').value+"&mail="+document.getElementById('mail').value+"&next="+document.getElementById('next').value+"&web="+document.getElementById('web').value+"&sele="+document.getElementById('sele').value);	
	request.onreadystatechange=function()
	{ 	
		switch(request.readyState)
		{
			case 4:
			{
				
		
			$.fancybox({'opacity'	: true,'overlayColor'	: '#000','title':'Registro - Fiesta Feliz Per&uacute;','padding':3,'href'	: "pages/msgOk.php?mod=registro"});	
						
		setTimeout(function(){$.fancybox.close({'onClosed':true});location.href="index.php";},10000);	
			}
			break;
		}
	}

		return true;
		}
}

function agregaRubro(){
	var slc1 = document.getElementById("rubros");
	var slc2 = document.getElementById("seleccionados");

	valor=slc1.options[slc1.selectedIndex].value;
	texto=slc1.options[slc1.selectedIndex].text;
	document.formulario_guia_registro.sele.value+=valor+",";
	agregaOpcion(valor,texto,slc2);	
	eliminaOpcion(slc1);	
}

function eliminaRubro(){
	var slc1 = document.getElementById("rubros");
	var slc2 = document.getElementById("seleccionados");
	valor=slc2.options[slc2.selectedIndex].value;
	texto=slc2.options[slc2.selectedIndex].text;
	sele=document.formulario_guia_registro.sele.value;
	n1=sele.substring(0,sele.indexOf(valor));
	n2=sele.substring(sele.indexOf(valor)+1+valor.length,sele.length);
	document.formulario_guia_registro.sele.value=n1+n2;
	agregaOpcion(valor,texto,slc1);
	eliminaOpcion(slc2);
}

function vaciaLista(){
	var slc1 = document.getElementById("rubros");
	var slc2 = document.getElementById("seleccionados");
	document.formulario_guia_registro.sele.value="";
	while(slc2.options.length){
		valor=slc2.options[0].value;
		texto=slc2.options[0].text;
		agregaOpcion(valor,texto,slc1);
		slc2.options[0] = null;
	}
	ordenaLista(slc1);
}

function agregaOpcion(valor,texto,slc){
	option=new Option(texto,valor);
	slc.options[slc.length]=option;
	ordenaLista(slc);
}
function eliminaOpcion(slc){
	if(slc.selectedIndex>-1) slc.options[slc.selectedIndex]=null;

}

function ordenaLista(slc1){	
	cant=0;
	var array=new Array();
	while(slc1.options.length>cant){
		array[cant]=new Array();
		array[cant][0]=slc1.options[cant].value;
		array[cant][1]=slc1.options[cant].text;
		cant++;
	}
	var x,y,temp,temp2;
	for(x=0;x<array.length;x++){
		for(y=x+1;y<array.length;y++){
			if(array[x][0]>array[y][0]){
				temp=array[x][0];
				temp2=array[x][1];
				array[x][0]=array[y][0];
				array[x][1]=array[y][1];
				array[y][0]=temp;
				array[y][1]=temp2;
			}
		}
	}
	while(slc1.options.length)slc1.options[0] = null;
	c=0;
	while(c<array.length){
		valor=array[c][0];
		texto=array[c][1];
		option=new Option(texto,valor);
		slc1.options[c]=option;
		c++;
	}
}
//////////////////////////////////////////////////////////////////////
/*metodo para "crear html de las empresas (preview)"*/

function createCompFb(modulo,codigo)
{
	//alert("Modulo: "+modulo+" - Codigo: "+codigo);
	var request=ajax();
	request.open("POST", "pages/create_page_emp.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("modulo="+modulo+"&codigo="+codigo);	
	request.onreadystatechange=function()
	{ 	
		switch(request.readyState)
		{
			case 4:
			{
				/*if(request.responseText=="ok")
				{
					window.open("http://www.facebook.com/sharer.php?u=http://fiestafelizperu.com/fb/"+modulo+"/file_"+codigo+".php");
				}*/
			}
			break;
		}
	}
	
	
}

function recomendar(url){
	var request=ajax();
	request.open("POST", "pages/ajax_rec.php", true);

	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("url="+url+"&mail1="+document.getElementById("ema").value+"&mail2="+document.getElementById("eami").value+"&coment="+document.getElementById("rec_comen").value);
	request.onreadystatechange=function(){

		switch(request.readyState){
			case 4: {
					//alert(request.responseText);
					if(request.responseText=="0")
					{
						$.fancybox({'overlayShow'	: false,'padding':2,'href'	: "pages/error.html"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
					}
					else
					{
						$.fancybox({'overlayShow'	: false,'padding':2,'href'	: "pages/confirmacion.php"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
					}
					break;
				}}

		}}
		
/*function contactar(){
	var request=ajax();
	request.open("POST", "pages/ajax_com.php", true);

	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("mail1="+document.getElementById("ema").value+"&mail2="+document.getElementById("eami").value+"&coment="+document.getElementById("rec_comen").value);
	request.onreadystatechange=function(){

		switch(request.readyState){
			case 4: {
					//alert(request.responseText);
					if(request.responseText=="0")
					{
						$.fancybox({'overlayShow'	: false,'padding':2,'href'	: "pages/error.html"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
					}
					else
					{
						$.fancybox({'overlayShow'	: false,'padding':2,'href'	: "pages/confirmacion.php?c=ok"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
					}
					break;
				}}

		}}	
*/		
function comentar(){
	//alert("user="+document.getElementById("nomb_com").value+"&correo="+document.getElementById("mail_com").value+"&coment="+document.getElementById("comen_com").value);
	var request=ajax();
	request.open("POST", "pages/ajax_comentar.php", true);

	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.send("user="+document.getElementById("nomb_com").value+"&correo="+document.getElementById("mail_com").value+"&coment="+document.getElementById("comen_com").value);
	request.onreadystatechange=function(){

		switch(request.readyState){
			case 4: {
					//alert(request.responseText);
					if(request.responseText=="0")
					{
						$.fancybox({'overlayShow'	: true,'padding':2,'href'	: "pages/error.html"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
					}
					else
					{
						$.fancybox({'overlayShow'	: false,'padding':2,'href'	: "pages/confirmacion.php?com=ok"});
						setTimeout(function(){$.fancybox.close({'onClosed':true});},3000);
						
						document.getElementById('nomb_com').value='';document.getElementById('mail_com').value='';document.getElementById('comen_com').value='';document.getElementById('nomb_com').focus();
						document.getElementById('recep_comentarios').innerHTML='';
						document.getElementById('recep_comentarios').innerHTML=request.responseText;
					}
					break;
				}}

		}}				

/********************************************************/
