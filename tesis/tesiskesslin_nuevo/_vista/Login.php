<html>
    <head>
        <title>Sistema de Control de Activos</title>
        <meta charset="utf-8">
        <link href="../Css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--webfonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="../js/jquery-1.4.4.js"></script>
        <script language="javascript" src="../js/jquery-1.3.1.min.js"></script>

        <script language="javascript" src="../Controles/DataGrid.php"></script>

        <script language="javascript" src="../funciones/functions.js"></script>

    </head>
    <body>
        <div class="main">
            <div class="login-form">
                <h1>TESIS KESSLIN</h1>
                <div class="head">
                    <img src="../images/user.png" alt=""/>
                </div>
                <form id="Formlogin">
                    <input type="text" class="text" id="usuario" value="Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {
                        this.value = 'USERNAME';
                    }" >
                    <input type="password" id="contrasena" value="Contraseña" onfocus="this.value = '';" onblur="if (this.value == '') {
                        this.value = 'Password';
                    }">
                    <div class="submit">
                        <input type="button" onclick="Login()" value="INGRESAR" >
                    </div>	
                    <p><a href="#">Olvidastes tu contraseña ?</a></p>
                </form>
            </div>
        </div> 
    </body>
</html>