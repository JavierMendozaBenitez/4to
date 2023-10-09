<?php
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el valor usuario_json en el POST
    if (isset($_POST['usuario_json'])) {
        // Incluir la clase Usuario.php y configurar la conexión a la base de datos
        require_once('./clases/Usuario.php');
        
        // Decodificar el JSON recibido en usuario_json
        $datosUsuario = json_decode($_POST['usuario_json'], true);

        // Verificar si existe y no está vacío el valor de 'id' en el JSON
        if (isset($datosUsuario['id']) && !empty($datosUsuario['id'])) {
            // Crear una instancia de Usuario
            $id = $datosUsuario['id'];
            $nombre = $datosUsuario['nombre'];
            $correo = $datosUsuario['correo'];
            $clave = $datosUsuario['clave'];
            $id_perfil = $datosUsuario['id_perfil'];

            $usuario = new Usuario($id, $nombre, $correo, $clave, $id_perfil, "algo");

            $exito = $usuario->Modificar();
            
            // Preparar la respuesta JSON
            $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Usuario modificado correctamente' : 'Error al modificar el usuario'];
            
            // Devolver la respuesta JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        }else {
        // Si no se recibió usuario_json, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'ID erroneo.']);
        }
    } else {
        // Si no se recibió usuario_json, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Falta el parámetro usuario_json en POST.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
