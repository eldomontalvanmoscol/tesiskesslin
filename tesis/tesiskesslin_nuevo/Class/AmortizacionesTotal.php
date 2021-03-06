<?php
session_start();
include ('../Cx.php');
$link=Conectarse();	
//VARIABLE TC ALMACENA LA VARIABLES DE SESSION $_SESSION['TCambioV'], PARA USAR OTRO VALOR MODIFICAR ESTA VARIABLE.

function TopTotalAmortizaC($link,$IdCtaCobrar,$IdMonedaCta){	//FUNCION2012*

$ImporAmort="SELECT ROUND(( 
IFNULL((SELECT SUM(d1.Importe*IF(ctas_cobrar.IdTipoMoneda=d1.IdMoneda,1,if(d1.IdMoneda=1,1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=1 and CompOrVenta=2),(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=1 and CompOrVenta=1) ) )) FROM fin_caja_banco_oper_det d1 where d1.TipoOperacion='Ingreso' and d1.IdCta=ctas_cobrar.IdCtaCobrar and d1.DocSerieDocumento=ctas_cobrar.Serie and d1.DocNroDocumento=ctas_cobrar.NumDoc and d1.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_cobrar.TipoDoc) and d1.IdMiEmpresa=".$_SESSION['IdMiEmpresa']."),0) 
- IFNULL((SELECT SUM(x.Importe*IF(ctas_cobrar.IdTipoMoneda=x.IdMoneda,1,if(x.IdMoneda=1,
1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=1 and CompOrVenta=2),
(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=1 and CompOrVenta=1)
 ) ) )
FROM fin_caja_banco_oper y, fin_caja_banco_oper_det x where y.IdOperacion=x.IdOperacion and x.TipoOperacion='Egreso' and x.IdCta=ctas_cobrar.IdCtaCobrar and x.DocSerieDocumento=ctas_cobrar.Serie and x.DocNroDocumento=ctas_cobrar.NumDoc and x.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_cobrar.TipoDoc) and x.IdMiEmpresa='".$_SESSION['IdMiEmpresa']."'),0) ),2) AS Saldototal 
FROM ctas_cobrar WHERE IdCtaCobrar='".$IdCtaCobrar."' AND (EstadoDoc='Pendiente' OR EstadoDoc='Cancelado') AND IdMiSede='".$_SESSION['IdMiSede']."' AND IdMiEmpresa='".$_SESSION['IdMiEmpresa']."' ";
	
	$resp2 = mysqli_query($link,$ImporAmort);
	$items2 = $resp2->fetch_object();	
	$TopPrecio=round($items2->Saldototal,4);
	
	$ImportAmort2="SELECT Monto,Moneda,date_format(FCrea,'%Y-%m-%d')AS FCrea  FROM ctas_amortizaciones WHERE IdCtaCobrar=".$IdCtaCobrar." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa']."";
	$Query2S=mysqli_query($link,$ImportAmort2);
	$Query2D=mysqli_query($link,$ImportAmort2);
	$sumaAmort=0;
	
	if($IdMonedaCta==1){			//cuenta en soles
			while($ItemOpe2S=$Query2S->fetch_object()){
			$Moneda=$ItemOpe2S->Moneda;
					if($Moneda==1){
						$sumaAmort+= round($ItemOpe2S->Monto,4);
					}else{
						if($Moneda==2){
							$TipoCambio=tipodecambio($link,2,$ItemOpe2S->FCrea);
							$aux= round($ItemOpe2S->Monto,4)*$TipoCambio;
							$sumaAmort+= round($aux,4);
						}
					}
			}
	}else{
		
		if($IdMonedaCta==2){			//cuenta en dolares
			while($ItemOpe2D=$Query2D->fetch_object()){
			$Moneda=$ItemOpe2D->Moneda;
					if($Moneda==1){					//moneda de operacion en soles --transforma tipocambio
							$TipoCambio=tipodecambio($link,2,$ItemOpe2D->FCrea);
							$aux= round($ItemOpe2D->Monto,4)/$TipoCambio;
							$sumaAmort+= round($aux,4);
						
					}else{
						if($Moneda==2){
							$sumaAmort+= round($ItemOpe2D->Monto,4);
						}
					}
			}
	}
	}
	
	$TopAmort=round($sumaAmort,4);
	return round($TopPrecio+$TopAmort,4);	
}

