// JavaScript Document
jQuery(document).ready(function (){
	
	var Ancho=(jQuery(window).width()/2)-230;
	jQuery('#SNegocio').dialog({
		autoOpen: false,
		minWidth: 550,
		title: 'Nuevo Socio de Negocio',
		show: 'fast',
		hide: 'fast',
		resizable: false,
		modal: true,
		zIndex: 3999,
		position: [Ancho,60]
		
		});	
	
	jQuery('.ui-widget').css({
							 'font-family':'Sans-serif',
							 'font-size':'9pt'
							 });
	
	
/*	.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; font-size: 1em; }*/
	
});
