<?php

require_once('IBM.php');

class Usuario implements IBM{
    public int $id;
    public string $nombre;
    public string $correo;
    public string $clave;
    public int $id_perfil;
    public string $perfil;

    public function __construct(int $id, string $nombre, string $correo, string $clave, int $id_perfil, string $perfil) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->id_perfil = $id_perfil;
        $this->perfil = $perfil;
    }

    public function ToJSON() {
        $userData = [
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'clave' => $this->clave
        ];

        return json_encode($userData);
    }

    public function GuardarEnArchivo() {
        // Ruta del archivo JSON
        $archivo = '../backend/archivos/usuarios.json';
    
        // Leer el contenido actual del archivo
        $contenidoActual = file_get_contents($archivo);
    
        // Convertir el contenido a un array (si existe)
        $usuarios = json_decode($contenidoActual, true);
    
        if (!$usuarios) {
            $usuarios = []; // Inicializar el array si el archivo está vacío o no es un JSON válido.
        }
    
        // Obtener la representación JSON del usuario actual utilizando ToJSON()
        $usuarioJSON = $this->ToJSON();
    
        // Decodificar el JSON y agregarlo al array de usuarios
        $usuarios[] = json_decode($usuarioJSON, true);
    
        // Convertir el array de usuarios a JSON
        $nuevoContenido = json_encode($usuarios);
    
        // Guardar el nuevo contenido en el archivo
        $resultado = file_put_contents($archivo, $nuevoContenido);
    
        if ($resultado !== false) {
            $respuesta = [
                'exito' => true,
                'mensaje' => 'Usuario agregado correctamente.'
            ];
        } else {
            $respuesta = [
                'exito' => false,
                'mensaje' => 'Error al agregar el usuario.'
            ];
        }
    
        return json_encode($respuesta);
    }

    public static function TraerTodosJSON() {
        // Ruta del archivo JSON
        $archivo = '../backend/archivos/usuarios.json';
    
        // Leer el contenido actual del archivo
        $contenidoActual = file_get_contents($archivo);
    
        // Decodificar el JSON a un array de usuarios
        $usuariosArray = json_decode($contenidoActual, true);
    
        if (!$usuariosArray) {
            return []; // Si no hay usuarios, retorna un array vacío.
        }
    
        // Crear un array de objetos Usuario a partir del array de usuarios
        $usuarios = [];
        foreach ($usuariosArray as $userData) {
            //$usuario = new Usuario();
            // $usuario->nombre = $userData['nombre'];
            // $usuario->correo = $userData['correo'];
            // $usuario->clave = $userData['clave'];

            $id = isset($userData['id']) ? $userData['id'] : 0; // Valor predeterminado 0 si no hay 'id'
            $nombre = isset($userData['nombre']) ? $userData['nombre'] : '';
            $correo = isset($userData['correo']) ? $userData['correo'] : '';
            $clave = isset($userData['clave']) ? $userData['clave'] : '';
            $id_perfil = isset($userData['id_perfil']) ? $userData['id_perfil'] : 0; // Valor predeterminado 0 si no hay 'id_perfil'
            $perfil = isset($userData['perfil']) ? $userData['perfil'] : '';

            $usuario = new Usuario($id, $nombre, $correo, $clave, $id_perfil, $perfil);
        
            //$usuario = new Usuario($userData['id'], $userData['nombre'], $userData['correo'], $userData["clave"], $userData["id_perfil"], $userData["perfil"]);
                
            $usuarios[] = $usuario;
        }
    
        return $usuarios;
    }

    public function Agregar() {
        // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
        // Verificar si la conexión se estableció correctamente
        if (!$conexion) {
            return false;
        }
    
        // Preparar la consulta SQL para insertar un nuevo usuario
        $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, correo, clave, id_perfil) VALUES (?, ?, ?, ?)");
    
        // Vincular los valores de la instancia a los parámetros de la consulta
        $consulta->bindParam(1, $this->nombre);
        $consulta->bindParam(2, $this->correo);
        $consulta->bindParam(3, $this->clave);
        $consulta->bindParam(4, $this->id_perfil);
    
        // Ejecutar la consulta y verificar si se pudo agregar el usuario
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function TraerTodos() {
        // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
        $conexion = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
        // Verificar si la conexión se estableció correctamente
        if (!$conexion) {
            return [];
        }
    
        // Preparar la consulta SQL para obtener todos los usuarios con la descripción del perfil
        $consulta = $conexion->prepare("SELECT usuarios.id, usuarios.nombre, usuarios.correo, usuarios.clave, usuarios.id_perfil, perfiles.descripcion as perfil
                                         FROM usuarios
                                         INNER JOIN perfiles ON usuarios.id_perfil = perfiles.id");
    
        // Ejecutar la consulta
        if ($consulta->execute()) {
            // Obtener los resultados de la consulta
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
            // Crear un array para almacenar los objetos Usuario
            $usuarios = [];
    
            foreach ($resultados as $fila) {
                // $usuario = new Usuario();
                // $usuario->id = $fila['id'];
                // $usuario->nombre = $fila['nombre'];
                // $usuario->correo = $fila['correo'];
                // $usuario->clave = $fila['clave'];
                // $usuario->id_perfil = $fila['id_perfil'];
                // $usuario->perfil = $fila['perfil'];
                $usuario = new Usuario($fila["id"], $fila["nombre"], $fila["correo"], $fila["clave"], $fila["id_perfil"], $fila['perfil']);
                                    
                $usuarios[] = $usuario;
            }
    
            return $usuarios;
        } else {
            return [];
        }
    }
    public static function TraerUno($params) : ?Usuario
    {
        $usuario = null; 

        try
        {
            $params = json_decode($params);
            $correo = $params[0];
            $clave = $params[1];
            $pdo = new PDO("mysql:host=localhost;dbname=usuarios_test","root","");
            $sql = $pdo->prepare("SELECT * FROM usuarios 
            INNER JOIN perfiles ON usuarios.id_perfil = perfiles.id WHERE correo = :correo AND clave = :clave");
            $sql->bindParam(':correo', $correo, PDO::PARAM_STR,50); 
            $sql->bindParam(':clave', $clave, PDO::PARAM_STR,8); 
            $sql->execute();
            $fila = $sql->fetch();
            
            if ($fila !== false)
            {
                $usuario = new Usuario($fila["id"], $fila["nombre"], $fila["correo"], $fila["clave"], $fila["id_perfil"], $fila["descripcion"]);
            }
        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $usuario;
    }

    public function Modificar() : bool {
        $retorno = false;
        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=usuarios_test","root","");
            $sql = $pdo->prepare("UPDATE usuarios SET correo = :correo, clave = :clave, nombre = :nombre, id_perfil = :id_perfil WHERE id = :id");
            $sql->bindParam(':id', $this->id, PDO::PARAM_INT);
            $sql->bindParam(':correo', $this->correo, PDO::PARAM_STR,50); 
            $sql->bindParam(':clave', $this->clave, PDO::PARAM_STR,8); 
            $sql->bindParam(':nombre', $this->nombre, PDO::PARAM_STR,30);
            $sql->bindParam(':id_perfil', $this->id_perfil, PDO::PARAM_INT,10);
            $sql->execute(); 
            $retorno = true;

        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $retorno;
    }
    
    
    public static function Eliminar($id)
    {
        try
        {
            // Verificar si el ID está vacío o no es un número
            if (empty($id) || !is_numeric($id)) {
                return false;
            }
            
            $pdo = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
            
            // Verificar si el usuario con el ID existe
            $sql = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE id = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            $existeUsuario = $sql->fetchColumn() > 0;
            
            if ($existeUsuario) {
                // Si el usuario con el ID existe, eliminarlo
                $sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
                $sql->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado = $sql->execute();
                
                // Verificar si se eliminó con éxito o no
                return $resultado;
            } else {
                // Si el usuario con el ID no existe, devolver false
                return false;
            }
        }
        catch(PDOException $e)
        {
            return false;
        }
    }


    // public static function Eliminar($id): bool {
    //     // Crear una conexión PDO a la base de datos usuarios_test (debes configurar la conexión previamente)
    //     $pdo = new PDO("mysql:host=localhost;dbname=usuarios_test", "root", "");
    
    //     // Verificar si la conexión se estableció correctamente
    //     if (!$pdo) {
    //         return false;
    //     }
    
    //     // Preparar la consulta SQL para eliminar un usuario por su ID
    //     $consulta = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    
    //     // Vincular el valor del ID a los parámetros de la consulta
    //     //$consulta->bindParam(1, $id);
    //     $consulta->bindParam(':id', $id, PDO::PARAM_INT);
    
    //     // Ejecutar la consulta y verificar si se pudo eliminar el usuario
    //     if ($consulta->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    

}