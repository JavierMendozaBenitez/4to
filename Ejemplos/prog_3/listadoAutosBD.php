<?php   
require_once("./clases/autoBD.php");
use VasquezYober\AutoBD;
$mostrar = isset($_GET["tabla"]) ? $_GET["tabla"] : "sin tabla"; 

$neumaticos = AutoBD::Traer();

if ($mostrar == "mostrar") {

    echo "<style>
    table {
      border-collapse: collapse; 
      width: 80%; 
      padding: 10px;
      margin: 50px auto;
      text-align: center;
    }
    td, th {
      border: 1px solid black;
      padding: 8px; 
      text-align: center;
    }
    </style>";

    echo "<table border='1'>
        <tr>
            <th> patente</th>
            <th> marca</th>
            <th> color</th>
            <th> precio</th>
            <th> foto</th>
            <th> acciones</th>
        </tr>";

        foreach ($neumaticos as $neumatico) {
            $pathFoto = $neumatico->PathFoto() ?? ''; // Verifica si PathFoto() devuelve un valor válido
        
            echo "
            <tr>
                <td> {$neumatico->Patente()}</td>
                <td> {$neumatico->Marca()}</td>
                <td> {$neumatico->Color()}</td>
                <td> {$neumatico->Precio()}</td>
                <td>";
        
                if ($pathFoto === 'sin foto') {
                    echo "<img src='./prog_3/fotosPruebas/nofoto.png' alt='nofoto.png' width='100px' height='100px'/>";
                } else {
                    echo "<img src='./prog_3/autos/imagenes/{$pathFoto}' alt='{$pathFoto}' width='100px' height='100px'/>";
                }
            echo "</td>
                <td>
                    <button type='button' class='btn btn-info' id='btnModificar' data-obj='" . $neumatico->ToJSON() . "' name='btnModificar'>
                        modificar<span class='bi bi-pencil'></span>
                    </button>
                    <button type='button' class='btn btn-danger' id='btnEliminar' data-obj='" . $neumatico->ToJSON() . "' name='btnEliminar'>
                        <span class='bi bi-x-circle'>eliminar</span>
                    </button>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<pre>";
    print_r($neumaticos);
    echo "</pre>";
}
?>