<?php 
	/**
	 * Controlador contactos, gestiona el contacto obtenido
	 */
	Class SeguimientoController{
		private $config;
		private $datos;
		private $seguimiento;
		private $authController;

		public function __construct($config){
			$this->config = $config;

			require_once($this->config->get('modelsDir').'Seguimientos.php');
			$this->seguimiento = new Seguimientos($this->config);

			require_once($this->config->get('controllersDir').'AuthController.php');
			$this->authController = new AuthController($this->config);
		}

		public function obtenerSeguimientoPaciente($key, $paciente){
			if($this->comprobarNulo($key) && $this->comprobarNulo($paciente)){
				
				$user = $this->authController->getUserKey($key);

				if ($user["return"]) {
					$contacto = $this->seguimiento->obtenerSeguimientoPacienteId($paciente);

					echo json_encode(array('response' => true, 'seguimiento' => $contacto));
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