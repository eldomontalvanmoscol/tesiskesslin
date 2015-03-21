 $(document).ready(function () {
                $('#ingresar_login').click(function () {
                    usuario = $('#login-name').val();
                    password = $('#login-pass').val();

                    if (usuario === '') {
                        alert('Ingresar Usuario');
                        return false;
                    }
                    if (password === '') {
                        alert('Ingresar Contraseña');
                        return false;
                    }

                    var parametros = {
                        vs_var1: usuario,
                        vs_var2: password
                    };
                    $.ajax({
                        data: parametros,
                        //                                    funcion:nVerificarUsuario2,
                        url: 'controller/login.php',
                        type: 'POST',
                        success: function (result, request) {

                            var va_resultado;

                            va_resultado = result.split('_|_');

                            if (va_resultado[1] === '1') {
                                window.location.href = 'registrado.html';
                            } else {
                                alert("No se pudo loguear");
                            }
                        },
                        failure: function () {
                            alert('fallo');
                        }
                    });
                });
                $('#registrar').click(function () {
                    nombre = $('#first_name').val();
                    apellido = $('#last_name').val();
                    display_name = $('#display_name').val();
                    email = $('#email').val();
                    password = $('#password').val();
                    password_confirmacion = $('#password_confirmation').val();

                    if (nombre === '') {
                        alert('Ingresar nombre');
                        return false;
                    }
                    if (apellido === '') {
                        alert('Ingresar apellido');
                        return false;
                    }
                    if (display_name === '') {
                        alert('Ingresar id de usuario');
                        return false;
                    }
                    if (email === '') {
                        alert('Ingresar email');
                        return false;
                    }
                    if (password_confirmacion === '') {
                        alert('Ingresar password de verificacion');
                        return false;
                    }
                    if (password === '') {
                        alert('Ingresar password');
                        return false;
                    }
                    
                    if(password_confirmacion!==password){
                        alert('Las contraseñas no coinciden');
                        return false;
                    }
                    var parametros = {
                        vs_var1: nombre,
                        vs_var2: apellido,
                        vs_var3: display_name,
                        vs_var4: email,
                        vs_var5: password,
                        vs_var6: password_confirmacion
                    };
                    $.ajax({
                        data: parametros,
                        //                                    funcion:nVerificarUsuario2,
                        url: 'controller/registro.php',
                        type: 'POST',
                        success: function (result, request) {

                            var va_resultado;

                            va_resultado = result.split('_|_');

                            if (va_resultado[1] === '1') {
                                alert('Registrado Exitosamente');
                            } else {
                                alert("No se pudo loguear");
                            }
                        },
                        failure: function () {
                            alert('fallo');
                        }
                    });
                });
            });