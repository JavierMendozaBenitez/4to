<?php
require_once './Alumno.php';

use Mendoza\Alumno;

$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";

switch ($accion) {
    case "agregar":
        file_put_contents('log.txt', print_r($_POST, true)); // Esto guardará los datos en un archivo llamado log.txt para su revisión
        // $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        // $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        // $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        // $foto = "";
        $datosJSON = file_get_contents('php://input');
        $datos = json_decode($datosJSON);

        // Ahora puedes acceder a los datos como propiedades del objeto $datos
        $legajo = isset($datos->legajo) ? $datos->legajo : "";
        $nombre = isset($datos->nombre) ? $datos->nombre : "";
        $apellido = isset($datos->apellido) ? $datos->apellido : "";
        $foto = isset($datos->foto) ? $datos->foto : "";
        file_put_contents('log2.txt', print_r($_POST, true)); // Esto guardará los datos en un archivo llamado log.txt para su revisión

        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
            $fotoNombre = $_FILES["foto"]["name"];
            $foto = "fotos/{$fotoNombre}";
            move_uploaded_file($_FILES["foto"]["tmp_name"], "../$foto");
        } else {
            $foto = "fotos/{$legajo}.jpg";
        }
        
        $alumno = new Alumno($legajo, $nombre, $apellido, $foto);
        if ($alumno->guardar() && $legajo !== '' || $nombre !== '' || $apellido !== '') {
            $response = array(
                'status' => 'success',
                'message' => 'El alumno se ha agregado correctamente.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'No se pudo agregar el alumno.'
            );
        }
        
        echo json_encode($response);
        break;

    case "listar":
        $alumnos = Alumno::listar();
        $alumnoData = array();
        
        foreach ($alumnos as $alumno) {
            $alumnoData[] = array(
                'legajo' => $alumno->getLegajo(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApellido(),
                'foto' => $alumno->getFoto()
            );
        }

        echo json_encode($alumnoData);
        break;

    case "verificar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        $alumno = Alumno::verificar($legajo);
        if ($alumno) {
            $alumnoData = array(
                'legajo' => $alumno->getLegajo(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApellido(),
                'foto' => $alumno->getFoto()
            );
            echo json_encode($alumnoData);
        } else {
            $response = array(
                'status' => 'error',
                'message' => "El alumno con legajo '$legajo' no se encuentra en el listado."
            );
            echo json_encode($response);
        }
        break;

    case "modificar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";

        $alumno = new Alumno($legajo, $nombre, $apellido);
        if ($alumno->modificar()) {
            $response = array(
                'status' => 'success',
                'message' => "El alumno con legajo '$legajo' se ha modificado."
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => "El alumno con legajo '$legajo' no se encuentra en el listado o no se pudo modificar."
            );
        }
        
        echo json_encode($response);
        break;

    case "borrar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        if (Alumno::borrar($legajo)) {
            $response = array(
                'status' => 'success',
                'message' => "El alumno con legajo '$legajo' se ha borrado."
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => "El alumno con legajo '$legajo' no se encuentra en el listado o no se pudo borrar."
            );
        }
        
        echo json_encode($response);
        break;

    case "obtener":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
    
        $alumno = Alumno::obtenerPorLegajo($legajo);
        if ($alumno) {
            $alumnoData = array(
                'legajo' => $alumno->getLegajo(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApellido(),
                'foto' => $alumno->getFoto()
            );
            echo json_encode($alumnoData);
        } else {
            $response = array(
                'status' => 'error',
                'message' => "El alumno con legajo '$legajo' no se encuentra en el listado."
            );
            echo json_encode($response);
        }
        break;

    case "redirigir":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        $alumno = Alumno::verificar($legajo);
        if ($alumno) {
            $response = array(
                'status' => 'success',
                'message' => 'Redirigiendo a la página principal...'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => "El alumno con legajo '$legajo' no se encuentra en el listado."
            );
            echo json_encode($response);
        }
        break;
    case "listar_objetos":
        $alumnos = Alumno::listarObjetos();
        $alumnoData = array();
        
        foreach ($alumnos as $alumno) {
            $alumnoData[] = array(
                'legajo' => $alumno->getLegajo(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApellido(),
                'foto' => $alumno->getFoto()
            );
        }

        echo json_encode($alumnoData);
        break;

    // case "listar_tabla":
    //     $alumnos = Alumno::listarObjetos();

    //     // Generar la tabla HTML
    //     $tablaHTML = '<table border="1">
    //                     <tr>
    //                         <th>LEGAJO</th>
    //                         <th>APELLIDO</th>
    //                         <th>NOMBRE</th>
    //                         <th>FOTO</th>
    //                     </tr>';

    //     foreach ($alumnos as $alumno) {
    //         $tablaHTML .= '<tr>';
    //         $tablaHTML .= '<td>' . $alumno->getLegajo() . '</td>';
    //         $tablaHTML .= '<td>' . $alumno->getApellido() . '</td>';
    //         $tablaHTML .= '<td>' . $alumno->getNombre() . '</td>';
    //         $tablaHTML .= '<td><img src="' . $alumno->getFoto() . '" alt="Foto del alumno"></td>';
    //         $tablaHTML .= '</tr>';
    //     }

    //     $tablaHTML .= '</table>';

    //     echo $tablaHTML;
    //         break;
    case "listar_tabla":
        $tabla = Alumno::listarTabla();
        echo $tabla;
        break;    
    default:
        $response = array(
            'status' => 'error',
            'message' => 'Acción no válida.'
        );
        echo json_encode($response);
        break;
}
?>
