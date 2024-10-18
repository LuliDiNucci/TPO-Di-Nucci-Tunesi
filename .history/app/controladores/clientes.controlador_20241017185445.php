<?php
require_once '../tpe/app/models/categorias.model.php';
require_once '../tpe/app/views/categorias.view.php';

class ControladorClientes
{
    private $modelo;
    private $vista;

    public function __construct($res)
    {
        $this->modelo = new ModeloClientes();
        $this->vista = new VistaClientes($res->usuario);
    }

    public function mostrarClientes()
    {
        $clientes = $this->modelo->obtenerClientes();

        return $this->vista->mostrarCategorias($clientes);
    }
    public function mostrarCliente($id_cliente)
    {
        $cliente = $this->modelo->getCategoria($id_cliente);
        $ventasCliente = $this->modelo->obtenerVentasCliente($id_cliente);

        if ($cliente) {
            $this->vista->mostrarCliente($cliente, $ventasCliente);
        } else {
            header("Location: ../clientes");
            exit;
        }
    }


    public function agregarCliente()
    {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $mail = $_POST['mail'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $imagen = $_POST['imagen'];

        $this->modelo->insertarCategoria($dni, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);

        header("Location: ././clientes");
        exit;
    }

    public function borrarCliente($id_cliente)
    {
        $cliente = $this->modelo->obtenerCategoria($id_cliente);
        $this->modelo->eraseCategoria($id_cliente);
        header("Location: ../categorias");
        exit;
    }
    public function updateCategoria($id_cliente)
    {
      
        $cliente = $this->modelo->getCategoria($id_cliente); 
        
        if (isset($_POST['nombre']) ) {
            
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $imagen = $_POST['imagen'];

            $this->modelo->updateCategoria($id_cliente, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);
            header("Location: ../categorias");
            exit;
         
        } else {
            $this->vista->showFormEditar( $cliente);
        }
        
    }
}
