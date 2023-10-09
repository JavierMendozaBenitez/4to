<?php
require_once("./backend/clases/Usuario.php");
$opcion = $_POST["opcion"];
$usuario = new Usuario(1,"Juan", "Juan@admin.com", "2asd2", 1, "vendedor");
switch($opcion)
{
    case "alta":
        $mensaje = json_decode($usuario->GuardarEnArchivo());
        echo $mensaje->exito . " - " . $mensaje->mensaje;
        break;
    case "baja":
        $id = $_POST["id"];
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
        // $ID = $_POST["id"];
        // $mensaje = json_decode($usuario->Eliminar("id"));
        // echo $mensaje->exito . " - " . $mensaje->mensaje;
        break;    
    case "listar":
        $usuarios = $usuario->TraerTodosJSON();
        foreach($usuarios as $usuario)
        {
            echo $usuario->id . " - " . $usuario->nombre . " - " . $usuario->correo . "\n";
        }
        break;

    case "mostrar":
        $usuarios = Usuario::TraerTodos();
        foreach($usuarios as $usaurio_db)
        {
            echo $usaurio_db->id . " - " . $usaurio_db->nombre . " - " . $usaurio_db->perfil . "\n";
        }
        break;
    case "TraerUno_db":
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];

        $params = array();
        $params["correo"] = $correo;
        $params["clave"] = $clave;
        
        $usuario_nuevo = Usuario::TraerUno($params);
        echo $usuario_nuevo->id . " - " . $usuario_nuevo->nombre . " - " . $usuario_nuevo->perfil;
        break;
    case "login":
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];

        $params = array(
            $correo,
            $clave
        );

        $params_json = json_encode($params);

        $usuario_encontrado = Usuario::TraerUno($params_json);

        if ($usuario_encontrado !== null) {
            // Inicio de sesión exitoso
            echo "Inicio de sesión exitoso para: " . $usuario_encontrado->nombre;
        } else {
            // Inicio de sesión fallido
            echo "Inicio de sesión fallido. Verifique sus credenciales.";
        }
        break;
        case "modificacion":
            $retorno = $usuario->Modificar();
            if($retorno)
            {
                echo "Se modificó correctamente.";
            }
            else
            {
                echo "No se modifico.";
            }
        break;
        
}
?>