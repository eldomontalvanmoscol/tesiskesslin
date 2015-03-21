<?php
include '../Conexion/Cx.php';

### MODELO LISTA 
function Listar(){
    global $link ;
    $cons = $link->query("CALL GetUsuario('$usuario','$pass',$Tipo_Usuario)");
    $resp=mysqli_query($link,$cons);
    $row=$resp->fetch_object();
    return $row;
}

## MODELO VER 
function Ver(){
    
    
}
## MODELO CREA 
function Crear(){
    
    
}

## MODELO ELIMINA
function Eliminar(){
	
    
}


switch($_REQUEST['Accion']){
    case "Listar":
	Listar();
	break;
    
case "Crear":
	Crear();
	break;

case "Eliminar":
	Eliminar();
	break;
case "Ver":
	Ver();
	break;
    
}