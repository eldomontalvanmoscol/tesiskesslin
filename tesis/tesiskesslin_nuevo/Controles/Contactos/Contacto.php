<?php

class Contacto{
	
	var $NombreC;
	var $IdMod;
	var $IdDoc;
	var $TipoOper;
	
	function Contactos($link,$Nombre,$IdMod,$IdDoc,$TipoOpe){
		$this->NombreC	=	$Nombre;	// Nombre del control
		$this->IdMod	=	$IdMod;		// Id del modulo: Ejm. Maestro de Cliente
		$this->IdDoc	=	$IdDoc;		// Id del documento: Ejm. Id Cliente
		$this->TipoOper	=	$TipoOpe;	// Tipo de Operacion
				
		$Ruta='http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['ConfG_RutaRelativaS'].'Controles/Contactos/';
	

?>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><div align="right">Nombres</div></td>
    <td>
    <input type="hidden" id="hid_InsrtUpdt" name="hid_InsrtUpdt" value="1" />
    <input type="hidden" id="id_contacto" name="id_contacto"/>
    <input name="ctrlNombres" type="text" onkeydown="return validarLetras(event)" id="ctrlNombres" size="20" onKeyPress="return validarTextoM(event)" onChange="ValidaCampoT2('ctrlNombres');" onpaste="return true" /></td>
    <td><div align="right">Cargo</div></td>
    <td ><input type="text" name="ctrlcargo" id="ctrlcargo" size="20"/></td>
    <td><div align="right">NroDoc</div></td>
    <td><input name="ctrlNroDoc" type="text" onkeydown="return validarNumeros(event)" id="ctrlNroDoc" size="8" onKeyPress="return validarTextoM(event)" onChange="ValidaCampoT2('ctrlNroDoc');" onpaste="return true"/></td>
  </tr>
  <tr>
    <td width="6%"><div align="right">Direccion</div></td>
    <td width="20%"><input name="ctrlDireccion" type="text" id="ctrlDireccion" size="20" onKeyPress="return validarTextoM(event)"  onChange="ValidaCampoT2('ctrlDireccion');" onpaste="return true" /></td>
    <td width="12%"><div align="right">Telefono</div></td>
    <td width="17%"><input name="ctrlTelefono"  onkeydown="return validarNumeros(event)" type="text" id="ctrlTelefono" size="20" /></td>
     <td width="6%">
       <div style="margin-left:107%;" align="right"> <input type="button" name="button" id="button" value="Agregar" onclick="NuevoContacto();" /></div>
        </td>
  </tr>
</table>
<div id="DetalleContacto" class="over" style="overflow:auto; height:100px;">
<table width="100%" border="0" cellspacing="1" cellpadding="2" id="tblContactos">
  <thead>
  <tr>
    <th width="2%" class="out">*</th>
    <th width="3%" class="out">X</th>
    <th width="29%" class="out">Nombres</th>
    <th width="16%" class="out">Cargo</th>
    <th width="27%" class="out">Dirección</th>
    <th width="23%" class="out">Teléfono</th>
  </tr>
  </thead>
  <tbody></tbody>
</table>
</div>

<script type="text/javascript">	
CargaContacto=function(){
	var param='IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
	var url = '<?php echo $Ruta;?>ContactoCuadro.php';
	//alert(url);
	//jQuery.getJSON(url,param,function(data,textStatus){ CargaListCon(data); FocusContacto(); });
	jQuery.getJSON(url,param,function(data,textStatus){ CargaListCon(data); FocusContacto(); });
	
}

CargaListCon=function(data){
	jQuery("#hid_InsrtUpdt").val(1);
	var col='';
	for(var i=0; i<data.length; i++){
		//variables creadas para un mejor orden al llevar String en una funcion javascript
		var cargo="'"+data[i]['Cargo']+"'";
		var Direccion="'"+data[i]['Direccion']+"'";
		var Nombre="'"+data[i]['Nombres']+"'";
		
		col += '<tr onclick="ObtenerDatos('+data[i]['IdContacto']+','+data[i]['NroDoc']+','+data[i]['Telefono']+','+cargo+','+Direccion+','+Nombre+');">';
		col += '<td class="out">'+(parseInt(i)+1)+'</td>'
		col += '<td bgcolor="#FFFFFF"><input type="button" value="X" onclick="EliminarContacto('+data[i]['IdContacto']+')" /></td>'
		col += '<td bgcolor="#FFFFFF">'+data[i]['Nombres']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Cargo']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Direccion']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Telefono']+'</td>';
		col += '</tr>';
	}
	jQuery("#tblContactos tbody").html(col); //IdContacto,Nombres,NroDoc,Direccion,Telefono
}



NuevoContacto=function(){
	if(jQuery("#hid_InsrtUpdt").val()==1){
		if(jQuery('#ctrlNombres').val()==''){
			alert('No ha llenado el campo Nombres');
			jQuery('#ctrlNombres').focus();
		}else{
			var param='';
			var param='ctrlNombres='+jQuery('#ctrlNombres').val()+'&ctrlNroDoc='+jQuery('#ctrlNroDoc').val()+'';
			param+='&ctrlDireccion='+jQuery('#ctrlDireccion').val()+'&ctrlTelefono='+jQuery('#ctrlTelefono').val()+'&ctrlCargo='+jQuery('#ctrlcargo').val()+'';
			param+='&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
			
			jQuery.ajax({
					url: '<?php echo $Ruta;?>ContactoQuery.php?Accion=Insertar',
					type: 'POST',
					data: param,
					complete: function(){ CargaContacto(); }
					});
		}
	}else if(jQuery("#hid_InsrtUpdt").val()==2){
		if(jQuery('#ctrlNombres').val()==''){
			alert('No ha llenado el campo Nombres');
			jQuery('#ctrlNombres').focus();
		}else{
			var IdContacto=jQuery("#id_contacto").val();
			var param='';
			var param='ctrlNombres='+jQuery('#ctrlNombres').val()+'&ctrlNroDoc='+jQuery('#ctrlNroDoc').val()+'';
				param+='&ctrlDireccion='+jQuery('#ctrlDireccion').val()+'&ctrlTelefono='+jQuery('#ctrlTelefono').val()+'&ctrlCargo='+jQuery('#ctrlcargo').val()+'';
				param+='&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';	
			jQuery.ajax({
					url: '<?php echo $Ruta;?>ContactoQuery.php?Accion=Actualizar&IdContacto='+IdContacto,
					type: 'POST',
					data: param,
					complete: function(){ CargaContacto(); }
					});
		}
	}	
}

FocusContacto=function(){
	jQuery('#ctrlNombres').val('');
	jQuery('#ctrlNroDoc').val('');
	jQuery('#ctrlDireccion').val('');
	jQuery('#ctrlTelefono').val('');
	jQuery('#ctrlcargo').val('');
	jQuery('#ctrlNombres').focus;

}
validarLetras=function(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; // backspace
		if (tecla==32) return true; // espacio
		if (tecla==9) return true; // tabulador horizontal
		if (tecla==11) return true; // tabulador vertical
		    if (tecla==110) return true; // punto
		if (e.ctrlKey && tecla==86) { return true;} //Ctrl v
		if (e.ctrlKey && tecla==67) { return true;} //Ctrl c
		if (e.ctrlKey && tecla==88) { return true;} //Ctrl x

		patron = /[a-zA-Z]/; //patron

		te = String.fromCharCode(tecla); 
		return patron.test(te); // prueba de patron
}

validarNumeros=function(e) { // 1
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if (tecla==8) return true; // backspace
		if (tecla==9) return true; // tabulador horizontal
		if (tecla==11) return true; // tabulador vertical
		if (tecla==109) return true; // menos
    if (tecla==110) return true; // punto
		if (tecla==189) return true; // guion
		if (e.ctrlKey && tecla==86) { return true}; //Ctrl v
		if (e.ctrlKey && tecla==67) { return true}; //Ctrl c
		if (e.ctrlKey && tecla==88) { return true}; //Ctrl x
		if (tecla>=96 && tecla<=105) { return true;} //numpad

		patron = /[0-9]/; // patron

		te = String.fromCharCode(tecla); 
		return patron.test(te); // prueba
	}

EliminarContacto=function(IdContacto){
	var conf = confirm("¿Desea eliminar este contacto?");
	
	if(conf==true){
		jQuery.ajax({
				url: '<?php echo $Ruta;?>ContactoQuery.php?Accion=Eliminar&IdContacto='+IdContacto,
				type: 'POST',
				complete: function(){ CargaContacto(); }
				});
	}
}

CargaContacto();

ObtenerDatos = function (IdContacto,NroDoc,Telefono,Cargo,Direccion,Nombre){
		jQuery("#ctrlTelefono").val(Telefono);
		jQuery("#id_contacto").val(IdContacto);
		jQuery("#ctrlNroDoc").val(NroDoc);
		jQuery("#ctrlcargo").val(Cargo);
		jQuery("#ctrlDireccion").val(Direccion);
		jQuery("#ctrlNombres").val(Nombre);
		jQuery("#hid_InsrtUpdt").val(2);
}
</script>

<?php
}

}
?>