<?php
require_once("abstractRepository.php");

class ConsultaRepository extends Repository{

    private const ENTITY = "consultas";
    private const IDENTIFIER = "idConsulta";
    // private static $DBConnector;

    function getConsultaById($id){
        return $this->getOneById(
            self::ENTITY,
            self::IDENTIFIER,
            $id
        );
    }

    function getConsultasGeneral(){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera 
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        ORDER BY car.nombreCarrera DESC";
        return $this->getResults($query);
    }

    function getConsultasBloqueadas(){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera, con.fecha,
        con.modalidad, con.motivoCancelacion
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        INNER JOIN consultas con
            ON con.idProfesor = pm.idProfesor AND con.idMateria = pm.idMateria AND con.idCarrera = pm.idCarrera
        WHERE estado = 'Bloqueada'
        ORDER BY car.nombreCarrera DESC";
        return $this->getResults($query);
    }

    function getConsultasPorDia($fecha){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera, con.fecha,
        con.modalidad, con.motivoCancelacion
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        INNER JOIN consultas con
            ON con.idProfesor = pm.idProfesor AND con.idMateria = pm.idMateria AND con.idCarrera = pm.idCarrera
        WHERE con.fecha = '$fecha'
        ORDER BY car.nombreCarrera DESC";
        return $this->getResults($query);
    }

    function getAllConsultas(){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera, con.fecha,
        con.modalidad, con.motivoCancelacion
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        INNER JOIN consultas con
            ON con.idProfesor = pm.idProfesor AND con.idMateria = pm.idMateria AND con.idCarrera = pm.idCarrera
        ORDER BY car.nombreCarrera DESC";
        return $this->getResults($query);
    }



    function getConsultasByCarrera($idCarrera){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera 
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        WHERE pm.idCarrera = $idCarrera";
        return $this->getResults($query);
    }

    function getConsultasByAño($añoCarrera){
        $query = "SELECT pm.dia, pm.horarioFijo, concat(u.nombre, ' ', u.apellido) as 'profesor', 
        m.descripcionMateria, car.nombreCarrera , pm.idProfesor, pm.idMateria, pm.idCarrera 
		FROM profesor_materia pm 
        INNER JOIN usuarios u 
            ON pm.idProfesor = u.idUsuario
        INNER JOIN materias m 
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car 
            ON pm.idCarrera = car.idCarrera
        WHERE m.añoCursado = $añoCarrera";
        return $this->getResults($query);
    }


    function getConsultasBloqueadasByProfesor($idProfesor){
        $query = "SELECT pm.horarioFijo, m.descripcionMateria, car.nombreCarrera, c.fecha, c.estado, c.modalidad, 
        if(c.ubicacion <> '',c.ubicacion, 'No aplica') as ubicacion, 
        if(c.horarioAlternativo <> '' ,c.horarioAlternativo , horarioFijo) as horarioAlternativo, c.idConsulta
        FROM consultas c 
        INNER JOIN materias m ON c.idMateria = m.idMateria 
        INNER JOIN carreras car ON c.idCarrera = car.idCarrera
        INNER JOIN profesor_materia pm ON pm.idMateria = c.idMateria AND pm.idCarrera = c.idCarrera AND pm.idProfesor = c.idProfesor
        WHERE pm.idProfesor = $idProfesor AND estado = 'Bloqueada' 
        ORDER BY c.fecha ASC ;";
        return $this->getResults($query);
    }

