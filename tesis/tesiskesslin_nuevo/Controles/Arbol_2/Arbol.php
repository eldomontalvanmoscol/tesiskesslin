<?php
class Tree{
	private $Nombre;
	private $id_field;
	private $link_field;
	private $prefix;	
	private $CampoPadre;
	private $CampoHijo;
	private $Funcion;
	private $Condicion;
	private $Sql;
	private $MostLR;
	
	//$Arbol->Constructor($db,$this->Sql,$this->CampoPadre,$this->CampoHijo,0,$Espacio,$Function,$this->NomArbol,$this->AccionNodo,$this->MostLR);
	
	public function Constructor($db,$Sql,$id_field,$link_field,$parent,$prefix,$Function,$NomArbol,$AcccNodo,$MostLR){
			//ATRIBUTOS DEL ARBOL			
			$this->id_field		=$id_field;		//Nombre del campo llave de la tabla
			$this->link_field	=$link_field;	//Campo que establece la relacion padre hijo
			$this->Padre		=$parent;		//padre actual
			$this->prefix		=$prefix;		//string con un campo a mostrar en cada entrada del arbol
			$this->Condicion	=$Condicional;	//0:Normal,1:Editable(see all)
			$this->Sql			=$Sql;			//consulta
			$this->NomArbol		=$NomArbol;		//Nombre para diferenciar de otros arboles
			$this->AccionNodo	=$AcccNodo;	//esta accion evalua si es que ,solo acemos clik en los padres o en general //0=en todos,1=solo padres,2=solo hijos
			$this->MostLR		=$MostLR;	//si mostramos el link de raiz util en el control manager group
			//QUERY MYSQL
			@mysqli_query($db,"SET NAMES 'utf8'"); //forzamos codificacion utf-8. Util cuando se concatena columnmas
			$sqlAb="".$this->Sql." AND ".$link_field."=".$parent."";	
			
			//echo $link_field."=".$parent;
			
			
			//echo $sqlAb;
			$rs=mysqli_query($db,$sqlAb);
			//RUTAS
			$DirA="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/Arbol_2/";			

			while($arr = $rs->fetch_object()) {
				
				$sqlAbH=$this->Sql." AND Niveles =".$arr->IdNodo;	
				$rsH=mysqli_query($db,$sqlAbH);
				
				
				$Cant=$rsH->num_rows;
				$a=array();
				$i=0;
				$display="";
				
				if($Cant>0 ){
					if($display==''){
						$img=$DirA.'images/nolines_minus.gif';
						$NodoClass="class=\"ImgTreeMinus\"";
						$AImg=18;
					}else{
						$img=$DirA.'images/nolines_plus.gif';
						$AImg=10;
						$NodoClass="class=\"ImgTreePlus\"";
					}
					
					$Folder='folder.gif';
					$Class="class=\"TreeFolder\"";
					$href='';
					
					while($row = $rsH->fetch_object()){
						$a[$i]=$row->IdNodo."_".$arr->IdArbol."_".$this->NomArbol;
						$i++;
					}
					$json=json_encode($a);
					$onclick="onclick='ShowHide(".$json.",\"img".$arr->IdNodo.$this->NomArbol."_".$arr->IdArbol."\");'";
					//onclick='ShowHide(["405_1_BloqueVen","9584_1_BloqueVen","21122_1_BloqueVen","21125_1_BloqueVen"],"img40BloqueVen_1");'
					//$onclick="onclick=\"ShowHide('".$arr->IdNodo."');\"";
				}else{
					$img=$DirA."images/18x18.gif";
					$AImg=15;
					$onclick="";
					//SINCRONIZACIÓN
						//include('../../Componentes/Multiempresa/Sincronizar/PersonasVariablesId.php');
					//END	
					//MULTIEMPRESA
					//$sqls="SELECT IdArbol FROM arbol_cab WHERE DescripCort = 'Grupos o familias' AND IdMiEmpresa = ".$IdMiEmpresa;
					//$IdArbol = mysqli_fetch_assoc(mysqli_query($link, $sqls));
					//END
					
					//if($arr->IdArbol==$IdArbol['IdArbol']){ //En caso sea Grupos y Familias añadimos el icono de arbol
					if($arr->IdArbol==14){ //En caso sea Grupos y Familias añadimos el icono de arbol
						$Folder='arbol.png';
						$space=" ";
						$Class='';
						$href="href=\"#\"";
					}else{
					
						if($arr->Niveles==0){
							$display='';
							$href="href=\"#\"";
							$Folder='page.gif';
							$Class='';//class=\"LinkNoSelect\"
						}else{
							$display='';
							$href="href=\"#\"";
							$Folder='page.gif';
							$Class='';//class=\"LinkNoSelect\"
						}
					}
					
					
					
					
				}
				
				$Rama= "<img ".$NodoClass." id=\"img".$arr->IdNodo.$this->NomArbol."_".$arr->IdArbol."\" src=\"".$img."\" ".$onclick." width=".$AImg." height=\"18\" class=\"EspacioArbol\"  />";		
				$Espacio="<img src=\"".$DirA."images/18x18.gif\" width=\"16\" height=\"18\" class=\"EspacioArbol\"/>";	//img espacios
				
			   //FUNCION
			   $ValoresF=$arr->IdNodo.",'".$arr->Nombre."','".$arr->Niveles."',
			   '".$arr->IdArbol."','".$arr->Estado."','".$arr->Url."','".$arr->Target."','".$arr->CodAlternativo."'";
			
				if ($Function==''){	
					$this->Funcion ='';
					
				}else{
					$this->Funcion =$Function."(".$ValoresF.")";
				}	
				
				/*if($arr->Url=='' || $arr->Url=='*' || $arr->Url=='#'){ 
					$href='';
					if($arr->IdArbol==14){ //En caso sea Grupos y Familias añadimos el icono de arbol
						$Folder='arbol.png';
						$space=" ";
						$Class='';
						$href="href=\"#\"";
					}else{
						$Folder='folder.gif';
						$space="";
						$Class="class=\"TreeFolder\""; 
					}
					
				}else{ 
					$href="href=\"#\"";
					$Folder='page.gif';
					$Class='';
				}*/
						
				//PINTAMOS EL NODO CON SU LINK Y FUNCIONES
				//averiguamos si es link externo o interno
				
				if(ereg('http://',$arr->Url)){$ImgDir='folder_url.gif';}else{$ImgDir='folder.gif';}
				//if($arr->Estado==0){$Folder="folder_off.gif";}else{$Folder=$ImgDir;}	//nodo estado: activo/inactivo
				$Dir="<img src=\"".$DirA."images/".$Folder."\" width=\"18\" height=\"18\" border=\"0\"/>";
				
				echo "<ul id=\"".$arr->IdNodo."\" class=\"TreeView\" ".$display." \" >";
				echo "<li id=\"".$arr->IdNodo."_".$arr->IdArbol."_".$this->NomArbol."\">";
				echo $prefix.$Rama.$Dir;
				//echo $this->AccionNodo;
				//echo "href".$href;
				if($this->AccionNodo==0)
				{
					echo $space."<a ".$href." ".$Class." onclick=\"".$this->Funcion."\">&nbsp;".$arr->Nombre."&nbsp;</a>";
				}else if($this->AccionNodo==1){
					
					if($href==''){
						echo $space."<a ".$href."onclick=\"".$this->Funcion."\" ".$Class.">&nbsp;".$arr->Nombre."&nbsp;</a>";
						
					}else{
						echo $space."<a ".$href.$Class.">&nbsp;".$arr->Nombre."&nbsp;</a>";
					}	
					
				}else if($this->AccionNodo==2){
					if($href!=''){
						echo $space."<a ".$href."onclick=\"".$this->Funcion."\" ".$Class.">&nbsp;".$arr->Nombre."&nbsp;</a>";
					}else{
						echo $space."<a ".$Class.">&nbsp;".$arr->Nombre."&nbsp;</a>";
					}
				}
					
				
				//PINTAMOS LOS HIJOS DE ESTE NODO, Y ASI EN FORMA RECUSIVA
				$Arbol = new Tree();	
				$Arbol->Constructor($db,$this->Sql,$this->id_field,$link_field,$arr->$id_field,$prefix.$Espacio,$Function,$this->NomArbol,$this->AccionNodo,$this->MostLR);	
			}
			echo "</li>";
			echo "</ul>";

		} 		
	//}
	
