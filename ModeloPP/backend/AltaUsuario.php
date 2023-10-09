<?php
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los campos necesarios (correo, clave, nombre y id_perfil)
    if (isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['nombre']) && isset($_POST['id_perfil'])) {
        // Incluir la clase Usuario.php y configurar la conexión a la base de datos
        require_once('./clases/Usuario.php');
        
        // Crear una instancia de Usuario
        // $nuevoUsuario = new Usuario();
        
        // // Establecer los valores desde los datos recibidos por POST
        // $nuevoUsuario->correo = $_POST['correo'];
        // $nuevoUsuario->clave = $_POST['clave'];
        // $nuevoUsuario->nombre = $_POST['nombre'];
        // $nuevoUsuario->id_perfil = $_POST['id_perfil'];
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $nombre = $_POST["nombre"];
        $id_perfil = $_POST["id_perfil"];

        $nuevoUsuario = new Usuario(1,$nombre,$correo,$clave,$id_perfil,"a");

        // Invocar al método Agregar
        $exito = $nuevoUsuario->Agregar();
        
        // Devolver una respuesta JSON con el resultado
        $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Usuario agregado correctamente' : 'Error al agregar el usuario'];
            
        // Devolver la respuesta JSON
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
