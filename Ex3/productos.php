<?php
    session_start();

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_POST['agregar'])) {
        $productos = $_POST['productos'];

        if (isset($productos)) {
            foreach ($productos as $producto) {
                if (!in_array($producto, $_SESSION['carrito'])) {
                    $_SESSION['carrito'][] = $producto;
                }
            }
            
            header('Location: carrito.php');
            exit();
        }
    }

    if (isset($_POST['preferencias'])) {
        header('Location: preferencias.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Productos</h1>

    <form action="" method="post">
        <label><input type="checkbox" name="productos[]" value="Producto 1" <?php echo in_array("Producto 1", $_SESSION['carrito']) ? "checked" : ""; ?>> Producto 1</label><br>
        <label><input type="checkbox" name="productos[]" value="Producto 2" <?php echo in_array("Producto 2", $_SESSION['carrito']) ? "checked" : ""; ?>> Producto 2</label><br>
        <label><input type="checkbox" name="productos[]" value="Producto 3" <?php echo in_array("Producto 3", $_SESSION['carrito']) ? "checked" : ""; ?>> Producto 3</label><br>
        <button type="submit" name="agregar">Agregar al carrito</button>
        <button type="submit" name="preferencias">Volver a preferencias</button>
    </form>
</body>
</html>