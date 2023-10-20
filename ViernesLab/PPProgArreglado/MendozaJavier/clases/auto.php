<?php

//require_once('IBM.php');

namespace MendozaJavier;

class Auto{
    public string $patente;
    public string $marca;
    public string $color;
    public float $precio;

    public function __construct(string $patente, string $marca, string $color, float $precio) {
        $this->patente = $patente;
        $this->marca = $marca;
        $this->color = $color;
        $this->precio = $precio;
    }

    public function toJSON()
    {
        $autoData = array(
            'patente' => $this->patente,
            'marca' => $this->marca,
            'color' => $this->color,
            'precio' => $this->precio
        );
        return json_encode($autoData);
    }
    
    public function guardarJSON($path)
    {
        $autoData = $this->toJSON();
        $resultado = file_put_contents($path, $autoData . PHP_EOL, FILE_APPEND);
        if ($resultado !== false) {
            return json_encode(array('éxito' => true, 'mensaje' => 'Auto guardado correctamente.'));
        } else {
            return json_encode(array('éxito' => false, 'mensaje' => 'Error al guardar el auto.'));
        }
    }   

    public static function traerJSON($path) {
        $autos = array();
        $data = file_get_contents($path);
        $lines = explode(PHP_EOL, $data);

        foreach ($lines as $line) {
            if (!empty($line)) {
                $autoData = json_decode($line, true);
                if ($autoData) {
                    $autos[] = new Auto($autoData['patente'], $autoData['marca'], $autoData['color'], $autoData['precio']);
                }
            }
        }

        return $autos;
    }
    public static function verificarAutoJSON($auto) {
        $autos = self::traerJSON('./archivos/autos.json'); // Asegúrate de especificar la ruta correcta aquí
    
        foreach ($autos as $existingAuto) {
            if ($existingAuto->patente === $auto->patente) {
                return json_encode(array(
                    'existe' => true,
                    'mensaje' => 'El auto está registrado.'
                ));
            }
        }
    
        return json_encode(array(
            'existe' => false,
            'mensaje' => 'El auto no está registrado.'
        ));
    }
}

