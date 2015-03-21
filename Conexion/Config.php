<?php
session_start();


//PARAMETROS DE CONEXION


$servidor		="localhost:8080";	
$usuario_db		="root";
$password_db	="";
$bd		="tesiskeslin";

$link = mysqli_connect($servidor,$usuario_db,$password_db,$bd);
if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>