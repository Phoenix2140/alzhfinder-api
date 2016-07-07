<?php 
	/**
	 * Controlador contactos, gestiona el contacto obtenido
	 */
	Class ContactosController{
		private $config;
		private $datos;
		private $contactos;
		private $authController;

		public function __construct($config){
			$this->config = $config;

			require_once($this->config->get('modelsDir').'Contactos.php');
			$this->contactos = new COntactos($this->config);

			require_once($this->config->get('controllersDir').'AuthController.php');
			$this->authController = new AuthController($this->config);
		}

		public function obtenerContactoPacienteID($key, $paciente){
			if($this->comprobarNulo($key) && $this->comprobarNulo($paciente)){
				
				$user = $this->authController->getUserKey($key);

				if ($user["return"]) {
					$contacto = $this->contactos->getContactoIdPaciente($paciente);

					echo json_encode(array('response' => true, 'contacto' => $contacto));
				} else {
					echo json_encode(array('response' => false));
				}

			}else{
				echo json_encode(array('response' => false));
			}
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
	}
 ?>