<?php

class Direccion{
	var $NombreC;
	var $IdMod;
	var $IdDoc;
	var $TipoOper;
	function Direcciones($link,$Nombre,$IdMod,$IdDoc,$TipoOpe){
		$this->NombreC	=	$Nombre;	// Nombre del control
		$this->IdMod	=	$IdMod;		// Id del modulo: Ejm. Maestro de Cliente
		$this->IdDoc	=	$IdDoc;		// Id del documento: Ejm. Id Cliente
		$this->TipoOper	=	$TipoOpe;	// Tipo de Operacion
		
		$Ruta='http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['ConfG_RutaRelativaS'].'Controles/Direcciones/';
?>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="6%"><div align="right">Direcci&oacute;n</div></td>
    <td width="31%"><input name="DirControl" type="text" class="Izq" id="DirControl" size="20"  onKeyPress="return validarTextoM(event)" onChange="ValidaCampoT2('DirControl');"  onpaste="return true" /></td>
    <td width="10%"><div align="right">Referencias</div></td>
    <td width="48%"><input name="Referencias" type="text" id="Referencias"  class="Izq" size="20"  onKeyPress="return validarTextoM(event)"  onChange="ValidaCampoT2('Referencias');" onpaste="return true"/></td>
    <td width="5%"><input type="button" name="button" id="button" value="Agregar" onclick="NuevoDir();" /></td>
  </tr>
    <tr>
    <td><div align="right">Ubigeo</div></td>
    <td colspan="5">
    <?php
    $Ubi5 = new Ubigeo();	
    $Ubi5->UbigeoDir($db,'Ubigeo2','150101',$Ubigeo);	//db, Nombre, Default, Editar
    ?>			</td>
  </tr>
  
</table>
<div id="DetalleDireccion" class="over" style="overflow:auto; height:100px;">
<table width="100%" border="0" cellspacing="1" cellpadding="2" id="tblDirecciones">
  <thead>
  <tr>
    <th width="2%" class="out">*</th>
    <th width="3%" class="out">X</th>
    <th width="54%" class="out">Dirección</th>
    <th width="30%" class="out">Ubigeo</th>
    <th width="43%" class="out">Referencias</th>
  </tr>
  </thead>
  <tbody></tbody>
</table>
</div>

<script type="text/javascript">	
CargaDir=function(){
	var param='IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
	var url='<?php echo $Ruta;?>DireccionCuadro.php';
	jQuery.getJSON(url,param,function(data,textStatus){ CargaListDirec(data); FocusDir(); });
}

CargaListDirec = function(data){
	var col='';
	for(var i=0; i<data.length; i++){
		col += '<tr>';
		col += '<td class="out">'+(parseInt(i)+1)+'</td>'
		col += '<td bgcolor="#FFFFFF"><input type="button" value="X" onclick="EliminarDir('+data[i]['IdDireccion']+')" /></td>'
		col += '<td bgcolor="#FFFFFF">'+data[i]['Direccion']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Ubigeo']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Referencias']+'</td>';
		col += '</tr>';
	}
	jQuery("#tblDirecciones tbody").html(col);
}

NuevoDir=function(){
if(jQuery('#DirControl')==''){
alert('No ha llenado el campo Direccion');
FocusDir();
}else{
	var param='Direccion='+jQuery('#DirControl').val()+'&Referencias='+jQuery('#Referencias').val()+'&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>'+'&Ubigeo='+jQuery('#Ubigeo2').val();
		jQuery.ajax({
				url: '<?php echo $Ruta;?>DireccionQuery.php?Accion=Insertar',
				type: 'POST',
				data: param,
				complete: function(){ CargaDir(); }
				});
	}
}

FocusDir=function(){
jQuery('#DirControl').val('');
jQuery('#Referencias').val('');
jQuery('#DirControl').focus();
}

EliminarDir=function(IdDireccion){
	var conf = confirm("¿Desea eliminar esta dirección?");
	if(conf==true){
		jQuery.ajax({
				url: '<?php echo $Ruta;?>DireccionQuery.php?Accion=Eliminar&IdDireccion='+IdDireccion,
				type: 'POST',
				complete: function(){ CargaDir(); }
				});
	}
}

CargaDir();
</script>

<?php
}
}
?>