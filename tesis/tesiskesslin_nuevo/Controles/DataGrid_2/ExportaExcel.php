<?php
session_start();
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
	ob_start("ob_gzhandler");
}else{
	ob_start();
}

set_time_limit(0);	//tiempo de ejecucion infinito
ini_set("memory_limit","60M");	//limite de memoria

include ('../../Cx.php');
$link=Conectarse();



if($_GET['Tipo']==1){	//EXCEL O HTML
	header("Pragma: no-cache");
	header("Expires: 0");
	header("Content-Transfer-Encoding: binary");
	header("Content-type: application/force-download");
	$filename = "Fichero.xls";	//nombre del archivo
	header("Content-Disposition: attachment; filename=$filename"); 
}

function array_recibe($url_array) {
		$tmp = stripslashes($url_array);
		$tmp = urldecode($tmp);
		$tmp = unserialize($tmp);
	   return $tmp;
}

$QueryConc=array_recibe($_GET['Query']);
$Result= mysqli_query($link,$QueryConc);

$Columnas=array_recibe($_GET['Columnas']);


?>
<title>Skynet ERP - <?php echo $_GET['Titulo'];?></title>
<?php 
if($_GET['Tipo']!=1){
	echo "<link href='estilo.css' rel='stylesheet' type='text/css' />";
}
?>
<div style="padding:10px;">
<?php
#CAJA DEL DATA GRID		
	echo "<h2>".$_GET['Titulo']."</h2>";
	echo "<b>Razón social:</b> ".$_SESSION['ConfG_RUC'].'-'.$_SESSION['NomMiEmpresa'];
	echo "<br><b>Sede:</b> ".$_SESSION['IdMiSede'].'-'.$_SESSION['NomMiSede'];
	echo "<br><b>Almacén:</b> ".$_SESSION['IdAlmacen'].'-'.$_SESSION['NombreAlmacen'];
	echo "<br><b>Usuario:</b> ".$_SESSION['NombreUsuario'];
	echo "<br><b>Fecha del reporte:</b> ".date('d-m-Y');
	echo "<br><b>Power By:</b> © Skynet ERP v. ".$_SESSION['Version']." - www.skyneterp.com";
	echo "<br><br><table cellpadding=\"1\" cellspacing=\"1\" width=\"100%\"><tr>";	
    echo "<th width=\"2%\" bgcolor=\"#999999\">*</th>";
	#CABECERA
    foreach($Columnas as $Nombre=>$Valor){	//Pintamos el nombre de las cabeceras
		$CamTabla=$Columnas[$Nombre]['CampoTabla'];
		
		if($_POST['NomOrden']==$CamTabla){//Condicionamos para que pinte la flecha de ordenamiento
            if($_POST['IdOrden']=="DESC"){
				$FlechaG="<font size=\"5\">&#711;</font>";
			}else{
				$FlechaG="<font size=\"5\">&#710;</font>";
			}
        }else{
			$FlechaG="";
		}	
		
		echo "<th width=\"3%\" style=\"cursor:pointer;\" bgcolor=\"#999999\" align=\"center\">$Nombre $FlechaG</th>";
    } 
	
	#CUERPO
	$a=0;  
	while($row_grid = $Result->fetch_object()) {
		$a++;
   		echo "<tr>";
		echo "<th width=\"5\" valign=\"top\">$a</th>";
		foreach($Columnas as $Nombre=>$Valor){	//Array de las variables de configuracion del grid			
            $CampoT	=	$Columnas[$Nombre]['CampoTabla'];
            $Alinea	=	$Columnas[$Nombre]['Alineamiento'];
            $Anch	=	$Columnas[$Nombre]['Ancho'];
            $TipoC	=	$Columnas[$Nombre]['TipoCampo'];
			$Funcion=	$Columnas[$Nombre]['Function'];		
			//Separamos el alias del nombre de los campos para pintar. El alias solo es util para busquedas.
			$CampoSinAli=strstr($CampoT,'.'); //extraemos el nombre del campo del alias
			if($CampoSinAli==''){
				$CampoSinAlias=$CampoT;
			}else{
				$CampoSinAlias=substr($CampoSinAli,1,60);	//eliminamos el punto
			}
		
		$TipoCG=stripslashes($row_grid->$CampoSinAlias)."&nbsp;";
		//pintamos el contenido de los registros
            echo "<td width=\"".$Anch."\" valign=\"top\" align=\"".$Alinea."\">";
			echo utf8_encode($TipoCG);		
			echo "</td>";
		}	
		echo "</tr>";	
   	} 
      echo "</tr>";
	  echo "</tabla>";
	
mysqli_close($link);	
?>
</div>