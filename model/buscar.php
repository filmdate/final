<?php


// Se importa database.php para realizar consultas a la base de datos
include_once("../config/database.php");

// Variable global

$collection=$bd->peliculas;

//------------------------------------------------------------------------------
// Los mensajes flash requieren las sesiones 
//------------------------------------------------------------------------------
if( !session_id() ) session_start();

//------------------------------------------------------------------------------
// Se incluye la clase y se instancia
//------------------------------------------------------------------------------
require_once('../controller/class.messages.php');
$msg = new Messages();

echo "<link href=\"../css/mensajes.css\" rel=\"stylesheet\" type=\"text/css\" >";


if(isset($_POST['pelicula'])){

	$peliculaUsuario=strtolower($_POST['pelicula']);

	$peliculaUsuario=trim($peliculaUsuario);

	$peliculas=$collection->find();

	$array=array();
	$titulo;
	$titulo_min;
	$encontrado;

	//var_dump(iterator_to_array($peliculas));

	foreach($peliculas as $campos => $values){

		foreach($values as $campo => $datos){			

			if($campo=="title"){

				$titulo=$datos;
				$titulo_min=strtolower($datos);
				//echo $titulo . "<br>";
				$encontrado = strpos($titulo_min, $peliculaUsuario);

				if($encontrado !== FALSE){

					if(strtolower($titulo)==$titulo_min){

						// Se guarda el titulo en el array
						array_push($array,$titulo);

					}

				}	

			}

		}

	}

	if(count($array)==0){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: Los datos no son validos');

		echo $msg->display();

		// Imprime un mensaje y termina el script actual
		exit();

	}
	else{

		foreach($array as $values){

			$mostrar=$collection->find(array('title' => $values));

			foreach ($mostrar as $campos => $datos) {

				foreach($datos as $campo => $dato){

					$titulo;
					$year;
					$runtime;
					$poster;
					$synopsis;

					if($campo=="poster"){

						$poster=$dato;						

					}

					if($campo=="title"){

						$titulo=$dato;
						echo "<a href='../views/perfil-peli.php?peli=$titulo'><img src=$poster></a><br>";
						echo "<a href='../views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a><br>";

					}

					if($campo=="year"){

						$year=$dato;
						echo "<p> Ano: $year </p>";

					}

					if($campo=="runtime"){

						$runtime=$dato;
						echo "<p> Duracion: $runtime mins </p>";

					}

					if($campo=="synopsis"){

	                    $synopsis=$dato;
	                    echo "<p> Sinopsis: $synopsis </p>";


	                } 

				}
			}

		}

	}
}
	
?>
