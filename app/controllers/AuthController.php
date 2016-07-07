<?php 
	/**
	 * Controlador para la autentificación y 
	 * comprobación de la llave de acceso
	 */
	Class AuthController{
		private $config;
		private $usuarios;

		public function __construct($config){
			$this->config = $config;

			require_once($this->config->get('modelsDir').'Usuarios.php');
			$this->usuarios = new Usuarios($this->config);

		}

		public function getUserKey($key){
			$user = $this->usuarios->getUserKey($key);

			if($user["token_key"] == $key){
				return array('return' => true, 'usuario' => $user);
			}else{
				return array('return' => false);
			}
		}
	}
 ?>