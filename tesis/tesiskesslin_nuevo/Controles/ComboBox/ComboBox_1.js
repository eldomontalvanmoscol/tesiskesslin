//SCRIPT COMBO BOX
(function(jQuery){
	
jQuery.fn.ComboBox_1=function() {



	var args = arguments[0] || {};
	
	var u = args.url;		// url donde del archivo donde se realiza la consulta a la base de datos
	var q = args.query;		// sql a la base de datos
	var at = args.atribts;	// array de dos valores, el primero almacena el value del option y el segundo el texto del option
	var tr = args.trigger;
	var df = args.defecto;	// selecciona un option por defecto
	var ed = args.editado;	// se le pasa el valor por php <?php $row->CodDpto ?>
	var dis= args.enable;	// activa o desactiva el combo
	var f = args.funcion;	// evento onchage del select
	var cmb = jQuery(this);	// id del select
	
	
	var values = args.values;

this.each(function(){

	var m = {

		f_1: function(){	// funcion que realiza la peticion
		
			var str = '';
		
			for(x in values){
				
				str = str + values[x] + ',';
			}
			
			//str = str.substring(0, str.length-1);

			/*jQuery.getJSON( u, {'q': q, 'c_1': str+at['txt']}, function(data, textStatus){ 
				m.f_2(data);
			});*/
			
			jQuery.ajax({
				url: u,
				type: 'GET',
				dataType: 'json',
				data: {'q': q, 'c_1': str+at['txt']},
				async: false,
				success: function(data){ m.f_2(data); },

			});
			
			
		},
		
		f_2: function(data){	
			
			var cad = '';//'+f+'(\''+data[i][at['val']]+'\');
			var param_vals = '';
			
			
			for(var i=0; i<data.length; i++){
				//alert(at['txt']);
				//cad = cad + '<option value='+data[i][at['val']]+'>'+data[i][at['txt']]+'</option>'; 
				
				for(x in values){
					//alert(values[x]);
					//alert(data[i]['CodDpto']);
					param_vals = param_vals + "'" + data[i][values[x]] + "',";
					//alert(param_vals);
					
				}
				
				param_vals = param_vals.substring(0, param_vals.length-1);
				//var param=data[i][at['txt']];
				
				cad = cad + '<option value="'+param_vals+'" >'+data[i][at['txt']]+'</option>'; 
				param_vals = '';
				//onclick="'+f+'(\''+data[i][at['val']]+'\',\''+data[i][at['txt']]+'\');"
				// arma la cadena de options para agregarlos al select
			}
			
			cmb.html(cad); // agrega options al select
			//cmb.attr('onchange',m.f_3());
			//cmb.attr('onchange',f); // agrega evento onchange al select
			
			
			
			
			if( ed != '' ){ // carga valor por editado si es diferente de vacio
				
				cmb.val( ed ); 
			}else{
				if( df != '' ){ cmb.val( df ); } // carga valor por defecto
			} 
			
			// habilita o deshabilita el select
			if( dis != '1' ){ cmb.prop('disabled',true); }else if( dis == '1' ){ cmb.prop('disabled',false); }
			
		},
		
		f_3: function(){
				
				if(tr==1){
					var param = '';
					var v = cmb.find('option:selected').val(); 
		//var param = temp + v;
					var param = v;
					eval(f+'('+param+')'); // eval: ejecuta la funcion que le pasamos como parametro. Ej. eval("funcion()")
				}else{
					eval(f+'()'); // hace una funcion
				}
			}
	
	};



	m.f_1(); // ejecutamos la funcion para cargar nuestro select

	cmb.change(function(){ m.f_3(); });
	//cmb.attr('onchange',m.f_3());
	
	if(tr=="1"){ cmb.trigger('change'); };

}); //fin each

	
};

})( jQuery );