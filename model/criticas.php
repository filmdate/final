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

$id_usuario=$_POST['id_usuario'];
$id_pelicula=$_POST['id_pelicula'];
$comentario=$_POST['comentario'];

// Establecemos la colección
$collection=$bd->peliculas;

$datos=obtenerDatosPelicula($id_pelicula);

$titulo;

foreach ($datos as $campo => $valor) {

	if($campo=="title"){

		$titulo=$valor;

	}
}

// Se comprueba si el comentario está definido
//if(isset($_POST['enviarCritica'])){
	// Si el textarea de criticas está vacio
	if(isset($comentario) and $comentario==NULL){

				// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: No has introducido el comentario');

		// Redirecciona al perfil de la película
		header('Location: ../views/perfil-peli.php?peli=' . $titulo);

		// Imprime un mensaje y termina el script actual
		exit();
		
	}
	else{ // Si el textarea no está vacío

		try {

			// Se crea un array para obtener los datos del formulario para guarda como un documento
			$document = array( 

				"id_usuario" => $id_usuario, 
				"id_pelicula" => $id_pelicula,
				"comentario" => $comentario

	    	);

			// Se inserta el documento en la colección llamado criticas
			$collection2=$bd->criticas;
			$collection2->insert($document);

			// Se realiza una consulta con el id_pelicula
			$criti=$collection2->find(array('id_pelicula' => $pelicula_id));

			// Devuelve el objeto JSON
			echo json_encode(iterator_to_array($criti));

			
			// Redirecciona al perfil de la película
			//header("location: ../views/perfil-peli.php?peli=$titulo");

		}
		catch (MongoCursorException $e) {

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: Al insertar datos!');

			// Redirecciona al perfil de la película
			header('Location: ../views/perfil-peli.php?peli=$titulo');

			// Imprime un mensaje y termina el script actual
			exit();

		}// Cierre de la excepción

	}

//} // Cierre del if --> variable registro

?>