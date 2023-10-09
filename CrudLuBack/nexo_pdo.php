<?php
session_start();
require_once 'Mendoza/Alumno_pdo.php';

use Mendoza\Alumno_pdo;

$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";
//$accion = $_POST["accion"];
//Crear una instancia de Alumno_pdo pasando la conexión PDO como argumento
        $db = new PDO("mysql:host=localhost;dbname=alumno_pdo", "root", "");
        $alumno_pdo = new Alumno_pdo($db);

switch ($accion) {
    // case "conexion":

    //     try
    //     {
    //         // Crear una instancia de Alumno_pdo pasando la conexión PDO como argumento
    //         $db = new PDO("mysql:host=localhost;dbname=alumno_pdo", "root", "");
    //         $alumno_pdo = new Alumno_pdo($db);    
    //         echo "se conecto <br>";

    //     }catch(PDOException $exc)
    //     {
    //         echo $exc->getMessage() . "<br>";
    //     }
     
    // break;
    case "agregar":
        // Obtener los datos del formulario
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $foto = isset($_FILES["foto"]["tmp_name"]) ? $_FILES["foto"]["tmp_name"] : "";

        //$alumno_pdo = new Alumno_pdo($legajo, $nombre, $apellido, $foto);

        if ($alumno_pdo->agregar_bd($legajo, $apellido, $nombre, $foto)) {
            echo "El alumno se ha agregado correctamente.";
        } else {
            echo "No se pudo agregar el alumno.";
        }
        break;

    case "listar":
        $alumnos = $alumno_pdo->listar_bd();
        // Resto del código para mostrar la lista de alumnos
        break;

    case "obtener":
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $alumno = $alumno_pdo->obtener_bd($id);
        // Resto del código para mostrar los detalles del alumno
        break;

    case "modificar":
        // Obtener los datos del formulario
        $id = isset($_POST["id"]) ? $_POST["id"] : "";
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $foto = isset($_FILES["foto"]["tmp_name"]) ? $_FILES["foto"]["tmp_name"] : "";

        if ($alumno_pdo->modificar_bd($id, $legajo, $apellido, $nombre, $foto)) {
            echo "El alumno se ha modificado correctamente.";
        } else {
            echo "No se pudo modificar el alumno.";
        }
        break;

    case "borrar":
        $id = isset($_POST["id"]) ? $_POST["id"] : "";

        if ($alumno_pdo->borrar_bd($id)) {
            echo "El alumno se ha borrado correctamente.";
        } else {
            echo "No se pudo borrar el alumno.";
        }
        break;

        case "redirigir":
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
        
            $alumno = $alumno_pdo->obtener_bd($id);
    
            if ($alumno) {
                // Crear variables de sesión
                $_SESSION['legajo'] = $alumno['legajo'];
                $_SESSION['nombre'] = $alumno['nombre'];
                $_SESSION['apellido'] = $alumno['apellido'];
                $_SESSION['foto'] = $alumno['foto'];
                
                header("Location: ./principal.php"); // Redirigir a principal.php
                exit();
            } else {
                echo "El alumno con ID '$id' no se encuentra en el listado.";
            }
            break;
    
        default:
            echo "<h2>Acción no válida.</h2><br/>";
            break;
    }
    ?>
    
       
