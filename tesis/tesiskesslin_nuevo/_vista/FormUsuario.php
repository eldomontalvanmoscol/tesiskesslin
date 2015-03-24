<?php
@$_POST['Accion']=="E";
//session_start(); 
header("Cache-Control: no-store, no-cache, must-revalidate");
include("../Conexion/Cx.php");	//Clase de conexion mysqli
$link=Conectarse();
//include("../conexion.php");
//INCLUIMOS LAS CLASES, CONTROLES O COMPONENTES A UTILIZAR
//require('../../Controles/DataGrid_2/Grid.php');
include('../Controles/Arbol_2/Arbol.php');  
include('../Controles/Arbol_2/ArbolDiv.php');
require('../Controles/ComboBox/Combos.php'); 
require('../Controles/DataTime/Data.php');
include('../Controles/Canales/Canal.php');
include('../Controles/Direcciones/Direccion.php');
include('../Controles/CuentasBanco/CuentasBanco.php'); 
include('../Controles/Upload/Upload.php');
include('../Controles/Contactos/Contacto.php');


//include('../../Controles/Search/Search.php');  
include('../Controles/Ubigeo/Ubigeo.php');	
require('../Class/UltimoId.php'); 
include('../Class/IdTabla.php');	//obtiene el id del arbol
//echo $_POST['Accion'];
//echo $_SESSION['IdPersona'];
if(@$_POST['Accion']=="E"){
	$SqlPersona="SELECT IdUsuario,nom_usuario,pass,estado,IdTipoUsuario FROM usuario WHERE IdUsuario=".$_POST['Id']."";	
	$ConsuPer=mysqli_query($link,$SqlPersona);
	$fil = $ConsuPer->fetch_object();
	
	$IdUsuario=$fil->IdUsuario;
	//$Nombre=utf8_encode(chop($fil->Nombre));
	$Nombre=utf8_encode($fil->nom_usuario);
	$estado=$fil->estado;
	$IdTipoUsuario=$fil->IdTipoUsuario;
}else{
	$IdUsuario= CampoTabla($link,'IdUsuario','Usuario')+1;
	$v='174';
	$TDocD='19';
	//$Login="";
}

?>
<link type="text/css" href="../Css/cssSN/estilo.css" rel="stylesheet" />
<style type="text/css">
/* QUITA SCROLL DE LA VENTANA */
html,body { 
  overflow:hidden;
}
  	.ImpotNube1{
	background-image:url(images/link.gif);
	}
	
	.ImportSunat1{
		background-image:url(images/buton.gif);
	}
	.ImportD1{
		background-image:url(images/Import.png);
		
	}
	.ImpotNube1, .ImportSunat1, .ImportD1{
	background-repeat:no-repeat;
	border:transparent;
	background-color:transparent;
	cursor:pointer
	}

</style>


<div id="Retorno"><!--Aqui se retorna las peticiones ajax--></div>
<div id="MenuIzq">
<ul>
  <li onclick="NavegaForm('FormSocio.php','0','0',0);" id="FS" style="background-color: rgb(234, 232, 228);">Socio</li>
  <li onclick="NavegaForm('FormCliente.php','IdTC','PermiC',1);" id="FC">Cliente</li>
  <li onclick="NavegaForm('FormProveedor.php','IdTP','PermiP',2);" id="FP">Proveedor</li>
  <li onclick="NavegaForm('FormTrabajador.php','IdTT','PermiT',3);" id="FT">Trabajador</li>
  <li onclick="NavegaForm('FormUsuario.php','IdTU','PermiU',4);" id="FU">Usuario</li>
  <li onclick="NavegaForm('FormConductor.php','IdTCO','PermiCO',5);" id="FCO">Conductor</li>
  <li onclick="NavegaForm('FormVendedor.php','IdTV','PermiV',6);" id="FV">Vendedor</li>
</ul>
</div>

