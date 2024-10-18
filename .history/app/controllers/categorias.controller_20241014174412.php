<?php
require_once '../tpe/app/models/categorias.model.php';
require_once '../tpe/app/views/categorias.view.php';

class CategoriasController
{
    private $model;
    private $view;


    public function __construct($res)
    {
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView($res->usuario);
    }

    public function showCategorias()
    {
        $clientes = $this->model->getCategorias();

        return $this->view->showCategorias($clientes);
        
    }
    public function showCategoria($id_categoria) {
        $categoria = $this->model->getCategoria($id_categoria);
        $ventasCategoria= $this->model->getVentasCategoria($id_categoria);
    
        if ($categoria) {
             $this->view->showCategoria($categoria, $ventasCategoria);
        } else {
            header("Location: ../categorias");
            exit(); 
        }
    }


    public function addCategoria()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $mail = $_POST['mail'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $imagen = $_POST['imagen'];

        $this->model->insertCategoria($dni, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);

        header('Location: ' . CATEGORIAS_URL);
        exit();
    }

    public function eraseCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);
        if (!$categoria) {
            header('Location: ' . CATEGORIAS_URL);
        }
        $this->model->eraseCategoria($id_categoria);
       // header('Location: ' . CATEGORIAS_URL);
        exit();
    }
    public function updateCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);

        if (!$categoria) {
            return $this->view->showError("No existe la categoria con el id_categoria=$categoria");
        }
        
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $mail = $_POST['mail'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $imagen = $_POST['imagen'];
        
        $this->model->updateCategoria($categoria, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen); 

        header('Location: ' . CATEGORIAS_URL);
        exit();
    }
}