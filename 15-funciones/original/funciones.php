<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html {
            box-sizing: border-box;
        }
        .error {
            margin-top: 2px;
            padding: 0.5em;
            color: red;
            background-color: pink;
        }
        form {
            max-width: 15em;
        }
    </style>
</head>
<body>
    <div id="container">
        <h2>Multiplicar</h2>
        <form action="" method="post">
            <input type="text" name="numero01">
            <input type="text" name="numero02">
            <br>
            <input type="submit" value="calcular">
            <?php
                include("operaciones.php");
                validarCampos();
            ?>
        </form>
    </div>
</body>
</html>