<?php session_start(); 
include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesIdMiEmpresa.php');
?>
<div id="DivSearchCotac"></div>
<script type="text/javascript">
jQuery('#DivSearchCotac').SkynetGrid({ 
	Nombre: 'ListadoSearhContacto',
	Url: 'Controles/DataGrid_3/GridQuery.php',
	Alto: '200px',
	Ancho: '', // Ej: ''<>100%, '50px' o '50%'
	NroReg: 16,
	PagIni: 0,
	//QueryGrid: "SELECT * FROM contactos WHERE IdDoc='<?php echo $_GET['IdDoc'] ?>' AND IdMod=5 AND  IdMiEmpresa='<?php echo $_SESSION['IdMiEmpresa']; ?>'",
	QueryGrid: "SELECT * FROM contactos WHERE IdDoc='<?php echo $_GET['IdDoc'] ?>' AND IdMod=5 AND  IdMiEmpresa='<?php echo $IdMiEmpresax; ?>'",
	OtrosCampos: {},
  	OrderBy: 'IdContacto',
  	OrderCampo: 'DESC',
  	Options:[{value:'NroDoc',name:'NroDoc'},{value:'Nombres',name:'Nombres'}],
  	FocusOn: 1, //0: Desactiva el focus en Campo Buscar,  1: Activa el focus en Campo Buscar
  	CampoId:'IdContacto',
  	FunciLoadGrid: 0,
	FunciMouse:[{name:'getdataSearhContacto'},{name:''},{name:'getdataSearhContacto'}],
  	FunciParam:{0:'Nombres'},//Definir los parametros de la funciones Click, DobleClick y ClickDerecho con este mismo orden
	MenuVisible: 0, //0: No muestra, 1: Muestra MenuCampoTabla
	MenuContextual: '',
	Msg: '',
	Columna : [
	{display: 'Id', name: 'IdContacto', width: '7%', sortable: true, align: 'right'},
	{display: 'NroDoc', name: 'NroDoc', width: '30%', sortable: true, align: 'left'},
	{display: 'Nombres', name: 'Nombres', width: '60%', sortable: true, align: 'left'}
	]
	});
getdataSearhContacto=function(Nombres)
{
	jQuery('#<?php echo $_GET['TxtContacto'];?>').val(Nombres);
	jQuery('#listFlotante').dialog('close');
}

</script>