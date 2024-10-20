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

        return $this->vista->mostrarClientes($clientes);
    }
    public function mostrarCliente($id_cliente)
    {
        $cliente = $this->modelo->obtenerClientes($id_cliente);
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

        $this->modelo->insertarCliente($dni, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);

        header("Location: ././clientes");
        exit;
    }

    public function borrarCliente($id_cliente)
    {
        $cliente = $this->modelo->obtenerCliente($id_cliente);
        $this->modelo->borrarCliente($id_cliente);
        header("Location: ../clientes");
        exit;
    }
    public function editarCliente($id_cliente)
    {
      
        $cliente = $this->modelo->obtenerCliente($id_cliente); 
        
        if (isset($_POST['nombre']) ) {
            
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $imagen = $_POST['imagen'];

            $this->modelo->editarCliente($id_cliente, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);
            header("Location: ../clientes");
            exit;
         
        } else {
            $this->vista->mostrarFormularioEditar( $cliente);
        }
        
    }
}
