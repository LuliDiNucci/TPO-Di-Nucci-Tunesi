<?php
require_once 'model.php';
require_once 'config.php';

class VentasModel extends Model
{
    protected function _deploy()
    {
        $query = $this->db->query('SHOW TABLES LIKE\'ventas\'');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            $ventas = [
                ['clave_foranea' => '17', 'fecha_compra' => '2024-10-17 17:38:24', 'monto' => '175000', 'producto' => 'Olympea', 'importado' => '0'],
                ['clave_foranea' => '17', 'fecha_compra' => '2024-10-17 17:38:24', 'monto' => '175000', 'producto' => 'Olympea', 'importado' => '0'],
                ['clave_foranea' => '14', 'fecha_compra' => '2024-10-17 22:39:21', 'monto' => '223740', 'producto' => 'good girl carolina herrera', 'importado' => '1'],
                ['clave_foranea' => '15', 'fecha_compra' => '2024-10-17 22:39:57', 'monto' => '185900', 'producto' => 'Giorgio Armani', 'importado' => '1'],
                ['clave_foranea' => '15', 'fecha_compra' => '2024-10-17 22:40:25', 'monto' => '161100', 'producto' => 'Emporio She- Giorgio Armani', 'importado' => '0'],
                ['clave_foranea' => '18', 'fecha_compra' => '2024-10-17 22:40:50', 'monto' => '166789', 'producto' => 'Gentelman Society- Giorgio Armani', 'importado' => '1'],
                ['clave_foranea' => '16', 'fecha_compra' => '2024-10-17 22:41:23', 'monto' => '153500', 'producto' => 'Chance- Chanel', 'importado' => '1'],
                ['clave_foranea' => '16', 'fecha_compra' => '2024-10-17 22:41:50', 'monto' => '154615', 'producto' => 'Flower by kenzo', 'importado' => '1']

            ];
            $sql = <<<SQL
                CREATE TABLE `ventas` (
                        `id_venta` int(11) NOT NULL,
                        `clave_foranea` int(11) NOT NULL,
                        `fecha_compra` datetime NOT NULL,
                        `monto` int(255) NOT NULL,
                        `producto` varchar(255) NOT NULL,
                        `Importado` tinyint(1) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
            SQL;
            $this->db->query($sql);
            $insertSql = "INSERT INTO ventas (clave_foranea, fecha_compra, monto, producto, importado) values(?,?,?,?,?)";
            $statement = $this->db->prepare($insertSql);
            foreach ($ventas as $venta) {
                $statement->execute([
                    $venta['clave_foranea'],
                    $venta['fecha_compra'],
                    $venta['monto'],
                    $venta['producto'],
                    $venta['importado']
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

    public function eraseVenta($id_venta)
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
