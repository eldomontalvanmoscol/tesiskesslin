<?php
class Canal{
	var $NombreC;
	var $IdMod;
	var $IdDoc;
	var $TipoOper;
	function Canales($link,$Nombre,$IdMod,$IdDoc,$TipoOpe){
		$this->NombreC	=	$Nombre;	// Nombre del control
		$this->IdMod	=	$IdMod;		// Id del modulo: Ejm. Maestro de Cliente
		$this->IdDoc	=	$IdDoc;		// Id del documento: Ejm. Id Cliente
		$this->TipoOper	=	$TipoOpe;	// Tipo de Operacion
		
	$Ruta='http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['ConfG_RutaRelativaS'].'Controles/Canales/';
	$cs = 'SELECT IdMaestro,IdGrupo,DescripCorta FROM ma00 WHERE IdGrupo=9';
	$rs = mysqli_query($link,$cs);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="2" >
	<tr>
		<td width="4%"><div align="right">Canal</div></td>
		<td width="5%"><select name="Canal" id="Canal">
			<?php
        	while($rw = $rs->fetch_object()) //echo "<option value=\"".utf8_encode($rw->DescripCorta)."\" onclick=\"FocusC()\">".utf8_encode($rw->DescripCorta)."</option>";
			echo '<option value="'.utf8_encode($rw->DescripCorta).'" onclick="FocusC()">'.utf8_encode($rw->DescripCorta).'</option>';
			?>
			</select></td>
		<td width="20%"><input name="CanalDescrip" type="text" id="CanalDescrip"  class="Izq" size="10"/></td>
		<td width="10%"><div align="right">Descripci&oacute;n</div></td>
		<td width="56%"><input name="Descripcion" type="text" class="Izq" id="Descripcion" size="20" /></td>
		<td width="5%"><input type="button" name="button" id="button" value="Agregar" onclick="NuevoCan();" /></td>
	</tr>
</table>
<div id="DetalleCanal" class="over" style="overflow:auto; height:100px;">
<table width="100%" border="0" cellspacing="1" cellpadding="2" id="tblCanales">
  <thead>
  <tr>
    <th width="2%" class="out">*</th>
    <th width="3%" class="out">X</th>
    <th width="18%" class="out">Canal</th>
    <th width="19%" class="out">Número</th>
    <th width="58%" class="out">Descripción</th>
  </tr>
  </thead>
  <tbody></tbody>
</table>
</div>

<script type="text/javascript">	

CargaCan=function(){
	var param='IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';	
	var url='<?php echo $Ruta;?>CanalCuadro.php';
	jQuery.getJSON(url,param,function(data,textStatus){ CargaListCan(data); FocusC(); });
}

CargaListCan = function(data){
	var col='';
	for(var i=0; i<data.length; i++){
		col += '<tr>';
		col += '<td class="out">'+(parseInt(i)+1)+'</td>'
		col += '<td bgcolor="#FFFFFF"><input type="button" value="X" onclick="EliminarCan('+data[i]['IdCanal']+')" /></td>'
		col += '<td bgcolor="#FFFFFF">'+data[i]['Canal']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['DescripCanal']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['Descripcion']+'</td>';
		col += '</tr>';
	}
	jQuery("#tblCanales tbody").html(col);
}

NuevoCan=function(){
	if(jQuery('#CanalDescrip').val()==''){
		alert('No ha llenado el campo del canal');
		FocusC();
	}else{
		var param='Canal='+jQuery('#Canal').val()+'&CanalDescrip='+jQuery('#CanalDescrip').val()+'&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>&Descripcion='+jQuery('#Descripcion').val();
		var url='<?php echo $Ruta;?>CanalQuery.php?Accion=Insertar';
			jQuery.ajax({
					url: url,
					type: 'POST',
					data: param,
					complete: function(){
						CargaCan();
					}
			});
			
		}
}

FocusC=function(){
	jQuery('#CanalDescrip').val('');
	jQuery('#Descripcion').val('');
	jQuery('#CanalDescrip').focus();
	
}

EliminarCan=function(IdCanal){
	var conf = confirm("¿Desea eliminar este canal?");
	if(conf==true){
		var url='<?php echo $Ruta;?>CanalQuery.php?Accion=Eliminar&IdCanal='+IdCanal;
		jQuery.ajax({
					url: url,
					type: 'POST',
					complete: function(){
						CargaCan();
					}
		});
	}
}
CargaCan();

</script>

<?php
}
}
?>
