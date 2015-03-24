<?php
//SELECT IdNodo FROM `arbol` WHERE IdMiEmpresa=1 AND Niveles LIKE '2.%' AND IdArbol=1 AND Estado=1
session_start();
function CapturaID($IdArbol,$Nivel){
include('../../conexion.php');
	$consulta = $db->prepare("SELECT * FROM arbol WHERE IdArbol='".$IdArbol."' AND IdMiEmpresa='".$_SESSION['IdMiEmpresa']."' AND Estado=1 AND Niveles LIKE '1.1'.'%'");
	$consulta->execute();
	return $consulta->fetchAll();
}

//echo CapturaID(1,'2.');

$VerAr=CapturaID(1,$_POST['NivelAr']);
foreach($VerAr as $item){
	echo $item['IdNodo']."\n";
}	
	
//echo $_POST['IdArbol']."<br>";
echo $_POST['NivelAr']."<br>";
?>