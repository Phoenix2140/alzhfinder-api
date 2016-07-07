<?php 
	/**
	 * Modelo de la Tabla Contactos
	 * Estructura de la Tabla
	 *		id_contactos	INT
	 *		id_pacientes	INT
	 *		nombre			VARCHAR(45)
	 *		fono 			VARCHAR(45)
	 *		direccion 		VARCHAR(45)
	 *		email 			VARCHAR(45)
	 */
	Class Contactos{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}
		/**
		 * Creamos un contacto para un paciente determinado
		 */
		public function crearContacto($paciente, $nombre, $fono, $direccion, $email){
			$this->db->query("INSERT INTO contactos (id_pacientes, nombre, 
				fono, direccion, email) VALUES (:paciente, :nombre, :fono, 
				:direccion, :email)");

			$this->db->bind(':paciente', 	$paciente);
			$this->db->bind(':nombre', 		$nombre);
			$this->db->bind(':fono', 		$fono);
			$this->db->bind(':direccion', 	$direccion);
			$this->db->bind(':email', 		$email);

			$this->db->execute();
		}

		/**
		 * Obtenemos todos los contactos (posible estadística o que un contacto
		 * sea asignado a muchos pacientes)
		 * revisar eso último
		 */
		public function getContactos(){
			$this->db->query("SELECT * FROM contactos");

			return $this->db->resultSet();
		}

		/**
		 * Obtener el contacto por el ID del paciente
		 */
		public function getContactoIdPaciente($paciente){
			$this->db->query("SELECT * FROM contactos WHERE id_pacientes=:paciente");

			$this->db->bind(':paciente', $paciente);
			
			return $this->db->single();
		}

		/**
		 * Obtener el contacto por su ID
		 */
		public function getContactoId($id){
			$this->db->query("SELECT * FROM contactos WHERE id_contactos=:id");

			$this->db->bind(':id', 	$id);

			return $this->db->single();
		}

		/**
		 * Actualizar un contacto determinado por su ID
		 */
		public function updateContactoId($id, $paciente, $nombre, $fono, $direccion, $email){
			$this->db->query("UPDATE contactos SET id_pacientes=:paciente, 
				nombre=:nombre, fono=:fono, direccion=:direccion, email=:email 
				WHERE id_contactos=:id");

			$this->db->bind(':id', 			$id);
			$this->db->bind(':paciente', 	$paciente);
			$this->db->bind(':nombre', 		$nombre);
			$this->db->bind(':fono', 		$fono);
			$this->db->bind(':direccion', 	$direccion);
			$this->db->bind(':email', 		$email);

			$this->db->execute();
		}

		/**
		 * Eliminar un contacto determinado por us ID
		 */
		public function delContactoId($id){
			$this->db->query("DELETE FROM contactos WHERE id_contactos=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}

 ?>