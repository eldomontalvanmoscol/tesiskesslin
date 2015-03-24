<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();

function Inserta($link){
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END	
	$add = 'INSERT INTO direcciones (
	IdMiEmpresa,
	IdMiSede,
	IdMod,
	IdDoc,
	Direccion,
	Referencias,
	Ubigeo,
	FCrea
	) VALUES (
	'.$IdMiEmpresax.',
	'.$IdMiSedex.',
	'.$_POST['IdMod'].',
	'.$_POST['IdDoc'].',
	"'.utf8_decode($_POST['Direccion']).'",
	"'.utf8_decode($_POST['Referencias']).'",
	"'.utf8_decode($_POST['Ubigeo']).'",
	NOW()
	)';

	mysqli_query($link,$add);
}

function Elimina($link){
	$del = 'DELETE FROM direcciones WHERE IdDireccion='.$_GET['IdDireccion'];
	mysqli_query($link,$del);
}

if($_GET['Accion']=="Insertar") Inserta($link);
if($_GET['Accion']=="Eliminar") Elimina($link);
?>