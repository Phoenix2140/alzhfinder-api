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
	}
 ?>