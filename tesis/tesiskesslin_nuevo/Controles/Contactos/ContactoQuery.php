<?php
session_start();
include ('../../Cx.php');

$link=Conectarse();

function Inserta($link){
//SINCRONIZACIÓN
	include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php');
//END	
	$add = 'INSERT INTO contactos (
	IdMiEmpresa,
	IdMiSede,
	IdMod,
	IdDoc,
	Nombres,
	NroDoc,
	Direccion,
	Telefono,
	Cargo,
	FCrea,
	IdUserCrea
	) VALUES (
	'.$IdMiEmpresax.',
	'.$IdMiSedex.',
	'.$_POST['IdMod'].',
	'.$_POST['IdDoc'].',
	"'.trim(utf8_decode($_POST['ctrlNombres'])).'",
	"'.trim(utf8_decode($_POST['ctrlNroDoc'])).'",
	"'.trim(utf8_decode($_POST['ctrlDireccion'])).'",
	"'.trim(utf8_decode($_POST['ctrlTelefono'])).'",
	"'.trim(utf8_decode($_POST['ctrlCargo'])).'",
	NOW(),
	'.$_SESSION['IdUsuario'].'
	)';

	mysqli_query($link,$add);
}

function Elimina($link){
	$del = 'DELETE FROM contactos WHERE IdContacto='.$_GET['IdContacto'];
	mysqli_query($link,$del);
}

function Actualiza($link){
	$upd = "UPDATE contactos SET
	 	IdMod='".$_POST['IdMod']."',
		IdDoc='".$_POST['IdDoc']."',
		Nombres='".trim(utf8_decode($_POST['ctrlNombres']))."',
		NroDoc='".trim(utf8_decode($_POST['ctrlNroDoc']))."',
		Direccion='".trim(utf8_decode($_POST['ctrlDireccion']))."',
		Telefono='".trim(utf8_decode($_POST['ctrlTelefono']))."',
		Cargo='".trim(utf8_decode($_POST['ctrlCargo']))."'
	 	WHERE IdContacto=".$_GET['IdContacto'];
	mysqli_query($link,$upd);
}

if($_GET['Accion']=='Insertar') Inserta($link);
if($_GET['Accion']=='Eliminar') Elimina($link);
if($_GET['Accion']=='Consultar') Consulta($link);
if($_GET['Accion']=='Actualizar') Actualiza($link);
?>