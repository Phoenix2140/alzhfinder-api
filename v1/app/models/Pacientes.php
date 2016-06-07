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
	}
 ?>