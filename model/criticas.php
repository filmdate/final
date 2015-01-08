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
include_once("../funciones/peliculas.php");


// Se comprueba si el comentario está definido
if(isset($_POST['enviarCritica'])){
	// Si el textarea de criticas está vacio
	if($_POST['criti']==NULL){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: No has introducido el comentario');

		// Redirecciona al perfil de la película
		header('Location: ../views/perfil-peli.php');

		// Imprime un mensaje y termina el script actual
		exit();
		
	}
	else{ // Si el textarea no está vacío

		try {

			$idUsu=$_SESSION['id_usuario'];

			// Se crea un array para obtener los datos del formulario para guarda como un documento
			$document = array( 

				"id_usuario" => $idUsu, 
				"id_pelicula" => $_SESSION['id_pelicula'],
				"comentario" => $_POST['criti']

	    	);

			// Se inserta el documento en la colección llamado criticas
			$collection=$bd->criticas;
			$collection->insert($document);

			// Se establece la colección llamado películas
			$collection=$bd->peliculas;

			$datosPelicula=obtenerDatosPelicula($_SESSION['id_pelicula']);

			foreach ($datosPelicula as $campo => $valor) {

                $nombrePeli;

                if($campo=="title"){

                    $nombrePeli=$valor;
                    echo $nombrePeli;

                }               

            }

			// Redirecciona al perfil de la película
			header("location: ../views/perfil-peli.php?peli=$nombrePeli");

		}
		catch (MongoCursorException $e) {

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: Al insertar datos!');

			// Redirecciona al perfil de la película
			header('Location: ../views/perfil-peli.php?peli=$nombrePeli');

			// Imprime un mensaje y termina el script actual
			exit();

		}// Cierre de la excepción

	} 

} // Cierre del if --> variable registro

?>