<?php

require_once 'model.php';
require_once 'config.php';


class VentasModel extends Model
{
    public function _deploy()
    {
    $query= $this->db->query('SHOW TABLES LIKE\'ventas\'');
    $tables=$query->fetchAll();

        if(count($tables)==0){
            $ventas = [ /*(14, 46555898, 'Maria Florencia Miguens', 556688, 'florenciamiguens@gmail.com', '2014-10-08', 'https://weremote.net/habitos-mujer-exitosa/'),
                (15, 38759465, 'Pedro Gonzales', 779635, 'pedrogonzales@gmail.com', '2014-10-05', 'https://unsplash.com/es/s/fotos/hombre-joven'),
                (16, 35648965, 'Sofia Pereyra', 541235, 'sofiap@gmail.com', '2014-10-06', 'https://www.telva.com/bienestar/relaciones/2023/03/05/64043c3102136ef87c8b45b9.html'),
                (17, 41235698, 'Lucia Rodriguez', 458976, 'luciarodriguez@gmail.com', '2014-10-08', 'https://stock.adobe.com/ar/search?k=%22mujer%20de%20color%22'),
                (18, 29564879, 'Rodrigo Martinez', 548796, 'rodrigom20@gmail.com', '2024-10-01', 'https://www.revistagq.com/cuidados/articulo/como-ser-un-hombre-mejor-mas-feliz-octavio-salazar');
                 */
                ['dni' => '46555898', 'nombre' => 'Maria Florencia Miguens', 'telefono' => '556688', 'mail' => 'florenciamiguens@gmail.com', 'fecha_compra' =>'2014-10-08', 'imagen' => 'https://weremote.net/wp-content/uploads/2022/08/mujer-sonriente-apunta-arriba-1536x1024.jpg']
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