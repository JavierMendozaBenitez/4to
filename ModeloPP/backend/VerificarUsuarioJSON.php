<?php

// require_once('./clases/Usuario.php');

// $correo = $_POST["correo"];
// $clave = $_POST["clave"];

// $usuario_json = json_encode([$correo,$clave]);
// $usuario = Usuario::TraerUno($usuario_json);

// echo $usuario->nombre;
// Agrega un var_dump para verificar el contenido recibido
//var_dump(file_get_contents("php://input"));
// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el parámetro usuario_json en formato JSON
    $usuario_json = json_decode(file_get_contents("php://input"), true);

    // Agrega un var_dump para depurar
    //var_dump($usuario_json['correo']);

    if ($usuario_json !== null && isset($usuario_json['correo']) && isset($usuario_json['clave'])) {
        // Incluir la clase Usuario.php y configurar la conexión a la base de datos
        require_once('./clases/Usuario.php');

        // Llamar al método TraerUno como un método de clase
        $usuario_json = json_encode([$usuario_json['correo'],$usuario_json['clave']]);
        $resultado = Usuario::TraerUno($usuario_json);

        if ($resultado !== null) {
            // Si se encontró el usuario, configurar la respuesta como éxito
            $respuesta['exito'] = true;
            $respuesta['mensaje'] = 'Usuario encontrado.';
        } else {
            // Si no se encontró el usuario, configurar la respuesta como error
            $respuesta['exito'] = false;
            $respuesta['mensaje'] = 'Usuario no encontrado.';
        }

        // Devolver la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    } else {
        // Si el parámetro usuario_json no es válido, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Parámetros incorrectos o faltantes.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
// require_once('./clases/Usuario.php');

//   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     //     // Verificar si se recibió el parámetro usuario_json en formato JSON
//     $usuario_json = json_decode(file_get_contents("php://input"), true);

//     if ($usuario_json !== null && isset($usuario_json['correo']) && isset($usuario_json['clave'])) {

//         $usuario_json = json_encode([$usuario_json['correo'],$usuario_json['clave']]);
//         $usuario = Usuario::TraerUno($usuario_json);

//         echo $usuario->nombre;
//     }
//   }