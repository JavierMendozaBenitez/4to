<?php
function EsPar($numero) {
    return $numero % 2 == 0;
}

function EsImpar($numero) {
    return $numero % 2 != 0;
}

$numero = 61; // Cambia este número según tus necesidades

if (EsPar($numero)) {
    echo "$numero es par.";
} else {
    echo "$numero es impar.";
}
?>
