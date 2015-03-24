<?php
session_start(); 

function ObtenerCR($link,$IdCorrelativo){
	//OBTIERNE CORRELATIVO REAL
	$sqlCorrelativo = "SELECT Serie, Correlativo, IdCorrelativo
	FROM correlativos_doc 
	WHERE IdCorrelativo=".$IdCorrelativo." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa']." AND IdMiSede=".$_SESSION['IdMiSede']."";
	$resultados = mysqli_query($link,$sqlCorrelativo);
	$row=$resultados->fetch_object();	
	$CR=array($row->Serie,$row->Correlativo+1);
	
	//ACTUALIZA
	$sqla = "UPDATE correlativos_doc SET Correlativo='".$CR[1]."' WHERE IdCorrelativo= ".$row->IdCorrelativo."";
	$resultadosa = mysqli_query($link,$sqla);

	return $CR;
}
	
?>
