<?php

require_once './clases/Mascota.php';

use Animalitos\Mascota;

// Crear dos objetos Mascota con el mismo nombre y distinto tipo
$mascota1 = new Mascota("Buddy", "Perro");
$mascota2 = new Mascota("Buddy", "Gato");

// Mostrar las mascotas (uno con el método estático y el otro con el de instancia)
echo "Mascota 1: " . Mascota::mostrar($mascota1) . "\n";
echo "Mascota 2: " . $mascota2->toString() . "\n";

// Comparar las mascotas
if ($mascota1->equals($mascota2)) {
    echo "Mascota 1 y Mascota 2 son iguales.\n";
} else {
    echo "Mascota 1 y Mascota 2 son diferentes.\n";
}

// Crear dos objetos Mascota con el mismo nombre, mismo tipo y distintas edades
$mascota3 = new Mascota("Luna", "Perro", 3);
$mascota4 = new Mascota("Luna", "Perro", 5);

// Mostrar las mascotas (uno con el método estático y el otro con el de instancia)
echo "Mascota 3: " . Mascota::mostrar($mascota3) . "\n";
echo "Mascota 4: " . $mascota4->toString() . "\n";

// Comparar las mascotas
if ($mascota3->equals($mascota4)) {
    echo "Mascota 3 y Mascota 4 son iguales.\n";
} else {
    echo "Mascota 3 y Mascota 4 son diferentes.\n";
}

// Comparar la primera Mascota con la tercera
if ($mascota1->equals($mascota3)) {
    echo "Mascota 1 y Mascota 3 son iguales.\n";
} else {
    echo "Mascota 1 y Mascota 3 son diferentes.\n";
}




// // Código de prueba
// require_once './clases/Mascota.php'; // Asegúrate de incluir la clase Mascota
require_once './clases/Guarderia.php';
use Negocios\Guarderia;

$guarderia = new Guarderia("La guardería de Pancho");

$mascota1 = new Mascota("Fido", "Perro", 3);
$mascota2 = new Mascota("Miau", "Gato", 2);
$mascota3 = new Mascota("Rex", "Perro", 4);

$guarderia->add($mascota1);
$guarderia->add($mascota2);
$guarderia->add($mascota3);

echo $guarderia->toString();
