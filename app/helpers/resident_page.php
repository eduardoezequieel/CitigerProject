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
            
                <!-- Fuentes -->
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet"> 
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet"> 

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
                    <div class="media d-flex align-items-center">
                        <img src="../../resources/img/citigerDarkLogo2.png" alt="" class="img-fluid pl-3 pt-1" width="140px">
                    </div>
                    </div>
                    
                    <!-- Perfil -->
                    <div id="tarjeta">
                        <div id="tarjetaPerfil" class="p-3">
                            <div class="row">
                                <div class="col-3">
                                   <img src="../../resources/img/140025816_1267548823644856_116407320835883935_n.jpg" alt="" class="redondearImg" width="60px">
                                </div>
                            <div class="col-9">
                                <label for="ajustes" class="pl-4 pt-2" id="usuario">Eduardo Rivera</label>
                                <label for="ajustes" class="pl-4" id="tipoUsuario">Residente</label>
                            </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12" id="filaBotones">
                                    <div id="botones">
                                    <a href="#" class="btn fas fa-cog botonesPerfil" id="ajustes"></a>
                                    <a href="index.php" class="btn fas fa-sign-out-alt botonesPerfil" id="cerrar"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Botones de Navegación -->
                    <ul class="nav flex-column colorCitiger mt-4">
                    <li class="nav-item">
                        <a href="listado_alquiler.php" class="nav-link categoriasFuente">
                        <i class="fas fa-home mr-3 tamañoIconos"></i>
                        Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link categoriasFuente">
                        <i class="fas fa-coins mr-3 tamañoIconos"></i>
                        Aportaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link categoriasFuente">
                        <i class="fas fa-exclamation-triangle mr-3 tamañoIconos"></i>
                        Denuncias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_visitas.php" class="nav-link categoriasFuente">
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
                    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
                </body>
                </html> 
            ');
        }
    }
?>