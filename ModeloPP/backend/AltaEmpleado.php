<?php
// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron todos los valores necesarios
    if (
        isset($_POST['nombre']) &&
        isset($_POST['correo']) &&
        isset($_POST['clave']) &&
        isset($_POST['id_perfil']) &&
        isset($_POST['sueldo']) &&
        isset($_FILES['foto'])
    ) {
        // Incluir la clase Empleado.php y configurar la conexión a la base de datos
        require_once('./clases/Empleado.php');
        
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $nombre = $_POST["nombre"];
        $id_perfil = (int) $_POST["id_perfil"];
        $foto = $_FILES["foto"];
        $sueldo = (double)$_POST["sueldo"];

        $empleado = new Empleado(1, $nombre, $correo, $clave, $id_perfil, "cantante", $foto, $sueldo);

        // // // Crear una instancia de Empleado
        //  $empleado = new Empleado();
        
        // // Establecer los valores desde los datos recibidos
        // $empleado->nombre = $_POST['nombre'];
        // $empleado->correo = $_POST['correo'];
        // $empleado->clave = $_POST['clave'];
        // $empleado->id_perfil = $_POST['id_perfil'];
        // $empleado->sueldo = $_POST['sueldo'];

        // //Procesar la imagen recibida
        // $foto = $_FILES['foto'];

        // // Agregar un var_dump para depuración
        // var_dump($foto);

        // Verificar si se recibió una imagen válida
        if ($foto && $foto['error'] === 0) {
            // Generar un nombre único para la imagen
            //$nombreImagen = $empleado->nombre . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
            
            // Ruta donde se guardará la imagen
            //$rutaImagen = './empleados/fotos/' . $nombreImagen;


            // Crear una instancia de Empleado
        


            // // // Mover la imagen al directorio destino
            // if (move_uploaded_file($foto['tmp_name'], $rutaImagen)) {
            //     $empleado->foto = $rutaImagen;
            //  } else {
            //     // Si no se pudo mover la imagen, devolver un error
            //     http_response_code(500); // Internal Server Error
            //     echo json_encode(['exito' => false, 'mensaje' => 'Error al cargar la imagen']);
            //     exit;
            // }
            $exito = $empleado->Agregar();
        } else {
            // Si no se recibió una imagen válida, devolver un error
            http_response_code(400); // Bad Request
            echo json_encode(['exito' => false, 'mensaje' => 'Imagen no válida']);
            exit;
        }

        // Intentar agregar el empleado utilizando el método Agregar
        //$exito = $empleado->Agregar();

        // Preparar la respuesta JSON
        $respuesta = [
            'exito' => $exito,
            'mensaje' => $exito ? 'Empleado registrado correctamente.' : 'Error al registrar el empleado.'
        ];
    } else {
        // Si faltan parámetros requeridos, devolver un error
        http_response_code(400); // Bad Request
        $respuesta = ['exito' => false, 'mensaje' => 'Parámetros incorrectos o faltantes.'];
    }
} else {
    // Si la solicitud no es POST, devolver un error
    http_response_code(405); // Method Not Allowed
    $respuesta = ['exito' => false, 'mensaje' => 'Método no permitido.'];
}

// Devolver la respuesta JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
?>
