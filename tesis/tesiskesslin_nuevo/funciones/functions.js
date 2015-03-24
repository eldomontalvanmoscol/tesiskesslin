Login = function () {
    var usuario = jQuery('#usuario').val();
    var contraseña = jQuery('#contrasena').val();
    var Url="../_modelo/LoginConsulta.php?Accion=Ingresar&Usuario="+usuario+"&Contra="+contraseña;	
	                    var parametros = {
							vs_var1: usuario,
							vs_var2: contraseña
                    };
                jQuery.ajax({
			data: parametros,
                        //funcion:nLogin,
                        url: Url,
                        type: 'POST',
                        success: function (result, request) {
                            
                            var va_resultado;
                                
                            va_resultado = result.split('_|_');
                            
                            if (va_resultado[0] === '1' ) {
                                window.location.href='../index.php';
                            } else {
                                alert("No se pudo loguear");
                                return false;
                            }
                        },
                        failure: function () {
                            alert('fallo');
                        }
                    });
                

}

