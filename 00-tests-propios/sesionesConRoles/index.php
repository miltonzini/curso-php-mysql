<?php
    include_once 'includes/user.php';
    include_once 'includes/user_session.php';

    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
        //echo "Hay sesión";
        $user->setUser($userSession->getCurrentUser()); // esto es para el escenario en que abramos el sitio con la sesión previamente iniciada
        include_once 'vistas/home.php';
    } else if (isset($_POST['username']) && isset($_POST['password'])){ // chequeo si se le dio click a submit
        //echo "validación de login";
        $userForm = $_POST['username']; // mapeamos la información
        $passForm = $_POST['password'];

        if ($user->userExists($userForm, $passForm)) {
            //echo "usuario validado";
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);

            include_once 'vistas/home.php';
        } else {
            //echo "datos incorrectos";
            $errorLogin = "Nombre de usuario o Password incorrecto";
            include_once 'vistas/login.php';
        }
    } else {
        //echo "Login";
        include_once 'vistas/login.php';
    }

?>