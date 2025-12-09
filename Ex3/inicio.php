<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido</h1>
    <form action="bienvenida.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="frase">Frase de bienvenida:</label>
        <select id="frase" name="frase" required>
            <option value="¡Bienvenido a nuestra tienda">¡Bienvenido a nuestra tienda!</option>
            <option value="¡Gracias por visitarnos">¡Gracias por visitarnos!</option>
            <option value="¡Disfruta de tus compras">¡Disfruta de tus compras!</option>
        </select><br><br>

        <button type="submit" name="continuar">Continuar</button>
    </form>
</body>
</html>