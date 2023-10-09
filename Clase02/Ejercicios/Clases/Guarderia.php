<?php

namespace Negocios; // Define el namespace

require_once './clases/Mascota.php';

use Animalitos\Mascota;

class Guarderia
{
    public $nombre;
    public $mascotas = [];

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function equals(Mascota $mascota)
    {
        foreach ($this->mascotas as $guarderiaMascota) {
            if ($guarderiaMascota->nombre == $mascota->nombre && $guarderiaMascota->tipo == $mascota->tipo) {
                return true;
            }
        }
        return false;
    }

    public function add(Mascota $mascota)
    {
        if (!$this->equals($mascota)) {
            $this->mascotas[] = $mascota;
            return true;
        }
        return false;
    }

    public function toString()
    {
        $mascotasString = "";
        $edadTotal = 0;
        $contadorMascotas = count($this->mascotas);

        foreach ($this->mascotas as $mascota) {
            $mascotasString .= $mascota->nombre . " (" . $mascota->tipo . "), ";
            $edadTotal += $mascota->edad;
        }

        $promedioEdad = $contadorMascotas > 0 ? $edadTotal / $contadorMascotas : 0;

        $resultado = "Guardería: " . $this->nombre . "\n";
        $resultado .= "Mascotas: " . rtrim($mascotasString, ", ") . "\n";
        $resultado .= "Promedio de edad: " . number_format($promedioEdad, 2) . "\n";

        return $resultado;
    }
}