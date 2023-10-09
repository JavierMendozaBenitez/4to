<?php
// Incluir la clase Empleado.php y configurar la conexión a la base de datos
require_once('./clases/Empleado.php');

// Verificar si se recibió el parámetro 'id' por POST
if (isset($_POST['id'])) {
    // // Obtener el ID del empleado a eliminar
    // $idEmpleado = intval($_POST['id']);
    
    // // Crear una instancia de Empleado
    // $empleado = new Empleado();
    
    // // Intentar eliminar el empleado utilizando el método Eliminar
    // $exito = $empleado->Eliminar($idEmpleado);
    $idEmpleado = $_POST["id"];
    if(Empleado::Eliminar($idEmpleado))
    {
        $respuesta["exito"] = true;
        $respuesta["mensaje"] = "Se eliminó correctamente el empleado.";
    }
    else
    {
        $respuesta["exito"] = false;
        $respuesta["mensaje"] = "No se eliminó correctamente el empleado.";
    }

    // // Preparar la respuesta JSON
    // $respuesta = [
    //     'exito' => $exito,
    //     'mensaje' => $exito ? 'Empleado eliminado correctamente.' : 'Error al eliminar el empleado.'
    // ];
} else {
    // Si no se recibieron los parámetros requeridos, devolver un error
    $respuesta = [
        'exito' => false,
        'mensaje' => 'Parámetros incorrectos o faltantes.'
    ];
}

// Devolver la respuesta JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
?>
