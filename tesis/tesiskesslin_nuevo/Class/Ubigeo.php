<?php
session_start();
	
function ubigeoTextoCliente($link,$IdCliente,$ruc){
	if($IdCliente!=""){
		 $orden="SELECT Ubigeo FROM empre_cliente WHERE IdCliente = '".$IdCliente."'";
	}else {
		$orden="SELECT Ubigeo FROM empre_cliente WHERE Ruc = '".$ruc."'";
	}
	
	$resultUbigeo= mysqli_query($link,$orden);   
	$row = $resultUbigeo->fetch_object();
  
	$NameUbi=getLugar($link, $row->Ubigeo);	//150101
	return $NameUbi;
}

function ubigeoTextoProveedor($link,$IdProveedor,$ruc){
	if($IdProveedor!=""){
		$orden="SELECT Ubigeo FROM empre_proveedor WHERE IdProveedor = '".$IdProveedor."'";
	}else{
		$orden="SELECT Ubigeo FROM empre_proveedor WHERE Ruc = '".$ruc."'";
		}
	
	$resultUbigeo= mysqli_query($link,$orden);   
	$row = $resultUbigeo->fetch_object();
  
	$NameUbi=getLugar($link, $row->Ubigeo);	//150101
	return $NameUbi;
}

function getLugar($link,$ubigeo){	
	$chars = strlen($ubigeo);
	if($chars==6){
		$departamento = substr($ubigeo,0,2); //elemento 0 al elemento 1, o sea las 2 primeras letras
		$provincia = substr($ubigeo,2,2); //texto,pos,numesp
		$distrito = substr($ubigeo,4,2);

		$SQL1 = "SELECT Nombre FROM ubigeo WHERE CodDpto='".$departamento."' AND CodProv='".$provincia."' AND CodDist='".$distrito."'";
		$resultDist= mysqli_query($link,$SQL1);   
		$row1 = $resultDist->fetch_object();
		$nomDist=utf8_encode($row1 ->Nombre);
	
		$SQL2 = "SELECT Nombre FROM ubigeo WHERE CodDpto='".$departamento."' AND CodProv='".$provincia."' AND CodDist='00'";
		$resultProv= mysqli_query($link,$SQL2);   
		$row2 = $resultProv->fetch_object();
		$nomProv=utf8_encode($row2 ->Nombre);
	
		$SQL3 = "SELECT Nombre FROM ubigeo WHERE CodDpto='".$departamento."' AND CodProv='00' AND CodDist='00'";
		$resultDpto= mysqli_query($link,$SQL3);   
		$row3 = $resultDpto->fetch_object();
		$nomDpto=utf8_encode($row3 ->Nombre);
	
		$lugar=$nomDpto." - ".$nomProv." - ".$nomDist;
	}
	else{
		$lugar="";	
	}
	
	return $lugar; 
}

?>