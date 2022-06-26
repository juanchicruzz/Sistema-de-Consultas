<?php

require_once("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class MySQLConnector {

private static $DB_HOST;
private static $DB_NAME;
private static $DB_USERNAME;
private static $DB_PASSWORD;
private static $DB_CHARSET;
private static $INSTANCE;
// luego a implementar Pool de conexiones
// private static $conn = array();
private static $CONNECTION;
private static $MAX_CONNECTIONS = 3;
public $CURR_CONNECTIONS;  

private function __construct()
{   
    self::$DB_HOST = DB_HOST;
    self::$DB_NAME = DB_NAME;
    self::$DB_USERNAME = DB_USERNAME;
    self::$DB_PASSWORD = DB_PASSWORD;
    self::$DB_CHARSET = DB_CHARSET;
    $this->CURR_CONNECTIONS = 0;
}

private function createConnection(){
    $connection = mysqli_connect(
        self::$DB_HOST, self::$DB_USERNAME, self::$DB_PASSWORD, self::$DB_NAME);
    mysqli_set_charset($connection, self::$DB_CHARSET);
    if(!$connection){
        echo "La conexion no tuvo exito";
        return null;
    }
    return $connection;
}

private function selectDatabase($connection, $db_name){
    // Si no se pasan parametros, se toma como default la constante DB_NAME
    if (empty($db_name)){
        $db_name = self::$DB_NAME;
    }
    return mysqli_select_db($connection, $db_name);
}

public static function getInstance(){
    // IMPLEMENTANDO SINGLETON
    if(!isset(self::$INSTANCE)){
        self::$INSTANCE = new MySQLConnector();
    }
    return self::$INSTANCE;
}

public function getConnection(){
    // Si no existe una conexion creada la creamos, si ya existe se devuelve
    if(!isset(self::$CONNECTION)){
        $newConnection = self::createConnection();
        self::$CONNECTION = $newConnection;
    }
    return self::$CONNECTION;
}

public function closeConnection($conn){
    if(isset($conn)){
        mysqli_close($conn);
        self::$CONNECTION = null;
    }
}

public function releaseConnection($connection){
    // La guardamos para volver a reutilizar
    if(isset($connection)){
        self::$CONNECTION = $connection;
    }
}

}

?>