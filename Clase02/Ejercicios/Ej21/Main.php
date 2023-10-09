<?php

require_once "./Auto.php";
// Ejemplo de uso:
$auto1 = new Auto("Toyota", "Rojo", 20000);
$auto2 = new Auto("Toyota", "Azul", 25000);
$auto3 = new Auto("Honda", "Rojo", 18000);
$auto4 = new Auto("Ford", "Negro", 22000, new DateTime("2022-01-15"));
$auto5 = new Auto("Toyota", "Rojo", 30000);

$auto3->AgregarImpuestos(1500);
$auto4->AgregarImpuestos(1500);
$auto5->AgregarImpuestos(1500);

$importeDouble = Auto::Add($auto1, $auto2);

if ($auto1->Equals($auto2)) {
    echo "Los autos 1 y 2 son de la misma marca.<br>";
} else {
    echo "Los autos 1 y 2 son de marcas diferentes.<br>";
}

if ($auto1->Equals($auto5)) {
    echo "Los autos 1 y 5 son de la misma marca.<br>";
} else {
    echo "Los autos 1 y 5 son de marcas diferentes.<br>";
}

echo "Importe total de los autos 1 y 2: $importeDouble<br>";

// Mostrar los autos impares
if ($auto1->Equals($auto3)) {
    Auto::MostrarAuto($auto1);
}
if ($auto3->Equals($auto5)) {
    Auto::MostrarAuto($auto3);
}
