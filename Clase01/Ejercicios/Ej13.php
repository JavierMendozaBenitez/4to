<!-- <?php
// Crear tres arrays
$animales = array("Perro", "Gato", "Ratón", "Araña", "Mosca");
$años = array("1986", "1996", "2015", "78", "86");
$tecnologias = array("php", "mysql", "html5", "typescript", "ajax");

// Utilizar array_push para cargar valores adicionales en los arrays
array_push($animales, "Tigre", "Loro");
array_push($años, "2000", "2022");
array_push($tecnologias, "CSS", "JavaScript");

// Juntar los tres arrays en uno solo
$resultado = array_merge($animales, $años, $tecnologias);

// Mostrar el array resultante por pantalla
echo "Array resultante:<br>";
foreach ($resultado as $valor) {
    echo "$valor<br>";
}
?> -->

<?php
// Crear tres arrays y mostrarlos
$animales = array("Perro", "Gato", "Ratón", "Araña", "Mosca");
$años = array("1986", "1996", "2015", "78", "86");
$tecnologias = array("php", "mysql", "html5", "typescript", "ajax");

echo "Arrays originales:<br>";
echo "Animales: " . implode(", ", $animales) . "<br>";
echo "Años: " . implode(", ", $años) . "<br>";
echo "Tecnologías: " . implode(", ", $tecnologias) . "<br>";

// Utilizar array_push para cargar valores adicionales en los arrays y mostrarlos
array_push($animales, "Tigre", "Loro");
array_push($años, "2000", "2022");
array_push($tecnologias, "CSS", "JavaScript");

echo "<br>Arrays después de array_push:<br>";
echo "Animales: " . implode(", ", $animales) . "<br>";
echo "Años: " . implode(", ", $años) . "<br>";
echo "Tecnologías: " . implode(", ", $tecnologias) . "<br>";

// Juntar los tres arrays en uno solo
$resultado = array_merge($animales, $años, $tecnologias);

// Mostrar el array resultante por pantalla
echo "<br>Array resultante:<br>";
foreach ($resultado as $valor) {
    echo "$valor<br>";
}
?>

