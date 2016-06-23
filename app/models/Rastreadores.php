<?php 

	/**
	 * Modelo de la tabla rastreadores
	 * Estructura de la tabla:
	 *		id_rastreador 	INT
	 *		id_pacientes 	INT
	 *		token_key		VARCHAR(120)
	 */
	Class Rastreadores{
		private $db;

		/**
		 * Constructor de la clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Creamos o "activamos" un rastreador para un paciente
		 */
		public function crearRastreador($paciente, $llave){
			$this->db->query("INSERT INTO rastreadores (id_pacientes, token_key)
			 VALUES (:paciente, :llave)");

			$this->db->bind(':paciente', $paciente);
			$this->db->bind(':llave', $llave);

			$this->db->execute();
		}

		/**
		 * Obtenemos la lista de rastreadores asignados a algún apciente
		 */
		public function getRastreadoresPacienteId($paciente){
			$this->db->query("SELECT * FROM rastreadores WHERE id_pacientes=:paciente");

			$this->db->bind(':paciente', $paciente);

			return $this->db->resultSet();
		}

		/**
		 * Obtenemos todos los rastreadores existentes o activados
		 */
		public function getRastreadores(){
			$this->db->query("SELECT * FROM rastreadores");

			$this->db->bind(':', $);

			return $this->db->resultSet();
		}

		/**
		 * Editar el paciente asignado a un rastreador
		 */
		public function editarPacienteRastreador($id, $paciente){
			$this->db->query("UPDATE rastreadores SET id_pacientes=:paciente 
				WHERE id_rastreador=:id");

			$this->db->bind(':id', $id);
			$this->db->bind(':paciente', $paciente);

			$this->db->execute();
		}

		/**
		 * Eliminar un rastreador por su ID
		 */
		public function delRastreadorId($id){
			$this->db->query("DELETE FROM rastreadores WHERE id_rastreador=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}

		/**
		 * Eliminar rastreadores de un paciente
		 */
		public function delRastreadoresPacienteId($paciente){
			$this->db->query("DELETE FROM rastreadores WHERE id_pacientes=:paciente");

			$this->db->bind(':paciente', $paciente);

			$this->db->execute();
		}
	}
 ?>