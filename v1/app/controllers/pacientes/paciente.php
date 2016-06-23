<?php 

	Class Paciente{
		private $config;
		private $datos;
		private $paciente;

		/**
		 * Contructor de la clase
		 */
		public function __construct($config){
			$this->config = $config;

			/**
			 * Impportamos el modelo de paciente
			 */
			require_once($this->config->get('modelsDir').'Pacientes.php');
			$this->paciente = new Pacientes($this->config);

			/**
			 * Obtenemos los datos enviados por el Cliente
			 */
			//$this->datos = file_get_contents("php://input");
			$this->datos = json_decode( file_get_contents('php://input') );
		}


		/**
		 * Crear nuevo paciente (Por ahora sin seguridad para verificar que se están creando)
		 */
		public function crearPaciente(){
			//Comprobamos que los datos enviados sean válidos
			if($this->comprobarDatos($this->datos)){
				
				$token = md5($this->datos->email.time());

				$this->paciente->crearpaciente( $this->datos->email, $this->datos->pass, 
					$this->datos->nombre, $token );

				$this->returnTrue();

			}else{

				$this->returnFalse();
				
			}
		}

		/**
		 * Obtenemos todos los pacientes registrados
		 */
		public function obtenerPacientes(){
			echo json_encode($this->paciente->getpacientes());
		}

		/**
		 * Obtenemos todos los pacientes de un usuario
		 */

		/**
		 * Actualizamos los datos de un paciente con su ID y nuevos datos
		 *
		 */
		public function updateUser(){
			if($this->comprobarpaciente($this->datos)){

				$this->paciente->updateUser( $this->datos->id, 
					$this->datos->email, $this->datos->pass, 
					$this->datos->nombre);

				$this->returnTrue();
			}else{
				$this->returnFalse();
			}
		}

		/**
		 * Eliminamos los datos del paciente por su ID
		 */
		public function delUser(){
			if ($this->comprobarID($this->datos)) {

				$this->paciente->delUser($this->datos->id);
				
				$this->returnTrue();
			}else{
				$this->returnFalse();
			}
		}

		/**
		 * Comprobamos que existan los campos user, pass y email
		 * en el json
		 */
		public function comprobarDatos($json){
			if(isset($json->nombre) && isset($json->pass) && 
				isset($json->email)){

				return true;
			}else{

				return false;
			}
		}



		/**
		 * Comprobamos que el campo ID contenga datos, además que
		 * la validación de comprobarDatos() sea true
		 */
		public function comprobarpaciente($json){
			if($this->comprobarID($json) && $this->comprobarDatos($json)){

				return true;
			}else{

				return false;
			}
		}

		/**
		 * Verificamos que exista el campo ID
		 */
		public function comprobarID($json){
			if (isset($json->id)) {
				
				return true;
			}else{
				
				return false;
			}
		}

		/**
		 * Funcion que devuelve una respuesta verdadera
		 */
		public function returnTrue(){
			echo json_encode(array('response' => true));
		}

		/**
		 * Funcion que devuelve una respuesta verdadera
		 */
		public function returnFalse(){
			echo json_encode(array('response' => false));
		}
	}
 ?>