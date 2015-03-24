<?php
session_start();
include ('../../Cx.php');
include('../../Class/Ubigeo.php');
$link=Conectarse();
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END	


$cs = 'SELECT IdDireccion,Direccion,Ubigeo,Referencias FROM direcciones WHERE IdMiEmpresa='.$IdMiEmpresax.' AND IdMiSede='.$IdMiSedex.' and IdMod='.$_GET['IdMod'].' and IdDoc='.$_GET['IdDoc'].' ORDER BY IdDireccion DESC';
$rs = mysqli_query($link,$cs);

echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
	$d = '"IdDireccion":"'.utf8_encode($rw['IdDireccion']).'", "Direccion":"'.utf8_encode($rw['Direccion']).'", "Ubigeo":"'.utf8_encode($rw['Ubigeo']).'", "Referencias":"'.utf8_encode($rw['Referencias']).'"';
    $a[] = '{'.$d.'}';
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';
