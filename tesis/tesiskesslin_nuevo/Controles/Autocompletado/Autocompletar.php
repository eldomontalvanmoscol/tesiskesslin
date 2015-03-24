<?php
####################### EJEMPLO DE USO DE AUTOCOMPLETADO ########################

##Declaramos los parametros
//$Atributos=array(NombreCampo1,NombreCampo2,NombreCampo3,NombreTabla,Condicion);
//$Campos=array(NombreCampo1,NombreCampo2,NombreCampo3);
//$CampoBusqueda="NombreCampo1";
//$NomCajaTexto="CajaTexto";
//$NomListado="Autocompletado";
//$ValueOption="NombreCampo1";
//$Inputs=array("NombreCampo2","NombreCampo3");
//$ValueCajaTexto="Value";

#Esta funcion carga otros inputs que necesitemos llenar. 
//$Funcion="CargarDatosSecundarios()";

#Si nos situamos en el campo de texto de autocompletado y presionamos ENTER esta funcion abrira el Formulario Rapido para insertar un Nuevo Socio, si colocamos "", entonces no se ejecutara nada.
//$Formulario="AbreFormulario()"

#Funcion que limpia campos secundarios
//$Limpiar="LimpiaDatosSecundarios()";

##Creamos el Objeto de la Clase Autocompletdo
//$AutoCompleta=new Autocompletado();
//$AutoCompleta->Autocompletar($Atributos,$Campos,$CampoBusqueda,"NomCajaTexto","NomListado","ValueOption",$Inputs,$ValueCajaTexto,$Funcion,$Formulario,$Limpiar);

#################################################################################

class Autocompletado{
  var $Atributos;  //array(Campo1,Campo2,Campo3,Tabla,Condicion)
  var $Campos;
  var $CampBusqueda;
  var $NomCampo;
  var $NomCombo;
  var $CmbValor;
  var $COcultos;
  var $ValueD;
  var $Funcion;
  var $Formulario;
  var $Limpiar;
  var $ToolTip;
  var $ConvetirCPP;
  var $ValVend;
	
