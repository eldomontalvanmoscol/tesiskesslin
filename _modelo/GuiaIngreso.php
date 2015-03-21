<?php
include '../Conexion/Cx.php';
function Ingresar(){
    $usuario=$_REQUEST['Usuario'];
    $usuario=$_REQUEST['Contra'];
    
}
switch($_REQUEST['Accion']){
    case 'Ingresar':
        Ingresar();
        break;
    
}