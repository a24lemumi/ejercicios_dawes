<?php
    session_start();

    // unset($_SESSION['usuario']);
    // Error: No hace falta unset() antes de session_destroy(), ya que esta función elimina todas las variables de sesión.

    session_unset();
    session_destroy();
    header('Location: formulario.php');
    exit();