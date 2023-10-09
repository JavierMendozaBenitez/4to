<?php
    namespace Mendoza;

    class Alumno_pdo {
        private $db;
    
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function agregar_bd($legajo, $apellido, $nombre, $foto) {
            $stmt = $this->db->prepare("INSERT INTO alumnos (legajo, apellido, nombre, foto) VALUES (?, ?, ?, ?)");
            $stmt->execute([$legajo, $apellido, $nombre, $foto]);
        }
    
        public function listar_bd() {
            $stmt = $this->db->query("SELECT * FROM alumnos");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    
        public function obtener_bd($id) {
            $stmt = $this->db->prepare("SELECT * FROM alumnos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    
        public function modificar_bd($id, $legajo, $apellido, $nombre, $foto) {
            $stmt = $this->db->prepare("UPDATE alumnos SET legajo = ?, apellido = ?, nombre = ?, foto = ? WHERE id = ?");
            $stmt->execute([$legajo, $apellido, $nombre, $foto, $id]);
        }
    
        public function borrar_bd($id) {
            $stmt = $this->db->prepare("DELETE FROM alumnos WHERE id = ?");
            $stmt->execute([$id]);
        }
    
        public function redirigir_bd($url) {
            header("Location: $url");
            exit();
        }
    }
    
    try {        
        $db = new \PDO("mysql:host=localhost;dbname=alumno_pdo", "root", "");
        $alumno_pdo = new Alumno_pdo($db);
    } catch (\PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
    ?>
    