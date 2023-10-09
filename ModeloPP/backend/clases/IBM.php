<?php

// Define la interfaz IBM
interface IBM {
    // Método para modificar un registro en la base de datos
    public function Modificar();
    
    // Método estático para eliminar un registro por ID
    public static function Eliminar($id);
}

?>
