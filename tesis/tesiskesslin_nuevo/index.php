<?php
session_start();
include_once 'Conexion/Cx.php';
if (!isset($_SESSION['LoginEmail'])) {
    header("Location:_controlador/LoginC.php");
} else {
    ?>
    <html>
        <head>
            <title>Sistema de Control de Activos</title>
            <meta charset="utf-8">
            <link href="Css/style.css" rel='stylesheet' type='text/css' />
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!--webfonts-->
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
            <script type="text/javascript" src="js/jquery-1.4.4.js"></script>
            <script language="javascript" src="js/jquery-1.3.1.min.js"></script>

            <script language="javascript" src="Controles/DataGrid.php"></script>

            <script language="javascript" src="funciones/functions.js"></script>
            <link rel="stylesheet" type="text/css" href="Css/dropdowns.css">
            <link rel="stylesheet" type="text/css" href="Css/dropdowns-skin-discrete.css">
            <script type="text/javascript">

                carga = function (id) {
                    var src = "";
                    if (id === 'mclientes') {
                        src = '_vista/Clientes.php';
                    }
                    if (id === 'musuarios') {
                        src = '_vista/Usuario.php';
                    }
                    if (id === 'ptransferencia') {
                        src = '_vista/Transferencia.php';
                    }
                    if (id === 'pRegAcitvosEquipos') {
                        src = '_vista/RegAcitvosEquipos.php';
                    }
                    $('#contenido').attr('src', src);

                }

            </script>
        </head>
        <body>
            <div class="dropdowns">

                <a class="toggleMenu" >Menu</a>
                <ul class="nav">
                    <li  class="test">
                        <a id ="inicio">Home</a>
                    </li>
                    <li>
                        <a href="#">Mantenimiento</a>

                        <ul>
                            <li><a id="mclientes"   onclick="carga('mclientes')" href="#" >Mant. Clientes</a></li>
                            <li><a id="musuarios"   onclick="carga('musuarios')" href="#"  >Mant. Usuarios</a></li>
                            <li><a id="mproductos"  onclick="carga('mproductos')" href="#"  >Mant. Productos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Procesos</a>

                        <ul>
                            <li><a id="pgingreso" href="#"  >Guia de Ingreso</a></li>
                            <li><a id="pgsalida" href="#"  >Guia de Salida</a></li>
                            <li><a id="ptransferencia" onclick="carga('ptransferencia')" href="#" >Transferencia</a></li>
                            <li><a id="pRegAcitvosEquipos" onclick="carga('pRegAcitvosEquipos')" href="#" >Reg. Acitvos de Equipos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Reportes</a>

                        <ul>
                            <li><a id="rproductos" >Productos</a></li>
                            <li><a id="rsalida" >Guia de Salida</a></li>
                        </ul>

                    </li>
                </ul>
            </div>

            <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script type="text/javascript" src="js/dropdowns.js"></script>
            <script>
                                $(".dropdowns").dropdowns();
            </script>
            <iframe  height="100%" width="100%" id="contenido" ></iframe>
            <script>

                $("#contenido").contents().find("body").css({color: 'red'});
                $('#contenido').load(function () {
                    $(this).contents().find('body').attr('id', 'contenidobody')
                    $(this).contents().find('body').attr('style', 'margin:0 auto')
                });
            </script>
        </body>
    </html>
    <?php
}?>