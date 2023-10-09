<?php

namespace Mendoza;

class Alumno
{
    private $legajo;
    private $nombre;
    private $apellido;
    private $foto;

    public function __construct($legajo, $nombre, $apellido, $foto = "")
    {
        $this->legajo = $legajo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->foto = $foto;
    }

    public function getLegajo()
    {
        return $this->legajo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function guardar()
    {
        $archivo = './archivos/alumnos_foto.txt';

        // Modifica el nombre de la foto antes de guardarla
        $extension = pathinfo($this->foto, PATHINFO_EXTENSION);
        $this->foto = "{$this->legajo}.{$extension}";

        $registro = "{$this->legajo} - {$this->apellido} - {$this->nombre} - {$this->foto}\r\n";

        if (file_put_contents($archivo, $registro, FILE_APPEND)) {
            return true;
        } else {
            return false;
        }
    }

    public static function listar()
{
    $archivo = './archivos/alumnos_foto.txt';
    $alumnos = [];

    if (file_exists($archivo)) {
        $lines = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $data = explode(" - ", $line);
            if (count($data) == 4) {
                $alumnos[] = new Alumno($data[0], $data[2], $data[1], $data[3]);
            } else {
                // Manejar el caso en el que la línea no tiene el formato esperado
            }
        }
    }

    return $alumnos;
}

    public static function verificar($legajo)
    {
        $archivo = './archivos/alumnos_foto.txt';

        if (file_exists($archivo)) {
            $lines = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $data = explode(" - ", $line);
                if ($data[0] == $legajo) {
                    return new Alumno($data[0], $data[2], $data[1], $data[3]);
                }
            }
        }

        return null;
    }

    public function modificar()
    {
        $archivo = './archivos/alumnos_foto.txt';
        $lines = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newLines = [];

        foreach ($lines as $line) {
            $data = explode(" - ", $line);
            if ($data[0] == $this->legajo) {
                $line = "{$this->legajo} - {$this->apellido} - {$this->nombre} - {$this->foto}";
            }
            $newLines[] = $line;
        }

        if (file_put_contents($archivo, implode("\r\n", $newLines))) {
            return true;
        } else {
            return false;
        }
    }

    public static function borrar($legajo)
    {
        $archivo = './archivos/alumnos_foto.txt';
        $lines = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newLines = [];

        $alumnoEncontrado = false;
        foreach ($lines as $line) {
            $data = explode(" - ", $line);
            if ($data[0] == $legajo) {
                $alumnoEncontrado = true;
                continue;
            }
            $newLines[] = $line;
        }

        if ($alumnoEncontrado) {
            if (file_put_contents($archivo, implode("\r\n", $newLines))) {
                // Borra la foto asociada al alumno
                $fotoPath = "./fotos/{$legajo}.jpg";
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function obtenerPorLegajo($legajo)
    {
        $archivo = './archivos/alumnos_foto.txt';

        if (file_exists($archivo)) {
            $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // foreach ($lineas as $linea) {
            //     list($legajoArchivo, $apellido, $nombre, $foto) = explode(' - ', $linea);

            //     if ($legajoArchivo == $legajo) {
            //         return new Alumno($legajo, $nombre, $apellido, $foto);
            //     }
            // }
            foreach ($lineas as $line) {
                $data = explode(" - ", $line);
                
                // Verificar que haya al menos 4 elementos en $data antes de acceder a ellos
                if (isset($data[0], $data[1], $data[2], $data[3])) {
                    $alumnos[] = new Alumno($data[0], $data[2], $data[1], $data[3]);
                } else {
                    // Manejar el caso en que los datos no tienen el formato esperado
                    // Puedes mostrar un mensaje de error o realizar alguna otra acción
                }
            }
        }

        return null; // Si no se encontró el alumno
    }
}

?>
