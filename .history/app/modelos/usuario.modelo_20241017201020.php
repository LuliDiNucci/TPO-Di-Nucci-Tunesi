<?php
require_once 'modelo.php';
require_once 'config.php';

class ModeloUsuario extends Modelo{
    public function _deploy()
    {
        $query= $this->db->query('SHOW TABLES LIKE\'usuario\'');
        $tablas=$query->fetchAll();

            if(count($tablas)==0){
                $usuarios = [
                    ['usuario' => 'webadmin', 'contrasenia' => 'Admin1229']
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
                $insertarSql="INSERT INTO usuario(nombre,password) values(?,?)";
                $sentencia= $this->db->prepare($insertarSql);

                foreach ($usuarios as $usuario){
                    $sentencia->execute([
                        $usuario['nombre'],
                        password_hash($usuario['constra'], PASSWORD_DEFAULT)
                    ]);
                }
            
        }
    }
    public function obetenerUsuarioPorNombre($nombre){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute(params: [$nombre]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;

    }


}
