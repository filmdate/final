$(document).ready(function() {

	// cuando haga clic en alguna de las estrellas
	$(".estrellasValoracion").bind("click",function(){

		// Se obtienen los atributos de la estrella que hizo clic
	    var estrella=this;

	    // creamos el objeto JSON para enviar a la página PHP
	   	var datosClick = {
	        clickEstrella : $(estrella).attr("value"), // le pasamos el valor de la estrella
	        pelicula_id : $(estrella).attr("id") 
	    };

	    // Se envía el valor al archivo php
	    $.post(

	        '../model/valoracion.php', // archivo que va a recibir nuestro pedido
	        datosClick, // el objeto JSON con los datos 

	        // función que se ejecutará cuando obtengamos la respuesta
	        function(datos) {

	        	$("#estrella").html(datos);
	            
	        },

	        'json' // indicamos que el formato utilizado es JSON
	    ); 

	});	

});