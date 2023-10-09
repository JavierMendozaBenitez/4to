<?php
// Incluir la clase Empleado.php y configurar la conexión a la base de datos
require_once('./clases/Empleado.php');

// Obtener la lista de empleados utilizando el método TraerTodos
$empleados = Empleado::TraerTodos();

// HTML para mostrar la lista de empleados en una tabla
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>
    <h1>Listado de Empleados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Perfil</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado) : ?>
                <tr>
                    <td><?php echo $empleado->id; ?></td>
                    <td><?php echo $empleado->nombre; ?></td>
                    <td><?php echo $empleado->correo; ?></td>
                    <td><?php echo $empleado->perfil; ?></td>
                    <!-- <td><img src="<?php echo $empleado->foto; ?>" alt="Foto"></td> -->
                    <td>
                        <?php foreach ($empleado->foto as $foto) : ?>
                            <img src="<?php echo $foto; ?>" alt="Foto">
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
