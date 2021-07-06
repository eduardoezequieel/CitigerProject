<?php
    class Admin_Page{
        public static function sidebarTemplate($titulo){
            // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
            session_start();
            // Se imprime el código HTML de la cabecera del documento.
            print('
                <!doctype html>
                <html lang="es">
                <head onload="loadPage()">
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
                    <link type="text/css" rel="stylesheet" href="../../resources/css/vanilla-dataTables.min.css"/>
                
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
            ');

            // Se obtiene el nombre del archivo de la página web actual.
            $filename = basename($_SERVER['PHP_SELF']);
            // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
            if (isset($_SESSION['idusuario'])) {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a 'primer_uso.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a index.php
                if ($filename != 'index.php' && $filename != 'primer_usuario.php') {
                    // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                    print('
                        <!-- Inicio del Sidebar -->
                        <div class="vertical-nav colorCitiger" id="sidebar">
                            <div class="py-3 px-3 colorCitiger">
                                <div class="media d-flex">
                                    <a href="dashboard.php" id="btnDashboard" class="btn btnInicio"><img
                                            src="../../resources/img/citigerDarkLogo2.png" alt="#" id="imgDashboard"
                                            class="img-fluid" width="140px"></a>
                                </div>
                            </div>

                            <!-- Perfil -->
                            <div id="tarjeta">
                                <div id="tarjetaPerfil" class="p-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="../../resources/img/dashboard_img/usuarios_fotos/' . $_SESSION['foto'] . '"
                                                id="fotoPerfil" alt="" class="rounded-circle fit-images" width="60px"
                                                height="60px">
                                        </div>
                                        <div class="col-9">
                                            <label for="ajustes" class="pl-4 pt-2" id="usuario">'. $_SESSION['usuario'].'</label>
                                            <label for="ajustes" class="pl-4" id="tipoUsuario">'. $_SESSION['tipousuario'].'</label>
                                            <input type="text" id="txtModo" class="d-none" value="'. $_SESSION['modo'].'">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12" id="filaBotones">
                                            <div id="botones">
                                                <a href="ajustes_cuenta.php" class="btn fas fa-cog botonesPerfil"
                                                    id="ajustes"></a>
                                                <a href="#" class="btn fas fa-sign-out-alt botonesPerfil" id="cerrar"
                                                    onclick="logOut()"></a>
                                                <a href="#" class="btn fas fa-sun botonesPerfil" id="lightMode"
                                                    onclick="lightMode()"></a>
                                                <a href="#" class="btn fas fa-moon botonesPerfil" id="darkMode"
                                                    onclick="darkMode()"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Botones de Navegación -->
                            <ul class="nav flex-column colorCitiger mt-4">
                            <li class="nav-item">
                                <a href="menu_alquileres.php" class="nav-link ">
                                <i class="fas fa-home mr-3 tamañoIconos"></i>
                                Alquileres
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="aportaciones.php" class="nav-link ">
                                <i class="fas fa-coins mr-3 tamañoIconos"></i>
                                Aportaciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="denuncias.php" class="nav-link ">
                                <i class="fas fa-exclamation-triangle mr-3 tamañoIconos"></i>
                                Denuncias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="menu_materiales.php" class="nav-link ">
                                <i class="fas fa-boxes mr-3 tamañoIconos"></i>
                                Materiales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="menu_usuarios.php" class="nav-link ">
                                <i class="fas fa-users-cog mr-3 tamañoIconos"></i>
                                Usuarios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="menu_visitas.php" class="nav-link ">
                                <i class="fas fa-car mr-3 tamañoIconos"></i>
                                Visitas
                                </a>
                            </li>
                            </ul>
                        </div>
                        <!-- Fin del sidebar -->
                    ');
                } else {
                    header('location: index.php');
                }
            } else {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a 'primer_uso.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
                if ($filename != 'index.php' && $filename != 'primer_uso.php') {
                    header('location: index.php');
                } 
            }
        }

        public static function welcomeMessage()
        {
            print('
                <div class="row my-4">
                    <div class="col-12">
                        <h1 class="tituloDashboard">¡Bienvenido '.$_SESSION['usuario'].'!</h1>
                    </div>
                </div>
            '                
            );
        }

        public static function footerTemplate($controller){
            print('
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
                    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
                    <script src="../../app/controllers/dashboard/'.$controller.'"></script>
                    <script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>
                    <script src="../../resources/js/sweetalert.min.js"></script>
                    <script src="../../app/helpers/components.js"></script>
                </body>
                </html> 
            ');
        }
    }
?>