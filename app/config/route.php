<?php 
	/**
	 * Se llama a la clase Router para tratar las rutas
	 * y el tipo de Método que utiliza (POST, GET u otro)
	 */
	require_once($config->get('baseDir').'Router.php');
	$ruta = new Router();

	/**
	 * Controlador para el login
	 */
	require_once($config->get('controllersDir').'usuarios/login.php');
	$login = new Login($config);

	/**
	 * Controlador para los usuarios
	 */
	require_once($config->get('controllersDir').'usuarios/usuario.php');
	$usuario = new Usuario($config);

	/**
	 * Controlador para obtener los pacientes
	 */
	require_once($config->get('controllersDir').'pacientes/paciente.php');
	$pacientes = new Paciente($config);

	/**
	 * Controlador para obtener contactos
	 */
	require_once($config->get('controllersDir').'contactos/contactosController.php');
	$contactos = new ContactosController($config);

	
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

			case 'usuarios':

				$usuario->obtenerUsuarios();
				break;
			case 'pacientes':
				
				/**
				 * Si se envía la llave, se realiza la operación
				 */
				if (isset($enlace[$config->get('deep')+1])) {
					$pacientes->obtenerPacientesUsuario($enlace[$config->get('deep')+1]);
				} else {
					echo json_encode(array('response' => false, 
						'msg' => "Error al obtener pacientes, no se envío la llave"));
				}
				
				break;

			case 'contacto':
				if(isset($enlace[$config->get('deep')+1]) && $enlace[$config->get('deep')+2]){
					$contactos->obtenerContactoPacienteID($enlace[$config->get('deep')+1], $enlace[$config->get('deep')+2]);
				}else{
					echo json_encode(array('response' => false));
				}
				break;
			
			case '':
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

			case 'usuarios':

				$usuario->crearUsuario();

				break;
			case 'login':
				$login->login();
				break;
			
			case '':
			default:
				echo json_encode(array('response' => "post_null"));
				break;
		}
	}elseif($ruta->get() == 'PUT'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método POST con el switch, PUT se refiere a ingresar
		 * o actualizar un elemento
		 */
		$enlace = $ruta->enlace();

		switch ($enlace[$config->get('deep')]) {

			case 'usuarios':
				
				$usuario->updateUser();

				break;
			
			case '':
			default:
				echo json_encode(array('response' => false));
				break;
		}
	}elseif($ruta->get() == 'DELETE'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método DELETE con el switch
		 */
		$enlace = $ruta->enlace();

		switch ($enlace[$config->get('deep')]) {

			case 'usuarios':
				
				$usuario->delUser();

				break;
			
			case '':
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