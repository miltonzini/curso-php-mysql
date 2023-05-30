# Comentario general


# Archivos:
-root/index.php
-root/vistas/home.php
-root/vistas/login.php
-root/includes/db.php
-root/includes/logout.php
-root/includes/user_session.php
-root/includes/user.php


# Código index.php
```php
<?php
    include_once 'includes/user.php'; // comentario 01
    include_once 'includes/user_session.php'; // comentario 01

    $userSession = new UserSession(); // comentario 02
    $user = new User();// comentario 02

    if(isset($_SESSION['user'])){
        //echo "Hay sesión"; //temp
        $user->setUser($userSession->getCurrentUser()); // comentario 03
        include_once 'vistas/home.php';
    } else if (isset($_POST['username']) && isset($_POST['password'])){ // comentario 04
        //echo "validación de login"; //temp
        $userForm = $_POST['username']; // 04 A
        $passForm = $_POST['password']; // 04 A

        if ($user->userExists($userForm, $passForm)) { // 04 B
            //echo "usuario validado"; //temp
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);

            include_once 'vistas/home.php';
        } else {
            //echo "datos incorrectos"; //temp
            $errorLogin = "Nombre de usuario o Password incorrecto";
            include_once 'vistas/login.php';
        }
    } else { // comentario 05
        //echo "Login"; //temp
        include_once 'vistas/login.php';
    }

?>
```
# Comentarios index.php
01: primero incluímos las librerías
02: instanciamos UserSession y User.
03: esto es para el escenario en que abramos el sitio con la sesión previamente iniciada
04: si no hay sesión iniciada, chequeo si se le dio click a submit
    04 A: mapeo la información introducida. Quizás convendría usar nombres más claros como $userInput y $passwordInput o $enteredInput y $enteredPassword.
    04 B: le pasamos esos dos valores a la función userExists() y si da true
    1) guardamos $userForm en $userSession con su método setCurrentUser(). De esa forma no se pierde el nombre de usuario durante la navegación.
    2) guardamos $userForm en $user con su método setUser().
    3) llamamos a la vista home.php
05: si no se da el punto 03 ni 04, redirigimos a la vista login


# Código home.php
```php

```

# Código login.php
```php

```


# Código db.php
```php

```

# Código logout.php
```php
<?php
    include_once 'user_session.php'; // comentario 01

    $userSession = new UserSession(); // comentario 02
    $userSession->closeSession(); // comentario 03

    header("location: ../index.php"); // comentario 04

?>
```
# Comentarios logout.php



# Código user_session.php
```php
<?php
include_once 'db.php';
class UserSession {
    public function __construct(){
        session_start(); // comentario 01
    }

    public function setCurrentUser($user){ // comentario 02
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){ // comentario 03
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();  // comentario 04
        session_destroy(); // comentario 05 
    }
}

?>

```
# Comentarios user_session.php
01: función nativa de php para iniciar o reanudar una sesión de php, que permite el almacenamiento y acceso a datos del usuario a lo largo de diferentes solicitudes http. Debo hacer este llamado en cada página que necesite usar info de sesión.
02: setter
03: getter
04: borra los valores de las sesiones
05: destruye la sesión como tal.



# Código user.php
```php
<?php 
include_once 'db.php';
class User extends db
{
    private $nombre;
    private $username;

    public function userExists($user, $pass){ // comentario 01
        $md5pass = md5($pass);

        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if ($query->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function setUser($user){ // comentario 02
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) { // comentario 03
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }
    
    public function getNombre (){
        return $this->nombre;
    }
}

?>

```

# Comentarios user.php
-vamos a usar el objeto user para utilizar su información en diferentes partes de la página. Por ejemplo para imprimir su nombre.
01: función para validar si existe un usuario con el nombre introducido.
02: función para asignar las variables del objeto "usuario" (nombre y username) según el nombre proporcionado.
03: Dado que se supone que la consulta sql debería devolver una sola fila por user, resulta redundante usar un foreach. Podría reemplazarse con el foreach por algo como esto:
```php
public function setUser($user) {
    $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
    $query->execute(['user' => $user]);

    $currentUser = $query->fetch(); // Obtener la única fila de resultados

    if ($currentUser) {
        $this->nombre = $currentUser['nombre'];
        $this->username = $currentUser['username'];
    }
```
... quizás se usó este foreach por algún motivo como una posible flexibilidad futura, o para poder reutilizar código.

