<?php
class Arbol{
	private $NomCamp;
	private $IdArbol;
	private $IdNodoE;
	private $QueryArbol;
	private $Descrip;
	private $Tabla;
	private $NomArbol;
	private $MosLR;
	
	
	function ArbolDiv($db,$NombreCampo,$Descrip,$Tabla,$IdArbol,$IdNodoEdit,$Funcion,$NomArbol,$ClickPoH=0,$MosLR=0){		
		$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control
		$this->NomCamp	=	$NombreCampo;	// Sirve para identificar un unico campo
		$this->IdArbol	=	$IdArbol; 		// sirve para pintar un tipo de arbol
		$this->IdNodoE	=	$IdNodoEdit;	// selecciona un nodo por defecto. se usa para las ediciones
		$this->Descrip	=	$Descrip;		//Descripción del arbol
		$this->Tabla	=	$Tabla;			//Nombre de la tabla
		$this->NomArbol	=	$NomArbol;		//Nombre para diferenciar de otros arboles
		$this->ClickPHT =	$ClickPoH;		//este parametro indica,si haces click en todos,hijos o padres->inserta a la caja los valores
		$this->MosLR	=	$MosLR;			//si mostramos el link raiz del arbol,util en el control manager group
		if ($Funcion==''){
			$this->Funcion ='';
		}else{
			$this->Funcion =$Funcion;
		}
		//este script pinta el arboldiv en caso se edite
		if($this->IdNodoE!=NULL){
			$sql = "SELECT * FROM tree_det WHERE IdNodo=".$this->IdNodoE." ";  
			//$resultados = mysql_query($sql,$db);
			$resultados=mysqli_query($db,$sql);
			$row = $resultados->fetch_object();
		}
	
		$Nombre= utf8_encode(stripslashes($row->Nombre));
?>
	<input type="text" name="<?php echo $this->NomCamp;?>" id="<?php echo $this->NomCamp;?>" 
    value="<?php echo utf8_encode(stripslashes($this->IdNodoE));?>" size="4" onfocus="Mostrar<?php echo $this->NomCamp;?>(this);" style=" float:left; width:15%;"  readonly="readonly"/>
    
	<input type="text" name="Desc<?php echo $this->NomCamp;?>" id="Desc<?php echo $this->NomCamp;?>"  
    value="<?php echo stripslashes($Nombre);?>" onfocus="Mostrar<?php echo $this->NomCamp;?>(this);" style="width:65%; float: left;"  readonly="readonly"/>
    
	<input style="background-image: url(<?php echo $DirName;?>Controles/Arbol_2/images/arbol.png); 
    background-repeat: no-repeat; background-position: center center; float:right; width:13%" 
    name="Boton" id="Boton<?php echo $this->NomCamp;?>" value=" ... " type="button"  onclick="Mostrar<?php echo $this->NomCamp;?>(this);"/>
    
    <div id="Capa<?php echo $this->NomCamp;?>" 
    style="border: 1px solid #999; padding:5px; background-color:#E3EEF9; position: fixed; width:390px; height:260px; overflow:scroll; display:none; z-index:99000"><!--Aqui carga el arbol--></div>
    
<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery('#Capa<?php echo $this->NomCamp;?>').html('<p><img src="<?php echo $DirName;?>Controles/Arbol_2/images/cargando.gif" /></p>');
	
	//muestra el div del arbol
	Mostrar<?php echo $this->NomCamp;?>=function(IdBoton){  //cumulativeOffset()
		var Id=jQuery(IdBoton).attr("id");		//extraigo en id del obbjeto
		var Posi=jQuery('#'+Id).offset();	//obtiene la posicion relativa de un elemento.	
		jQuery('#Capa<?php echo $this->NomCamp;?>').css({top:Posi.top+22});
		jQuery('#Capa<?php echo $this->NomCamp;?>').toggle();	
					
		var param='IdArbol=<?php echo $this->IdArbol;?>&NomCamp=<?php echo $this->NomCamp;?>&Descrip=<?php echo $this->Descrip;?>&Tabla=<?php echo $this->Tabla;?>&NomArbol=<?php echo $this->NomArbol;?>&AccionNodo=<?php echo $this->ClickPHT;?>&MoslR=<?php echo $this->MosLR; ?>';	
		
		
		jQuery.ajax({
				url: '<?php echo $DirName;?>Controles/Arbol_2/ArbolVentana.php',
				type: 'POST',
				data: param,
				success: function(data){
							jQuery('#Capa<?php echo $this->NomCamp;?>').html(data);
				         },
				complete: function(){
						     jQuery('.Tree_root').hide();
							 jQuery('#Capa<?php echo $this->NomCamp;?>').find("img[src*='arbol.png']").hide();
							 jQuery('#Capa<?php echo $this->NomCamp;?>').find('br:first').hide();
							 if(jQuery('#Capa<?php echo $this->NomCamp;?>').html().indexOf('<ul')==-1){
							 	jQuery('#Capa<?php echo $this->NomCamp;?>').find('a:first').hide();
								jQuery('#Capa<?php echo $this->NomCamp;?>').find('.ClassExpCol').removeAttr('onclick').hide();
							 }
				          }
		});
	}
	//pinta los valores en los campos text cuando se selecciona un nodo
	FuncArbol<?php echo $this->NomCamp;?>=function(IdNodo, Nombre,Padre, IdArbol, Estado, Url, Target,CodAlternativo){	
		if(IdNodo=='77777'){
			IdN=0;
			//alert('No deveria seleccionar la raíz');
			jQuery('#Desc<?php echo $this->NomCamp;?>').val(Nombre);			
			jQuery('#<?php echo $this->NomCamp;?>').val(IdN);
			jQuery('#Capa<?php echo $this->NomCamp;?>').hide();
			<?php echo $this->Funcion;?>(IdNodo, Nombre,Padre, IdArbol, Estado, Url, Target,CodAlternativo);
		}else{
			IdN=IdNodo;
			jQuery('#Desc<?php echo $this->NomCamp;?>').val(Nombre);			
			jQuery('#<?php echo $this->NomCamp;?>').val(IdN);
			jQuery('#Capa<?php echo $this->NomCamp;?>').hide();
			<?php echo $this->Funcion;?>(IdNodo, Nombre,Padre, IdArbol, Estado, Url, Target,CodAlternativo);		
		}
	}
});
</script>
<?php
	}	//fin function	
}	//fin Clase
?>
