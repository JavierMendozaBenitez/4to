<?php

require_once('AutoBD.php'); // Asegúrate de incluir la clase AutoBD
use MendozaJavier\AutoBD;

// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el JSON de la solicitud
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData);

    // Verificar si se pudo decodificar el JSON correctamente
    if ($data !== null && isset($data->patente)) {
        // Crear la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

        // Llama al método traer para obtener la lista de autos desde la base de datos
        $autos = AutoBD::traer($conexion);

        foreach ($autos as $auto) {
            if ($auto->patente === $data->patente) {
                // Si se encuentra el registro, retornar los datos del objeto en formato JSON
                header('Content-Type: application/json');
                echo $auto->toJSON();
                exit; // Detener la ejecución después de encontrar una coincidencia
            }
        }
    }

    // Si no se encontró coincidencia, devolver un JSON vacío
    header('Content-Type: application/json');
    echo '{}';
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
