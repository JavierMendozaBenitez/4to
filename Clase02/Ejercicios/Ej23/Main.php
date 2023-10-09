<?php

require_once "./Pasajero.php";
require_once "./Vuelo.php";


// Crear pasajeros
$pasajero1 = new Pasajero("López", "Juan", "12345678", true);
$pasajero2 = new Pasajero("García", "María", "87654321", false);
$pasajero3 = new Pasajero("Pérez", "Ana", "55555555", true);

// Crear vuelos
$vuelo1 = new Vuelo("Aerolíneas Argentinas", 500);
$vuelo2 = new Vuelo("LATAM", 450, 3);

// Agregar pasajeros a vuelos
$vuelo1->AgregarPasajero($pasajero1);
$vuelo1->AgregarPasajero($pasajero2);
$vuelo2->AgregarPasajero($pasajero3);

// Mostrar información de vuelos
$vuelo1->MostrarVuelo();
echo "<br>";
$vuelo2->MostrarVuelo();
echo "<br>";

// Calcular y mostrar recaudación total
$totalRecaudado = Vuelo::Add($vuelo1, $vuelo2);
echo "Recaudación total de los vuelos: $" . $totalRecaudado . "<br>";

// Intentar agregar un pasajero repetido
if ($vuelo1->AgregarPasajero($pasajero2)) {
    echo "Pasajero agregado al vuelo 1.<br>";
} else {
    echo "No se pudo agregar al pasajero al vuelo 1 (ya está en la lista o excede la capacidad).<br>";
}

// Quitar un pasajero de un vuelo
$vuelo1->Remove($pasajero1);
echo "Lista de pasajeros después de quitar a Juan López:<br>";
$vuelo1->MostrarVuelo();