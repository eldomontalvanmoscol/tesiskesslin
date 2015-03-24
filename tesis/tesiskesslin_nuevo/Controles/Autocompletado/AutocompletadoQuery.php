<?php
session_start();
include ('../../Cx.php'); //Conexion Mysql
$link=Conectarse();     //mysql
function Busca($link){

//SINCRONIZACIÓN
include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesId.php');
//END	

  $aCamp=explode('**',$_GET['Campo']); //array de Campos
  $Col=explode(',',$_GET['Columna']);
  //$Sql='SELECT '.$aCamp[0].','.$aCamp[1].','.$aCamp[2].' FROM '.$aCamp[3].' WHERE '.$aCamp[4].' '.$_GET['CampBusq'].' LIKE  \'%'.$_GET['Palabra'].'%\' ORDER BY '.$aCamp[0].' ASC LIMIT 10';
 
	//$Sql='SELECT '.$aCamp[0].','.$aCamp[1].','.$aCamp[2].' FROM '.$aCamp[3].' WHERE '.$_GET['CampBusq'].' LIKE  \'%'.$_GET['Palabra'].'%\' ORDER BY '.$aCamp[0].' ASC LIMIT 10';
	
 //$Sql='SELECT '.$aCamp[0].','.$aCamp[1].','.$aCamp[2].' FROM '.$aCamp[3].' WHERE '.$_GET['CampBusq'].' LIKE  \'%'.$_GET['Palabra'].'%\' AND IdMiEmpresa = '.$IdMiEmpresa.' ORDER BY '.$aCamp[0].' ASC LIMIT 10';
 
 $IdMiEmpresa = ($IdMiEmpresa == "") ? 1 : $IdMiEmpresa;
 $Sql='SELECT '.$aCamp[0].','.$aCamp[1].','.$aCamp[2].' FROM '.$aCamp[3].' WHERE '.$aCamp[4].' '.$_GET['CampBusq'].' LIKE  \'%'.$_GET['Palabra'].'%\' AND IdMiEmpresa = '.$IdMiEmpresa.' ORDER BY '.$aCamp[0].' ASC LIMIT 10';
	
  $rs=mysqli_query($link,$Sql);
  echo '[';
  $a = array();
  
  while($rw=$rs->fetch_array(MYSQLI_NUM)){
    $a[]="{\"".$Col[0]."\": \"".utf8_encode($rw[0])."\", \"".$Col[1]."\": \"".utf8_encode($rw[1])."\", \"".$Col[2]."\": \"".utf8_encode($rw[2])."\"}";
  }
  echo implode(', ', $a);
  echo ']';
}
Busca($link);

//IdMiEmpresa='.$_SESSION['IdMiEmpresa']
?>