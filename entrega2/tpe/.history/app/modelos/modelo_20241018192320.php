<?php
require_once "config.php";

abstract class Modelo
{
    protected $db;

    public function __construct()
    {
        try {
            // Conectarse al servidor MySQL sin especificar una base de datos
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";charset=utf8", 
                MYSQL_USER, 
                MYSQL_PASS
            );

            // Crear la base de datos si no existe
            $this->_deploy();

            // Reconectar a la base de datos recién creada
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . 
                ";dbname=" . MYSQL_DB . 
                ";charset=utf8", 
                MYSQL_USER, 
                MYSQL_PASS
            );
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    protected function _deploy()
    {
        $sql = <<<SQL
            CREATE DATABASE IF NOT EXISTS compras;
        SQL;

        if ($this->db) {
            $this->db->exec($sql); // Usar exec para ejecutar la consulta
        } else {
            throw new Exception("No se pudo conectar a la base de datos.");
        }
    }
}

