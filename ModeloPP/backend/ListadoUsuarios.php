<?php
// Incluir la clase Usuario.php y configurar la conexión a la base de datos
require_once('./clases/Usuario.php');

// Comprobar si se ha enviado una solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener la lista de todos los usuarios
    $usuarios = Usuario::TraerTodos();

    // Comprobar si se obtuvieron datos de usuarios
    if ($usuarios !== null) {
        // Crear la tabla HTML para mostrar los usuarios
        echo '<html><head><title>Listado de Usuarios</title></head><body>';
        echo '<h1>Listado de Usuarios</h1>';
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Perfil</th></tr>';
        
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario->id . '</td>';
            echo '<td>' . $usuario->nombre . '</td>';
            echo '<td>' . $usuario->correo . '</td>';
            echo '<td>' . $usuario->perfil . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        echo '</body></html>';
    } else {
        // Si no se obtuvieron datos de usuarios, mostrar un mensaje de error
        echo 'No se pudieron obtener los datos de los usuarios.';
    }
} else {
    // Si la solicitud no es GET, mostrar un mensaje de error
    echo 'Acceso no permitido.';
}
