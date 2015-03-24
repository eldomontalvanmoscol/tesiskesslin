jQuery(document).ready(function(){	

ClassCtrolTipoCambio = function(){
	
	
	this.IdEmpre;//id de la empresa
	this.Div;//div donde carga el control conta	
	this.ComboSelectTC;//select del tipo de cambio
	this.IdCalendario;//Id del input calendario que verifica la fecha para mostrar TC
	this.Ver;//Solo lectura :0, normal: 1
	this.Intercambio;//si cambia entre contable y administrativo
	this.C_A;//Contable o Administrativo
	this.C_V;//compra :1 ó venta:2
	
		this.CargaTipoCambio=function(IdEmp,SincTipoCambio,DivContenedor,ComboSelectTC,IdCalendario,Ver,Intercambio,C_A,C_V) {	
			
			this.IdEmpre		=(SincTipoCambio=="1")?1:IdEmp;
			this.Div			=DivContenedor;
			this.ComboSelectTC	=ComboSelectTC;	
			this.IdCalendario	=IdCalendario;
			this.Ver			=Ver;
			this.Intercambio	=Intercambio;
			this.C_A			=(C_A==1)?"C":"A";
			this.C_V			=C_V;			
	
			this.InsertaFuncion();							
			this.CreaControl();

			if(IdCalendario!=""){ setTimeout(CmbTC, 300, this.IdEmpre,ComboSelectTC,IdCalendario,Ver)}else{CmbTC(this.IdEmpre,ComboSelectTC,IdCalendario,Ver)}		
			
			
		}
		
		
		CambioTextContaOrAdmin=function(e){	
//		alert(jQuery("#"+e.id).attr('Intercambio'))
			if(jQuery("#"+e.id).attr('Intercambio')==1){
				var val=e.value;			
					if(val=="C"){	NewVal="A";	text="Administrativo";}
					else{			NewVal="C";	text="Contable";	}			
				//alert("Utilizara el tipo de cambio "+text)
				e.value=NewVal;
				
				IdEmpre=jQuery("#"+e.id).attr('IdEmpre');
				ParamFuncion=jQuery("#"+e.id).attr('ParamFuncion');
				IdCalendario=jQuery("#"+e.id).attr('IdCalendario');							
				Ver=jQuery("#"+e.id).attr('Ver');	 
				//alert(ParamFuncion+"-"+IdCalendario+"-"+Ver);
				
				CmbTC(IdEmpre,ParamFuncion,IdCalendario,Ver);	
			}
		}		
			
		this.CreaControl = function() {			
	//	alert("control: "+this.IdCalendario)
			var DivCaja="<input onclick=\"CambioTextContaOrAdmin(this)\" CV=\""+this.C_V+"\" Intercambio=\""+this.Intercambio+"\" IdEmpre=\""+this.IdEmpre+"\" id=\"ContaOrAdminText"+this.ComboSelectTC+"\" name=\"ContaOrAdminText\" Ver=\""+this.Ver+"\" "+
				" IdCalendario=\""+this.IdCalendario+"\" onmouseover=\"Leyenda(this, 'Seleccione el tipo de cambio a usar: Contable(C) o Administrativo(A)');\" type=\"button\" "+
				" class=\"GridTitle\" ParamFuncion=\""+this.ComboSelectTC+"\" style=\"background-color:#25567B;color:#FFF\" value=\""+this.C_A+"\"/>&nbsp;"+
				"<input type=\"hidden\" id=\"ContaOrAdmin"+this.ComboSelectTC+"\" name=\"ContaOrAdmin\" value="+this.C_A+" />"+
				"<input type=\"hidden\" id=\"CompOrVenta"+this.ComboSelectTC+"\"  name=\"CompOrVenta\"  value="+this.C_V+" />"+
				"<span id=\"SpanTC"+this.ComboSelectTC+"\"></span>"+
				"<select onchange=\"InsertaValHidden('ContaOrAdminText"+this.ComboSelectTC+"',this.id,'"+this.ComboSelectTC+"')\" id=\""+this.ComboSelectTC+"\" name=\""+this.ComboSelectTC+"\"  onblur=\"LeyendaFecha(this);\"></select>";
			
			jQuery('#'+this.Div).html(DivCaja);
			
		}
		InsertaValHidden=function(idCA,idCV,ComboSelectTC){
		CA=jQuery("#"+idCA).val();	
		CA=(CA=="C")?1:2;
		
		valCV=jQuery("#"+idCV+" option:selected").text();	
		val=valCV.split(': ');
		CV=(val[0]=="C")?1:2;
		
		jQuery("#ContaOrAdmin"+ComboSelectTC).val(CA);
		jQuery("#CompOrVenta"+ComboSelectTC).val(CV);
			
		//alert(CA+","+CV)	
		
		}
		
		readonly=function(ComboSelectTC,Ver){						
			if(Ver==0){
				jQuery( "#ContaOrAdminText"+ComboSelectTC).attr('disabled','disabled')
				val=jQuery( "#"+ComboSelectTC+" option:selected" ).text()
				jQuery( "#"+ComboSelectTC ).hide()
				jQuery( "#SpanTC"+ComboSelectTC).html('<input type="text" readonly size="10" value="'+val+'" />');
			}
		}

		FechaActual=function(){
				var fecha = new Date (); 
				var anio=fecha.getFullYear();
				var mes= fecha.getMonth() + 1; 
				var dia=fecha.getDate() ;
				var hora=fecha.getHours();
				var minu=fecha.getMinutes();
				var sec=fecha.getSeconds();
				
				mes=(mes<10)?"0"+mes:mes;
				dia=(dia<10)?"0"+dia:dia;				
				
				FechaAct = []
				FechaAct[0]=anio+"-"+mes+"-"+dia;
				FechaAct[1]=anio+"-"+mes+"-"+dia+" "+hora+":"+minu+":"+sec; 
			
			return FechaAct;
		}
	
		CmbTC = function(IdEmpre,ComboSelectTC,IdCalendario,Ver){// ACTUALIZA EL COMBO TIPO CAMBIO, EN BASE A LA FECHA SELECCIONADA Y BOTON DE SELECCION CONTABLE O ADMINISTRATIVO
				
				FechaAct=FechaActual();
				//alert(FechaAct[0])
			
				FechaOperacion=jQuery("#"+IdCalendario).val();
				
//				alert("CbmTC:"+IdCalendario+"->"+FechaOperacion)
				//alert("fechaoper"+FechaOperacion)
				
				//Fecha=((FechaOperacion==null) || (FechaOperacion==""))?"AND FCrea = DATE_FORMAT('"+FechaAct+"', '%Y-%m-%d')":"AND FCrea = DATE_FORMAT('"+FechaOperacion+"', '%Y-%m-%d')";
				Fecha=(FechaOperacion==null)?"AND FCrea = DATE_FORMAT('"+FechaAct[0]+"', '%Y-%m-%d')":"AND FCrea = DATE_FORMAT('"+FechaOperacion+"', '%Y-%m-%d')";
	//			alert(Fecha)
			//	alert(Ver)
							
				var ContaOrAdmin=(jQuery('#ContaOrAdminText'+ComboSelectTC).val()=="C")?1:2;
				jQuery('#ContaOrAdmin'+ComboSelectTC).val(ContaOrAdmin);
						
				var CV=(jQuery('#ContaOrAdminText'+ComboSelectTC).attr('CV')==1)?"asc":"desc";
						
				jQuery('#'+ComboSelectTC).ComboBox({ // COMBO TIPO CAMBIO
							url: "Controles/ComboBox/combo_query.php",
							query: "SELECT MonedaEquivalente,TipoCambio, concat(CASE CompOrVenta WHEN '1' THEN 'C' WHEN '2' THEN 'V' END,': ', TipoCambio) AS TipoCambiox"+
								   " FROM tipo_moneda_cambio WHERE ContaOrAdmin = '"+ContaOrAdmin+"'  "+Fecha+" AND IdMiEmpresa='"+IdEmpre+"' order by CompOrVenta "+CV,	
							atribts: {"val": "TipoCambio", "txt": "TipoCambiox"},
							defecto: "0", 
							editado: "",
							enable: 1, // 0: deshabilitado - 1: habilitado
							funcion: "", // funcion que se ejecuta al hacer onchange
							trigger: "0" //lanza onchange al cargar la pagina	
						});//END COMBOBOX		
						
				VerificaExistTC(IdEmpre,ComboSelectTC,IdCalendario,Ver);	
				readonly(ComboSelectTC,Ver);
				InsertaValHidden('ContaOrAdminText'+ComboSelectTC,ComboSelectTC,ComboSelectTC);
		}
		
		ValidaPeriodoX=function(e,IdEmpre,ComboSelectTC,Ver){
			
			FechaAct=FechaActual();			
			var FechaOPM = e.value.split('-');
			//alert(FechaOPM[0]+'-'+FechaOPM[1] )

			jQuery.post("Class/ValidaPeriodo.php", { anio:FechaOPM[0],mes:FechaOPM[1],IdMod:11},
	        	 function(data){
					//alert(data)
						if(data==1){
								alert("Lo sentimos pero no puede continuar con este proceso ya que el periodo contable est\xe1 cerrado.\nCambie "+
										"la fecha de la operación o contactese con el super admin para desbloquear el periodo contable.");
								
								jQuery("#"+e.id).val(FechaAct[1]);
						alert(jQuery("#"+e.id).val())
						}else if(data=="N"){
								alert("Lo sentimos pero no puede continuar con este proceso ya que el periodo contable '"+FechaOPM[1]+"-"+FechaOPM[0]+"' no est\xe1 aperturado.");
								jQuery("#"+e.id).val(FechaAct[1]);
						alert(jQuery("#"+e.id).val())
						}
		  			CmbTC(IdEmpre,ComboSelectTC,e.id,Ver);
		 		});
	
		
		
		}
		
		this.InsertaFuncion=function(){
			if(this.IdCalendario!=""){
			jQuery("#"+this.IdCalendario).attr('onchange',"ValidaPeriodoX(this,'"+this.IdEmpre+"','"+this.ComboSelectTC+"','"+this.Ver+"')");
			}
		}
		
		VerificaExistTC=function(IdEmpre,ComboSelectTC,IdCalendario,Ver){
			FechaAct=FechaActual();	
			var Val = jQuery('#'+ComboSelectTC).val();
		//	alert("Val:"+Val)
			if(Val == null){
				alert("No hay tipo de cambio para esta fecha")
				jQuery("#"+IdCalendario).val(FechaAct[1]);
				CmbTC(IdEmpre,ComboSelectTC,IdCalendario,Ver);
			}
			
		}



	}

})