<div id="VentanaSocioW">
<div style="padding: 10px; height:auto;" >
<form id="formSocio" name="formSocio" method="post" action="" >
<div id="DivSocio" style="width:560px; line-height:5px; margin:0px; float:left; height:auto;" >

    <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
            <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#general1" id="SGeneral">General</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#avanzados1" id="SAvanzado">Avanzados</a></li>
		<li class="ui-state-default ui-corner-top"><a href="#canales1" id="SCanales">Canales</a></li>
        <li class="ui-state-default ui-corner-top"><a href="#contactos1" id="SContactos">Contactos</a></li>
		<li class="ui-state-default ui-corner-top"><a href="#ficheros1" id="SFicheros">Ficheros</a></li>
        <!--<li><a href="#Mensajes1" id="SMensajes">Mensajes</a></li>-->
	</ul>
    <div style="padding-left:0px; padding-right:0px; line-height:10px; height:auto;" id="general1" class="ui-tabs-panel ui-widget-content ui-corner-bottom"> 
<div id="Socios"></div>
<table width="100%" cellspacing="0" cellpadding="3" border="0">
  <tbody><tr>
    <td width="163" align="right">Id</td>
    <td width="385" colspan="2"><label><input type="text" readonly="" value="1071" size="5" id="Id" name="Id"></label>
    			    <label><input type="hidden" value="" id="IdPersona" name="IdPersona"></label></td>
  </tr>
  <tr>
    <td align="right">Tipo documento</td>
    <td colspan="2">
	    <select name="TipoDoc" id="TipoDoc"><option value="19">DNI</option><option value="20">Pasaporte</option><option value="37">Carnet Extranjería</option><option value="43">RUC</option><option value="44">Carnet de extranjeria</option><option value="45">Interno Correlativo</option><option value="46">Part. de nacimiento-identidad</option><option value="47">Otros</option></select>
		    </td>
  </tr>
  <tr>
  	<td align="right">
      Nº documento<span class="colorAsterisco">(*)</span>
    </td>
    <td colspan="2">
      <input type="text" required="" value="" onchange="ValidarNumDoc();" onkeypress="return validarNumerox(event)" maxlength="15" size="15" id="NumDoc" name="NumDoc">
	  <input type="button" onclick="BuscarDatoPer()" value="&nbsp;" class="ImportD1" name="ButonSunatP" id="ButonSunatP" title="Importar datos desde SUNAT">
      <input type="button" class="ImpotNube1" id="sunat" name="sunat" value="&nbsp;" onclick="MM_openBrWindow('http://www.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias','SUNAT','width=680,height=500')" title="Consulta RUC SUNAT">
      </td>
  </tr>
  <tr>
    <td align="right">Nombres y apellidos(*)</td>
    <td colspan="2">
    	<div id="ControlNuevoNom">
    	<input type="text" required="" onpaste="return true" onkeypress="return validarTextoM(event)" value="" style="width:288px" id="Nombres" name="Nombres">  <img width="16" height="16" title="Ingrese nombres y apellidos , en ese orden." alt="Información" style="vertical-align:middle;" src="../ImgSys/info16.png">
        </div>
         
       
    </td>
    <!--ValidaCampo('persona','Nombre','Nombres');-->
  </tr>
  <tr>
     <td align="right">Dirección(*)</td>
     <td colspan="2"><input type="text" required="" onpaste="return true" onkeypress="return validarTextoM(event)" value="" size="45" id="Direccion" name="Direccion"></td>
  </tr>
  <tr>
    <td align="right">Ubigeo</td>
    <td>
				<!--combos comunciantes -->
		<select name="AUbigeo" id="AUbigeo" onchange="UbigeoCambioB()"><option value="01">01-AMAZONAS</option><option value="02">02-ANCASH</option><option value="03">03-APURIMAC</option><option value="04">04-AREQUIPA</option><option value="05">05-AYACUCHO</option><option value="06">06-CAJAMARCA</option><option value="07">07-CALLAO</option><option value="08">08-CUSCO</option><option value="09">09-HUANCAVELICA</option><option value="10">10-HUANUCO</option><option value="11">11-ICA</option><option value="12">12-JUNIN</option><option value="13">13-LA LIBERTAD</option><option value="14">14-LAMBAYEQUE</option><option selected="" value="15">15-LIMA</option><option value="16">16-LORETO</option><option value="17">17-MADRE DE DIOS</option><option value="18">18-MOQUEGUA</option><option value="19">19-PASCO</option><option value="20">20-PIURA</option><option value="21">21-PUNO</option><option value="22">22-SAN MARTIN</option><option value="23">23-TACNA</option><option value="24">24-TUMBES</option><option value="25">25-UCAYALI</option></select>

		<select name="BUbigeo" id="BUbigeo" onchange="UbigeoCambioC()"><option selected="" value="01">01-LIMA</option><option value="02">02-BARRANCA</option><option value="03">03-CAJATAMBO</option><option value="04">04-CANTA</option><option value="05">05-CA?ETE</option><option value="06">06-HUARAL</option><option value="07">07-HUAROCHIRI</option><option value="08">08-HUAURA</option><option value="09">09-OYON</option><option value="10">10-YAUYOS</option></select>
		
		<select name="CUbigeo" id="CUbigeo" onchange="UbigeoFinaliza()"><option selected="" value="01">01-LIMA</option><option value="02">02-ANCON</option><option value="03">03-ATE</option><option value="04">04-BARRANCO</option><option value="05">05-BRE?A</option><option value="06">06-CARABAYLLO</option><option value="07">07-CHACLACAYO</option><option value="08">08-CHORRILLOS</option><option value="09">09-CIENEGUILLA</option><option value="10">10-COMAS</option><option value="11">11-EL AGUSTINO</option><option value="12">12-INDEPENDENCIA</option><option value="13">13-JESUS MARIA</option><option value="14">14-LA MOLINA</option><option value="15">15-LA VICTORIA</option><option value="16">16-LINCE</option><option value="17">17-LOS OLIVOS</option><option value="18">18-LURIGANCHO</option><option value="19">19-LURIN</option><option value="20">20-MAGDALENA DEL MAR</option><option value="21">21-MAGDALENA VIEJA</option><option value="22">22-MIRAFLORES</option><option value="23">23-PACHACAMAC</option><option value="24">24-PUCUSANA</option><option value="25">25-PUENTE PIEDRA</option><option value="26">26-PUNTA HERMOSA</option><option value="27">27-PUNTA NEGRA</option><option value="28">28-RIMAC</option><option value="29">29-SAN BARTOLO</option><option value="30">30-SAN BORJA</option><option value="31">31-SAN ISIDRO</option><option value="32">32-SAN JUAN DE LURIGANCHO</option><option value="33">33-SAN JUAN DE MIRAFLORES</option><option value="34">34-SAN LUIS</option><option value="35">35-SAN MARTIN DE PORRES</option><option value="36">36-SAN MIGUEL</option><option value="37">37-SANTA ANITA</option><option value="38">38-SANTA MARIA DEL MAR</option><option value="39">39-SANTA ROSA</option><option value="40">40-SANTIAGO DE SURCO</option><option value="41">41-SURQUILLO</option><option value="42">42-VILLA EL SALVADOR</option><option value="43">43-VILLA MARIA DEL TRIUNFO</option></select>
		
		<input type="hidden" name="Ubigeo" id="Ubigeo" value="150101">


	</td>
  </tr>
  <tr>
    <td align="right">Sexo</td>
    <td><label><input type="radio" checked="checked" value="M" id="radio8" name="Sexo">Masculino</label>
      <label><input type="radio" value="F" id="radio7" name="Sexo">Femenino</label>
      </td>
  </tr>
  <!--<tr>
    <td width="163" align="right">Email</td>
    <td colspan="2"><input name="EmailLogin" type="email" autocomplete="off"  id="EmailLogin" size="30" value="<?php// echo $Login;?>" onchange="validarLoginBD();"/>
    <input type='hidden' name='validalogin' id='validalogin' value='-1'/>(Login)</td>
  </tr>
  <tr>
    <td align="right">Contrase&ntilde;a</td>
    <td colspan="2"><input name="Password" type="password" id="Password" size="18" value="<?php// echo $Password;?>" />
  	           Repetir <span class="colorAsterisco">(*)<input name="PasswordConf" type="password" id="PasswordConf" size="18" onchange="validarPassword();" value="<?php// echo $Password;?>" /></span></td>
  </tr>-->
  <!--<tr>
    <td align="right">Area o departamento<span class="colorAsterisco"></span></td>
    <td colspan="2"></td>
  </tr>
