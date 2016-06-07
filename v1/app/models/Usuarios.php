<?php 
	/**
	 * Modelo de la tabla de Usuarios
	 * Estructura de la tabla:
	 *		id_usuarios INT
	 *		user 		VARCHAR(45)
	 *		pass 		VARCHAR(45)
	 *		nombre 		VARCHAR(45)
	 * 		token_key 	VARCHAR(120)
	 */
	Class Usuarios{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		public function crearUsuario($user, $pass, $nombre, $token){
			$this->db->query("INSERT INTO usuarios (user, pass, nombre, token_key)
				VALUES (:user, :pass, :nombre, :token)");

			$this->db->bind(':user', $user);
			$this->db->bind(':pass', $pass);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':token', $token);

			$this->db->execute();
		}

		public function getUsuarios(){
			$this->db->query("SELECT * FROM usuarios");

			return $this->db->resultSet();
		}

	}
 ?>