<?php
session_start();
include ('../../Cx.php');
$link=Conectarse();

function AveriguaPro($link,$IdPersona){
	$Consulta="SELECT IdProveedor FROM empre_proveedor WHERE IdPersona=".$IdPersona." LIMIT 1";
	$resp=mysqli_query($link,$Consulta);
	$row=$resp->fetch_object();
	if($row->IdProveedor=='' || $row->IdProveedor==NULL){$IdP=0;}else{$IdP=1;}
	return $IdP;
}

function AveriguaCli($link,$IdPersona){
	$Consulta="SELECT IdCliente FROM empre_cliente WHERE IdPersona=".$IdPersona." LIMIT 1";
	$respc=mysqli_query($link,$Consulta);
	$rowc=$respc->fetch_object();
	if($rowc->IdCliente=='' || $rowc->IdCliente==NULL){$IdC=0;}else{$IdC=1;}
	return $IdC;
}

function CambiaEtdTCP($link,$TipoCP,$IdPersona){
	$actualiza="UPDATE persona SET ".$TipoCP."='1' WHERE IdPersona=".$IdPersona;
	mysqli_query($link,$actualiza);
}

function ConsultaEstadoPC($link,$campo,$IdPersona){
	$Consulta="SELECT ".$campo." FROM persona WHERE NumDoc='".$IdPersona."' LIMIT 1";
	$Resp=mysqli_query($link,$Consulta);
	$row=$Resp->fetch_object();
	return $row->$campo;
}

function DatosPersona($link,$IdPersona){
	$ConsultaP="SELECT IdMiEmpresa,IdMiSede,Ubigeo,IdPersona,TipoDoc,NumDoc FROM persona WHERE IdPersona=".$IdPersona." LIMIT 1";
	$ResP=mysqli_query($link,$ConsultaP);
	$RowP=$ResP->fetch_object();
	$ArrayValP=array($RowP->IdMiEmpresa,$RowP->IdMiSede,$RowP->Ubigeo,$RowP->IdPersona,$RowP->TipoDoc,$RowP->NumDoc);
	return $ArrayValP;
}
function ConvierteProveedor($link,$IdEmpresa,$IdSede,$Ubigeo,$IdPersona,$TipoEmpresa,$Rucc){
	$InsertarProveedor = "INSERT INTO empre_proveedor(
						  IdMiEmpresa,
						  IdMiSede,
						  Nombre,	
						  Direccion,
						  Ubigeo,
						  IdPersona,
						  TipoEmpresa,
						  Ruc,
						  FCrea,
						  IdUserCrea
						  ) VALUES (
						  '".$IdEmpresa."',
						  '".$IdSede."',
						  '',		
						  '',
						  '".$Ubigeo."',
						  ".$IdPersona.",
						  '".$TipoEmpresa."',
						  '".$Rucc."',
						  NOW(),	
						  '".$_SESSION['IdUsuario']."'
						  )";
	
	return mysqli_query($link,$InsertarProveedor);
}

function ConvierteCliente($link,$IdEmpresa,$IdSede,$Ubigeo,$IdPersona,$TipoEmpresa,$Rucc){
	$InsertarCliente = "INSERT INTO empre_cliente(
						IdMiEmpresa,
						IdMiSede,
						Nombre,	
						Direccion,
						Ubigeo,
						TipoEmpresa,
						Ruc,
						FCrea,
						IdPersona,
						IdPersonaVend,
						Vendedor,
						IdUserCrea
						) VALUES (
						'".$IdEmpresa."',
						'".$IdSede."',
						'',		
						'',
						'".$Ubigeo."',
						'".$TipoEmpresa."',
						'".$Rucc."',
						NOW(),	
						'".$IdPersona."',
						'0',
						'',
						".$_SESSION['IdUsuario']."
						)";
	return mysqli_query($link,$InsertarCliente);
}

function SoyProveedor($link,$IdPersona)
{
	$IsPro=AveriguaPro($link,$IdPersona);//consultamos si es proveeedor o no
	if($IsPro==0)
	{
		$DP=DatosPersona($link,$IdPersona);//obtenemos datos de la persona
		$ValidP=ConvierteProveedor($link,$DP[0],$DP[1],$DP[2],$DP[3],$DP[4],$DP[5]);//creamos al proveedor
		if($ValidP==true){CambiaEtdTCP($link,'TipoProveedor',$IdPersona);}//activamos como proveeedor en la tabla persona
	}else{
		$ActivoP=ConsultaEstadoPC($link,'TipoProveedor',$IdPersona);//consultamos si el proveedor existente este activado como proveedor en la tabla persona
		if($ActivoP!=1){
			CambiaEtdTCP($link,'TipoProveedor',$IdPersona);//activamos como proveeedor en la tabla persona
		}
	}
}

function SoyCliente($link,$IdPersona)
{
	$IsCli=AveriguaCli($link,$IdPersona);//consultamos si la persona ya es cliente o no
	if($IsCli==0)
	{
		$DC=DatosPersona($link,$IdPersona);//obtenemos datos de la persona
		$ValidC=ConvierteCliente($link,$DC[0],$DC[1],$DC[2],$DC[3],$DC[4],$DC[5]);//convertimos como cliente
		if($ValidC==true){CambiaEtdTCP($link,'TipoCliente',$IdPersona);}//activamos como cliente en la tabla persona
	}else{
		$ActivoC=ConsultaEstadoPC($link,'TipoCliente',$IdPersona);//consultamos si el cliente  este activado como cliente en la tabla persona
		if($ActivoC!=1){
			CambiaEtdTCP($link,'TipoCliente',$IdPersona);//activamos como cliente en la tabla persona
		}
	}
}


function ValidaVend($link,$NomControl,$IdPersonaC)
{
	$ConstaVend="SELECT IdVendedor,AccesoClientes FROM vendedores WHERE IdPersona=".$_SESSION['IdPersona']." AND IdMiSede=".$_SESSION['IdMiSede']." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa'];
	$RespVend=mysqli_query($link,$ConstaVend);
	$RowV=$RespVend->fetch_object();
	if($RowV->IdVendedor!=''){
		if($RowV->AccesoClientes==0){
			$ConstaCP="SELECT IdPersonaVend FROM empre_cliente WHERE IdPersona=".$IdPersonaC." AND IdMiSede=".$_SESSION['IdMiSede']." AND IdMiEmpresa=".$_SESSION['IdMiEmpresa'];
			$RespC=mysqli_query($link,$ConstaCP);
			$RowC=$RespC->fetch_object();
			if($RowC->IdPersonaVend==$_SESSION['IdPersona']){
				$Trans=0;
			}else{
				$Trans=1;
			}
		}else{
			$Trans=0;	
		}
	}else{
		$Trans=0;
	}
	echo "<input type='hidden' id='ValTran".$NomControl."' name='ValTran".$NomControl."' value='".$Trans."' />";
}


switch($_POST['Accion']){
	case 'ConvierteCP':
		SoyProveedor($link,$_POST['IdPersona']);
		SoyCliente($link,$_POST['IdPersona']);
		break;
	case 'ValidaVend':
		ValidaVend($link,$_POST['NombControl'],$_POST['IdPersonaC']);
		break;	
}
?>