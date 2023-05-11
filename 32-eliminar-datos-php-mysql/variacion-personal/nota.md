En esta refactorización:
1) se corrigió la verificación de la ejecución de la consulta sql:
```php
if($conexion -> query($sql) === true) {
    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
} else {
    die("Error al insertar datos: " . $conexion -> error);
}
```

por 

```php
if ($conexion->query($sql) !== true) {
    die("Error al insertar datos: " . $conexion->error);
}
```

2) Se usaron funciones separadas para que el código sea más modular, más legible y evitar redundancias.

3) Se cambió el prefijo form_eliminar (id) a camelCase (formEliminar).