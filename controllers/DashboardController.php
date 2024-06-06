<?php
namespace Controllers;

use Model\Task;
use MVC\Router;
use Model\User;

class DashboardController{
    public static function index(Router $router){
        
        session_start();
        isAuth();
        $tasks = Task::belongsTo('ownerId', $_SESSION['id']);

        $router->render('dashboard/index', [
            'titulo' => 'TAREAS',
            'tasks' => $tasks
        ]);
    }

    public static function create_task(Router $router){
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $task = new Task($_POST);
            $alertas = $task -> validateTask();
            if(empty($alertas)){  

                $task->url = md5(uniqid());
                $task->ownerId = $_SESSION['id'];
                
                $task->guardar();
                //redireccionar
                header('Location: /task?url='.$task->url);
            }
        }

        $router -> render('dashboard/create-task', [
            'titulo' => 'CREAR TAREA',
            'alertas' => $alertas
        ]);

    }

    public static function update_task(Router $router){
        session_start();
        isAuth();
        $alertas=[];

        $id = $_GET['id'];
        $task = Task::where('id', $id);

        if(!$id) header('Location: /dashboard');

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $task -> sincronizar($_POST);
            $task->guardar();

            header('Location: /dashboard');


        }

        $router -> render('dashboard/update-task', [
            'titulo' => 'EDITAR TAREA',
            'alertas' => $alertas,
            'nameTask' => $task->task,
            'description' => $task->description,
            'dueDate' => $task->dueDate
        ]);
    }

    public static function delete_task(Router $router){
        session_start();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $task = new Task($_POST);
            $result = $task -> eliminar();

            $result = [
                'result' => $result,
                'message' => 'Eliminado Correctamente',
                'type' => 'exito'
            ];

            echo json_encode(['resultado' => $result]);
        }
    }

    public static function task(Router $router){
        session_start();
        isAuth();

        $url = $_GET['url'];
        if(!$url) header('Location: /dashboard');

        $task = Task::where('url', $url);
        if($task->ownerId !== $_SESSION['id']){
            header('Location: /dashboard');
        }   

        $router->render('dashboard/task', [
            'titulo' => $task->task
        ]);
    }

    public static function change_status(Router $router){
        $id = $_POST['id'];
        $task = Task::where('id', $id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $task -> sincronizar($_POST);
            $taskStatus = $task->status;
            if($taskStatus == 0){
                $task->status = 1;
            } else {
                $task->status = 0;
            }

            $resultado = $task->guardar();
            if($resultado){
                header('Location: /');
            }
        }        

    }

    public static function profile(Router $router){
        session_start();
        isAuth();
        $alertas = [];

        $user = User::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user->sincronizar($_POST);

            $alertas = [];

            if(empty($alertas)) {

                $existUser = User::where('email', $user->email);

                if($existUser && $existUser->id !== $user->id ) {
                    // Mensaje de error
                    User::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $user->getAlertas();
                } else {
                    // Guardar el registro
                    $user->guardar();

                    User::setAlerta('exito', 'Guardado Correctamente');
                    $alertas = $user->getAlertas();

                    // Asignar el nombre nuevo a la barra
                    $_SESSION['name'] = $user->name;
                }
            }
        }
        
        $router->render('dashboard/profile', [
            'titulo' => 'Perfil',
            'usuario' => $user,
            'alertas' => $alertas
        ]);

    }


}