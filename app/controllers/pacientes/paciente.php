<?php 

	Class Paciente{
		private $config;
		private $datos;
		private $paciente;
		private $authController;

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

			require_once($this->config->get('controllersDir').'AuthController.php');
			$this->authController = new AuthController($this->config);

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
		public function obtenerPacientesUsuario($key){
			if ($this->comprobarNulo($key)) {
				$user = $this->authController->getUserKey($key);
				
				if ($user["return"]) {
					$datos = $this->paciente->getPacientesPorUsuarioId($user["usuario"]["id_usuarios"]);
					echo json_encode(array('response' => true, 'pacientes' => $datos));
				} else {
					echo json_encode(array('response' => false));
				}
				
			} else {
				echo json_encode(array('response' => false));
			}
			
		}

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
		private function comprobarDatos($json){
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
		private function comprobarpaciente($json){
			if($this->comprobarID($json) && $this->comprobarDatos($json)){

				return true;
			}else{

				return false;
			}
		}

		/**
		 * Verificamos que exista el campo ID
		 */
		private function comprobarID($json){
			if (isset($json->id)) {
				
				return true;
			}else{
				
				return false;
			}
		}

		/**
		 * Comprobar llave de autentificación
		 */
		private function comprobarKey($key){

		}

		/**
		 * Comprobamos que los datos enviados no lleguen vacíós
		 */
		private function comprobarNulo($valor){
			if (isset($valor) && !is_null($valor)) {
				return true;
			} else {
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