<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
	ob_start("ob_gzhandler");
}else{
	ob_start();
}

set_time_limit(0);	//tiempo de ejecucion infinito
ini_set("memory_limit","60M");	//limite de memoria

include ('../../Cx.php');
$link=Conectarse();

	#RECUPERAMOS EL ARRAY DE LAS COLUMNAS A PINTAR
	function array_recibe($url_array) {
		$tmp = stripslashes($url_array);
		$tmp = urldecode($tmp);
		$tmp = unserialize($tmp);
	   return $tmp;
	}
	
	
	//echo $_POST['Query']."<br>";
	$Columnas=array_recibe($_POST['Columnas']);
	$sql_query=array_recibe($_POST['Query']);	
	//echo $sql_query;

	#CONCATENACION DEL QUERY, DE ACUERDO A LAS OPCIONES DE BUSCQUEDA
	if($_POST['SearchCampo']==''){	//si no existe una busqueda, pintamos el query como esta
		$QueryConc=$sql_query;
	}else{	//Caso contrario, comprobamos si existe una cadena WHERE en el query
	$Where=stristr($sql_query,'WHERE');	//buscamos si existe un where sin distincion de mayuscula/miniscula
		if($Where==''){
			$QueryConc=$sql_query." WHERE ".$_POST['SearchCampo']." LIKE '%".$_POST['SearchPalabra']."%'";
		}else{
			 $QueryConc=$sql_query." AND ".$_POST['SearchCampo']." LIKE '%".$_POST['SearchPalabra']."%'";
		}
	}	

	#CALCULAMOS EL TOTAL DE REGISTROS
	$CountReg = $link->Query($QueryConc);
	$TRegistros=$CountReg->num_rows;	//contamos registros

	#CONSULTA SQL
	$QueryFinal="".$QueryConc." ORDER BY ".$_POST['NomOrden']." ".$_POST['IdOrden']." LIMIT ".$_POST['InicioPag'].",".$_POST['Registros']."";
	$QueryFinalR="".$QueryConc." ORDER BY ".$_POST['NomOrden']." ".$_POST['IdOrden']."";	//Para reporte
	$QueryFinalR2= urlencode(serialize($QueryFinalR));	
	
	$Result= mysqli_query($link,$QueryFinal);
	#TOTAL DE PAGINAS
	$TotalPag=ceil($TRegistros/$_POST['Registros']);	
	#CAJA DEL DATA GRID
	echo "<div id=\"QueryDev".$_POST['Name']."\" style=\"padding:10px; border:solid 1px #999; background-color: #FFF; display:none;\">".$QueryConc."</div>";
	echo "<table cellpadding=\"1\" cellspacing=\"1\" width=\"100%\"><tr>";	
    echo "<th width=\"2%\" class=\"out\">*</th>";
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
		
		echo "<td width=\"3%\" class=\"out\"  style=\"cursor:pointer;\" align=\"center\" onclick=\"Ordenamiento();\">$Nombre $FlechaG</td>";
    } 
	
	#CUERPO
	$a=0;  
	while($row_grid = $Result->fetch_object()) {
		$a++;
   		echo "<tr class=\"Grid\">";
		echo "<th class=\"out\" width=\"5\" valign=\"top\">$a</th>";
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
			//extraemos el nombre de la funcion externa del datagrid
				$ExtraeNom1=strpos($Funcion,"(");
				$FuncionG=substr($Funcion,0,$ExtraeNom1);
			//si la funcion fue definida procedemos
			if($Funcion==NULL){
				$FuncionG=$CampoT;
				$FuncionFinal="$FuncionG('".$row_grid->$CampoT."')";
			}else{
				//En caso se haya definido los campos, extraemos los valores dentro de () de la funcion
				$ExtraValor1=substr($Funcion,$ExtraeNom1+1,-1);
				$ExpVal=explode(",",$ExtraValor1); //aqui tenemos el nombre de los campos.
				//obtenemos los valores de la funcion. Soporta hasta 15 valores
				if(isset($row_grid->$ExpVal[0])) $ValFun1=addslashes(htmlentities($row_grid->$ExpVal[0]));
				if(isset($row_grid->$ExpVal[1])) $ValFun2=addslashes(htmlentities($row_grid->$ExpVal[1]));
				if(isset($row_grid->$ExpVal[2])) $ValFun3=addslashes(htmlentities($row_grid->$ExpVal[2]));
				if(isset($row_grid->$ExpVal[3])) $ValFun4=addslashes(htmlentities($row_grid->$ExpVal[3]));
				if(isset($row_grid->$ExpVal[4])) $ValFun5=addslashes(htmlentities($row_grid->$ExpVal[4]));
				if(isset($row_grid->$ExpVal[5])) $ValFun6=addslashes(htmlentities($row_grid->$ExpVal[5]));
				if(isset($row_grid->$ExpVal[6])) $ValFun7=addslashes(htmlentities($row_grid->$ExpVal[6]));
				if(isset($row_grid->$ExpVal[7])) $ValFun8=addslashes(htmlentities($row_grid->$ExpVal[7]));
				if(isset($row_grid->$ExpVal[8])) $ValFun9=addslashes(htmlentities($row_grid->$ExpVal[8]));
				if(isset($row_grid->$ExpVal[9])) $ValFun10=addslashes(htmlentities($row_grid->$ExpVal[9]));
				if(isset($row_grid->$ExpVal[10])) $ValFun11=addslashes(htmlentities($row_grid->$ExpVal[10]));
				if(isset($row_grid->$ExpVal[11])) $ValFun12=addslashes(htmlentities($row_grid->$ExpVal[11]));
				if(isset($row_grid->$ExpVal[12])) $ValFun13=addslashes(htmlentities($row_grid->$ExpVal[12]));
				if(isset($row_grid->$ExpVal[13])) $ValFun14=addslashes(htmlentities($row_grid->$ExpVal[13]));
				if(isset($row_grid->$ExpVal[14])) $ValFun15=addslashes(htmlentities($row_grid->$ExpVal[14]));
				if(isset($row_grid->$ExpVal[15])) $ValFun16=addslashes(htmlentities($row_grid->$ExpVal[15]));
				if(isset($row_grid->$ExpVal[16])) $ValFun17=addslashes(htmlentities($row_grid->$ExpVal[16]));
				if(isset($row_grid->$ExpVal[17])) $ValFun18=addslashes(htmlentities($row_grid->$ExpVal[17]));
				if(isset($row_grid->$ExpVal[18])) $ValFun19=addslashes(htmlentities($row_grid->$ExpVal[18]));
				if(isset($row_grid->$ExpVal[19])) $ValFun20=addslashes(htmlentities($row_grid->$ExpVal[19]));
				if(isset($row_grid->$ExpVal[20])) $ValFun21=addslashes(htmlentities($row_grid->$ExpVal[20]));
				if(isset($row_grid->$ExpVal[21])) $ValFun22=addslashes(htmlentities($row_grid->$ExpVal[21]));
				if(isset($row_grid->$ExpVal[22])) $ValFun23=addslashes(htmlentities($row_grid->$ExpVal[22]));
				if(isset($row_grid->$ExpVal[23])) $ValFun24=addslashes(htmlentities($row_grid->$ExpVal[23]));
				if(isset($row_grid->$ExpVal[24])) $ValFun25=addslashes(htmlentities($row_grid->$ExpVal[24]));
//pintamos los valores para armar la funcion
$FuncionFinal="$FuncionG('$ValFun1','$ValFun2','$ValFun3','$ValFun4','$ValFun5','$ValFun6','$ValFun7','$ValFun8','$ValFun9','$ValFun10','$ValFun11','$ValFun12','$ValFun13','$ValFun14','$ValFun15','$ValFun16','$ValFun17','$ValFun18','$ValFun19','$ValFun20','$ValFun21','$ValFun22','$ValFun23','$ValFun24','$ValFun25')";				
				}
	#SWTICH QUE CREA EL TIPO DE CAMPO A PINTAR
	 switch($TipoC){	//0:TextoNormal, 1:Check, 2:Text, 3:Combo, 4:Options, 5:Boton, 6:Ver.., 7:Link, 8:codicionales
		case 1:	
		$TipoCG="<input name=\"Check_".$a."\" id=\"Check_".$a."\" type=\"checkbox\" value=\"$CampoSinAlias\"  onclick=\"$FuncionFinal\"/>";
		break;
		case 2:
		$TipoCG="<input name=\"Text_".$a."\" id=\"Text_".$a."\" type=\"text\" class=\"itext\" value=\"".stripslashes($row_grid->$CampoSinAlias)."\" onchange=\"$FuncionFinal\"/>";
		break;
		case 4:
		$TipoCG="<input name=\"$CampoSinAlias\" id=\"$CampoSinAlias\" onclick=\"$FuncionFinal\" type=\"radio\" value=\"$CampoSinAlias\" />";
		break;
		case 5:
		$TipoCG="<input name=\"Boton_".$a."\" id=\"Boton_".$a."\" type=\"button\" style=\"width:100%\" value=\"".$row_grid->$CampoSinAlias."\"  onclick=\"$FuncionFinal\"/>";
		break;
		case 6:
		$TipoCG="<input name=\"Boton_".$a."\" id=\"Boton_".$a."\" type=\"button\" style=\"width:100%\"  class=\"BotonT\" value=\"Ver..\" onclick=\"$FuncionFinal\"/>";
		break;
		case 7:
		$TipoCG="<a href=\"#\" onclick=\"$FuncionFinal\" />".$row_grid->$CampoSinAlias."</a>";
		break;
		case 8:
		$TipoCG="$CampoSinAlias";
		break;
		default:
		$TipoCG=stripslashes($row_grid->$CampoSinAlias);
		break;		
	}
	
//pintamos el contenido de los registros
            echo "<td width=\"".$Anch."\" class=\"LineaGrid\" onclick=\"PintarCelda('".$row_grid->$CampoSinAlias."');\" valign=\"top\" align=\"".$Alinea."\">";
			echo utf8_encode($TipoCG);		
			echo "</td>";
		}	
		echo "</tr>";	
   	} 
      echo "</tr>";
	  echo "</tabla>";
	 

mysqli_close($link);

?> 
<input name="QueryBus" id="QueryBus" type="hidden" value="<?php echo $QueryFinalR2;?>" />

<script type="text/javascript">
$('TRegistros<?php echo $_POST['Name'];?>').value='<?php echo $TRegistros;?>';	//pinta el campo de total de registros del navegador
$('TPaginas<?php echo $_POST['Name'];?>').value='<?php echo $TotalPag;?>';	//pinta el total de paginas del grid
</script>