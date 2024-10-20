<?php
require_once 'model.php';
require_once 'config.php';

class UsuarioModel extends Model{
    public function _deploy()
    {
        $query= $this->db->query('SHOW TABLES LIKE\'usuario\'');
        $tables=$query->fetchAll();

            if(count($tables)==0){
                $usuarios = [
                    ['usuario' => 'webadmin', 'password' => 'Admin1229']
                ];
                $sql = <<<SQL
                CREATE TABLE `usuario` (
                            `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(50) NOT NULL,
                            `contrasena` varchar(500) NOT NULL,
                            PRIMARY KEY (`id_usuario`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                SQL;
                $this->db->query($sql);
                $insertSql="INSERT INTO usuario(user,password) values(?,?)";
                $statement= $this->db->prepare($insertSql);
                
                foreach ($usuarios as $usuario){
                    $statement->execute([
                        $usuario['user'],
                        password_hash($usuario['password'], PASSWORD_DEFAULT)
                    ]);
                }
            
        }
    }
    public function getUsuarioByNombre($nombre){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute(params: [$nombre]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;

    }


}
