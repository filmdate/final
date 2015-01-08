<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

	<!-- Cabecera de toda la página -->
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title> filmdate </title>

        <!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />

		<link rel="stylesheet" href="../css/main.css" /> <!-- El diseño está en un archivo externo -->

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
        <!-- jQuery de slider -->
        <script type="text/javascript" src="../js/slider.js"></script> <!-- jQuery slider -->
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
        
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>	

		<!-- Engloba todas las etiquetas -->
		<div id="container"> 

            <!-- Encabezado de toda la página -->                    
            <?php include("includes/headerInicio.html"); ?>

            <!-- Representa el slider-->
            <div class="slider">  

                <!-- jQuery handles to place the header background images -->
                <div id="headerimgs">

                    <div id="headerimg1" class="headerimg"></div>
                    <div id="headerimg2" class="headerimg"></div>

                </div> <!-- Cierre de headerimgs -->

                <!-- Slideshow controls -->
                <div id="headernav-outer">

                    <!-- Botones de navegador -->
                    <div id="headernav">

                        <div id="back" class="btn"></div>
                        <div id="next" class="btn"></div>

                    </div> <!-- Cierre de nav -->

                </div> <!-- Cierre de los controles del slideshow -->

            </div> <!-- Cierre del slider -->



            <!-- Representa el apartado de Cartelera -->
            <section id="cartelera">
                <!-- Boton para ir hacia abajo -->
                <div id="div_abajo">
                    <center><span style="font-size:20px;color:grey;" class="glyphicon glyphicon-chevron-down glyphicon-refresh-animate"></span></center>
                 </div> <!-- Cierre del btn_abajo -->

                <h3> Cartelera </h3>

                <?php

                    echo "<link href=\"../css/main.css\" rel=\"stylesheet\" type=\"text/css\" >";

                    // Establecemos la colección
                    $collection=$bd->peliculas;

                    $cartelera=$collection->find(array("boxOffice" => "boxOffice"))->limit(5);

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
                                echo "<a href='views/perfil-peli.php?peli=$titulo'><img src=$poster></a>";
                                echo "<h4><a href='views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";

                            }

                            if($movie=="year"){

                                $year=$dato;
                                echo "<p>" . $year. "</p>";

                            }

                            if($movie=="runtime"){

                                $runtime=$dato;
                                echo "<p>" . $runtime. " mins </p>";

                            }

                            echo "</div>";
                        }

                        echo "</div>";
                    }

                ?>     

                <div class="vermas" onclick="location.href='views/cartelera.php'">
                    <span class="glyphicon glyphicon-plus"</span>
                </div>       

            </section> <!--Cierre de la Cartelera -->

            <!-- Representa el apartado de Próximamente -->
            <section id="proximamente">

                <h3> Próximamente </h3>

                <?php

                    echo "<link href=\"../css/main.css\" rel=\"stylesheet\" type=\"text/css\" >";

                    // Establecemos la colección
                    $collection=$bd->peliculas;

                    $proximamente=$collection->find(array("upcoming" => "upcoming"))->limit(5);

                    foreach ($proximamente as $campo => $valor) {

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
                                echo "<a href='views/perfil-peli.php?peli=$titulo'><img src=$poster></a>";
                                echo "<h4><a href='views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";

                            }

                            if($movie=="year"){

                                $year=$dato;
                                echo "<p>" . $year. "</p>";

                            }

                            if($movie=="runtime"){

                                $runtime=$dato;
                                echo "<p>" . $runtime. " mins </p>";

                            }

                            echo "</div>";      

                        }

                        echo "</div>";                
                    }

                ?>
                <div class="vermas" onclick="location.href='views/proximamente.php'">
                    <span class="glyphicon glyphicon-plus"</span>
                </div>


            </section> <!--Cierre de la Próximamente -->

            <!-- Pie de toda la página -->
            <?php include("includes/footer.html"); ?>


            <!--Ventana Modal del Log In-->
            <?php include("includes/ventanaModalLogin.html"); ?>


            <!--Ventana Modal del Sign In-->
            <?php include("includes/ventanaModalSignin.html"); ?>

             
         </div> <!-- Cierre div del container -->

        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>

	</body>
	
</html>