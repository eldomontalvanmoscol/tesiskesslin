

	Nuevo=function(){		
		if(UrlControlador==null){
			alert('Para crear un nuevo documento, debe abrir ante el modulo respectivo')
		}else{		
			UrlNuevo=UrlControlador+"?Accion=Crear";			
			Ventana('N500',UrlNuevo,titulo,'','post',W_ancho,H_altura,'0px','0px');
		 }
    }
    
    Editar=function(){		
        if(IdLista==null){
           alert('Para editar debe seleccionar un registro del modulo de '+titulo)
        }
        else{
            js_modulo = "ff"; js_est_ope = "ok";
            if(js_modulo == "mensajeria" && js_est_ope == "failed"){
                alert("No es posible modificar un mensaje");
            }
            else{			
					UrlNuevo=UrlControlador+"?Accion=Modificar&Id="+IdLista;
					Ventana('E500',UrlNuevo,titulo,'','post',W_ancho,H_altura,'0px','0px');
            	}
        }
    }
    
   Ver=function(){		
        if(IdLista==null){alert('Para editar debe seleccionar un registro del modulo de '+titulo)}else{
            UrlModif=UrlControlador+"?Accion=Ver&Id="+IdLista;	
			Ventana(501,UrlModif,titulo,'','post',W_ancho,H_altura,'0px','100px');
        }
    }
    
    Aprobar=function(){
    	if(IdLista==null){alert('Para aprobar debe seleccionar un registro del modulo de '+titulo)}else{
			UrlModif=UrlControlador+"?Accion=Aprobar&Id="+IdLista;
			
			res=confirm('Está seguro de que desea aprobar este registro?');
			if (res==true){
                new Ajax.Updater(aDiv,UrlModif,{
					 evalScripts:true, 
					 method:'get'
					 });
			}				
        }
    }

  Bloquear=function(){
        if(IdLista==null){alert('Para bloquear debe seleccionar un registro del modulo de '+titulo)}else{
        UrlModif=UrlControlador+"?Accion=Eliminar&Id="+IdLista;
        //alert("eliminara: "+IdLista);	  
            Dialog.confirm("<B>BLOQUEAR</B><BR><BR>Está seguro de bloquear el registro nro: "+IdLista+"?", {
            className: "bluelighting",
            width:300, 
            okLabel: "Eliminar", 
            cancelLabel:"Cancelar",
            cancel:function(win) {debug("cancel confirm panel")}, 
            ok:function(win) {AceptoBloquear()
            ; return true;} });
            
            function AceptoBloquear(){
            //new Ajax.Updater(aDiv,UrlModif,{evalScripts:true, method:'get'}); return false;
            }
        }
    }	
		
    function Imprimir(){
		//alert(FlagVC);
		
		if(TipoLic==0){
			BloqueaSkynet('_vista/MsnFree.php');
		}else{			
        if(IdLista==null){
			alert('Para imprimir debe seleccionar un registro del modulo de '+aloha);
		}else{			
            switch (TipoDoc) {
				case 1: if(FlagVC=='c'){ var NomDoc='FacturaCompra.php';}
						else{ var NomDoc='Factura.php';}
				   		break
				case 2: if(FlagVC==''){ var NomDoc='ReciboXHonorario.php';}
				  		break						
				case 3: if(FlagVC=='c'){ var NomDoc='BoletaCompra.php';}
						else{  var NomDoc='Boleta.php';}
				  		break
				case 7: if(FlagVC=='c'){ var NomDoc='NotaCreditoCompra.php';}
						else{  var NomDoc='NotaCredito.php';}
				        break
				case 8: if(FlagVC=='c'){ var NomDoc='NotaDebitoCompra.php';}
						else{  var NomDoc='NotaDebito.php';}
				        break
				case 9:
				   var NomDoc='GuiaRemision.php'
				   break
				case 13:
				   //var NomDoc='Cotizacion.php'
				   var NomDoc='pdf.php'
				   break			   
				case 14:
				  // var NomDoc='OrdenCompra.php'
				   var NomDoc='pdf.php'
				   break
				case 16:// Guia de Salida
				  var NomDoc='pdf.php'
				  //var NomDoc='GuiaSalida.php'
				   break
				case 17:// Guia de Ingreso
				   var NomDoc='pdf.php'
				   //var NomDoc='GuiaIngreso.php'
				   break

				case 18: 
				if(FlagVC=='c'){ var NomDoc='ReciboInterno.php';}
				else{  var NomDoc='ReciboInterno.php';}
						 
						 // alert()
						  
				break
						 
				/*case 21:
				   var NomDoc='Letra.php'
				   break*/
				case 21:// Letra de cambio
				   var NomDoc='pdf.php'
				   //var NomDoc='Letra.php'
				   break   
				   
				case 22:
				   var NomDoc='Cheque.php'
				   break
				case 23:
				   var NomDoc='pdf.php'
				   break
				case 24:
				   var NomDoc='OrdenProduccion.php'
				   break
				case 26:
				   var NomDoc='Percepcion.php'			  
				   break
				case 27: 
				   var NomDoc='TicketsCotizacion.php';
			  		break
				/*case 28:
				   var NomDoc='FacturaCompra.php'			  
				   break
				case 29:
				   var NomDoc='BoletaCompra.php'			  
				   break
				case 30:
				   var NomDoc='ReciboInternoCompra.php'			  
				   break*/
				 case 40:
				   var NomDoc='Retencion.php'			  
				   break
				 case 41:
				   var NomDoc='ContratoTrabajadores.php'			  
				   break
				 case 49:
				 	var NomDoc='OrdTrabajo.php'	
				 	break	
				 case 50:
				 	var NomDoc='Presupuesto.php'	
				 	break
				 case 51:
				 	var NomDoc='ActivosFijos.php'	
				 	break
				case 121:// ReciboInterno
				   var NomDoc='pdf.php'
				   
				   //alert()
				   //var NomDoc='ReciboInterno.php'
				   break	
				   
				case 90:// Letra de cambio
				   var NomDoc='pdf.php'
				   //var NomDoc='Letra.php'
				   break   
				   
				/*case 121: if(FlagVC=='c'){ var NomDoc='ReciboInterno.php';}
						 else{  var NomDoc='ReciboInterno.php';}
				   		 break*/
				/*case 21:
				   var NomDoc='Letra.php'
				   break*/			   
				default:
				   var NomDoc='Factura.php'				   
            }
			   
			//alert('Id= '+IdLista+' TipoDoc='+TipoDoc+'FlagVC='+FlagVC);     
			if(NomDoc=='pdf.php'){// IMPRIMIR EN PDF
			//TipoDoc = 14;
			/*alert(IdLista);
			alert(TipoDoc);*/
	
				jQuery.getJSON("p/CifrarIdDoc.php", { IdLista: IdLista, Request: "Cifrar", TipoDoc: TipoDoc},
				  function(data){
					  UrlDoc='p/?d='+data.Td+'and'+data.Id+'and'+FlagVC;
					  var especificaciones="top=0,left=0,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no, width=900,height=600";
					  var titulo="Comprobantes";					  
					  window.open(UrlDoc,titulo,especificaciones);
				 });	

			}else{// IMPRESION CLASICA
				UrlDoc='Componentes/Print/'+NomDoc+'?Id='+IdLista+'&TipoDoc='+TipoDoc+'&Flag='+FlagVC;	
				var especificaciones="top=0,left=0,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no, width=900,height=600";
				var titulo="Comprobantes";
				window.open(UrlDoc,titulo,especificaciones);
			}    
        			
            
        }
		}
    }	//TERMINA IMPRIMIR
	
	LlamarAnulaDocumento=function(Bolean){		
	//alert('num '+Bolean);
		if(Bolean==0){			
			//var W = 300;
			//var H = 100;
			//var x = (screen.width-W)/2;	
			//var y = (screen.availHeight-H)/4;
			
			UrlAnula="_controlador/AnularDocumentoC.php?Accion=Crear&Id="+IdLista+"&TipoDoc="+TipoDoc+"&IdGuiaRel="+IdGuiaRel+"&NombreDoc="+NombreDoc+"&UrlControlador="+UrlControlador;
			var param='';
			//alert(UrlAnula);
			$('Bloqueo').toggle();
			var myAjax = new Ajax.Updater( 'Bloqueo', UrlAnula, { evalScripts:true, method: 'get', parameters: param });
	
		}else{//Fin if
			alert("El Documento seleccionado no puede anularse ya que fue usado por otro documento");		
		}
	}
	
	 Eliminar=function(){
		if(IdLista==null){alert('Para eliminar debe seleccionar un registro del modulo de '+titulo)}
		else{
			
			if(NomGd=='Ctza' || NomGd=='OCompra' || NomGd=='ORequisicion' || NomGd=='PVenta' || NomGd=='CCompra' || NomGd=='Prpto' || NomGd=='OrdTrab' || NomGd=='OrdProdL')
			{
				if(Estado!='Anulado')
				{
					alert("Para eliminar este documento antes debe anular");
				}
				else{
					
					
						
						
					UrlModif=UrlControlador+"?Accion=Eliminar&Id="+IdLista;
					res=confirm('¿Está seguro de que desea eliminar este registro?');
					if (res==true){
					   new Ajax.Updater(aDiv,UrlModif,{
						   evalScripts:true, 
						   method:'get'
						   }); 
						   return false;
					}
				}
			}

			else
			{
				UrlModif=UrlControlador+"?Accion=Eliminar&Id="+IdLista;
				res=confirm('¿Está seguro de que desea eliminar este registro?');
				if (res==true){
				   new Ajax.Updater(aDiv,UrlModif,{
					   evalScripts:true, 
					   method:'get'
					   }); 
					   return false;
				}
			}
	    }
    }
	 
	
	
    function Anular(){	
			
		
		if(IdLista==null){
			alert('Para anular el registro debe seleccionarlo antes del modulo de '+titulo)
		}else{
			
			// PRODUCCIÓN
			if(TipoDoc == '24'){
				if(Estado=='Fabricando' || Estado=='Culminado' || Estado=='Parte Producción' || Estado=='Entregado' || Estado=='Anulado'){
					if(Estado=='Anulado'){
						alert("El Documento ya está Anulado");
					}else{
						alert("No puede anular un documento en estado "+Estado);
					}
				}else if(Estado=='Solicitud-RR'){
					if(NivelP == 'S2' || NivelP == 'S1' || NivelP == 'S0'){
						LlamarAnulaDocumento(0);
					}else{
						alert("Usted no tiene el nivel de permiso requerido para anular este documento");
					}
				
				}else{
					LlamarAnulaDocumento(0);
				}					
				
				
			}else{
				
			
			//yo richard modifique de este hasta
				//modulo finanzas(cheques)
				if(Estado=='Activo')
				{
					LlamarAnulaDocumento(0);
					return;
				}
				
				
				
				
			//aqui
				if(Estado=='Aprobado' || Estado=='Emitido' || Estado=='Pagando' || Estado=='Cobrando' || Estado=='Atendido' || Estado=='Visado' ||Estado=='Despachado' || Estado=='Facturado' || Estado=='Orden de trabajo' || Estado=='Reservado'){	
				
					//Revisa si una Cotizacion Aprobada ha sido usado por una GuiaSalida ó Comprob. venta
					if(TipoDoc==13 && (Estado=='Aprobado' || Estado=='Despachado' || Estado=='Facturado' || Estado=='Atendido')){
						if(Estado=='Aprobado'){
							var urlRevisaGuiaSalComprb="Class/urlRevisaDocRelacion.php?Accion=urlRevisaCotizacion";
							var params="IdCotizacion="+IdLista+"&AbreViatura=CZ";
							var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaGuiaSalComprb,{	
												method		:'post',
												parameters	: params,
												onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnCotiZaX'))}
												});
						}else{
							
							LlamarAnulaDocumento(1);
						}					
					}else if(TipoDoc==49){//mig
						if(Estado=='Aprobado'){//para relacionar mas adelante
							LlamarAnulaDocumento(0);
						}else{
							LlamarAnulaDocumento(0);
						}
						
					}else if(TipoDoc==50 && Estado=='Orden de trabajo'){//mig
						if(Estado=='Orden de trabajo'){
							var urlRevisaGuiaSalComprb="Class/urlRevisaDocRelacion.php?Accion=urlRevisaOrdenTrabajo";
							var params="IdPresupuesto="+IdLista;
							var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaGuiaSalComprb,{	
												method		:'post',
												parameters	: params,
												onComplete	: function(){LlamarAnulaDocumento($F('HBoleOrdTrab'))}
												});
							
						}else{
							LlamarAnulaDocumento(1);
						}
						//alert('aprobado '+IdLista);
					}else{
						//Revisa si una Orden de Compra Aprobada ha sido usado por una GuiaIngreso ó Comprob. Compra
						if(TipoDoc==14 && Estado=='Aprobado'){				
							var urlRevisaGuiaIngComprb="Class/urlRevisaDocRelacion.php?Accion=urlRevisaOrdenCompra";
							var params="IdOrdenCompra="+IdLista+"&AbreViatura=OC";
							var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaGuiaIngComprb,{	
													method		:'post',
													parameters	: params,
													onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnCotiZaX'))}
													});
						}else{
							
							//ANTES Estaba envez del 121 - > 18 - RI
							if((TipoDoc==1 || TipoDoc==3 || TipoDoc==121)&& (Estado=='Aprobado') && (ModComVen==1)){				
							
								
								 jQuery.post("Class/urlRevisaDocRelacion.php?Accion=urlRevisaPerioCont", { Fecha:Fecha},
										function(data){
											//var datee = data.split("-");
											
											
											if(data==1){
											alert("Lo sentimos pero no puede continuar con este proceso ya que el periodo contable est\xe1 cerrado.\nCambie la fecha de la emisi\xf3n o contactese con el super admin para desbloquear el periodo contable.");
											
											}else{
										///////
										
									
										var urlRevisaComprb="Class/urlRevisaDocRelacion.php?Accion=urlRevisaComprabanteVentaAmortiz";
								var params="IdComprobante="+IdLista+"";
								var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaComprb,{	
														method		:'post',
														parameters	: params,
														onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnComproBVenTa'))}
														});		
										
										
										//////////
										 }
											
										});
								
											
							}else{	
								
								if((TipoDoc==1 || TipoDoc==3 || TipoDoc==121 || TipoDoc==2)&& (Estado=='Aprobado') && (ModComVen==2)){				
							
		
								jQuery.post("Class/urlRevisaDocRelacion.php?Accion=urlRevisaPerioCont", { Fecha:Fecha},
										function(data){
											if(data==1){
											alert("Lo sentimos pero no puede continuar con este proceso ya que el periodo contable est\xe1 cerrado.\nCambie la fecha de la emisi\xf3n o contactese con el super admin para desbloquear el periodo contable.");
											
											 }else{
								
								
								var urlRevisaComprb="Class/urlRevisaDocRelacion.php?Accion=urlRevisaComprobanteCompraAmortiz";
								var params="IdComprobante="+IdLista+"";
								var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaComprb,{	
														method		:'post',
														parameters	: params,
														onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnComproBComTa'))}
														});		
														//alert(ModComVen+'compra')	
											 }
							  			  });	
							 
							 	}else{	
							
							
							
								//Revisa si una Orden de Produccion Aprobada ha sido usado por una GuiaSalida ó Comprob. venta						
								if(TipoDoc==24242424 && Estado=='Aprobado'){
									var urlRevisaNose="Class/urlRevisaDocRelacion.php?Accion=urlRevisaCotizacion";
									var params="IdCotizacion="+IdLista+"&AbreViatura=CZ";
									var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaNose,{	
															method		:'post',
															parameters	: params,
															onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnCotiZaX'))}
															});					
								}else{		
									if(TipoDoc==16 && Estado=='Aprobado'){	//para anular guia de salida de almacen
										var urlRevisaNose="Class/urlRevisaDocRelacion.php?Accion=GuiaAlmacen";
										var params="IdGuia="+IdLista+"&AbreViatura=GA";
										var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaNose,{	
															method		:'post',
															parameters	: params,
															onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnGuiaAlm'))}
															});			
									}else{
										if(TipoDoc==17 && Estado=='Aprobado'){	//para anular guia de salida de almacen
											var urlRevisaNose="Class/urlRevisaDocRelacion.php?Accion=GuiaAlmacen";
											var params="IdGuia="+IdLista+"&AbreViatura=GA";
											var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaNose,{	
															method		:'post',
															parameters	: params,
															onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnGuiaAlm'))}
															});			
										}else{	
											
										   if((TipoDoc==7 || TipoDoc==8) && (Estado=='Aprobado') && ModComVen==1){	//6Y7-->7Y8
										   		//alert(IdLista);
												ValidaDocAnular();
										   }else{
											   if((TipoDoc==7 || TipoDoc==8) && (Estado=='Aprobado') && ModComVen==2){	//6Y7-->7Y8  de compras
										   		//alert(IdLista);
												var urlRevisaNota="Class/urlRevisaDocRelacion.php?Accion=urlRevisaNotasCreDeCompraAmortiz";
												var params="IdComprobante="+IdLista;
												var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaNota,{	
														method		:'post',
														parameters	: params,
														onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnNotasCDComTa'))}
														});	
														
											   }else{
													if((TipoDoc==21 || TipoDoc==90) && (Estado=='Pagando' || Estado=='Cobrando')){
														LlamarAnulaDocumento(1);
													}else if((TipoDoc==21 || TipoDoc==90) && Estado=='Aprobado'){
														var urlRevisaNose="Class/urlRevisaDocRelacion.php?Accion=LetrasCambio";
														var params='IdLista='+IdLista+'&TipoDoc='+TipoDoc;
														//alert(params);
														var ajx=new Ajax.Updater("DivRevisaDocRelacion",urlRevisaNose,{	
																method		:'post',
																parameters	: params,
																onComplete	: function(){LlamarAnulaDocumento($F('HBoleAnLetraCambio'))}
																});	
													}else{
														//anulando orden de requisicion
													  	if(TipoDoc==23 &&(Estado=='Emitido' || Estado=='Atendido' || Estado=='Aprobado' || Estado=='Visado' || Estado=='Reservado') )
													  	{
														  	if(Estado=='Atendido'){
																alert('El Documento no puede anularse ya que está siendo usado por otro documento.\nElimine la relación por medio de la opción "Documentos relacionados", con click derecho.');
																//LlamarAnulaDocumento(1);
															}
															else{LlamarAnulaDocumento(0);}
													  	}else{
															//alert("Anulando");
															LlamarAnulaDocumento(0);
													  	}
													}
											   
											   
											   /*if((TipoDoc==35 || TipoDoc==36) && (Estado=='Aprobado')){
												   ValidaDocAnular();
												  }else{*/
											         //LlamarAnulaDocumento(0);
												 /* }*/
											   }//fin 7-8 tipo compra
											}	//fin 7-8	tipo venta											
										}	//fin 17
									}	//fin 16
								}		//fin 24242424
								}	//fin 1 3 18 compra
							}		//fin 1 3 18 venta
						}		//fin 14
					}//Fin else		13		
				}else{			//fin aprobado
					
					alert("El Documento ya está Anulado");
				}//Fin else	
		
	   		}// END PRODUCCIÓN		
       }//Fin if
	   
	
	  
		   
		   
    }//end funtion
	
	//FUNCIONES NUEVAS DE ANULACION 2.0.0
	ValidaDocAnular=function(){	//Validamos si este documento a sido usado por otro, o a generado alguna operacion
		
		//alert("va a validar");
		var param="Id="+IdLista+"&TipoDoc="+TipoDoc;
		var Url="Class/AnulaDocumentos/ValidarDocAnular.php";
		var ajx = new Ajax.Updater('ProcesosVarios',Url,{
								method:"post", 
								parameters:param,
								evalScripts:true                                                    
            });			
			
		//estos valores lo debe retornar el archivo externo	
		//var ResultadoValida='';
		//EjecutaAnulacion(ResultadoValida);
	}
	
	EjecutaAnulacion=function(Nulo){
		
		if(Nulo==0){
		BloqueaSkynet('Class/AnulaDocumentos/AnularDocForm.php?Id='+IdLista+'&Tipo='+TipoDoc+'&UrlControlador='+UrlControlador);
		}else{
		alert('No se puede anular un documento que dio origen a alguna transacción o a un nuevo documento');
		}		
	}
    
	
	/*ValidaPeriodoC=function(fecha){
		
			alert("asas");
			var url='Class/urlRevisaDocRelacion.php?Accion=urlRevisaPerioCont';
			var resppc = '';
		   
		 
			
			 jQuery.ajax({
						url: url,
						type: 'POST',
						data: 'Fecha='+fecha,
						dataType: 'Script',
						async: false,
						success: function(data){		
								//alert(data);
								resppc = data;
						}
		     	});
		     
			  return resppc;

	}*/
	