<?php

class Usuario{
	private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $rol;
	private $password;
	private $imagen;
	//Conexión base de datos
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	function getId(){
		return $this->id;
	}

	function getNombre(){
		return $this->nombre;
	}

	function getApellido(){
		return $this->apellido;
	}

	function getEmail(){
		return $this->email;
	}

	function getRol(){
		return $this->rol;
	}

	function getPassword(){
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getImagen(){
		return $this->imagen;
	}

	function setId($id){
		$this->id = $id;
	}

	function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellido($apellido){
		$this->apellido = $this->db->real_escape_string($apellido);
	}

	function setEmail($email){
		$this->email = $this->db->real_escape_string($email);
	}
	function setRol($rol){
		$this->rol = $rol;
	}

	function setPassword($password){
		$this->password = $password;
	}

	function setImagen($imagen){
		$this->imagen = $imagen;
	}

	public function save(){
		$sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}

	public function login(){
		$email = $this->getEmail();
		$password = $this->password;
		$result = false;
		//Comprobar si existe el usuario
		$sql = "SELECT *FROM usuarios where email = '$email';";
		$login = $this->db->query($sql);
		if ($login && $login->num_rows == 1) {
			$usuario = $login->fetch_object();
			//Verificar contraseña
			$verify = password_verify($password, $usuario->password);
			if ($verify) {
				$result = $usuario;
			}
		}
		return $result;
	}
}