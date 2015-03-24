<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdMiEmpresa.php');
//END


//$cs = 'SELECT IdCuentas,(SELECT NombreBanco FROM bancos WHERE IdBanco=cuentas_bancarias.CuentaBanco) AS NomBanco,(SELECT DescripCorta FROM ma00 WHERE IdGrupo=14 AND IdMaestro=cuentas_bancarias.CuentaTipo) AS TipoCuenta,(SELECT Simbolo FROM tipo_moneda WHERE IdTipoMoneda=cuentas_bancarias.CuentaMoneda) AS TipoMoneda,CuentaNro FROM cuentas_bancarias WHERE IdMiEmpresa='.$_SESSION['IdMiEmpresa'].' and IdMiSede='.$_SESSION['IdMiSede'].' and IdMod='.$_GET['IdMod'].' and IdDoc='.$_GET['IdDoc'].' ORDER BY IdCuentas DESC';
$cs = 'SELECT IdCuentas,(SELECT NombreBanco FROM bancos WHERE IdBanco=cuentas_bancarias.CuentaBanco) AS NomBanco,(SELECT DescripCorta FROM ma00 WHERE IdGrupo=14 AND IdMaestro=cuentas_bancarias.CuentaTipo) AS TipoCuenta,(SELECT Simbolo FROM tipo_moneda WHERE IdTipoMoneda=cuentas_bancarias.CuentaMoneda) AS TipoMoneda,CuentaNro FROM cuentas_bancarias WHERE IdMiEmpresa='.$IdMiEmpresax.' and IdMod='.$_GET['IdMod'].' and IdDoc='.$_GET['IdDoc'].' ORDER BY IdCuentas DESC';

$rs = mysqli_query($link,$cs);

echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
	$d = '"IdCuentas":"'.utf8_encode($rw['IdCuentas']).'", "NomBanco":"'.utf8_encode($rw['NomBanco']).'", "TipoCuenta":"'.utf8_encode($rw['TipoCuenta']).'", "TipoMoneda":"'.utf8_encode($rw['TipoMoneda']).'", "CuentaNro":"'.utf8_encode($rw['CuentaNro']).'"';
    $a[] = '{'.$d.'}';
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';
?>