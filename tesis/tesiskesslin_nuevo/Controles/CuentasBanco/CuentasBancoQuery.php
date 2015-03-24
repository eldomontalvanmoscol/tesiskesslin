<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();

function Inserta($link){
//SINCRONIZACIÓN
include("../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdx.php");
//END
	$add = 'INSERT INTO cuentas_bancarias (
	IdMiEmpresa,
	IdMiSede,
	IdMod,
	IdDoc,
	CuentaNro,
	CuentaTipo,
	CuentaMoneda,
	CuentaBanco,
	FCrea,
	IdUserCrea
	) VALUES (
	'.$IdMiEmpresax.',
	'.$IdMiSedex.',
	'.$_POST['IdMod'].',
	'.$_POST['IdDoc'].',
	"'.$_POST['NumCtaCB'].'",
	"'.$_POST['TipoCtaCB'].'",
	"'.$_POST['MonedaBankCB'].'",
	"'.$_POST['BancoCB'].'",
	NOW(),
	"'.$_SESSION['IdUsuario'] .'"
	)';
	mysqli_query($link,$add);
}

function Elimina($link){
	$del = 'DELETE FROM cuentas_bancarias WHERE IdCuentas='.$_GET['IdCuentas'];
	mysqli_query($link,$del);
}

if($_GET['Accion']=='Insertar') Inserta($link);
if($_GET['Accion']=='Eliminar') Elimina($link);
?>