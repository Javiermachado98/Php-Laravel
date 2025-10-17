<?php
//Este es mi enrutador, el que distribuye todo a cada lado
session_start(); // el mismo session que usamos en el login.

require_once 'controllers/controller.php'; // necesito llamar a mis funciones

$controller = new controller(); // instanciar mi controlador

$action = $_GET['action'] ?? 'login';

try {
    switch ($action) { // podemos hacer un home y lo mandamos a loguear
        case 'login':
            $controller->showLogin();
            break;
        case 'processLogin':
            $controller->login();
            break;
        
        case 'dashboard':
            $controller->dashboard();
            break;
        
        case 'logout':
            $controller->logout();
            break;
        
        default:
            http_response_code(404);
            echo "<h1>Error: Página no encontrada</h1>";
            break;

    }
} catch (Exception $e) {
    // Manejo básico de errores de la aplicación
    error_log("Error en el enrutador: " . $e->getMessage());
    http_response_code(500);
    echo "<h1>Error 500: Error interno del servidor</h1>";
}

?>