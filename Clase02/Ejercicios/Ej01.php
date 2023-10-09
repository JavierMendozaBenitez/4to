<?php
function calcularPotencias($base, $exponente) {
    echo "Potencias de $base:<br>";
    for ($i = 1; $i <= $exponente; $i++) {
        $resultado = pow($base, $i);
        echo "$base ^ $i = $resultado&nbsp;<br>";
    }
    echo "<br>";
}

for ($numero = 1; $numero <= 4; $numero++) {
    calcularPotencias($numero, 4);
}
?>

