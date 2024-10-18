<?php
require_once "config.php";
class Modelo
{
    protected $db;

    public function __construct()
    {
        
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
            ";dbname=" . MYSQL_DB .
            ";charset=utf8", 
            MYSQL_USER, 
            MYSQL_PASS);
        $this->_deploy();
    }
    protected function _deploy(){
        $sql = <<<SQL
                    CREATE DATABASE IF NOT EXISTS compras;
        SQL;
        
    }
}
