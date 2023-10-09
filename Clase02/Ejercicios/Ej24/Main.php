<?php


require_once './Operario.php';
require_once './Fabrica.php';

$operario1 = new Operario("Juan", "Perez", "12345", 2000);
$operario2 = new Operario("Maria", "Gonzalez", "67890", 1800);

$fabrica = new Fabrica();

// Agregar operarios a la fábrica
$fabrica->Add($operario1);
$fabrica->Add($operario2);

// Mostrar información de la fábrica
echo "Información de la fábrica:<br>";
echo $fabrica->Mostrar();
echo "<br>";

// Mostrar costo total de la fábrica
echo "Costo total de la fábrica: $" . Fabrica::MostrarCosto($fabrica) . "<br>";

// Intentar agregar un operario repetido
$operario3 = new Operario("Juan", "Perez", "12345", 2200);
if ($fabrica->Add($operario3)) {
    echo "Operario agregado a la fábrica.<br>";
} else {
    echo "No se pudo agregar al operario a la fábrica (ya está en la lista o excede la capacidad).<br>";
}

// Quitar un operario de la fábrica
if ($fabrica->Remove($operario1)) {
    echo "Operario quitado de la fábrica.<br>";
} else {
    echo "No se pudo quitar al operario de la fábrica (no encontrado).<br>";
}
