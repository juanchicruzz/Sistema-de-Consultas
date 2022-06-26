<?php
require_once("abstractRepository.php");

class UserRepository extends Repository {

    private const ENTITY = "usuarios";
    private const IDENTIFIER = "idUsuario";
    // private static $DBConnector;

    function getAllUsers(){
        $query = "
            SELECT * FROM ".self::ENTITY."
            INNER JOIN roles ON idRolUsuario = idRol;";
        return $this->getResults($query);
    }

    function getDocenteNoValidated(){
        $query = "
            SELECT * FROM ".self::ENTITY."
            INNER JOIN roles ON idRolUsuario = idRol
            WHERE validado = 0 AND
            idRol = 2";
            
        return $this->getResults($query);
    }

    function getUserById($id){
        return $this->
        getOneById(
            self::ENTITY,
            self::IDENTIFIER,
            $id);
    }

    function getUserByEmail($email){
        $query = "SELECT * FROM ".self::ENTITY
            ." WHERE email = '".$email."' ;" ;
            return $this->getResults($query);
    }

    function createSimpleUser($email, $legajo, $idRol){
        $query = '
            INSERT INTO '.self::ENTITY
            .'(email, legajo, idRolUsuario) ' 
            .'VALUES(?, ?, ?);';
        return $this->executeQuery(
            $query, 
            [$email, $legajo, $idRol]);
    }

    function updateUser($email, $legajo, $idUsuario){
        $query = 'UPDATE '.self::ENTITY.' SET '
            .'email=?, legajo=?'
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            [$email, $legajo, $idUsuario]);
    }

    function validateUser($idUsuario){
        $query = 'UPDATE '.self::ENTITY.' SET '
            .'validado =?'
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            [1,$idUsuario]);
    }

    function deleteUser($idUsuario){
        $query = '
            DELETE FROM '.self::ENTITY
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            [$idUsuario]);
    }

    function registerUser($email, $password, $legajo, $idRolUsuario){
        $query = '
            INSERT INTO '.self::ENTITY
            .'(email, password, legajo, idRolUsuario) ' 
            .'VALUES(?, ?, ?, ?);';
        return $this->executeQuery(
            $query, 
            [$email, $password, $legajo, $idRolUsuario]);
    }
}

?>