function tipodecambio($link,$idmoneda,$fecha){		//obtiene el tipo de cambio compra, acminitrativo
$tipocambio="SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente=".$idmoneda." and  DATE(FCrea)='".$fecha."' and ContaOrAdmin=2 and CompOrVenta=1";
$Cobrar = mysqli_query($link,$tipocambio);
$row = $Cobrar->fetch_object();
return $row->TipoCambio;
}

function TopTotalAmortizaP($link,$IdCtaPagar,$IdMonedaCta){	//FUNCION2012*

 $ImporAmort="SELECT ROUND(( 
IFNULL((SELECT SUM(d1.Importe*IF(ctas_pagar.IdTipoMoneda=d1.IdMoneda,1,if(d1.IdMoneda=1,1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=1 and CompOrVenta=1),(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=1 and CompOrVenta=1) ) )) FROM fin_caja_banco_oper_det d1 where d1.TipoOperacion='Egreso' and d1.IdCta=ctas_pagar.IdCtaPagar and d1.DocSerieDocumento=ctas_pagar.Serie and d1.DocNroDocumento=ctas_pagar.NumDoc and d1.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_pagar.TipoDoc) and d1.IdMiEmpresa=".$_SESSION['IdMiEmpresa']."),0) 
- IFNULL((SELECT SUM(x.Importe*IF(ctas_pagar.IdTipoMoneda=x.IdMoneda,1,if(x.IdMoneda=1,
1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=1 and CompOrVenta=2),
(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=1 and CompOrVenta=1)
 ) ) )
FROM fin_caja_banco_oper y, fin_caja_banco_oper_det x where y.IdOperacion=x.IdOperacion and x.TipoOperacion='Ingreso' and x.IdCta=ctas_pagar.IdCtaPagar and x.DocSerieDocumento=ctas_pagar.Serie and x.DocNroDocumento=ctas_pagar.NumDoc and x.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_pagar.TipoDoc) and x.IdMiEmpresa='1'),0) ),2) AS Saldototal 
FROM ctas_pagar WHERE IdCtaPagar='".$IdCtaPagar."' AND (EstadoDoc='Pendiente' OR EstadoDoc='Cancelado' OR EstadoDoc='Amortizado' OR EstadoDoc='Aprobado') AND IdMiSede='".$_SESSION['IdMiSede']."' AND IdMiEmpresa='".$_SESSION['IdMiEmpresa']."' ";

	$resp2 = mysqli_query($link,$ImporAmort);
	$items2 = $resp2->fetch_object();	
	 $TopPrecio=round($items2->Saldototal,4);	
	
	$ImportAmort2="SELECT Monto,Moneda,date_format(FCrea,'%Y-%m-%d')AS FCrea  FROM ctas_amortizaciones WHERE IdCtapagar=".$IdCtaPagar." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa']."";
	$Query2S=mysqli_query($link,$ImportAmort2);
	$Query2D=mysqli_query($link,$ImportAmort2);
	$sumaAmort=0;
	
	if($IdMonedaCta==1){			//cuenta en soles
			while($ItemOpe2S=$Query2S->fetch_object()){
			$Moneda=$ItemOpe2S->Moneda;
					if($Moneda==1){
						$sumaAmort+= round($ItemOpe2S->Monto,2);
					}else{
						if($Moneda==2){
							$TipoCambio=tipodecambio($link,2,$ItemOpe2S->FCrea);
							$aux= $ItemOpe2S->Monto*$TipoCambio;
							$sumaAmort+= round($aux,2);
						}
					}
			}
	}else{
		
		if($IdMonedaCta==2){			//cuenta en dolares
			while($ItemOpe2D=$Query2D->fetch_object()){
			$Moneda=$ItemOpe2D->Moneda;
					if($Moneda==1){
							$TipoCambio=tipodecambio($link,2,$ItemOpe2D->FCrea);
							$aux= ($ItemOpe2D->Monto)/$TipoCambio;
							$sumaAmort+= round($aux,2);
						
					}else{
						if($Moneda==2){
							$sumaAmort+= round($ItemOpe2D->Monto,2);
						}
					}
			}

	}
	}
	
     $TopAmort=$sumaAmort;

	return round($TopPrecio+$TopAmort,4);
	
} //fin de f 2012
	
