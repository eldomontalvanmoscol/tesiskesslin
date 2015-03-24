<?php
session_start();
include('../../Cx.php');
$link=Conectarse();	//mysql

include('../../Controles/Arbol_2/Arbol.php'); 
include('../../Controles/Arbol_2/ArbolDiv.php'); 	
include('../../Componentes/Multiempresa/Sincronizar/TreeIdMiEmpresa.php'); 

$IdArbolx = $_POST['IdArbol'];
$IdMiEmpresax = TreeIdMiEmpresa($IdArbolx);


$SqlArb="SELECT * FROM ".$_POST['Tabla']." WHERE IdArbol=".$_POST['IdArbol']." AND Estado = 1 AND IdMiEmpresa = ".$IdMiEmpresax;
//echo $SqlArb;
//$SqlArb="SELECT * FROM ".$_POST['Tabla']." WHERE IdArbol=".$_POST['IdArbol']." AND Estado=1 AND IdMiEmpresa = ".$_SESSION['IdMiEmpresa'];
//$SqlArb="SELECT * FROM ".$_POST['Tabla']." WHERE IdArbol= 1 AND Estado=1";
$Arbol = new Tree();	//db, Nombre, Sql, CampoPadre, CampoHijo, Funcion 
$Arbol->VerArbol($link,$_POST['Descrip'],$SqlArb,'IdNodo','Niveles','FuncArbol'.$_POST['NomCamp'],$_POST['NomArbol'],$_POST['AccionNodo'],$_POST['MoslR']);
?>
