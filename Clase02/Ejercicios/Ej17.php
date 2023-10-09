<?php
function validarPalabra($palabra, $max) {
    $palabrasValidas = ["Recuperatorio", "Parcial", "Programacion"];

    // Verificar la longitud de la palabra
    if (strlen($palabra) > $max) {
        return 0; // La palabra tiene más caracteres de los permitidos
    }

    // Verificar si la palabra está en el listado de palabras válidas
    if (in_array($palabra, $palabrasValidas)) {
        return 1; // La palabra está en el listado de palabras válidas
    }

    return 0; // La palabra no está en el listado de palabras válidas
}

$palabra = "Parciall"; // Cambia esta palabra según tus necesidades
$max = 15; // Cambia este valor según tus necesidades

$resultado = validarPalabra($palabra, $max);

if ($resultado === 1) {
    echo "La palabra es válida.";
} else {
    echo "La palabra no es válida.";
}
?>
