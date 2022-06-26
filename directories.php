<?php
const ROOT = "/sistema-consultas";
// const SERVER_ROOT = $_SERVER['SERVER_NAME'] . ROOT;
const SERVER_ROOT = "localhost/sistema-consultas";

// COMUNES PARA INCLUIR ARCHIVOS
define('DIR_INDEX', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/index.php");
define('DIR_HEADER', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials/header.php");
define('DIR_FOOTER', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials/footer.php");
define('DIR_NAV_BAR', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials/navbar.php");
define('DIR_NAV_BAR_ADMIN', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials/navbar-admin.php");
define('DIR_NAV_BAR_PROFESSOR', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials/navbar-prof.php");
define('DIR_PARTIALS', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/partials");

// CARPETAS PARA INCLUIR ARCHIVOS

define('DIR_AUTH', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/auth");
define('DIR_CONTROLLERS', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/controllers");
define('DIR_DB', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/db");
define('DIR_REPOSITORIES', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/db/repositories");
define('DIR_SECURITY', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/controllers/security.php");
define('DIR_VIEWS', $_SERVER['DOCUMENT_ROOT'] . ROOT . "/views");

// REDIRECT (NO PARA INCLUIR ARCHIVOS)

define('REDIR_INDEX', ROOT . "/index.php");
define('REDIR_HEADER', ROOT . "/partials/header.php");
define('REDIR_FOOTER', ROOT . "/partials/footer.php");
define('REDIR_PARTIALS', ROOT . "/partials");

define('REDIR_AUTH', ROOT . "/auth");
define('REDIR_CONTROLLERS', ROOT . "/controllers");
define('REDIR_DB', ROOT . "/db");
define('REDIR_REPOSITORIES', ROOT . "/db/repositories");
define('REDIR_SECURITY', ROOT . "/controllers/security.php");
define('REDIR_VIEWS', ROOT . "/views");


?>