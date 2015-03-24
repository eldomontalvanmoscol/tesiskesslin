<?php
session_start();

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){ ob_start('ob_gzhandler'); }else{ ob_start(); }

set_time_limit(0);  //tiempo de ejecucion infinito
ini_set('memory_limit','60M');  //limite de memoria era 60

include('../../Cx.php');
$link = Conectarse();
$c_1 = explode(',',$_GET['c_1']);
//$c_2 = $_GET['c_2'];
$q = $_GET['q'];
$rs = mysqli_query($link, $q);
$longitud = count($c_1);
$d = '';

echo '[';
$a=array();
while($rw = $rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
	
	for($i=0;$i<$longitud;$i++){
      
	  $str=utf8_encode($rw[$c_1[$i]]);
	  
      if($i!=$longitud-1){
        $d=$d.$c_1[$i]."\":\"".$str."\",\"";
      }else{
        $d=$d.$c_1[$i]."\":\"".$str; //Almacena ultimo elemento del array
      }
    }
	
    $a[] = "{\"".$d."\"}";
	$d = '';
}

mysqli_free_result($rs);
echo implode(',', $a);
echo ']';


?>