Login = function () {
    var usuario = $('#usuario');
    var contraseña = $('#contrasena');
    var Url="_modelo/LoginConsulta.php?Accion=Ingresar&Usuario="+usuario+"&Contra="+contraseña;	
    jQuery.post(Url, jQuery("#Formlogin").serialize(), function () {
        
    });




}