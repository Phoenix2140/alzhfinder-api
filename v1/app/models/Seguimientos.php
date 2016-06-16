<?php 
	/**
	 * Modelo de la tabla Seguimientos
	 * Estructura de la tabla:
	 *		id_seguimientos		INT
	 *		id_pacientes 		INT
	 *		id_rastreador 		INT
	 *		x_pos				VARCHAR(45)
	 *		y_pos				VARCHAR(45)
	 *		fecha 				DATE
	 *		hora 				TIME
	 */
	Class Seguimientos{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Agregamos la posición, la fecha y hora al registro del paciente
		 */
		public function crearSeguiguiento($paciente, $rastreador, $xpos, $ypos, $fecha, $hora){
			$this->db->query("INSERT INTO sguimientos (id_pacientes, id_rastreador, x_pos, y_pos, fecha, hora) 
				VALUES (:paciente, :rastreador, :xpos, :ypos, :fecha, :hora)");

			$this->db->bind(':paciente', $paciente);
			$this->db->bind(':rastreador', $rastreador);
			$this->db->bind(':xpos', $xpos);
			$this->db->bind(':ypos', $ypos);
			$this->db->bind(':fecha', $fecha);
			$this->db->bind(':hora', $hora);

			$this->db->execute();

		}

		/**
		 * Obtenemos los datos de posición de un paciente
		 */
		public function obtenerSeguimientoPacienteId($paciente){
			$this->db->query("SELECT * FROM seguimientos WHERE id_pacientes=:paciente");

			$this->db->bind(':paciente', $paciente);

			return $this->db->resultSet();
		}

		/**
		 * Obtenemos los datos de posición de un rasatreador
		 */
		public function obtenerSeguimientoRastreadorId($rastreador){
			$this->db->query("SELECT * FROM seguimientos WHERE id_rastreador=:rastreador");

			$this->db->bind(':rastreador', $rastreador);

			return $this->db->resultSet();
		}

		/**
		 * Obtenemos todos los datos de seguimiento de todos los pacientes 
		 * (revisar)
		 */
		public function obtenerSeguimiento(){
			$this->db->query("SELECT * FROM seguimientos");

			return $this->db->resultSet();
		}

		/**
		 * Eliminamos todo el seguimiento de un determinado paciente
		 * (Ver utilizad al eliminar un paciente)
		 */
		public function delSeguimientoPacienteId($paciente){
			$this->db->query("DELETE FROM seguimientos WHERE id_pacientes=:paciente");

			$this->db->bind(':paciente', $paciente);

			$this->db->execute();
		}
	}
 ?>