-->
  <tr>
    <td align="right">Fecha de Nacimiento</td>
    <td colspan="2"><input type="text" readonly="readonly" value="" id="FNacimiento" name="FNacimiento" class="hasDatepicker" size="12"><img class="ui-datepicker-trigger" src="images/calendar.gif" alt="..." title="..."></td>
  </tr>
  <tr>
    <td align="right">Nacionalidad</td>
    <td colspan="2"><label>
          </label>
      <select name="Nacionalidad" id="Nacionalidad"><option value="1">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="4">American Samoa</option><option value="5">Andorra</option><option value="6">Angola</option><option value="7">Anguilla</option><option value="8">Antarctica</option><option value="9">Antigua and Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="12">Aruba</option><option value="13">Ascension</option><option value="14">Australia</option><option value="15">Austria</option><option value="16">Azerbaijan</option><option value="17">Bahamas</option><option value="18">Bahrain</option><option value="19">Bangladesh</option><option value="20">Barbados</option><option value="21">Belarus</option><option value="22">Belgium</option><option value="23">Belize</option><option value="24">Benin</option><option value="25">Bermuda</option><option value="26">Bhutan</option><option value="27">Bolivia</option><option value="28">Bosnia and Herzegovina</option><option value="29">Botswana</option><option value="30">Brazil</option><option value="31">British Indian Ocean Territory</option><option value="32">Brunei Darussalam</option><option value="33">Bulgaria</option><option value="34">Burkina Faso</option><option value="35">Burundi</option><option value="36">C?te D'Ivoire</option><option value="37">Cambodia</option><option value="38">Cameroon</option><option value="39">Canada</option><option value="40">Cape Verde</option><option value="41">Cayman Islands</option><option value="42">Central African Republic</option><option value="43">Chad</option><option value="44">Chile</option><option value="45">China</option><option value="46">Christmas Island</option><option value="47">Cocos(Keeling)Island</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="50">Congo</option><option value="51">Congo, Democratic Republic of the</option><option value="52">Cook Islands</option><option value="53">Costa Rica</option><option value="54">Croatia</option><option value="55">Cuba</option><option value="56">Cyprus</option><option value="57">Czech Republic</option><option value="58">Denmark</option><option value="59">Djibouti</option><option value="60">Dominica</option><option value="61">Dominican Republic</option><option value="62">Ecuador</option><option value="63">Egypt</option><option value="64">El Salvador</option><option value="65">Equatorial Guinea</option><option value="66">Eritrea</option><option value="67">Estonia</option><option value="68">Ethiopia</option><option value="69">Falkland Islands (Malvinas)</option><option value="70">Faroe Islands</option><option value="71">Fiji</option><option value="72">Finland</option><option value="73">France</option><option value="74">French Guiana</option><option value="75">French Polynesia</option><option value="76">Gabon</option><option value="77">Gambia</option><option value="78">Georgia</option><option value="79">Germany</option><option value="80">Ghana</option><option value="81">Gibraltar</option><option value="82">Greece</option><option value="83">Greenland</option><option value="84">Grenada</option><option value="85">Guadeloupe</option><option value="86">Guam</option><option value="87">Guatemala</option><option value="88">Guernsey</option><option value="89">Guinea</option><option value="90">Guinea-Bissau</option><option value="91">Guyana</option><option value="92">Haiti</option><option value="93">Holy See (Vatican City State)</option><option value="94">Honduras</option><option value="95">Hong Kong</option><option value="96">Hungary</option><option value="97">Iceland</option><option value="98">India</option><option value="99">Indonesia</option><option value="100">Inmarsat Atlantic Ocean-East</option><option value="101">Inmarsat Atlantic Ocean-West</option><option value="102">Inmarsat Indian Ocean</option><option value="103">Inmarsat Pacific Ocean</option><option value="104">Inmarsat Single Number Access</option><option value="105">Iran</option><option value="106">Iraq</option><option value="107">Ireland</option><option value="108">Isle of Man</option><option value="109">Israel</option><option value="110">Italy</option><option value="111">Jamaica</option><option value="112">Japan</option><option value="113">Jersey</option><option value="114">Jordan</option><option value="115">Kazakhstan</option><option value="116">Kenya</option><option value="117">Kiribati</option><option value="118">Korea, Democratic People's Republic of</option><option value="119">Korea, Republic of</option><option value="120">Kuwait</option><option value="121">Kyrgyz Republic</option><option value="122">Lao People's Democratic Republic</option><option value="123">Latvia</option><option value="124">Lebanon</option><option value="125">Lesotho</option><option value="126">Liberia</option><option value="127">Libyan Arab Jamahiriya</option><option value="128">Liechtenstein</option><option value="129">Lithuania</option><option value="130">Luxembourg</option><option value="131">Macao</option><option value="132">Macedonia</option><option value="133">Madagascar</option><option value="134">Malawi</option><option value="135">Malaysia</option><option value="136">Maldives</option><option value="137">Mali</option><option value="138">Malta</option><option value="139">Marshall Islands</option><option value="140">Martinique</option><option value="141">Mauritania</option><option value="142">Mauritius</option><option value="143">Mayotte</option><option value="144">Mexico</option><option value="145">Micronesia</option><option value="146">Moldova</option><option value="147">Monaco</option><option value="148">Mongolia</option><option value="149">Montserrat</option><option value="150">Morocco</option><option value="151">Mozambique</option><option value="152">Myanmar</option><option value="153">Namibia</option><option value="154">Nauru</option><option value="155">Nepal</option><option value="156">Netherlands</option><option value="157">Netherlands Antilles</option><option value="158">New Caledonia</option><option value="159">New Zealand</option><option value="160">Nicaragua</option><option value="161">Niger</option><option value="162">Nigeria</option><option value="163">Niue</option><option value="164">Norfolk Island</option><option value="165">Northern Mariana Islands</option><option value="166">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="169">Palau</option><option value="170">Palestinian Territory, Occupied</option><option value="171">Panama</option><option value="172">Papua New Guinea</option><option value="173">Paraguay</option><option value="174">Peru</option><option value="175">Philippines</option><option value="176">Poland</option><option value="177">Portugal</option><option value="178">Puerto Rico</option><option value="179">Qatar</option><option value="180">Reunion</option><option value="181">Romania</option><option value="182">Russian Federation</option><option value="183">Rwanda</option><option value="184">S?o Tome and Principe</option><option value="185">Saint Helena</option><option value="186">Saint Kitts and Nevis</option><option value="187">Saint Lucia</option><option value="188">Saint Pierre and Miquelon</option><option value="189">Saint Vincent and the Grenadines</option><option value="190">Samoa</option><option value="191">San Marino</option><option value="192">Saudi Arabia</option><option value="193">Senegal</option><option value="194">Serbia and Montenegro</option><option value="195">Seychelles</option><option value="196">Sierra Leone</option><option value="197">Singapore</option><option value="198">Slovakia</option><option value="199">Slovenia</option><option value="200">Solomon Islands</option><option value="201">Somalia</option><option value="202">South Africa</option><option value="203">Spain</option><option value="204">Sri Lanka</option><option value="205">Sudan</option><option value="206">Suriname</option><option value="207">Swaziland</option><option value="208">Sweden</option><option value="209">Switzerland</option><option value="210">Syria</option><option value="211">Taiwan</option><option value="212">Tajikistan</option><option value="213">Tanzania</option><option value="214">Thailand</option><option value="215">Timor-Leste</option><option value="216">Togo</option><option value="217">Tokelau</option><option value="218">Tonga</option><option value="219">Trinidad and Tobago</option><option value="220">Tunisia</option><option value="221">Turkey</option><option value="222">Turkmenistan</option><option value="223">Turks and Caicos Islands</option><option value="224">Tuvalu</option><option value="225">Uganda</option><option value="226">Ukraine</option><option value="227">United Arab Emirates</option><option value="228">United Kingdom</option><option value="229">United States</option><option value="230">Uruguay</option><option value="231">Uzbekistan</option><option value="232">Vanuatu</option><option value="233">Venezuela</option><option value="234">Viet Nam</option><option value="235">Virgin Islands, British</option><option value="236">Virgin Islands, U.S.</option><option value="237">Wallis and Futuna Islands</option><option value="238">Yemen</option><option value="239">Zambia</option><option value="240">Zimbabwe</option></select></td>
  </tr>

  <tr>
    <td align="right">Nivel de permiso</td>
    <td colspan="2">   
      <select name="JefeArea">
        <option value="5">Nivel 4 - Permisos básicos de usuario</option>
        <option value="4">Nivel 3 - Permisos de Encargado de Almacen</option>
        <option value="3">Nivel 2 - Permisos de Jefe de Área</option>
        <option value="2">Nivel 1 - Permisos de Jefe de TI</option>
        <option value="1">Nivel 0 - Permisos root (sólo para desarrolladores)</option>
      </select> 
          <img width="16" height="16" id="Niveles" alt="Información" style="vertical-align:middle;" src="../ImgSys/info16.png" title="Estos niveles están disponibles sólo para usuarios activos del sistema.">
        </td>
  </tr>

  
  

