
function pulsar(e){tecla=(document.all)?e.keyCode:e.which;if(tecla==78&&e.altKey){Nuevo();}
if(tecla==69&&e.altKey){Editar();}
if(tecla==65&&e.altKey){Aprobar();}
if(tecla==46&&e.altKey){Eliminar();}
if(tecla==85&&e.altKey){Anular();}
if(tecla==73&&e.altKey){Imprimir();}
if(tecla==83&&e.altKey){Cargar('_controlador/StockArticuloC.php?Accion=Listar');}
if(tecla==80&&e.altKey){}
if(tecla==67&&e.altKey){}
if(tecla==72&&e.altKey){Cargar('_controlador/HomeC.php');}
if(tecla==27){BotonCancel();}
if(tecla==37){}
if(tecla==39){}
if(tecla==38){}
if(tecla==40){}
if(tecla==13&&e.altKey){BotonValidar();}}