$IdMonedaCta=$_POST['IdTipoMoneda'];

switch($_POST['Tipo']){
	case 'Ingreso':	$TAmor=TopTotalAmortizaC($link,$_POST['IdCtaCobrar'],$IdMonedaCta);
					break;
	case 'Egreso':	$TAmor=TopTotalAmortizaP($link,$_POST['IdCtaPagar'],$IdMonedaCta);
					break;
}


?>
<script type="text/javascript">
var TAmort='<?php echo $TAmor; ?>'; //30
//alert(TAmort);
var Tipo='<?php echo  $_POST['Tipo'];?>';
//var num;

switch(Tipo){
	case 'Ingreso':	
	TotalAmortizadoxC('<?php echo $_POST['IdCtaCobrar'];?>','<?php echo $_POST['Ruc'];?>','<?php echo $_POST['IdCliente'];?>','<?php echo $_POST['NomCliente'];?>','<?php echo $_POST['DirecCliente'];?>','<?php echo $_POST['IdTipoMoneda'];?>','<?php echo $_POST['SimboloMoneda'];?>','<?php echo $_POST['Total'];?>','<?php echo $_POST['TipoDoc'];?>','<?php echo $_POST['Serie'];?>','<?php echo $_POST['NumDoc'];?>','<?php echo $_POST['ProdServ'];?>','<?php echo $_POST['CCID'];?>','<?php echo $_POST['PPID'];?>','<?php echo $_POST['CTID'];?>','<?php echo $_POST['PYID'];?>','<?php echo $_POST['Item'];?>', '<?php echo $_POST['FCreaOr'];?>', '<?php echo $_POST['IdComprobante'];?>');
					break;
					
	case 'Egreso':	
	TotalAmortizadoxP('<?php echo $_POST['IdCtaPagar'];?>','<?php echo $_POST['Ruc'];?>','<?php echo $_POST['IdProveedor'];?>','<?php echo $_POST['NomProveedor'];?>','<?php echo $_POST['DirecProveedor'];?>','<?php echo $_POST['IdTipoMoneda'];?>','<?php echo $_POST['SimboloMoneda'];?>','<?php echo $_POST['Total'];?>','<?php echo $_POST['TipoDoc'];?>','<?php echo $_POST['Serie'];?>','<?php echo $_POST['NumDoc'];?>','<?php echo $_POST['ProdServ'];?>','<?php echo $_POST['CCID'];?>','<?php echo $_POST['PPID'];?>','<?php echo $_POST['CTID'];?>','<?php echo $_POST['PYID'];?>','<?php echo $_POST['Item'];?>', '<?php echo $_POST['FCreaOr'];?>', '<?php echo $_POST['IdComprobante'];?>', '<?php echo $_POST['pcCuenta'];?>', '<?php echo $_POST['pcDescri'];?>', '<?php echo $_POST['TipoComprob'];?>');
					break;
}

