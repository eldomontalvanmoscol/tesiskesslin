<?PHP 
session_start();
function UpdateCorrelativoDoc($CodTipoDoc,$Serie,$Corre){
	include('../conexion.php');
	$Corre=$Corre-1;
	$actualiza = $db->prepare('UPDATE correlativos_doc SET  Correlativo=Correlativo+1
										WHERE CodTipoDoc=:CodTipoDoc and Serie=:Serie and Correlativo=:Corre and
										IdMiEmpresa=:IdMiEmpresa and IdMiSede=:IdMiSede');
	
	
  	/*$sql = "UPDATE correlativos_doc SET  Correlativo=Correlativo+1 WHERE CodTipoDoc=".$CodTipoDoc." and Serie=".$Serie." and Correlativo=".$Corre." and
										IdMiEmpresa=".$_SESSION['IdMiEmpresa']." and IdMiSede=".$_SESSION['IdMiSede'];*/
							
	/*UPDATE correlativos_doc SET  Correlativo=Correlativo+1 WHERE CodTipoDoc=1 and Serie=001 and Correlativo=314 and
										IdMiEmpresa=1 and IdMiSede=1*/
	$actualiza->bindParam(':Serie', $Serie);	
	$actualiza->bindParam(':Corre', $Corre);	
	$actualiza->bindParam(':CodTipoDoc', $CodTipoDoc);	
	$actualiza->bindParam(':IdMiEmpresa', $_SESSION['IdMiEmpresa']);
	$actualiza->bindParam(':IdMiSede', $_SESSION['IdMiSede']);		
	$actualiza->execute();
}
//echo $_POST['CodTipoDoc'].' '.$_POST['Hserie'].' '.$_POST['Hcorre'];
switch($_GET['Accion']){
	case "UpdateCorelativo":
		UpdateCorrelativoDoc($_POST['CodTipoDoc'],$_POST['Hserie'],$_POST['Hcorre']);
		break;	
}	
?>