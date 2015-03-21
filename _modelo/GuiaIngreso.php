<?php
include '../Conexion/Cx.php';

### MODELO LISTA 
function Listar(){
    
    
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