function TotalAmortizadoxC(IdCtaCobrar,Ruc,IdCliente,NomCliente,DirecCliente,IdTipoMoneda,SimboloMoneda,Total,TipoDoc,Serie,NumDoc,ProdServ,CCID,PPID,CTID,PYID,Item,FCreaOr, IdComprobante){

	if(TAmort==''){
		var SaldoCta=parseFloat(Total);
	}else{
		var SaldoCta=parseFloat(Total) - parseFloat(TAmort);
	}

	//conversion de tipo de cambio
	//var TC='<?php //echo $_SESSION['TCambioV'];?>';
	/*var AuxImporte  = jQuery("input#AuxImporte").val();
	var AuxImportex = (AuxImporte == "") ? 0 : parseFloat(AuxImporte);
	var newAuxImportex = AuxImportex + SaldoCta;
	jQuery("input#AuxImporte").val(newAuxImportex);*/
	var TC = parseFloat(jQuery('#tipocx option:selected').val());
	
	var SaCta;
	if($F('cboMoneda')==1 && IdTipoMoneda==2){		//origen $ destino soles  SimboloMoneda=='$'
		SaCta=SaldoCta * TC;
		$('SaCtax').value=1;
	}else if($F('cboMoneda')==1 && IdTipoMoneda==1){  //  SimboloMoneda=='S/.'
		SaCta=SaldoCta;									
		$('SaCtax').value=0;
	}else if($F('cboMoneda')==2 && IdTipoMoneda==2){ //SimboloMoneda=='$'
		SaCta=SaldoCta;
		$('SaCtax').value=0;
	}else if($F('cboMoneda')==2 && IdTipoMoneda==1){	//origen soles destino $ SimboloMoneda=='S/.'
		SaCta=SaldoCta / TC;
		$('SaCtax').value=2;
	}
	var TCx=$F('SaCtax');
	if($F('txtMontOaPagar')=='' || $F('ocasion')==0){		//caso hallamos ingresado un monto, al jalar cuenta lo inicializa en 0
		ImpActual=0;
		$('ocasion').value=1;			// ocasion es 1 ,cuando ya jalo una cuenta y al jalar otra sera sumatorias.
	}else{
		ImpActual=$F('txtMontOaPagar');
	}
	
	//sumamos al monto de otros documentos
	TotalPagar=parseFloat(ImpActual) + parseFloat(SaCta);
	
	//creamos el icono con datos
	var  Trib_NumContrib='<?php echo $_SESSION['Trib_NumContrib'];?>';
	var Ley='Razon Social: '+NomCliente+'<br>'+Trib_NumContrib+':'+Ruc+'<br>Total: '+SimboloMoneda+' '+Total+'<br>Amortizado: '+TAmort+'<br>Saldo: '+SaldoCta;	

	//Evitamos duplicidadad. Buscamos si existe el caracter almacenado en la var: text
	var DivCapa='Cuentas';
	var TxtDiv=$(DivCapa).innerHTML;	//aqui demos cargar todo el contenido de la variable: DivCapa

	var text='id='+'"'+IdCtaCobrar+'"';

	if(TxtDiv.indexOf(text)!=-1){
		
		alert('Ya fue asignado el documento');
			
	}else{

		var FCreaOr = "<input id='FCreaOr"+Item+"' name='FCreaOr"+Item+"' type='hidden' value='"+FCreaOr+"' />";
		var IdCompr = "<input id='IdCompr"+Item+"' name='IdCompr"+Item+"' type='hidden' value='"+IdComprobante+"' />";
		
		//var NumComprobx = "<input id='NumComprobx"+Item+"' name='NumComprobx"+Item+"' type='hidden' value='' />";
		//var TipoComprobx = "<input id='TipoComprobx"+Item+"' name='TipoComprobx"+Item+"' type='hidden' value='' />";
		
		
		var IdPerDocx = "<input id='IdPerDocx"+Item+"' name='IdPerDocx"+Item+"' type='hidden' value='"+IdCliente+"' />";
		var NumPerDocx = "<input id='NumPerDocx"+Item+"' name='NumPerDocx"+Item+"' type='hidden' value='"+Ruc+"' />";
		var NomPerDocx = "<input id='NomPerDocx"+Item+"' name='NomPerDocx"+Item+"' type='hidden' value='"+NomCliente+"' />";
		
		$('Cuentas').insert('<div style="float:left;padding-right:10px;border:solid 1px #666;" onmouseover="Leyenda(this,\''+Ley+'\',1);"><input name="IdDocC'+Item+'" id="IdDocC'+Item+'" type="hidden" value="'+IdCtaCobrar+'" /><input name="SaldoCta'+Item+'" id="SaldoCta'+Item+'" type="hidden" value="'+SaCta+'" /><input name="TipoC'+Item+'" id="TipoC'+Item+'" type="hidden" value="'+TCx+'" /><input name="'+IdCtaCobrar+'" id="'+IdCtaCobrar+'" type="hidden" value="'+IdCtaCobrar+'" /><input name="IdCtaCobrar'+Item+'" id="IdCtaCobrar'+Item+'" type="hidden" value="'+IdCtaCobrar+'" /><input name="TipoDoc'+Item+'" id="TipoDoc'+Item+'" type="hidden" value="'+TipoDoc+'" /><input name="Serie'+Item+'" id="Serie'+Item+'" type="hidden" value="'+Serie+'" /><input name="NumDoc'+Item+'" id="NumDoc'+Item+'" type="hidden" value="'+NumDoc+'" /><img src="ImgSys/page.gif" width="18" height="18" style="vertical-align:middle;"/>'+TipoDoc+'('+Serie+'-'+NumDoc+'): '+SimboloMoneda+' '+Total+FCreaOr+IdCompr+IdPerDocx+NumPerDocx+NomPerDocx+'</div>');
		
		//condicional que deshabilita  monto cuando esta en moneda distinta a la del banco.
		if($F('CtrolMoneda')==1 && SimboloMoneda!=$F('SimbMoneda')){
				// $('Importe').disabled=true;
				jQuery("#Importe").attr('readonly', true);
		}
		
		
		$('txtMontOaPagar').value=Redondear(TotalPagar,4);
		$('AuxMontOaCobrar').value=$F('txtMontOaPagar');
		$('CuentasCobrar').hide();	
		$('NroDocs').value=Item;
		$('btnCuentas').focus();
		//Esta linea es para CajaIngresoEgreso
		//$('Importe').value=$F('txtMontOaPagar');
		
		jQuery('input#Importe').val(jQuery('input#txtMontOaPagar').val());

		if($F('checkMonto')=="on"){
			$('txtMontOaPagar').readOnly=true;
			$('Importe').readOnly=true;
			$('checkMonto').disabled=true;	// ya no puede habilitar el check.
			$('Aux').value=0;
		}else{
			$('txtMontOaPagar').readOnly=false;
			$('Importe').readOnly=false;
			$('btnCuentas').hide();
			$('Aux').value=1;	//Aux = 1 va a calcular el monto a cobrar cuando se inserta			
		}
	
	jQuery("#BFOperacionx").attr('disabled', true);
	
	var chkRendi = jQuery("#iniRend").attr( "checked" );
	if( chkRendi == "checked") {
		setTimeout(setPreviewRendicion("Egreso"), 200);
	}
	
	}
}



