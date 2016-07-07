<?php 

	Class Login{
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
			// $this->jsonGet = file_get_contents("php://input");
			$this->jsonGet = json_decode( file_get_contents('php://input') );
		}


		/**
		 * Crear nuevo usuario (Por ahora sin seguridad para verificar que se están creando)
		 */
		public function login(){
			//Comprobamos que los datos enviados sean válidos
			if($this->comprobarDatos($this->jsonGet)){

				
				$user = $this->usuario->getUsuarioLogin($this->jsonGet->user, $this->jsonGet->pass);

				if(isset($user["token_key"]) && !is_null($user["token_key"])){

					echo json_encode(array('response' => true, 'key' => $user["token_key"]));
				}else{
					echo json_encode(array('response' => false));				
				}

			}else{
				echo json_encode(array('response' => false));
				
			}
		}

		/**
		 * Comprobar Datos
		 */
		public function comprobarDatos($json){
			if(isset($json->user) && isset($json->pass)){

				return true;
			}else{

				return false;
			}
		}
	}
 ?>