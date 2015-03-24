<?php
session_start();
$Path=($_REQUEST['WEB']=="WEB")?"../":"";
include ($Path.'../Cx.php');
$link=Conectarse();
## ©2008 DERECHOS RESERVADOS - SKYNET ERP
header("Cache-Control: no-store, no-cache, must-revalidate");
$TituloM	=	"Mis organizaciones";	//Título del módulo. Ventana del modulo y las ventanas emergentes.
$FileNameM	=	"MiOrganizacion";	//Nombre del archivo modelo(sin .php). Sin espacios, tílde o símbolos.


## CONTROLADOR LISTA 
function Listar(){
	
	include ('../Controles/ComboBox/Combos.php');
	include('../Controles/DataTime/Data.php'); 
	global $TituloM;
	global $FileNameM;
	?>
	<script type="text/javascript">
	//ESTADO DE LOS BOTONES DE ACCION ---------------
	$('Nuevo').disabled=false;
	$('Editar').disabled=false;
	$('Aprobar').disabled=true;
	$('Anular').disabled=true;
	$('Eliminar').disabled=true;
	$('Imprimir').disabled=true;
	
    UrlControlador	=	'_controlador/<?php echo $FileNameM; ?>C.php';		//Pasamos la ruta del controlador
    titulo			=	'<?php echo $TituloM; ?>';		//Pasamos el titulo del modulo		
	$('Titulo').update(titulo);	
	
	W_ancho="600px";
	//W_ancho="1000px";
	H_altura="450px";
	IdManual=208;
    </script>
<?php
	//require ('../Controles/DataGrid_2/Grid.php'); 	    //Cargamos el componente grid

	require ('../_vista/'.$FileNameM.'Lista.php');		//Llamamos la pagina lista de la capa vista --Principal
	
}

function Crear($link){
	echo $Path=($_REQUEST['WEB']=="WEB")?"../":"";
	
	include($Path.'../Class/UltimoId.php');
	include($Path.'../Controles/ComboBox/Combos.php');
	include($Path.'../Controles/DataTime/Data.php'); 
	global $FileNameM;	
    $ID = CampoTabla($link,'IdOrganizacion','mi_organizacion')+1;	
	$condi = 'Crear';
	
	


	?>
	<script type="text/javascript">
	Path="";
	if('<?php echo $_REQUEST['WEB'] ?>'=="WEB"){Path="../../";};
	
	var UrlCrea= Path+"_modelo/MiOrganizacion.php?Accion=Inserta";		//Ruta del archivo modelo q realizara el insert
	var UrlResp=Path+"_controlador/<?php echo $FileNameM; ?>C.php?Accion=Listar";	//Ruta del GRID a cargar como respuesta (sin ../)
	
	BotonEnviar=function(){
	

		jQuery.post(UrlCrea, jQuery("#formMO").serialize(),function(data){
				jQuery("div#load").show();				

				CrearEmpresa();
				 jQuery("div#load").append("<h3>100%<br>Creando Empresa...</h3>");				
 		 });
		
	}
	
	CrearEmpresa = function(){

		var UrlVerIdOrganizacion= Path+"_modelo/MiEmpresaInserta.php?Accion=MiEmpresaInsertaXOrganizacion";		//Ruta del archivo modelo q realizara el insert
		jQuery.post(UrlVerIdOrganizacion, jQuery("#formMO").serialize(),function(data){
			 
			 CreaUsuarioAdmin();
			 jQuery("div#load h3").remove();
			 jQuery("div#load").append("<h3>96%<br>Creando Grupos y familias...</h3>");	
 		 });
		
		
	}
	
	CreaUsuarioAdmin= function(){
		
		var UrlCreaUsu= Path+"Componentes/Multiempresa/Sincronizar/PersonasDesincronizaXOrganizacion.php?CrearSuperAdmin=SI";		//Ruta del archivo modelo q realizara el insert
		jQuery.post(UrlCreaUsu, jQuery("#formMO").serialize(),function(Id){
			 InsertaUbicacionMulti(Id);
			 jQuery("div#load h3").remove();
			 jQuery("div#load").append("<h3>92%<br>Creando usuario Super Administrador...</h3>");	
 		});
		
	}
	
	InsertaUbicacionMulti= function(Id){
		
		var UrlCreaUsu= Path+"Componentes/SocioNegocio/SocioInsertaMultiXOrganizacion.php?Accion=SI&IdMiEmpresa="+Id;		
		jQuery.post(UrlCreaUsu, jQuery("#formMO").serialize(),function(){
			 CrearConfig(Id);
			 jQuery("div#load h3").remove();
			 jQuery("div#load").append("<h3>90%<br>Insertando permisos en multiempresa...</h3>");	
 		});
	}
	
//-------------------------INICIO REPLICAS------------------------------

CrearConfig = function(Id){

	var IdConf = Id;  
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Config/ConfigCrea.php',
				data : {CConfig: "SI", IdConf: IdConf},
				success: function(data) { 
				
						UpdateConfig(Id);
						jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>88%<br>Creando Grupos y familias...</h3>");	
				}
			});
}


