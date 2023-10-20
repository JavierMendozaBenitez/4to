<?php
require_once('AutoBD.php');
use MendozaJavier\AutoBD;

// Verificar si se recibió una solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mostrar la información de todos los autos borrados en una tabla (HTML)
    // y sus respectivas imágenes si están disponibles
    mostrarAutosBorrados();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió un parámetro auto_json por POST
    if (isset($_POST['auto_json'])) {
        $autoData = json_decode($_POST['auto_json'], true);

        // Crear la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

        // Crear una instancia de la clase AutoBD con los datos recibidos
        $auto = new AutoBD($autoData['patente'], $autoData['marca'], $autoData['color'], $autoData['precio'], $autoData['pathFoto']);
        //var_dump($auto->guardarEnArchivo());
        //var_dump($auto);
        // Invocar el método eliminar para borrar el auto de la base de datos
        $exito = AutoBD::eliminar($conexion, $autoData['patente']); // Modificación aquí
        var_dump($exito);
        $auto->guardarEnArchivo();
        // if ($exito) {
        //     // Invocar el método guardarEnArchivo para guardar la información del auto en un archivo
        //     $auto->guardarEnArchivo();
        //     var_dump($auto->guardarEnArchivo());
        // }

        $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Auto borrado correctamente' : 'Error al borrar el auto'];

        header('Content-Type: application/json');
        echo json_encode($respuesta);
    } else {
        // Si no se recibió el parámetro auto_json por POST, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Falta el parámetro auto_json.']);
    }
} else {
    // Si la solicitud no es GET ni POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}

function mostrarAutosBorrados() {
    $archivo = '../archivos/autosbd_borrados.txt';

    if (file_exists($archivo)) {
        // Leer el contenido del archivo
        $contenido = file_get_contents($archivo);

        // Divide el contenido en líneas
        $lineas = explode("\n", $contenido);

        // Inicializa un array para almacenar los datos de los autos borrados
        $autosBorrados = [];

        // Variables temporales para almacenar los datos de un auto
        $patente = null;
        $marca = null;
        $color = null;
        $precio = null;
        $foto = null;

        // Recorre las líneas para extraer los datos
        foreach ($lineas as $linea) {
            // Busca líneas que contengan datos relevantes (Patente, Marca, Color, Precio, Nueva ubicación de la foto)
            if (strpos($linea, "Patente:") !== false) {
                $patente = trim(str_replace("Patente:", "", $linea));
            } elseif (strpos($linea, "Marca:") !== false) {
                $marca = trim(str_replace("Marca:", "", $linea));
            } elseif (strpos($linea, "Color:") !== false) {
                $color = trim(str_replace("Color:", "", $linea));
            } elseif (strpos($linea, "Precio:") !== false) {
                $precio = trim(str_replace("Precio:", "", $linea));
            } elseif (strpos($linea, "Nueva ubicación de la foto:") !== false) {
                $foto = trim(str_replace("Nueva ubicación de la foto:", "", $linea));

                // Cuando se completa la información de un auto, agrégalo al array
                if ($patente !== null && $marca !== null && $color !== null && $precio !== null && $foto !== null) {
                    $autosBorrados[] = [
                        'patente' => $patente,
                        'marca' => $marca,
                        'color' => $color,
                        'precio' => $precio,
                        'pathFoto' => $foto
                    ];

                    // Reinicia las variables temporales
                    $patente = null;
                    $marca = null;
                    $color = null;
                    $precio = null;
                    $foto = null;
                }
            }
        }

        // Genera una tabla HTML para mostrar los autos borrados y sus imágenes si están disponibles
        echo '<html>';
        echo '<head>';
        echo '<style>';
        echo 'table { border-collapse: collapse; width: 100%; }';
        echo 'th, td { border: 1px solid black; padding: 8px; text-align: center; }';
        echo 'img { max-width: 100px; max-height: 100px; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        echo '<table>';
        echo '<tr>';
        echo '<th>Patente</th>';
        echo '<th>Marca</th>';
        echo '<th>Color</th>';
        echo '<th>Precio</th>';
        echo '<th>Foto</th>';
        echo '</tr>';

        foreach ($autosBorrados as $auto) {
            echo '<tr>';
            echo '<td>' . $auto['patente'] . '</td>';
            echo '<td>' . $auto['marca'] . '</td>';
            echo '<td>' . $auto['color'] . '</td>';
            echo '<td>' . $auto['precio'] . '</td>';
            echo '<td>';

            // var_dump($auto['pathFoto']);
            // var_dump(file_exists($auto['pathFoto']));
            if (isset($auto['pathFoto']) && file_exists($auto['pathFoto'])) {
                echo '<img src="' . $auto['pathFoto'] . '" alt="Foto">';
            } else {
                echo 'Sin imagen';
            }

            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</body>';
        echo '</html>';
    } else {
        echo 'No hay autos borrados.';
    }
}

