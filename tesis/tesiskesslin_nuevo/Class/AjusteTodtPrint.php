<?php

//$link=conexion bd
//$IdCom=id comprobante o id del registro comprobante a imprimir
//$Tabla_detalle=nombre de la tabla detalle del comprobante
//$id_Rela_id_cab=campo id del comprobante,ejmplo.IdComprobante
//$campo_importe_deta=campo totales o importes de la tabla detalle del comprobante,ejemplo. Importe
//$TablaComCab=nombre tabla comprobante cabecera
//$CampoTIVG=campo igv de la tabla comprobante cabecera
//$redondeo=indica la configuracion de decimales de impresion del documento
//$TipoDocum=tipo de documento.ya sea factura,recibo,boleta,etc

function AjusteTotales($link,$TablaComCab,$IdCom,$TipoDocum,$Tabla_detalle,$id_Rela_id_cab,$campo_importe_deta,$redondeo)
{
	$IgvPro="select TasaIgv,Igv from ".$TablaComCab." where ".$id_Rela_id_cab."=".$IdCom;
	$ResIgv=mysqli_query($link,$IgvPro);
	$RowIgv=$ResIgv->fetch_object();
	
 	$ConsDetalle="select ".$campo_importe_deta.",PrecioVenta,Cantidad from ".$Tabla_detalle." where ".$id_Rela_id_cab."='".$IdCom."'";
 	$Resultado=mysqli_query($link,$ConsDetalle);
	
 	
	
	if($TipoDocum==18 || $TipoDocum==3){
		while($row=$Resultado->fetch_object())
 		{
		
			if($RowIgv->Igv==0){
				$PrecioUnit=$row->PrecioVenta;
			}else{
				$PrecioUnit=(($row->PrecioVenta*$RowIgv->TasaIgv)/100)+$row->PrecioVenta;//calcula precio unitario.
			}
				$ValorVenta=$PrecioUnit*$row->Cantidad;//calcula precio venta
				$TotFN+=round($ValorVenta,$redondeo);
		}
		$SubTF=0.000;
		$IgvF=0.000;
		$TotalF=round($TotFN,$redondeo);
		
	}else{
		while($row=$Resultado->fetch_object())
 		{
	   		$SubTotalF +=round($row->$campo_importe_deta,$redondeo);
		}
		
		if($RowIgv->Igv==0)
		{
			$SubTF=round($SubTotalF,$redondeo);
			$IgvF=round($RowIgv->Igv,$redondeo);
	 		$TotalF=round(($SubTF+$IgvF),$redondeo);
		}else{
			$SubTF=round($SubTotalF,$redondeo);
	 		$IgvT=$RowIgv->TasaIgv/100;
	 		$IgvF=round(($SubTF*$IgvT),$redondeo);
	 		$TotalF=round(($SubTF+$IgvF),$redondeo);
		}
		
	}

	 $ArrayTotales=array($SubTF,$IgvF,$TotalF);
	 
	return $ArrayTotales;
}

?>