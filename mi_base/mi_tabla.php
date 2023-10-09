<?php

class Mi_Tabla
{
    public int $id;
    public string $cadena;
    public string $fecha;

    public function toString()
    {
        return $this->id. " - " .$this->cadena. " - " . $this->fecha;
    }
}