<?php

require_once('AutoBD.php'); // Asegúrate de incluir la clase AutoBD
use MendozaJavier\AutoBD;


// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el JSON de la solicitud
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData);

    // Verificar si se pudo decodificar el JSON correctamente
    if ($data !== null) {
        // Crear una instancia de la clase AutoBD con los datos del JSON
        $auto = new AutoBD($data->patente, $data->marca, $data->color, $data->precio);

        // Crear la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

        // Invocar el método modificar para actualizar el auto en la base de datos
        $exito = $auto->modificar($conexion);

        // Preparar la respuesta en formato JSON
        $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Auto modificado correctamente' : 'Error al modificar el auto'];

        header('Content-Type: application/json');
        echo json_encode($respuesta);
    } else {
        // Si no se pudo decodificar el JSON, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Error en los datos JSON.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}