<?php

require_once('AutoBD.php');
use MendozaJavier\AutoBD;

// Verificar si se recibió una solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mostrar la información de todos los autos modificados en una tabla (HTML)
    // y sus respectivas imágenes si están disponibles
    mostrarAutosModificados();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió un parámetro auto_json por POST
    if (isset($_POST['auto_json']) && isset($_FILES['foto'])) {
        $autoData = json_decode($_POST['auto_json'], true);
        $foto = $_FILES['foto'];

        // Crear la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

        // Crear una instancia de la clase AutoBD con los datos recibidos
        $auto = new AutoBD($autoData['patente'], $autoData['marca'], $autoData['color'], $autoData['precio'], $foto['name']);

        // Invocar el método modificar para actualizar el auto en la base de datos
        $exito = $auto->modificar($conexion);

        if ($exito) {
            // Nuevo nombre de la foto
            $nombreFoto = $autoData['patente'] . '.modificado.' . date('His') . '.jpg';
            
            // Actualizar el nombre de la foto en la base de datos
            $sql = "UPDATE autos SET foto = :nombreFoto WHERE patente = :patente";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombreFoto', $nombreFoto);
            $stmt->bindParam(':patente', $autoData['patente']);
            $stmt->execute();

            // Mover la foto original al subdirectorio "./autosModificados/"
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $ubicacionNuevaFoto = '../autosModificados/' . $nombreFoto;
            move_uploaded_file($foto['tmp_name'], $ubicacionNuevaFoto);
        }

        $respuesta = ['exito' => $exito, 'mensaje' => $exito ? 'Auto modificado correctamente' : 'Error al modificar el auto'];

        header('Content-Type: application/json');
        echo json_encode($respuesta);
    } else {
        // Si no se recibió el parámetro auto_json por POST, devolver un error
        http_response_code(400); // Bad Request
        echo json_encode(['exito' => false, 'mensaje' => 'Faltan datos obligatorios.']);
    }
} else {
    // Si la solicitud no es GET ni POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}

function mostrarAutosModificados() {
    // Directorio de las fotos modificadas
    $directorio = '../autosModificados/';

    // Obtener la lista de archivos en el directorio
    $archivos = scandir($directorio);

    // Iniciar tabla HTML
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

    // Iterar sobre los archivos en el directorio
    foreach ($archivos as $archivo) {
        // Ignorar los directorios "." y ".."
        if ($archivo != "." && $archivo != "..") {
            // Obtener la patente del nombre del archivo (hasta el primer punto)
            $patente = explode('.', $archivo)[0];

            // Consultar la base de datos para obtener la información del auto
            $conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");
            $consulta = $conexion->prepare("SELECT * FROM autos WHERE patente = :patente");
            $consulta->bindParam(':patente', $patente);
            $consulta->execute();
            $auto = $consulta->fetch(PDO::FETCH_ASSOC);

            // Mostrar la información en la tabla HTML
            echo '<tr>';
            echo '<td>' . $auto['patente'] . '</td>';
            echo '<td>' . $auto['marca'] . '</td>';
            echo '<td>' . $auto['color'] . '</td>';
            echo '<td>' . $auto['precio'] . '</td>';
            echo '<td><img src="' . $directorio . $archivo . '" alt="Foto"></td>';
            echo '</tr>';
        }
    }

    // Cerrar tabla HTML
    echo '</table>';
    echo '</body>';
    echo '</html>';
}
?>
