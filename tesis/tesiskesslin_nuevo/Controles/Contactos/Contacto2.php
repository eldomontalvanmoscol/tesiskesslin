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
<script type="text/javascript">	
CargaContacto=function(){
	var parame='IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
	new Ajax.Updater('DetalleContacto','<?php echo $Ruta;?>ContactoCuadro.php',{
	parameters: parame,
	evalScripts:true,
	method:'post',
	onComplete: FocusContacto	
	}); 
}

NuevoContacto=function(){
	if($F('ctrlNombres')==''){
		alert('No ha llenado el campo Nombres');
		$('ctrlNombres').focus();
	}else{
		var param='';
		var param='ctrlNombres='+$F('ctrlNombres')+'&ctrlNroDoc='+$F('ctrlNroDoc')+'';
		param+='&ctrlDireccion='+$F('ctrlDireccion')+'&ctrlTelefono='+$F('ctrlTelefono')+'';
		param+='&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';		
		new Ajax.Request('<?php echo $Ruta;?>ContactoQuery.php?Accion=Insertar',{
			evalScripts:true,
			method:'post',
			parameters: param,
			onComplete: CargaContacto
			});
	}	
}

FocusContacto=function(){
	Field.clear('ctrlNombres');
	Field.clear('ctrlNroDoc');
	Field.clear('ctrlDireccion');
	Field.clear('ctrlTelefono');
	Field.focus('ctrlNombres');
}

EliminarContacto=function(IdContacto){
	new Ajax.Request('<?php echo $Ruta;?>ContactoQuery.php?Accion=Eliminar&IdContacto='+IdContacto,{
	evalScripts:true,
	method:'post',
	onComplete: CargaContacto
	}); 
}

CargaContacto();
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><div align="right">Nombres</div></td>
    <td><input name="ctrlNombres" type="text" id="ctrlNombres" size="40" onKeyPress="return validarTextoM(event)" onChange="ValidaCampoT2('ctrlNombres');" onpaste="return true" /></td>
    <td><div align="right">NroDoc</div></td>
    <td><input name="ctrlNroDoc" type="text" id="ctrlNroDoc" size="25" onKeyPress="return validarTextoM(event)" onChange="ValidaCampoT2('ctrlNroDoc');" onpaste="return true"/></td>
    <td><input type="button" name="button" id="button" value="Agregar" onclick="NuevoContacto();" /></td>
  </tr>
  <tr>
    <td width="6%"><div align="right">Direccion</div></td>
    <td width="25%"><input name="ctrlDireccion" type="text" id="ctrlDireccion" size="40" onKeyPress="return validarTextoM(event)"  onChange="ValidaCampoT2('ctrlDireccion');" onpaste="return true" /></td>
    <td width="12%"><div align="right">Telefono</div></td>
    <td width="17%"><input name="ctrlTelefono" type="text" id="ctrlTelefono" size="25" /></td>
    <td width="40%">&nbsp;</td>
  </tr>
</table>
<div id="DetalleContacto" class="over" style="overflow:auto; height:100px;"></div>
<?php
}
}
?>