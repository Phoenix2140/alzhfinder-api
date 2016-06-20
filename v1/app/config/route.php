<?php 
	/**
	 * Se llama a la clase Router para tratar las rutas
	 * y el tipo de Método que utiliza (POST, GET u otro)
	 */
	require_once($config->get('baseDir').'Router.php');
	$ruta = new Router();

	require_once($config->get('controllersDir').'usuarios/registrar.php');
	$registrar = new Registrar($config);

	
	/**
	 * Se separan las rutas por los métodos GET y POST
	 * que son los métodos más utilizados, se pueden 
	 * incorporar otros según se requiera.
	 */
	if($ruta->get() == 'GET'){

		/**
		 * Se obtiene el enlace de la dirección web y se divide
		 * para poder tratarlas con un switch.
		 */
		$enlace = $ruta->enlace();

		/**
		 * El Switch utiliza una accion dependiendo de la ruta.
		 */
		switch ($enlace[$config->get('deep')]){
			case '':
				/**
				 * Se llama y se crea un objeto de la clase Home 
				 * para este ejemplo
				 */
				echo json_encode(array('response' => "get_sin_ruta"));

				break; // Se finaliza el switch
			/**
			 * Si la direción es /hola, se hace un echo con hola y
			 * se termina el switch
			 */
			case 'hola': 
				
				//echo json_encode(array('response' => true));
				$registrar->obtenerUsuarios();	
				break;

			case 'usuarios':
				echo json_encode(array('response' => 'get_usuarios'));
				break;
			
			default:
				echo json_encode(array('response' => "get_null"));
				break;
		}

	}elseif($ruta->get() == 'POST'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método POST con el switch
		 */
		$enlace = $ruta->enlace();

		switch ($enlace[$config->get('deep')]) {
			case '':
				echo json_encode(array('response' => "post_sin_ruta"));
				break;
			case 'usuarios':

				$registrar->crearUsuario();

				break;
			
			default:
				echo json_encode(array('response' => "post_null"));
				break;
		}
	}elseif($ruta->get() == 'PUT'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método PUT con el switch
		 */
		$enlace = $ruta->enlace();

		switch ($enlace[$config->get('deep')]) {
			case '':
				echo json_encode(array('response' => "put_sin_ruta"));
				break;
			
			default:
				echo json_encode(array('response' => "put_null"));
				break;
		}
	}elseif($ruta->get() == 'DELETE'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método DELETE con el switch
		 */
		$enlace = $ruta->enlace();

		switch ($enlace[$config->get('deep')]) {
			case '':
				echo json_encode(array('response' => "delete_sin_ruta"));
				break;
			
			default:
				echo json_encode(array('response' => "delete_null"));
				break;
		}
	}else{
		/**
		 * Pueden agregarse más Métodos
		 */
		echo json_encode(array('response' => "nothing"));
	}
 ?>