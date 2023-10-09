<?php
// Incluir la clase Empleado.php y configurar la conexión a la base de datos
require_once('./clases/Empleado.php');

// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el valor empleado_json en el POST
    if (isset($_POST['empleado_json'])) {
        // Decodificar el JSON recibido en empleado_json
        $datosEmpleado = json_decode($_POST['empleado_json'], true);
        
        if (isset($datosEmpleado['id']) && !empty($datosEmpleado['id'])) {
            // Crear una instancia de Usuario
            $id = $datosEmpleado['id'];
            $nombre = $datosEmpleado['nombre'];
            $correo = $datosEmpleado['correo'];
            $clave = $datosEmpleado['clave'];
            $id_perfil = $datosEmpleado['id_perfil'];
            $foto = isset($_FILES["foto"]) ? $_FILES["foto"] : array();
            $sueldo =$datosEmpleado["sueldo"];
            //$sueldo =(float)$_POST["sueldo"];

            $empleado = new Empleado($id,$nombre, $correo, $clave, $id_perfil, "algo", $foto, $sueldo);  
            //var_dump(($empleado));
            // Invocar al método Modificar
            $exito = $empleado->Modificar();
            //var_dump(($exito));

            // Preparar la respuesta JSON
            $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Empleado modificado correctamente' : 'Error al modificar el empleado'];

            // Devolver la respuesta JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);

        }    
        else 
        {
            // Si no se recibió usuario_json, devolver un error
            http_response_code(400); // Bad Request
            echo json_encode(['exito' => false, 'mensaje' => 'ID erroneo.']);
        }
    } else {
        // Si no se recibió empleado_json, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Falta el parámetro empleado_json en POST.']);
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
