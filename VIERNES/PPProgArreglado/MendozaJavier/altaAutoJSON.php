<?php

require_once('./clases/auto.php');
use MendozaJavier\Auto;
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los campos necesarios (patente, marca, color y precio)
    if (isset($_POST['patente']) && isset($_POST['marca']) && isset($_POST['color']) && isset($_POST['precio'])) {
        // Incluir la clase Auto.php
        //require_once('./clases/auto.php');

        // Crear una instancia de la clase Auto
        $patente = $_POST['patente'];
        $marca = $_POST['marca'];
        $color = $_POST['color'];
        $precio = $_POST['precio'];

        $auto = new Auto($patente, $marca, $color, $precio);
        
        // Invocar el método guardarJSON
        $archivoJSON = './archivos/autos.json';
        //$exito = $auto->guardarJSON($archivoJSON);
        
        $respuesta = $auto->guardarJSON($archivoJSON);

        //$respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Auto agregado correctamente' : 'Error al agregar el auto'];

        header('Content-Type: application/json');
        
        //echo json_encode($respuesta);
        echo ($respuesta);
    } else {
        // Si no se recibieron todos los campos necesarios, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Faltan datos obligatorios.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
