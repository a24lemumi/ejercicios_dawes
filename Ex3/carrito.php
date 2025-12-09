<?php
    session_start();

    include './lib/function.php';

    if (!isset($_SESSION['carrito'])) {
        header('Location: productos.php');
        exit();
    }

    if (isset($_POST['vaciar'])) {
        unset($_SESSION['carrito']);
        header('Location: productos.php');
        exit();
    }

    if (isset($_POST['eliminar'])) {
        $productoAEliminar = clearData($_POST['eliminar']);
        
        if (!empty($productoAEliminar)) {
            foreach ($_SESSION['carrito'] as $indice => $producto) {
                if ($producto === $productoAEliminar) {
                    unset($_SESSION['carrito'][$indice]);
                }
            }
        }
    }

    // Mostrar el contenido del carrito
    echo "<h1>Carrito de Compras</h1>";
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo "<form method='POST' action='carrito.php'>";
        echo "<ul>";
        foreach ($_SESSION['carrito'] as $producto) {
            echo "<li>$producto <button type='submit' name='eliminar' value='$producto'>Eliminar</button></li>";
        }
        echo "</ul>";
        echo "<button type='submit' name='vaciar'>Vaciar Carrito</button>";
        echo "</form>";
    } else {
        echo "<p>No hay productos en el carrito.</p>";
    }
?>