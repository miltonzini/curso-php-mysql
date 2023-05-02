<?php
    $servidor = "localhost";
    $nombre = "root";
    $password = "fakepassword";
    $db = "test_todolist";

    $conexion = new mysqli($servidor, $nombre, $password, $db);

    if($conexion->connect_error) {
        die("conexión fallida: " . $conexion -> connect_error);
    }

    
    $sql = "CREATE DATABASE test_todolist";
    if ($conexion -> query($sql) === true) {
        echo "Base de datos creada correctamente.";
    } else {
        die("Error al crear base de datos: " . $conexion -> error);
    }
    
    
    
    $sql = "CREATE TABLE todo_table(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        texto VARCHAR(100) NOT NULL,
        completado BOOLEAN NOT NULL,
        timestamp TIMESTAMP
    )";
    
    
    if ($conexion -> query($sql) === true) {
        echo "Tabla creada correctamente.";
    } else {
        die("Error al crear tabla: " . $conexion -> error);
    };
    
    

?>