<?php
// Incluir la clase Auto.php
require_once('./clases/auto.php');
use MendozaJavier\Auto;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = Auto::traerJSON('./archivos/autos.json');

    echo json_encode($result);
}