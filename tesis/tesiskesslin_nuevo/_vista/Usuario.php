<?php ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>
<link rel="stylesheet" href="../Css/estilo.css">
<!-- FRAMEWORK PROTOTYPE --> 
<!--<script type="text/javascript" src="../Scripts/prototype.js"></script>-->
<script type="text/javascript" src="../Scripts/src/scriptaculous.js"></script>
<script type="text/javascript" src="../Controles/ToolTips/ToolTips.js"></script>
<link href="../Controles/ToolTips/Estilo.css" rel="stylesheet" type="text/css" /> 

    
<!--<script type="text/javascript" src="../Scripts/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js"></script>-->
<script type="text/javascript" src="../Scripts/ValidaTexto.js"></script>
<script type="text/javascript" src="../Scripts/DatePicker.js"></script>
<script type="text/javascript" src="../Controles/ComboBox/ComboBox.min.js"></script>

<link type="text/css" href="../Css/custom/jquery.custom.css" rel="stylesheet" />
<link type="text/css" href="../Css/estilo.css" rel="stylesheet" />
<!--editor html jquery-->
<script type="text/javascript" src="../Scripts/jquery.cleditor.min.js"></script>
<link type="text/css" href="../Css/jquery.cleditor.css" rel="stylesheet" />
</head>
<body>
    <div id="tabs" style="height:97%;">
        <ul>
            <li><a href="#ListaU">Lista</a></li>
            <li><a href="#DatosU">Datos</a></li>
        </ul>
        <div id="ListaU" style="height:auto;padding:10px;height: 80%;">
            <?php include ('ListaUsuario.php');?>
        </div>
        <div id="DatosU" style="height:auto;padding:10px;height: 80%;">
            <?php include ('FormUsuario.php');?>
        </div>
    </div>
</body>
</html>