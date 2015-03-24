<?php
session_start();
include('Upload.php');

$IdMod=$_POST['IdMod'];
$IdDoc=$_POST['IdDocumento'];
$TipoDoc=$_POST['TipoDoc'];
	Upload($link,'Ficheros',$IdMod,$IdDoc,'E',$TipoDoc);
?>

