<?php

class Operario {
    private $_nombre;
    private $_apellido;
    private $_legajo;
    private $_salario;

    public function __construct($nombre, $apellido, $legajo, $salario) {
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_legajo = $legajo;
        $this->_salario = $salario;
    }

    public function GetNombreApellido() {
        return $this->_nombre . ', ' . $this->_apellido;
    }

    public function Mostrar() {
        return $this->GetNombreApellido() . ' - Legajo: ' . $this->_legajo . ' - Salario: $' . $this->_salario;
    }

    public function Equals(Operario $operario) {
        return $this->_nombre === $operario->_nombre &&
               $this->_apellido === $operario->_apellido &&
               $this->_legajo === $operario->_legajo;
    }

    public function GetSalario() {
        return $this->_salario;
    }

    public function SetAumentarSalario($porcentaje) {
        $this->_salario += $this->_salario * ($porcentaje / 100);
    }
}