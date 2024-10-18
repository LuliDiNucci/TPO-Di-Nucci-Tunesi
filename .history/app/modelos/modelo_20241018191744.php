<?php
require_once "config.php";
class Modelo
{
    protected $db;
    public function __construct()
    {
    // Conectarse al servidor MySQL sin especificar una base de datos
    $this->db = new PDO(
        "mysql:host=" . MYSQL_HOST . ";charset=utf8", 
        MYSQL_USER, 
        MYSQL_PASS
    );
    
    // Crear la base de datos si no existe
    $this->_deploy();

    // Conectarse a la base de datos recién creada
    $this->db = new PDO(
        "mysql:host=" . MYSQL_HOST . 
        ";dbname=" . MYSQL_DB . 
        ";charset=utf8", 
        MYSQL_USER, 
        MYSQL_PASS
    );
}

protected function _deploy()
{
    $sql = <<<SQL
        CREATE DATABASE IF NOT EXISTS compras;
    SQL;
    $this->db->exec($sql); // Usar exec para ejecutar la consulta
}
}
