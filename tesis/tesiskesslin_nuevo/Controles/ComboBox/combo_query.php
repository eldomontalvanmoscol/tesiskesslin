<?php
session_start();

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){ ob_start('ob_gzhandler'); }else{ ob_start(); }

set_time_limit(0);  //tiempo de ejecucion infinito
ini_set('memory_limit','60M');  //limite de memoria era 60
$Que=stripslashes($_GET['q']);

include('../../Cx.php');
$link = Conectarse();
$c_1 = $_GET['c_1'];
$c_2 = $_GET['c_2'];
$q = $Que;
$rs = mysqli_query($link, $q);
$d = '';

echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
	$d = utf8_encode($c_1)."\":\"".utf8_encode($rw[$c_1])."\",\"".utf8_encode($c_2)."\":\"".utf8_encode($rw[$c_2]);
    $a[] = "{\"".$d."\"}";
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';


?>