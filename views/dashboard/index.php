<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../resources/css/styles.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>

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
                                            <a class="btn boton my-3">Iniciar Sesión →</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <hr><h1 class="texto">  ¿Sucede algo?  </h1><hr>
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
   
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>