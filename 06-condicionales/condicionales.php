<?php
    $hora = 12;
    if ($hora >= 7 && $hora < 12) {
        echo "Buenos días";
    } else if ($hora >= 12 && $hora < 17) {
        echo "Buenas tardes";
    } else {
        echo "Buenas noches";
    }
    echo "<br/>(la variable 'hora' está seteada en " . $hora . ").";
?>