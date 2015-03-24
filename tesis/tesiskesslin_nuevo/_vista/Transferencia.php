<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
    
    Grabar=function(){
        numtrans=$('#numtrans').val();
        numtrans=$('#numtrans').val();
        numtrans=$('#numtrans').val();
    }
</script>
<div style="background-color: white;">
    <div style="clear: both; height: 30px;"></div>
    <div align="center">
        <label>Registro de Planificaci&oacute;n de Transferencias de equipos de C&oacute;mputo</label>
    </div>
    <div style="clear: both; height: 30px;"></div>
    <div>
        <div style="display:inline-block">
            <label>N° Transferencia: <input type="text" id="numtrans" value="" name="numtrans" /></label>     
        </div> 
        <div style="display:inline-block">
            <fieldset>
                <input type="radio" value="1" name="tipotrans" id="mante">Mantenimiento
                <input type="radio" value="2" name="tipotrans" id="prest">Prestamos
                <input type="radio" value="3" name="tipotrans" id="garan">Garant&iacute;a
                <input type="radio" value="4" name="tipotrans" id="servi">Servicio
            </fieldset>

        </div>
        <div style="display:inline-block"><p>Fecha: <input type="text" id="datepicker"></p></div>
    </div>
    <div>
        <div>
            <div id="Origen" style="display:inline-block">
                <fieldset>
                    <label>Empresa: <input type="text" name="empresaori" id="empresaori" value=""/></label><br/>
                    <label>&Aacute;rea: <select id="areaori" name="areaori"><option value="1">Contabilidad</option></select></label><br/>
                    <label>Campaña: <select id="campañaori" name="campañaori"></select></label><br/>
                    <label>Responsable: <input type="text" name="responsaori" id="responsaori" value=""/></label><br/>
                    <label>Telefono: <input type="text" name="telefori" id="telefori" value=""/></label>  <br/>      
                </fieldset>
            </div>
            <div id="Destino" style="display:inline-block">
                <fieldset>
                    <label>Empresa: <input type="text" name="empresades" id="empresades" value=""/></label><br/>
                    <label>&Aacute;rea: <select id="areades" name="areades"><option value="1">Contabilidad</option></select></label><br/>
                    <label>Campaña: <select id="campañades" name="campañades"></select></label><br/>
                    <label>Responsable: <input type="text" name="responsades" id="responsades" value=""/></label><br/>
                    <label>Telefono: <input type="text" name="telefdes" id="telefdes" value=""/></label> <br/>       
                </fieldset>
            </div>
        </div>
    </div>
    <div>
        <label>Equipos: <select id="Equipo" name="Equipo"><option value="0">Impresora</option></select></label>
        <label>Cantidades: <input type="text" name="cant" id="cant" value=""/></label>
        <label>Responsable de Transferencia: <input type="text" name="resptrans" id="resptrans" value=""/></label>
    </div>
    <div>
        <label>
            Usuario: <input type="text" id="usuario" name="usuario" value=""/>
        </label>
    </div>
    <div>
        <input type="button" id="buscar" value="BUSCAR"/>
        <input type="button" id="nuevo" value="NUEVO"/>
        <input type="button" id="modificar" value="MODIFICAR"/>
        <input type="button" id="grabar" onclick="Grabar()" value="GRABAR"/>
        <input type="button" id="imprimir" value="IMPRIMIR"/>
    </div>
</div>
