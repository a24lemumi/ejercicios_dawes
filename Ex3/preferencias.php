<?php
    session_start();

    include './lib/function.php';

    if (!isset($_SESSION['usuario'])) {
        header('Location: formulario.php');
        exit();
    } else {
        if (isset($_SESSION['visitasUsuario'])) {
            $_SESSION['visitasUsuario']++;
        }

        if (isset($_COOKIE['visitasTotales'])) {
            setcookie('visitasTotales', $_COOKIE['visitasTotales'] + 1, time() + 3600); // Error: Si no está definida, puede generar un error
        } else { // Error: Si no está definida, puede generar un error
            setcookie('visitasTotales', 1, time() + 3600);
        }
    }

    if (isset($_POST['guardar'])) {
        $tema = clearData($_POST['tema']);
        $tamano_fuente = clearData($_POST['tamano_fuente']);

        if (!empty($tema) || !empty($tamano_fuente)) {
            // Guardar preferencias en la sesión
            $_SESSION['usuario']['tema'] = $tema;
            $_SESSION['usuario']['tamano_fuente'] = $tamano_fuente;

            $tamano_fuente == 'pequeno' ? $size = '12px' : ($tamano_fuente == 'mediano' ? $size = '16px' : $size = '20px');

            // Error: Usar <script> para aplicar el tamaño de fuente dinámicamente
        }
    }

    if (isset($_POST['cerrarSession'])) {
        header('Location: cerrarSession.php');
        exit();
    }

    if (isset($_SESSION['visitasUsuario'])) {
        if ($_SESSION['visitasUsuario'] > 5) {
            header('Location: bloqueo.php');
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="<?php echo $_SESSION['usuario']['tema'] ?? 'claro'; echo ' ' . ($size ?? 'mediano'); ?>">

    <h1>Preferencias de Usuario</h1>
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Nombre: <?php echo $_SESSION['usuario']['nombre']; ?></p>
        <p>Hora de Acceso: <?php echo $_SESSION['usuario']['hAcceso']; ?></p>
    <?php else: ?>
        <p>No hay información de usuario disponible.</p>
    <?php endif; ?>

    <p>Visitas Totales: <?php echo $_COOKIE['visitasTotales'] ?? 0; ?></p>
    <p>Visitas de Usuario: <?php echo $_SESSION['visitasUsuario'] ?? 0; ?></p>

    <form action="" method="post">
        <label for="">Tema:</label><br>
        <input type="radio" id="claro" name="tema" value="claro" checked>
        <label for="claro">Claro</label><br>
        <input type="radio" id="oscuro" name="tema" value="oscuro">
        <label for="oscuro">Oscuro</label><br><br>

        <label for="">Tamaño fuente:</label>
        <select name="tamano_fuente" id="tamano_fuente">
            <option value="pequeno">Pequeño</option>
            <option value="mediano" selected>Mediano</option>
            <option value="grande">Grande</option>
        </select><br><br>

        <input type="submit" name="guardar" value="Guardar Preferencias">
        <input type="submit" name="cerrarSession" value="Cerrar Sesión">
    </form>

    <form action="productos.php" method="post">
        <input type="submit" name="irCarrito" value="Ir al Carrito">
    </form>
</body>
</html>