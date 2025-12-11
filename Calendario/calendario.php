<?php
    #Ejercicio 1.
    // Array de configuración de horarios de grupos DAW

    // Incluir el archivo de configuración
    include ('config.php');
    include ('formulario.php');

    if (isset($_POST['submit'])) {
        $grupo = $_POST['grupo'];
        echo "<h2>Horario del grupo: " . htmlspecialchars($grupo) . "</h2>";

        echo "<table border='1'>
                <tr>
                    <th>Hora / Día</th> 
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>";
        for ($hora = 1; $hora <= 6; $hora++) {
            echo "<tr><td>" . $hora . "ª</td>";
            for ($dia = 1; $dia <= 5; $dia++) {
                $noHayHora = false;
                foreach ($horariosGrupos as $horario) {
                    // Comprobar si el grupo coincide con el seleccionado
                    if (($grupo == "2 DAW A" && $horario['grupo'] == "2º DAW A") || ($grupo == "1 DAW A" && $horario['grupo'] == "1º DAW A")) {
                        // Recorremos los módulos del horario
                        foreach ($horario['horario'] as $asignatura) {
                            // Comprobar si las horas están en horas o horario
                            if (isset($asignatura['horas'])) {
                                $horas = $asignatura['horas'];
                            } elseif (isset($asignatura['horario'])) {
                                $horas = $asignatura['horario'];
                            }

                            // Recorremos las horas
                            foreach ($horas as $horaInfo) {
                                // Si la hora y el día coinciden, mostramos la asignatura
                                if ($horaInfo['Hora'] == $hora . "ª" && 
                                    (($dia == 1 && $horaInfo['Dia'] == "Lunes") || 
                                    ($dia == 2 && $horaInfo['Dia'] == "Martes") || 
                                    ($dia == 3 && $horaInfo['Dia'] == "Miércoles") || 
                                    ($dia == 4 && $horaInfo['Dia'] == "Jueves") || 
                                    ($dia == 5 && $horaInfo['Dia'] == "Viernes"))) {

                                    // Imprimir la asignatura en la tabla
                                    $codigo = array_search($asignatura, $horario['horario']);
                                    echo "<td class='asignatura $codigo'>" . htmlspecialchars($codigo) . "</td>";
                                    
                                    $noHayHora = true;
                                }
                            }
                        }
                    }
                }
                // Si no hay clase en esa hora, dejamos la celda vacía
                if (!$noHayHora) {
                    echo "<td></td>";
                }
            }
                
            echo "<tr>";
        }
        
        echo "</table>";
        
        // Imprimir la leyenda de módulos y profesores
        echo "<h3>Leyenda de Módulos y Profesores</h3>";
        echo "<ul>";
        foreach ($horariosGrupos as $horario) {
            if (($grupo == "2 DAW A" && $horario['grupo'] == "2º DAW A") || ($grupo == "1 DAW A" && $horario['grupo'] == "1º DAW A")) {
                foreach ($horario['horario'] as $modulo) {
                    echo "<li>" . htmlspecialchars($modulo['nombre']) . " - Profesor: " . htmlspecialchars($modulo['profesor']) . "</li>";
                }
            }
        }
        echo "</ul>";
    }

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario de Grupos DAW</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th {
            background: #2c3e50;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        td:nth-child(1) {
            width: 10%;
        }

        td.asignatura {
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
        }

        /* 🎓 Colores por módulo */
        .DWES {
            background-color: #6a1b9a;
        }

        .DWC {
            background-color: #0277bd;
        }

        .PROG {
            background-color: #2e7d32;
        }

        .BD {
            background-color: #c62828;
        }

        /* Celdas vacías */
        td:empty {
            background-color: #f2f4f7;
        }

        ul {
            width: 35%;
        }
        
        ul li {
            background: #fff;
            padding: 10px;
            margin: 5px 0;
            border-left: 5px solid #2c3e50;
        }
    </style>
</head>
<body>
</body>
</html>