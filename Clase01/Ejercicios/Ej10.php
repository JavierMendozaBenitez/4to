<?php
// Inicializar un array para almacenar los números impares
$numeros_impares = [];

// Variable para contar los números impares
$contador = 1;

// Usar un bucle while para llenar el array con los primeros 10 números impares
while (count($numeros_impares) < 10) {
    if ($contador % 2 != 0) {
        $numeros_impares[] = $contador;
    }
    $contador++;
}

// Usar un bucle for para imprimir los números impares
echo "Números impares utilizando for:<br>";
for ($i = 0; $i < count($numeros_impares); $i++) {
    echo $numeros_impares[$i] . "<br>";
}

// Usar un bucle while para imprimir los números impares nuevamente
echo "Números impares utilizando while:<br>";
$indice = 0;
while ($indice < count($numeros_impares)) {
    echo $numeros_impares[$indice] . "<br>";
    $indice++;
}

// Usar un bucle foreach para imprimir los números impares una vez más
echo "Números impares utilizando foreach:<br>";
foreach ($numeros_impares as $numero) {
    echo $numero . "<br>";
}
?>
