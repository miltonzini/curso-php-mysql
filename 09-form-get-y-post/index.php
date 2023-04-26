<div id="formularios">
    <?php
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $campos = array();

            if ($nombre == "") {
                array_push($campos, "El campo 'nombre' no puede estar vacío");
            }

            if ($password == "" || strlen($password) < 8 ) {
                array_push($campos, "El campo 'password' no puede estar vacío ni tener menos de 8 caracteres");
            }

            if ($email == "" || strpos($email, "@") === false ) {
                array_push($campos, "Introduzca una dirección de email válida");
            }

            if (count($campos) > 0) {
                echo "<div class='error'>";
                for ($i = 0; $i < count($campos); $i++) { 
                    echo "<li>" . $campos[$i] . "</li>";
                }
            } else {
                echo "<div class='correcto'>
                Datos Correctos";
            }
            echo "</div>";
        }
    ?>
    <form action="recibir_post.php" id="form_session" method="post">
        <p>Nombre:</p>
        <div class="field-container">
            <input name="nombre" type="text" class="field" placeholder="Juan Pérez"> <br/>
        </div>    
        <p>Contraseña:</p>
        <div class="field-container">
            <input name="password" type="text" class="field" placeholder="******"> <br/>
        </div>    
        <p>Correo Electrónico:</p>
        <div class="field-container">
            <input name="email" type="text" class="field" placeholder="usuario@ejemplo.com"> <br/>
        </div>
        <div class="center-content">
            <input type="submit" value="Iniciar sesión" > <br> <br>
            <a href="recibir_get.php?tipo_usuario=nuevo&navegador=chrome">Registrar cuenta</a>
        </div>
    </form>
</div>