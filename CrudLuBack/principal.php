<?php
session_start();

// Verificar si las variables de sesión existen y son válidas
if (isset($_SESSION['legajo'], $_SESSION['nombre'], $_SESSION['apellido'], $_SESSION['foto'])) {
    $legajo = $_SESSION['legajo'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $foto = $_SESSION['foto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>
    <h1>Legajo: <?php echo $legajo; ?></h1>
    <h2>Nombre y Apellido: <?php echo $nombre . ' ' . $apellido; ?></h2>
    <img src="<?php echo $foto; ?>" alt="Foto del alumno">

    <h2>Listado completo de alumnos:</h2>
    <table>
        <thead>
            <tr>
                <th>Legajo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Aquí debes leer y mostrar el contenido de ./archivos/alumnos_foto.txt
            // Puedes utilizar la función file() para leer el archivo y luego recorrerlo para mostrarlo en la tabla
            // Ten en cuenta que esto es solo un ejemplo básico y deberás adaptarlo a tus necesidades específicas
            $archivo_alumnos = './archivos/alumnos_foto.txt';
            if (file_exists($archivo_alumnos)) {
                $lineas = file($archivo_alumnos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lineas as $linea) {
                    list($legajo, $nombre, $apellido, $foto) = explode(' - ', $linea);
                    echo '<tr>';
                    echo '<td>' . $legajo . '</td>';
                    echo '<td>' . $nombre . '</td>';
                    echo '<td>' . $apellido . '</td>';
                    echo '<td>' . $foto . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
} else {
    // Si las variables de sesión no son válidas, redirige a nexo_poo_foto.php
    header('Location: ./nexo_poo_foto.php');
}
?>
