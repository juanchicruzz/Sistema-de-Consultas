<?php

require_once(dirname( __DIR__ ) . "/utils.php");
require_once(dirname( __DIR__ ) . "/mySQLConnector.php");

    class Repository {


    protected static function DBInstance(){
        return MySQLConnector::getInstance();
    }

    // SELECT STATEMENTS
    protected function getResults($selectQuery){
        $conn = $this->DBInstance()->getConnection(); // Crea la Instancia (mysqlconnector), abre la conexion
        $result = mysqli_query($conn, $selectQuery);
        $this->DBInstance()->releaseConnection($conn);
        return $result;
    }

    // INSERT, UPDATE, DELETE STATEMENTS
    protected function executeQuery($query, array $params = []): int{
        $nRows = 0;
        $conn = $this->DBInstance()->getConnection();
        $stmt = $conn->stmt_init();
        if($stmt->prepare($query)){
            Utils::customBindParams($params, $stmt);
            $stmt->execute();
            $nRows = $stmt->affected_rows; 
        };
        $stmt->close();
        $this->DBInstance()->releaseConnection($conn);
        return $nRows;
    }

    //Common Functions
    protected function getAll($table){
        $query = "SELECT * FROM ".$table.";";
        return $this->getResults($query);
    }

    protected function getOneById($entity, $identifier, $id){
        $query = "SELECT * FROM ".$entity
        ." WHERE ".$identifier." = ".$id. ";";
        return $this->getResults($query);
    }

    protected function getOneByIdJoinTables($entity, $identifier, $id, $joinTable, $joinIdentifier1, $joinIdentifier2){
        $query = "SELECT * FROM ".$entity . " t1 "
          ." INNER JOIN ".$joinTable. " t2 ON t1." .$joinIdentifier1. " = t2." . $joinIdentifier2
          ." WHERE ".$identifier." = ".$id. ";";
        return $this->getResults($query);
    }

    
}
