<?php
require_once('Usuario.php'); // Asegúrate de incluir la clase Usuario si no está incluida
require_once('ICRUD.php');

class Empleado extends Usuario implements ICRUD {
    public array $foto;
    public float $sueldo;

    public function __construct(int $id, string $nombre, string $correo, string $clave, int $id_perfil, string $perfil, array $foto, float $sueldo) {
        parent::__construct($id, $nombre, $correo, $clave, $id_perfil, $perfil);
        $this->foto = $foto;
        //$this->setFotoFromString($foto);
        $this->sueldo = $sueldo;
    }

    // Método para convertir la cadena de ruta en un array
    public function setFotoFromString($fotoString) {
        // Verifica si la cadena es válida y no está vacía
        if (!empty($fotoString)) {
            // Crea un array con la cadena como único elemento
            $this->foto = [$fotoString];
        }
    }
    public static function TraerTodos() {
        // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");    
        // Verificar si la conexión se estableció correctamente
        if (!$conexion) {
            return [];
        }    
        // Preparar la consulta SQL para obtener todos los empleados con descripción del perfil y foto
        $consulta = $conexion->prepare("SELECT * FROM empleados 
        INNER JOIN perfiles ON empleados.id_perfil = perfiles.id");    
        // Ejecutar la consulta
        if ($consulta->execute()) {
            // Obtener los resultados de la consulta
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
            // Crear un array para almacenar los objetos Empleado
            $empleados = [];
    
            foreach ($resultados as $fila) {
                // $empleado = new Empleado();
                // $empleado->id = $fila['id'];
                // $empleado->nombre = $fila['nombre'];
                // $empleado->correo = $fila['correo'];
                // $empleado->clave = $fila['clave'];
                // $empleado->id_perfil = $fila['id_perfil'];
                // $empleado->foto = $fila['foto'];
                // $empleado->sueldo = $fila['sueldo'];
                // $empleado->perfil = $fila['perfil'];
                $fotoArray = [$fila['foto']];
                $empleado = new Empleado($fila["id"], $fila["nombre"], $fila["correo"], $fila["clave"], $fila["id_perfil"], $fila['descripcion'], $fotoArray, $fila["sueldo"]);
                //$empleado = new Empleado($fila["id"], $fila["nombre"], $fila["correo"], $fila["clave"], $fila["id_perfil"], $fila['descripcion'], $fila["foto"], $fila["sueldo"]);        

                $empleados[] = $empleado;
            }    
            return $empleados;
        } else {
            return [];
        }
    }
    

    public function Agregar() {
        $retorno = false;   
        $destinoCarpeta = "./empleados/fotos/";
        $pathImage = $this->foto["name"];
        $destino = $destinoCarpeta . $pathImage;
        $hora_actual = date("His");
        $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
        $destino = $destinoCarpeta . "{$this->nombre}.{$hora_actual}.{$tipoArchivo}";
        move_uploaded_file($this->foto["tmp_name"] , $destino);
        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=usuarios_test","root","");
            $correo = $this->correo;
            $clave = $this->clave;
            $nombre = $this->nombre;
            $id_perfil = $this->id_perfil;
            $sueldo = $this->sueldo;
            $sql = $pdo->prepare("INSERT INTO empleados(correo, clave, nombre, id_perfil, foto, sueldo) VALUES (:correo, :clave, :nombre, :id_perfil, :foto, :sueldo)");
            $sql->bindParam(':correo', $correo, PDO::PARAM_STR,50);
            $sql->bindParam(':clave', $clave, PDO::PARAM_STR,8);
            $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR,30);
            $sql->bindParam(':id_perfil', $id_perfil, PDO::PARAM_INT,10);
            $sql->bindParam(':foto', $destino, PDO::PARAM_STR,50);
            $sql->bindParam(':sueldo', $sueldo, PDO::PARAM_INT);
            $sql->execute();
            $retorno = true;

        }catch(PDOException $e)
        {
            echo $e->getMessage();
            $retorno = false;
        }
        return $retorno;

        // // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        // $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
        // // Verificar si la conexión se estableció correctamente
        // if (!$conexion) {
        //     return false;
        // }
    
        // // Preparar la consulta SQL para agregar un nuevo empleado
        // $consulta = $conexion->prepare("INSERT INTO empleados (nombre, correo, clave, id_perfil, foto, sueldo) VALUES (?, ?, ?, ?, ?, ?)");
    

        // // Generar un nombre único para la imagen
        //     //$nombreImagen = $empleado->nombre . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
            
        //     // Ruta donde se guardará la imagen
        //     //$rutaImagen = './empleados/fotos/' . $nombreImagen;


        //     // Crear una instancia de Empleado
        


