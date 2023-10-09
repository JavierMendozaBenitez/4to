<?php
// Definir un array de 5 elementos con números aleatorios entre 1 y 10
$elementos = [];
for ($i = 0; $i < 5; $i++) {
    $elementos[] = rand(1, 10);
}

// Calcular el promedio de los números en el array
$suma = array_sum($elementos);
$promedio = $suma / count($elementos);

// Determinar si el promedio es mayor, menor o igual a 6
if ($promedio > 6) {
    echo "El promedio de los números es mayor que 6.";
} elseif ($promedio < 6) {
    echo "El promedio de los números es menor que 6.";
} else {
    echo "El promedio de los números es igual a 6.";
}

// Mostrar los números generados
echo "<br>Números generados: " . implode(", ", $elementos);
?>