	//db, Nombre, Sql, CampoPadre, CampoHijo, Funcion
	function VerArbol($db,$Nombre,$Sql,$CampoPadre,$CampoHijo,$Function,$NomArbol,$AccionNodo=0,$MostLR=0){
		$this->Nombre		=$Nombre;
		$this->CampoPadre	=$CampoPadre;
		$this->CampoHijo	=$CampoHijo;
		$this->Funcion		=$Function;
		$this->Condicion	=$Condicional;
		$this->Sql			=$Sql;
		$this->NomArbol		=$NomArbol;
		$this->AccionNodo	=$AccionNodo;
		$this->MostLR		=$MostLR;
		//echo "AccionN: ".$this->AccionNodo;
		
		
		$IdRaiz='77777';
		$DirA='http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['ConfG_RutaRelativaS'].'Controles/Arbol_2/';
		//$Espacio="<img src=\"".$DirA."images/18x18.gif\" width=\"18\" height=\"18\"/>";	//img espacios
		$DirA="http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']."Controles/Arbol_2/";
		$img=$DirA.'images/nolines_minus.gif';
		$Icon="<img class=\"ClassExpCol\" width=\"18\" height=\"18\" src=\"".$img."\" />";
		
		//FUNCION
		if ($Function==''){
			$this->Funcion ='';
		}else{
			$this->Funcion =$Function."(".$IdRaiz.",'',0,'".$this->Nombre."','','','','')"; 	
			
		}
		
		echo $Icon."<a href='#' id='IdColapsa' >(Colapsar)</a>";
		if($this->MostLR==1){
			$imgn=$DirA.'images/arbol.png';
			$IcoR="<div style=\"margin-left:15px;cursor:pointer;background-image:url(".$imgn."); width:16px; height:16px;no-repeat; background-position: center\" onClick=\"".$this->Funcion."\" id='Padre777777'></div>";
			echo $IcoR;
		}
		

		//PINTAMOS LA RAIZ DEL ARBOL
		if($this->Nombre!=''){
			if($this->AccionNodo==0){
			echo "<br /><img src=\"".$DirA."images/arbol.png\" width=\"16\" height=\"16\"/> <a href=\"#\" class=\"Tree_root\"  id='$IdRaiz' onclick=\"".$this->Funcion."\">";
			echo $this->Nombre."</a><br>";
			}
			if($this->AccionNodo==1){
				echo "<br /><img src=\"".$DirA."images/arbol.png\" width=\"16\" height=\"16\"/> <a href=\"#\" class=\"Tree_root\"  id='$IdRaiz'>";
			echo $this->Nombre."</a><br>";
			}
		}
		//echo $this->Sql;
		//echo $this->CampoPadre;
		//echo $this->CampoHijo;
		//echo $this->NomArbol;
		//PINTAMOS LOS NODOS
		$Arbol = new Tree();
		$Arbol->Constructor($db,$this->Sql,$this->CampoPadre,$this->CampoHijo,0,$Espacio,$Function,$this->NomArbol,$this->AccionNodo,$this->MostLR);
		return;
		
		mysqli_close($db);
	}
}
?>