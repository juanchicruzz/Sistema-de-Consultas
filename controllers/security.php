<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

Class Security {

    private const ALUMN_TYPE = 1;
    private const PROF_TYPE = 2;
    private const ADMIN_TYPE = 3;

    static function verifyUser($type){
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
        {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        }
        if(!($_SESSION['userType'] == $type))
        {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        }
    }

    static function verifyUserIsAdmin(){
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
        {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        }
        if(isset($_SESSION['userType']) && $_SESSION['userType'] != self::ADMIN_TYPE)
        {
            header("Location: " . REDIR_INDEX);
            exit;
        }
    }

    static function verifyUserIsProfessor(){
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
        {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        }
        if(isset($_SESSION['userType']) && $_SESSION['userType'] != self::PROF_TYPE)
        {
            header("Location: " . REDIR_INDEX);
            exit;
        }
    }
    
    static function verifyUserIsStudent(){
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
        {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        }
        if(isset($_SESSION['userType']) && $_SESSION['userType'] != self::ALUMN_TYPE)
        {
            header("Location: " . REDIR_INDEX);
            exit;
        }
    }
}
?>