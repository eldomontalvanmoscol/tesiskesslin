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
		
		//$Ruta="Controles/Ubigeo/";
		$Ruta= 'http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['ConfG_RutaRelativaS'].'Controles/Ubigeo/';	//ruta relativa del control	
		if($this->UbiEdit==''){$this->Ubig=$this->UbiDef;}else{$this->Ubig=$this->UbiEdit;}
		$Dpto=substr($this->Ubig,0,2);	//090909
		$Prov=substr($this->Ubig,2,2);
		$Dist=substr($this->Ubig,4,2);
?>
		<!--combos comunciantes -->
		<select onChange="<?php echo $this->NameC.'CambioB()' ?>" id="<?php echo 'A'.$this->NameC ?>" name="<?php echo 'A'.$this->NameC ?>">
        </select>

		<select onChange="<?php echo $this->NameC.'CambioC()' ?>" id="<?php echo 'B'.$this->NameC ?>" name="<?php echo 'B'.$this->NameC ?>" >
        </select>
		
		<select onChange="<?php echo $this->NameC.'Finaliza()' ?>" id="<?php echo 'C'.$this->NameC ?>" name="<?php echo 'C'.$this->NameC ?>">
        </select>
		
		<input  type="hidden" id="<?php echo $this->NameC ?>" name="<?php echo $this->NameC ?>" />

<script type="text/javascript">	


/////////////////////////////////USANDO JQUERY////////////////////////////////
 function CambioA(){
	var paramA='Dpto=<?php echo $Dpto; ?>';
	var url='<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComA';
	var nomdiv='<?php echo 'A'.$this->NameC;?>';
	
	jQuery.ajax({
				url: url,
				type: 'POST',
				data: paramA,
				success: function(data){
							jQuery('#'+nomdiv+'').html(data);
							<?php echo $this->NameC;?>CambioB();
						  }
				
				});
	
}

<?php echo $this->NameC;?>CambioB=function(){

	var paramB='CodDpto='+jQuery('#'+'<?php echo 'A'.$this->NameC;?>').val()+'&Prov=<?php echo $Prov; ?>';
	var url='<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComB';
	var nomdiv='<?php echo 'B'.$this->NameC;?>';
	
	jQuery.ajax({
				url: url,
				type: 'POST',
				data: paramB,
				success: function(data){
							jQuery('#'+nomdiv+'').html(data);
							<?php echo $this->NameC ?>CambioC();
						  }
				
				});
				
}

<?php echo $this->NameC;?>CambioC=function(){

	var paramC='CodDpto='+jQuery('#'+'<?php echo "A".$this->NameC;?>').val()+'&CodProv='+jQuery('#'+'<?php echo "B".$this->NameC;?>').val()+'&Dist=<?php echo $Dist; ?>';
	var url='<?php echo $Ruta;?>UbigeoCombos.php?Refresh=ComC';
	var nomdiv='<?php echo "C".$this->NameC;?>';
	
	jQuery.ajax({
				url: url,
				type: 'POST',
				data: paramC,
				success: function(data){
							jQuery('#'+nomdiv+'').html(data);
							<?php echo $this->NameC;?>HiddenUbi();
						  }
				
				});
				
}

<?php echo $this->NameC;?>Finaliza=function(){
	<?php echo $this->NameC;?>HiddenUbi();
	}

function <?php echo $this->NameC;?>HiddenUbi(){
	
	var NewUbigeo=jQuery('#'+'<?php echo 'A'.$this->NameC;?>').val()+jQuery('#'+'<?php echo 'B'.$this->NameC;?>').val()+jQuery('#'+'<?php echo 'C'.$this->NameC;?>').val();
	jQuery('#'+'<?php echo $this->NameC;?>').val(NewUbigeo);
}


CambioA();

<?php echo $this->NameC;?>HiddenUbi();

</script>
<?php	
	}
}
?>