<?php

// Se importa database.php para realizar consultas a la base de datos
include_once("../config/database.php");

function obtenerIdPelicula($titulo){

	// Variable global
	global $collection;

	// Variable local 
	$id_pelicula=''; // Se establece el valor vacío de String

	// Se realiza una consulta para obtener la id de la película
	$peliculas=$collection->findOne(array('title' => $titulo));

	// Recorremos los datos de esa película en concreto
	foreach($peliculas as $campos => $datos){

		// Filtramos el campo para obtener el dato
		if($campos=='_id'){

			// Se guarda el id único de la película en una variable local
			$id_pelicula=$datos;

		} // Cierre del if

	} // Cierre del bucle foreach

	// Devuelve la variable local en String
	return $id_pelicula;	


}  //Cierre de la función obtenerIdPelicula


function obtenerDatosPelicula($id_pelicula){

	// Variable global
	global $collection;

	// Se realiza una consulta para obtener los datos de la película a mostrar
	$peliculas=$collection->findOne(array('_id' => $id_pelicula));

	

	// Devuelve el array de película
	return $peliculas;

}

?>