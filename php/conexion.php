<?php

define('DB_HOST', 'mysql:host=localhost;dbname=tutoriales');
define('DB_USER', 'root');
define('DB_PASS', '');

class DB
{
    private static $instancia;
    private $con;

    private function __construct()
    {
        try {
            $this->con = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->con->exec("set names utf8");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("<p>No se ha conectado a la DB " . $e->getMessage());
        }
    }

    private static function conexion()
    {
        if (!isset(self::$instancia)) {
            self::$instancia = new DB;
        }
    }

    private static function prepare($sql)
    {
        return self::$instancia->con->prepare($sql);
    }


    public static function editar()
    {
        self::conexion();
        $sql = "SELECT * FROM listas_reproduccion";
        try {
            $resultado = self::prepare($sql);
            $resultado->execute();
            $aux = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($aux)) {
                return $aux;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "Error en la conexión: ", $ex->getMessage();
        }
    }

    public static function videos($id_lista){
        self::conexion();
        $sql="SELECT * FROM videos WHERE id_lista=?";
        try {
            $resultado= self::prepare($sql);
            $resultado->bindParam(1,$id_lista);
            $resultado->execute();
            $aux=$resultado->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($aux)){
                return $aux;
            }else{
                return null;
            }

        } catch (PDOException $e) {
            echo "error en la conexion " . $e->getMessage();
        }
    }
}

/*
$a = DB::editar();
var_dump($a);
*/

/*
$a=DB::videos(1);
var_dump($a);*/