<?php 

	Class Usuario{
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
			$this->jsonGet = json_decode( file_get_contents('php://input') );
		}


		/**
		 * Crear nuevo usuario (Por ahora sin seguridad para verificar que se están creando)
		 */
		public function crearUsuario(){
			//Comprobamos que los datos enviados sean válidos
			if($this->comprobarDatos($this->jsonGet)){
				
				$token = md5($this->jsonGet->email.time());

				$this->usuario->crearUsuario( $this->jsonGet->email, $this->jsonGet->pass, 
					$this->jsonGet->nombre, $token );

				$this->returnTrue();

			}else{

				$this->returnFalse();
				
			}
		}

		/**
		 * Obtenemos todos los usuarios registrados
		 */
		public function obtenerUsuarios(){
			echo json_encode($this->usuario->getUsuarios());
		}

		/**
		 * Actualizamos los datos de un usuario con su ID y nuevos datos
		 *
		 */
		public function updateUser(){
			if($this->comprobarUsuario($this->jsonGet)){

				$this->usuario->updateUser( $this->jsonGet->id, 
					$this->jsonGet->email, $this->jsonGet->pass, 
					$this->jsonGet->nombre);

				$this->returnTrue();
			}else{
				$this->returnFalse();
			}
		}

		/**
		 * Eliminamos los datos del usuario por su ID
		 */
		public function delUser(){
			if ($this->comprobarID($this->jsonGet)) {

				$this->usuario->delUser($this->jsonGet->id);
				
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
		public function comprobarUsuario($json){
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