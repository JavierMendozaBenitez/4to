<?php

class Auto {
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca, $color, $precio = 0, $fecha = null) {
        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }

    public function AgregarImpuestos($impuesto) {
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto(Auto $auto) {
        echo "Marca: " . $auto->_marca . "<br>";
        echo "Color: " . $auto->_color . "<br>";
        echo "Precio: " . $auto->_precio . "<br>";
        echo "Fecha: " . ($auto->_fecha ? $auto->_fecha->format('Y-m-d') : 'N/A') . "<br>";
    }

    public function Equals(Auto $auto) {
        return $this->_marca === $auto->_marca;
    }

    public static function Add(Auto $auto1, Auto $auto2) {
        if ($auto1->_marca === $auto2->_marca && $auto1->_color === $auto2->_color) {
            return $auto1->_precio + $auto2->_precio;
        } else {
            echo "No se pueden sumar autos de diferentes marcas o colores.";
            return 0;
        }
    }
}

