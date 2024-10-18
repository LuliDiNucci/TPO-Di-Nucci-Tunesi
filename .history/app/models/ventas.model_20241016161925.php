<?php
//require_once '../tpe/config.php';

class VentasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        //$this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy();
    }
  /*  private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE IF NOT EXIST ventas (
                id_venta INT AUTO_INCREMENT PRIMARY KEY,
                clave_foranea INT NOT NULL,
                fecha_compra DATE NOT NULL,
                monto INT NOT NULL,
                producto VARCHAR NOT NULL,);
            CREATE TABLE IF NOT EXISTE cliente(
                id_venta INT AUTO_INCREMENT PRIMARY KEY,
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

    public function insertVenta($claveForanea, $monto, $producto, $importado)
    {
        try {
            $query = $this->db->prepare('INSERT INTO ventas(clave_foranea, monto, producto, importado) VALUES (?, ?, ?, ?)');
            $query->execute([$claveForanea, $monto, $producto, $importado]);
    
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