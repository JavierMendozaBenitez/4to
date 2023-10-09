<?php

class Pasajero {
    private $_apellido;
    private $_nombre;
    private $_dni;
    private $_esPlus;

    public function __construct($apellido, $nombre, $dni, $esPlus) {
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_dni = $dni;
        $this->_esPlus = $esPlus;
    }

    public function Equals(Pasajero $otroPasajero) {
        return $this->_dni === $otroPasajero->_dni;
    }

    public function GetInfoPasajero() {
        return "Apellido: " . $this->_apellido . ", Nombre: " . $this->_nombre . ", DNI: " . $this->_dni . ", Es Plus: " . ($this->_esPlus ? "Sí" : "No");
    }

    public static function MostrarPasajero(Pasajero $pasajero) {
        echo $pasajero->GetInfoPasajero() . "<br>";
    }

    public function EsPlus() {
        return $this->_esPlus;
    }
}