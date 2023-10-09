<?php

require_once "./Garage.php";

// Ejemplo de uso:
$auto1 = new Auto("Toyota", "Rojo", 20000);
$auto2 = new Auto("Ford", "Azul", 25000);
$auto3 = new Auto("Honda", "Verde", 18000);

$miGarage = new Garage("Mi Garage", 10);

$miGarage->Add($auto1);
$miGarage->Add($auto2);
$miGarage->Add($auto3);

echo "Contenido del Garage:<br>";
$miGarage->MostrarGarage();

$miGarage->Remove($auto2);

echo "Contenido del Garage después de quitar un auto:<br>";
$miGarage->MostrarGarage();
