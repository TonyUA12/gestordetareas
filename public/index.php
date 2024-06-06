<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\DashboardController;
use MVC\Router;

$router = new Router();
//login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


//crear usuarios
$router->get('/createuser', [LoginController::class, 'createUser']);
$router->post('/createuser', [LoginController::class, 'createUser']);

// Formulario para forgotpassword
$router->get('/forgotpassword', [LoginController::class, 'forgotPassword']);
$router->post('/forgotpassword', [LoginController::class, 'forgotPassword']);

// formulario new password
$router->get('/resetpassword', [LoginController::class, 'resetPassword']);
$router->post('/resetpassword', [LoginController::class, 'resetPassword']);

// confirmaccount
$router->get('/message', [LoginController::class, 'message']);
$router->get('/confirmaccount', [LoginController::class, 'confirmAccount']);


//DASHBOARD

$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/create-task', [DashboardController::class, 'create_task']);
$router->post('/create-task', [DashboardController::class, 'create_task']);
$router->get('/task', [DashboardController::class, 'task']);
$router->get('/profile', [DashboardController::class, 'profile']);
$router->post('/task/delete', [DashboardController::class, 'delete_task']);
$router->post('/task/status', [DashboardController::class, 'change_status']);
$router->get('/update', [DashboardController::class, 'update_task']);
$router->post('/update', [DashboardController::class, 'update_task']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();