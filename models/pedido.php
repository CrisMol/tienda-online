<?php

class Pedido{
	private $id;
	private $usuario_id;
	private $provincia;
	private $localidad;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;
	//Conexión base de datos
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function getId(){
		return $this->id;
	}

	public function getUsuarioId(){
		return $this->usuario_id;
	}

	public function getProvincia(){
		return $this->provincia;
	}

	public function getLocalidad(){
		return $this->localidad;
	}

	public function getDireccion(){
		return $this->direccion;
	}

	public function getCoste(){
		return $this->coste;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getHora(){
		return $this->hora;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setUsuarioId($usuario_id){
		$this->usuario_id = $usuario_id;
	}

	public function setProvincia($provincia){
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	public function setLocalidad($localidad){
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	public function setDireccion($direccion){
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	public function setCoste($coste){
		$this->coste = $coste;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

	public function setHora($hora){
		$this->hora = $hora;
	}

	public function save(){
		$sql = "INSERT INTO pedidos VALUES(null, {$this->getUsuarioId()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, '{$this->getEstado()}', CURDATE(), CURTIME());";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}

	public function getAll(){
		$productos = $this->db->query("SELECT *FROM pedidos ORDER BY id DESC");
		return $productos;
	}

	public function getOne(){
		$producto = $this->db->query("SELECT *FROM pedidos where id={$this->getId()}");
		return $producto->fetch_object();
	}

	public function saveLinea(){
		$sql = "SELECT LAST_INSERT_ID() as 'pedido';";
		$query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->pedido;

		foreach($_SESSION['carrito'] as $elemento){
			$producto = $elemento['producto'];

			$insert = "INSERT INTO lineaspedidos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";

			$update = "UPDATE productos SET stock = stock-{$elemento['unidades']} where id='{$producto->id}' ";

			$save = $this->db->query($insert);
			$refresh = $this->db->query($update);
			
			$result = false;
			if ($save && $refresh) {
				$result = true;
			}
		}
		return $result;
	}

	public function getAllByUser(){
		$sql = "SELECT p.* FROM pedidos p "
			 . "where p.usuario_id={$this->getUsuarioId()} ORDER BY id DESC;";
		$pedido = $this->db->query($sql);
		return $pedido;
	}

	public function getOneByUser(){
		$sql = "SELECT p.id, p.coste FROM pedidos p "
			 . "INNER JOIN lineaspedidos lp ON lp.pedido_id = p.id "
			 . "where p.usuario_id={$this->getUsuarioId()} ORDER BY id DESC LIMIT 1;";
		$pedido = $this->db->query($sql);
		return $pedido->fetch_object();
	}

	public function getProductsByPedido($id){
		//$sql = "SELECT * FROM productos where id IN (SELECT producto_id FROM lineaspedidos WHERE pedido_id = {$id})";

		$sql = "SELECT pr.*, lp.unidades FROM productos pr "
				."INNER JOIN lineaspedidos lp ON pr.id = lp.producto_id "
				."WHERE lp.pedido_id = {$id};";
		$productos = $this->db->query($sql);
		return $productos;
	}

	public function getUserByPedido($id){
		//$sql = "SELECT * FROM productos where id IN (SELECT producto_id FROM lineaspedidos WHERE pedido_id = {$id})";

		$sql = "SELECT u.* FROM usuarios u "
				."INNER JOIN pedidos pe ON pe.usuario_id = u.id "
				."WHERE pe.id = {$id};";
		$usuario = $this->db->query($sql);
		return $usuario->fetch_object();
	}

	public function edit(){
		$sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
		$sql .= "WHERE id={$this->getId()};";

		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}
}