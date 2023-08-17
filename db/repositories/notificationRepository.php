<?php
require_once("abstractRepository.php");

class InscripcionRepository extends Repository
{

    private const ENTITY = "notificacioones";

    function getAllNotifications()
    {
        return $this->getAll(self::ENTITY);
    }

    
}
