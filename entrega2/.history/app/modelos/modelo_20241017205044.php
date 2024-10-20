<?php
require_once 'config.php';

abstract class Modelo {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . 
                ";dbname=" . MYSQL_DB . 
                ";charset=utf8", 
                MYSQL_USER, 
                MYSQL_PASS
            );
            $this->db->exec("CREATE DATABASE IF NOT EXISTS " . MYSQL_DB . " CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
        // Conectarse a la nueva base de datos
        $this->db->exec("USE " . MYSQL_DB);
        // Ahora que la base de datos existe, podrías ejecutar el contenido del archivo compras.sql o usar consultas SQL como en _deploy().
    }
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_deploy();
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    abstract protected function _deploy();
}