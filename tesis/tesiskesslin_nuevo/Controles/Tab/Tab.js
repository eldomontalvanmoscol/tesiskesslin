//las clases en prototype:
// para definir un metodo se usa la propiedad prototype
// para crear los constructores se antepone el this.variable
//puedes crear constructores globales o privadas dentro de un metodo

function Tabs(Nombre,Capas) {
	this.TabNom = Nombre;
	this.TabCapas = Capas;
	this.DivAnt='';
	this.TabAnt=''; 
	
	Tabs.prototype.Capas = function() {
		this.as=$$('div#'+this.TabNom+' li.TabOff');	//obtenemos el id de las listas
		
		this.NumTab=this.TabCapas.length;	//calculamos el nro de pestañas
		for(it=0;it<this.NumTab;it++){
			$(this.TabCapas[it]).style.display='none';	//ocultamos las capas detalle	
		}
		//pintamos la primera pestaña
		this.MuestraTab(this.TabCapas[0],this.as[0]);	//Ejecutamos la funcion q muestrala capa y la pestaña activa
	}
	
	Tabs.prototype.MuestraTab = function(CapaT,Tab) {
		this.CapaT=CapaT;
		this.Tab=Tab;
		
		if(this.DivAnt!=''){		
			$(this.DivAnt).style.display='none';	//ocultamos la capa anterior
			Element.removeClassName(this.TabAnt, "TabOn"); 	//quitamos el estilo a la pestaña anterior ON
			Element.addClassName(this.TabAnt, "TabOff");		//para luego ocultarlo añadiendo el estilo OFF
		}
		//mostramos la capa con sus estilos	
		Element.removeClassName(this.Tab, "TabOff"); 
		Element.addClassName(this.Tab, "TabOn");	//agregamos el estilo ON a la pestaña activa
		$(this.CapaT).style.display='inline';	//mostramos la capa
	
		this.DivAnt=this.CapaT;
		this.TabAnt=this.Tab;
	}
}
