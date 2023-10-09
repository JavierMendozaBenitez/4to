<?php

require_once "./Punto.php";
require_once "./Rectangulo.php";

// Crear un punto para el vértice 1
$vertice1 = new Punto(0, 0);

// Crear un punto para el vértice 3
$vertice3 = new Punto(4, 3);

// Crear un rectángulo
$rectangulo = new Rectangulo($vertice1, $vertice3);

// Obtener los datos del rectángulo
$ladoUno = $rectangulo->getLadoUno();
$ladoDos = $rectangulo->getLadoDos();
$area = $rectangulo->getArea();
$perimetro = $rectangulo->getPerimetro();

// Mostrar los datos del rectángulo
echo "Lado Uno: $ladoUno<br>";
echo "Lado Dos: $ladoDos<br>";
echo "Área: $area<br>";
echo "Perímetro: $perimetro<br>";



