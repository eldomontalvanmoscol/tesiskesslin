<?php
/*requiere ingresar el script necesario en la pagina donde se inserta*/
function DataTime($Nombre,$FDefecto,$FEdicion,$FFormato){	//Nombre del combo, Fecha por default,Fecha de edicion
	echo "<input name=\"$Nombre\" id=\"$Nombre\" size=\"9\" readonly=\"1\" type=\"text\" ";
		if ($FEdicion==NULL){
		echo "value=\"".stripslashes(utf8_encode($FDefecto))."\"";
		}else{
		echo "value=\"".stripslashes(utf8_encode($FEdicion))."\"";
		}
	echo ">";
	?>
    <button type="reset" id="<?php echo "B".$Nombre; ?>">...</button>
    <script type="text/javascript">
      Calendar.setup(
        {
          inputField  : "<?php echo $Nombre; ?>", 	        // ID of the input field
          ifFormat    : "%Y-%m-%d",							//"%Y-%m-%d",    	// the date format
          button      : "<?php echo "B".$Nombre; ?>",      	// ID of the button
		  singleClick :    true
        }
      );
    </script>
	<?php
}

?>