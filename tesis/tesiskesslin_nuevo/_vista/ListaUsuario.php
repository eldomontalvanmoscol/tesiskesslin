<?php
?>

<style type="text/css">

/*html,body{ margin:0px; height:100%; }*/

</style>
<link type='text/css' href='../Css/SkynetGrid.css' rel='stylesheet' />

<!--<div style="height:100%; width:100%; background-color:#EEEEEE; border:#EEEEEE solid 1px">-->
<div id="SocioLista2" style="width:100%; padding-right:10px; background-color:#EEEEEE; border:#EEEEEE solid 1px">
</div>
<!--</div>-->

<script type='text/javascript' src='../Controles/DataGrid_3/SkynetGrid.min.js'></script>
<script type="text/javascript" language="javascript">
//SINCRONIZACIÓN
//	var SincPersonas = "1";
//	
//	if(SincPersonas == "1"){
//		IdMiEmpresa   = "1";
//	}else{
//		IdMiEmpresa   = "<?php //echo $_SESSION['IdMiEmpresa']; ?>";
//	}
//END

jQuery(document).ready(function(){

//jQuery().scrollTop(300);

AlturaGrid=function(){  //Redimensiona Grid a la Ventana
  var H_Doc=document.documentElement.clientHeight;
  var H_Menu=jQuery('#MenuTop').height();
  var H_Search=jQuery('#SearchGSocioNegocio').height();
  
  var H_Grid=parseInt(H_Doc)-parseInt(H_Menu)-16;
  jQuery('#SocioLista2').height(H_Grid);

}

jQuery(window).bind('resize',AlturaGrid);
AlturaGrid();

jQuery("#SocioLista2").SkynetGrid({ 
  Nombre: 'SocioNegocio',
  Url: '../Controles/DataGrid_3/GridQuery.php',
  Alto: '400',//350
  Ancho: '', // Ej: ''<>100%, '50px' o '50%'
  NroReg: 20, //&#x2713
  PagIni: 0,
  QueryGrid:"SELECT IdUsuario,nom_usuario,pass,estado,IdTipoUsuario FROM usuario",
  OtrosCampos: {},// {}=vacio
  OrderBy: 'IdUsuario',
  OrderCampo: 'DESC',
  Options: [{value:'Nombre',name:'nom_usuario'},{value:'estado',name:'estado'}],
  FocusOn: 1, //0: Desactiva el focus en Campo Buscar,  1: Activa el focus en Campo Buscar
  CampoId: 'IdPersona', 
  FunciLoadGrid: 0,
  FunciMouse: [{name:'CapturaElimina'},{name:'Captura'},{name:'CapturaElimina'}],
  FunciParam: {0:'IdPersona'},//Definir los parametros de la funciones Click, DobleClick y ClickDerecho con este mismo orden
  MenuVisible: 1, //0: No muestra, 1: Muestra Menu
  MenuContextual: [
  {NameLink:'Refrescar', IdLink:'RefreshSocio', ImgLink:'../../ImgSys/refresh.png'},
  {NameLink:'Eliminar socio de negocio', IdLink:'DeleteSocio', ImgLink:'../../ImgSys/delete.png'},
  {NameLink:'Editar socio de negocio', IdLink:'EditSocio', ImgLink:'../../ImgSys/editar.png'},
  {NameLink:'Salir', IdLink:'SalirSocio', ImgLink:'../../ImgSys/salir.gif'}
  ],  
  Msg: 'No se encontro ningún registro. No existe ningún socio de negocio o la búsqueda no fue correcta.',
  Columna : [
  {display: 'Id', name: 'IdUsuario', width: '9%', sortable: true, align: 'right'},
  {display: 'Usuario', name: 'nom_usuario', width : '50%', sortable: true, align: 'left'},
  {display: 'Estado', name: 'estado', width: '20%', sortable: true, align: 'right'},
  {display: 'IdTipoUsuario', name: 'IdTipoUsuario', width: '10%', sortable: true, align: 'right'},]
});

jQuery('#MRefreshSocioNegocio, #MNuevoSocioNegocio, #MEditarSocioNegocio, #MEliminarSocioNegocio, #MAnularSocioNegocio, #MImprimirSocioNegocio, #MUsuarioSocioNegocio, #MSalirSocioNegocio').hide();
jQuery('hr').hide();

jQuery('#cmbBSocioNegocio').on('change',function(){
  var opTipo=jQuery('#cmbBSocioNegocio').find('option:selected').val();
  if(opTipo=='Tipo'){
	jQuery(this).removeAttr('id').attr('id','cmbTemp');
    var cmbTipo='<select id="cmbBSocioNegocio"><option value="TipoCliente">Cliente (C)</option><option value="TipoProveedor">Proveedor (P)</option><option value="TipoTrabajador">Trabajador (T)</option><option value="TipoUsuario">Usuario (U)</option><option value="TipoConductor">Conductor (Co)</option><option value="TipoVendedor">Vendedor (V)</option></select>';
	jQuery('#cmbTemp').after(cmbTipo);
	jQuery('#txtBSocioNegocio').val(1).hide();
  }
});

jQuery('#cmbTemp').on('change',function(){
  jQuery('#cmbBSocioNegocio').remove();
  jQuery('#cmbTemp').removeAttr('id').attr('id','cmbBSocioNegocio');
  jQuery('#txtBSocioNegocio').val('').show();
});

jQuery('#TipoClienteSocioNegocio').attr('title','Cliente');
jQuery('#TipoProveedorSocioNegocio').attr('title','Proveedor');
jQuery('#TipoTrabajadorSocioNegocio').attr('title','Trabajador');
jQuery('#TipoUsuarioSocioNegocio').attr('title','Usuario');
jQuery('#TipoConductorSocioNegocio').attr('title','Conductor');
jQuery('#TipoVendedorSocioNegocio').attr('title','Vendedor');


}); 

</script>