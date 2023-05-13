<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .itemContainer {
            background-color: #e4dffd;
            border-radius: 0.5rem;
            width: 12rem;
            height: 1rem;
            padding: 1rem;
            margin: 0.5rem;
        }
        .itemContainer * {
            margin: auto;
            display: inline;
        }
        .tareaCompletada {
            color: gray;
        }
    </style>
</head>
<body>
    <div id="nuevoPendienteContainer">
        <form action="index.php" method="POST">
            <input type="text" name="texto" id="texto">
            <input type="submit" value="añadir tarea">
        </form> 
    </div>
    <div class="mostrarTodoContainer">
        <form action="index.php" method="POST" id="formMostrarTodo">
            <input type="checkbox" name="inputMostrarTodo" onchange="mostrarTodo(this)" 
            <?php if(isset($_POST['inputMostrarTodo'])){
                if ($_POST['inputMostrarTodo'] == "on") {
                    echo "checked";
                }
            } ?>> Mostrar todo
        </form>
    </div>

    <div id="todoList">
        <?php
            //Conexión BD
            $server = "localhost";
            $user = "root";
            $password = "fakepassword";
            $db = "test_todolist";
        
            $conexion = new mysqli($server, $user, $password, $db);
        
            if ($conexion -> connect_error) {
                die("Conexión fallida: " . $conexion -> connect_error);
            }
        
            //Validación de datos para ingresar
            if(isset($_POST['texto'])) {
                $texto = $_POST['texto'];
                if($texto != "") {
                    $sql = "INSERT INTO todo_table(texto, completado) VALUES ('$texto', false)";
                    if($conexion -> query($sql) === true) {
                        //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                    } else {
                        die("Error al insertar datos: " . $conexion -> error);
                    }
                }
                
                
            } else if(isset($_POST['completar'])){
                $id = $_POST['completar'];

                $sql = "UPDATE todo_table SET completado = 1 WHERE id = $id";

                if($conexion -> query($sql) === true) {
                    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                } else {
                    die("Error al actualizar datos: " . $conexion -> error);
                }
            } else if (isset($_POST['eliminar'])) {
                $id = $_POST['eliminar'];

                $sql = "DELETE FROM todo_table WHERE id = $id";

                if($conexion -> query($sql) === true) {
                    //echo '<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                } else {
                    die("Error al actualizar datos: " . $conexion -> error);
                }
            } 
            if (isset($_POST['inputMostrarTodo'])) { // revisar el nombre de la variable
                $ordenar = $_POST['inputMostrarTodo'];
                
                if($ordenar === "on") {
                    $sql = "SELECT * FROM todo_table ORDER BY completado DESC";
                } 
            } else {
                $sql = "SELECT * FROM todo_table WHERE completado = 0";
            }

            //Obtención de datos de la tabla
            $resultado = $conexion -> query($sql);
            if ($resultado -> num_rows > 0) {
                while($row = $resultado -> fetch_assoc()) {
                    ?>
                    <div class="itemContainer">
                        <form method="POST" id="form<?php echo $row['id'];?>" action="">
                            <input name="completar" value=" <?php echo $row['id'];?>" id="<?php echo $row['id'];?>" type="checkbox" onchange="completarPendiente(this)" <?php if($row['completado'] == 1) echo "checked disabled" ?>><span class="texto <?php if($row['completado'] == 1) echo "tareaCompletada" ?>"> <?php echo $row['texto'];?></span>
                        </form>
                        <form method="POST" id="form_eliminar_<?php echo $row['id'];?>" action="">
                            <input type="hidden" name="eliminar" value="<?php echo $row['id'];?>" />
                            <input type="submit" value="Eliminar">
                        </form>
                    </div>


                    <?php

                }
            }
            $conexion -> close();
        ?>
    </div>
    <script> <!-- JS -->
        function completarPendiente(e){
            var id = "form" + e.id;
            var formulario = document.getElementById(id);
            formulario.submit();
        };
        function mostrarTodo(e) {
            var formulario = document.getElementById("formMostrarTodo");
            formulario.submit();
        }
    </script>

</body>
</html>