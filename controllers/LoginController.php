<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {

        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);

            $alertas = $user->validateLogin();

            if(empty($alertas)){
                //verificar existencia
                $user = User::where('email', $user->email);

                if(!$user || !$user->confirm){
                    User::setAlerta('error', 'El usuario no existe o no esta confirmado');
                } else {
                    if(password_verify($_POST['password'], $user->password)){

                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;


                        //REDIRECCIONAR A
                        header('Location: /dashboard');
                        debuguear($_SESSION);

                    } else {
                        User::setAlerta('error', 'Contraseña Incorrecta');
                    }
                }
            }

        }

        $alertas = User::getAlertas();

        //RENDERISAR LA VISTA
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function createUser(Router $router) {
        $alertas = [];
        $user = new User;


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user -> sincronizar($_POST);
            $alertas = $user -> validateNewAccount();

            if(empty($alertas)){
                $userExist = User::where('email', $user->email);

                if($userExist){
                    User::setAlerta('error', 'El usuario esta registrado');
                    $alertas = User::getAlertas();
                } else {

                    $user->hashPassword();
                    //eliminar password 2
                    unset($user->password2);

                    $user -> generateToken();
                    
                    $resultado = $user->guardar();

                    //Enviar confirmacion
                    $email = new Email($user->email, $user->name, $user->token);

                    $email->sendConfirmation();

                    if($resultado) {
                        header('Location: /message');
                    }
                }
            }
        }

        $router->render('auth/createUser', [
            'titulo' => 'Crear Cuenta',
            'user' => $user,
            'alertas' => $alertas
        ]);
    }

    public static function forgotPassword(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alertas = $user->validateEmail();
            if(empty($alertas)){
                $user = User::where('email', $user->email);
                if($user && $user->confirm){
                    
                    //nuevo token
                    $user->generateToken();
                    unset($user->password2);
                    
                    $user->guardar();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();


                    $user::setAlerta('exito', 'Se ah enviado las instrucciones al email');

                }else{
                    User::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    
                }
            }
        }

        $alertas = User::getAlertas();
        

        $router->render('auth/forgotpassword', [
            'titulo' => 'Recuperar Contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function resetPassword(Router $router) {

        $token = s($_GET['token']);
        $show = true;

        if(!$token) header('Location: /');

        $user = User::where('token', $token);

        if(empty($user)){
            User::setAlerta('error', 'Token no Válido');
            $show = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user -> sincronizar($_POST);
            unset($user->password2);
            $alertas = $user->validatePassword();

            if(!empty($user->password)){
                $user->hashPassword();

                $user->token = null;

                $resultado = $user->guardar();

                if($resultado){
                    header('Location: /');
                }
            }else{

            }
        }

        $alertas = User::getAlertas();

        $router->render('auth/resetPass', [
            'titulo' => 'Nueva Contraseña',
            'alertas' => $alertas,
            'show' => $show
        ]);
    }

    public static function message(Router $router) {
        $router->render('auth/message', [
            'titulo' => 'Mensaje Enviado'
        ]);
    }

    public static function confirmAccount(Router $router) {

        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        //Encontrar al usuario con este token
        $user = User::where('token', $token);

        if(empty($user)) {
            User::setAlerta('error', 'Token No Válido');
        } else {
            $user -> confirm = 1;
            $user ->token = null;
            unset($user->password2);

            $user->guardar();

            User::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = User::getAlertas();



        $router->render('auth/confirm', [
            'titulo' => 'Confirmar Cuenta',
            'alertas' => $alertas
        ]);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }

}