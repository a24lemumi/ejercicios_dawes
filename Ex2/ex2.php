<?php
include ('config.php');

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$idioma = isset($_POST['idioma']) ? $_POST['idioma'] : '';

echo '<form method="post" action="">';
echo 'Nombre: <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '"><br>';
echo 'Idioma: <input type="text" name="idioma" value="' . htmlspecialchars($idioma) . '"><br><br>';

foreach ($test as $index => $question) {
    echo "<label>" . $question['pregunta'] . "</label><br>";

    // Obtener la respuesta del usuario si ya se ha enviado
    $userAnswer = isset($_POST['answer_' . $index]) ? trim($_POST['answer_' . $index]) : '';

    if ($question['Tipo'] == 'text') {
        // Determinar el color
        $color = '';
        if (isset($_POST['submit'])) {
            if (in_array(strtolower($userAnswer), array_map('strtolower', $question['Respuesta']))) {
                $color = 'green';
                $userAnswer = $question['Respuesta'][0]; // mostrar la respuesta correcta
            } else {
                $color = 'red';
            }
        }

        echo "<input type='text' name='answer_" . $index . "' value='" . htmlspecialchars($userAnswer) . "' style='background-color: " . $color . ";'><br>";
    }

    if ($question['Tipo'] == 'Multiple-choice') {
        foreach ($question['Opciones'] as $option) {
            $correcta = strtolower($question['Respuesta']);
            $userAnswerLower = strtolower($userAnswer);
            $optionLower = strtolower($option);

            // Determinar clase
            $class = '';
            if (isset($_POST['submit'])) {
                if ($optionLower == $correcta) {
                    $class = 'correct'; // respuesta correcta
                }
                if ($optionLower == $userAnswerLower && $userAnswerLower != $correcta) {
                    $class = 'wrong'; // respuesta del usuario incorrecta
                }
            }

            // Generar input con label
            echo '<label class="' . $class . '">';
            echo '<input type="radio" name="answer_' . $index . '" value="' . htmlspecialchars($option) . '" ' . ($userAnswerLower == $optionLower ? 'checked' : '') . '> ';
            echo htmlspecialchars($option);
            echo '</label><br>';
        }
    }


    echo "<br>";
}

echo '<input type="submit" name="submit" value="Enviar formulario">';
echo "</form><br>";

// Calcular puntuación si se ha enviado
if (isset($_POST['submit'])) {
    $score = 0;

    foreach ($test as $index => $question) {
        $userAnswer = isset($_POST['answer_' . $index]) ? trim($_POST['answer_' . $index]) : '';

        if ($question['Tipo'] == 'text') {
            if (in_array(strtolower($userAnswer), array_map('strtolower', $question['Respuesta']))) {
                $score += $question['Acierto'];
            } else {
                $score += $question['Fallo'];
            }
        } elseif ($question['Tipo'] == 'Multiple-choice') {
            if (strtolower($userAnswer) == strtolower($question['Respuesta'])) {
                $score += $question['Acierto'];
            } else {
                $score += $question['Fallo'];
            }
        }
    }

    $class = '';
    if ($score >= 5) {
        $class = 'high';
    } elseif ($score >= 2.5) {
        $class = 'medium';
    } else {
        $class = 'low';
    }

    echo "<div class='resultados'>";
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($nombre) . "</p>";
    echo "<p><strong>Idioma:</strong> " . htmlspecialchars($idioma) . "</p>";
    echo "<p><strong>Puntuación total:</strong> " . $score . "</p>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos para radio buttons correctos / incorrectos */
        label.correct input[type="radio"] + span,
        label.correct {
            background-color: #4CAF50; /* verde */
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
        }

        label.wrong input[type="radio"] + span,
        label.wrong {
            background-color: #f44336; /* rojo */
            color: white;
            padding: 1px 5px;
            border-radius: 4px;
        }

        /* Ocultar estilo nativo del radio button y usar span */
        input[type="radio"] {
            accent-color: inherit; /* hace que el círculo tome el color de fondo del label */
            margin-right: 5px;
        }

        /* Contenedor de resultados */
        .resultados {
            background-color: #f0f4f8;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 400px;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        /* Nombre e idioma */
        .resultados p {
            font-size: 1.1em;
            margin: 5px 0;
        }

        /* Puntuación */
        .resultados .score {
            font-size: 1.5em;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            display: inline-block;
            color: white;
            margin-top: 10px;
        }

        /* Colores según el rango */
        .score.high { background-color: #4CAF50; }   /* verde */
        .score.medium { background-color: #FF9800; } /* naranja */
        .score.low { background-color: #f44336; }    /* rojo */

    </style>
</head>
<body>
    
</body>
</html>