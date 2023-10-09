<?php
$suma = 0;
$contador = 0;

while ($suma + ($contador + 1) <= 1000) {
    $contador++;
    $suma += $contador;
}

echo "Los números sumados son: ";

for ($i = 1; $i <= $contador; $i++) {
    if ($i != $contador) {
        echo "$i, ";
    } else {
        echo "$i";
    }
}

echo "<br>";
echo "La suma total es: $suma<br>";
echo "Se sumaron un total de $contador números.";
?>
