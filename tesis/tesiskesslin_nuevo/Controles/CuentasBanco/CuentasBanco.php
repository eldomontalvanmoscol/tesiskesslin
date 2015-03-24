<?php
//session_start(); 

class CuentasBanco{
	var $NombreC;
	var $IdMod;
	var $IdDoc;
	var $TipoOper;
	function CuentasBancos($link,$Nombre,$IdMod,$IdDoc,$TipoOpe){
		$this->NombreC	=	$Nombre;	// Nombre del control
		$this->IdMod	=	$IdMod;		// Id del modulo: Ejm. Maestro de Cliente
		$this->IdDoc	=	$IdDoc;		// Id del documento: Ejm. Id Cliente
		$this->TipoOper=$TipoOpe;	// Tipo de Operacion
		
		$Ruta="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/CuentasBanco/";
//SINCRONIZACIÓN
//include("../../Componentes/Multiempresa/Sincronizar/PersonasVariablesId.php");
//END
?>
<table width="100%" height="74" border="0">
  <tr>
    <td>Instituci&oacute;n Financiera
   <?php 
				//$SqlCombo1='SELECT IdBanco,NombreBanco FROM bancos WHERE IdMiEmpresa='.$_SESSION['IdMiEmpresa'];
				$SqlCombo1="SELECT IdBanco,NombreBanco FROM bancos WHERE IdMiEmpresa = 1";
				Combo($link,$SqlCombo1,'BancoCB','IdBanco','NombreBanco','1',$CuentaBanco,1,'');
			?>N&uacute;m. de Cta
      <input name="NumCtaCB" type="text" id="NumCtaCB" size="6" value="<?php echo $CuentaNro; ?>" />
      </td>
  </tr>
  <tr>
    <td>Tipo de Cuenta
    <?php
				$SqlCombo2='SELECT DescripCorta,IdMaestro,IdGrupo FROM ma00 where IdGrupo=14';
				Combo($link,$SqlCombo2,'TipoCtaCB','IdMaestro','DescripCorta','57',$CuentaTipo,1,'');	
				?>
    Moneda
    <?php
				//$SqlCombo3='SELECT IdTipoMoneda, NomMoneda FROM tipo_moneda Where IdMiEmpresa = '.$_SESSION['IdMiEmpresa'].' order by NomMoneda asc';
				$SqlCombo3="SELECT IdTipoMoneda, NomMoneda FROM tipo_moneda Where IdMiEmpresa = 1 order by NomMoneda asc";
				Combo($link,$SqlCombo3,'MonedaBankCB','IdTipoMoneda','NomMoneda','1',$CuentaMoneda,1,'');	
				?> 
       
      <input name="buttonA" type="button" id="buttonA" size="10" value="Agregar" onclick="NuevoCuentasBanco()"/></td>
  </tr>
</table>

<div id="DetalleCuentas" class="over" style="overflow:auto; height:100px;">
<table width="100%" border="0" cellspacing="1" cellpadding="2" id="tblCuentasBanco">
  <thead>
  <tr>
    <th width="2%" class="out">*</th>
    <th width="3%" class="out">X</th>
    <th width="54%" class="out">Institución Financiera</th>
    <th width="30%" class="out">Tipo de Cuenta</th>
    <th width="43%" class="out">Moneda</th>
    <th width="43%" class="out">N&deg; de Cta</th>
  </tr>
  </thead>
  <tbody></tbody>
</table>
</div>
<script type="text/javascript">	
CargaCuentasBanco=function(){
	var param='IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
	var url='<?php echo $Ruta;?>CuentasBancoCuadro.php'
	jQuery.getJSON(url,param,function(data,textStatus){ CargaListCtaBanco(data); FocusCuentas(); });
}

CargaListCtaBanco = function(data){
	var col='';
	for(var i=0; i<data.length; i++){
		col += '<tr>';
		col += '<td class="out">'+(parseInt(i)+1)+'</td>'
		col += '<td bgcolor="#FFFFFF"><input type="button" value="X" onclick="EliminarCuentasBanco('+data[i]['IdCuentas']+')" /></td>'
		col += '<td bgcolor="#FFFFFF">'+data[i]['NomBanco']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['TipoCuenta']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['TipoMoneda']+'</td>';
		col += '<td bgcolor="#FFFFFF">'+data[i]['CuentaNro']+'</td>';
		col += '</tr>';
	}
	jQuery("#tblCuentasBanco tbody").html(col);
}

NuevoCuentasBanco=function(){
if(jQuery('#BancoCB option:selected').text()=='SELECCIONAR UN BANCO'){
	alert('Seleccione un banco');
	
}	
else if(jQuery('#NumCtaCB').val()==''){
	alert('Ingrese n\xfamero de Cta.');

}else{
	var param='BancoCB='+jQuery('#BancoCB').val()+'&TipoCtaCB='+jQuery('#TipoCtaCB').val()+'&MonedaBankCB='+jQuery('#MonedaBankCB').val()+'&NumCtaCB='+jQuery('#NumCtaCB').val()+'&IdMod=<?php echo $this->IdMod;?>&IdDoc=<?php echo $this->IdDoc;?>';
		jQuery.ajax({
				url: '<?php echo $Ruta;?>CuentasBancoQuery.php?Accion=Insertar',
				type: 'POST',
				data: param,
				complete: function(){ CargaCuentasBanco(); }
				});
	}
}

FocusCuentas=function(){
jQuery('#BancoCB').val('');
jQuery('#TipoCtaCB').val('');
jQuery('#MonedaBankCB').val('');
jQuery('#NumCtaCB').val('');
jQuery('#NumCtaCB').focus();

}

EliminarCuentasBanco=function(IdCuentas){
	var conf = confirm("¿Desea eliminar esta cuenta bancaria?");
	
	if(conf==true){
		jQuery.ajax({
				url: '<?php echo $Ruta;?>CuentasBancoQuery.php?Accion=Eliminar&IdCuentas='+IdCuentas,
				type: 'POST',
				complete: function(){ CargaCuentasBanco(); }
				});
	}
}

CargaCuentasBanco();
</script>

<?php
}
}
?>