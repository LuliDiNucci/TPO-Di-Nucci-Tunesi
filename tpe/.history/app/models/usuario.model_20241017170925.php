<?php

require_once 'model.php';
require_once 'config.php';

class UsuarioModel extends model{
    $query= $this->db->query('SHOW TABLES LIKE\'usuario'\'');
    $tables=$query->fetchAll();

    if(count($tables)==0){
        $usuarios = [
            ['usuario' => 'webadmin, 'password' => 'Admin1229']
        ];
    }
    public function getUsuarioByNombre($nombre){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute(params: [$nombre]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;

    }


}
