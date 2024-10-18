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
            $ventas = [         
                ['dni' => '46555898', 'nombre' => 'Maria Florencia Miguens', 'telefono' => '556688', 'mail' => 'florenciamiguens@gmail.com', 'fecha_compra' =>'2014-10-08', 'imagen' => 'https://weremote.net/wp-content/uploads/2022/08/mujer-sonriente-apunta-arriba-1536x1024.jpg'],
                ['dni' => '38759465', 'nombre' => 'Pedro Gonzales', 'telefono' => '779635', 'mail' => 'pedrogonzales@gmail.com', 'fecha_compra' => '2014-10-05', 'imagen' => 'https://plus.unsplash.com/premium_photo-1682096259050-361e2989706d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
                ['dni' => '35648965', 'nombre' => 'Sofia Pereyra', 'telefono' => '541235', 'mail' => 'sofiap@gmail.com', 'fecha_compra' => '2014-10-06', 'imagen' => 'https://phantom-telva.unidadeditorial.es/9132d2a2c7abb6ab7cf099d4af093fa6/resize/1280/f/webp/assets/multimedia/imagenes/2023/03/05/16780029716658.jpg'],
                ['dni' => '41235698', 'nombre' => 'Lucia Rodriguez', 'telefono' => '458976', 'mail' => 'luciarodriguez@gmail.com', 'fecha_compra' => '2014-10-08', 'imagen' => 'https://as1.ftcdn.net/v2/jpg/06/02/06/62/1000_F_602066201_4zhQhDW6qVGqTQSaPmZzPfxKwQCEL3Kt.jpg'],
                ['dni' => '29564879', 'nombre' => 'Rodrigo Martinez', 'telefono' => '548796', 'mail' => 'rodrigom20@gmail.com', 'fecha_compra' => '2024-10-01', 'imagen' => 'https://media.revistagq.com/photos/6008111d0c66a2a0f048c638/16:9/w_1600,c_limit/chris-hemsworth.jpg']
                
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