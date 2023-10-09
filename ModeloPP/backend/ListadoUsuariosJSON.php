<?php
// Verificar si la solicitud es de tipo GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Incluir la clase Usuario.php y configurar la conexión a la base de datos
    require_once('./clases/Usuario.php');
    
    // Obtener todos los usuarios llamando al método TraerTodosJSON()
    $usuarios = Usuario::TraerTodosJSON();
    
    // Devolver la lista de usuarios en formato JSON
    header('Content-Type: application/json');
    echo json_encode($usuarios);
} else {
    // Si la solicitud no es GET, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