UpdateConfig = function(Id){
	
/*	var IdConf = jQuery('#Id').val();
	var RuConf = jQuery('#Ruc').val();
	var NoConf = jQuery('#Nombre').val();
	var DiConf = jQuery('#Direccion').val();
	var TeConf = jQuery('#Telefono').val();
	var EmConf = jQuery('#Email').val();
	var UrConf = jQuery('#Url').val();
	var PaConf = jQuery('#Pais').val();*/
	
	
	var IdConf = Id;
	var RuConf = jQuery('#Ruc').val();
	var NoConf = jQuery('#Nombre').val();
	var DiConf = jQuery('#Direccion').val();
	var TeConf = jQuery('#Telefono').val();
	var EmConf = jQuery('#Email').val();
	var UrConf = jQuery('#Url').val();
	var PaConf = jQuery('#Pais').val();
	
	
	jQuery.ajax({
				type : 'POST',
				url : Path+'_modelo/MiEmpresaInserta.php',
				data : {UConfig: "SI", IdConf: IdConf, RuConf: RuConf, NoConf: NoConf, DiConf: DiConf, TeConf: TeConf, EmConf: EmConf, UrConf: UrConf,                        				                       PaConfig: PaConf }, // + "&par1=1&par2=2&par3=232"
				success: function(results) { 
					//jQuery("div#load").hide();	
					//Cargar(UrlResp);			 
		 			//jQuery('#N500').remove();	
					ReplicaTreeDet(IdConf);
						jQuery("div#load h3").remove();
						//jQuery("div#load").append("<h3>Creando \u00e1rbol de grupos del sistema...</h3>");
						jQuery("div#load").append("<h3>84%<br>Creando Grupos y familias...</h3>");		
				}
			});
}
//------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------



ReplicaTreeDet = function(IdConf){

	jQuery.ajax({  
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaTreeDet.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					UpdateReplicaTreeDetNiveles(IdConf);
					jQuery("div#load h3").remove();
					jQuery("div#load").append("<h3>80%<br>Creando Correlativos de documentos...</h3>");
					//ReplicaTipoListaPrecio();
					//UpdateReplicaTreeDet();
						//jQuery("div#load h3").remove();
						//jQuery("div#load").append("<h3>Creando Precio de venta de productos...</h3>");
						//jQuery("div#load h3").remove();
						//jQuery("div#load").append("<h3>Creando Tipos de Precio de productos...</h3>");					
				}
			});
}


UpdateReplicaTreeDetNiveles = function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : '<?php echo $Path?>Componentes/Multiempresa/Sincronizar/UpdateReplicaTreeDetNiveles.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					//ReplicaTipoListaPrecio(IdConf)
					//ReplicaPrecioVentaProductos(IdConf);
					ReplicaTipoListaPrecio(IdConf);
						jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>40%<br>Creando Tipos de Precio de productos...</h3>");			
				}
			});
}
    


