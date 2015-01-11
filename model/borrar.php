<?php

// Se importa database.php para realizar consultas a la base de datos
include_once("../config/database.php");

// Se importan las funciones para comprobar u obtener datos
include_once("../funciones/peliculas.php");

// Se comprueba si el anadir está definida
//if(isset($_POST['eliminar'])){

$id=$_GET['id'];

$collection=$bd->peliculas;

//$collection->remove(array ('id' => $id));

if(!$collection->remove('id' => new MongoId($id), true)){
     die('erroret');
}else{
    
    header('Content-Type: application/json');
    echo json_encode(array('exito'=>true));
}



//} // Cierre del if --> variable registro

?>