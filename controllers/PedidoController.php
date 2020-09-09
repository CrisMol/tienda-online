<?php

require_once 'models/pedido.php';

class pedidoController{
	public function hacer(){
		require_once 'views/pedido/hacer.php';
	}

	public function add(){
		if (isset($_SESSION['identity'])) {
			$usuario_id = $_SESSION['identity']->id;
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

			$stats = Utils::statsCarrito();
			$coste = $stats['total'];

			if ($provincia && $localidad && $direccion) {
				//Guardar datos
				$pedido = new Pedido();
				$pedido->setUsuarioId($usuario_id);
				$pedido->setProvincia($provincia);
				$pedido->setLocalidad($localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);
				$pedido->setEstado("confirm");

				$save = $pedido->save();

				//Guardar linea pedido
				$saveLinea = $pedido->saveLinea();

				if ($save && $saveLinea) {
					$_SESSION['pedido'] = "complete";
				}else{
					$_SESSION['pedido'] = "failed";
				}
				
			}else{
				$_SESSION['pedido'] = "failed";
			}
			header("Location:".base_url."pedido/confirmado");
		}else{
			header("Location:".base_url);
		}
	}

	public function confirmado(){
		if (isset($_SESSION['identity'])) {
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();
			$pedido->setUsuarioId($identity->id);
			$pedido = $pedido->getOneByUser();

			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductsByPedido($pedido->id);
		}
		require_once 'views/pedido/confirmado.php';
	}

	public function misPedidos(){
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();
		$pedido->setUsuarioId($usuario_id);
		$pedidos = $pedido->getAllByUser();
		require_once 'views/pedido/mis_pedidos.php';
	}

	public function detalle(){
		Utils::isIdentity();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			//Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido = $pedido->getOne();

			$pedido_usuario = new Pedido();
			$usuario = $pedido_usuario->getUserByPedido($id);
			
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductsByPedido($id);


			require_once 'views/pedido/detalle.php';
		}else{
			header("Location".base_url."pedido/misPedidos");
		}
	}

	public function gestion(){
		Utils::isAdmin();
		$gestion = true;

		$pedido = new Pedido();
		$pedidos = $pedido->getAll();
		require_once 'views/pedido/mis_pedidos.php';
	}

	public function estado(){
		Utils::isAdmin();

		if (isset($_POST['pedido-id']) && isset($_POST['estado'])) {
			$id = $_POST['pedido-id'];
			$estado = $_POST['estado'];
			//update del pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido->setEstado($estado);
			$pedido->edit();
			header("Location:".base_url."pedido/detalle&id=".$id);
		}else{
			header("Location:".base_url);
		}
	}

}