ReplicaTipoListaPrecio = function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaListaTipoPrecio.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
						ReplicaCorrelDoc(IdConf);	
						jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>72%<br>Creando Precio de venta de productos...</h3>");			
				}
			});
}
/*
ReplicaPrecioVentaProductos = function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaPrecioVentaProductos.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					//UpdateReplicaPrecioVentaProductos();
					ReplicaCorrelDoc();	
					jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>68%<br>Creando Correlativos de documentos...</h3>");
				}
			});
}

UpdateReplicaPrecioVentaProductos = function(){// NOT NOW
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateReplicaPrecioVentaProductos.php',
				data : {Actuar: "SI"}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
						ReplicaCorrelDoc();
						jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>64%<br>Creando Correlativos de documentos...</h3>");			
				}
			});
}
*/
ReplicaCorrelDoc = function(IdConf){
	
	jQuery.ajax({     
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaCorrelativosDoc.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					ReplicaPlanCuentas(IdConf)	
						jQuery("div#load h3").remove();
						jQuery("div#load").append("<h3>60%<br>Creando Plan de cuentas...</h3>");			
				}
			});
}  

ReplicaPlanCuentas= function(IdConf){

	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaPlanCuentas.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					ReplicaPlanCuentaDestino(IdConf);	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>54%<br>Creando Plan de cuenta destino...</h3>");			
				}
			});
}

ReplicaPlanCuentaDestino= function(IdConf){

	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaPlanCuentaDestino.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					UpdatePlanCuentaDestino(IdConf);	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>50%<br>Actualizando plan cuenta destino...</h3>");				
				}
			});
}

UpdatePlanCuentaDestino= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateReplicaPlanCuentaDestino.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					//ReplicaCTFormula(); //Old
					ReplicaMaCab(IdConf);// New 13Jun
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>46%<br>Creando Centro de costos...</h3>");				
				}
			});
			/*jQuery("div#load h3").remove();
			jQuery("div#load").append("<h3>Creando Formulas de contabilidad...</h3>");	
			ReplicaCTFormula();	*/
}



/*REPLICA TABLA MAESTRA*/
ReplicaMaCab= function(IdConf){ // NEW
	var request = jQuery.ajax({type : 'POST', url : 'Componentes/Multiempresa/Sincronizar/ReplicaMaCab.php', data : {Actuar: "SI",Id:IdConf}});
	request.done(function(data){
		ReplicaMaDet(IdConf);
		jQuery("div#load h3").remove();
		jQuery("div#load").append("<h3>Relacionando maestros del sistema...</h3>");		
	});
}// END ReplicaMacab

ReplicaMaDet= function(IdConf){ // NEW
	var request = jQuery.ajax({type : 'POST', url : 'Componentes/Multiempresa/Sincronizar/ReplicaMaDet.php', data : {Actuar: "SI",Id:IdConf}});
	request.done(function(data){
		UpdateReplicaMaDet(IdConf);
	});
}// END ReplicaMaDet

UpdateReplicaMaDet= function(IdConf){ // NEW
	
	var request = jQuery.ajax({type : 'POST', url : 'Componentes/Multiempresa/Sincronizar/UpdateReplicaMaDet.php', data : {Actuar: "SI",Id:IdConf}}); 
	request.done(function(){
		ReplicaMotivos(IdConf);  
		jQuery("div#load h3").remove();
		jQuery("div#load").append("<h3>Creando Motivos de documentos...</h3>");		
	});
}// END UpdateReplicaMaDet

/*END REPLICA TABLA MAESTRA*/    
  
ReplicaMotivos= function(IdConf){ // NEW
	var request = jQuery.ajax({type : 'POST', url : 'Componentes/Multiempresa/Sincronizar/ReplicaMotivos.php', data : {Actuar: "SI",Id:IdConf}}); 
	request.done(function(){
		ReplicaCC(IdConf);
		jQuery("div#load h3").remove();
		jQuery("div#load").append("<h3>Creando Centro de costos...</h3>");		
	});
}// END ReplicaMotivos
  

// REPLICAR CENTRO DE COSTOS, RELACIONAR CON CENTRO DE COSTO ASIG
// RELACIONAR CON LOS PLANES DE CUENTA DE LA NUEVA EMPRESA
ReplicaCC= function(IdConf){

	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaCC.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data){ 
					ReplicaCTFormulaDetalle(IdConf);
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>42%<br>Relacionando Centro de costos...</h3>");		
				}
			});
}// END CReplicaCC
/*
ReplicaCCAsig= function(IdConf){    
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaCCAsig.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					UpdateCCAsigR1(IdConf);
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>38%<br>Creando Formulas de contabilidad...</h3>");
				}
			});
}// END CReplicaCCAsig

UpdateCCAsigR1= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateCCAsigR1.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					UpdateCCAsigR2();	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>34%<br>Creando Formulas de contabilidad...</h3>");	
				}
			});
}// END CUpdateReplicaCCAsig

UpdateCCAsigR2= function(){
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateCCAsigR2.php',
				data : {Actuar: "SI"}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					ReplicaCTFormulaDetalle();
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>30%<br>Creando Formulas de contabilidad...</h3>");		
				}
			});
}// END CUpdateReplicaCCAsig

*/
ReplicaCTFormulaDetalle= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaCTFormulaDetalle.php',
				data : {Actuar: "SI",Id:IdConf},
				success: function(data) { 
					ReplicaMatrizContable(IdConf);	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>26%<br>Creando Matriz contable...</h3>");			
				}
			});
}

