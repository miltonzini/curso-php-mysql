<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label.title {
            display: block;
        }
        body{background-color: #efefef; box-sizing: border-box;}

		form{
			background-color: white;
			padding: 15px;
			margin: 100px auto;
			width: 400px;
            border-radius: 6px;
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
    <?php
        $name = ""; 
        $email = "";
        $password = "";
        $nivel = "";
        $ciudad = "";

        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if (isset($_POST['nivel'])) { 
                $nivel = $_POST['nivel'];
            } else {
                $nivel = "";
            }
            // lo anterior (para nivel) es necesario ya que por defecto no hay ningún bullet marcado, entonces
            // da un error al buscar un array indefinido.  
            $ciudad = $_POST['ciudad'];

            $camposError = array();

            if ($name == "") {
                array_push($camposError, "introduzca un nombre");
            }
            if (strpos($email, '@') === false) {
                array_push($camposError, "introduzca un email válido");
            }
            if (strlen($password) < 8) {
                array_push($camposError, "introduzca una contraseña válida");
            }
            if ($nivel == "") {
                array_push($camposError, "introduzca una nivel");
            }

            if ($ciudad == "") {
                array_push($camposError, "elija una ciudad");
            }

            // imprimir errores
            if (count($camposError) > 0) {
                echo "<div class='error'>";
                for ($i=0; $i < count($camposError); $i++) { 
                    echo "<li>" . $camposError[$i] . "</li>";
                } 
            } else {
                echo "<div class='correcto'>";
                echo "Los datos fueron ingresados correctamente";
            }
            echo "</div>";
        } 
    ?>
    <form action="formularioMZ.php" method="post">
        <label class="title" for="name">Nombre:</label>
        <input name="name" type="text" id="name" class="field" placeholder="nombre" value="<?php echo $name ?>">

        <label class="title" for="email">Email:</label>
        <input name="email" type="text" id="email" class="field" placeholder="nombre" value="<?php echo $email ?>">

        <label class="title" for="password">Password:</label>
        <input name="password" type="text" id="password" class="password" placeholder="********" value="<?php echo $password ?>">

        <label class="title">Nivel de inglés</label>
        <input name="nivel" type="radio" name="ingles" id="" value="principiante" <?php if($nivel == "principiante") echo "checked" ?>>
        <label for="nivel">Principiante</label>
        <input name="nivel" type="radio" name="ingles" id="" value="intermedio" <?php if($nivel == "intermedio") echo "checked" ?>>
        <label for="nivel">Intermedio</label>
        <input name="nivel" type="radio" name="ingles" id="" value="avanzado" <?php if($nivel == "avanzado") echo "checked" ?>>
        <label for="nivel">Avanzado</label>
        
        <br>
        <label for="ciudad">Ciudad de orígen:</label>
        <select name="ciudad" id="ciudad">
            <option value="">Elija una Ciudad</option>
            <option value="caba" <?php if ($ciudad == "caba") echo "selected"?>>Capital Federal</option>
            <option value="gba" <?php if ($ciudad == "gba") echo "selected"?>>Gran Buenos Aires</option>
            <option value="cordoba" <?php if ($ciudad == "cordoba") echo "selected"?>>Córdoba</option>
            <option value="rosario" <?php if ($ciudad == "rosario") echo "selected"?>>Rosario</option>
        </select>

        <br>
        <input class"submit" type="submit" value="enviar">
    </form>
    
</body>
</html>