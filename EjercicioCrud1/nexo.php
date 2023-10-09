<!-- <?php
 $accion = isset($_POST["accion"]) ? $_POST["accion"] : "";
// $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
// $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
// $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

//$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
$apellido = isset($_REQUEST["apellido"]) ? $_REQUEST["apellido"] : "";
$legajo = isset($_REQUEST["legajo"]) ? $_REQUEST["legajo"] : "";

// Utilizamos un switch para manejar las acciones
switch ($accion) {
    case "agregar":
        // Abrir el archivo
        $archivo = './archivos/alumnos.txt';
        $ar = fopen($archivo, "a");

        // Verificar si el archivo se abrió correctamente
        if ($ar) {
            // Crear el registro en el formato requerido
            $registro = "$legajo - $apellido - $nombre";

            // Escribir el registro en el archivo
            $cant = fwrite($ar, "$registro\r\n");

            // Cerrar el archivo
            fclose($ar);

            // Verificar si se pudo escribir el registro
            if ($cant > 0) {
                echo "<h2>Alumno guardado correctamente.</h2><br/>";
            } else {
                echo "<h2>No se pudo guardar al alumno.</h2><br/>";
            }
        } else {
            echo "<h2>No se pudo abrir el archivo.</h2><br/>";
        }
        break;
    case "listar":
        // Abre el archivo para lectura
        $archivo = './archivos/alumnos.txt';
        $ar = fopen($archivo, "r");

        // Verifica si el archivo se abrió correctamente
        if ($ar) {
            // Muestra el contenido completo del archivo
            while (!feof($ar)) {
                $linea = fgets($ar);
                echo $linea . "<br/>";
            }

            // Cierra el archivo
            fclose($ar);
        } else {
            echo "<h2>No se pudo abrir el archivo.</h2><br/>";
        }
        break;
    case "verificar":
        $legajoVerificar = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        // Abre el archivo para lectura
        $archivo = './archivos/alumnos.txt';
        $ar = fopen($archivo, "r");

        // Verifica si el archivo se abrió correctamente
        if ($ar) {
        $alumnoEncontrado = false;

        // Busca el legajo en el archivo
        while (!feof($ar)) {
            $linea = fgets($ar);
            $datos = explode(" - ", $linea);

            // Compara el legajo con el legajo a verificar
            if (isset($datos[0]) && trim($datos[0]) == $legajoVerificar) {
                $alumnoEncontrado = true;
                break;
            }
        }
    
            // Cierra el archivo
            fclose($ar);

            // Muestra el resultado según si se encontró o no el alumno
            if ($alumnoEncontrado) {
                echo "El alumno con legajo '$legajoVerificar' se encuentra en el listado.";
            } else {
                echo "El alumno con legajo '$legajoVerificar' no se encuentra en el listado.";
            }
        } else {
            echo "<h2>No se pudo abrir el archivo.</h2><br/>";
        }
        break;
    case "modificar":
        $legajoModificar = isset($_POST["legajo"]) ? $_POST["legajo"] : "";
        $nombreNuevo = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellidoNuevo = isset($_POST["apellido"]) ? $_POST["apellido"] : "";

        // Abre el archivo para lectura
        $archivo = './archivos/alumnos.txt';
        $ar = fopen($archivo, "r");

        // Verifica si el archivo se abrió correctamente
        if ($ar) {
            $alumnoEncontrado = false;
            $lineas = [];

            // Busca el legajo en el archivo y modifica el registro si se encuentra
            while (!feof($ar)) {
                $linea = fgets($ar);
                $datos = explode(" - ", $linea);

                // Compara el legajo con el legajo a modificar
                if (isset($datos[0]) && trim($datos[0]) == $legajoModificar) {
                    $alumnoEncontrado = true;
                    $lineas[] = "$legajoModificar - $apellidoNuevo - $nombreNuevo\r\n";
                } else {
                    $lineas[] = $linea;
                }
            }

            // Cierra el archivo
            fclose($ar);
            
            // Si se encontró el alumno, escribe las líneas modificadas en el archivo
            if ($alumnoEncontrado) {
                $ar = fopen($archivo, "w");

                // Verifica si el archivo se abrió correctamente en modo escritura
                if ($ar) {
                    foreach ($lineas as $lineaModificada) {
                        fwrite($ar, $lineaModificada);
                    }
                    fclose($ar);
                    echo "El alumno con legajo '$legajoModificar' se ha modificado.";
                } else {
                    echo "<h2>No se pudo abrir el archivo en modo escritura.</h2><br/>";
                }
            } else {
                echo "El alumno con legajo '$legajoModificar' no se encuentra en el listado.";
            }
        } else {
            echo "<h2>No se pudo abrir el archivo en modo lectura.</h2><br/>";
        }
        break;
    case "borrar":
        $legajoBorrar = isset($_POST["legajo"]) ? $_POST["legajo"] : "";

        // Abre el archivo para lectura
        $archivo = './archivos/alumnos.txt';
        $ar = fopen($archivo, "r");

        // Verifica si el archivo se abrió correctamente
        if ($ar) {
            $alumnoEncontrado = false;
            $lineas = [];

            // Busca el legajo en el archivo y elimina el registro si se encuentra
            while (!feof($ar)) {
                $linea = fgets($ar);
                $datos = explode(" - ", $linea);

                // Compara el legajo con el legajo a borrar
                if (isset($datos[0]) && trim($datos[0]) == $legajoBorrar) {
                    $alumnoEncontrado = true;
                } else {
                    $lineas[] = $linea;
                }
            }

            // Cierra el archivo
            fclose($ar);

            // Si se encontró el alumno, elimina el archivo y crea uno nuevo con las líneas restantes
            if ($alumnoEncontrado) {
                unlink($archivo);

                $ar = fopen($archivo, "a");

                // Verifica si el archivo se abrió correctamente en modo escritura
                if ($ar) {
                    foreach ($lineas as $lineaModificada) {
                        fwrite($ar, $lineaModificada);
                    }
                    fclose($ar);
                    echo "El alumno con legajo '$legajoBorrar' se ha borrado.";
                } else {
                    echo "<h2>No se pudo abrir el archivo en modo escritura.</h2><br/>";
                }
            } else {
                echo "El alumno con legajo '$legajoBorrar' no se encuentra en el listado.";
            }
        } else {
            echo "<h2>No se pudo abrir el archivo en modo lectura.</h2><br/>";
        }
        break;
        
    default:
        echo "<h2>Acción no válida.</h2><br/>";
        break;
}
?> -->
