<?php

//------------------------------------------------------------------------------
// Los mensajes flash requieren las sesiones 
//------------------------------------------------------------------------------
if( !session_id() ) session_start();

//------------------------------------------------------------------------------
// Se incluye la clase y se instancia
//------------------------------------------------------------------------------
require_once('../controller/class.messages.php');
$msg = new Messages();


// Se importa database.php para realizar consultas a la base de datos
include_once("../config/database.php");

// Se importan las funciones para comprobar u obtener datos
include_once("../funciones/usuarios.php");

// Iniciar una nueva sesión o reanudar una sesión
session_start();

// Se comprueba si el editNombre está definida
if(isset($_POST['editEmail'])){
	
	// Si los campos username o password están vacíos
	if($_POST['email']==NULL or $_POST['password']==NULL){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: Los campos estan vacios');

		// Redirecciona al perfil del usuario
		header('Location: ../views/profile.php');

		// Imprime un mensaje y termina el script actual
		exit();

	}
	else{ // Si los campos no están vacíos

		// Se comprueba si la contraseña coincide
		if(verificarPassword($_SESSION["nombreUsuario"],md5($_POST['password']))==true){ //Si la contraseña coindice

			// Se establece la variable mediante el valor de la variable de sesión
			$id_usuario=$_SESSION["id_usuario"];

			// Si existe un usuario con el mismo email introducido
			if(usuarioExiste($_POST['email'])==true){

				// Mensaje de error a mostrar
				$msg->add('e', 'ERROR: Ya existe un usuario');

				// Redirecciona al perfil del usuario
				header('Location: ../views/profile.php');

				// Imprime un mensaje y termina el script actual
				exit();

			}
			else{

				// Se consultan los datos de ese usuario en concreto
				$users=$collection->findOne(array('_id' => $_SESSION["id_usuario"]));

				// Se recorre el array
				foreach ($users as $document) {
					
					// Se actualiza el email del usuario
					$collection->update(array('usuario' => $_SESSION["nombreUsuario"]), array('$set'=> array('email' => $_POST['email'])));

				}

				// Se obtiene el nombre de usuario de la BD
				$email=obtenerEmail($id_usuario);

				// Se establece la variable de sesión del nombre de usuario
				$_SESSION["email"]=$email;

	   			// Muestra mensaje exitoso
				$msg->add('s', 'Cambio realizado');

				// Redirecciona al perfil del usuario
				header('Location: ../views/profile.php');

				// Imprime un mensaje y termina el script actual
				exit();

			}
		
		}
		else{ // Si la contraseña no coincide

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: La clave no es correcta');

			// Redirecciona al perfil del usuario
			header('Location: ../views/profile.php');

			// Imprime un mensaje y termina el script actual
			exit();

		} // Cierre del else porque la contraseña no coincide
		
	} // Cierre del else si los campos no están vacíos

} // Cierre del if --> variable login

?>