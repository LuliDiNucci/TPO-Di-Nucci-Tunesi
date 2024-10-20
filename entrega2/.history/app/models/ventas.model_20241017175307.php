<?php

require_once 'model.php';
require_once 'config.php';


    /**
     * Summary of __construct
     */
{
    public function _deploy()
    {
    $query= $this->db->query('SHOW TABLES LIKE\'ventas\'');
    $tables=$query->fetchAll();

        if(count($tables)==0){
            $ventas = [         
                ['clave_foranea' => '17', 'fecha_compra' => '2024-10-17 17:38:24', 'monto' => '175000', 'producto' => 'Olympea', 'importado' =>'0'],
                /*(24, 17, '2024-10-17 17:38:02', 220000, 'La vie est belle', 0),
(25, 17, '2024-10-17 17:38:24', 175000, 'Olympea', 0),
(26, 14, '2024-10-17 22:39:21', 223740, 'good girl carolina herrera', 1),
(27, 15, '2024-10-17 22:39:57', 185900, 'Giorgio Armani', 1),
(28, 15, '2024-10-17 22:40:25', 161100, 'Emporio She- Giorgio Armani', 0),
(29, 18, '2024-10-17 22:40:50', 166789, 'Gentelman Society- Giorgio Armani', 1),
(30, 16, '2024-10-17 22:41:23', 153500, 'Chance- Chanel', 1),
(31, 16, '2024-10-17 22:41:50', 154615, 'Flower by kenzo', 1); */
                
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
    public function getVentas()
    {
        $query = $this->db->prepare('SELECT * FROM ventas');
        $query->execute();

        $ventas = $query->fetchAll(PDO::FETCH_OBJ);

        return $ventas;
    }

    public function getVenta($id_venta)
    {
        $query = $this->db->prepare('SELECT * FROM ventas WHERE id_venta = ?');
        $query->execute([$id_venta]);

        $venta = $query->fetch(PDO::FETCH_OBJ);

        return $venta;
    }

    public function insertVenta($claveForanea, $fechaCompra, $monto, $producto, $importado)
    {
        try {
            $query = $this->db->prepare('INSERT INTO ventas(clave_foranea, fecha_compra, monto, producto, importado) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$claveForanea, $fechaCompra, $monto, $producto, $importado]);
    
            $id_venta = $this->db->lastInsertId();
    
            return $id_venta;
        } catch (PDOException $e) {
            echo 'Error al insertar venta: ' . $e->getMessage();
            return false; 
        }
    }    

    public function eraseVenta($id_venta, $res)
    {
        $query = $this->db->prepare('DELETE FROM ventas WHERE id_venta = ?');
        $query->execute([$id_venta]);
        
    }


    public function updateVenta($id_venta, $fecha_compra, $monto, $producto, $importado)
    {
        $query = $this->db->prepare('UPDATE ventas SET fecha_compra = ?, monto = ?, producto = ?, importado = ? WHERE id_venta = ?');
        $query->execute([$fecha_compra, $monto, $producto, $importado, $id_venta]);
    }
    

}