        //     // // // Mover la imagen al directorio destino
        //     // if (move_uploaded_file($foto['tmp_name'], $rutaImagen)) {
        //     //     $empleado->foto = $rutaImagen;
        //     //  } else {
        //     //     // Si no se pudo mover la imagen, devolver un error
        //     //     http_response_code(500); // Internal Server Error
        //     //     echo json_encode(['exito' => false, 'mensaje' => 'Error al cargar la imagen']);
        //     //     exit;
        //     // }
        // // Generar el nombre del archivo de la foto (nombre.tipo.hora_min_seg.jpg)
        // $nombreArchivo = $this->nombre . "." . pathinfo($foto['name'], PATHINFO_EXTENSION) . "." . date("His") . ".jpg";
        // var_dump($nombreArchivo);
        // // Mover la foto al directorio especificado
        // $rutaFoto = "../empleados/fotos/" . $nombreArchivo;
        // var_dump($rutaFoto);
        // move_uploaded_file($foto['tmp_name'], $rutaFoto);
    
        // // Vincular los valores de la instancia a los parámetros de la consulta
        // $consulta->bindParam(1, $this->nombre);
        // $consulta->bindParam(2, $this->correo);
        // $consulta->bindParam(3, $this->clave);
        // $consulta->bindParam(4, $this->id_perfil);
        // $consulta->bindParam(5, $nombreArchivo);
        // $consulta->bindParam(6, $this->sueldo);
    
        // // Ejecutar la consulta y verificar si se pudo agregar el empleado
        // if ($consulta->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    

    public function Modificar():bool {
        // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
        // Verificar si la conexión se estableció correctamente
        if (!$conexion) {
            return false;
        }
    
        // Verificar si se proporciona una nueva foto
        if ($this->foto !== null) {
            // Generar el nombre del archivo de la foto (nombre.tipo.hora_min_seg.jpg)
            $nombreArchivo = $this->nombre . "." . pathinfo($this->foto['name'], PATHINFO_EXTENSION) . "." . date("His") . ".jpg";
    
            // Mover la foto al directorio especificado
            $rutaFoto = "../backend/empleados/fotos/" . $nombreArchivo;
            move_uploaded_file($this->foto['tmp_name'], $rutaFoto);
    
            // Actualizar la foto en la base de datos
            $consultaFoto = $conexion->prepare("UPDATE empleados SET foto = ? WHERE id = ?");
            $consultaFoto->bindParam(1, $nombreArchivo);
            $consultaFoto->bindParam(2, $this->id);
            $consultaFoto->execute();
        }
    
        // Preparar la consulta SQL para modificar los demás campos del empleado
        $consulta = $conexion->prepare("UPDATE empleados SET nombre = ?, correo = ?, clave = ?, id_perfil = ?, sueldo = ? WHERE id = ?");
    
        // Vincular los valores de la instancia a los parámetros de la consulta
        $consulta->bindParam(1, $this->nombre);
        $consulta->bindParam(2, $this->correo);
        $consulta->bindParam(3, $this->clave);
        $consulta->bindParam(4, $this->id_perfil);
        $consulta->bindParam(5, $this->sueldo);
        $consulta->bindParam(6, $this->id);
    
        // Ejecutar la consulta y verificar si se pudo modificar el empleado
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public static function Eliminar($id) {

        try
        {
            // Verificar si el ID está vacío o no es un número
            if (empty($id) || !is_numeric($id)) {
                return false;
            }
            
            $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
            
            // Verificar si la conexión se estableció correctamente
            if (!$conexion) {
                return false;
            }

            // Verificar si el usuario con el ID existe
            $consulta = $conexion->prepare("SELECT COUNT(*) FROM empleados WHERE id = :id");
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
            $existeUsuario = $consulta->fetchColumn() > 0;
            
            if ($existeUsuario) {
                // Si el usuario con el ID existe, eliminarlo
                $consulta = $conexion->prepare("DELETE FROM empleados WHERE id = :id");
                $consulta->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado = $consulta->execute();
                
                // Verificar si se eliminó con éxito o no
                return $resultado;
            } else {
                // Si el usuario con el ID no existe, devolver false
                return false;
            }
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }        
        catch(PDOException $e)
        {
            return false;
        }    
        
        // catch(PDOException $e)
        // {
        //     return false;
        // }
        // // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        // $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
        // // Verificar si la conexión se estableció correctamente
        // if (!$conexion) {
        //     return false;
        // }
    
        // // Preparar la consulta SQL para eliminar el empleado por su ID
        // $consulta = $conexion->prepare("DELETE FROM empleados WHERE id = ?");
    
        // // Vincular el valor del ID al parámetro de la consulta
        // $consulta->bindParam(1, $id);
    
        // // Ejecutar la consulta y verificar si se pudo eliminar el empleado
        // if ($consulta->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    
}
?>
