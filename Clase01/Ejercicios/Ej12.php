<?php
// Crear un array asociativo para representar una lapicera
$lapicera = array(
    'color' => '',
    'marca' => '',
    'trazo' => '',
    'precio' => 0.0
);

// Crear y cargar la primera lapicera
$lapicera['color'] = 'Azul';
$lapicera['marca'] = 'BIC';
$lapicera['trazo'] = 'Fino';
$lapicera['precio'] = 1.5;

// Mostrar la primera lapicera
echo "Lapicera 1:<br>";
echo "Color: " . $lapicera['color'] . "<br>";
echo "Marca: " . $lapicera['marca'] . "<br>";
echo "Trazo: " . $lapicera['trazo'] . "<br>";
echo "Precio: $" . $lapicera['precio'] . "<br>";

// Crear y cargar la segunda lapicera
$lapicera['color'] = 'Rojo';
$lapicera['marca'] = 'Pilot';
$lapicera['trazo'] = 'Medio';
$lapicera['precio'] = 2.0;

// Mostrar la segunda lapicera
echo "<br>Lapicera 2:<br>";
echo "Color: " . $lapicera['color'] . "<br>";
echo "Marca: " . $lapicera['marca'] . "<br>";
echo "Trazo: " . $lapicera['trazo'] . "<br>";
echo "Precio: $" . $lapicera['precio'] . "<br>";

// Crear y cargar la tercera lapicera
$lapicera['color'] = 'Verde';
$lapicera['marca'] = 'Faber-Castell';
$lapicera['trazo'] = 'Grueso';
$lapicera['precio'] = 1.8;

// Mostrar la tercera lapicera
echo "<br>Lapicera 3:<br>";
echo "Color: " . $lapicera['color'] . "<br>";
echo "Marca: " . $lapicera['marca'] . "<br>";
echo "Trazo: " . $lapicera['trazo'] . "<br>";
echo "Precio: $" . $lapicera['precio'] . "<br>";
?>
