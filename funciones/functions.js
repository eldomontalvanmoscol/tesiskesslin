Login = function () {
    var usuario = jQuery('#usuario').val();
    var contraseña = jQuery('#contrasena').val();
    var Url="_modelo/LoginConsulta.php?Accion=Ingresar&Usuario="+usuario+"&Contra="+contraseña;	
    jQuery.post(Url, jQuery("#Formlogin").serialize(), function () {
        
        
    });
    

}

