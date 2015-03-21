Login = function () {
    var usuario = jQuery('#usuario').val();
    var contraseña = jQuery('#contrasena').val();
    var Url="_modelo/LoginConsulta.php?Accion=Ingresar&Usuario="+usuario+"&Contra="+contraseña;	
    jQuery.post(Url, jQuery("#Formlogin").serialize(), function () {
        
        
    });
    

}


GuiaIngreso= function () {
    
    var Url="_modelo/GuiaIngreso.php?Accion=Listar";	
    jQuery.post(Url, '', function () {
        
        
    });

}