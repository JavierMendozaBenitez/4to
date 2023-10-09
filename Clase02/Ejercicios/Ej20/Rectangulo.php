<?php

require_once "./Punto.php";

class Rectangulo {
    private $vertice1;
    private $vertice2;
    private $vertice3;
    private $vertice4;
    private $ladoUno;
    private $ladoDos;
    private $area;
    private $perimetro;

    public function __construct(Punto $vertice1, Punto $vertice3) {
        $this->vertice1 = $vertice1;
        $this->vertice3 = $vertice3;

        // var_dump($vertice1);
        // var_dump($vertice3);

        // Calcular vértices 2 y 4
        $this->vertice2 = new Punto($vertice1->getCoordX(), $vertice3->getCoordY());
        $this->vertice4 = new Punto($vertice3->getCoordX(), $vertice1->getCoordY());

        $this->calcularLados();
        $this->calcularArea();
        $this->calcularPerimetro();
    }

    private function calcularLados() {
        //$this->ladoUno = abs($this->vertice2->getCoordX() - $this->vertice1->getCoordX());
        $this->ladoUno = abs($this->vertice2->getCoordX() - $this->vertice1->getCoordX());
        $this->ladoDos = abs($this->vertice3->getCoordY() - $this->vertice2->getCoordY());
    }

    private function calcularArea() {
        $this->area = $this->ladoUno * $this->ladoDos;
    }

    private function calcularPerimetro() {
        $this->perimetro = 2 * ($this->ladoUno + $this->ladoDos);
    }

    public function getLadoUno() {
        return $this->ladoUno;
    }

    public function getLadoDos() {
        return $this->ladoDos;
    }

    public function getArea() {
        return $this->area;
    }

    public function getPerimetro() {
        return $this->perimetro;
    }
}