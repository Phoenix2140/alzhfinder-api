<?php 
	/**
	 * Modelo de la tabla Seguimientos
	 * Estructura de la tabla:
	 *		id_seguimientos		INT
	 *		id_pacientes 		INT
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
	}
 ?>