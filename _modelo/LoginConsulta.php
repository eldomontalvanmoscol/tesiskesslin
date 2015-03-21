<?php
include '../Conexion/Cx.php';
$link=  Conectarse();
function Ingresar(){
    $usuario=$_REQUEST['Usuario'];
    $pass=$_REQUEST['Contra'];
    $url="index.php";
    $r = $link->query("CALL GetUsuario('$usuario','$pass',$Tipo_Usuario)");
    $cont=  mysqli_num_rows($r);
    if($cont==0){
        echo $index;
        
    }elseif($cont>0){
        echo $url;
    }
    
}
switch($_REQUEST['Accion']){
    case 'Ingresar':
        Ingresar();
        break;
    
}