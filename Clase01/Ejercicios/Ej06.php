<?php
$operador = '/';
$op1 = 10;
$op2 = 5;

$resultado = 0;

switch ($operador) {
    case '+':
        $resultado = $op1 + $op2;
        break;
    case '-':
        $resultado = $op1 - $op2;
        break;
    case '*':
        $resultado = $op1 * $op2;
        break;
    case '/':
        if ($op2 != 0) {
            $resultado = $op1 / $op2;
        } else {
            echo "No se puede dividir por cero.";
            exit;
        }
        break;
    default:
        echo "Operador no válido.";
        exit;
}

echo "El resultado de la operación es: $resultado";
?>