    function getConsultasActivasByProfesor($idProfesor){
        $query = "SELECT pm.horarioFijo, m.descripcionMateria, car.nombreCarrera, c.fecha, c.estado, c.modalidad, 
        if(c.ubicacion <> '',c.ubicacion, 'No aplica') as ubicacion, 
        if(c.horarioAlternativo <> '' ,c.horarioAlternativo , horarioFijo) as horarioAlternativo, c.idConsulta
        FROM consultas c
        INNER JOIN materias m ON c.idMateria = m.idMateria 
        INNER JOIN carreras car ON c.idCarrera = car.idCarrera
        INNER JOIN profesor_materia pm ON pm.idMateria = c.idMateria AND pm.idCarrera = c.idCarrera AND pm.idProfesor = c.idProfesor
        WHERE pm.idProfesor = $idProfesor AND estado <> 'Bloqueada'
        and c.fecha > current_date() 
        ORDER BY c.fecha ASC;";
        return $this->getResults($query);
    }


    function getConsultasByProfesor($idProfesor){
        $query = "SELECT pm.dia, pm.horarioFijo ,m.descripcionMateria, car.nombreCarrera , pm.idMateria, m.añoCursado, pm.idCarrera, pm.idProfesor
        FROM profesor_materia pm
        INNER JOIN materias m
            ON pm.idMateria = m.idMateria
        INNER JOIN carreras car
            ON pm.idCarrera = car.idCarrera
        WHERE pm.idProfesor = $idProfesor";
        return $this->getResults($query);
    }

    function getDetallesParaInscripcion($idProfesor, $idMateria, $idCarrera){
        $query = "SELECT concat(u.nombre, ' ', u.apellido) as profesor, 
        m.descripcionMateria as materia, c.nombreCarrera as carrera
        FROM profesor_materia pm
        INNER JOIN usuarios u 
            ON u.idUsuario = pm.idProfesor
        INNER JOIN materias m 
            ON m.idMateria = pm.idMateria
        INNER JOIN carreras c
            ON c.idCarrera = pm.idCarrera
        WHERE pm.idProfesor = $idProfesor 
        AND pm.idMateria = $idMateria 
        AND pm.idCarrera = $idCarrera";
        return $this->getResults($query);
    }


    function updateCupoConsulta($idConsulta, $tipo) {
        
        // Obtener el cupo actual
        $result = $this->getConsultaById($idConsulta);
        
        if ($row = $result->fetch_array()) {
            $cupoActual = $row['cupo'];
            // Determinar nuevo cupo
            if ($tipo == 'baja'){
                $cupoNuevo = $cupoActual + 1;
            }
            else{
                $cupoNuevo = $cupoActual - 1 ;
            }
            // Actualizar el cupo en la tabla
            $query = 'UPDATE '.self::ENTITY.' SET '
            .' cupo=?,'
            .' WHERE '.self::IDENTIFIER. '=?'; 
            return $this->executeQuery(
                $query, 
                [$cupoNuevo, $idConsulta]);
        }
       
    }
    

