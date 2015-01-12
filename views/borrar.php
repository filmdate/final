<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

	<!-- Cabecera de toda la página -->
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> filmdate </title>
        <!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">
        <style type="text/css">

                .contenido{
                    text-align: center;
                    margin-top: 250px;
                }
                .contenido p{
                    color: #fff;
                    font-size: 18px;
                }
                .contenido h2{
                    color: #fff;
                    font-size: 32px;
                }

        </style>
	</head>
	<body  background="../images/cine.jpg" no-repeat center center fixed>	
    <!--MENU-->
        <nav class="navbar navbar-default" role="navigation"><!--inverse en vez de default, para que sea en negro el navegador-->
            <div class="container-fluid">
                <div class="navbar-header">
                    <!--Boton para el responsive-->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#acolapsar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="admin.php" class="navbar-brand">filmdate</a>
                </div>

                <div class="collapse navbar-collapse" id="acolapsar">
                    <ul class="nav navbar-nav">
                        <li><a href="#"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
                        <li class="dropdown">
                        <!--Seccion Desplegable-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Usuarios <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="anadir.html">Añadir</a></li>
                                <li><a href="listar.html">Listar</a></li>
                                <li><a href="borrar.php">Borrar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                        <!--Seccion Desplegable2-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-film"></span> Peliculas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="anadir.html">Añadir</a></li>
                                <li><a href="listar.html">Listar</a></li>
                                <li><a href="borrar.php">Borrar</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div>
                    <!--Buscador-->
                    <form action="./" class="navbar-form navbar-left">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                         <button class="btn btn-default" style="margin-top:8px;" onclick="location.href='salir.php'">
                         <span class="glyphicon glyphicon-off"></span></button>                     
                </div>
                </div>
            </div>
        </nav>

        <!--PARA CUANDO CLICKE UNA FILA
        <script type="text/javascript">
            $('.table > tr').click(function() {
                // row was clicked
            });
        </script>-->

        <div class="container" style="position:relative;top:50px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background:#4D4D4D;border:none;">Películas</div>
                <table class="table table-striped table-hover table-bordered">
                    
                    <tr class="info">
                     <th>Título</th>
                     <th>Duración</th>
                    </tr>
                <?php
                    include_once("../funciones/peliculas.php");
                    include_once("../config/database.php");
                    // Establecemos la colección
                    $collection=$bd->peliculas;

                    $pelis=$collection->find(array());



                    foreach ($pelis as $campo => $valor) {

                        foreach ($valor as $movies => $datos) {

                            if($movies=="_id"){
                            
                                echo "<tr id='$datos'>";
                                echo $datos;
                            }
                             
                        }
                        


                        foreach ($valor as $movie => $dato) {

                            $titulo;
                            $descripcion;

                            if($movie=="title"){

                                $titulo=$dato;
                                echo "<td>" . $titulo . "</td>";

                            }

                            if($movie=="synopsis"){

                                $descripcion=$dato;
                                echo "<td><p align='justify'>" . $descripcion . "</p></td>";
                            }
                             
                        }
                        echo "<td><a method='get' name='eliminar' onclick='eliminar($datos)'>Eliminar</a></td>";
                        echo "</tr>";
                    }

                ?>  
                </table>
            </div>
            <button name="borrar" type="submit" class="btn btn-primary" style="width:120px;background-color:#00B8E6;border:none;outline: none;"><span class="glyphicon glyphicon-minus"></span> Borrar</button>
                <p><br/>
        </div>
        <script type="text/javascript">
        function eliminar(id){          
            
            // con el método $.get hacemos una petición GET mediante AJAX con jQuery
            // 1. El primer parámetro es la dirección a donde se va a hacer la petición y los parámetros de la misma
            // en este caso el parámetro será el id de la persona que se va a eliminar.                 // 2. El segundo parámetro es la función que se va a ejecutar cuando se reciba la respuesta del servidor
            $.get('../model/borrar.php?id='+id, 
            function(data){
                if (data.exito != true){
                  alert('Error');
                }else{
                    // si la respuesta fue exitosa entonces eliminamos la fila de la tabla 
                    $('#fila_'+id).remove();
                }
            });                       
        }

        </script>
            
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>
	
</html>