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
	}
 ?>