<?php
class Ubigeo{
	var $NameC;
	var $UbiDef;
	var $UbiEdit;
	var $Ubig;

	function UbigeoDir($db,$NombreCB,$UbiDef,$UbiEdit){
		$this->NameC		=	$NombreCB; 		// Nombre del campo
		$this->UbiDef		=	$UbiDef; 		// Nombre del campo
		$this->UbiEdit		=	$UbiEdit; 		// Nombre del campo
		
		$Ruta="Controles/Ubigeo/";
		//$Ruta= "http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/Ubigeo/";	//ruta relativa del control	
		if($this->UbiEdit==''){$this->Ubig=$this->UbiDef;}else{$this->Ubig=$this->UbiEdit;}
		$Dpto=substr($this->Ubig,0,2);	//090909
		$Prov=substr($this->Ubig,2,2);
		$Dist=substr($this->Ubig,4,2);
		
		//combos comunciantes
		echo "<select onChange=\"".$this->NameC."CambioB();\" id=\"A".$this->NameC."\" name=\"A".$this->NameC."\">";
        echo "</select>";
		
		echo "<select onChange=\"".$this->NameC."CambioC();\" id=\"B".$this->NameC."\" name=\"B".$this->NameC."\">";
        echo "</select>";
		
		echo "<select onChange=\"Finaliza()\" id=\"C".$this->NameC."\" name=\"C".$this->NameC."\">";
        echo "</select>";
		
		echo "<input  type=\"hidden\" id=\"".$this->NameC."\" name=\"".$this->NameC."\"/>";
		
?>	
<script type="text/javascript">	
CambioA();
<?php echo $this->NameC;?>HiddenUbi();

 function CambioA(){
	var paramA='Dpto=<?php echo $Dpto; ?>';
	new Ajax.Updater('<?php echo "A".$this->NameC;?>','<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComA',{
	parameters: paramA,
	evalScripts:true,
	method:'post',
	onComplete:function(){<?php echo $this->NameC;?>CambioB()}
	});
}

<?php echo $this->NameC;?>CambioB=function(){
	var paramB='CodDpto='+$F('<?php echo "A".$this->NameC;?>')+'&Prov=<?php echo $Prov; ?>';
	new Ajax.Updater('<?php echo "B".$this->NameC;?>','<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComB',{
	parameters: paramB,
	evalScripts:true,
	method:'post',
	onComplete:function(){<?php echo $this->NameC;?>CambioC()}
	});
}

<?php echo $this->NameC;?>CambioC=function(){
	var paramC='CodDpto='+$F('<?php echo "A".$this->NameC;?>')+'&CodProv='+$F('<?php echo "B".$this->NameC;?>')+'&Dist=<?php echo $Dist; ?>';
	
	new Ajax.Updater('<?php echo "C".$this->NameC;?>','<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComC',{
	parameters: paramC,
	evalScripts:true,
	method:'post',
	onComplete:function(){<?php echo $this->NameC;?>HiddenUbi()}
	});
}

Finaliza=function(){
	<?php echo $this->NameC;?>HiddenUbi();
	}

function <?php echo $this->NameC;?>HiddenUbi(){
	var NewUbigeo=$F(('<?php echo "A".$this->NameC;?>'))+$F(('<?php echo "B".$this->NameC;?>'))+$F(('<?php echo "C".$this->NameC;?>'));
	$('<?php echo $this->NameC;?>').value=NewUbigeo;
}
</script>
<?php	
	}
}
?>