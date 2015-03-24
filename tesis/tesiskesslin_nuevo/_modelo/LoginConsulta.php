<?php
include '../Conexion/Cx.php';
$link=  Conectarse();
$vs_var1 = isset($_REQUEST['vs_var1']) ? $_REQUEST['vs_var1'] : null;
$vs_var2 = isset($_REQUEST['vs_var2']) ? $_REQUEST['vs_var2'] : null;
   function Ingresar($link,$vs_var1,$vs_var2){
    $usuario=$vs_var1;
    $pass=$vs_var2;
    $Tipo_Usuario=1;
    $url="inicio.php";
    //$r=$link->query("SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND pass='$pass' AND tipo_usuario=$Tipo_Usuario");
    $r = $link->query("CALL LoginUsuario('$usuario','$pass',$Tipo_Usuario)");
    $cont=  mysqli_num_rows($r);
    if($cont==0){
        
    }elseif($cont>0){
        echo '1_|_';
        $_SESSION['LoginEmail']=$usuario;
        $_SESSION['pass']=$pass;
        $_SESSION['tipo_usuario']=$Tipo_Usuario;
        
        echo $_SESSION['LoginEmail'];
    }
   }
  
SWITCH($_REQUEST['Accion']){
	case 'Ingresar':
		Ingresar($link,$vs_var1,$vs_var2);
		break;
	
}
    
    
    

