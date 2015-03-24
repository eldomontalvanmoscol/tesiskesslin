<?php
include('../Conexion/Cx.php');
$link=  Conectarse(); // llamamos a funcion conexion y la guardamos en la varibale link
$accion=$_REQUEST['Accion'];//obtenemos la variable POST o GET Accion
$vs_var1 = isset($_REQUEST['vs_var1']) ? $_REQUEST['vs_var1'] : null;
$vs_var2 = isset($_REQUEST['vs_var2']) ? $_REQUEST['vs_var2'] : null;
$vs_var3 = isset($_REQUEST['vs_var3']) ? $_REQUEST['vs_var3'] : null;
$vs_var4 = isset($_REQUEST['vs_var4']) ? $_REQUEST['vs_var4'] : null;
$vs_var5 = isset($_REQUEST['vs_var5']) ? $_REQUEST['vs_var5'] : null;
$vs_var6 = isset($_REQUEST['vs_var6']) ? $_REQUEST['vs_var6'] : null;
$vs_var7 = isset($_REQUEST['vs_var7']) ? $_REQUEST['vs_var7'] : null;
$vs_var8 = isset($_REQUEST['vs_var8']) ? $_REQUEST['vs_var8'] : null;
$vs_var9 = isset($_REQUEST['vs_var9']) ? $_REQUEST['vs_var9'] : null;
$vs_var10 = isset($_REQUEST['vs_var10']) ? $_REQUEST['vs_var10'] : null;
$vs_var11 = isset($_REQUEST['vs_var11']) ? $_REQUEST['vs_var11'] : null;
$vs_var12 = isset($_REQUEST['vs_var12']) ? $_REQUEST['vs_var12'] : null;
$vs_var13 = isset($_REQUEST['vs_var13']) ? $_REQUEST['vs_var13'] : null;
function InsertarTransferencia($link){
    
}
function InsertarTransferenciaCab($link){
    
    
}
function InsertarTransferenciaDet($link){
    
}

SWITCH ($accion){
    case 'InsertarTransferencia':
         InsertarTransferencia($link);
         break;
    
    
}