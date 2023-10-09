<?php
// Obtener la fecha actual
$fecha_actual = date('Y-m-d'); // Formato año-mes-día

// Imprimir la fecha en diferentes formatos
echo "Fecha actual en formato AAAA-MM-DD: $fecha_actual<br>";

$fecha_formato_personalizado = date('d/m/Y'); // Formato día/mes/año
echo "Fecha actual en formato DD/MM/AAAA: $fecha_formato_personalizado<br>";

$fecha_formato_largo = date('l, j F Y'); // Formato día de la semana, día de mes completo, mes completo y año
echo "Fecha actual en formato largo: $fecha_formato_largo<br>";

// Determinar la estación del año en Argentina
$mes_actual = date('n'); // Obtener el mes actual como número (1-12)

$estacion = '';

switch ($mes_actual) {
    case 12:
    case 1:
    case 2:
        $estacion = 'Verano';
        break;
    case 3:
    case 4:
    case 5:
        $estacion = 'Otoño';
        break;
    case 6:
    case 7:
    case 8:
        $estacion = 'Invierno';
        break;
    case 9:
    case 10:
    case 11:
        $estacion = 'Primavera';
        break;
}

echo "Estación del año actual en Argentina: $estacion";
?>
