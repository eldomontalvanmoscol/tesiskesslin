<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();

function Inserta($link){
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END
	$add = 'INSERT INTO canales (
	IdMiEmpresa,
	IdMiSede,
	IdMod,
	IdDoc,
	Canal,
	DescripCanal,
	Descripcion,
	FCreacion
	) VALUES (
	'.$IdMiEmpresax.',
	'.$IdMiSedex.',
	'.$_POST['IdMod'].',
	'.$_POST['IdDoc'].',
	"'.utf8_decode($_POST['Canal']).'",
	"'.utf8_decode($_POST['CanalDescrip']).'",
	"'.utf8_decode($_POST['Descripcion']).'",
	NOW()
	)';
	
	mysqli_query($link,$add);
}

function Elimina($link){
	$del = 'DELETE FROM canales WHERE IdCanal='.$_GET['IdCanal'];
	mysqli_query($link,$del);
}

if($_GET['Accion']=='Insertar'){ Inserta($link); }
if($_GET['Accion']=='Eliminar'){ Elimina($link); }
?>