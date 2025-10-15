<?php
//Este es mi enrutador, el que distribuye todo a cada lado
session_start(); // el mismo session que usamos en el login.

require_once 'controllers/controller.php'; // necesito llamar a mis funciones

$controller = new controller(); // instanciar mi controlador

try {
    switch ($route) { // podemos hacer un home y lo mandamos a loguear
        case 'home':
            if (!isset($_SESSION['usuario_id'])) {
                $controller->login();
            }
    }
} catch (Exception $e) {
    // Manejo básico de errores de la aplicación
    error_log("Error en el enrutador: " . $e->getMessage());
    http_response_code(500);
    echo "<h1>Error 500: Error interno del servidor</h1>";
}

?>