<?php
/* $tipo_ope: Determina el estado de los controles del formulario de Upload que pueden ser de Nuevo(N), Editar(E), Lectura(L)
bade de datos,nombre, idmodulo, iddocumento, tipo de operacion */

function Upload($link,$NameUp,$IdMod,$IdDoc,$tipo_ope){
	
//revise la tabla 'fichero_IdMod' para $IdDoc//
$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control	 		

$Ruta=$DirName."Controles/Upload/";
$_SESSION['IdMod']=$IdMod;
$_SESSION['IdDoc']=$IdDoc;

if($tipo_ope == "L"){
   $func_load = "estado_controles();";
}else{
  $func_load = "";
}
?>
<div style="background-color:#CCF; padding:5px;"> 
    <div> 
    <iframe width="100%" height="30" frameborder="0" scrolling="no" name="if_upload" id="if_upload"
     onload="<?php echo $func_load; ?>" src="<?php echo $Ruta;?>Iframe.php"></iframe>
    </div>
    <div id="TabFilesX" class="Tab">
        <ul class="HeadTab">
            <li class="TabOff" onClick="CambiaTabFileF('VenImagenes',this);">Imagenes</li>
            <li class="TabOff" onClick="CambiaTabFileF('VenFicheros',this);">Archivos</li>       
        </ul>
        <div class="BodyTab" style="overflow:auto; width:100%; height:100px;">
            <div id="VenImagenes" class="over"></div> 
            <div id="VenFicheros" class="over"></div>
        </div>
    </div>
</div>
<?php
 } 
 ?>
 
<script type="text/javascript">	
var PestFil = new Tabs('TabFilesX',["VenImagenes", "VenFicheros"]);
PestFil.Capas();
CambiaTabFileF=function(Nom,IdTab){
	PestFil.MuestraTab(Nom,IdTab);
}

DeleteFile=function(IdFile,NomSis){
	if (confirm('Esta seguro que quiere eliminar este archivo?')){
	// Si toca aceptar se ejecuta eso (el valor que el confirm devuelve es true)
	DeleteU(IdFile,NomSis);
	}else{
	// Si toca cancelar se ejecuta eso (el valor que el confirm devuelve es false).
	}
}

DeleteU=function(IdFiles,NomSis){
	new Ajax.Request('Controles/Upload/QueryDelete.php?Id='+IdFiles+'&NomSis='+NomSis,{
	evalScripts:true,
	method:'post',
	onComplete	: function(){RefreshFiles()}
	}); 
	return false;
}

CargaFiles=function(TipoF){	
	if(TipoF==0){ 		
		var CapaFile='VenImagenes';
	}else{
		var CapaFile='VenFicheros';
	}
		
	var paramFil='tipo_ope=<?php echo $tipo_ope; ?>&TipoFile='+TipoF; 	
	new Ajax.Updater(CapaFile,'Controles/Upload/Cuadro.php',{
	evalScripts:true,
	parameters:paramFil,
	method:'post'
	}); 
	return false;
}

estado_controles=function(){
	window.frames['if_upload'].desactivar_form();
}

RefreshFiles=function(){
	CargaFiles(0);
	CargaFiles(1);
}
CargaFiles(0);
</script>