</tbody></table>
</div>
    
    
</div>  <!--Cierra div Tabs-->

</div>  <!--Cierra div DivSocio-->
<div id="DivFlotante" style=" padding:10px; position:absolute; left:10px;background-color:#F8F0DA; text-shadow:#999; bottom:80px; border:1px double #999; border-radius:10px; display:none">
	<div style="font-size:18px; text-align:right; margin-right:5px; cursor:pointer; background-color:#E6D595; padding:5px; border:1px double #999; border-radius:5px;" onclick="jQuery('#DivFlotante').hide()"><span>X</span></div>
	<div id="InfoPersonaSunat" style=" width:530px;height:200px; margin-top:5px; overflow-y:scroll"></div>
</div>



    <div style="width:560px;">
    <p align="center">
        <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="BotonValidar();" style="float:left;" />
        <input type="button" name="btnCerrar" id="Cerrar" value="Cerrar" style="float:right;" onclick="window.close();" />
        <input type="button" name="btnNuevo" id="Nuevo" value="Nuevo" style="float:right;" />
    </p>
    </div>
<div id="DivVeriCod"></div>

</form>
</div>
</div>
<!--<script type="text/javascript">

		$(document).ready(function(){
		
		var TipoEmpresa='<?php //echo $_POST['Accion']; ?>';
		
		BuscarDatoPer=function()
		{
			jQuery('#InfoPersonaSunat').html('');
			var Ruc=jQuery('#NumDoc').val();
			var TipoEmp=jQuery('#TipoDoc option:selected').val();
			if(TipoEmp==43)
			{
				if(Ruc==''){
					alert("Por favor ingrese <?php echo $_SESSION['Trib_NumContrib']; ?> del socio");
					jQuery('#NumDoc').focus();
				}else
				{
					if(isNaN(Ruc))
					{
						alert("El ruc no puede ser texto");
						jQuery('#NumDoc').val('');
						jQuery('#NumDoc').focus();
					}else{
						ValidaRucSocio();
					}
				}
			}else{
				alert("Esta herramiento solo se puede usar con el tipo documento '<?php echo $_SESSION['Trib_NumContrib']; ?>' del socio");
			}
		}
		
		ValidaRucSocio=function()
		{
			var params="RUC="+jQuery('#NumDoc').val()+"";
			var UrlCrea= "<?PHP echo "http://".$_SERVER['HTTP_HOST']."/".$_SESSION['ConfG_RutaRelativaS']; ?>Componentes/SocioNegocio/ValidaRuc.php?Tipo="+TipoEmpresa;
			var Respuesta='';
			jQuery.ajax({
				url: UrlCrea,
				type: 'POST',
				data: params,
				success: function(data){
						jQuery('#DivVeriCod').html(data);
						if(jQuery('#nbolean').val()>0){
							jQuery('#NumDoc').val('');
							jQuery('#NumDoc').focus();
							alert("Este documento ya existe");
						}else{
							FuncValidaCampoS();
						}
					}
				});
		}
		
		FuncValidaCampoS=function(){
			var Ruc=jQuery('#NumDoc').val();
			var CampoRuc='NumDoc';
			var CampoNom='Nombres';
			var CampoDir='Direccion';
			var IdBotonCS='btnGuardar';
			var DivCombo='ControlNuevoNom';
			var TamanoCajNomP=45;
			var DivInfoPer='InfoPersonaSunat';
			jQuery('#ButonSunatP').removeClass('ImportD1');
			jQuery('#ButonSunatP').addClass('ImportSunat1');
			jQuery('#InfoPersonaSunat').load("ExtraeInfoPer.php",{'RucPSc':Ruc,'IdCRuc':CampoRuc,'IdCNomb':CampoNom,'IdCDirec':CampoDir,'IdBotonCS':IdBotonCS,'DivCombo':DivCombo,'DivInfoPer':DivInfoPer,'TamanoCajNomP':TamanoCajNomP},function(){
				jQuery('#ButonSunatP').removeClass('ImportSunat1');
				jQuery('#ButonSunatP').addClass('ImportD1');
				jQuery('#DivFlotante').show();
			})
		}
		
	})

