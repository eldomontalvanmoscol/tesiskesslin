<?php
session_start();
include('Config.php');

#VARIABLES DEL SISTEMA
	$_SESSION['Idioma'] 			= 'la_es';							//Idioma del sistema

	#CONFIGURACION GENERAL			
	$_SESSION['NomMiEmpresa']		= 'EMPRESA DEMO S.A.C.';		//Razon Social 		
	$_SESSION['ConfG_RUC']			= '12345678910';				//RUC
	$_SESSION['ConfG_IniActiv']		= '2010-03-27 00:00:00';	//'2009-05-03';Inicio de Actividades
	$_SESSION['ConfG_Dir']			= 'Av. Circunvalación 3456 - Urb. Villa Jardín, San Luis. Lima Perú';		//Direccion
	$_SESSION['ConfG_Telef']		= '4374125 / 981413935';		//Telefono
	$_SESSION['ConfG_Email']		= 'email@dominio.com';			//Email
	$_SESSION['ConfG_PagWeb']		= 'http://www.skyneterp.com';				//Pagina Web
	$_SESSION['ConfG_RutaRelativaS']= 'erp508/';			//Ruta del Directorio del Sistema
	$_SESSION['ConfG_RutaRelativaW']= 'web/';			//Ruta del Directorio Web
	$_SESSION['UpdateComprueba']	= '1';	//Comprobación automática de actualizaciones
	
	#PERSONALIZACION
	$_SESSION['Per_Logo']			= 'Logo.gif';				//Nombre del archivo Logo 
	$_SESSION['Per_ImprLogoDatos']	= '1';		//Imprimir logo y datos de empresa en los documentos
	$_SESSION['Per_NumRegsSearch']	= '20';	//Número de registros por search
	$_SESSION['Per_NumRegsList']	= '20';		//Número de registros en listado de ventanas emergentes	
	$_SESSION['Per_NumRegsDoc']		= '20';		//Número de registros de items	
	$_SESSION['Per_MonNacional']	= '1';		//Define Moneda Nacional
	$_SESSION['Per_MonDefecto']		= '1';	//Define Moneda por Defecto 
	$_SESSION['Per_MonTipoCambio']	= '2';		//Define Moneda Tipo de Cambio
	
	#COMPORTAMIENTOS
	#Actividad Predominante
	$_SESSION['VendedorLibre']				='1';			//En ventas, desea asignar vendedores arbitrariamente?
	$_SESSION['Actividad']					='0';				//Seleccionar Actividad Predominante
	$_SESSION['Ayuda']						='';					//Ayuda intercativa	
	$_SESSION['Comp_CotSinPrecioVent']		= '1';		//¿Desea cotizar sin tener precio de venta?
	$_SESSION['Cotiz_Bloquea_Aprobacion']	= '0';			//Bloquea la aprobación de una cotización si no tien stock 
	$_SESSION['Comp_Update_PrecioV']		= '1';		//Actualizar precios de venta si se modifica el tipo de cambio
	$_SESSION['Comp_Update_PrecioV_VC']		= '1';		//Actualizar precios de venta si se modifica el valor de compra
	$_SESSION['Comp_TipoDescCotFact']		= '1';				//Desea asignar descuento en ventas	
	$_SESSION['Comp_TipoDescTPV']			= '1';			//Tipo de descuento a otorgar en TPV 
	$_SESSION['Comp_ListaPrecTPV']			= '1';		//¿Desea manejar lista de precios en TPV? 
	$_SESSION['Comp_PrecVentProdEdit']		= '1';		//¿Desea que el precio de venta de sus productos sea editable? 
	$_SESSION['Comp_DescripProdEdit']		= '1';			//¿Desea que la descripción de sus productos sea editable ? 
	$_SESSION['Comp_ListaPrecCli']			= '1';	//¿Desea asignar una lista de precios a un Cliente? 
	$_SESSION['Comp_IncIGVPrecVent']		= '1';			//¿Desea mostrar una columna con el IGV en el valor de venta? 
	$_SESSION['ConfirmaTpv']				= '1';			//Confirmación antes de procesar una venta en TPV
		
	#TRIBUTACION
	//Institución Administradora de Tributos
	$_SESSION['Trib_Nombre']				= 'SUNAT';				//Nombre entidad tributaria 
	$_SESSION['Trib_Web']					= 'www.sunat.org.pe';				//Página Web 
	$_SESSION['Trib_ConfirDatosEmpresa']	= 'http://www.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias';		//UrlConsultaSunat
	$_SESSION['Trib_WebTipoCambio']			= 'http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias';		//Url de tipo de cambio
	
	//Impuestos
	$_SESSION['Trib_Pais']					= '174';					//Pais 
	$_SESSION['Trib_DocNacIden']			= 'DNI';				//Denominación del Doc. Nacional de Identidad 
	$_SESSION['Trib_NumContrib']			= 'RUC';				//Denominación del N° de Contribuyente 
	$_SESSION['Trib_NombreImp']				= 'IGV';			//Nombre del Impuesto 
	$_SESSION['Trib_Porcentaje']			= '18';	//Porcentaje Agravado 
	$_SESSION['MontoAfectReten4ta']			= '1500';	//Agente a retencion mayoes al monto configurado reta de 4ta.
	$_SESSION['MontoAfectRetenIgv']			= '700';	//Agente a retencion mayoes al monto configurado renta a Igv.
	$_SESSION['Trib_Agente_Retencion']		= '0';		//Agente retencion. 
	$_SESSION['Trib_Agente_Percepcion']		= '0';		//Agente percepcion. 
	$_SESSION['Trib_ITF']					= '0.005';					//Impuesto a las Transacciones Financieras 
	$_SESSION['UIT']					= '3700.00';					//Unidad impositiva tributaria
	  
	#FINANZAS
	//Centro de Costos   
	$_SESSION['Fin_CentCostVent']			= '153';				//Centro de Costos para Ventas 
	$_SESSION['Fin_CentCostComp']			= '24';			//Centro de Costos para Compras
	$_SESSION['Fin_CentCostBanc']			= '151';				//Centro de Costos Banco 
	//Motivos de Operación  
	$_SESSION['Fin_MotOpe_Vent']			= '43';				//Para Ventas 
	$_SESSION['Fin_MotOpe_PuntVent']		= '37';				//Para Punto de Venta	
	$_SESSION['Fin_MotOpe_Comp']			= '38';			//Para Compras
	$_SESSION['Fin_MotOpe_BancoITF']		= '38';				//De Banco(ITF) PPBancos
	$_SESSION['Fin_MotOpe_RetDin_Vuelt']	= '44';				//De Retorno Dinero (vuelto)
	$_SESSION['Fin_MotOpe_RetDin_Devol']	= '37';				//De Retorno Dinero (Devoluciones)
	$_SESSION['Fin_MotOpe_CajaBanc_Apert']	= '43';			//De Caja/Banco (apertura)	
	
	
	#DECIMALES DOCUMENTOS
	$_SESSION['DecFactura']					= '2';			//Decimales Facturas
	$_SESSION['DecBoleta']					= '2';			//Decimales Boletas
	$_SESSION['DecNotaC']					= '2';				//Decimales Notas de crédito
	$_SESSION['DecNotaD']					= '3';				//Decimales Notas de débito
	$_SESSION['DecGuiaR']					= '3';				//Decimales guías de remisión
	$_SESSION['DecCotiza']					= '2';			//Decimales cotizaciones
	$_SESSION['DecOrdenC']					= '2';			//Decimales ordenes de compra
	$_SESSION['DecGuiaI']					= '3';				//Decimales Guias de ingreso de almacen
	$_SESSION['DecGuiaS']					= '3';				//Decimales Guias de salida de almacen
	$_SESSION['DecRecibo']					= '2';			//Decimales Recibo interno	
	$_SESSION['DecLetra']					= '3';				//Decimales Letras
	$_SESSION['DecCheque']					= '3';			//Decimales Cheques
	$_SESSION['DecRequisicion']				= '3';		//Decimales Requisiciones
	$_SESSION['DecProduccion']				= '3';		//Decimales Ordenes de Produccion
	$_SESSION['DecOrdenP']					= '3';			//Decimales Orden de pedido de almacen
	$_SESSION['DecPercepcion']				= '3';		//Decimales Percepciones
	$_SESSION['DecPreventa']				= '3';			//Decimales Preventa	
	$_SESSION['DecKardex']					= '3';			//Decimales kardex
	$_SESSION['EstiloDoc']					= '0';			//Estilo de Impresion de Documento
	
	#SISTEMAS
	$_SESSION['Maes_CampoProductos'] 		= 'IdProducto';			//CAMPO A ORDENAR		
	$_SESSION['Maes_AscDescProductos'] 		= '1';			//FORMA DE ORDENAMIENTO	
	$_SESSION['BuscarPor'] 					= 'Nombre';			//BUSCAR POR
	$_SESSION['BuscarPorRS_RUC'] 			= 'RS';		//BUSCAR SOCIOS DE NEGOCIO POR RAZON SOCIAL O RUC
	$_SESSION['ClienteDB'] 					= '../phpMyAdmin/index.php';			//URL DEL CLIENTE DE BASE DE DATOS: phpmyadmin	
	$_SESSION['SeparadorMiles'] 			= ',';			//SEPARADOR DE MILES (',','.',ETC)	
	
	############################################################################################
	#SEGURIDAD
	$_SESSION['Seg_Copia']					= 'Automatico';							//Copia de Seguridad	
	$_SESSION['Seg_backup']					= 0;									//Restauración del sistema
	############################################################################################

?>
