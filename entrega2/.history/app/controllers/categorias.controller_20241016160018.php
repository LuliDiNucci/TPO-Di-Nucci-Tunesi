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
    public function showCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);
        $ventasCategoria = $this->model->getVentasCategoria($id_categoria);

        if ($categoria) {
            $this->view->showCategoria($categoria, $ventasCategoria);
        } else {
            header("Location: ../categorias");
            exit;
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

        header("Location: ././categorias");
        exit;
    }

    public function eraseCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);
        $this->model->eraseCategoria($id_categoria);
        header("Location: ../categorias");
        exit;
    }
    public function updateCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria); // Suponiendo que devuelve una sola categoría

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
            $mail = isset($_POST['mail']) ? $_POST['mail'] : null;
            $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;

            if ($nombre && $telefono && $mail && $fecha_nacimiento && $imagen) {
                $this->model->updateCategoria($id_categoria, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);

                header('Location: ' . CATEGORIAS_URL);
                exit;
            } else {
                // Mostrar un error si falta algún dato
                $this->view->showError('Faltan completar algunos campos.');
            }
        } else {
            // Mostrar el formulario de edición con los datos actuales del cliente
            $this->view->showFormEditar($cliente); // Enviar solo la categoría a editar
        }
    }
}