ReplicaMatrizContable= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaMatrizContable.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					ReplicaFormatos(IdConf);	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>22%<br>Formateando documentos...</h3>");		
				}
			});
}

ReplicaFormatos= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				url : Path+'Componentes/Multiempresa/Sincronizar/ReplicaFormatos.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) { 
					//UpdateReplicaCTFormulaDetalle();// Old
					UpdateReplicaCTFormulaDetalle2(IdConf);// New 13Jun
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>18%<br>Finalizando creaci\u00f3n de empresa...</h3>");			
				}
			});
}

UpdateReplicaCTFormulaDetalle2= function(IdConf){
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateReplicaCTFormulaDetalle2.php',
				data : {Actuar: "SI",Id:IdConf},
				success: function(data) { 
					UpdateMatrizContable(IdConf);	
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>12%<br>Actualizando Matriz contable...</h3>");			
				}
			});
}


UpdateMatrizContable= function(IdConf){
	//alert(IdConf)
	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/UpdateReplicaMatrizContable.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) {
					//EmpresaInsertaMultiSocio(IdConf); 
					jQuery("div#load h3").remove();
				    jQuery("div#load").append("<h3>5%<br>Finalizando</h3>");
				    jQuery("div#load").hide();	
						Respuesta();		
					jQuery('#N500').remove();							
				}
			});
}


 

/*EmpresaInsertaMultiSocio= function(IdConf){

	jQuery.ajax({
				type : 'POST',
				//url : '_modelo/MiEmpresaInserta.php',
				url : Path+'Componentes/Multiempresa/Sincronizar/EmpresaInsertaMultiSocio.php',
				data : {Actuar: "SI",Id:IdConf}, // + "&par1=1&par2=2&par3=232"
				success: function(data) {   
					jQuery("div#load").hide();	
						Respuesta();		
					jQuery('#N500').remove();							
				} 
			});
}*/
//-------------------------FIN REPLICAS------------------------------

	<?php if($_REQUEST['WEB']=="WEB"){ ?>
					
	Respuesta=function(){ 		
		// Cargar(UrlResp);	//Actualiza el listado del index.php
		 //$("#N500").remove();
		 alert("Se realizo con exito la creacion de su empresa")
		 self.close();
		 
	}   
	
	
	BotonEnviar();
	
	<?php
	}else{
	?>
	

	Respuesta=function(){ 		
		 Cargar(UrlResp);	//Actualiza el listado del index.php
		 jQuery("#N500").remove();
		// alert("Echo")
		 
		 
	}
	
	BotonCancel=function(){ 
		 jQuery("#N500").remove();
	}
	<?php }?>
	</script>
	<?php
	
 // require ('../_vista/'.$FileNameM.'Lista.php');		
    //include('../_vista/'.$FileNameM.'Crea.php');
	
	if($_REQUEST['WEB']!="WEB"){
		include('../_vista/MiOrganizacionCrea.php');
	}
	
}

