<?php
class Conexion {
    // Singleton
    private static $instancia=null;
    private $cn=null;


    public static function getInstancia() {
        try {
            if(self::$instancia==null) {
                self::$instancia=new Conexion();
            }
        }
        catch (Exception $e) {
            throw $e;
        }
        return self::$instancia;
    }

    // Singleton
    function __construct() {
        try {
            $cn=mysql_connect("localhost:8080","root","");
            mysql_select_db("tesiskeslin");

        }
        catch(Exception $ex) {
            throw new Exception("Error al intentarse Conectarse...");
        }
    }

    public function ejecutarConsulta($sql) {
        
        try {
            $lista=array();

            $rs=mysql_query($sql);
            while($fila=mysql_fetch_assoc($rs)) {
                $lista[]=$fila;
            }
            if(count($lista)>0) {
                return $lista;
            }
           mysql_free_result($rs);
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }


    public function ejecutarActualizacion($sql) {
        try {
            mysql_query($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }
	
	public function cerrarConexion() {
        try {
            mysql_close();
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }	
}

?>