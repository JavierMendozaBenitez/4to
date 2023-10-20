<?php

require_once('AutoBD.php'); // Asegúrate de incluir la clase AutoBD
use MendozaJavier\AutoBD;


// Crear la conexión a la base de datos
$conexion = new PDO("mysql:host=localhost;dbname=garage_bd", "root", "");

// Verificar si se recibió el parámetro 'tabla' con el valor 'mostrar'
if (isset($_GET['tabla']) && $_GET['tabla'] === 'mostrar') {
    // Invocar el método traer para obtener la lista de autos
    $autos = AutoBD::traer($conexion);

    // Mostrar los datos en una tabla HTML con imagen si está disponible
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Listado de Autos</title>
    </head>
    <body>
        <h1>Listado de Autos</h1>
        <table>
            <thead>
                <tr>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>";
    
            foreach ($autos as $auto) {
                echo "<tr>
                        <td>{$auto->patente}</td>
                        <td>{$auto->marca}</td>
                        <td>{$auto->color}</td>
                        <td>{$auto->precio}</td>";
            
                        $pathFoto = $auto->getPathFoto();
                if ($pathFoto !== null) {
                    echo "<td><img src='../autos/imagenes/{$pathFoto}' alt='Foto del auto' width='100' height='75'></td>";
                } else {
                    echo "<td>Sin foto</td>";
                }
            
                echo "</tr>";
            }
    
    echo "</tbody>
        </table>
    </body>
    </html>";
} else {
    // Si no se recibe el parámetro 'tabla' o no tiene el valor 'mostrar', retornar JSON
    $autos = AutoBD::traer($conexion);
    header('Content-Type: application/json');
    echo json_encode($autos);
}