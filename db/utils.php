<?php

//UTILS
class Utils{
    static function getParamsAsString(array $params){
        $bindString = "";
        foreach($params as $p){
            switch ($p) {
                case is_double($p):
                    $bindString.="d";
                    break;
                case is_string($p):
                    $bindString.="s";
                    break;
                case is_int($p):
                    $bindString.="i";
                    break;
            } 
        }
        return $bindString;
    }
    static function customBindParams(array $params, $stmt){
        $bindString = self::getParamsAsString($params);
        $nArgs = count($params);
        switch ($nArgs){
            case 0:
                break;
            case 1: 
                $stmt->bind_param(
                    $bindString, $params[0]);
                break;
            case 2: 
                $stmt->bind_param(
                    $bindString, $params[0], $params[1]);
                break;
            case 3: 
                return $stmt->bind_param(
                    $bindString, $params[0], $params[1], $params[2]);
                break;  
            case 4: 
                return $stmt->bind_param(
                    $bindString, $params[0], $params[1], $params[2], $params[3]);
                break;   
        }
    }

    static function convertirFechaFromSQL(string $fecha){
        $fecha = explode("-", $fecha);
        // array string with all months of the year
        $meses = array("..", "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        if(str_starts_with($fecha['1'], 0)){
            $mes = $fecha['1'] = substr($fecha['1'], 1);
        } else $mes = $fecha['1'];
        $mesTexto = $meses[$mes];
        return $fecha[2] . " de " . $mesTexto . " de " . $fecha[0];
    }
    
}

?>