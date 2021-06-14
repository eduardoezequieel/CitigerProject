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

                <title>'.$titulo.'</title>
              </head>
              <body>
                <!-- Inicio del Sidebar -->
                <div class="vertical-nav colorCitiger" id="sidebar">
                    <div class="py-3 px-3 colorCitiger">
                    <div class="media d-flex">
                    <a href="dashboard.php" class="btn btnInicio2"><img src="../../resources/img/citigerDarkLogo2.png" alt="" class="img-fluid" width="140px"></a>
                    </div>
                    </div>
                    
                    <!-- Perfil -->
                    <div id="tarjeta">
                        <div id="tarjetaPerfil" class="p-3">
                            <div class="row">
                                <div class="col-3">
                                   <img src="../../resources/img/ppEdenilson.png" alt="" class="redondearImg" width="60px">
                                </div>
                                <div class="col-9">
                                    <label for="ajustes" class="pl-4 pt-2" id="usuario">Edenilson Ramírez</label>
                                    <label for="ajustes" class="pl-4" id="tipoUsuario">Caseta</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                
                    <!-- Botones de Navegación -->
                    <ul class="nav flex-column colorCitiger mt-4">
                        <li class="nav-item">
                            <a href="../../views/caseta/ajustes_cuenta.php" class="nav-link ">
                            <i class="fas fa-cog mr-3 tamañoIconos"></i>
                            Ajustes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                            <i class="fas fa-adjust mr-3 tamañoIconos"></i>
                            Dia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../views/caseta/index.php" class="nav-link ">
                            <i class="fas fa-sign-out-alt mr-3 tamañoIconos"></i>
                            Cerrar Sesión
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