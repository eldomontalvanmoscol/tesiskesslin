<?php
//requiere framework protoype
	class DataGrid{
	function DataView($IDG,$Nivel,$db,$SqlDV,$ColumnasDV,$CanRegDV,$AltoDV,$OrderBDV,$IdDV,$CabeceraG,$PieG){		
			$this->NameG		=	$IDG; 			// Se usa cuando se referencia a esta clases, dos o mas veces
			$this->NivelG		=	$Nivel; 		// E(Emergente), L(Listado)
			$this->SqlG			=	$SqlDV; 		// Query del Grid
			$this->SearchCampo	=	'';
			$this->SearchPalabra=	'';
			$this->ColumnasG	=	$ColumnasDV; 	// Array de las columnas del grid 
			$this->CanRegG		=	$CanRegDV; 		// Cantidad de registros por Grid
			$this->AltoG		=	$AltoDV; 		// Alto del Grid px
			$this->IdG			=	$IdDV; 			// Id de ordenamiento por default (0:ascendente, 1:descendente)
			$this->OrderBDG		=	$OrderBDV; 		// Campo por el cual se ordenara el grid por default
			$this->CabeceraG	=	$CabeceraG; 	// 0(sincabecera), 1(Buscador, fechas, mas), 2(buscador, fechas), 3(buscador, mas),4(buscador), 
			$this->PieG			=	$PieG;			// 0(sin pie),1(Paginador, totales),2 (Paginador)
			
			$DirName="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];	//ruta relativa del control	 		
			$ColumnasG= urlencode(serialize($this->ColumnasG));	//serializamos y condificamos para evitar conflictos con comillas (querys,array,etc.)
			$Consulta= urlencode(serialize($this->SqlG));	
		//CONDICIONALES
		if($this->AltoG==NULL){$Alto="";}else{$Alto=$this->AltoG;}	//si no existe una altura, coloca por default el alto total de la pagina
		if($this->IdG==0){$IdOrden="ASC";}else{$IdOrden="DESC";}	//indica el orden de las consultas
		//AQUI CARGA LA CABECERA DEL GRID (BUSCADORES, FECHAS, ETC.)
		echo "<div class=\"panel\" style=\"padding: 5px;\">";
		if($this->CabeceraG!=0){ include('GridCabecera.php'); }
		
		//DIV DONDE CARGA EL GRID
		echo "<div id=\"".$this->NameG."\" style=\"overflow:auto; height:".$Alto."px;background-color:#cecbbd\"></div>";
		
	?>
	<script type="text/javascript">
	//FUNCION QUE CARGA EL GRID CAJA
	CargarGrid<?php echo $this->NameG;?>=function(Nombre,Query,SearchCampo,SearchPalabra,Columnas,Registros,IdOrden,NomOrden,InicioPag){
		/*Pintamos las variables que pasaremos a la caja*/
		var UrlCajaG='<?php echo $DirName;?>Controles/DataGrid_2/GridCaja.php';
		var param='Name='+Nombre+'&Query='+Query+'&SearchCampo='+SearchCampo+'&SearchPalabra='+SearchPalabra+'&Columnas='+Columnas+'&Registros='+Registros+'&IdOrden='+IdOrden+'&NomOrden='+NomOrden+'&InicioPag='+InicioPag;
		
		var AjxGrid=new Ajax.Updater('<?php echo $this->NameG;?>',UrlCajaG,{
								evalScripts:true,
								method:'post',
								parameters:param,
								on404:SessionOff
		});
	}
	//CARGA EL GRID POR PROMERA VEZ
	
	CargarGrid<?php echo $this->NameG;?>('<?php echo $this->NameG;?>','<?php echo $Consulta;?>','<?php echo $this->SearchCampo;?>','<?php echo $this->SearchPalabra;?>','<?php echo $ColumnasG;?>','<?php echo $this->CanRegG;?>','<?php echo $IdOrden;?>','<?php echo $this->OrderBDG;?>','<?php echo 0;?>');
	
	//PRUEBA 
	Ordenamiento=function(){
		alert('Skynet ERP');
	}
	
	//DEFINE LA VARIABLE QUE USARA EL INDEX.(BOTONES DE CONTROL)
	PintarCelda = function(IdGrid){
		IdLista=IdGrid;	
	}
	
	FocusBusca=function(){
		Field.focus('PalabraG<?php echo $this->NameG;?>');
		Field.select('PalabraG<?php echo $this->NameG;?>');
	}
	
	
	FocusBusca();
	//CIERRA LA APLICACION SI LA SESSION A MUERTO
	function SessionOff(){
	alert('El sistema a estado inactivo por mucho tiempo. Su sesion a finalizado.');
	inicio();
	}

	//DIMENCIONA LA ALTURA AUTOMATICAMENTE
	Event.observe(window, "resize", AlturaGrid, false);//cuando ocurre un cambio en la ventana, redimencionamos
	AlturaGrid();
	function AlturaGrid(){	//otorga una altura de acuerdo al tamañod e la ventana
		var ValorAlto='<?php echo $this->AltoG;?>';
		if(ValorAlto==''){
			var AlturaD=document.documentElement.clientHeight;
			var AltuHead1=$('Header').offsetHeight;	//altura de los menus de la cabecera
			var AltuHead2=AltuHead1+100;
			var AlturaD2=AlturaD-AltuHead2;	//restamos la altura correspondiente a los menus
			var AlturaD3=AlturaD2+'px';
			$('<?php echo $this->NameG;?>').style.height=AlturaD3;
		}
	}
	
	
</script>
	<?php
		if($this->PieG!=0){ include('GridNavegador.php');}
		echo "</div>";
		}
	
	}
?>
</div>