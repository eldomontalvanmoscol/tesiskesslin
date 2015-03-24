<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END	

$cs = 'SELECT IdContacto,Nombres,NroDoc,Direccion,Telefono,Cargo FROM contactos WHERE IdMiEmpresa='.$IdMiEmpresax.' AND IdMiSede='.$IdMiSedex.' and IdMod='.$_GET['IdMod'].' and IdDoc='.$_GET['IdDoc'].' ORDER BY IdContacto DESC';
$rs = mysqli_query($link,$cs);
	
echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
			$d = '"IdContacto":"'.utf8_encode($rw['IdContacto']).'", 
				  "Nombres":"'.utf8_encode($rw['Nombres']).'", 
				  "NroDoc":"'.utf8_encode($rw['NroDoc']).'", 
				  "Direccion":"'.utf8_encode($rw['Direccion']).'", 
				  "Telefono":"'.utf8_encode($rw['Telefono']).'",
				  "Cargo":"'.utf8_encode($rw['Cargo']).'"';
    $a[] = '{'.$d.'}';
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';
?>