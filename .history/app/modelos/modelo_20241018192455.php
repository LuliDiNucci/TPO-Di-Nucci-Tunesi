<?php
abstract class Modelo
{
    protected $db;

    public function __construct()
    {
        try {
            // Primero conectamos sin especificar base de datos
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );
            
            // Creamos la base de datos si no existe
            $this->_deploy();
            
            // Reconectamos especificando la base de datos
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . 
                ";dbname=" . MYSQL_DB . 
                ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );
            
            // Configuramos PDO para que lance excepciones en caso de errores
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    protected function _deploy()
    {
        try {
            $sql = "CREATE DATABASE IF NOT EXISTS " . MYSQL_DB;
            $this->db->exec($sql);
            
            // Aquí puedes agregar la creación de tablas si lo necesitas
            $this->_createTables();
            
        } catch (PDOException $e) {
            die("Error creando la base de datos: " . $e->getMessage());
        }
    }
    
    protected abstract function _createTables();
}