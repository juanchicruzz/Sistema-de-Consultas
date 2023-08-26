<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    switch($_SESSION["userType"]){
      case "1": {
        include_once(DIR_SITE_MAP_ALUMNO);
        break;
      }
      case "2": {
        include_once(DIR_SITE_MAP_PROFESSOR);
        break;
      }
      case "3": {
        include_once(DIR_SITE_MAP_ADMIN);
        break;
      }
  
    }  
  }   
?>