function TotalAmortizadoxP(IdCtaPagar,Ruc,IdProveedor,NomProveedor,DirecProveedor,IdTipoMoneda,SimboloMoneda,Total,TipoDoc,Serie,NumDoc,ProdServ,CCID,PPID,CTID,PYID,Item,FCreaOr, IdComprobante, pcCuenta, pcDescri, TipoComprob){
	
	var chkRendi = jQuery("#iniRend").attr( "checked" );// Si es una Rendicion
	var impRendi = (jQuery( "input#montoRendir" ).val() == "") ? 0 : parseFloat(jQuery( "input#montoRendir" ).val()).toFixed(4);
	
			
	//obtenemos el saldo a pagar
	if(TAmort==''){
		var SaldoCta=parseFloat(Total);
	}else{
		var SaldoCta=parseFloat(Total) - parseFloat(TAmort);
	}
	
	//conversion de tipo de cambio
	//var TC='<?php //echo $_SESSION['TCambioV'];?>';
	/*var AuxImporte  = jQuery("input#AuxImporte").val();
	var AuxImportex = (AuxImporte == "") ? 0 : parseFloat(AuxImporte);
	var newAuxImportex = AuxImportex + SaldoCta;*/
	//jQuery("input#AuxImporte").val(parseFloat(newAuxImportex).toFixed(4));
	var cbMoneda = jQuery('#cboMoneda').val();
	var TC = parseFloat(jQuery('#tipocx option:selected').val());
	var SaCta;
	//alert(Item);	
	if($F('cboMoneda')==1 && IdTipoMoneda==2){		//origen $ destino soles  SimboloMoneda=='$'
		SaCta=SaldoCta * TC;
		$('SaCtax').value=1;
	}else if($F('cboMoneda')==1 && IdTipoMoneda==1){   //SimboloMoneda=='S/.'
		SaCta=SaldoCta;									
		$('SaCtax').value=0;
	}else if($F('cboMoneda')==2 && IdTipoMoneda==2){		//SimboloMoneda=='$'
		SaCta=SaldoCta;
		$('SaCtax').value=0;
	}else if($F('cboMoneda')==2 && IdTipoMoneda==1){	//origen soles destino $  SimboloMoneda=='S/.'
	    //TC = '<?php //echo $_SESSION['TCambioV'];?>'; //Cambiado el 7-10 por V. Revizar ***
		SaCta=SaldoCta / TC;
		$('SaCtax').value=2;
	}
	
	
	var TCx=$F('SaCtax');	
	//alert(TCx); 2
	if($F('txtMontOaPagar')=='' || $F('ocasion')==0){
		ImpActual=0;
		$('ocasion').value=1;
	}else{
		ImpActual=$F('txtMontOaPagar');
	}
	
	//sumamos al monto de otros documentos
	TotalPagar = parseFloat(ImpActual) + parseFloat(SaCta);
	
	
	
	
	
	//creamos el icono con datos
	var  Trib_NumContrib='<?php echo $_SESSION['Trib_NumContrib'];?>';
	var Ley='Razon Social: '+NomProveedor+'<br>'+Trib_NumContrib+':'+Ruc+'<br>Total: '+SimboloMoneda+' '+Total+'<br>Amortizado: '+TAmort+'<br>Saldo: '+SaldoCta;
	
	//alert(SaldoCta);
	
	
	
	//Evitamos duplicidadad. Buscamos si existe el caracter almacenado en la var: text
	var DivCapa='Cuentas';
	var TxtDiv=$(DivCapa).innerHTML;	//aqui demos cargar todo el contenido de la variable: DivCapa

	var text='id='+'"'+IdCtaPagar+'"';
	var nitem = parseInt(jQuery("#nitem").val());// Nuevo nitem
	if(TxtDiv.indexOf(text)!=-1){
		if(nitem != "") {
				jQuery("#nitem").val(nitem-1);
		}
		alert('Ya fue asignado el documento');

	}else{
		
		var difx = impRendi - TotalPagar;
	
		if( chkRendi == "checked" && difx < 0) { 
			if(nitem != "") {
				jQuery("#nitem").val(nitem-1);
			}			
			alert("El total de los comprobantes no puede ser superior al monto a rendir( " + impRendi + " )" );
		} else {
			
			var pcCuentx = "<input id='pcCuentx"+Item+"' name='pcCuentx"+Item+"' type='hidden' value='"+pcCuenta+"' />";
			var pcDescrx = "<input id='pcDescrx"+Item+"' name='pcDescrx"+Item+"' type='hidden' value='"+pcDescri+"' />";
						
			var FCreaOr = "<input id='FCreaOr"+Item+"' name='FCreaOr"+Item+"' type='hidden' value='"+FCreaOr+"' />";
			var IdCompr = "<input id='IdCompr"+Item+"' name='IdCompr"+Item+"' type='hidden' value='"+IdComprobante+"' />";
			
			//var NumComprobx = "<input id='NumComprobx"+Item+"' name='NumComprobx"+Item+"' type='hidden' value='"+NumComprob+"' />";
			var TipoComprobx = "<input id='TipoComprobx"+Item+"' name='TipoComprobx"+Item+"' type='hidden' value='"+TipoComprob+"' />";
			var IdMonComprobx = "<input id='IdMonComprobx"+Item+"' name='IdMonComprobx"+Item+"' type='hidden' value='"+IdTipoMoneda+"' />";
			
			var MontoComprobx = "<input id='MontoComprobx"+Item+"' name='MontoComprobx"+Item+"' type='hidden' value='"+Total+"' />";
					
			var IdPerDocx = "<input id='IdPerDocx"+Item+"' name='IdPerDocx"+Item+"' type='hidden' value='"+IdProveedor+"' />";
			var NumPerDocx = "<input id='NumPerDocx"+Item+"' name='NumPerDocx"+Item+"' type='hidden' value='"+Ruc+"' />";
			var NomPerDocx = "<input id='NomPerDocx"+Item+"' name='NomPerDocx"+Item+"' type='hidden' value='"+NomProveedor+"' />";
			
			
			$('Cuentas').insert('<div style="float:left;padding-right:10px;border:solid 1px #666;" onmouseover="Leyenda(this,\''+Ley+'\',1);"><input name="IdDocC'+Item+'" id="IdDocC'+Item+'" type="hidden" value="'+IdCtaPagar+'" /><input name="SaldoCta'+Item+'" id="SaldoCta'+Item+'" type="hidden" value="'+SaCta+'" /><input name="TipoC'+Item+'" id="TipoC'+Item+'" type="hidden" value="'+TCx+'" /><input name="'+IdCtaPagar+'" id="'+IdCtaPagar+'" type="hidden" value="'+IdCtaPagar+'" /><input name="IdCtaPagar'+Item+'" id="IdCtaPagar'+Item+'" type="hidden" value="'+IdCtaPagar+'" /><input name="TipoDoc'+Item+'" id="TipoDoc'+Item+'" type="hidden" value="'+TipoDoc+'" /><input name="Serie'+Item+'" id="Serie'+Item+'" type="hidden" value="'+Serie+'" /><input name="NumDoc'+Item+'" id="NumDoc'+Item+'" type="hidden" value="'+NumDoc+'" /><img src="ImgSys/page.gif" width="18" height="18" style="vertical-align:middle;"/>'+TipoDoc+'('+Serie+'-'+NumDoc+'): '+SimboloMoneda+' '+Total+FCreaOr+IdCompr+pcDescrx+pcCuentx+IdPerDocx+NumPerDocx+NomPerDocx+TipoComprobx+IdMonComprobx+MontoComprobx+'</div>');
			
			
			//condicional que deshabilita  monto cuando esta en moneda distinta a la del banco.
			if($F('CtrolMoneda')==1 && SimboloMoneda!=$F('SimbMoneda')){
					// $('Importe').disabled=true;
					jQuery("#Importe").attr('readonly', true);
			}
			
			
			//alert(TotalPagar);
			$('txtMontOaPagar').value=Redondear(TotalPagar,4);
			$('AuxMontOaPagar').value=$F('txtMontOaPagar');
			$('CuentasPagar').hide();
			$('NroDocs').value=Item;
			$('btnCuentas1').focus();
			
			//Esta linea es para CajaIngresoEgreso
			//$('Importe').value = $F('txtMontOaPagar');
			// Update 26Ago
			jQuery('input#Importe').val(jQuery('input#txtMontOaPagar').val());
			
			if($F('checkMonto1')=="on"){
				$('txtMontOaPagar').readOnly=true;
				$('Importe').readOnly=true;
				$('checkMonto1').disabled=true;	// ya no puede habilitar el check.
				$('Aux').value=0;
			}else{
				$('txtMontOaPagar').readOnly=false;
				$('Importe').readOnly=false;
				$('btnCuentas1').hide();
				$('Aux').value=1;
	
			}
			
			jQuery("#BFOperacionx").attr('disabled', true);
			
			if( chkRendi == "checked") {
				setTimeout(setPreviewRendicion("Ingreso"), 200);
			}
		} // Si es rendicion y las cuentas no superan el monto a rendir
		
	}// Si no fue insertado
}

Redondear=function(num,decimal){
			dec=1;
			for(i=0;i<decimal;i++){
				dec=10*dec;
			}	
			var original=parseFloat(num); 		
			var result=Math.round(original*dec)/dec;
			return 	result;	
	}
</script>
