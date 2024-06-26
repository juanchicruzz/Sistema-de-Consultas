<?php
require_once("abstractRepository.php");

class InscripcionRepository extends Repository
{

    private const ENTITY = "inscripciones";

    function getAllInscripciones()
    {
        return $this->getAll(self::ENTITY);
    }

    function getInscripcionByConsultaAndAlumno($idConsulta, $idAlumno)
    {
        $query = "
            SELECT * FROM " . self::ENTITY
            . " WHERE idAlumno = '" . $idAlumno . "' 
            AND idConsulta = '" . $idConsulta . "';";
        return $this->getResults($query);
    }

    function getInscripcionesByConsulta($idConsulta)
    {
        $query = "SELECT i.motivoConsulta , ifnull(u.nombre,'-') nombre,ifnull(u.apellido,'-') apellido,
        ifnull(u.email,'-') Mail , u.legajo, u.email
         FROM inscripciones i 
         INNER JOIN usuarios u 
         ON i.idAlumno = u.idUsuario 
         INNER JOIN consultas c 
         ON i.idConsulta = c.idConsulta 
        WHERE i.idConsulta = '$idConsulta' ;";
        return $this->getResults($query);
    }

    function getInscripcionesByAlumno($idAlumno)
    {
        $query = "SELECT m.descripcionMateria, car.nombreCarrera, pm.dia, c.fecha, c.estado, 
        c.modalidad, c.ubicacion, if(horarioAlternativo <> '', horarioAlternativo, pm.horarioFijo) as horario, 
        i.motivoConsulta, i.fechaInscripcion, i.idConsulta
        FROM inscripciones i
        INNER JOIN consultas c
            ON i.idConsulta = c.idConsulta
        INNER JOIN profesor_materia pm
            ON c.idProfesor = pm.idProfesor AND c.idCarrera = pm.idCarrera AND c.idMateria = pm.idMateria
        INNER JOIN materias m
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car
            ON pm.idCarrera = car.idCarrera
        WHERE i.idAlumno = $idAlumno 
        ORDER BY c.fecha ASC;";
        return $this->getResults($query);
    }

    function getIdsInscripcionesByAlumno($idAlumno)
    {
        $query = "
            SELECT idConsulta FROM " . self::ENTITY
            . " WHERE idAlumno = '" . $idAlumno . "' ;";
        return $this->getResults($query);
    }

    function inscribirAlumnoEnConsulta($idAlumno, $idConsulta, $motivo)
    {
        $query = "INSERT INTO " . self::ENTITY
            . " (idAlumno, idConsulta, motivoConsulta) VALUES (?, ?, ?);";
        return $this->executeQuery(
            $query,
            [$idAlumno, $idConsulta, $motivo]
        );
    }

    function darDeBajaAlumnoEnConsulta($idAlumno, $idConsulta)
    {
        $query = "DELETE FROM  " . self::ENTITY . " 
        WHERE idAlumno = ? AND idConsulta = ?;";
        return $this->executeQuery(
            $query,
            [$idAlumno, $idConsulta]
        );
    }

}
