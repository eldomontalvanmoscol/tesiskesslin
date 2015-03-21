<?php
session_start(); 

header("Cache-Control: no-store, no-cache, must-revalidate");
include ('cx.php');

$TituloM	=	"Guia de Ingreso";	//Título del módulo. Ventana del modulo y las ventanas emergentes.
$FileNameM	=	"GuiaIngreso";		//Nombre del archivo modelo(sin .php). Sin espacios, tílde o símbolos.

### CONTROLADOR LISTA 
function Listar(){
    
    
}
## CONTROLADOR VER 
function Ver(){
    
    
}
## CONTROLADOR CREA 
function Crear(){
    
    
}

## CONTROLADOR ELIMINA
function Eliminar(){
	
    
}






##    BUCLE QUE DECIDE QUE FUNCION EJECUTARSE  
switch($_GET['Accion']){
    
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
?>
