<?php
$DireccA="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/Arbol/";	//ruta para el ajax
$Existe=1;	//sirve para no incluir dos o mas veces esta clase

class Tree{
	function QueryArbol($db,$Query){	//query del arbol
		$consulta = $db->prepare($Query);
		$consulta->execute();
		return $consulta->fetchAll();
	}
	
	function VerArbol($db,$QueryA,$FuncionA){	//metodo que pinta el arbol
		$this->QueryA=$QueryA;
		$this->FunctionA=$FuncionA;

		$DirA="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/Arbol/";
		$DirArbol=$DirA."images/";	
		//extraemos el nombre de la funcion definida
		$ExtraeNom1=strpos($this->FunctionA,"(");
		$FuncionG=substr($this->FunctionA,0,$ExtraeNom1);
		//En caso se haya definido los campos de una funcion, extraemos los valores dentro de ()
		$ExtraValor1=substr($this->FunctionA,$ExtraeNom1+1,-1);
		$ExpVal=explode(",",$ExtraValor1); //aqui tenemos el nombre de los campos.
		//pintamos la raiz
		echo "<img src=\"".$DirArbol."arbol.png\" width=\"16px\" height=\"16px\" /> ";
		echo " <a href=\"#\" id=\"0\" onclick=\"$FuncionG(0,0,'Todos');\">Raiz</a><BR>";
		//referenciamos al metodo QueryArbol
		$ConsulArbol=self::QueryArbol($db, $this->QueryA);
		foreach($ConsulArbol as $row){
			//obtenemos los valores de la funcion
			$VFun1=utf8_encode($row[$ExpVal[0]]);
			$VFun2=utf8_encode($row[$ExpVal[1]]);
			$VFun3=utf8_encode($row[$ExpVal[2]]);
			$VFun4=utf8_encode($row[$ExpVal[3]]);
			$VFun5=utf8_encode($row[$ExpVal[4]]);
			$VFun6=utf8_encode($row[$ExpVal[5]]);
			$VFun7=utf8_encode($row[$ExpVal[6]]);
			$VFun8=utf8_encode($row[$ExpVal[7]]);
			$VFun9=utf8_encode($row[$ExpVal[8]]);
			$VFun10=utf8_encode($row[$ExpVal[9]]);
			$FunFinal="$FuncionG('$VFun1','$VFun2','$VFun3','$VFun4','$VFun5','$VFun6','$VFun7','$VFun8','$VFun9','$VFun10')";	

			//Armamos el arbol de directorio(espacion, imagenes, etc.)
			$SinPto=explode(".",$row['Niveles']);
			$CanElm=count($SinPto)-1;	//contamos los niveles o array
			$CanLista=18*$CanElm;
			$Espacio="<img src=\"".$DirArbol."18x18.gif\" width=\"$CanLista\" height=\"18\"/>";	//creamos espacios
			$Rama= "<img src=\"".$DirArbol."nolines_plus.gif\" width=\"18px\" height=\"18px\"/>";
			if($row['Estado']==0){$ImgDir="folder_off.gif";}else{
				
				switch ($row['Url']){
					case NULL:
					$ImgDir="folderopen.gif";	
					break;
					case "*": 
					$ImgDir="cube16.png";
					break;
					case "#": 
					$ImgDir="icon_module_sm.png";
					break;
					default:
					$ImgDir="folder_url.gif";
				}
			}
			$Folder= "<img src=\"".$DirArbol.$ImgDir."\" border=\"0\" title=\"".utf8_encode($row['Descripcion'])."\" onclick=\"Contrae('$row[Niveles]')\" width=\"16px\" height=\"16px\"/>";

			//antes de pintar la funcion nos aseguramos de que tiene algun dato
			if($this->FunctionA==NULL){$FTree="";}else{$FTree="onclick=\"$FunFinal\"";}
			echo "<div id=\"$row[IdNodo]\">".$Espacio.$Rama.$Folder."<a href=\"#\" $FTree>".utf8_encode(stripslashes($row['Nombre']))."</a></div>";
		}

		return;
	}
}


?>
<script type="text/javascript">
Contrae=function(NivelAr){
alert(NivelAr);

	var pars='IdArbol='+1+'&NivelAr='+NivelAr;
	var ajax = new Ajax.Request( '<?php echo $DireccA;?>ArbolDisplay.php', {
                                parameters: pars,
                                method:"post",
                                onComplete: Acciona
                                }
	);
}

Acciona=function(NodoA){
	
}
</script>