  function Autocompletar($ArrAtributos,$CamposTabla,$CampoBusqueda,$NomCajaT,$NomCombo,$cmbValor,$COcultos,$ValueD,$Funcion,$Form,$Limpiar,$ConvetirCPP=1,$ValVend=1){
    $this->Atributos  =  $ArrAtributos;    //1.array(Campo1,Campo2,Campo3,Tabla,Condicion)
    $this->Campos    =  $CamposTabla;    //2.Alias de los campos 
    $this->CampBusqueda= $CampoBusqueda;  //3.Campo por el cual hace la busqueda
    $this->NomCampo  =  $NomCajaT;      //4.Nombre y Id del Campo de texto
    $this->NomCombo  =  $NomCombo;      //5.Nombre y Id del Select
    $this->CmbValor  =  $cmbValor;      //6.Value del Select
    $this->COcultos    =  $COcultos;      //7.Campos Ocultos donde se guarda la data
    $this->ValueD    =  $ValueD;      //8.Valor Editar
    $this->Funcion    =  $Funcion;      //9.Funcion que se ejecuta despues de seleccionar un valor de la lista
    $this->Formulario =  $Form;        //10.Funcion que abre formulario rapido (Persona, Productos)
    $this->Limpiar    =  $Limpiar;      //11.Funciona que limpia otros secundarios
  	$this->ConvetirCPP=	$ConvetirCPP;	//esta variable indica si es que seguiremos convertiendo a la persona en cliente y proveedor al buscar,ojo si ya no deseamos realizar este proceso.simplemente  pasamos como parametro. "NO".en nuestro metodo Autocompletar,que por defecto es "0".//implementado por richard.
	$this->ValVend=	$ValVend;//validamos cleintess asignados o todos para los vendedores,es otro parametro agregado por richard,lo mismo si no queremos validar los clientes asignado pasamos como parametro en nuestro metodo despues del parametro .$ConvetirCPP por que sino tomara como su valor este.colocamos "0"//implementado por richard.
	
    $AtributosT = implode('**',$this->Atributos);
    $CamposT   = implode(',',$this->Campos);
    
    $Ruta="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];
//display:none;
    
    echo "<div id=\"Div".$this->NomCampo."\" style=\"display:none; position:absolute; padding:8px; background-color:#FF9; border:#CCC 1px solid; z-index:7000; \">Presione la tecla Enter/Doble click, para crear un Nuevo Socio.</div>";

    
    echo "<input type=\"text\" name=\"".$this->NomCampo."\" placeholder=\"Buscar...\" id=\"".$this->NomCampo."\" autocomplete=\"off\" size=\"40\" value=\"".$this->ValueD."\" />";
    echo "<div style='display:none' id='ValidaVend".$this->NomCampo."'></div>";
    echo "<br><select name=\"".$this->NomCombo."\" id=\"".$this->NomCombo."\" multiple=\"multiple\" style=\"width:225px; height:170px; display:none;  position:absolute !important; z-index:7001 !important;\"></select>"; //width:225px; 
    echo "<input type=\"hidden\" id=\"Cont".$this->NomCampo."\" name=\"Cont".$this->NomCampo."\" value=\"0\" />";
//width:225px;
?>

<script type="text/javascript">
jQuery(document).ready(function(){ 
Autcompletar<?php echo $this->NomCampo;?>=function(){
  jQuery('#'+'<?php echo $this->NomCombo; ?>').find("option").remove();
  jQuery('#'+'<?php echo "Cont".$this->NomCampo; ?>').val('0');
  
  var palabra=jQuery('#'+'<?php echo $this->NomCampo; ?>').val();
  
  palabra = palabra.replace('ñ','n');
  palabra = palabra.replace('Ñ','N'); 
  palabra = palabra.replace('á','a');
  palabra = palabra.replace('é','e');
  palabra = palabra.replace('í','i');
  palabra = palabra.replace('ó','o');
  palabra = palabra.replace('ú','u');
  palabra = palabra.replace('Á','A');
  palabra = palabra.replace('É','E');
  palabra = palabra.replace('Í','I');
  palabra = palabra.replace('Ó','O');
  palabra = palabra.replace('Ú','U');

  jQuery.getJSON("<?php echo $Ruta;?>Controles/Autocompletado/AutocompletadoQuery.php",{CampBusq:'<?php echo $this->CampBusqueda; ?>', Campo: '<?php echo $AtributosT; ?>',Columna: "<?php echo $CamposT; ?>",Palabra: palabra},function(data,textStatus){
    Recorre<?php echo $this->NomCampo;?>(data);    
  });
  
   /*jQuery.get("<?php// echo $Ruta;?>Controles/Autocompletado/AutocompletadoQuery.php", { CampBusq:'<?php// echo $this->CampBusqueda; ?>',Campo:'<?php// echo $AtributosT; ?>',Columna: "<?php// echo $CamposT; ?>",Palabra: palabra },
    function(data){
		alert(data);
    });*/
  

}

Recorre<?php echo $this->NomCampo;?>=function(data){    //Pinta los datos en el Combo        
  jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option').remove();
  jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();

  var Cont=0;
  
  for(var i = 0; i < data.length; i++) {  //bucle por el total de registros  
    
    jQuery('#'+'<?php echo $this->NomCombo; ?>').append("<option onclick=\"CapturaDatos<?php echo $this->NomCampo;?>('"+data[i]['<?php echo $this->Campos[0]; ?>']+"','"+data[i]['<?php echo $this->Campos[1]; ?>']+"','"+data[i]['<?php echo $this->Campos[2]; ?>']+"');\" value='"+data[i]['<?php echo $this->CmbValor; ?>']+"'>"+data[i]['<?php echo $this->CmbValor; ?>']+"</option>");
      Cont++;
      jQuery('#'+'<?php echo $this->NomCombo; ?>').show();
	  jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:first').attr('selected','selected');
  }
  
  jQuery('#'+'<?php echo "Cont".$this->NomCampo; ?>').val(Cont);  
  
}

jQuery('#'+'<?php echo $this->NomCombo; ?>').bind('change keyup',function (event) { //Pinta Opcion Seleccionada en el Campo al pulsar Enter
  if(event.keyCode==13){ 
    jQuery(this).children("option:selected").click();
  }
}).change();
  
CapturaDatos<?php echo $this->NomCampo;?>=function(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>)
{
	if('<?php echo $this->ConvetirCPP; ?>'==1)
	{
		var Campo1='<?php echo $this->Campos[1]?>';
		var Campo2='<?php echo $this->Campos[2]?>';
		var funcion='<?php echo $fun=substr($this->Funcion,0,12);?>';
		var Desicion=0;
		//consultamos en los parametros biene el campo IdPersona,sirve para crear  cliente o proveedor luego de consultar
		if(Campo1=='IdPersona'){Desicion=1;}
		else if(Campo2=='IdPersona'){Desicion=2;}
		if(Desicion!=0)
		{
			if(Desicion==1){var IdPersona=<?php echo $this->Campos[1]; ?>;}else{var IdPersona=<?php echo $this->Campos[2]; ?>}
			if(funcion=='buscaCliente'){
			jQuery.ajax({
				type:"POST",
				url:"<?php echo $Ruta;?>Controles/Autocompletado/ConvierteProCli.php",
				data:"Accion=ConvierteCP&IdPersona="+IdPersona,
				success:function(){
				  CrearHiddenFin<?php echo $this->NomCampo;?>(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>);
				}
			})
			}else{
				 CrearHiddenFin<?php echo $this->NomCampo;?>(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>);
				}
		}else{
		  CrearHiddenFin<?php echo $this->NomCampo;?>(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>)
		}
	}else{
		CrearHiddenFin<?php echo $this->NomCampo;?>(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>)
	}
}

CrearHiddenFin<?php echo $this->NomCampo;?>=function(<?php echo $this->Campos[0]; ?>,<?php echo $this->Campos[1]; ?>,<?php echo $this->Campos[2]; ?>)
{	
	if('<?php echo $this->ValVend;?>'==1){
		var Campo1='<?php echo $this->Campos[1]?>';
		var Campo2='<?php echo $this->Campos[2]?>';
		var Desicion=0;	//consultamos en los parametros biene el campo IdPersona,sirve para validar clientes asignados para vendedores
		if(Campo1=='IdPersona'){Desicion=1;}else if(Campo2=='IdPersona'){Desicion=2;}
		if(Desicion==1){var IdPersonaCP=<?php echo $this->Campos[1]; ?>;}else{var IdPersonaCP=<?php echo $this->Campos[2]; ?>}
		
		jQuery.ajax({type:'POST',url:"<?php echo $Ruta;?>Controles/Autocompletado/ConvierteProCli.php",data:'Accion=ValidaVend&NombControl=<?php echo $this->NomCampo;?>&IdPersonaC='+IdPersonaCP,success: function(data){
			jQuery('#ValidaVend<?php echo $this->NomCampo;?>').html(data);
			if(jQuery('#ValTran<?php echo $this->NomCampo;?>').val()==0){
				jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
				jQuery('#'+'<?php echo $this->NomCampo; ?>').val(jQuery.trim(<?php echo $this->Campos[0]; ?>));
				jQuery('#'+'<?php echo $this->COcultos[0]; ?>').val(<?php echo $this->Campos[1]; ?>);
				jQuery('#'+'<?php echo $this->COcultos[1]; ?>').val(<?php echo $this->Campos[2]; ?>);  
				<?php echo $this->Funcion; ?>
			 }else{
				 alert("El socio de negocio seleccionado está restringido para su cuenta");
				 jQuery('#<?php echo $this->NomCampo;?>').val('').focus();
			 }
			}
		})
	}else{
		jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
		jQuery('#'+'<?php echo $this->NomCampo; ?>').val(jQuery.trim(<?php echo $this->Campos[0]; ?>));
		jQuery('#'+'<?php echo $this->COcultos[0]; ?>').val(<?php echo $this->Campos[1]; ?>);
		jQuery('#'+'<?php echo $this->COcultos[1]; ?>').val(<?php echo $this->Campos[2]; ?>);  
		<?php echo $this->Funcion; ?>
	}
}

VerificaAutoC<?php echo $this->NomCampo;?>=function(event){
  var cant=jQuery('#'+'<?php echo "Cont".$this->NomCampo; ?>').val();
  var CantPalabra=jQuery('#'+'<?php echo $this->NomCampo; ?>').val().length;
  if(event.keyCode==13){
    jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
    <?php echo $this->Formulario; ?>
  }
}
	
jQuery('#'+'<?php echo $this->NomCampo; ?>').keydown(function(event){ 
  if(jQuery('#'+'<?php echo $this->NomCampo; ?>').is(':focus')){
    if(event.keyCode==40){ //SI PRESIONA LA TECLA DOWN (FLECHA HACIA ABAJO)
	  event.preventDefault();
	  if(!(jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:last').is(':selected'))){
        var OptSelect=jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:selected').removeAttr('selected');
	    OptSelect.next().attr('selected','selected');
	  }
    }else if(event.keyCode==38){ //SI PRESIONA LA TECLA UP (FLECHA HACIA ARRIBA)
	  event.preventDefault();
	  if(!(jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:first').is(':selected'))){
        var OptSelect=jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:selected').removeAttr('selected');
	    OptSelect.prev().attr('selected','selected');
	  }else{
	    jQuery('#'+'<?php echo $this->NomCombo; ?>').find("option").remove();
        jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
	  }
    }
  }
});

jQuery('#'+'<?php echo $this->NomCampo; ?>').keyup(function(event){
  if(jQuery('#'+'<?php echo $this->NomCampo; ?>').attr('readonly')!='readonly'){
    
    if(event.keyCode==13){
	  if(jQuery('#'+'<?php echo $this->NomCombo; ?>').is(':visible')){
	    jQuery('#'+'<?php echo $this->NomCombo; ?>').find('option:selected').trigger('click');
	  }else{
        jQuery('#'+'<?php echo $this->NomCombo; ?>').find("option").remove();
        jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
        <?php echo $this->Formulario; ?>
	  }
    }
    if(event.keyCode==8){
        <?php 
        if(is_array($this->COcultos)){
          for($indice=0; $indice<count($this->COcultos); $indice++){
        ?>
            jQuery('#'+'<?php echo $this->COcultos[$indice]; ?>').val('');
        <?php
          }
        }else{
        ?>
            jQuery('#'+'<?php echo $this->COcultos; ?>').val('');;
        <?php
        }
        echo $this->Limpiar;
        ?>
    }
    
    if(event.keyCode!=40 && event.keyCode!=38 && event.keyCode!=13 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=35 && event.keyCode!=36 && event.keyCode!=16 && event.keyCode!=186 && event.keyCode!=222){//event.keyCode!=8 && 
      var longitud = jQuery('#'+'<?php echo $this->NomCampo; ?>').val().length;
      if(longitud>=4 && !(/^\s+$/.test(jQuery('#'+'<?php echo $this->NomCampo; ?>').val()))){
        Autcompletar<?php echo $this->NomCampo;?>();
      }else{
        jQuery('#'+'<?php echo $this->NomCombo; ?>').find("option").remove();
        jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
        
        <?php 
        if(is_array($this->COcultos)){
          for($indice=0; $indice<count($this->COcultos); $indice++){
        ?>
            jQuery('#'+'<?php echo $this->COcultos[$indice]; ?>').val('');
        <?php
          }
        }else{
        ?>
            jQuery('#'+'<?php echo $this->COcultos; ?>').val('');;
        <?php
        }
        echo $this->Limpiar;
        ?>        
      }
    }
  }
});

jQuery('#'+'<?php echo $this->NomCampo; ?>').dblclick(function(event){
	<?php echo $this->Formulario; ?>
})
jQuery('#'+'<?php echo $this->NomCombo; ?>').mouseout(function(){
  jQuery(document).click(function(){
    jQuery('#'+'<?php echo $this->NomCombo; ?>').find("option").remove();
    jQuery('#'+'<?php echo $this->NomCombo; ?>').hide();
  });
});


CapturaPosi<?php echo $this->NomCampo;?>=function(){
  <?php if($this->Formulario!=""){ ?>
  if(jQuery('#'+'<?php echo $this->NomCampo; ?>').attr('readonly')!='readonly'){
    var Posi=jQuery('#'+'<?php echo $this->NomCampo; ?>').offset();
    var Ancho=jQuery('#'+'<?php echo $this->NomCampo; ?>').width()+5;
  
    jQuery('#'+'Div<?php echo $this->NomCampo; ?>').css({left:Posi.left+Ancho});
	//jQuery('#'+'Div<?php echo $this->NomCampo; ?>').css({left:Posi.left+Ancho,top:Posi.top});//anterior
    //jQuery('#'+'Div<?php //echo $this->NomCampo; ?>').show();
    //setTimeout("OcultaDiv<?php //echo $this->NomCampo;?>();",3000);
  }
  <?php } ?>
}

OcultaDiv<?php echo $this->NomCampo;?>=function(){
  jQuery('#'+'Div<?php echo $this->NomCampo; ?>').hide();
}

jQuery('#'+'<?php echo $this->NomCampo; ?>').focus(CapturaPosi<?php echo $this->NomCampo;?>);

}); //Cierra Evento ready

</script>

<?php
  }
}

?>