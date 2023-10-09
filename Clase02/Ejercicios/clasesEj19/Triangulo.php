<?php

require_once "./FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica {
    private $_base;
    private $_altura;

    public function __construct($color, $base, $altura) {
        parent::__construct($color);
        $this->_base = $base;
        $this->_altura = $altura;
    }

    protected function CalcularDatos() {
        $this->_superficie = ($this->_base * $this->_altura) / 2;
        $this->_perimetro = $this->_base + (2 * sqrt(pow($this->_base / 2, 2) + pow($this->_altura, 2)));
    }

    public function Dibujar() {
        $dibujo = '';
        $espacios = $this->_base / 2;
        for ($i = 0; $i < $this->_altura; $i++) {
            if ($espacios >= 0) {
                $dibujo .= str_repeat(' ', $espacios);
                $dibujo .= str_repeat('*', $i * 2 + 1);
                $dibujo .= '<br>';
            }
            $espacios--;
        }
        return $dibujo;
    }
}
