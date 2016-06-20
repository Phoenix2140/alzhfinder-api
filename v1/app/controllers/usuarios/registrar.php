<?php 

	Class Registrar{
		private $config;
		private $jsonGet;
		private $usuario;

		/**
		 * Contructor de la clase
		 */
		public function __construct($config){
			$this->config = $config;

			/**
			 * Impportamos el modelo de usuario
			 */
			require_once($this->config->get('modelsDir').'Usuarios.php');
			$this->usuario = new Usuarios($this->config);

			/**
			 * Obtenemos los jsonGet enviados por el Cliente
			 */
			//$this->jsonGet = file_get_contents("php://input");
			$this->jsonGet = json_decode(file_get_contents('php://input'),true);
		}


		/**
		 * Crear nuevo usuario (Por ahora sin seguridad para verificar que se están creando)
		 */
		public function crearUsuario(){
			//echo $this->jsonGet;
			echo json_encode(array('Respuesta' => 'OK', 'jsonGet' => $this->jsonGet));
		}

		public function obtenerUsuarios(){
			echo $this->jsonGet;
		}
	}
 ?>