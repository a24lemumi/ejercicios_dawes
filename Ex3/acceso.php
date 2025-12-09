<?php
    session_start();

    include './lib/function.php';

    if (isset($_POST['submit'])) {
        $nombre = clearData($_POST['nombre']);

        if (!empty($nombre)) {
            $_SESSION['usuario'] = ['nombre' => $nombre, 'hAcceso' => date('H:i:s')];
        }

        header('Location: preferencias.php');
        exit();
    } else {
        header('Location: formulario.php');
        exit();
    }