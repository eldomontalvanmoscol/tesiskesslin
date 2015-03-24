<?php
include ('../../Cx.php');
$link=Conectarse();

function ComboA($link){
	$qA='SELECT * FROM ubigeo WHERE CodProv=0 and CodDist=0';
	$rs= mysqli_query($link,$qA);
	
		while($itemA = $rs->fetch_object()) {
			if($itemA->CodDpto==$_POST['Dpto']){$SelA='selected';}else{$SelA='';}
			echo '<option value="'.$itemA->CodDpto.'" '.$SelA.'>'.$itemA->CodDpto.'-'.utf8_encode($itemA->Nombre).'</option>';
		}
}

function ComboB($link){
	$qB='SELECT * FROM ubigeo WHERE CodDpto='.$_POST['CodDpto'].' and CodProv!=0 and CodDist=0';
	$rs= mysqli_query($link,$qB);
	
		while($itemB = $rs->fetch_object()) {
			if($itemB->CodProv==$_POST['Prov']){$SelB='selected';}else{$SelB='';}
			echo '<option value="'.$itemB->CodProv.'" '.$SelB.'>'.$itemB->CodProv.'-'.utf8_encode($itemB->Nombre).'</option>';
		}
}

function ComboC($link){
	$qC='SELECT * FROM ubigeo WHERE CodDpto='.$_POST['CodDpto'].' and CodProv='.$_POST['CodProv'].' and CodDist!=00';
	$rs= mysqli_query($link,$qC);
		while($itemC = $rs->fetch_object()) {
			if($itemC->CodDist==$_POST['Dist']){$SelC='selected';}else{$SelC='';}
			echo '<option value="'.$itemC->CodDist.'" '.$SelC.'>'.$itemC->CodDist.'-'.utf8_encode($itemC->Nombre).'</option>';
		}
}
//---------------------------------------------------
if($_GET['Refresh']=='ComA') ComboA($link);
if($_GET['Refresh']=='ComB') ComboB($link);
if($_GET['Refresh']=='ComC') ComboC($link);
?>
