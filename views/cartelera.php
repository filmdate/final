<html>

	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title> Cartelera </title>
		<!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />
		<link rel="stylesheet" href="../css/listaPelis.css" /> <!-- El diseño está en un archivo externo -->

		<!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
				<!--CSS bootstrap-->
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">

        <!-- jQuery para menu respontive -->
        <script type="text/javascript">
            $(document).ready(function(){
                //Obtenemos el link que contenga el id pull
                var pull=$('#pull');
                //Obtenemos todos las etiquetas ul que contenga la etiqueta nav
                var menu=$('ul');
                var html=$('html');
                //Guardamos la altura del menú en una variable
                var menuHeight=menu.height();
                //Cuando haga clic en el link, realizaremos una función con pasando un parámetro
                $(pull).on('click', function(e) {
                    e.preventDefault();
                    menu.slideToggle();
                });  //Cierre del método on
                //Cuando la ventana se hace más pequeño, se realiza la siguiente función
                $(window).resize(function(){
                  //Gaurdamos en una variable el width de la ventana de forma local
                  var w=$(window).width();
                  //Si la anchura es mayor que 700px, el slider debe aparecer
                  if(w>700) {
                  //Eliminamos el atributo style del menú
                    menu.removeAttr('style');     
                  }
                //Cierre de la función resize
                });
            //Cierre de la función general    
            });
        </script> <!-- Cierre de jQuery del slider -->

	</head>

	<body>

		<div id="container"> 

		<header id="header"> 
	        <!-- Imagen corporativa -->
	        <div id="logo">
	            <a href="/index.php"><img class="imgLogo"/></a>
	            <!-- Botón del menú -->
	            <a href="#" id="pull"><img src="../images/nav-icon.png" /></a>
	        </div> <!-- Cierre del logo -->
	        <!-- Menú -->
	        <nav id="menu_nav">
	            <!-- Lista desordenada -->
	            <ul>
	                <!-- Item 1, Cartelera --> 
	                <li>
	                    <a href="cartelera.php" class="link"> Cartelera </a>
	                </li> <!-- Cierre de la Cartelera -->
	                <!-- Item 2, Próximamente --> 
	                <li>
	                    <a href="proximamente.php" class="link"> Próximamente </a>
	                </li> <!-- Cierre de la Próximamente -->
	                <!-- Item 3, Buscador --> 
	                <li>
	                    <!-- Caja de buscador -->
	                    <div id="buscador">
	                         <form method="get" action="/search" id="search">
	                            <input name="q" type="text" size="40" placeholder="Buscar pelicula" />
	                        </form>
	                    </div> <!-- Cierre de la caja del buscador -->
	                </li> <!-- Cierre de la Buscador -->
	                <!-- Items logueo -->
	                

	                    <?php

                            // Diseño en un archivo externo
	                        echo "<link href=\"../css/listaPelis.css\" rel=\"stylesheet\" type=\"text/css\" >";

                            // Se inicia sesión o reanuda la sesión
                            session_start();

                            if(!(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']!='')){

                                // Se incluye el archivo noLog que contiene los dos botones
                                include("../includes/noLog.html");


                            }
                            else{

                                // Link para ir al perfil de usuario
                                echo "<a href='profile.php' class='link'>Hola, <b>" . $_SESSION["nombreUsuario"]."</b></a>";

                                //Boton salir
                                include("../includes/log.html");

                            }

                        ?>

	            </ul> <!-- Cierre de la lista desordenada -->
	        </nav> <!-- Cierre del menú -->
		</header> <!-- Cierre del encabezado -->

		<!-- Representa el apartado de Cartelera -->
        <section id="cartelera">

			<h3> Cartelera </h3>

			<?php

				// Importamos el fichero database.php para la conexión a la base de datos en la nube
				include_once("../config/database.php");

				echo "<link href=\"../css/listaPelis.css\" rel=\"stylesheet\" type=\"text/css\" >";

				// Establecemos la colección
				$collection=$bd->peliculas;

				$cartelera=$collection->find(array("boxOffice" => "boxOffice"));

				//var_dump(iterator_to_array($cartelera));

				foreach ($cartelera as $campo => $valor) {

					echo "<div class='peli'>";

					foreach ($valor as $movie => $dato) {

						$titulo;
						$year;
						$runtime;
						$poster;

						if($movie=="poster"){

							$poster=$dato;						

						}

						echo "<div class='descrip'>";

						if($movie=="title"){

							$titulo=$dato;
							echo "<a href='perfil-peli.php?peli=$titulo'><img src=$poster></a>";
							echo "<h4><a href='perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";

						}

						if($movie=="year"){

							$year=$dato;
							echo $year. "<br>";

						}

						if($movie=="runtime"){

							$runtime=$dato;
							echo $runtime. " mins <br>";

						}

						echo "</div>";

					}

					echo "</div>";				      
				}

			?>

		</section> <!--Cierre de la Cartelera -->

        <!-- Pie de toda la página -->
        <?php include("../includes/footer.html"); ?>


		<!--Ventana Modal del Log In-->
        <?php include("../includes/ventanaModalLogin.html"); ?>


        <!--Ventana Modal del Sign In-->
        <?php include("../includes/ventanaModalSignin.html"); ?>

		</div> <!-- div de Container -->

		<script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>

	</body>

</html>