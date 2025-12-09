<?php
    session_start();

    // Definir las cartas del juego
    $cartas = [
        'oros' => [1, 2, 3, 4, 5, 6, 7, 'sota', 'caballo', 'rey'],
        'copas' => [1, 2, 3, 4, 5, 6, 7, 'sota', 'caballo', 'rey'],
        'espadas' => [1, 2, 3, 4, 5, 6, 7, 'sota', 'caballo', 'rey'],
        'bastos' => [1, 2, 3, 4, 5, 6, 7, 'sota', 'caballo', 'rey']
    ];

    // Inicializar el juego solo si no existe la sesión
    if (!isset($_SESSION['mazo']) || !isset($_SESSION['cartas_jugadas']) || !isset($_SESSION['tiempo_usado'])) {
        // Barajar las cartas
        $mazo = [];
        foreach ($cartas as $palo => $valores) {
            foreach ($valores as $valor) {
                $mazo[] = ['palo' => $palo, 'valor' => $valor];
            }
        }

        // Mezclar el mazo
        shuffle($mazo);
        $_SESSION['mazo'] = $mazo;
        $_SESSION['cartas_jugadas'] = [];
        $_SESSION['tiempo_usado'] = 0;
    }

    $tiempo_total = 60; // Minutos

    // Reiniciar el juego
    if (isset($_POST['reiniciar'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    $mensaje_alerta = "";

    if (isset($_POST['pedir'])) {
        if ($_SESSION['tiempo_usado'] < $tiempo_total && count($_SESSION['mazo']) > 0) {

            // Carta aleatoria
            $carta = array_pop($_SESSION['mazo']);

            // Actualizar el tiempo usado según el valor de la carta
            switch ($carta['valor']) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                    $_SESSION['tiempo_usado'] += 10;
                    break;
                case 'sota':
                    $_SESSION['tiempo_usado'] += 15;
                    break;
                case 'caballo':
                    $_SESSION['tiempo_usado'] += 20;
                    break;
                case 'rey':
                    $_SESSION['tiempo_usado'] += 25;
                    break;
                default:
                    $_SESSION['tiempo_usado'] += 30;
                    break;
            }

            if ($_SESSION['tiempo_usado'] > $tiempo_total) {
                $mensaje_alerta = "¡Has superado el tiempo permitido! Tiempo usado: " . $_SESSION['tiempo_usado'] . " minutos";
                $_SESSION['tiempo_usado'] = 0;
                $_SESSION['cartas_jugadas'] = [];
                $_SESSION['mazo'] = [];
            } else {
                $_SESSION['cartas_jugadas'][] = $carta;
            }

        } else if (count($_SESSION['mazo']) == 0) {
            $mensaje_alerta = "¡No quedan más cartas en el mazo!";
        }
    }

    if (isset($_POST['plantarse'])) {
        $mensaje_alerta = "¡Te has plantado! Tiempo usado: " . $_SESSION['tiempo_usado'] . " minutos";
        $_SESSION['tiempo_usado'] = 0;
        $_SESSION['cartas_jugadas'] = [];
        $_SESSION['mazo'] = [];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>60 Minutos</title>
</head>
<body>
    <?php if (!empty($mensaje_alerta)): ?>
        <script>alert('<?php echo $mensaje_alerta; ?>');</script>
    <?php endif; ?>
    
    <h1>Cartas jugadas</h1>
    <?php if (!empty($_SESSION['cartas_jugadas'])): ?>
        <ul>
            <?php foreach ($_SESSION['cartas_jugadas'] as $carta): ?>
                <li><?php echo $carta['valor'] . " de " . $carta['palo']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay cartas jugadas todavía.</p>
    <?php endif; ?>

    <p>Tiempo usado: <?php echo $_SESSION['tiempo_usado']; ?> minutos</p>
    <p>Cartas restantes: <?php echo count($_SESSION['mazo']); ?></p>
    <?php if (count($_SESSION['cartas_jugadas']) > 0): ?>
        <p>Riesgo en probabilidad: <?php echo round((count($_SESSION['cartas_jugadas']) / 40) * 100, 2); ?>%</p>
    <?php endif; ?>

    <form action="" method="post">
        <button type="submit" name="pedir">Pedir carta</button>
        <button type="submit" name="plantarse">Plantarse</button>
        <button type="submit" name="reiniciar">Jugar de nuevo</button>
    </form>
</body>
</html>