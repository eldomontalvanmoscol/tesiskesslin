<table width="100%" border="0" cellspacing="0" cellpadding="2" class="out">
  <tr>
    <td width="50%"><label>
      <input type="button" name="Inicio" id="Inicio" value="Inicio" onclick="GoFinal<?php echo $this->NameG;?>(0,0);"/>
    </label>
       <label><input type="button" name="Anterior" id="Anterior" value=" &lt; " onclick="GoFinal<?php echo $this->NameG;?>(<?php echo $this->CanRegG;?>,0);"/>
   </label>    
        </label>
        <label>
        <input name="NroPag<?php echo $this->NameG;?>" type="text" id="NroPag<?php echo $this->NameG;?>" value="1" size="4" readonly="readonly"/>
        </label>
      <label>
      <input type="button" name="Siguiente" id="Siguiente" value=" &gt; " onclick="GoFinal<?php echo $this->NameG;?>(<?php echo $this->CanRegG;?>,1);"/>
        </label>
  <label>
      <input type="button" name="Final" id="Final" value="Final"  onclick="GoFinal<?php echo $this->NameG;?>(1,1);"/>
</label></td>
    <td width="50%"><div align="right">
      <label>
      Tot. Pag.
      <input name="TPaginas<?php echo $this->NameG;?>" type="text" id="TPaginas<?php echo $this->NameG;?>" size="4" readonly="readonly" />
      </label>
      <label>Tot. Reg.
      <input name="TRegistros<?php echo $this->NameG;?>" type="text" id="TRegistros<?php echo $this->NameG;?>" size="5" readonly="readonly"/>
      </label>
    </div></td>
  </tr>
</table>
<script type="text/javascript">
var ValorIni=0;
var ContaPag=1;
GoFinal<?php echo $this->NameG;?>=function(InicioPag,Tip){	//valor, adelante o atras
	var CantRegistros=<?php echo $this->CanRegG;?>;				//Cantidad de registros existentes en la consulta
	var PaginadoFinal=$F('TRegistros<?php echo $this->NameG;?>')-CantRegistros;	//total menos cantidad de registros mostrados
	var TotalPag=$F('TPaginas<?php echo $this->NameG;?>');

	switch(InicioPag){
		case 0:	//ir al inicio
		ValInicioLimit=0;
		ValorIni=0;
		ContaPag=1;
		$('NroPag<?php echo $this->NameG;?>').value=ContaPag;
		break; 
		
		case 1:	//ir al final
		ValInicio=PaginadoFinal;
		if(ValInicio<0){ValorIni=0;	}else{ValorIni=ValInicio;}	//si el paginado es menor que cero, lleva al inicio		
		ValInicioLimit=ValorIni;
		ValorIni=ValInicioLimit;
		ContaPag=TotalPag;
		$('NroPag<?php echo $this->NameG;?>').value=ContaPag;
		break; 
		
		case <?php echo $this->CanRegG;?>:	//navegador en ambos sentidos
		if(Tip==0){		//asignamos nuevos valores a las variables
		ValorIni-=InicioPag-1;
		ContaPag--;
		}else{
		ValorIni+=InicioPag-1;
		ContaPag++;
		}	
		
			if(ValorIni < 0){
			ValorIni=0;
			ContaPag=1;
			}
			if(ContaPag>=TotalPag){ContaPag=TotalPag;}
			
			//alert($F('TPaginas<?php echo $this->NameG;?>'));
			if(ValorIni >= $F('TRegistros<?php echo $this->NameG;?>')){	//si el paginado es mayor que el nro. de registros lleva al final.
				ValorIni=PaginadoFinal;
				if(ValorIni<0){	ValorIni=0;}	//si el paginado es menor que cero, lleva al inicio
			}


			$('NroPag<?php echo $this->NameG;?>').value=ContaPag;
			ValInicioLimit=ValorIni;
			
		break; 	
	}
//Obtenemos valores de la busqueda, permiten conservar los valores de busqueda en el paginado	
var CampoSelect=$F('CampoS<?php echo $this->NameG;?>');	
var Palabrita=$F('PalabraG<?php echo $this->NameG;?>');

//llamamos la carga del grid


CargarGrid<?php echo $this->NameG;?>('<?php echo $this->NameG;?>','<?php echo $Consulta;?>',CampoSelect,Palabrita,'<?php echo $ColumnasG;?>','<?php echo $this->CanRegG;?>','<?php echo $IdOrden;?>','<?php echo $this->OrderBDG;?>',ValInicioLimit);
}
</script>