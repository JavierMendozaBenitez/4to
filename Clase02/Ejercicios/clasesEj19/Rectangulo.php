<?php

require_once "./FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica {
    private $_lado1;
    private $_lado2;

    public function __construct($color, $lado1, $lado2) {
        parent::__construct($color);
        $this->_lado1 = $lado1;
        $this->_lado2 = $lado2;
    }

    protected function CalcularDatos() {
        $this->_superficie = $this->_lado1 * $this->_lado2;
        $this->_perimetro = 2 * ($this->_lado1 + $this->_lado2);
    }

    public function Dibujar() {
        $dibujo = '';
        for ($i = 0; $i < $this->_lado2; $i++) {
            for ($j = 0; $j < $this->_lado1; $j++) {
                $dibujo .= '*';
            }
            $dibujo .= '<br>';
        }
        return $dibujo;
    }
}