<?php
    session_start();

    // Bloquear el acceso si ha visitado más de 5 veces durante 15 segundos
    if (isset($_SESSION['visitasUsuario']) && $_SESSION['visitasUsuario'] > 5) {
        if (!isset($_SESSION['tiempoBloqueo'])) {
            $_SESSION['tiempoBloqueo'] = time();
        }

        $tiempoRestante = $_SESSION['tiempoBloqueo'] + 15 - time();
        if ($tiempoRestante > 0) {
            echo "<h1>Acceso bloqueado</h1>";
            echo "<p>Has superado el número máximo de visitas permitidas.</p>";
            $segundos = $tiempoRestante % 60;
            echo "<p>Tiempo restante de bloqueo: $segundos segundos.</p>";
            exit();
        } else {
            // Reiniciar contador y tiempo de bloqueo
            $_SESSION['visitasUsuario'] = 1;
            unset($_SESSION['tiempoBloqueo']);
        }
    } else {
        // Si no está bloqueado, redirigir a preferencias.php
        header('Location: preferencias.php');
        exit();
    }