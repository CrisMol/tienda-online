<?php

require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{

	public function index(){
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();

		require_once 'views/categoria/index.php';
	}

	public function crear(){
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}

	public function save(){
		Utils::isAdmin();
		if (isset($_POST) && isset($_POST['nombre'])) {
			$nombre = $_POST['nombre'];
			//Guarda categoria en la base de datos
			$categoria = new Categoria();
			$categoria->setNombre($nombre);
			$save = $categoria->save();
		}
		//Redireccionar
		header("Location: ".base_url."categoria/index");
	}

	public function ver(){
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$categorias = new Categoria();
			$categorias->setId($id);
			$categoria = $categorias->getOne();

			//Conseguir productos
			$producto = new Producto();
			$producto->setCategoriaId($id);
			$productos = $producto->getAllCategorias();
		}
		require_once 'views/categoria/ver.php';
	}
}