jQuery('#NumDoc').keydown(function(event){
	if(event.keyCode==13){
		BuscarDatoPer();
	 }
	 
})

validarNumerox=function(e) {
	
	if(jQuery('#TipoDoc').val()==20 || jQuery('#TipoDoc').val()==73 || jQuery('#TipoDoc').val()==45 || jQuery('#TipoDoc').val()==44 || jQuery('#TipoDoc').val()==46 || jQuery('#TipoDoc').val()==47){			//id de carne empresa y empresa extranjera
		return true;
	
	}else{	
		 	//alert("valida");
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla==8||tecla==0) return true; //Tecla de retroceso (para poder borrar)
			patron = /[0-9]/; //ver nota
			te = String.fromCharCode(tecla);
			return patron.test(te);
	}
	
	
	
	
	/*tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8||tecla==0) return true; //Tecla de retroceso (para poder borrar)
	patron = /[0-9]/; //ver nota
	te = String.fromCharCode(tecla);
	return patron.test(te);*/
}

//VALIDA FORMULARIO
alerta=function(campo){
	var mens="Por favor complete el campo " + campo;
	//alert("Por favor complete el campo " + campo)
	Mensajes(mens,0,5000);
}

/*validarPassword=function(){
	if (jQuery('#Password').val()!=jQuery('#PasswordConf').val()){	
		Mensajes("LOS PASSWORD NO SON IGUALES",0,5000);
		alert("LOS PASSWORD NO SON IGUALES");
		jQuery('#PasswordConf').focus();
		jQuery('#PasswordConf').val('');	
	}
}*/


