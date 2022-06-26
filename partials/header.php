<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../partials/estilos.css" type="text/css">
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>Sistema de Consultas</title>
</head>

<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    switch($_SESSION["userType"]){
      case "1": {
        include_once(DIR_NAV_BAR);
        break;
      }
      case "2": {
        include_once(DIR_NAV_BAR_PROFESSOR);
        break;
      }
      case "3": {
        include_once(DIR_NAV_BAR_ADMIN);
        break;
      }
  
    }  
  }   

?>
<body>