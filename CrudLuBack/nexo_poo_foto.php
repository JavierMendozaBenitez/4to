<?php
session_start();
require_once 'Mendoza/Alumno.php';

use Mendoza\Alumno;

$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";

switch ($accion) {
    case "agregar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $foto = "";
        
        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
            // Obtener la extensión del archivo original
            $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $fotoNombreOriginal = $_FILES["foto"]["name"];
        
            // Obtener el número de legajo
            $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        
            // Construir el nuevo nombre del archivo
            $fotoNombreNuevo = "{$legajo}.{$extension}";
        
            // Ruta donde se encuentra la foto con el nombre original
            $rutaFotoOriginal = "./fotos/{$fotoNombreOriginal}";
        
            // Ruta donde se moverá la foto con el nuevo nombre
            $rutaFotoNueva = "./fotos/{$fotoNombreNuevo}";
        
            // Verificar si la foto original existe
            if (file_exists($rutaFotoOriginal)) {
                if (copy($rutaFotoOriginal, $rutaFotoNueva)) {
                    $foto = $rutaFotoNueva;
                } else {
                    // Si no se pudo copiar la imagen, dejar el campo foto vacío
                    $foto = "";
                }
                // Si no se proporcionó una imagen, dejar el campo foto vacío
                $alumno = new Alumno($legajo, $nombre, $apellido, $foto);
            
                // Realizar la modificación necesaria en el objeto Alumno
                // (por ejemplo, guardar en el archivo ./archivos/alumnos_foto.txt)
            
                if ($alumno->guardar()) {
                    echo "El alumno se ha agregado correctamente.";
                } else {
                    echo "No se pudo agregar el alumno.";
                }
            } else {
                echo "La foto original no existe.";
            }
        } else {
            // Si no se proporcionó una imagen, dejar el campo foto vacío
            $foto = "";
            $alumno = new Alumno($legajo, $nombre, $apellido, $foto);
        
            // Realizar la modificación necesaria en el objeto Alumno
            // (por ejemplo, guardar en el archivo ./archivos/alumnos_foto.txt)
        
            if ($alumno->guardar()) {
                echo "El alumno se ha agregado correctamente.";
            } else {
                echo "No se pudo agregar el alumno.";
            }
        }
        break;

        case "listar":
            $alumnos = Alumno::listar();
        
            require_once __DIR__ . '/vendor/autoload.php';
        
            // Crear una nueva instancia de mPDF
            $mpdf = new \Mpdf\Mpdf();
        
            // Establecer información del documento (título, encabezado, pie de página, etc.)
            $mpdf->SetTitle('Listado de Alumnos');
        
            // Establecer encabezado personalizado (nombre y número de página)
            $mpdf->SetHeader('Javier Mendoza||Página {PAGENO}');
        
            // Establecer pie de página (fecha actual centrada)
            $mpdf->SetFooter(date('d/m/Y'), 'C');
        
            // Construir el contenido del PDF
            $pdfContent = '<h1>Listado de Alumnos</h1>';
            $pdfContent .= '<table border="1">';
            $pdfContent .= '<tr><th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Foto</th></tr>';
        
            foreach ($alumnos as $alumno) {
                $legajo = $alumno->getLegajo();
                $nombre = $alumno->getNombre();
                $apellido = $alumno->getApellido();
                $foto = $alumno->getFoto();
        
                $pdfContent .= "<tr>
                <td>$legajo</td>
                <td>$apellido</td>
                <td>$nombre</td>
                <td><img src='./fotos/$foto' width='50' height='50'></td></tr>";
            }
        
            $pdfContent .= '</table>';
        
            // Agregar el contenido al PDF
            $mpdf->WriteHTML($pdfContent);
        
            // Establecer la contraseña de acceso
            $password = '1414'; // Reemplaza 'tuclave' con la contraseña deseada
            $mpdf->SetProtection(array(), $password);
        
            // Salida del PDF (descargar o mostrar en el navegador)
            $mpdf->Output();
            exit();
        
            break;
            

    case "verificar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        $alumno = Alumno::verificar($legajo);
        if ($alumno) {
            echo "Legajo: {$alumno->getLegajo()}, Nombre: {$alumno->getNombre()}, Apellido: {$alumno->getApellido()}";
            echo "<img src='{$alumno->getFoto()}' alt='Foto de {$alumno->getNombre()} {$alumno->getApellido()}'>";
        } else {
            echo "El alumno con legajo '$legajo' no se encuentra en el listado.";
        }
        break;

    case "modificar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";

        $alumno = new Alumno($legajo, $nombre, $apellido);
        if ($alumno->modificar()) {
            echo "El alumno con legajo '$legajo' se ha modificado.";
        } else {
            echo "El alumno con legajo '$legajo' no se encuentra en el listado o no se pudo modificar.";
        }
        break;

    case "borrar":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        if (Alumno::borrar($legajo)) {
            echo "El alumno con legajo '$legajo' se ha borrado.";
        } else {
            echo "El alumno con legajo '$legajo' no se encuentra en el listado o no se pudo borrar.";
        }
        break;
    case "obtener":
        $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
    
        $alumno = Alumno::obtenerPorLegajo($legajo);
        if ($alumno) {
            var_dump($alumno); // Mostrar información del alumno
        } else {
            echo "El alumno con legajo '$legajo' no se encuentra en el listado.";
        }
        break;

        case "redirigir":
            $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
    
            $alumno = Alumno::verificar($legajo);
            if ($alumno) {
                // Crear variables de sesión
                $_SESSION['legajo'] = $alumno->getLegajo();
                $_SESSION['nombre'] = $alumno->getNombre();
                $_SESSION['apellido'] = $alumno->getApellido();
                $_SESSION['foto'] = $alumno->getFoto();
                
                header("Location: ./principal.php"); // Redirigir a principal.php
                exit();
            } else {
                echo "El alumno con legajo '$legajo' no se encuentra en el listado.";
            }
            
            break;

    
        default:
            echo "<h2>Acción no válida.</h2><br/>";
            break;
}
?>
