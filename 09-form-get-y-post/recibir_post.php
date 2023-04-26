<?php
$nombre = $_POST['nombre'];
$password = $_POST['password'];
// $_POST es una variable global.

// conectarse a la base de datos
// autenticar el usuario

echo "el usuario es '" . $nombre . "' y la contraseña es '" . $password . "'.";
?>