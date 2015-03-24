//SCRIPT COMBO BOX
jQuery.fn.ComboBox=function() {

	var args = arguments[0] || {};
	
	var u = args.url;		// url donde del archivo donde se realiza la consulta a la base de datos
	var q = args.query;		// sql a la base de datos
	var at = args.atribts;	// array de dos valores, el primero almacena el value del option y el segundo el texto del option
	var p = args.param; // array que almacena values de combos anteriores que depende
	var tr = args.trigger;
	var dp = args.depende;
	var multi = args.multi;
	var df = args.defecto;	// selecciona un option por defecto
	var ed = args.editado;
	var dis= args.enable;
	var f = args.funcion;	// evento onchage del select
	var cmb = jQuery(this);	
	
	var m = {

		f_1: function(){	// funcion que realiza la peticion

			/*jQuery.getJSON( u, {'q': q, 'c_1': at['val'], 'c_2': at['txt']}, function(data, textStatus){ 
				m.f_2(data);
			});*/
			
			jQuery.ajax({
				url: u,
				type: 'GET',
				dataType: 'json',
				data: {'q': q, 'c_1': at['val'], 'c_2': at['txt']},
				async: false,
				success: function(data){ m.f_2(data); },
				complete: function(){ 
							
						}
			});
			
		},
		
		f_2: function(data){	
			
			var cad = '';//'+f+'(\''+data[i][at['val']]+'\');
			
			for(var i=0; i<data.length; i++){
				cad = cad + '<option value="'+data[i][at['val']]+'" >'+data[i][at['txt']]+'</option>'; 
				// arma la cadena de options para agregarlos al select
			}
			cmb.html(cad);
			//cmb.attr('onchange',f); // agrega evento onchange
			
			if( ed != '' ){ // carga valor por editado si es diferente de vacio
				cmb.val( ed ); 
			}else{
				if( df != '' ){ cmb.val( df ); } // carga valor por defecto
			} 
			
			if( dis != '1' ){ cmb.prop('disabled',true); }else if( dis == '1' ){ cmb.prop('disabled',false); }
			
		},
		
		f_3: function(){

				//cmb.bind('change', function(){ 
					var v = cmb.find('option:selected').val(); 
					var param = temp + v;
					eval(f+'("'+param+'")'); // eval: ejecuta la funcion que le pasamos como parametro. Ej. eval("funcion()")
					temp = '';
				//});
	
				//cmb.trigger('change');	
		}
	
	};
	
	m.f_1(); // ejecutamos la funcion para cargar nuestro select
	
	var temp = '';
	
	if(p[0]!=''){
		for (x in p){
			temp = temp + p[x] + '", "';
		}
	} else {
		
	}
	
	/*cmb.change(function(){ 
		var v = cmb.find('option:selected').val(); 
		//alert(v);
		//var t = cmb.find('option:selected').text();
		//var param = v+'","'+t;
		var param = temp + v;
		//alert(f+'("'+param+'")');
		eval(f+'("'+param+'")'); // eval: ejecuta la funcion que le pasamos como parametro. Ej. eval("funcion()")
		//alert(f+'()');
		//eval(f+'()');
		//alert(p.length);		
		temp = '';
	});*/
	
	cmb.change(function(){ 
		if(f != ""){
			if( multi == "1" ){
				var vc = cmb.find('option:selected').val();
				var valrs = '';
				for(x in dp){
					valrs = valrs + jQuery('#'+dp[x]).val() + '", "';
				}
				//alert(valrs+vc);
				eval(f+'("'+valrs+vc+'")');
			}else if( multi == "0" ){
				eval(f+'()');
			}
		}
	});

	if( tr=='1' ){ m.f_3(); }

};