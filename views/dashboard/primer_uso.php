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
    <link rel="icon" type="image/png" href="../../resources/img/iconocitiger.png" />


    <title>Primer Uso | Citiger</title>
  </head>
  <body>
    <input type="text" id="txtModo" class="d-none" text="">
      <!-- Contenedor Principal -->
    <div class="flex-column" id="container2">

        <div class="row mt-3 mb-2">
            <div class="col-12">
                <h1 class="tituloDato text-center">Primer Uso</h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-12">
                <h1 class="campoDato text-center px-4">Hemos detectado que no existe ningún usuario 
                    registrado, por favor escriba sus credenciales para crear una cuenta.</h1>
            </div>
        </div>

        <form id="primeruso-form" method="post" autocomplete="off">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Nombres:</label>
                            <input type="text" name="txtNombre" id="txtNombre" onchange="checkInputLetras('txtNombre')" class="form-control cajaTextoFormulario widthRegister" Required maxlength="30">
                        </div>
                    
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Apellidos:</label>
                            <input type="text" name="txtApellido" id="txtApellido" class="form-control cajaTextoFormulario widthRegister" onchange="checkInputLetras('txtApellido')" Required maxlength="30">
                        </div>
                    
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Usuario:</label>
                            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control cajaTextoFormulario widthRegister" onchange="checkInput('txtUsuario')" Required maxlength="25">
                        </div>
                    
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Fecha de Nacimiento:</label>
                            <input type="date" name="txtNacimiento" id="txtNacimiento" class="form-control cajaTextoFormulario widthRegister" Required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Correo:</label>
                            <input type="email" name="txtCorreo" id="txtCorreo" class="form-control cajaTextoFormulario widthRegister" onchange="checkCorreo('txtCorreo')" Required maxlength="50">
                        </div>
                    
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Confirmar Correo:</label>
                            <input type="text" name="txtCorreoConfirmar" id="txtCorreoConfirmar" class="form-control cajaTextoFormulario widthRegister" onchange="checkCorreo('txtCorreoConfirmar')" Required maxlength="50">
                        </div>
                    
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Contraseña:</label>
                            <input type="password" name="txtContrasenia" id="txtContrasenia" class="form-control cajaTextoFormulario widthRegister" onchange="checkInput('txtContrasenia')" Required maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Confirmar Contraseña:</label>
                            <input type="password" name="txtContraseniaConfirmar" id="txtContraseniaConfirmar" class="form-control cajaTextoFormulario widthRegister" onchange="checkInput('txtContraseniaConfirmar')" Required maxlength="50">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Teléfono Fijo:</label>
                            <input type="text" name="txtFijo" id="txtFijo" class="form-control cajaTextoFormulario widthRegister mb-0" onchange="checkTelefono('txtFijo')" Required maxlength="9">
                        </div>
                        <div class="form-group">
                            <label for="" class="tituloCajaTextoFormulario">Teléfono Celular:</label>
                            <input type="text" name="txtCelular" id="txtCelular" class="form-control cajaTextoFormulario widthRegister mb-0" onchange="checkTelefono('txtCelular')" Required maxlength="9">
                        </div>

                        <label for="" class="tituloCajaTextoFormulario">Género:</label>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitiger widthRegister">
                            <select class="custom-select" id="txtGenero" name="txtGenero">
                                <option selected="">Seleccionar...</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select> 
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="tituloCajaTextoFormulario">DUI:</label>
                            <input type="text" name="txtDui" id="txtDui" class="form-control cajaTextoFormulario widthRegister mb-0" onchange="checkDui('txtDui')" Required maxlength="10">
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <!-- Cargar Fotografia -->
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="bordeDivFotografia">
                                <div class="divFotografia" id="divFoto">
                                    <!--<img src="../../resources/img/67641302_948622395468919_4792483860753416192_n.jpg" alt="#" class="fit-images rounded-circle" width="150px">-->
                                </div>
                            </div>
                            <div id="btnAgregarFoto">
                                <button class="btn btnCargarFoto2 mx-2" id="botonFoto"><span class="fas fa-plus" ></span></button>
                            </div>
                            <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="tituloCajaTextoFormulario">Dirección:</label>
                        <textarea class="form-control cajaTextoFormulario widthRegister heightDireccion" name="txtDireccion" id="txtDireccion" onChange="checkInput('txtDireccion')" Required maxlength="200"></textarea>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-4">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn botonesListado"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Finalizar</button>
                </div>
            </div>
        </form>
    </div>
   
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../app/controllers/dashboard/primer_uso.js"></script>
    <script>document.getElementById('txtModo').value = 'light'</script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
  </body>
</html> 