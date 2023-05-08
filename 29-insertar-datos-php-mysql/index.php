<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input type="text" name="texto" id="texto">
        <input type="submit" value="añadir tarea">
    </form>

    <div id="todoList">
        <?php
            $server = "localhost";
            $user = "root";
            $password = "fakepassword";
            $db = "test_todolist";
        
            $conexion = new mysqli($server, $user, $password, $db);
        
            if ($conexion -> connect_error) {
                die("Conexión fallida: " . $conexion -> connect_error);
            }
        
            if(isset($_POST['texto'])) {
                $texto = $_POST['texto'];
                
                $sql = "INSERT INTO todo_table(texto, completado) VALUES ('$texto', false)";

                if($conexion -> query($sql) === true) {
                    echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                }

            } 
        ?>
    </div>

</body>
</html>