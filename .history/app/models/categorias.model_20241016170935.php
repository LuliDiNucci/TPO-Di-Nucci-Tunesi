<?php

//require_once '../tpe/config.php';
class CategoriasModel
{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(PDO::FETCH_COLUMN);

        if (count($tables) == 0) {
            $sqlClientes = "
                CREATE TABLE `clientes` (
                    `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
                    `dni` int(10) NOT NULL,
                    `nombre` varchar(100) NOT NULL,
                    `telefono` int(50) NOT NULL,
                    `mail` varchar(100) NOT NULL,
                    `fecha_nacimiento` date NOT NULL,
                    `imagen` varchar(200) NOT NULL,
                    PRIMARY KEY (`id_categoria`),
                    UNIQUE KEY `dni` (`dni`),
                    UNIQUE KEY `mail` (`mail`),
                    UNIQUE KEY `telefono` (`telefono`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
            ";
            $this->db->exec($sqlClientes);
        }

        if (count($tables) == 0) {
            $sqlUsuario = "
                CREATE TABLE `usuario` (
                    `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(50) NOT NULL,
                    `contrasena` varchar(500) NOT NULL,
                    PRIMARY KEY (`id_usuario`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            ";
            $this->db->exec($sqlUsuario);
        }

        if (count($tables) == 0) {
            $sqlVentas = "
                CREATE TABLE `ventas` (
                    `id_venta` int(11) NOT NULL AUTO_INCREMENT,
                    `clave_foranea` int(11) NOT NULL,
                    `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
                    `monto` int(255) NOT NULL,
                    `producto` varchar(255) NOT NULL,
                    `Importado` tinyint(1) NOT NULL,
                    PRIMARY KEY (`id_venta`),
                    KEY `clave foranea` (`clave_foranea`),
                    CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`clave_foranea`) REFERENCES `clientes` (`id_categoria`) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
            ";
            $this->db->exec($sqlVentas);
        }
    }

    public function getCategorias()
    {
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();

        $clientes = $query->fetchAll(PDO::FETCH_OBJ);

        return $clientes;
    }

    public function getCategoria($id_categoria)
    {
        $query = $this->db->prepare('SELECT * FROM clientes WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        $cliente = $query->fetch(PDO::FETCH_OBJ);

        return $cliente;
    }
    public function getVentasCategoria($id_categoria)
    {
        $query = $this->db->prepare('
        SELECT ventas.*
        FROM ventas
        INNER JOIN clientes ON ventas.clave_foranea = clientes.id_categoria
        WHERE clientes.id_categoria = ?');
        $query->execute([$id_categoria]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertCategoria($dni, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen)
    {
        $query = $this->db->prepare('INSERT INTO clientes(nombre, dni, telefono, mail, fecha_nacimiento, imagen) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$nombre, $dni, $telefono, $mail, $fecha_nacimiento, $imagen]);

        $id_categoria = $this->db->lastInsertId();

        return $id_categoria;
    }

    public function eraseCategoria($id_categoria)
    {
        $query = $this->db->prepare('DELETE FROM clientes WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    public function updateCategoria($id_categoria, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen)
    {
        $query = $this->db->prepare('UPDATE clientes SET nombre = ?, telefono = ?, mail = ?, fecha_nacimiento = ?, imagen = ? WHERE id_categoria = ?');
        $query->execute([$nombre, $telefono, $mail, $fecha_nacimiento, $imagen, $id_categoria]);
    }

    public function getClienteByid_categoria($id_categoria)
    {
        $query = $this->db->prepare("SELECT * FROM clientes WHERE id_categoria = ?");
        $query->execute([$id_categoria]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
