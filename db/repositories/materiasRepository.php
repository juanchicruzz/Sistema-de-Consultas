<?php
require_once("abstractRepository.php");

class MateriaRepository extends Repository{

    private const ENTITY = "materias";
    private const IDENTIFIER = "idMateria";
    // private static $DBConnector;

    function getAllMaterias(){
        return $this->getAll(self::ENTITY);
    }

    function getMateriaById($id){
        return $this->getOneById(
            self::ENTITY,
            self::IDENTIFIER,
            $id
        );
    }

    function getMateriaByDescription($description){
        $query = "
            SELECT * FROM ".self::ENTITY
            ." WHERE descripcionMateria = '".$description."' ;" ;
        return $this->getResults($query);
    }
}

?>