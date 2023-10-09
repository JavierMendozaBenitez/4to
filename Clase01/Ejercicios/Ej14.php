<?php
// Crear tres arrays con los datos del punto anterior
$animales = array("Perro", "Gato", "Ratón", "Araña", "Mosca");
$años = array("1986", "1996", "2015", "78", "86");
$tecnologias = array("php", "mysql", "html5", "typescript", "ajax");

// Crear un array asociativo que contenga los tres arrays
$array_asociativo = array(
    'Animales' => $animales,
    'Años' => $años,
    'Tecnologías' => $tecnologias
);

// Crear un array indexado que contenga los tres arrays
$array_indexado = array($animales, $años, $tecnologias);

// Mostrar el contenido del array asociativo
echo "Array Asociativo:<br>";
foreach ($array_asociativo as $clave => $valor) {
    echo "$clave: " . implode(", ", $valor) . "<br>";
}

// Mostrar el contenido del array indexado
echo "<br>Array Indexado:<br>";
foreach ($array_indexado as $indice => $array) {
    echo "Array $indice: " . implode(", ", $array) . "<br>";
}
?>
