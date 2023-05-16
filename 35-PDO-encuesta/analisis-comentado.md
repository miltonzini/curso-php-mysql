# Comentario general
Aquí se analizará el flujo paso a paso, tomando como ejemplo de testing que se elija la opción "Java" y se haga sumbit. Al final la descripción.

# Archivos:
-root/index.php
-root/main.css
-root/includes/db.php
-root/includes/survey.php
-root/vistas/vista-votacion.php
-root/vistas/vista-resultados.php

# Código index.php
```php
<?php
    include_once 'includes/survey.php'; // comentario 01
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Encuesta</title>
</head>
<body>
    <form action="#" method="POST">
        <?php
            $survey = new Survey(); // comentario 02
            $showResults = false;// comentario 03

            if (isset($_POST['lenguaje'])) { // comentario 04
                $showResults = true;
                
                $survey->setOptionSelected($_POST['lenguaje']);// comentario 05
                $survey->vote(); // comenario 07
            }

        ?>

        <h2>¿Cuál es tu lenguaje de programación preferido?</h2>

        <?php
            if ($showResults) { // comentario 09
                $lenguajes = $survey->showResults();
                echo '<h2>' . $survey->getTotalVotes() . ' votos totales</h2>' ;

                foreach($lenguajes as $lenguaje) {
                    $porcentaje = $survey->getPercentageVotes($lenguaje['votos']);
                    
                    include 'vistas/vista-resultados.php';
                }
            } else {
                include 'vistas/vista-votacion.php';
            }
        ?>

        
    </form>

</body>
</html>
```


# Código db.php
```php
<?php

class DB {
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct() {
        $this->host = 'localhost';
        $this->db = 'test_encuestas';
        $this->user = 'root';
        $this->password = 'fakepassword';
        $this->charset = 'utf8mb4';
    }

    public function connect(){
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_EMULATE_PREPARES => false];

            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            print_r("Connection error: " . $e->getMessage());
        }
    }
}

?>
```


# Código survey.php
```php
<?php
    include_once 'db.php';

    class Survey extends DB
    {
        private $totalVotes;
        private $optionSelected;
    
        public function setOptionSelected($option){
            // comentario 06 
            $this->optionSelected = $option;
        
        }
    
        public function getOptionSelected(){
            return $this->optionSelected;
        }

        public function vote(){
            $query = $this->connect()->prepare('UPDATE lenguajes SET votos = votos + 1 WHERE opcion = :opcion');
            $query->execute(['opcion' => $this->optionSelected]);
        }
        
        public function showResults(){
            return $this->connect()->query('SELECT * FROM lenguajes'); // comentario x
        }

        public function getTotalVotes(){
            $query = $this->connect()->query('SELECT SUM(votos) AS votos_totales FROM lenguajes');
            $this->totalVotes = $query->fetch(PDO::FETCH_OBJ)->votos_totales;
            return $this->totalVotes;
        }

        public function getPercentageVotes($votes){
            return round(($votes / $this->totalVotes) * 100, 0);
        }
    }
// Comentario X. Aquí no necesitamos preparar la consulta ni llamar a execute, ya que no tenemos valores que validar, a diferencia de la consulta anterior.
// Comentario Y. El "AS votos_totales" es una forma en sql de poner un alias a la tabla de resultados
?>
```


# Código vista-votacion.php
```php
<input type="radio" name="lenguaje" id="" value="c"> C <br>
<input type="radio" name="lenguaje" id="" value="c++"> C++ <br>
<input type="radio" name="lenguaje" id="" value="java"> Java <br>
<input type="radio" name="lenguaje" id="" value="swift"> Swift <br>
<input type="radio" name="lenguaje" id="" value="python"> Pyton <br>

<input type="submit" value="Votar!">
```


# Código vista-resultados.php
```php
<div class="opcion">
<?php
    $barWidth = $porcentaje * 5; // magic number
    $estilo = "barra";

    if($survey->getOptionSelected() == $lenguaje['opcion']){
        $estilo = "seleccionado";
    }

    echo $lenguaje['opcion'];
?>
    <div class="<?php echo $estilo; ?>" style="width: <?php echo $barWidth . 'px;' ?>"><?php echo $porcentaje . '%'?></div>

</div>

<?php

```


# Código main.css
```css
body{
    font-family: Arial, Helvetica, sans-serif;
}
form{
    background-color: #eee;
    margin: 0 auto;
    width: 500px;
    padding: 20px;
}

.opcion{
    padding: 5px 0;
}

.barra{
    background-color:rgb(152, 196, 236);
    border-radius: 4px;
    padding: 10px;
}

.seleccionado{
    background-color: rgb(33, 90, 143);
    border-radius: 4px;
    color: white;
    padding: 10px;
}
```



# Comentarios
## Paso a paso tomando un caso de prueba en que elijamos la opción "Java".
01: en **index.php** se llama a *survey.php* para poder acceder a sus funciones, clases, etc.
02: en **index.php** instanciamos la *clase Survey* (contenida en survey.php)
03: inicializamos la variable *$showResults* en false. Esta definirá qué vista se mostrará.
04: chequeamos si se hizo submit con el dato "lenguaje" (en este caso de prueba el array asociativo contiene lenguaje => 'java'). Si es afirmativo cambiamos *$showResults* a true, para que se muestre la vista de resultados.
05: llamamos al *método setOptionSelected* del objeto *$survey* y le pasamos por parámetro "java", es decir $_POST['lenguaje'].
06: en **survey.php** el método recién llamado guarda "java" (como parámetro *$option*) en el atributo *optionSelected* del objeto de la clase Survey. 
07: en **index.php** llamamos al método *vote()* del objeto *$survey*
08: en **survey.php** la fución vote prepara la consulta sql dejando un placeholder *:opcion*. Luego ejecuta esa query completando el placeholder con la info contenida en survey->optionSelected ("java"). Esta consuilta incrementa en 1 la cantidad de votos para esa fila en la tabla sql.
09: 