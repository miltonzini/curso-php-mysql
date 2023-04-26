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
    </style>
</head>
<body>
    <div id="container">
        <?php 
            $meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
            echo "today is " . date('l') . " " . date('d') . " of " . $meses[date('m') - 1] . " of " . date('Y') . ".";
            echo "<br/>";
            echo "time is " . date('j') . ":" . date('m') . ":"  . date('s') . ".";
            // versión abreviada:
            //echo "time is " . date('j:m:sa') . ".";
        ?>  
    </div>
</body>
</html>