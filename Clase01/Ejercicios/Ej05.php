<?php
$a = 6;
$b = 9;
$c = 9;

if (($a > $b && $a < $c) || ($a > $c && $a < $b)) {
    echo "El valor del medio es: $a";
} elseif (($b > $a && $b < $c) || ($b > $c && $b < $a)) {
    echo "El valor del medio es: $b";
} elseif (($c > $a && $c < $b) || ($c > $b && $c < $a)) {
    echo "El valor del medio es: $c";
} else {
    echo "No hay valor del medio";
}
?>
