<?php
    session_start();
    include './lib/function.php';

    if (isset($_POST['continuar'])) {
        $nombre = clearData($_POST['nombre']);
        $frase = clearData($_POST['frase']);

        if (!empty($nombre) && !empty($frase)) {
            if (isset($_SESSION['usuario'])) {
                echo "<h1>" . $frase . ", " . $nombre . "!</h1>";
            } else {
                $_SESSION['usuario'] = $nombre;
                setcookie('frase_bienvenida', $frase, time() + 3600);
                echo "<h1>" . $frase . ", " . $nombre . "!</h1>";
            }
        }
    }