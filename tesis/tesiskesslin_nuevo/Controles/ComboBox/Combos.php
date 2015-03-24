<?php
########################################## COMBO SIMPLE #############################################
//sql, Nombre del combo, Valor por default(Edicion)
//include ('../conexion.php');
function Combo($db,$SqlCombo,$NombreCombo,$CValue,$CDescrip,$ValorDefecto,$ValorEditado,$Disabled,$Funcion){	
	$consulta= mysqli_query($db,$SqlCombo);
	//activamos o desactivamos el combo
	if($Disabled==0){ $disabled= "disabled=disabled";} else{ $disabled= '';}
	//preparamos la funcion
	$ExtraeNom1=strpos($Funcion,"(");
				$FuncionG=substr($Funcion,0,$ExtraeNom1);
			//si la funcion fue definida procedemos
			if($Funcion==NULL){
				$FuncionFinal="";
			}else{
				$FuncionFinal="onchange=$FuncionG(this.value,'".$NombreCombo."')";
			}
	
if($_SESSION['Developer']==1){	
	echo "<input name=\"CbDev\" type=\"button\" onclick=\"ComboSQL('$NombreCombo');\" Class=\"Dev\" onmouseover=\"Leyenda(this,'Script SQL de la consulta',1);\"/>";
	echo "<div id=\"ComboDev".$NombreCombo."\" name=\"ComboDev".$NombreCombo."\" style=\"position:inherit; padding:10px; border:solid 1px #999; background-color: #FFF; display:none;\">$SqlCombo</div>";
}
	
	echo "<select name=\"$NombreCombo\" id=\"$NombreCombo\" $FuncionFinal $disabled>";
	while($fila = $consulta->fetch_object()) {
		//while($fila = $consulta->fetch()){
			echo "<option value=\"".utf8_encode(stripslashes($fila->$CValue))."\"";
			if($ValorEditado==NULL){
				if($fila->$CValue==$ValorDefecto){echo "selected";}
			}else{
				if($fila->$CValue==$ValorEditado){echo "selected";}
			}
			echo ">".utf8_encode(stripslashes($fila->$CDescrip))."</option>";
		}	//cierra el bucle
	echo "</select>";
}
?>