function Modificar($link){
	
	/*include ('../Cx.php');
    $link=Conectarse();*/
	
	global $FileNameM;	
	//include('../Controles/ComboBox/Combos.php'); 
	include('../_modelo/MiOrganizacionConsulta.php');
	include('../Controles/DataTime/Data.php'); 
	
	$VerContenidoC2=MuestraOrganizaC($link);	
	$VerUsuario=MuestraUsuario($link);	
	
	    foreach ($VerUsuario as $indice => $clave){               
              //echo $indice. ' = '.$clave.'<br>';
               $item_n[$indice]= $clave;
	         }

    foreach ($VerContenidoC2 as $indice => $clave){               
              //echo $indice. ' = '.$clave.'<br>';
               $itemn[$indice]= $clave;
	         }
		
   	$condi='Modificar';
	//$soloVer=$_GET['ver'];
	?>
    <script type="text/javascript">
	Path="";
	var UrlCrea= "_modelo/MiOrganizacion.php?Accion=Modifica";	
	var UrlResp="_controlador/<?php echo $FileNameM; ?>C.php?Accion=Listar";	

	BotonEnviar=function(){
		/*var ajx = new Ajax.Request( UrlCrea,{
									method:"post", 
									parameters: Form.serialize($("form")), 									
									onComplete: Respuesta									
		});	*/	
		jQuery.post(UrlCrea, jQuery("#formMO").serialize(),
  			function(data){
				//alert(data);
			 Respuesta();
			 
 			 });
		
		CreaUsuarioAdmin();
	}
	CreaUsuarioAdmin= function(){
		
		var UrlCreaUsu= Path+"Componentes/Multiempresa/Sincronizar/PersonasDesincronizaXOrganizacion.php?Accion=Update";		//Ruta del archivo modelo q realizara el insert
		jQuery.post(UrlCreaUsu, jQuery("#formMO").serialize(),function(Id){
			// InsertaUbicacionMulti(Id);
			 jQuery("div#load h3").remove();
			 jQuery("div#load").append("<h3>92%<br>Creando usuario Super Administrador...</h3>");	
 		});
		
	}
	Respuesta=function(){ 	 
		Cargar(UrlResp);	
		 $('E500').remove();

	}
	
	BotonCancel=function(){ 
		 $('E500').remove();
	}
	</script>
    <?php
	include('../_vista/MiOrganizacionCrea.php');
	 //include('../_vista/'.$FileNameM.'Crea.php');
	//include ('../_vista/CTCentroCostoCrea.php');
}

function Eliminar(){
	
	//include ('../Cx.php');
    //$link=Conectarse();
	//global $FileNameM;
	//include('../_modelo/MiOrganizacion.php');
	include('../Controles/ComboBox/Combos.php');
	//$NumRegCosto=VerificaCCosto2($link,$_GET['Id']);

	?>
	<script type="text/javascript">
jQuery(document).ready(function (){	

 var UrlCrea= "_modelo/MiOrganizacion.php?Accion=Elimina";
 var UrlResp="_controlador/MiOrganizacionC.php?Accion=Listar";
	 
EliminaOrgani=function(IdCC){
     
	 
	 var r = confirm("Se eliminará la organización y sus empresas si es que las tuviese, esta operación es irreversible. ¿Aún asi desea eliminar la organización?");
     //var UrlResp="_controlador/Adm_AlmacenC.php?Accion=Listar";
	 if (r == true)
      {
	  ValidaPermiso('REQ','','','EstDocuEmi');
	  }else{
		 
      }
    /*var NumRegsC='<?php// echo $NumRegCosto; ?>';	
	
	if(NumRegsC>0){
	
	param='IdCC='+IdCC; 
	
	//alert(IdCC);
	Ventana('CCentroC','_vista/ValidaCentroCosto.php','Centro de Costo',param,'post','700px','500px','20px','20px');
	Respuesta(); 
	}else{
	 
	jQuery.post(UrlCrea, { Id:IdCC},
  			function(data){
			
			   Respuesta();
 			 });
	
	}*/
	 
		
	
	/*var ajx = new Ajax.Request( UrlCrea,{
                                        method:"post", 
                                        parameters: 'Id=<?php// echo $_GET['Id'];?>', 
                                        onComplete: Respuesta
    });*/
	
	
	
   }
			 
	Respuesta=function(){ 	 
		Cargar(UrlResp);	
		 $('E500').remove();

	}
			
   });
EliminaOrgani(<?php echo $_GET['Id'];?>);	
    </script>
	<?php
	
}
	
### BUCLE QUE DECIDE QUE FUNCION EJECUTARSE
switch($_GET['Accion']){
case "Listar":
	Listar();
	break;
case "Crear":
	Crear($link);
	break;
case "Modificar":
	Modificar($link);
	break;
case "Eliminar":
	Eliminar();
	break;
	
}	

?>
