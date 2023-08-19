<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

require_once(DIR_HEADER); ?>

<link rel="stylesheet" href="<?= REDIR_VIEWS ?>/css/siteMap.css">

<body>
    <div class="container">
        <nav>
            <ul class="list">
                <li><a href="<?= REDIR_INDEX ?>">Inicio</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/admin/users.php">ABM Alumnos</a></li>
                <li>Consultas</li>
                <ul>
                    <li><a href="<?= REDIR_VIEWS ?>/consultas.php">Consultas</a></li>
                    <li><a href="<?= REDIR_VIEWS ?>/admin/consultasBloqueadas.php">Consultas Bloqueadas</a></li>
                    <li><a href="<?= REDIR_VIEWS ?>/admin/consultasPorDia.php">Consultas por Dia</a></li>
                </ul>
                </li>

                <li><a href="<?= REDIR_VIEWS ?>/admin/validacionDocente.php">Validacion Docentes</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/admin/viewProfile.php">Perfil</a></li>
                <li><a href="#preguntas-frecuentes">Preguntas Frecuentes</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/siteMap.php">Mapa del Sitio</a></li>
            </ul>
        </nav>
    </div>
</body>
<br><br><br><br><br><br><br><br>

<?php include(DIR_FOOTER); ?>