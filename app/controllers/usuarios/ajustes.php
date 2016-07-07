<?php 
	/**
	 * Controlador que obtiene y asigna los ajustes
	 */
	Class Ajustes{
		private $config;
		private $settings;

		private function __construct($config){
			$this->config = $config;

			require_once($this->config->get('modelsDir').'Ajustes.php');
			$this->settings = new Settings($this->config);
		}

		/**
		 * Función para obtener los ajustes
		 */
	}
 ?>