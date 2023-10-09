<?php
// Incluir la clase Usuario.php
require_once('./clases/Usuario.php');

$accion = $_POST["accion"];
$id = $_POST["id"];

switch($accion)
{
    case "borrar":
        if(Usuario::Eliminar($id))
        {
            $respuesta["exito"] = true;
            $respuesta["mensaje"] = "Se eliminó correctamente el usuario.";
            // $respuesta = [
            //     'exito' => $true,
            //     'mensaje' => $exito ? 'Usuario eliminado correctamente.' : 'Error al eliminar el ussuario.'];
        }
        else
        {
            $respuesta["exito"] = false;
            $respuesta["mensaje"] = "No se eliminó correctamente el usuario.";
        }
        //var_dump($array_retorno);
        echo json_encode($respuesta);
        break;
}

// // Agrega un var_dump para verificar el contenido recibido
// var_dump(file_get_contents("php://input"));
// // Agrega un var_dump para depurar
// var_dump($_POST['id']);

// Verificar si se recibió el parámetro 'id' por POST y el parámetro 'accion' con valor "borrar"
// if (isset($_POST['id']) && isset($_POST['accion']) && $_POST['accion'] === "borrar") {
//     // Obtener el ID del usuario a eliminar
//     $idUsuario = intval($_POST['id']);
    
//     // Crear una instancia de Usuario
//     $usuario = new Usuario();
    
//     // Intentar eliminar el usuario utilizando el método Eliminar
//     $exito = $usuario->Eliminar($idUsuario);
    
//     // Preparar la respuesta JSON
//     $respuesta = [
//         'exito' => $exito,
//         'mensaje' => $exito ? 'Usuario eliminado correctamente.' : 'Error al eliminar el usuario.'
//     ];
// } else {
//     // Si no se recibieron los parámetros requeridos, devolver un error
//     $respuesta = [
//         'exito' => false,
//         'mensaje' => 'Parámetros incorrectos o faltantes.'
//     ];
// }

// // Devolver la respuesta JSON
// header('Content-Type: application/json');
// echo json_encode($respuesta);
?>
