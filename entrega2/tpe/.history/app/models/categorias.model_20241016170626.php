<?php

//require_once '../tpe/config.php';
class CategoriasModel
{
    private $db;

    public function __construct()
    {
        $this->db = $db;
       // $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        // $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy();
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
