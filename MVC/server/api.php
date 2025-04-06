<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
use Controllers\AuthController;
use Controllers\JornadaController;
use Controllers\NoticiasController;
use Controllers\EventosControllers;

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
$action = $get['action'] ?? ($data['action'] ?? null);

if (!$action){
    http_response_code(400);
    echo json_encode(['message' => 'No se recibio la accion']);
    exit;
}

$controllers = [
    'auth' => new AuthController(),
    'jornada' => new JornadaController(),
    'noticias' => new NoticiasController(),
    'equipo' => new EquipoController()
];

$routes = [
    'POST' => [
        'registrarse' => ['auth', 'registrarse'],
        'login' => ['auth', 'login'],
        'agregarRol' => ['auth', 'agregarRol'],
        'agregarJornada' => ['jornada', 'agregarJornada']
    ],
    'GET' => [
        'obtenerJornada' => ['jornada', 'obtenerJornada'],
        'obtenerRol' => ['auth' ,'obtenerRol'],
        'obtenerEquipo' => ['equipo' , 'obtenerEquipo'],
        'obtenerNoticias' => ['noticias', 'obtenerNoticias'],
    ],
    'UPDATE' => [
        'actualizarPerfil' => ['auth' , 'actualizarPerfil'],
        'actualizarJornada' => ['jornada' , 'actualizarJornada']
    ],
    'DELETE' => [
        'eliminarJornada' => ['jornada' , 'eliminarJornada']
    ]
];
if (isset($routes[$method][$action])){
    [$controllerKey, $method ] = $routes[$method][$action];
    $controllers[$controllerKey]->$method($data);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Accion no encontrada']);
}





?>