<?php
?>
<div style="background-color: white; margin:0 auto;"id="regactivosequipos">
    <div align="center"><label>Registro de activos de Equipos de C&oacute;mputo</label></div>
    <div id="info_cab" style="display: inline-block; width: 35%">
        <label>&Aacute;rea: <input type="text" id="area" name="area" value=""/></label><br/>
        <label>C&oacute;digo: <input type="text" id="cod" name="cod" value=""/><img src="../images/buscar.png">BUSCAR</label>
        <br/><label>Nombre del equipo: <br/><input type="text" id="nomeq" name="nomeq" value=""/></label><br/>
        <fieldset>
            <legend>Documento Compra</legend>
            <label>Tipo: <select id="tipodoc" name="tipodoc"><option>Factura</option></select></label>
        </fieldset>
            
    </div>
    <div id="Img_equipo" style="display: inline-block">
        <div>
            <img/>
        </div>
        <div>
            <input type="button" id="nuevo" onclick="Limpiar()" name="nuevo" value="Nuevo"/>
            <input type="button" id="modificar" onclick="Modificar()" name="modificar" value="Modificar"/>
            <input type="button" id="grabar" onclick="Grabar()" name="grabar" value="Grabar"/>
        </div>
    </div>




</div>