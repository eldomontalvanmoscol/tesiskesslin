<?php 
session_start();
if(isset($_SESSION['Login'])){
   include '_vista/Login.php';  
}else{
?>

<html>
    <head>
        <title>Sistema de Control de Activos</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--webfonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.4.4.js"></script>
        <script language="javascript" src="js/jquery-1.3.1.min.js"></script>

        <script language="javascript" src="Controles/DataGrid.php"></script>

        <script language="javascript" src="funciones/functions.js"></script>

        <script>

        </script>
    </head>
    <body>

    </body>
</html>
<?php }?>