//SCRIPT COMBO BOX
jQuery.fn.ComboBox=function() {

	var args = arguments[0] || {};
	
	var u 	= args.url;		// url donde del archivo donde se realiza la consulta a la base de datos
	var q 	= args.query;	// sql a la base de datos
	var at 	= args.atribts;	// array de dos valores, el primero almacena el value del option y el segundo el texto del option
	var df 	= args.defecto;	// selecciona un option por defecto
	var ed 	= args.editado;	// valor de edicion ej. 
	var dis	= args.enable;	// habilita o deshabilita el select
	var f 	= args.funcion;	// evento onchage del select
	var tr	= args.trigger; // lanza el evento onchange de nuestro select al cargar la pagina
	var cmb = jQuery(this);	// hacer referencia al select
	var param = args.param || ''; // se puede pasara como parametro valores que un quiere y usar en otro lado
	
	var m = {

		f_1: function(){	// funcion que realiza la peticion
			
			jQuery.ajax({
				url: u,
				type: 'GET',
				dataType: 'json',
				data: {'q': q, 'c_1': at['val'], 'c_2': at['txt']},
				async: false,
				success: function(data){ m.f_2(data); },
				complete: function(){ 
							if(tr==1){ m.f_3(); } // if trigger es igual a 1, lanza el evento onchange
						}
			});
			
		},
		
		f_2: function(data){	// arma el select agregandole options
			
			var cad = '';
			
			for(var i=0; i<data.length; i++){

				cad = cad + '<option value='+data[i][at['val']]+'>'+data[i][at['txt']]+'</option>'; 
				// arma la cadena de options para agregarlos al select
			}
			cmb.html(cad);	// agrega options al select
			//cmb.attr('onchange',f); // agrega evento onchange
			
			if( ed != '' ){ // carga valor por editado si es diferente de vacio
				cmb.val( ed ); 
			}else{
				if( df != '' ){ cmb.val( df ); } // carga valor por defecto
			} 
			
			//habilita o deshabilita el select
			if( dis != '1' ){ cmb.prop('disabled',true); }else if( dis == '1' ){ cmb.prop('disabled',false); }
		},
		
		f_3: function(){ // 
			var v = cmb.find('option:selected').val();
			
			var nf=0;var p='';
			if(param!=''){
				for(var fn in param){ //Arma parametros para funcion Click
					p=p+'\''+param[fn]+'\',';nf++;
				}
				p=p.substring(0,p.length-1);
				v=v+','+p;
			}
			
			eval(f+'('+v+')'); //ejecuta una funcion cualquiera y le agrega como parametro el value del option seleccionado
		}
	};
	
	m.f_1(); // ejecutamos la funcion para cargar el select
	
	cmb.change(function(){

		m.f_3();
	
	});
	
};