<?php
    session_start();

    include ('contador.php');

    if (!isset($_SESSION['usuario'])) {
        $_SESSION['usuario'] = ''; // Error: No se debe asignar un valor por defecto.
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="acceso.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <input type="submit" name="submit" value="Enviar">
    </form>
</body>
</html>