<?php
abstract class FiguraGeometrica {
    protected $_color;
    protected $_superficie;
    protected $_perimetro;

    public function __construct($color = "Blanco") {
        $this->_color = $color;
        $this->CalcularDatos();
    }

    public function getColor() {
        return $this->_color;
    }

    public function setColor($color) {
        $this->_color = $color;
    }

    public abstract function Dibujar();

    protected abstract function CalcularDatos();

    public function ToString() {
        return "Color: " . $this->_color . "<br>Superficie: " . $this->_superficie . "<br>Perímetro: " . $this->_perimetro;
    }
}