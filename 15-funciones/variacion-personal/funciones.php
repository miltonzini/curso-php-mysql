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
        .resultado {
            margin-top: 2px;
            padding: 0.5em;
            color: black;
            background-color: greenyellow;
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
        <h2>Sumar / Restar / Multiplicar / Didivir / Concatenar</h2>
        <form action="" method="post">
            <input type="text" name="numero01">
            <input type="text" name="numero02">
            <br>
            <input type="submit" value="calcular">
            <?php
                include("operaciones.php");
                sumar();
                //restar();
                //multiplicar();
                //dividir();
                //concatenar();
            ?>
        </form>
    </div>
</body>
</html>