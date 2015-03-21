//SCRIPT DATA GRID SKYNET
jQuery.fn.SkynetGrid=function() {

  var args=arguments[0] || {};  //Enviando argumentos
  var Nombre=args.Nombre;  //Nombre para identificar cada uno de los elementos
  var url=args.Url;  //obtenemos valor del array
  var ancho=args.Ancho;
  var alto=args.Alto;  //alto del grid
  var NroReg=args.NroReg;  //nro de registros por defaul
  var OrderBy=args.OrderBy;  //Ordenamiento por default
  var OrderCampo=args.OrderCampo;  //Ordenamiento por default
  var PagIni=args.PagIni;  
  var QueryGrid=args.QueryGrid;
  var Options=args.Options;
  var FocusOn=args.FocusOn;
  //var Alias=args.Alias;  
  var CampoId=args.CampoId;  //campo de seleccion de ID
  var FunciG=args.FunciLoadGrid;
  var Funci=args.FunciMouse;
  var FunciParam=args.FunciParam;
  var MenuView=args.MenuVisible;
  var MenuList=args.MenuContextual;
  var OtrosC=args.OtrosCampos;
  var Msg=args.Msg;
  var columna=args.Columna;  //array de cabecera y cuerpo del grid
  var nroColumnas=columna.length;  //contamos cantidad de columnas  
  var paramDC=args.paramDC;  
  var ContPag=1;
  var AliasCampos;
  var NameCampo=new Array();  //Nombres de cabecera
  var NameOtrosC=new Array(); 
  var DivLoader=jQuery(this);
  
  //FilSel=''; //Limpiamos la variable que contiene el IdFila, Esta Variable se encuentra declarada en el Index.

  var m={
	  
	  OCampos: function(){
		var j=0;
        for (x in OtrosC){
          NameOtrosC[j]=OtrosC[x];
		  j++;
        }
	  },
	  
      TraeDatos:function(PagIni){ //obtenemos el arreglo json del archivo externo .php
		
	    if(m.AddOpt()!=''){
          var Campo=jQuery('#cmbB'+Nombre).val();
          var Texto=jQuery('#txtB'+Nombre).val();
		  Texto = Texto.replace('ñ','n');
		  Texto = Texto.replace('Ñ','N'); 
		  Texto = Texto.replace('á','a');
		  Texto = Texto.replace('é','e');
		  Texto = Texto.replace('í','i');
		  Texto = Texto.replace('ó','o');
		  Texto = Texto.replace('ú','u');
		  Texto = Texto.replace('Á','A');
		  Texto = Texto.replace('É','E');
		  Texto = Texto.replace('Í','I');
		  Texto = Texto.replace('Ó','O');
		  Texto = Texto.replace('Ú','U');	  
	    }else{
		  var Campo='';
          var Texto='';
	    }

        jQuery.getJSON(url+'?accion=datos',{Ord:OrderBy, ordCamp:OrderCampo, PagI:PagIni, Query:QueryGrid, Alias:AliasCampos, Pg:NroReg, Campo:Campo,Texto:Texto},function(data,textStatus){
		  //alert(data.length);
		  
		  if(data.length==0){
		    if(Msg==''){
              Msg='Lo sentimos, pero no existen resultados para la opción de búsqueda realizada.';
            }
  
            var Aviso='<table width="100%" height="100%"><tr><td align="center">'+Msg+'</td></tr>'
            jQuery('#contenedor'+Nombre).append('<div id="MsgG'+Nombre+'" class="MsgGrid" >'+Aviso+'</div>');  
			
			  jQuery('#DivG'+Nombre).css('position','relative');
			  //jQuery('#contenedor'+Nombre).css('position','relative');
			  jQuery('#MsgG'+Nombre).show();
			  
		  }else if(data.length>0){
			  jQuery('#MsgG'+Nombre).hide();
			  jQuery('#DivG'+Nombre).css('position','');
			  //jQuery('#contenedor'+Nombre).css('position','');
			  jQuery('#loading'+Nombre).show();
		  }
		  
          m.Recorre(data,NameCampo);  //Referenciamos una funcion externa para evitar el undesing
          m.TRegist(Campo,Texto);
          m.TPaginas();

		  jQuery('#loading'+Nombre).hide();
		  if(FunciG==1){
		     GridFunction();
		  }
		  //alert("hi");
		  /*jQuery.ajax({
		         url: url+'?accion=datos',
				 type: 'GET',
				 //async: false,
				 dataType: 'JSON',
				 beforeSend: function(){ jQuery('#loading'+Nombre).show(); },
				 data: {Ord:OrderBy, ordCamp:OrderCampo, PagI:PagIni, Query:QueryGrid, Alias:AliasCampos, Pg:NroReg, Campo:Campo,Texto:Texto},
				 success: function(data){
					        m.Recorre(data,NameCampo);  //Referenciamos una funcion externa para evitar el undesing
                            m.TRegist(Campo,Texto);
							m.TPaginas();
							
					 },
				complete: function(){ 
				         jQuery('#loading'+Nombre).hide();
						// alert(FunciG); 
						 //if(FunciG==1){
            //jQuery('#'+Nombre+'Itm1').trigger('click');
            //alert("finish");
          				//}
						 }*/
        });
      },
      
      Recorre: function(data,NombreCampo){    //pinta el cuerpo del grid 

        for(var i=0; i<data.length; i++) {  //bucle por el total de registros
		  var p='';
		  var pd='';
          var Item=parseInt(i)+1;
          var Regis='<td id="'+Nombre+'Itm'+Item+'" class="GridTitle" oncontextmenu="event.stopPropagation(); return false;" onclick="event.stopPropagation(); return false;" >'+Item+'</td>';  //columna inicial para el item   
		
		  for(var a in FunciParam){ //Arma parametros para funcion Click
		    p=p+'\''+data[i][FunciParam[a]]+'\',';
		  }
		  p=p.substring(0,p.length-1);
		
          for(var x=0;x<nroColumnas;x++){  //total de columnas para extraer el valor de name
            Regis=Regis+'<td align="'+columna[x].align+'">'+data[i][NombreCampo[x]].replace(/"/gi,"").replace(/'/gi,"")+'</td>';
          }
		  //\''+Nombre+'\',\''+Nombre+data[i][CampoId]+'\',\''+data[i][CampoId]+'\',\''+Nombre+data[i][CampoId]+'\'
		  //var Param=Nombre+','+Nombre+data[i][CampoId]+','+data[i][CampoId]+','+Nombre+data[i][CampoId];
		  
		  var param=data[i][CampoId]+'\',\''+Nombre;

		  jQuery('<tr class="GridFila" id="'+Nombre+data[i][CampoId]+'" onClick="jQuery.fn.SkynetGrid.PintarCelda(\''+param+'\');'+Funci[0].name+'('+p+');" oncontextmenu="jQuery.fn.SkynetGrid.PintarCelda(\''+param+'\');'+Funci[2].name+'('+p+');" onDblClick="'+Funci[1].name+'('+p+');return false;"></tr>').html(Regis).appendTo('table#Grid'+Nombre+' tbody');

		  
        }//onContextMenu="menuCont();"
	  
	  },
      
      TRegist: function(Campo,Texto){//Calcula Total de Registros
        jQuery.ajax({
          url:url+'?accion=Reg',
          type: 'GET',
          data: 'Query='+QueryGrid+'&Campo='+Campo+'&Texto='+Texto+'&Nombre='+Nombre,
          dataType:'script',
          async:false
		  //complete: function() { alert("Reg"); }
        });
      },
      
      TPaginas: function(){//Calcula Total de Paginas
        var TReg=parseInt(jQuery('#TReg'+Nombre).val());
        if(TReg<NroReg){
          var Pags=1;
        }else{
          var Pags=Math.ceil(TReg/NroReg);
        }
        jQuery('#TPag'+Nombre).val(Pags);
      },
      
      LlenaCmb: function(){ //Agrega Options al Combo del Buscador
        for(var i=0; i<Options.length; i++){
          jQuery('#cmbB'+Nombre).append('<option value="'+Options[i].value+'">'+Options[i].name+'</option>');
        }
      },
      
      LoadLista: function(PagIni){
        jQuery('table#Grid'+Nombre+' tbody').find('tr').remove();
        m.TraeDatos(PagIni);
      },
	  
      BDatos: function(event){
        if(event.keyCode==13){
          jQuery('#btnI'+Nombre).trigger('click');
        }
      },
	  
	  AltDiv: function(){ //Calcula la altura del Grid
		
		if(Options!=''){
          var H_Search=jQuery('#SearchG'+Nombre).height();
		}else{
		  var H_Search=0;
		}

		var H_Footer=jQuery('#footer'+Nombre).height();
		var H_FootSear=parseInt(H_Search)+parseInt(H_Footer);
		
		if(alto==''){  
		  var H_Grid=DivLoader.height();
		  //alert(H_Grid);
          var H_Container=parseInt(H_Grid)+2-parseInt(H_FootSear);
		}else{
		  //var H_Container=parseInt(alto)-parseInt(H_FootSear);
		  var H_Container=alto;
		}
		  
		jQuery('#contenedor'+Nombre).height(H_Container);
		
	  },
	  
	  AnchTable: function(){
	  	if(ancho==''){
			var W_Table='100%';
		}else{
			var W_Table=ancho;
		}
		return W_Table;
	  },
	  
	  AddOpt: function(){ //Agrega Buscador
	    if(Options==''){
		  var opt='';
		}else{
		  var opt='<div style="background-color:#EEEEEE;" id="SearchG'+Nombre+'" ><table><tr><td><select id="cmbB'+Nombre+'" name="cmbB'+Nombre+'"></select></td><td><input type="text" id="txtB'+Nombre+'" size="30" name="txtB'+Nombre+'"/></td><td><input type="button" id="btnB'+Nombre+'" name="btnB'+Nombre+'" value="Buscar" /></td></tr></table></div>';
		}
		//jQuery('SearchG'+Nombre).focus();
		return opt;
	  },
	  
	  AddMenu: function(){  //Agregamos links Personalizados al MenuContextual
		jQuery('#btnsGridSk ul').remove();
		var list='';
		for(var i=0; i<MenuList.length; i++){
	      list+='<ul><li id="'+MenuList[i].IdLink+'" style="width:100%; text-align:left;" >'+MenuList[i].NameLink+'</li></ul>';
		}
		list+='<hr>'
	    jQuery('#btnsGridSk').html(list);
	  },
	  
	  OcultaLinks: function(){ // Agrega o Oculta, dependiento de los Botones de Accion de la barra

        if(jQuery('#BotonesAccion').find('#Nuevo').is(':disabled')){
          jQuery('#MNuevo'+Nombre).hide();
        }else{
          jQuery('#MNuevo'+Nombre).show();
        }
  
        if(jQuery('#BotonesAccion').find('#Editar').is(':disabled')){
          jQuery('#MEditar'+Nombre).hide();
        }else{
          jQuery('#MEditar'+Nombre).show();
        }
  
        if(jQuery('#BotonesAccion').find('#Eliminar').is(':disabled')){
          jQuery('#MEliminar'+Nombre).hide();
        }else{
          jQuery('#MEliminar'+Nombre).show();
        }
  
        if(jQuery('#BotonesAccion').find('#Anular').is(':disabled')){
          jQuery('#MAnular'+Nombre).hide();
        }else{
          jQuery('#MAnular'+Nombre).show();
        }
  
        if(jQuery('#BotonesAccion').find('#Imprimir').is(':disabled')){
          jQuery('#MImprimir'+Nombre).hide();
        }else{
          jQuery('#MImprimir'+Nombre).show();
        }
	  }
	  
    };

	  if(MenuView==1){ // Si MenuView equivale a 1, entonces se crea el MenuContextual
       	var Menu='';
	    Menu+='<div id="Menu'+Nombre+'" class="MenuContextual" align="left">';
        Menu+='<ul style="width:100%;">';
        Menu+='<li id="MRefresh'+Nombre+'"  style="width:100%; text-align:left;" onClick="inicio();">';//location.reload()
        Menu+='<img src="ImgSys/refresh.png" alt="adit" style="vertical-align:middle;" /> Refrescar</li>';
        Menu+='</ul>';
        Menu+='<hr>';
		Menu+='<ul style="width:100%;">';
        Menu+='<li id="MNuevo'+Nombre+'"  style="width:100%; text-align:left;" onClick="Nuevo();">';
        Menu+='<img src="ImgSys/nuevo.png" alt="add new" style="vertical-align:middle;" /> Nuevo</li>';
        Menu+='<li id="MEditar'+Nombre+'"  style="width:100%; text-align:left;" onClick="Editar();">';
        Menu+='<img src="ImgSys/editar.png" alt="edit" style="vertical-align:middle;" /> Editar</li>';
        Menu+='<li id="MEliminar'+Nombre+'"  style="width:100%; text-align:left;" onClick="Eliminar();">';
        Menu+='<img src="ImgSys/delete.png" alt="adit" style="vertical-align:middle;" /> Eliminar</li>';
        Menu+='<li id="MAnular'+Nombre+'"  style="width:100%; text-align:left;" onClick="Anular();">';
        Menu+='<img src="ImgSys/cancelar.png" alt="adit" style="vertical-align:middle;" /> Anular</li>';
        Menu+='<li id="MImprimir'+Nombre+'"  style="width:100%; text-align:left;" onClick="Imprimir();">';
        Menu+='<img src="ImgSys/print.png" alt="adit" style="vertical-align:middle;" /> Imprimir</li>';
		Menu+='</ul>';
        Menu+='<hr>';
		if(MenuList.length>0){
		  Menu+='<ul style="width:100%;">';
		  for(var i=0; i<MenuList.length; i++){
	        Menu+='<li id="'+MenuList[i].IdLink+'" style="width:100%; text-align:left;">';
			if(MenuList[i].ImgLink!=''){
			   Menu+='<img src="'+MenuList[i].ImgLink+'" style="vertical-align:middle;" />';
			}
			Menu+=' '+MenuList[i].NameLink+'</li>';
		  }
		  Menu+='</ul>';
          Menu+='<hr>';
		}
		Menu+='<ul style="width:100%;">';
        Menu+='<li id="MUsuario'+Nombre+'"  style="width:100%; text-align:left;" onClick="MuestraUser();">';
        Menu+='<img src="ImgSys/user.png" alt="adit" style="vertical-align:middle;" /> Perfil de usuario</li>';
        Menu+='<li id="MSalir'+Nombre+'"  style="width:100%; text-align:left;" onClick="Salir();">';
        Menu+='<img src="ImgSys/salir.gif" alt="adit" style="vertical-align:middle;" /> Salir de Skynet ERP</li>';
        Menu+='</ul>';
        Menu+='</div>';
	  }else{
	    var Menu='';
	  }
	   
	  var W_Table=m.AnchTable();
	  
//top:'+jQuery(this).offset().top+'px; left:'+jQuery(this).offset().left+'px; width:'+jQuery(this).width()+'px; height:'+jQuery(this).height()+'px;
  jQuery(this).html('<div id="DivG'+Nombre+'" style="width:100%; background-color:#EEEEEE;"><div id="loading'+Nombre+'" align="center" style="display:none; position:absolute; top:'+jQuery(this).offset().top+'px; left:'+jQuery(this).offset().left+'px; width:'+jQuery(this).width()+'px; height:'+jQuery(this).height()+'px; z-index:10001;"><div style="background-color:#FFF; width:200px; height:80px; position:relative; top:35%; border:#666 solid 1px; padding-top:80px;">Cargando ...<img src="ImgSys/ajax_loading5.gif" width="16" height="16" alt="Ajax" /></div></div>'+Menu+m.AddOpt()+'   <div id="contenedor'+Nombre+'"  style="overflow:auto; height:100%;   background-color:#CECBBD;"><table width="'+W_Table+'" class="GridSk" id="Grid'+Nombre+'" tabindex="0" border="0" cellspacing="1" cellpadding="2"><thead><tr><td class="GridTitle" id="astk'+Nombre+'" >*</td></tr></thead><tbody></tbody></table></div><div id="footer'+Nombre+'"><table width="100%" class="GridTitle" cellpadding="0"><tr><td align="left"><input type="button" id="btnI'+Nombre+'" name="btnI'+Nombre+'" value="Inicio" ><input type="button" id="btnA'+Nombre+'" name="btnA'+Nombre+'" value="&lt;"><input type="text" size="7" id="NroPag'+Nombre+'" name="NroPag'+Nombre+'" style="text-align:center" readonly="readonly" onclick="jQuery(this).select();" onkeyup="LoadGrid(event);" /><input type="button" id="btnS'+Nombre+'" name="btnS'+Nombre+'" value="&gt;"><input type="button" id="btnF'+Nombre+'" name="btnF'+Nombre+'" value="Final" /><input type="hidden" id="RegActual'+Nombre+'" name="RegActual'+Nombre+'" value="0" /></td><td></td><td align="right"><label>Total Pag.</label><input type="text" size="7" id="TPag'+Nombre+'" name="TPag'+Nombre+'" readonly="readonly" style="text-align:center"/>&nbsp;&nbsp;<label>Total Reg.</label><input type="text" size="7" id="TReg'+Nombre+'" name="TReg'+Nombre+'" readonly="readonly" style="text-align:center"/></td></tr></table></div></div></div>');  //pintamos la estructura base        //style="overflow:auto; 
  m.AltDiv();
  m.AnchTable();
  m.OCampos();
  m.OcultaLinks();
  Menu='';
  
  
  for(Xc=0; Xc<nroColumnas; Xc++){
	  //alert(columna[0].name);
  if(columna[Xc].name==OrderBy){ 
    if(OrderCampo=='DESC'){ var s='▼'; }else{ var s='▲';  }
  }else{ 
    var s=''; 
  }
  //pintamos la cabecera
    jQuery('table#Grid'+Nombre+' thead tr').bind('contextmenu',function(event){ event.stopPropagation(); return false;});
    jQuery('table#Grid'+Nombre+' thead tr').append('<td class="GridTitle" id="'+columna[Xc].name+Nombre+'" width="'+columna[Xc].width+'" >'+columna[Xc].display+' '+s+'</td>');  //id="'+columna[Xc].name+'"
    NameCampo[Xc]=columna[Xc].name;   
  } 
  
  AliasCampos=NameCampo.toString()+','+NameOtrosC.toString(); //Convierte array de Columnas a Cadena, para enviarlo por Ajax
  jQuery('#NroPag'+Nombre).val(ContPag);
  
  m.TraeDatos(PagIni);
  m.LlenaCmb();

  jQuery('#contenedor'+Nombre).scrollTop(0);
  
  //jQuery('#DivG'+Nombre).resizable(); //Redimensiona el div que contiene la tabla
  
  jQuery('#btnI'+Nombre).click(function(){ //Evento del Boton Inicio
    var NReg=0;
    ContPag=1;
    m.LoadLista(NReg);
    jQuery('#NroPag'+Nombre).val(ContPag);
    jQuery('#RegActual'+Nombre).val(NReg);
  });
  
  jQuery('#btnF'+Nombre).click(function(){ //Evento del Boton Final
    var Fin=parseInt(jQuery('#TReg'+Nombre).val())-parseInt(NroReg);  
    if(Fin>NroReg){  //condicionamos para que no de error cuando hay pocos registros
      ContPag=parseInt(jQuery('#TPag'+Nombre).val());  
      jQuery('#NroPag'+Nombre).val(ContPag);
      jQuery('#RegActual'+Nombre).val(Fin);
      m.LoadLista(Fin);
    }
  });
  
  jQuery('#btnS'+Nombre).click(function(){ //Evento del Boton Siguiente
    var Reg=parseInt(jQuery('#RegActual'+Nombre).val());
    if(Reg<parseInt(jQuery('#TReg'+Nombre).val())-NroReg){
      Reg = parseInt(Reg)+parseInt(NroReg);
      ++ContPag;
      jQuery('#NroPag'+Nombre).val(ContPag);
      jQuery('#RegActual'+Nombre).val(Reg);
      m.LoadLista(Reg);
    }
  });
  
  jQuery('#btnA'+Nombre).click(function(){ //Evento del Boton Anterior
    var Reg=parseInt(jQuery('#RegActual'+Nombre).val());
    if(Reg>0){
      Reg=parseInt(Reg)-parseInt(NroReg);
      if(Reg<=0){
        jQuery('#btnI'+Nombre).click();
      }else{
        --ContPag;
        jQuery('#NroPag'+Nombre).val(ContPag);
        jQuery('#RegActual'+Nombre).val(Reg); 
        m.LoadLista(Reg); 
      }
    }
  });

  jQuery('#btnB'+Nombre).click(function(){ //Evento del Boton Buscar 
	jQuery('#btnI'+Nombre).trigger('click');
  });
  
  jQuery('#txtB'+Nombre).keyup(function(event){ //Al dar Enter hace una busqueda por el texto que hemos ingresado
    var Focus=jQuery(this).is(':focus');
  	if(event.keyCode==13 && Focus){
	  jQuery('#btnI'+Nombre).click();
	  FilSel='';
	}
  });
  
  jQuery(window).bind('resize',m.AltDiv); //Redimensiona la altura del Grid dependiendo del ancho y alto de la ventana
  
 
 //************** ORDENAMIENTO POR CABECERA ASC O DESC  **************
  jQuery('table#Grid'+Nombre+' thead tr td').click(function(){
	var Id=jQuery(this).attr('id');
	var Id=Id.replace(Nombre,'');
	var str=jQuery('#'+OrderBy+Nombre).text();
	str=str.substring(0,str.length-1);
	jQuery('#'+OrderBy+Nombre).text(str);
    OrderBy=Id;
  
    if(OrderCampo=='DESC'){
	  jQuery(this).append(' ▲');  //ˆ
      OrderCampo='ASC';
    }else{
	  jQuery(this).append(' ▼'); //^ mas grande   //ˇ
      OrderCampo='DESC';
    }
  
    var Reg=parseInt(jQuery('#RegActual'+Nombre).val());
    jQuery('#RegActual'+Nombre).val(Reg);
    m.LoadLista(Reg);
	jQuery('#NroPag'+Nombre).val(ContPag);
 
  });
  
  jQuery('#astk'+Nombre).unbind('click');
  
  jQuery('#Grid'+Nombre).bind('contextmenu',function(e){
	  
      var posG=jQuery('#contenedor'+Nombre).offset(); //Posicion del Div
      var posX=(e.pageX - posG.left); // Posicion del Mouse respecto de X
      var posY=(e.pageY - posG.top);  // Posicion del Mouse respecto de Y
	  
	  //Eje Y
	  var H_Grid=jQuery('#contenedor'+Nombre).height();
	  var H_Menu=jQuery('#Menu'+Nombre).height();
	  var H_Pos=parseInt(H_Grid)-parseInt(H_Menu);
	  
	  //Eje X
      var W_Grid=jQuery('#contenedor'+Nombre).width();
	  var W_Menu=jQuery('#Menu'+Nombre).width();
	  var W_Pos=parseInt(W_Grid)-parseInt(W_Menu);
	  
	  if(posX > W_Pos){ //Posicion X del Menu
	     posX=parseInt(e.pageX)-parseInt(W_Menu)-14;
	  }else{
	     posX=e.pageX;
	  }
	  
	  if(posY > H_Pos){ //Poscion Y del Menu
	     posY=parseInt(e.pageY)-parseInt(H_Menu);
	  }else{
	     posY=e.pageY;
	  }
	  
     jQuery('#Menu'+Nombre).css({'left':posX, 'top':posY, 'zIndex':'101'}).show(30);

     jQuery(document.body).bind('contextmenu',function(e){ return false; });
     jQuery('#Grid'+Nombre+', #Menu'+Nombre).click(function(){
		jQuery('#Menu'+Nombre).hide(30);
        jQuery(document.body).unbind('contextmenu');
     });
	 jQuery(document.body).click(function(){
	    jQuery('#Menu'+Nombre).hide(30);
        jQuery(document.body).unbind('contextmenu');
	  });

  });
  
  if(Options!='' && FocusOn==1){
	  
    jQuery('#txtB'+Nombre).focus();
	/*jQuery('#txtB'+Nombre).focus(function(){
      FilSel='';
    });*/
  }
 
  

jQuery.fn.SkynetGrid.PintarCelda=function(Id,Nom){
  IdLista=Id;
  jQuery('#Grid'+Nom+' tr').removeClass('SelectFila');
  jQuery('#Grid'+Nom+' tr').addClass('GridFila');
  jQuery('#'+Nom+Id).removeClass('GridFila');
  jQuery('#'+Nom+Id).addClass('SelectFila');
  FilSel=Nom+Id;
  //alert(FilSel);
  jQuery('#Grid'+Nom).attr('onkeydown','NavegarGrid(event)');

};

};