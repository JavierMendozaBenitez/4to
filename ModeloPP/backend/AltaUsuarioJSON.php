<?php
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los campos necesarios (correo, clave y nombre)
    if (isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['nombre'])) {
        // Incluir la clase Usuario.php y configurar la conexión a la base de datos
        require_once('./clases/Usuario.php');
        
        // Crear una instancia de Usuario
        // $nuevoUsuario = new Usuario();
        
        // // Establecer los valores desde los datos recibidos por POST
        // $nuevoUsuario->correo = $_POST['correo'];
        // $nuevoUsuario->clave = $_POST['clave'];
        // $nuevoUsuario->nombre = $_POST['nombre'];

        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $nuevoUsuario = new Usuario(4,$nombre,$correo,$clave,3,"oo");

        // Invocar al método GuardarEnArchivo
        $resultado = $nuevoUsuario->GuardarEnArchivo();
        
        // Devolver una respuesta JSON con el resultado
        header('Content-Type: application/json');
        echo $resultado;
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
