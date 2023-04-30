<?php
    $server = "localhost";
    $user = "root";
    $password = "fakepassword";
    $db = "test_roles_2";

    $conexion = new mysqli($server, $user, $password, $db);

    if ($conexion -> connect_error) {
        die("Conexión fallida: " . $conexion -> connect_error);
    }

    echo "Conexión exitosa.";


?> 
