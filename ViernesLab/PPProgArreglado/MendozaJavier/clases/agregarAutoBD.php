<?php

require_once('AutoBD.php'); // Asegúrate de incluir la clase AutoBD
use MendozaJavier\AutoBD;

// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los campos necesarios (patente, marca, color, precio y foto)
    if (isset($_POST['patente']) && isset($_POST['marca']) && isset($_POST['color']) && isset($_POST['precio']) && isset($_FILES['foto'])) {
        $patente = $_POST['patente'];
        $marca = $_POST['marca'];
        $color = $_POST['color'];
        $precio = $_POST['precio'];
        $foto = $_FILES['foto'];

        // Crear la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

        // Llama al método traer para obtener la lista de autos desde la base de datos
        $autos = AutoBD::traer($conexion);

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        // Crear una instancia de la clase AutoBD con los datos recibidos
        $nombreFoto = $patente . '.' . date('His') . '.jpg';
        $ubicacionNuevaFoto = '../autos/imagenes/' . $nombreFoto;

        // Verificar la existencia previa del auto en la base de datos
        $auto = new AutoBD($patente, $marca, $color, $precio, $ubicacionNuevaFoto);

        if ($auto->existe($autos)) {
            $respuesta = ['exito' => false, 'mensaje' => 'El auto ya existe en la base de datos.'];
        } else {
            // Si el auto no existe, guardar la foto en "./autos/imagenes/"
            move_uploaded_file($foto['tmp_name'], $ubicacionNuevaFoto);

            // Invocar el método agregar para registrar el auto en la base de datos
            $exito = $auto->agregar($conexion);

            $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Auto agregado correctamente' : 'Error al agregar el auto'];
        }

        header('Content-Type: application/json');
        echo json_encode($respuesta);
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
