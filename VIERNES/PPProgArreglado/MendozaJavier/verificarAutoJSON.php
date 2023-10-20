<?php

require_once('./clases/auto.php');
use MendozaJavier\Auto;
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió la patente
    if (isset($_POST['patente'])) {
        // Incluir la clase Auto.php
        //require_once('./clases/Auto.php');

        // Utilizar el espacio de nombres correcto al crear una instancia de la clase Auto
        $patente = $_POST['patente'];

        // Crear una instancia de la clase Auto dentro del espacio de nombres MendozaJavier
        //$auto = new Auto();

        // Crear una instancia de la clase Auto
        $auto = new Auto($patente, '', '', 0); // Los otros campos pueden tener valores ficticios por ahora

        // Llamar al método verificarAutoJSON y obtener el resultado
        $resultado = Auto::verificarAutoJSON($auto);

        // // Construir la respuesta JSON
        // $respuesta = [
        //     'exito' => $resultado['exito'],
        //     'mensaje' => $resultado['mensaje']
        // ];

        header('Content-Type: application/json');
        //echo json_encode($resultado);
        
        echo ($resultado);
    } else {
        // Si no se recibió la patente, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Falta la patente.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
