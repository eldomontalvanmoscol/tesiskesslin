<?php
$Rutax="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS'];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="76%">

<?php 
	//deside como se muestra la cabecera
	if($this->CabeceraG==1 or $this->CabeceraG==2){
 }

if($this->CabeceraG==1 or $this->CabeceraG==2 or $this->CabeceraG==3 or $this->CabeceraG==4){
	?>
      <select name="CampoS<?php echo $this->NameG;?>" id="CampoS<?php echo $this->NameG;?>" onchange="FocusBusca();">
     <?php           
		foreach($this->ColumnasG as $Nombre=>$Valor){	
			$Buscador	=	$this->ColumnasG[$Nombre]['Buscador'];		//Visualizacion del campo el el buscador del grid
			$CampoT		=	$this->ColumnasG[$Nombre]['CampoTabla'];	//obtenemos los nombres de los array principales
			$TipoC		=	$this->ColumnasG[$Nombre]['TipoCampo'];		//Obtenemos los tipos de campo(check, boton, etc)
			
			if($Buscador=="true"){
				echo "<option value=\"$CampoT\">$Nombre</option>";
			}
		}
		?>
      </select>
      <input name="PalabraG<?php echo $this->NameG;?>" type="text" id="PalabraG<?php echo $this->NameG;?>" size="20" onchange="BuscarG<?php echo $this->NameG;?>()"/>
      <input type="button" name="button" id="button" value="Buscar" onclick="BuscarG<?php echo $this->NameG;?>()"/>
      <?php }?>
    </td>
    <td align="right">
 
  <div onclick="Excel(0);" class="Toolbar" style="width:25px; float:right;" onmouseover="Leyenda(this,'Exportar como HTML',1);"><img src="<?php echo $Rutax?>ImgSys/html.png" width="16" height="16" /></div>
   <div onclick="Excel(1);" class="Toolbar" style="width:25px; float:right;" onmouseover="Leyenda(this,'Exportar como Excel',1);"><img src="<?php echo $Rutax?>ImgSys/excel.gif" width="16" height="16" /></div>
  	<?php
	if($_SESSION['Developer']==1){
	?>
<div onclick="GridSQL('<?php echo $this->NameG;?>');" class="Toolbar" style="width:25px; float:right;" onmouseover="Leyenda(this,'Ver script SQL de la consulta',1);">
<img src="<?php echo $Rutax?>ImgSys/sql.gif" width="16" height="16" /></div>  
      <?php } ?>
      
 </td>
  </tr>
</table>
<script type="text/javascript">
BuscarG<?php echo $this->NameG;?>=function (){	//funcion que obtiene valores del select
	var CampoSelect=$F('CampoS<?php echo $this->NameG;?>');
	var Palabrita=$F('PalabraG<?php echo $this->NameG;?>');

CargarGrid<?php echo $this->NameG;?>('<?php echo $this->NameG;?>','<?php echo $Consulta;?>',CampoSelect,Palabrita,'<?php echo $ColumnasG;?>','<?php echo $this->CanRegG;?>','<?php echo $IdOrden;?>','<?php echo $this->OrderBDG;?>','<?php echo 0;?>');

FocusBusca();
}

Excel=function(Tipo){
	window.open('Controles/DataGrid_2/ExportaExcel.php?Query='+$F('QueryBus')+'&Name=<?php echo $this->NameG;?>&Columnas=<?php echo $ColumnasG;?>&Titulo='+titulo+'&Tipo='+Tipo, this.target, 'width=800,height=500,scrollbars=1'); return false;
	
}

</script>