<?php
//session_start();

function IdArbol($link,$IdMod){
	//$sql = "SELECT IdArbol,IdMiEmpresa,IdMod FROM tree_cab WHERE IdMiEmpresa= '$IdMiEmpresa' and IdMod=".$IdMod;  
	//$sql = "SELECT IdArbol,IdMiEmpresa, IdMod FROM tree_cab WHERE IdMiEmpresa =".$_SESSION['IdMiEmpresa']." AND IdMod=".$IdMod;  
	$sql = "SELECT IdArbol,IdMiEmpresa, IdMod FROM tree_cab WHERE IdMiEmpresa = 1 AND IdMod=".$IdMod;  
	//echo $sql;
	$consulta= mysqli_query($link,$sql);
	$row = $consulta->fetch_object();
	$IdArbol=$row->IdArbol;  
	return $IdArbol;
}




?>
