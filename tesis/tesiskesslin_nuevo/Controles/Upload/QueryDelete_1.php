<?php
session_start();
include("../../Cx.php");	//Clase de conexion mysqli
$link=Conectarse();

//eliminamos la tabla
 $elimina = "DELETE FROM ficheros WHERE IdFiles=".$_GET['Id']."";
$resultados = mysqli_query($link,$elimina);

//eliminamos el fichero
$DirFicheros="../../Preferencias/".$_SESSION['IdMiEmpresa']."/Archivos/";
unlink($DirFicheros.$_GET['NomSis']);
header("Location: Iframe.php");
?>