<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validar formulario</title>
	<style>
		body{background-color: #264673; box-sizing: border-box;}

		form{
			background-color: white;
			padding: 10px;
			margin: 100px auto;
			width: 400px;
		}


		input[type=text], input[type=password]{
			padding: 10px;
			width: 380px;
		}
		input[type="submit"]{
			margin-top: 1rem;
		}

		.error{
			background-color: #FF9185;
			font-size: 12px;
			padding: 10px;
		}
		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
        .error, .correcto{
            position: fixed;
            border-radius: 0.5rem;
            top: 0;
            right: 0;
        }
	</style>
</head>
<body>
<div id="formularios">
    <?php
        $nombre = ""; 
        $password = ""; 
        $email = ""; 
        $pais = ""; 
        $nivel = ""; 
        $lenguajes = array();
        // esa declaración temprana de las variables me sirve para después lograr que los datos persistan en el formulario 
        // en caso de que haya un error en la validación 

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            $email = $_POST['email']; 
            $pais = $_POST['pais']; 
            
            if (isset($_POST['nivel'])) {
                $nivel = $_POST['nivel']; ;
            } else {
                $nivel = "";
            }
            if (isset($_POST['lenguajes'])) {
                $lenguajes = $_POST['lenguajes'];
            } else {
                $lenguajes = [];
            }

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

            if ($pais == "") {
                array_push($campos, "Selecciona un país");
            }

            if ($nivel == "x") {
                array_push($campos, "Selecciona un nivel");
            }

            if (count($lenguajes) < 2) {
                array_push($campos, "elija al menos dos lenguajes");
            }

            if (count($campos) > 0) {
                echo "<div class='error'>";
                for ($i = 0; $i < count($campos); $i++) { 
                    echo "<li>" . $campos[$i] . "</li>";
                }
            } else {
                echo "<div class='correcto'>
                Datos ingresados correctamente";
            }
            echo "</div>";
        }
    ?>
    <form action="formulario.php" id="form_session" method="post">
    <label for="nombre">Nombre:</label>
    <div class="field-container">
        <input id="nombre" name="nombre" type="text" class="field" placeholder="Nombre" value="<?php echo $nombre; ?>"><br>
    </div>
    <label for="password">Contraseña:</label>
    <div class="field-container">
        <input id="password" name="password" type="text" class="field" placeholder="******" value="<?php echo $password; ?>"><br>
    </div>
    <label for="email">Correo Electrónico:</label>
    <div class="field-container">
        <input id="email" name="email" type="text" class="field" placeholder="usuario@ejemplo.com" value="<?php echo $email; ?>"><br>
    </div>
    <br>
    <label for="pais">País de orígen:</label>
    <select id="pais" name="pais">
        <option value="">Selecciona un país</option>
        <option value="ar" <?php if ($pais == "ar") echo "selected" ?>>Argentina</option>
        <option value="mx" <?php if ($pais == "mx") echo "selected" ?>>México</option>
        <option value="usa" <?php if ($pais == "usa") echo "selected" ?>>Estados Unidos</option>
        <option value="co" <?php if ($pais == "co") echo "selected" ?>>Colombia</option>
        <option value="cl" <?php if ($pais == "cl") echo "selected" ?>>Chile</option>
    </select>
    <br><br>
    <label>Nivel de desarrollo:</label>
    <div>
        <input type="radio" name="nivel" value="principiante" <?php if ($nivel == "principiante") echo "checked" ?>> 
        <label for="principiante">Principiante</label>
        <input type="radio" name="nivel" value="intermedio" <?php if ($nivel == "intermedio") echo "checked" ?>>
        <label for="intermedio">Intermedio</label>
        <input type="radio" name="nivel" value="avanzado" <?php if ($nivel == "avanzado") echo "checked" ?>>
        <label for="avanzado">Avanzado</label>
    </div>
    <br><br>
    <label>Lenguajes de programación</label>
    <br>
    <input type="checkbox" name="lenguajes[]" value="html" <?php if (in_array("html", $lenguajes)) echo "checked" ?>> HTML <br>
    <input type="checkbox" name="lenguajes[]" value="css" <?php if (in_array("css", $lenguajes)) echo "checked" ?>> CSS <br>
    <input type="checkbox" name="lenguajes[]" value="js" <?php if (in_array("js", $lenguajes)) echo "checked" ?>> Javascript <br>
    <input type="checkbox" name="lenguajes[]" value="php" <?php if (in_array("php", $lenguajes)) echo "checked" ?>> PHP <br>
    <!-- <label for="lenguajes[]">HTML</label> -->

    <br><br>
    <div class="center-content">
        <input type="submit" value="enviar datos">
    </div>
    </form>
</div>
</body>
</html>