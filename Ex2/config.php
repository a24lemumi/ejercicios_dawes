<?php
    #array de idiomas
    // Sustituye este comentario por la descripción del array
    array("Español", "Inglés","Francés", "Aleman","Italiano","Portugués");

    #array con el cuestionario.
    // Sustituye este comentario por la descripción del array
    $test = array(
        array ("pregunta" => "The room where secretaries work is called an .....",
            "Tipo"=>"text",
            "Respuesta"=>array("office"),
            "Acierto"=>1,
            "Fallo"=>0),
        array ("pregunta" => "To go to the top of the building you can take the .....",
            "Tipo"=>"text",
            "Respuesta"=>array("lift","elevator"),
            "Acierto"=>1,
            "Fallo"=>0),
        array ("pregunta" => "I ..... tennis every Sunday morning.",
            "Tipo"=>"Multiple-choice",
            "Opciones"=>array("playing","play","am playing","am play"),
            "Respuesta"=>"play",
            "Acierto"=>1,
            "Fallo"=>-0.25),
        array ("pregunta" => "Don't make so much noise. Noriko ..... to study for her ESL test!",
            "Tipo"=>"Multiple-choice",
            "Opciones"=>array("try","tries","tried","is trying"),
            "Respuesta"=>"is trying",
            "Acierto"=>1,
            "Fallo"=>-0.25),
        array ("pregunta" => "Jun-Sik ..... his teeth before breakfast every morning.",
            "Tipo"=>"Multiple-choice",
            "Opciones"=>array("will cleaned","is cleaning","cleans","clean"),
            "Respuesta"=>"cleans",
            "Acierto"=>1,
            "Fallo"=>-0.25),
        array ("pregunta" => "Sorry, she can't come to the phone. She ..... a bath!",
            "Tipo"=>"Multiple-choice",
            "Opciones"=>array("is having","having","have","has"),
            "Respuesta"=>"is having",
            "Acierto"=>1,
            "Fallo"=>-0.25),
        array ("pregunta" => "	..... many times every winter in Frankfurt.",
            "Tipo"=>"Multiple-choice",
            "Opciones"=>array("It snows","snowed","It is snowing","It is snow"),
            "Respuesta"=>"It snows",
            "Acierto"=>1,
            "Fallo"=>-0.25)
    );