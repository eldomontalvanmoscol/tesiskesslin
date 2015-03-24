<?php
session_start();

//VARIABLE TC ALMACENA LA VARIABLES DE SESSION $_SESSION['TCambioV'], PARA USAR OTRO VALOR MODIFICAR ESTA VARIABLE.
//Estas funciones se calculan para la interfaz de Operacion de Caja/Banco.

function TopTotalAmortizaC($link,$IdCtaCobrar,$IdMonedaCta){	//FUNCION2012*

$ImporAmort="SELECT ROUND(( 
IFNULL((SELECT SUM(d1.Importe*IF(ctas_cobrar.IdTipoMoneda=d1.IdMoneda,1,if(d1.IdMoneda=1,1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=2 and CompOrVenta=1),(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=2 and CompOrVenta=1) ) )) FROM fin_caja_banco_oper_det d1 where d1.TipoOperacion='Ingreso' and d1.IdCta=ctas_cobrar.IdCtaCobrar and d1.DocSerieDocumento=ctas_cobrar.Serie and d1.DocNroDocumento=ctas_cobrar.NumDoc and d1.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_cobrar.TipoDoc) and d1.IdMiEmpresa=".$_SESSION['IdMiEmpresa']."),0) 
- IFNULL((SELECT SUM(x.Importe*IF(ctas_cobrar.IdTipoMoneda=x.IdMoneda,1,if(x.IdMoneda=1,
1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=2 and CompOrVenta=1),
(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=2 and CompOrVenta=1)
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

function TopTotalAmortizaP($link,$IdCtaPagar,$IdMonedaCta){		//FUNCION2012*

	$ImporAmort="SELECT ROUND(( 
IFNULL((SELECT SUM(d1.Importe*IF(ctas_pagar.IdTipoMoneda=d1.IdMoneda,1,if(d1.IdMoneda=1,1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=2 and CompOrVenta=1),(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=date_format(d1.FechaOperacion,'%Y-%m-%d') and ContaOrAdmin=2 and CompOrVenta=1) ) )) FROM fin_caja_banco_oper_det d1 where d1.TipoOperacion='Egreso' and d1.IdCta=ctas_pagar.IdCtaPagar and d1.DocSerieDocumento=ctas_pagar.Serie and d1.DocNroDocumento=ctas_pagar.NumDoc and d1.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_pagar.TipoDoc) and d1.IdMiEmpresa=".$_SESSION['IdMiEmpresa']."),0) 
- IFNULL((SELECT SUM(x.Importe*IF(ctas_pagar.IdTipoMoneda=x.IdMoneda,1,if(x.IdMoneda=1,
1/(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=2 and CompOrVenta=1),
(SELECT TipoCambio FROM tipo_moneda_cambio WHERE MonedaEquivalente='2' and  DATE(FCrea)=(SELECT date_format(FechaOperacion,'%Y-%m-%d') FROM fin_caja_banco_oper WHERE IdOperacion=SUBSTRING_INDEX( SUBSTRING_INDEX( y.ConceptoOperacion,' ',-1),')',1 ) and IdMiEmpresa='".$_SESSION['IdMiEmpresa']."') and ContaOrAdmin=2 and CompOrVenta=1)
 ) ) )
FROM fin_caja_banco_oper y, fin_caja_banco_oper_det x where y.IdOperacion=x.IdOperacion and x.TipoOperacion='Ingreso' and x.IdCta=ctas_pagar.IdCtaPagar and x.DocSerieDocumento=ctas_pagar.Serie and x.DocNroDocumento=ctas_pagar.NumDoc and x.TiDocOrigen=(SELECT Abreviatura FROM tipo_documentos WHERE IdTipoDoc=ctas_pagar.TipoDoc) and x.IdMiEmpresa='1'),0) ),2) AS Saldototal 
FROM ctas_pagar WHERE IdCtaPagar='".$IdCtaPagar."' AND (EstadoDoc='Pendiente' OR EstadoDoc='Cancelado') AND IdMiSede='".$_SESSION['IdMiSede']."' AND IdMiEmpresa='".$_SESSION['IdMiEmpresa']."' ";

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
}

function TotalCtaC($link,$IdCtaCobrar){	
	 $Import="SELECT Total 	FROM ctas_cobrar WHERE IdCtaCobrar=".$IdCtaCobrar." and IdMiEmpresa=".$_SESSION['IdMiEmpresa']."";
									
	$Query=mysqli_query($link,$Import);
	$row = $Query->fetch_object();
	$Top=$row->Total;
	return $Top;
}
	
	
function TotalCtaP($link,$IdCtaPagar){	
	$Import="SELECT Total FROM ctas_pagar WHERE IdCtaPagar=".$IdCtaPagar." and IdMiEmpresa=".$_SESSION['IdMiEmpresa']."";
									
	$Query=mysqli_query($link,$Import);
	$row = $Query->fetch_object();
	$Top=$row->Total;
	return $Top;
}

?>