<?php
    include ('config.php'); // Carga preguntas y configuración del test
    
    // Captura nombre e idioma del usuario
    $nombre = $_POST['nombre'] ?? '';
    $idioma = $_POST['idioma'] ?? '';
    
    // Formulario principal
    echo '<form method="post" action="">';
    echo 'Nombre: <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '"><br>';
    echo 'Idioma: <input type="text" name="idioma" value="' . htmlspecialchars($idioma) . '"><br><br>';
    
    // Recorrer preguntas
    foreach ($test as $index => $question) {
        echo "<label>" . $question['pregunta'] . "</label><br>";
        $userAnswer = trim($_POST['answer_' . $index] ?? '');
    
        // Preguntas de texto
        if ($question['Tipo'] == 'text') {
            $color = '';
            if (isset($_POST['submit'])) {
                $color = in_array(strtolower($userAnswer), array_map('strtolower', $question['Respuesta'])) ? 'green' : 'red';
                if ($color == 'green') $userAnswer = $question['Respuesta'][0]; // Mostrar respuesta correcta
            }
            echo "<input type='text' name='answer_$index' value='" . htmlspecialchars($userAnswer) . "' style='background-color: $color;'><br>";
        }
    
        // Preguntas de opción múltiple
        if ($question['Tipo'] == 'Multiple-choice') {
            foreach ($question['Opciones'] as $option) {
                $class = '';
                if (isset($_POST['submit'])) {
                    if (strtolower($option) == strtolower($question['Respuesta'])) $class = 'correct';
                    if (strtolower($option) == strtolower($userAnswer) && strtolower($userAnswer) != strtolower($question['Respuesta'])) $class = 'wrong';
                }
                echo "<label class='$class'><input type='radio' name='answer_$index' value='" . htmlspecialchars($option) . "' " . (strtolower($userAnswer)==strtolower($option) ? 'checked' : '') . "> $option</label><br>";
            }
        }
    
        echo "<br>";
    }
    
    echo '<input type="submit" name="submit" value="Enviar formulario">';
    echo "</form><br>";
    
    // Calcular puntuación
    if (isset($_POST['submit'])) {
        $score = 0;
        foreach ($test as $index => $question) {
            $userAnswer = trim($_POST['answer_' . $index] ?? '');
            if ($question['Tipo']=='text') {
                $score += in_array(strtolower($userAnswer), array_map('strtolower', $question['Respuesta'])) ? $question['Acierto'] : $question['Fallo'];
            } elseif ($question['Tipo']=='Multiple-choice') {
                $score += strtolower($userAnswer)==strtolower($question['Respuesta']) ? $question['Acierto'] : $question['Fallo'];
            }
        }
    
        // Mostrar resultados
        echo "<div class='resultados'>";
        echo "<p><strong>Nombre:</strong> ".htmlspecialchars($nombre)."</p>";
        echo "<p><strong>Idioma:</strong> ".htmlspecialchars($idioma)."</p>";
        echo "<p><strong>Puntuación total:</strong> $score</p>";
        echo "</div>";
    }
?>