BotonValidar=function(){
	
/*	if(jQuery('#DescArea').val()==''){
		 jQuery("#BotonArea").trigger("click");
		alerta('\"Area o Departamento\"');
	}	
	else*/ if(jQuery('#NumDoc').val()==""){
		jQuery('#NumDoc').focus();	
		alerta('\"Nro de Documento\"');		
	}else{  
		if (jQuery('#Nombres').val()==""){
			jQuery('#Nombres').focus();	
			alerta('\"Nombre\"');		
		}else{
		
			if (jQuery('#Direccion').val()==""){
				jQuery('#Direccion').focus();
				alerta('\"Direccion\"');			
			}else{
				jQuery('#btnGuardar').attr('disable',true);
				jQuery('#btnCancelar').attr('disable',true);
				GuardarSocio();
			}
		}
	}
}
	
GuardarSocio=function(){
		
	var Id='<?php echo $_POST['Id']?>';
	var Accion='<?php echo $_POST['Accion']?>';	
	//alert(Accion+' '+Id) //C
	var UrlCreaSocio="SocioNegocioInserta.php?Accion="+Accion+"&Id="+Id; //SocioNegocioInserta.php?Accion=C&Id=
	//alert(UrlCreaSocio);
	var datos=jQuery('#formSocio').serialize();
	// Var Para La Replicacion
	var idsocio = jQuery("#Id").val();

	if(Accion=="C"){
		var Msj="El Socio ha sido creado correctamente. Ahora puede crear las otras entidades.";
		var MsjE="No se pudo crear Cliente."
	}else{
		var Msj="El Socio ha sido editado correctamente.";
		var MsjE="Error al editar Socio.";
	}
	//Para Insert/Update
		
	jQuery.ajax({
				url: UrlCreaSocio,
				type: 'POST',
				data: datos,
				dataType:'Script',
				async: false,
				error: function(){ 	Mensajes(MsjE,0,8000);	},
				success: function(data){
							if(Accion!="E"){
								UsuarioMulti();
							}
							AccionSocio();
							Mensajes(Msj,1,8000);
							//UsuarioMulti();
							}
				});
	
	
	
}///funcion

