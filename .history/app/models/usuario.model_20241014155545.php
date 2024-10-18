<?php

//require_once '../tpe/config.php';
class UsuarioModel{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        //$this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy();
    }

    /*private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE IF NOT EXISTS ventas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                clave_foranea INT NOT NULL,
                fecha_compra DATE NOT NULL,
                monto INT NOT NULL,
                producto VARCHAR NOT NULL,);
            CREATE TABLE IF NOT EXISTS cliente(
                id INT AUTO_INCREMENT PRIMARY KEY,
                dni INT NOT NULL,
                nombre VARCHAR NOT NULL,
                telefono INT NOT NULL,
                mail VARCHAR NOT NULL,
                fecha de nacimiento DATE NOT NULL
              )
            END;
            
        } //A CHEQUEAR
            $this->db->query($sql);
    }*/

    public function getUsuarioByDni($dni){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE dni = ?");
        $query->execute(params: [$dni]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;

    }


}
