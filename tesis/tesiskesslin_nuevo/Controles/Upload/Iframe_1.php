<?php 
session_start();

if(isset($_GET['ext'])){
	$ext=$_GET['ext'];
}else{
	$ext='';
}

?>
<style type="text/css">
body,td,th,input,select {
	font-size: 8.60pt;
}

</style>
<script type="text/javascript" src="../../Scripts/jquery.min.js"></script>
<form action="QueryInsert.php" method="post" enctype="multipart/form-data" name="formU" id="formU">
  <input type="file" name="File" id="File" size="30"  style="width:100%;" onchange="Cargar(this.form.File.value)"/>    
    <input type="hidden" name="IdDoc" id="IdDoc" value="<?php echo $_SESSION['IdDoc'];?>"/>
    <input type="hidden" name="IdMod" id="IdMod" value="<?php echo $_SESSION['IdMod'];?>"/> 
    <input type="hidden" name="TipoDoc" id="TipoDoc" value="<?php echo $_SESSION['TipoDoc'];?>"/>   
</form>

<script type="text/javascript">	
parent.RefreshFiles();

function Cargar(archivo) {
 if (!archivo){
		alert('Para cargar un archivo utilice el boton Examinar');
	}else{
		
		fragmentoarch = archivo.split('.');
		var ext1 = fragmentoarch[fragmentoarch.length - 1];
	 	  if(ext1=='php'){
		    alert("No se puede subir un archivo con extensión php.");
		    }else{
		      document.formU.submit();
			}	 
	}
}

function desactivar_form(){
	jQuery('#formU').attr('disabled','disabled');
}


var ext='<?php echo $ext; ?>';

if(ext!=''){
	
	if(ext=='image'){
		parent.ClickPestaña('VerImg');
	}else{
		parent.ClickPestaña('VerFile');
	}
	
	//}
	
}

</script>