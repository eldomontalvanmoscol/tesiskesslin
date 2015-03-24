<?php
//OBTIENE EL ULTIMO ID DE UNA TABLA
//EXISTE OTRO ULTIMOID.PHP EN LA CARPETA MODELO, SIN EMBARGO ESTE ARCHIVO ES EL MAS ACTUALIZADO BASADO EN MYSQLI
function CampoTabla($link,$IdNom,$TablaNom){		
	//obtenemos el ultimo id
	$consulta = "SELECT ".$IdNom." FROM ".$TablaNom." ORDER BY ".$IdNom." DESC LIMIT 1";
	//$consulta = "SELECT MAX(".$IdNom.")as ".$IdNom." FROM ".$TablaNom;
	//$consulta = "SELECT TOP ".$IdNom." as ".$IdNom." FROM ".$TablaNom." ORDER BY ".$IdNom." DESC LIMIT 1";
	$resultas = mysqli_query($link,$consulta);
	 
	$fila = $resultas->fetch_object();	
	$fil=$fila->$IdNom+1;
	
	//reseteamos porciaca el incrementable
	$resetea = "ALTER TABLE ".$TablaNom." AUTO_INCREMENT =".$fil."";
	$reset = mysqli_query($link,$resetea);
	
	return $fila->$IdNom;	
	return 0;	
	
}
?>
