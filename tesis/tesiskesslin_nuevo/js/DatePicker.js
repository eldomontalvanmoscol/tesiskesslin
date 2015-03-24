
function Calendario(Campo){

	jQuery.datepicker.regional['es'] = { //CONFIGURACION A ESPAÑOL
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd-mm-yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
	  title: 'calendario',
      yearSuffix: ''};
   jQuery.datepicker.setDefaults(jQuery.datepicker.regional['es']);
		
	jQuery( "#"+Campo+"" ).datepicker({
		showOn: "button",
		buttonImage:"ImgSys/Calendar.png",
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		 yearRange: '-70:+15'
	});
	
	jQuery( "#"+Campo+"" ).attr('size','12');
	
}