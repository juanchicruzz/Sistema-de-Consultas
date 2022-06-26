<?php
require_once("abstractRepository.php");

class RoleRepository extends Repository{

    private const ENTITY = "roles";
    private const IDENTIFIER = "idRol";
    // private static $DBConnector;

    function getAllRoles(){
        return $this->getAll(self::ENTITY);
    }

    function getRoleById($id){
        return $this->getOneById(
            self::ENTITY,
            self::IDENTIFIER,
            $id
        );
    }

    function getRoleByDescription($description){
        $query = "
            SELECT * FROM ".self::ENTITY
            ." WHERE descripcionRol = '".$description."' ;" ;
        return $this->getResults($query);
    }
}

?>