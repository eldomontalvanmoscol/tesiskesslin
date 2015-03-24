<?php

function BuscarDatosTabla($TipoDoc){

	switch($TipoDoc){
		case 7:
		$IdDoc			='IdNota';			// Nombre del campo Id de la Tabla Cabecera ,ejem Tabla Nota-->IdNota
		$NameTablaC		='notas';			// Nombre del Tabla Cabecera
		$NameTablaD		='notas_detalle';	// Nombre de la Tabla Detalle
		$PosCorrelativo	=7;					// Posición del Campo NumDoc en la Tabla Cabecera  0-7
		$PosEstado		=42;				// Posición del Campo Estado en la Tabla Cabecera	
		$PosIdDetalle	=3;					// Posición del Campo Id de la Tabla Cabecera en la Tabla Detalle
		$TipoCuenta		='ctas_pagar';		// Tipo de Cuenta donde el documento tiene relacion directa
		break;
		
		case 8:
		$IdDoc			='IdNota';			
		$NameTablaC		='notas';			
		$NameTablaD		='notas_detalle';	
		$PosCorrelativo	=7;					
		$PosEstado		=42;				
		$PosIdDetalle	=3;	
		$TipoCuenta		='ctas_cobrar';
		break;
		
		case 1:
		$NameTabla='';
		break;		
		
		case 3:
		$NameTabla='';
		break;		
		
		case 9:
		$NameTabla='';
		break;		
		}		
		
		$Tabla = array($IdDoc,$NameTablaC,$NameTablaD,$PosCorrelativo,$PosEstado,$PosIdDetalle,$TipoCuenta);
		return $Tabla;	
	
	}
?>
