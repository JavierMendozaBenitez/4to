<?php
require_once './Operario.php';
class Fabrica {
    private $_operarios = array();
    private $_cantidadMaxima = 5;

    public function __construct() {
    }

    private function RetornarCostos() {
        $costos = 0;
        foreach ($this->_operarios as $operario) {
            $costos += $operario->GetSalario();
        }
        return $costos;
    }

    private function MostrarOperarios() {
        $infoOperarios = '';
        foreach ($this->_operarios as $operario) {
            $infoOperarios .= $operario->Mostrar() . '<br>';
        }
        return $infoOperarios;
    }

    public static function MostrarCosto(Fabrica $fabrica) {
        return $fabrica->RetornarCostos();
    }

    public static function Equals(Fabrica $fabrica, Operario $operario) {
        foreach ($fabrica->_operarios as $op) {
            if ($op->Equals($operario)) {
                return true;
            }
        }
        return false;
    }

    public function Add(Operario $operario) {
        if (count($this->_operarios) < $this->_cantidadMaxima && !self::Equals($this, $operario)) {
            array_push($this->_operarios, $operario);
            return true;
        }
        return false;
    }

    public function Remove(Operario $operario) {
        $index = -1;
        foreach ($this->_operarios as $key => $op) {
            if ($op->Equals($operario)) {
                $index = $key;
                break;
            }
        }
        if ($index >= 0) {
            array_splice($this->_operarios, $index, 1);
            return true;
        }
        return false;
    }

    public function Mostrar() {
        return $this->MostrarOperarios();
    }
}
