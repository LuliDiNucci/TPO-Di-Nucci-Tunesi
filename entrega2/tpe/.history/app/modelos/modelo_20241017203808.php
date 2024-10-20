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
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_deploy();
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    abstract protected function _deploy();
}