UsuarioMulti = function(){
	jQuery.ajax({
					url: 'SocioInsertaMulti.php',
					type: 'POST',
					data: {Accion: "SI"},
					success: function(data){
							//FINISH
							}
		});
}


ValidarNumDoc=function(a){
	
	var Accion=jQuery('#Accion').val();
	if(Accion=='C'){
		var TipoAcc='C';
	}else{
		var TipoAcc='E';
	}
	
	
	if(jQuery('#NumDoc').val()!=''){
		var params="&TipoDoc="+jQuery('#TipoDoc').val()+"&NumDoc="+jQuery('#NumDoc').val()+"&Accion="+TipoAcc+"&IdPersona="+jQuery('#Id').val();
		var url='../../_modelo/PersonaValida.php';
		jQuery.ajax({
				url: url,
				type: 'POST',
				data: params,
				success: function(data){
							jQuery('#Retorno').html(data);
				}
		});
		
	}	
}//end function

/*validarLoginBD=function(){
	
	var s = jQuery('#EmailLogin').val();
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;	
	if (filter.test(s)){							 
		ValidaCampo('persona','Login','EmailLogin','IdPersona');		
	    jQuery('#Password').val('');
	}
	else
	{
		//alert("Ingrese una direccion de correo valida");
		Mensajes("Ingrese una direccion de correo valida",0,5000);		
		jQuery('#EmailLogin').val('');			
		jQuery('#EmailLogin').focus();						
	}	
}*/

