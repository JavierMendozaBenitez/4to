<?php
function invertirPalabra($palabra) {
    $longitud = count($palabra);
    $palabraInvertida = array();

    // Recorremos el array de caracteres en orden inverso y lo agregamos al nuevo array
    for ($i = $longitud - 1; $i >= 0; $i--) {
        $palabraInvertida[] = $palabra[$i];
    }

    // Convertimos el array invertido en una cadena
    $palabraInvertida = implode('', $palabraInvertida);

    return $palabraInvertida;
}

$palabraOriginal = "HOLA";
$palabraInvertida = invertirPalabra(str_split($palabraOriginal));

echo "Palabra original: $palabraOriginal<br>";
echo "Palabra invertida: $palabraInvertida";
?>
