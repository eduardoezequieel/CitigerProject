<?php
    class admin_Page{
        public static function sidebarTemplate($titulo){
            print('
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
                <link rel="stylesheet" href="../../resources/css/estilos2.css">
                <link rel="stylesheet" href="../../resources/css/estilosControles.css">
                <link rel="stylesheet" href="../../resources/css/estilos4.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
            
                <!-- Fuentes -->
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                <meta http-equiv="Expires" content="0">
                <meta http-equiv="Last-Modified" content="0">
                <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                <meta http-equiv="Pragma" content="no-cache">

                <title>'.$titulo.'</title>
              </head>
              <body>
                <!-- Inicio del Sidebar -->
                <div class="vertical-nav colorCitiger" id="sidebar">
                    <div class="py-3 px-3 colorCitiger">
                    <div class="media d-flex">
                        <a href="dashboard.php" class="btn btnInicio"><img id="imgDashboard" src="../../resources/img/citigerDarkLogo2.png" alt="" class="img-fluid" width="140px"></a>
                    </div>
                    </div>
                    
                    <!-- Perfil -->
                    <div id="tarjeta">
                        <div id="tarjetaPerfil" class="p-3">
                            <div class="row">
                                <div class="col-3">
                                   <img src="../../resources/img/140025816_1267548823644856_116407320835883935_n.jpg" alt="" class="redondearImg fit-images" height="60px" width="60px">
                                </div>
                            <div class="col-9">
                                <label for="ajustes" class="pl-4 pt-2" id="usuario">Eduardo Rivera</label>
                                <label for="ajustes" class="pl-4" id="tipoUsuario">Residente</label>
                                <input type="text" id="txtModo" class="d-none" value="light">
                            </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12" id="filaBotones">
                                    <div id="botones">
                                        <a href="ajustes_cuenta.php" class="btn fas fa-cog botonesPerfil" id="ajustes"></a>
                                        <a href="index.php" class="btn fas fa-sign-out-alt botonesPerfil" id="cerrar"></a>
                                        <a href="index.php" class="btn fas fa-adjust botonesPerfil" id="modo"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Botones de Navegación -->
                    <ul class="nav flex-column colorCitiger mt-4">
                    <li class="nav-item">
                        <a href="alquileres.php" class="nav-link categoriasFuente">
                        <i class="fas fa-home mr-3 tamañoIconos"></i>
                        Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="denuncias.php" class="nav-link categoriasFuente">
                        <i class="fas fa-exclamation-triangle mr-3 tamañoIconos"></i>
                        Denuncias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="visitas.php" class="nav-link categoriasFuente">
                        <i class="fas fa-car mr-3 tamañoIconos"></i>
                        Visitas
                        </a>
                    </li>
                    </ul>
                </div>
                <!-- Fin del sidebar -->
            ');
        }

        public static function footerTemplate(){
            print('
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
                    <script src="../../app/controllers/js/main.js"></script>
                    <script src="../../app/helpers/components.js"></script>
                    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
                </body>
                </html> 
            ');
        }
    }
?>