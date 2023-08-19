<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

require_once(DIR_HEADER); ?>

<link rel="stylesheet" href="<?= REDIR_VIEWS ?>/css/siteMap.css">

<body>
    <div class="container">
        <nav>
            <ul class="list">
                <li><a href="<?= REDIR_INDEX ?>">Inicio</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasProfesor.php">Mis Consultas</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultaBloquearSemana.php">Bloquear Consultas</a>
                    <ul>
                        <li>
                            <a href="#mis-inscripciones">Motivo Bloqueo</a>
                        </li>
                    </ul>
                </li>
                <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasBloqueadas.php">Consultas Bloqueadas</a></li>
                <li><a href="#perfil">Perfil</a></li>
                <li><a href="#preguntas-frecuentes">Preguntas Frecuentes</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <li><a href="<?= REDIR_VIEWS ?>/siteMap.php">Mapa del Sitio</a></li>
            </ul>
        </nav>
    </div>
</body>
<br><br><br><br><br><br><br><br>

<?php include(DIR_FOOTER); ?>