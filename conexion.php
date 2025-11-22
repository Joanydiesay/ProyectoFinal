<?php
// Verifica si la clase Conexion ya está definida
if (!class_exists('Conexion')) {
    class Conexion {
        private $cn = null;

        public function conecta() {
            if ($this->cn === null) {
                try {
                    $this->cn = new PDO("mysql:host=localhost:3307;dbname=tienanitabd", "root", "");
                    $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Error de conexión: " . $e->getMessage());
                }
            }
            return $this->cn;
        }
    }
}
// Crear una función global para reutilizar
if (!function_exists('getConexion')) {
    function getConexion() {
        static $conexion = null;

        if ($conexion === null) {
            $objConexion = new Conexion();
            $conexion = $objConexion->conecta();
        }

        return $conexion;
    }
}

// Ejemplo de uso:
$conn = getConexion();
?>
