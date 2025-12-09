<?php
    if (!isset($_COOKIE['visitasTotales'])) {
        setcookie('visitasTotales', 0, time() + 3600);
    }

    if (!isset($_SESSION['visitasUsuario'])) {
        $_SESSION['visitasUsuario'] = 0;
    }