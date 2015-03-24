<?php
session_start();
include('Upload.php');
Upload($db,$_GET['Nom'],$_GET['IdMod'],$_GET['IdDocum'],$Accion,$_GET['TipoDoc']);

?>