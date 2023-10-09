<?php

class Punto {
    private $coordX;
    private $coordY;

    public function __construct($coordX, $coordY) {
        $this->coordX = $coordX;
        $this->coordY = $coordY;
    }

    public function getCoordX() {
        return $this->coordX;
    }

    public function getCoordY() {
        return $this->coordY;
    }
}