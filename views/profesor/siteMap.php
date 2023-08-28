<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
?>


<?php require_once(DIR_HEADER);  ?>
<link rel="stylesheet" href="<?= REDIR_CSS ?>/siteMap.css">

<body>
    <div class="container">
        <nav>
            <ul class="list">
                <li><a href="<?= REDIR_INDEX ?>">Inicio</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasProfesor.php">Mis Consultas</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultaBloquearSemana.php">Bloquear Consultas</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasBloqueadas.php">Consultas Bloqueadas</a></li>
                <li><a href="#perfil">Perfil</a></li>
                <li><a href="#preguntas-frecuentes">Preguntas Frecuentes</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/siteMap.php">Mapa del Sitio</a></li>
            </ul>
        </nav>
    </div>
</body>

<?php include(DIR_FOOTER); ?>