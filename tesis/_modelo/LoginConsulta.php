<?php
include '../Conexion/Cx.php';
$link=  Conectarse();
Class Login{
    
    
    function Ingresar($usuario,$pass){
    $usuario=$_REQUEST['Usuario'];
    $pass=$_REQUEST['Contra'];
    $Tipo_Usuario=1;
    $url="index.php";
    //$r=$link->query("SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND pass='$pass' AND tipo_usuario=$Tipo_Usuario");
    $r = $link->query("CALL GetUsuario('$usuario','$pass',$Tipo_Usuario)");
    $cont=  mysqli_num_rows($r);
    if($cont==0){
        echo $index;
        
    }elseif($cont>0){
        echo $url;
    }
    
}
    
    
    
}
