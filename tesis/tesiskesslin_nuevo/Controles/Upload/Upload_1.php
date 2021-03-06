<?php
/* $tipo_ope: Determina el estado de los controles del formulario de Upload que pueden ser de Nuevo(N), Editar(E), Lectura(L)
bade de datos,nombre, idmodulo, iddocumento, tipo de operacion */

function Upload($link,$NameUp,$IdMod,$IdDoc,$tipo_ope,$TipoDoc){
//revise la tabla 'fichero_IdMod' para $IdDoc//

$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control	 
$Ruta=$DirName."Controles/Upload/";
$_SESSION['IdMod']=$IdMod;
$_SESSION['IdDoc']=$IdDoc;
$_SESSION['TipoDoc']=$TipoDoc;

if($tipo_ope == "L"){
   $func_load = "estado_controles();";
}else{
  $func_load = "";
}

?>
<script type="text/javascript">

</script>

<div style="background-color:#CCF; padding:5px;"> 
    <div>
        <iframe width="100%" height="30" frameborder="0" scrolling="no" name="if_upload" id="if_upload"
         onload="<?php echo $func_load; ?>" src="<?php echo $Ruta;?>Iframe.php"></iframe>
    </div>
    
    <div id="TabFilesX" >
        <ul>
            <li ><a href="#VenImagenes" id="VerImg"  >Im&aacute;genes</a></li>
            <li ><a href="#VenFicheros" id="VerFile" >Ficheros</a></li>    
        </ul>
            <div id="VenImagenes" style="height:70px; overflow:auto;" ></div> 
            <div id="VenFicheros" style="height:70px; overflow:auto;" ></div>
            <input type="hidden" id="TDoc" name="TDoc" value="<?php echo $TipoDoc ?>" />
    </div>
</div>

<?php
 } 
 ?>
 
<script type="text/javascript">	
jQuery('.ui-widget').css({'font-family':'Sans-serif','font-size':'9.6pt' });

DeleteFile=function(IdFile,NomSis){
	if (confirm('Esta seguro que quiere eliminar este archivo?')){
	// Si toca aceptar se ejecuta eso (el valor que el confirm devuelve es true)
	DeleteU(IdFile,NomSis);
	}else{
	// Si toca cancelar se ejecuta eso (el valor que el confirm devuelve es false).
	}
}

DeleteU=function(IdFiles,NomSis){
	var Dir='<?php echo "http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'] ;?>';
	jQuery.ajax({
				url: Dir+'Controles/Upload/QueryDelete.php?Id='+IdFiles+'&NomSis='+NomSis,
				type: 'POST',
				complete: function(){RefreshFiles();}
				});
	return false;
}

CargaFiles=function(TipoF){	
	var Dir='<?php echo "http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'] ;?>';
	var hTDoc=jQuery('#TDoc').val();
	
	if(TipoF==0){ var CapaFile='VenImagenes'; }else{ var CapaFile='VenFicheros'; }
		
	var paramFil='tipo_ope=<?php echo $tipo_ope; ?>&TipoFile='+TipoF+'&TipoDoc='+hTDoc;//+TipoDocum; 	
    var url=Dir+'Controles/Upload/Cuadro.php';
	
	jQuery.ajax({
				url: url,
				type: 'POST',
				data: paramFil,
				success: function(data){ jQuery("#"+CapaFile+"").html(data); }
				});
}

estado_controles=function(){
	window.frames['if_upload'].desactivar_form();
}

RefreshFiles=function(){
	CargaFiles(0);
	CargaFiles(1);
}

ClickPestaña = function(WId){
	jQuery('#'+WId).trigger('click');
}

verurl=function(val){
jQuery('#'+val).select();

}

jQuery(document).ready(function(){
	jQuery('#TabFilesX').tabs();
	CargaFiles(0);
});
</script>