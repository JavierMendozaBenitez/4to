<?php
require_once "./Rectangulo.php";
require_once "./Triangulo.php";
class FigurasApp {
    public static function ejecutarEjemplo() {
        $rectangulo = new Rectangulo("Azul", 5, 3);
        $triangulo = new Triangulo("Rojo", 4, 5);

        echo "Rectángulo:<br>";
        echo $rectangulo->ToString() . "<br>";
        echo $rectangulo->Dibujar() . "<br>";

        echo "Triángulo:<br>";
        echo $triangulo->ToString() . "<br>";
        echo $triangulo->Dibujar() . "<br>";
    }
}

// Luego, para ejecutar el ejemplo, puedes hacer lo siguiente:
FigurasApp::ejecutarEjemplo();