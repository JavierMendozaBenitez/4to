<?php

require_once "./Pasajero.php";

class Vuelo {
    private $_fecha;
    private $_empresa;
    private $_precio;
    private $_listaDePasajeros;
    private $_cantMaxima;

    public function __construct($empresa, $precio, $cantMaxima = 0) {
        $this->_fecha = new DateTime(); // Fecha actual
        $this->_empresa = $empresa;
        $this->_precio = $precio;
        $this->_listaDePasajeros = array();
        $this->_cantMaxima = $cantMaxima;
    }

    public function AgregarPasajero(Pasajero $pasajero) {
        if ($this->GetCantPasajeros() < $this->_cantMaxima && !$this->PasajeroEnLista($pasajero)) {
            $this->_listaDePasajeros[] = $pasajero;
            return true; // Se agregó el pasajero con éxito
        } else {
            return false; // No se pudo agregar el pasajero
        }
    }

    private function PasajeroEnLista(Pasajero $pasajero) {
        foreach ($this->_listaDePasajeros as $p) {
            if ($p->Equals($pasajero)) {
                return true;
            }
        }
        return false;
    }

    public function MostrarVuelo() {
        echo "Información del vuelo:<br>";
        echo "Fecha: " . $this->_fecha->format('Y-m-d') . "<br>";
        echo "Empresa: " . $this->_empresa . "<br>";
        echo "Precio: $" . $this->_precio . "<br>";
        echo "Cantidad máxima de pasajeros: " . $this->_cantMaxima . "<br>";
        echo "Lista de pasajeros:<br>";
        foreach ($this->_listaDePasajeros as $pasajero) {
            Pasajero::MostrarPasajero($pasajero);
        }
    }

    public function GetCantPasajeros() {
        return count($this->_listaDePasajeros);
    }

    public static function Add(Vuelo $vuelo1, Vuelo $vuelo2) {
        $recaudacion = 0;
        foreach ($vuelo1->_listaDePasajeros as $pasajero) {
            $precio = $pasajero->EsPlus() ? $vuelo1->_precio * 0.8 : $vuelo1->_precio;
            $recaudacion += $precio;
        }
        foreach ($vuelo2->_listaDePasajeros as $pasajero) {
            $precio = $pasajero->EsPlus() ? $vuelo2->_precio * 0.8 : $vuelo2->_precio;
            $recaudacion += $precio;
        }
        return $recaudacion;
    }
    
    public function Remove(Pasajero $pasajero) {
        if ($this->PasajeroEnLista($pasajero)) {
            $key = array_search($pasajero, $this->_listaDePasajeros);
            unset($this->_listaDePasajeros[$key]);
        } else {
            echo "El pasajero no está en este vuelo.<br>";
        }
        return $this;
    }
}
