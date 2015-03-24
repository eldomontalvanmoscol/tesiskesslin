<?php
session_start();
include('../../Cx.php');
$link=Conectarse();
include('AnularDatosTabla.php');
include('../CtasCobrarPagar/OrigenNotas.php');


$DatosTabla	=BuscarDatosTabla($_POST['TipoDoc']);
$IdDoc		= $DatosTabla[0];
$NameTablaC = $DatosTabla[1];
$TipoCuenta	= $DatosTabla[6];

Anular($link, $_POST['Id'], $_POST['TipoDoc'],$NameTablaC,$IdDoc);
AnularCuentasCP($link,$TipoCuenta,$_POST['Id'],$_POST['TipoDoc']);

//ANULAR DOCUMENTO ->ACTUALIZA EL ESTADO A ANULADO
function Anular($link, $Id, $TipoDoc, $NomTabla, $IdTabla){
	$sql="UPDATE ".$NomTabla." SET EstadoDoc ='Anulado' WHERE ".$IdTabla." = ".$Id." AND TipoDoc= ".$TipoDoc." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa']."";
	$resultados = mysqli_query($link,$sql);
}
//ANULAR ASIENTO CONTABLE ->ACTUALIZA EL ESTADO A ANULADO
?>