<?php session_start(); ?>

<div id="DivSearhDirecciones"></div>
<script type="text/javascript">
jQuery('#DivSearhDirecciones').SkynetGrid({ 
	Nombre: 'ListadoSearhDirecciones',
	Url: 'Controles/DataGrid_3/GridQuery.php',
	Alto: '200px',
	Ancho:'', // Ej: ''<>100%, '50px' o '50%'
	NroReg: 16,
	PagIni: 0,
	QueryGrid: "SELECT 0 as IdDireccion,Direccion,'' as Referencias,Ubigeo,'Principal' as Tipo FROM persona WHERE IdPersona='<?php echo $_GET['IdDoc'];?>' UNION SELECT IdDireccion, Direccion, Referencias, Ubigeo,'Secundario' as Tipo FROM direcciones WHERE IdMiEmpresa='<?php echo $_SESSION['IdMiEmpresa'];?>' and IdMiSede='<?php echo $_SESSION['IdMiSede'];?>' and IdMod='<?php echo $_GET['IdMod'];?>' and IdDoc='<?php echo $_GET['IdDoc'];?>'",
	OtrosCampos: {0:'Ubigeo'},
  	OrderBy: 'IdDireccion',
  	OrderCampo: 'ASC',
  	Options: [{value: "Direccion", name: "Direccion"},{value: "Referencias",name: "Referencias"}],
  	FocusOn: 1, //0: Desactiva el focus en Campo Buscar,  1: Activa el focus en Campo Buscar
  	CampoId:'IdDireccion',
  	FunciLoadGrid: 0,
	FunciMouse:[{name:'getdataSearhDirecciones'},{name:'getdataSearhDirecciones'},{name:'getdataSearhDirecciones'}],
  	FunciParam:{0:"IdDireccion", 1:"Direccion", 2:"Ubigeo"},//Definir los parametros de la funciones Click, DobleClick y ClickDerecho con este mismo orden
	MenuVisible: 0, //0: No muestra, 1: Muestra Menu
	MenuContextual: '',
	Msg: '',
	Columna : [
	{display: 'Id', name: 'IdDireccion', width: '10%', sortable: true, align: 'right'},
	{display: 'Direccion', name: 'Direccion', width: '55%', sortable: true, align: 'left'},
	{display: 'Referencias', name: 'Referencias', width: '30%', sortable: true, align: 'left'}
	//{display: 'Tipo', name: 'Tipo', width: '20%', sortable: true, align: 'left'}
	]});

	 getdataSearhDirecciones = function(IdDireccion,Direccion,Ubigeo){
		  jQuery('#<?php echo $_GET['CTextoDir'];?>').val(Direccion);
		  jQuery('#<?php echo $_GET['CTUbigeo'];?>').val(Ubigeo);
		  jQuery('#listFlotante').dialog('close');
	  }
</script>