jQuery(document).ready(function(){
	jQuery('#tabs').tabs();
	//var AccionSoc='<?php //echo $_POST['Accion']; ?>';
	/*if(AccionSoc=='C'){
		jQuery('#NumDoc').focus();
	}*/
});

jQuery('#Nuevo').click(function(){
	jQuery('#IdSocio').val('');
	jQuery('#NombreTemp').val('');
	jQuery('#NumDocTemp').val('');
	jQuery('#UbigeoTemp').val('');
	jQuery('#IdTC').val('0');
	jQuery('#IdTP').val('0');
	jQuery('#IdTT').val('0');
	jQuery('#IdTU').val('0');
	jQuery('#IdTV').val('0');
	jQuery('#IdTCO').val('0');
	jQuery('#IdTO').val('0');
	jQuery('#IdSocioElimina').val('');
	jQuery('#NSocioElimina').val('');
	jQuery('#Accion').val('C');
	jQuery("#Principal").load('SociosFormulario.php');			   
});

if(jQuery('#Accion').val()=='E'){
	jQuery('.MenuHerraSelect').removeClass('MenuHerraSelect');
   jQuery('#Formulario').addClass('MenuHerraSelect');
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

jQuery('#TipoDoc').bind('change',function(){
	var valor=jQuery(this).val();
	if(valor==45){
		
		var Url='SocioNegocioConsulta.php?Accion=CorreInterno';
		
		jQuery.ajax({
			url: Url,
			type: 'GET',
			dataType: 'script',
			async: false,
			success: function(){ jQuery('#NumDoc').attr('readonly','readonly');
				jQuery('#Nombres').focus();
			}
		});

	}else{
		jQuery('#NumDoc').removeAttr('readonly');
		//jQuery('#NumDoc').val('');
		//jQuery('#Direccion').val('');
		jQuery('#NumDoc').focus();
	}
	
	//jQuery('#Nombres').focus();
	
});

InsertaNumDocDir=function(NumDoc,Pais){
	
	jQuery('#NumDoc').val(NumDoc);
	jQuery('#Direccion').val(Pais);
}

jQuery('#Nacionalidad').ComboBox({ //combo Nacionalidad
	url: "../../Controles/ComboBox/combo_query.php",
	query: "SELECT * FROM paises ORDER BY NombrePais ASC",
	atribts: {"val": "IdPais", "txt": "NombrePais"},
	defecto: '<?php echo $v ?>', 
	editado: '<?php echo $IdPais ?>',
	enable: '1', // 0: deshabilitado - 1: habilitado
	funcion: "", // funcion que se ejecuta al hacer onchange
	trigger: "0" //lanza onchange al cargar la pagina
});

jQuery('#TipoDoc').ComboBox({ // combo Tipo Documento
	url: "../../Controles/ComboBox/combo_query.php",
	query: "SELECT * FROM tipo_documentos  WHERE TipoDoc=2",
	atribts: {"val": "IdTipoDoc", "txt": "Nombre"},
	defecto: '<?php echo $TDocD; ?>', 
	editado: "<?php echo $IdTipoDoc ?>",
	enable: "1", // 0: deshabilitado - 1: habilitado
	funcion: "ValidarNumDoc", // funcion que se ejecuta al hacer onchange
	trigger: "0" //lanza onchange al cargar la pagina
});

jQuery('#Niveles').attr('title','Estos niveles están disponibles sólo para usuarios activos del sistema.');

Calendario('FNacimiento');
</script>-->