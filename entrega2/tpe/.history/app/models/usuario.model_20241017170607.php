<?php

require_once 'model.php';
require_once 'config.php';
class UsuarioModel{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        //$this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy();
    }
    public function getUsuarioByNombre($nombre){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute(params: [$nombre]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;

    }


}
