<?php
function ComboA(){
	include ('../../Cx.php');
	$link=Conectarse();
	
	$QueryA='SELECT * FROM ubigeo WHERE CodProv=0 and CodDist=0';
	$Result= mysqli_query($link,$QueryA);
	
	while($itemA = $Result->fetch_object()) {
		
		if($item->CodDpto==$_POST['Dpto']){$SelA="selected";}else{$SelA='';}
		echo "<option value=\"".$item->CodDpto."\" $SelA>".$itemA->CodDpto."-".utf8_encode($itemA->Nombre)."</option>";
		}
}

function ComboB(){
	include ('../../conexion.php');
	$QueryB='SELECT * FROM ubigeo WHERE CodDpto='.$_POST['CodDpto'].' and CodProv!=0 and CodDist=0';
	$consulta = $db->prepare($QueryB);
	$consulta->execute();
	$itemsB = $consulta->fetchAll();
		foreach($itemsB as $itemB)
		{
		if($itemB['CodProv']==$_POST['Prov']){$SelB="selected";}else{$SelB='';}
		echo "<option value=\"".$itemB['CodProv']."\" $SelB>".$itemB['CodProv']."-".utf8_encode($itemB['Nombre'])."</option>";
		}
}

function ComboC(){
	include ('../../conexion.php');

	$QueryC='SELECT * FROM ubigeo WHERE CodDpto='.$_POST['CodDpto'].' and CodProv='.$_POST['CodProv'].' and CodDist!=00';
	$consulta = $db->prepare($QueryC);
	$consulta->execute();
	$itemsC = $consulta->fetchAll();
		foreach($itemsC as $itemC)
		{
		if($itemC['CodDist']==$_POST['Dist']){$SelC="selected";}else{$SelC='';}
		echo "<option value=\"".$itemC['CodDist']."\" $SelC>".$itemC['CodDist']."-".utf8_encode($itemC['Nombre'])."</option>";
		}
}
//---------------------------------------------------
switch($_GET['Refresh']){
case "ComA":
	ComboA();
	break;
case "ComB":
	ComboB();
	break;
case "ComC":
	ComboC();
	break;
}	
?>
