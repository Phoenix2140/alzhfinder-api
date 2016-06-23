<?php 
	/**
	 * Modelo de la tabla Ajustes
	 * Estructura de la tabla:
	 *		id_ajustes 			INT
	 *		id_usuarios 		INT
	 *		tiempo_actualizar 	varchar(45)
	 */
	Class Ajustes{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que crea los ajustes por defecto usando el ID del
		 * usuario creado
		 */
		public function crearAjustes($usuario){
			$this->db->query("INSERT INTO ajustes (id_usuarios, tiempo_actualizar)
			 VALUES (:usuario, :tiempo)");

			$this->db->bind(':usuario', $usuario);
			$this->db->bind(':tiempo', "120");

			$this->db->execute();
		}

		/**
		 * Obtiene los ajustes por el ID de usuario
		 */
		public function getAjusteUsuarioId($id){
			$this->db->query("SELECT * FROM ajustes WHERE id_usuarios=:id");

			$this->db->bind(':id', $id);

			return $this->db->single();
		}

		/**
		 * Actualiza los ajustes por el ID de la tabla ajustes
		 */
		public function updateAjusteId($id, $tiempo){
			$this->db->query("UPDATE ajustes SET tiempo_actualizar=:tiempo
			 	WHERE id_ajustes=:id ");

			$this->db->bind(':id', $id);
			$this->db->bind(':tiempo', $tiempo);

			$this->db->execute();
		}

		/**
		 * Elimina un ajuste (normalmente cuando se elimine un usuario)
		 */
		public function delAjusteId($id){
			$this->db->query("DELETE FROM ajustes WHERE id_ajustes=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
 ?>