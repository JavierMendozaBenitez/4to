<?php

require_once "./Auto.php";

class Garage {
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial, $precioPorHora = 0) {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }

    public function MostrarGarage() {
        echo "Razón Social: " . $this->_razonSocial . "<br>";
        echo "Precio por Hora: " . $this->_precioPorHora . "<br>";
        echo "Autos en el Garage:<br>";
        foreach ($this->_autos as $auto) {
            Auto::MostrarAuto($auto);
        }
    }

    public function Equals(Auto $auto) {
        return in_array($auto, $this->_autos);
    }

    public function Add(Auto $auto) {
        if (!$this->Equals($auto)) {
            $this->_autos[] = $auto;
            echo "Auto agregado al Garage.<br>";
        } else {
            echo "El auto ya está en el Garage.<br>";
        }
    }

    public function Remove(Auto $auto) {
        $key = array_search($auto, $this->_autos);
        if ($key !== false) {
            unset($this->_autos[$key]);
            echo "Auto eliminado del Garage.<br>";
        } else {
            echo "El auto no está en el Garage.<br>";
        }
    }
}