<?php
if(!isset($Existe)){include('Arbol.php');}

class Arbol{
	var $NomCamp;
	var $IdArbol;
	var $IdNodoE;
	var $QueryArbol;
	
	function ArbolDiv($db,$NombreCampo,$IdArbol,$IdNodoEdit,$Funcion){
		$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control

		$this->NomCamp	=	$NombreCampo;	// Sirve para identificar un unico campo
		$this->IdArbol	=	$IdArbol; 		// sirve para pintar un tipo de arbol
		$this->IdNodoE	=	$IdNodoEdit;	// selecciona un nodo por defecto. se usa para las ediciones
		
		if ($Funcion==''){
			$this->Funcion ='';
		}else{
			$this->Funcion =$Funcion; 		
		}
	?>
	<script type="text/javascript">
	Mostrar<?php echo $this->NomCamp;?>=function(){ 
		$('Capa<?php echo $this->NomCamp;?>').toggle();		
	}
	
	IdArbol<?php echo $this->NomCamp;?>=function(IdTree,Nivel,Nombre){	//NIVEL DEL ARBOL
		$('Desc<?php echo $this->NomCamp;?>').value=Nombre;
		$('<?php echo $this->NomCamp;?>').value=IdTree;
		$('Capa<?php echo $this->NomCamp;?>').style.display = 'none';
		<?php echo $this->Funcion?>
	}
	</script>
<?php
	//este script pinta el arboldiv en caso se edite
	if($this->IdNodoE!=NULL){
		$sql = "SELECT * FROM arbol WHERE IdNodo=".$this->IdNodoE."";  
		foreach ($db->query($sql) as $row) {  
		}  
	}

	$Nombre= utf8_encode(stripslashes($row['Nombre']));
?>
<style type="text/css">
	<!--	
.BotonArbol {
	color: #00CCFF;
	font-weight: bold;
	background-image: url(<?php echo $DirName;?>ImgSys/arbol.png);
	background-repeat: no-repeat;
	background-position: center center;
}
	-->
	</style>

<label>
	<input type="text" name="<?php echo $this->NomCamp;?>" id="<?php echo $this->NomCamp;?>" 
    value="<?php echo utf8_encode(stripslashes($this->IdNodoE));?>" size="4" onfocus="Mostrar<?php echo $this->NomCamp;?>();" readonly="1" />
	</label>
	<label>
	<input type="text" name="Desc<?php echo $this->NomCamp;?>" id="Desc<?php echo $this->NomCamp;?>"  
    value="<?php echo stripslashes($Nombre);?>" size="25" onfocus="Mostrar<?php echo $this->NomCamp;?>();" readonly="1" />
    </label>
	<input class="BotonArbol" name="Boton" value=" ... " type="button"  onclick="Mostrar<?php echo $this->NomCamp;?>();"/>
    
<div id="Capa<?php echo $this->NomCamp;?>" class="over" style="position:absolute; left:76px; width:350px; height:200px; overflow:scroll; display:none;">
<?php
$this->QueryArbol='SELECT * FROM arbol WHERE IdMiEmpresa='.$_SESSION['IdMiEmpresa'].' and IdArbol='.$this->IdArbol.' order by Niveles';
$Arbol7 = new Tree();
$Arbol7->VerArbol($db,$this->QueryArbol,'IdArbol'.$this->NomCamp.'(IdNodo,Niveles,Nombre)');
?>
</div>	
<?php
	}	//fin function	
}	//fin Clase
?>