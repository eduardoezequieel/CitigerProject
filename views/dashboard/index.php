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
    <link rel="stylesheet" href="../../resources/css/citigerstyles.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet"> 

    <title>Iniciar Sesión | Citiger</title>
  </head>
  <body>
      <input type="text" id="txtModo" class="d-none" text="">
      <!-- Contenedor Principal -->
    <div id="containerr">
        <div id="contenedor">   
            <div class="row justify-content-center">
                <!-- Imagen -->
                <div class="col-6 col-md-6 col-sm-12 col-xs-12 mt-5 pt-4" id="imagenInicio">
                    <img id="imagenPrincipal" src="../../resources/img/Interaction Design-pana.png" class="img-fluid animate__animated animate__bounceIn animate__slow">
                </div>
                <!-- Contenido -->
                <div class="d-flex justify-content-center align-items-center col-xl-6 col-md-12 col-sm-12 col-xs-12">
                    <form method="post" id="login-form">
                        <div class="row my-2">
                            <div class="col-12">
                                <img id="CitigerLogo" src="../../resources/img/CitigerWhiteLogo.png" alt="" class="img-fluid animate__animated animate__bounceIn animate__slow">
                                <h1 class="titulo mt-2 animate__animated animate__bounceIn animate__slow">Iniciar Sesión</h1>
                            </div>
                        </div>
                        <!-- Input Correo -->
                        <div class="form-group mb-4 animate__animated animate__bounceIn animate__slow">
                            <h1 class="tituloCajasLogin">Correo Electrónico:</h1>
                            <input type="email" class="form-control cajaTextoLogin" id="txtCorreo" name="txtCorreo" aria-describedby="emailHelp" onChange="checkCorreo('txtCorreo')" placeholder="Ingrese su correo electrónico..." Required>
                        </div>
                        <!-- Input Contraseña -->
                        <div class="form-group mb-1 animate__animated animate__bounceIn animate__slow">
                            <h1 class="tituloCajasLogin">Contraseña:</h1>
                            <input type="password" class="form-control cajaTextoLogin  mb-1" id="txtContrasenia" name="txtContrasenia" onChange="checkInput('txtContrasenia')" placeholder="Ingrese su contraseña..." Required>
                            
                            <input id="mostrarContraseña" type="checkbox" class="checkboxCitiger" onChange="showHidePassword('mostrarContraseña', 'txtContrasenia')">
                            <label class="checkboxLabel checkboxCitiger mt-2" for="mostrarContraseña">      Mostrar Contraseña</label>
                        </div>
                        <!-- Botones -->
                        <div class="row justify-content-center animate__animated animate__bounceIn animate__slow">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button class="btn botonLogin my-3" type="submit">Iniciar Sesión →</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center animate__animated animate__bounceIn animate__slow">
                                <h1 class="texto">  ¿Sucede algo?  </h1>
                            </div>
                        </div>
                        <div class="row justify-content-center animate__animated animate__bounceIn animate__slow">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <a class="btn botonLogin2 my-2">Olvide mi contraseña →</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../app/controllers/dashboard/index.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script>document.getElementById('txtModo').value = 'light'</script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
  </body>
</html> 