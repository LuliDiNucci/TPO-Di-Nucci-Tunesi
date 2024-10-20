<?php
require_once 'modelo.php';
require_once 'config.php';

class ModeloUsuario extends Modelo
{
    public function _deploy()
    {
        $query = $this->db->query('SHOW TABLES LIKE \'usuario\'');
        $tablas = $query->fetchAll();

        if (count($tablas) == 0) {
            $usuarios = [
                ['id_usuario'=>'1', nombre' => 'webadmin', 'contrasena' => 'Admin1229']
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

            $insertarSql = "INSERT INTO usuario(nombre,contrasena) VALUES (?, ?)";
            $sentencia = $this->db->prepare($insertarSql);

            foreach ($usuarios as $usuario) {
                $sentencia->execute([
                    $usuario['nombre'],
                    password_hash($usuario['contrasena'], PASSWORD_DEFAULT)
                ]);
            }
        }
        $check = $this->db->query("SELECT * FROM usuario");
        var_dump($check->fetchAll());
    }

    public function obtenerUsuarioPorNombre($nombre, $contrasena)
    {
        // Buscar el usuario por su nombre
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute([$nombre]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);

        return $usuario;
    }
    
}
