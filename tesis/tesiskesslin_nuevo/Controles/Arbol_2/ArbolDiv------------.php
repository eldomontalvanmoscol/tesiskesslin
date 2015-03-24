<?php
class Arbol{
	private $NomCamp;
	private $IdArbol;
	private $IdNodoE;
	private $QueryArbol;
	private $Descrip;
	private $Tabla;
	
	
	function ArbolDiv($db,$NombreCampo,$Descrip,$Tabla,$IdArbol,$IdNodoEdit,$Funcion){		
		$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control
		$this->NomCamp	=	$NombreCampo;	// Sirve para identificar un unico campo
		$this->IdArbol	=	$IdArbol; 		// sirve para pintar un tipo de arbol
		$this->IdNodoE	=	$IdNodoEdit;	// selecciona un nodo por defecto. se usa para las ediciones
		$this->Descrip	=	$Descrip;		//Descripción del arbol
		$this->Tabla	=	$Tabla;			//Nombre de la tabla
		
		if ($Funcion==''){
			$this->Funcion ='';
		}else{
			$this->Funcion =$Funcion;
		}
			
		//este script pinta el arboldiv en caso se edite
		if($this->IdNodoE!=NULL){
			$sql = "SELECT * FROM tree_det WHERE IdNodo=".$this->IdNodoE."";  
			//$resultados = mysql_query($sql,$db);
			$resultados=mysqli_query($db,$sql);
			$row = $resultados->fetch_object();
		}
	
		$Nombre= utf8_encode(stripslashes($row->Nombre));
?>
	<input type="text" name="<?php echo $this->NomCamp;?>" id="<?php echo $this->NomCamp;?>" 
    value="<?php echo utf8_encode(stripslashes($this->IdNodoE));?>" size="4" onfocus="Mostrar<?php echo $this->NomCamp;?>(this);" style=" float:left; width:15%;"  readonly="readonly"/>
    
	<input type="text" name="Desc<?php echo $this->NomCamp;?>" id="Desc<?php echo $this->NomCamp;?>"  
    value="<?php echo stripslashes($Nombre);?>" onfocus="Mostrar<?php echo $this->NomCamp;?>(this);" style="width:70%; float: left;"  readonly="readonly"/>
    
	<input style="background-image: url(<?php echo $DirName;?>Controles/Arbol_2/images/arbol.png); 
    background-repeat: no-repeat; background-position: center center; float:right; width:13%" 
    name="Boton" value=" ... " type="button"  onclick="Mostrar<?php echo $this->NomCamp;?>(this);"/>
    
    <div id="Capa<?php echo $this->NomCamp;?>" 
    style="border: 1px solid #999; padding:5px; background-color:#E3EEF9; position: fixed; width:390px; height:260px; overflow:scroll; display:none; z-index:99000"><!--Aqui carga el arbol--></div>
    
<script type="text/javascript">
	//muestra el div del arbol
	Mostrar<?php echo $this->NomCamp;?>=function(IdBoton){ 
		var Posi=$(IdBoton).cumulativeOffset();	//obtiene la posicion relativa de un elemento.	
		$('Capa<?php echo $this->NomCamp;?>').style.top=parseFloat(Posi[1]+22)+'px';	
		//$('Capa<?php //echo $this->NomCamp;?>').show();
		//Effect.BlindDown('Capa<?php //echo $this->NomCamp;?>', { duration: 0.5 });
		$('Capa<?php echo $this->NomCamp;?>').toggle();	
					
		var param='IdArbol=<?php echo $this->IdArbol;?>&NomCamp=<?php echo $this->NomCamp;?>&Descrip=<?php echo $this->Descrip;?>&Tabla=<?php echo $this->Tabla;?>';	
		var ajx = new Ajax.Updater('Capa<?php echo $this->NomCamp;?>', '<?php echo $DirName;?>/Controles/Arbol_2/ArbolVentana.php',{
												method:"post", 
												parameters: param,
												evalScripts:true														
		});
	}
		
	//pinta los valores en los campos text cuando se selecciona un nodo
	FuncArbol<?php echo $this->NomCamp;?>=function(IdNodo, Nombre,Padre, IdArbol, Estado, Url, Target,CodAlternativo){	
		if(IdNodo=='77777'){
			IdN=0;
			alert('No deveria seleccionar la raíz');
		}else{
			IdN=IdNodo;
			$('Desc<?php echo $this->NomCamp;?>').value=Nombre;
			$('<?php echo $this->NomCamp;?>').value=IdN;
			$('Capa<?php echo $this->NomCamp;?>').hide();
			<?php echo $this->Funcion;?>(IdNodo, Nombre,Padre, IdArbol, Estado, Url, Target,CodAlternativo);		
		}						
	}
</script>
<?php
	}	//fin function	
}	//fin Clase
?>
