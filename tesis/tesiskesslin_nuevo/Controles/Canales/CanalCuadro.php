<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END	


$cs = 'SELECT IdCanal,Canal,DescripCanal,Descripcion FROM canales WHERE IdMiEmpresa='.$IdMiEmpresax.' AND IdMiSede='.$IdMiSedex.' AND IdMod='.$_GET['IdMod'].' AND IdDoc='.$_GET['IdDoc'];
$rs = mysqli_query($link,$cs);



echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
	$d = '"IdCanal":"'.utf8_encode($rw['IdCanal']).'", "Canal":"'.utf8_encode($rw['Canal']).'", "DescripCanal":"'.utf8_encode($rw['DescripCanal']).'", "Descripcion":"'.utf8_encode($rw['Descripcion']).'"';
    $a[] = '{'.$d.'}';
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';
