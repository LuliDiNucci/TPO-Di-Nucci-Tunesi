<?php

//require_once '../tpe/config.php';
class CategoriasModel
{
    private $db;
/* ['dni' => '46555898', 'nombre' => 'Maria Florencia Miguens', 'telefono' => '556688', 'mail' => 'florenciamiguens@gmail.com', 'fecha_compra' =>'2014-10-08', 'imagen' => 'https://weremote.net/wp-content/uploads/2022/08/mujer-sonriente-apunta-arriba-1536x1024.jpg'],
                ['dni' => '38759465', 'nombre' => 'Pedro Gonzales', 'telefono' => '779635', 'mail' => 'pedrogonzales@gmail.com', 'fecha_compra' => '2014-10-05', 'imagen' => 'https://plus.unsplash.com/premium_photo-1682096259050-361e2989706d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
                ['dni' => '35648965', 'nombre' => 'Sofia Pereyra', 'telefono' => '541235', 'mail' => 'sofiap@gmail.com', 'fecha_compra' => '2014-10-06', 'imagen' => 'https://phantom-telva.unidadeditorial.es/9132d2a2c7abb6ab7cf099d4af093fa6/resize/1280/f/webp/assets/multimedia/imagenes/2023/03/05/16780029716658.jpg'],
                ['dni' => '41235698', 'nombre' => 'Lucia Rodriguez', 'telefono' => '458976', 'mail' => 'luciarodriguez@gmail.com', 'fecha_compra' => '2014-10-08', 'imagen' => 'https://as1.ftcdn.net/v2/jpg/06/02/06/62/1000_F_602066201_4zhQhDW6qVGqTQSaPmZzPfxKwQCEL3Kt.jpg'],
                ['dni' => '29564879', 'nombre' => 'Rodrigo Martinez', 'telefono' => '548796', 'mail' => 'rodrigom20@gmail.com', 'fecha_compra' => '2024-10-01', 'imagen' => 'https://media.revistagq.com/photos/6008111d0c66a2a0f048c638/16:9/w_1600,c_limit/chris-hemsworth.jpg']
                 */
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
        // $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy();
    }
    /* private function _deploy()
     {
         $query = $this->db->query('SHOW TABLES');
         $tables = $query->fetchAll();
         if (count($tables) == 0) {
             $sql = <<<END
             CREATE TABLE IF NOT EXIST ventas (
                 id_categoria INT AUTO_INCREMENT PRIMARY KEY,
                 clave_foranea INT NOT NULL,
                 fecha_compra DATE NOT NULL,
                 monto INT NOT NULL,
                 producto VARCHAR NOT NULL,);
             CREATE TABLE IF NOT EXISTE cliente(
                 id_categoria INT AUTO_INCREMENT PRIMARY KEY,
                 dni INT NOT NULL,
                 nombre VARCHAR NOT NULL,
                 telefono INT NOT NULL,
                 mail VARCHAR NOT NULL,
                 fecha de nacimiento DATE NOT NULL
               )
             END;
             
         } //A CHEQUEAR
             $this->db->query($sql);
 */
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
}