    function updateConsulta($modalidad, $horarioAlt,  $ubicacion, $idConsulta){
        $query = 'UPDATE '.self::ENTITY.' SET '
            .' modalidad=?, horarioAlternativo=?, ubicacion=?, estado="Modificada" '
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            [$modalidad, $horarioAlt,  $ubicacion, $idConsulta]);
    }

    function bloquearConsulta($motivo,$idConsulta){
        $query = 'UPDATE '.self::ENTITY.' SET '
            .' estado=?,'
            .' motivoCancelacion=?'
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            ['Bloqueada',$motivo,$idConsulta]);
    }

    function desbloquearConsulta($idConsulta){
        $query = 'UPDATE '.self::ENTITY.' SET '
            .' estado=?, motivoCancelacion=?'
            .' WHERE '.self::IDENTIFIER. '=?'; 
        return $this->executeQuery(
            $query, 
            ['Activa',Null,$idConsulta]);
    }

    function getConsultasByDates($estado,$idProfesor,$fechaInicio, $fechaFin){
        $query = "SELECT c.idConsulta 
        FROM consultas c 
        WHERE c.idProfesor ='$idProfesor' AND c.estado = '$estado' AND c.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
        return $this->getResults($query);
    }

    function bloqConsultasByDates($motivo,$idProfesor,$fechaInicio, $fechaFin){
        $query = "UPDATE ".self::ENTITY." SET estado='Bloqueada' , motivoCancelacion=? ".
         "WHERE idProfesor=? AND ". 
         "fecha BETWEEN ? AND ? ";
        return $this->executeQuery(
            $query,
            [$motivo,$idProfesor,$fechaInicio,$fechaFin]
        );
    }

    function desbloqConsultasByDate($idProfesor,$fechaInicio, $fechaFin){
        $query = "UPDATE ".self::ENTITY." SET estado='Activa' , motivoCancelacion=NULL ".
         "WHERE idProfesor=? AND ". 
         "fecha BETWEEN ? AND ? ";
        return $this->executeQuery(
            $query,
            [$idProfesor,$fechaInicio,$fechaFin]
        );
    }

    function getConsultasByPrimaryKey($idProfesor, $idMateria, $idCarrera){
        $query = "SELECT c.idConsulta, upper(pm.dia) as dia, cupo, c.fecha, c.estado, c.modalidad,
        if(c.ubicacion <> '' ,c.ubicacion, 'No definido') as ubicacion, 
        if(c.horarioAlternativo <> '',c.horarioAlternativo, pm.horarioFijo) as horario,
        pm.cupo as cupoMaximo, COUNT(i.idConsulta) as inscriptos
        FROM consultas c
        INNER JOIN profesor_materia pm 
			ON c.idCarrera = pm.idCarrera AND c.idProfesor = pm.idProfesor AND c.idMateria = pm.idMateria
        LEFT JOIN inscripciones i 
            ON c.idConsulta = i.idConsulta  
      WHERE c.idCarrera = $idCarrera AND c.idProfesor = $idProfesor AND c.idMateria = $idMateria
      GROUP BY c.idConsulta ";
        return $this->getResults($query);
    }


    function getIdConsultaFromPKandFecha($idProfesor, $idMateria, $idCarrera, $fecha){
        $query = "SELECT idConsulta FROM consultas c 
        WHERE c.idCarrera = $idCarrera AND c.idProfesor = $idProfesor 
        AND c.idMateria = $idMateria AND c.fecha = '$fecha';";
      
        return $this->getResults($query);
    }

    function getConsultasByPrimaryKeyConInscripciones($idProfesor, $idMateria, $idCarrera){
        $query = "SELECT c.idConsulta, upper(pm.dia) as dia, c.fecha, c.estado, c.modalidad, 
        if(c.ubicacion <> '' ,c.ubicacion, 'No definido') as ubicacion, 
        if(c.horarioAlternativo <> '',c.horarioAlternativo, pm.horarioFijo) as horario, 
        c.idprofesor profesor, count(i.idAlumno) as inscriptos
        FROM consultas c
        INNER JOIN profesor_materia pm
            ON c.idCarrera = pm.idCarrera AND c.idProfesor = pm.idProfesor AND c.idMateria = pm.idMateria
        LEFT JOIN inscripciones i
            ON c.idConsulta = i.idConsulta
        WHERE c.idCarrera = $idCarrera AND c.idProfesor = $idProfesor AND c.idMateria = $idMateria
        AND c.fecha > current_date() 
        group by c.idConsulta, dia, c.fecha, c.estado, c.modalidad, ubicacion, horario, profesor;
        ";
        return $this->getResults($query);
    }

    function getInfoConsultaById($idConsulta){
        $query = "SELECT c.idConsulta, upper(pm.dia) as dia, c.fecha, c.modalidad, 
        if(c.ubicacion <> '' ,c.ubicacion, 'No definido') as ubicacion, 
        if(c.horarioAlternativo <> '',c.horarioAlternativo, pm.horarioFijo) as horario, 
        c.idprofesor profesor 
        FROM consultas c
        INNER JOIN profesor_materia pm 
        WHERE c.idConsulta = '$idConsulta';";
        return $this->getResults($query);

    }
}

?>
