<?php

namespace MendozaJavier;

 require_once('Auto.php');
 require_once('IParte1.php');
 require_once('IParte2.php');
 require_once('IParte3.php');

use PDO;

class AutoBD extends Auto implements IParte1, IParte2, IParte3
{
    protected $pathFoto;

    public function __construct($patente, $marca, $color, $precio, $pathFoto = null)
    {
        parent::__construct($patente, $marca, $color, $precio);
        $this->pathFoto = $pathFoto;
    }

    public function toJSON() {
        $autoData = [
            'patente' => $this->patente,
            'marca' => $this->marca,
            'color' => $this->color,
            'precio' => $this->precio,
            'pathFoto' => $this->pathFoto,
        ];
        return json_encode($autoData);
    }

    public function agregar($conexion) {
        $sql = "INSERT INTO autos (patente, marca, color, precio, foto) VALUES (:patente, :marca, :color, :precio, :foto)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':patente', $this->patente);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':foto', $this->pathFoto);

        return $stmt->execute();
    }
    public function getPathFoto() {
        return $this->pathFoto;
    }

    public static function traer($conexion) {
        $sql = "SELECT patente, marca, color, precio, foto FROM autos";
        $stmt = $conexion->query($sql);

        $autos = [];

        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     $auto = new AutoBD($row['patente'], $row['marca'], $row['color'], $row['precio'], $row['foto']);
        //     $autos[] = $auto;
        // }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $patente = $row['patente'];
            $marca = $row['marca'];
            $color = $row['color'];
            $precio = $row['precio'];
            $foto = isset($row['foto']) ? $row['foto'] : null;
    
            $auto = new AutoBD($patente, $marca, $color, $precio, $foto);
            $autos[] = $auto;
            
        }

        return $autos;
    }

    public static function eliminar($conexion, $patente) {
        $sql = "DELETE FROM autos WHERE patente = :patente";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':patente', $patente);
        $exito = $stmt->execute();
    
        // Verificar si se afectó alguna fila en la base de datos
        if ($stmt->rowCount() > 0) {
            return true; // Se eliminó correctamente
        } else {
            return false; // No se encontró ningún registro para eliminar
        }
    }

    public function modificar($conexion) {
        $sql = "UPDATE autos SET marca = :marca, color = :color, precio = :precio, foto = :foto WHERE patente = :patente";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':patente', $this->patente);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':foto', $this->pathFoto);
        return $stmt->execute();
    }
    public function existe(array $autos) {
        foreach ($autos as $auto) {
            if ($auto->patente === $this->patente) {
                return true;
            }
        }
        return false;
    }

    public function guardarEnArchivo() {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $nombreArchivo = $this->patente . '.borrado.' . date('His') . '.jpg';
        $ubicacionNuevaFoto = '../autosBorrados/' . $nombreArchivo;
    
        // Inicializa un mensaje de éxito o error
        //$mensaje = var_dump($this->pathFoto)."DESDE AUTODB";//muestra el nombre correcto
        $mensaje = "Error DESDE AUTODB";
        $exito = false;
        //var_dump($this->pathFoto);
    
        // Mover la foto al subdirectorio "./autosBorrados/"
        if ($this->pathFoto !== null && file_exists($this->pathFoto)) {
            if (rename($this->pathFoto, $ubicacionNuevaFoto)) {
                $mensaje = "Foto movida exitosamente.";
                $exito = true;
            } else {
                $error = error_get_last();
                $mensaje = "Error al mover la foto: " . $error['message'];
                $exito = false;
            }
        }
    
        // Escribir toda la información en el archivo de texto
        $contenidoArchivo = "Patente: {$this->patente}\nMarca: {$this->marca}\nColor: {$this->color}\nPrecio: {$this->precio}\nNueva ubicación de la foto: {$ubicacionNuevaFoto}";
        // Verificar si el archivo ya existe
        $archivo = '../archivos/autosbd_borrados.txt';
        if (file_exists($archivo)) {
            // Leer el contenido actual del archivo
            $contenidoActual = file_get_contents($archivo);

            // Agregar el nuevo auto borrado al contenido actual
            $contenidoActual .= "\n\n" . $contenidoArchivo;

            // Sobrescribir el archivo con el contenido actualizado
            file_put_contents($archivo, $contenidoActual);
        } else {
            // Si el archivo no existe, simplemente guarda el contenido del auto borrado
            file_put_contents($archivo, $contenidoArchivo);
        }

        // Devolver un resultado que indica éxito o error
        return json_encode(['exito' => $exito, 'mensaje' => $mensaje]);
    }
}
 