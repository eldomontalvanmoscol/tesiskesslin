<?php
/*requiere ingresar el script necesario en la pagina donde se inserta*/
function DataTime($Nombre,$FDefecto,$FEdicion,$FFormato,$Funcion){	//Nombre del combo, Fecha por default,Fecha de edicion, funsion externa
	//preparamos la llamada a la funcion externa
	//$Hrmins = date("H:i:s");
	$ExtraeNom1=strpos($Funcion,"(");
				$FuncionG=substr($Funcion,0,$ExtraeNom1);
			//si la funcion fue definida procedemos
			if($Funcion==NULL){
				$FuncionFinal="";
			}else{
				$FuncionFinal="onchange=$FuncionG(this.value,'".$Nombre."')";
			}
			
			/*if($PeriTra==1){
			   if($_SESSION['Periodo_Trabajo']!='' or $_SESSION['Periodo_Trabajo']!=NULL){
			     $FDefecto = $_SESSION['Periodo_Trabajo'];
			     $FDefecto = $FDefecto." ".$Hrmins;
			   }
			}*/
			
			
	//fin de preparamos
	
	echo "<input name=\"$Nombre\" id=\"$Nombre\" size=\"10\" $FuncionFinal readonly=\"1\" type=\"text\" ";
		if ($FEdicion==NULL){
		echo "value=\"".stripslashes(utf8_encode($FDefecto))."\"";
		}else{
		echo "value=\"".stripslashes(utf8_encode($FEdicion))."\"";
		}
	echo " onmouseover=\"Leyenda(this,jQuery('#$Nombre').val(),1)\">";
	?>
    <button type="reset" id="<?php echo "B".$Nombre; ?>" class="Calendar" onmouseover="Leyenda(this,jQuery('#<?php echo $Nombre; ?>').val(),1);">&nbsp;</button>
    <script type="text/javascript">
   //alert('<?php// echo $_SESSION['Periodo_Trabajo']?>');   //
      Calendar.setup(
        {
          inputField  : "<?php echo $Nombre; ?>", 	        // ID of the input field
          ifFormat    : "%Y-%m-%d %H:%M:%S",				//"%Y-%m-%d",    	// the date format
          button      : "<?php echo "B".$Nombre; ?>",      	// ID of the button
		  singleClick :    true
		  
        }
      );
    </script>
	<?php
}
?>