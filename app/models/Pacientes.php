<?php 
	/**
	 * Modelo de la Tabla Pacientes
	 * Estructura de la tabla
	 *		id_pacientes		INT
	 *		id_usuarios			INT
	 *		nombre				VARCHAR(100)
	 *		genero				VARCHAR(1)
	 *		f_nacimiento		DATE
	 *		observaciones		TEXT
	 *		activo 				BOOL
	 */

	class Pacientes{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Creamos el paciente con sus datos básicos
		 */
		public function crearPaciente($usuario, $nombre, $genero, $nacimiento, 
			$observaciones, $activo){
			$this->db->query("INSERT INTO pacientes (id_usuarios, nombre, 
				genero, f_nacimiento, observaciones, activo) 
				VALUES (:usuario, :nombre, :genero, :nacimiento, :observaciones, 
					:activo)");

			$this->db->bind(':usuario', $usuario);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':genero', $genero);
			$this->db->bind(':nacimiento', $nacimiento);
			$this->db->bind(':observaciones', $observaciones);
			$this->db->bind(':activo', $activo);

			$this->db->execute();
		}

		/**
		 * Obtenemos todos los pacientes y los retornamos
		 */
		public function getPacientes(){
			$this->db->query("SELECT * FROM pacientes");

			return $this->db->resultSet();
		}

		/**
		 * Obtenemos la información del paciente por su ID
		 */
		public function getPacienteId($id){
			$this->db->query("SELECT * FROM pacientes WHERE id_usuarios=:id");

			$this->db->bind(':id', $id);

			return $this->db->single();
		}

		/**
		 * Obtenemos todos los pacientes de un determinado usuario
		 */
		public function getPacientesPorUsuarioId($usuario){
			$this->db->query("SELECT * FROM pacientes WHERE id_usuarios=:usuario");

			$this->db->bind(':usuario', $usuario);

			return $this->db->resultSet();
		}

		/**
		 * Actualizamos los datos del paciente por su ID
		 */
		public function updatePacienteId($id, $usuario, $genero, $nacimiento, 
			$observaciones, $activo){
			$this->db->query("UPDATE pacientes SET id_usuarios=:usuario,
				genero=:genero, nacimiento=:nacimiento, observaciones=:observaciones,
				activo=:activo WHERE id_pacientes=:id");

			$this->db->bind(':id', $id);
			$this->db->bind(':usuario', $usuario);
			$this->db->bind(':genero', $genero);
			$this->db->bind(':nacimiento', $nacimiento);
			$this->db->bind(':observaciones', $observaciones);
			$this->db->bind(':activo', $activo);

			$this->db->execute();
		}

		/**
		 * Eliminamos los datos del paciente
		 */
		public function delPacienteId($id){
			$this->db->query("DELETE FROM pacientes WHERE id_pacientes=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}

	}
 ?>