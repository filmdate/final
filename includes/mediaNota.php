<?php

        include_once("funciones/peliculas.php");

        $id_pelicula;

        $id_pelicula=obtenerIdPelicula("$titulo");

        // Establecemos la colección
        $collection=$bd->valoracion;

        $media=mediaValoracion("$id_pelicula");

        $media=$media*2;

        $media=round($media,2);

        echo $media;

?>