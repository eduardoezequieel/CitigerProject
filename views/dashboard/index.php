<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../resources/css/estilos.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet"> 

    <title>Iniciar Sesión | Citiger</title>
  </head>
  <body>
      <!-- Contenedor Principal -->
    <div class="container">
        <div id="contenedor">
            <div class="row">
                <!-- Imagen -->
                <div class="col-6 mt-5 pt-4">
                    <img id="imagenPrincipal" src="../../resources/img/fondologinresidencial5.png" class="img-fluid">
                </div>
    
                <!-- Contenido -->
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="row mt-3">
                        <div class="col-12">
                            <img id="CitigerLogo" src="../../resources/img/citigerDarkLogo.png" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="titulo mt-2">Iniciar Sesión</h1>
                            <div id="controlesInicio" class="mt-4">
                                <form>
                                    <!-- Input Correo -->
                                    <div class="form-group mb-4">
                                        <h1 class="tituloCajas">Correo Electrónico:</h1>
                                        <input type="email" class="form-control cajaTexto" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico...">
                                    </div>
                                    <!-- Input Contraseña -->
                                    <div class="form-group mb-1">
                                        <h1 class="tituloCajas">Contraseña:</h1>
                                        <input type="password" class="form-control cajaTexto  mb-1" id="exampleInputPassword1" placeholder="Ingrese su contraseña...">
                                        
                                        <input id="mostrarContraseña" type="checkbox" class="checkboxCitiger">
                                        <label class="checkboxLabel checkboxCitiger mt-2" for="mostrarContraseña">      Mostrar Contraseña</label>
                                    </div>
                                    <!-- Botones -->
                                    <div class="row justify-content-center">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <a href="dashboard.php" class="btn boton my-3">Iniciar Sesión →</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <h1 class="texto">  ¿Sucede algo?  </h1>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <a class="btn boton2 my-2">Olvide mi contraseña →</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
   
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
  </body>
</html> 