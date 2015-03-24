<?php
session_start();

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){ ob_start('ob_gzhandler'); }else{ ob_start(); }

set_time_limit(0);  //tiempo de ejecucion infinito
ini_set('memory_limit','60M');  //limite de memoria era 60

include('../../Cx.php');
$link=Conectarse();   

$_GET['Query']=str_replace("\'","'",$_GET['Query']);

function Regs($link){
  if($_GET['Texto']==''){
    $c=$_GET['Query'];
  }else{
    $sCad='WHERE';
    if(strpos($_GET['Query'],$sCad) || strpos($_GET['Query'],strtolower($sCad))){
      $c=$_GET['Query']." AND ".$_GET['Campo']." LIKE '%".$_GET['Texto']."%'";
    }else{
      $c=$_GET['Query']." WHERE ".$_GET['Campo']." LIKE '%".$_GET['Texto']."%'";
    }
  }
  $rs=mysqli_query($link,$c);
  $rw=$rs->num_rows;
  unset($c);
  mysqli_free_result($rs);
  echo "jQuery('#TReg".$_GET['Nombre']."').val('".$rw."')";
}

function Consulta($link){
  if($_GET['Texto']==''){
    $c=$_GET['Query'].' ORDER BY '.$_GET['Ord'].' '.$_GET['ordCamp'].' LIMIT '.$_GET['PagI'].','.$_GET['Pg'];
  }else{
    $sCad='WHERE';
    if(strpos($_GET['Query'],$sCad) || strpos($_GET['Query'],strtolower($sCad))){
      $c=$_GET['Query']." AND ".$_GET['Campo']." LIKE '%".$_GET['Texto']."%' ORDER BY ".$_GET['Ord']." ".$_GET['ordCamp']." LIMIT ".$_GET['PagI'].",".$_GET['Pg'];
    }else{
      $c=$_GET['Query']." WHERE ".$_GET['Campo']." LIKE '%".$_GET['Texto']."%' ORDER BY ".$_GET['Ord']." ".$_GET['ordCamp']." LIMIT ".$_GET['PagI'].",".$_GET['Pg'];
    }
  }
  $rs=mysqli_query($link,$c);
  $aAlias=explode(',',$_GET['Alias']);
  $d='';
  echo '[';
  $arr=array();
  $cant=count($aAlias);
  while($rw=$rs->fetch_array(MYSQLI_ASSOC)){ //Arma array en JSON
    for($i=0;$i<$cant;$i++){
	  $str=preg_replace("/\s+/"," ",str_replace("\'","'", addslashes(trim(utf8_encode($rw[$aAlias[$i]])))));
     if($i!=$cant-1){
        $d=$d.$aAlias[$i]."\":\"".$str."\",\"";
      }else{
        $d=$d.$aAlias[$i]."\":\"".$str; //Almacena ultimo elemento del array
      }
    }
    $arr[]="{\"".$d."\"}";
    $d='';
  }
  unset($aAlias);
  unset($c);
  unset($d);
  mysqli_free_result($rs);
  echo implode(',', $arr);
  echo ']';
}

if($_GET['accion']=='datos'){
  Consulta($link);  //Extrae los Datos
}else if($_GET['accion']=='Reg'){
  Regs($link);  //Obtiene la Cantidad de Registros
}

mysqli_close($link); //Cerramos la conexion
?>  