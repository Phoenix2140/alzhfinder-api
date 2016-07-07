<?php 
	/**
	 * Modelo de la tabla de Usuarios
	 * Estructura de la tabla:
	 *		id_usuarios INT
	 *		email 		VARCHAR(45)
	 *		pass 		VARCHAR(45)
	 *		nombre 		VARCHAR(45)
	 * 		token_key 	VARCHAR(120)
	 */
	Class Usuarios{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		public function crearUsuario($email, $pass, $nombre, $token){
			$this->db->query("INSERT INTO usuarios (email, pass, nombre, token_key)
				VALUES (:email, :pass, :nombre, :token)");

			$this->db->bind(':email', $email);
			$this->db->bind(':pass', $pass);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':token', $token);

			$this->db->execute();
		}

		/**
		 * Función que obtiene todos los usuarios de la base de datos
		 */
		public function getUsuarios(){
			$this->db->query("SELECT * FROM usuarios");

			return $this->db->resultSet();
		}

		/**
		 * Función que obtiene el usuario por el email y la contraseña
		 */
		public function getUsuarioLogin($email, $pass){
			$this->db->query("SELECT * FROM usuarios WHERE email=:email AND pass=:pass");

			$this->db->bind(':email', $email);
			$this->db->bind(':pass', $pass);

			return $this->db->single();
		}

		/**
		 * Función que obtiene determinado usuario por la ID de este
		 */
		public function getUsuarioId($id){
			$this->db->query("SELECT * FROM usuarios WHERE id_usuarios=:id");

			$this->bind(':id', $id);

			return $this->db->single();
		}

		/**
		 * Actualizamos los datos del usuario (email(usuario), contraseña y el nombre)
		 */
		public function updateUser($id, $email, $pass, $nombre){
			$this->db->query("UPDATE usuarios SET email=:email, 
				pass=:pass, nombre=:nombre WHERE id_usuarios=:id");

			$this->db->bind(':id', $id);
			$this->db->bind(':email', $email);
			$this->db->bind(':pass', $pass);
			$this->db->bind(':nombre', $nombre);

			$this->db->execute();

		}

		/**
		 * Actualizamos el token de acceso a de la aplicación móvil
		 */
		public function updateToken($id, $token){
			$this->db->query("UPDATE usuarios SET token_key=:token 
				WHERE id_usuarios=:id");

			$this->db->bind(':id', $id);
			$this->db->bind(':token', $token);

			$this->db->execute();

		}

		/**
		 * Función que elimina un usuario por su ID
		 */
		public function delUser($id){
			$this->db->query("DELETE FROM usuarios WHERE id_usuarios=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}

	}
 ?>