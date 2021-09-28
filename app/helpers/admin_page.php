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
                    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">

                    <!-- Estilos -->
                    <link rel="stylesheet" href="../../resources/css/citigerstyles.css">
                    <link rel="stylesheet" href="../../resources/css/all.min.css">
                    <link rel="stylesheet" href="../../resources/css/fontawesome.min.css">
                    <link rel="stylesheet" href="../../resources/css/animate.min.css">
                    <link rel="icon" type="image/png" href="../../resources/img/iconocitiger.png" />
                
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
            if (isset($_SESSION['idusuario_dashboard'])) {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a 'primer_uso.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a index.php
                if ($filename != 'index.php' && $filename != 'primer_usuario.php') {
                    /*
                        Declarando variables con las partes del sidebar
                    */
                    $inicio_sidebar = '
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
                                            <img src="../../resources/img/dashboard_img/usuarios_fotos/' . $_SESSION['foto_dashboard'] . '"
                                                id="fotoPerfil" alt="" class="rounded-circle fit-images" width="60px"
                                                height="60px">
                                        </div>
                                        <div class="col-9">
                                            <label for="ajustes" class="pl-4 pt-2" id="usuario">'. $_SESSION['usuario_dashboard'].'</label>
                                            <label for="ajustes" class="pl-4" id="tipoUsuario">'. $_SESSION['tipousuario_dashboard'].'</label>
                                            <input type="text" id="txtModo" class="d-none" value="'. $_SESSION['modo_dashboard'].'">
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
                            <ul class="nav flex-column colorCitiger mt-4">';
                    $opcion1 = '<li class="nav-item">
                                    <a href="menu_alquileres.php" class="nav-link ">
                                    <i class="fas fa-home mr-3 tamañoIconos"></i>
                                    Alquileres
                                    </a>
                                </li>';
                    $opcion2 = '<li class="nav-item">
                                    <a href="aportaciones.php" class="nav-link ">
                                    <i class="fas fa-coins mr-3 tamañoIconos"></i>
                                    Aportaciones
                                    </a>
                                </li>';
                    $opcion3 = '<li class="nav-item">
                                    <a href="denuncias.php" class="nav-link ">
                                    <i class="fas fa-exclamation-triangle mr-3 tamañoIconos"></i>
                                    Denuncias
                                    </a>
                                </li>';
                    $opcion4 = '<li class="nav-item">
                                    <a href="menu_materiales.php" class="nav-link ">
                                    <i class="fas fa-boxes mr-3 tamañoIconos"></i>
                                    Materiales
                                    </a>
                                </li>';
                    $opcion5 = '<li class="nav-item">
                                    <a href="menu_usuarios.php" class="nav-link ">
                                    <i class="fas fa-users-cog mr-3 tamañoIconos"></i>
                                    Usuarios
                                    </a>
                                </li>';
                    $opcion6 = ' <li class="nav-item">
                                    <a href="menu_visitas.php" class="nav-link ">
                                    <i class="fas fa-car mr-3 tamañoIconos"></i>
                                    Visitas
                                    </a>
                                </li>';
                    $fin_sidebar = '</ul>
                                </div>
                                <!-- Fin del sidebar -->';
                    $inicio_navbar = '<!-- Inicio del navbar para dispositivos moviles -->
                                    <nav id="navbar" class="d-none navbar sticky-top navbar-expand-lg">
                                        <a class="navbar-brand" href="dashboard.php">
                                            <img src="../../resources/img/citigerWhiteLogo2.png" alt="#" id="imgDashboard2"
                                                class="img-fluid" width="120px"></a>
                                        </a>
                                        <button class="btn bg-darken2 mt-2 float-right" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="fas fa-caret-down"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-center align-items-center">
                                                    <div id="tarjeta">
                                                        <div id="tarjetaPerfil" class="p-3">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <img src="../../resources/img/dashboard_img/usuarios_fotos/' . $_SESSION['foto_dashboard'] . '"
                                                                        id="fotoPerfil" alt=""
                                                                        class="rounded-circle fit-images" width="60px"
                                                                        height="60px">
                                                                </div>
                                                                <div class="col-9">
                                                                    <label for="ajustes" class="pl-4 pt-2" id="usuario">'.
                                                                        $_SESSION['usuario_dashboard'].'</label>
                                                                    <label for="ajustes" class="pl-4" id="tipoUsuario">'.
                                                                        $_SESSION['tipousuario_dashboard'].'</label>
                                                                    <input type="text" id="txtModo" class="d-none"
                                                                        value="'. $_SESSION['modo_dashboard'].'">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-12" id="filaBotones">
                                                                    <div id="botones">
                                                                        <a href="ajustes_cuenta.php"
                                                                            class="btn fas fa-cog botonesPerfil"
                                                                            id="ajustes"></a>
                                                                        <a href="#"
                                                                            class="btn fas fa-sign-out-alt botonesPerfil"
                                                                            id="cerrar" onclick="logOut()"></a>
                                                                        <a href="#" class="btn fas fa-sun botonesPerfil"
                                                                            id="lightMode2" onclick="lightMode()"></a>
                                                                        <a href="#" class="btn fas fa-moon botonesPerfil"
                                                                            id="darkMode2" onclick="darkMode()"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="navbar-nav mr-auto d-flex justify-content-center align-items-center colorCitiger mt-4 bg-dark">
                                            <div>';
                    $opcion1_nav = '<li class="nav-item">
                                    <a href="menu_alquileres.php" class="nav-link ">
                                        <i class="fas fa-home mr-3 tamañoIconos"></i>
                                        Alquileres
                                    </a>
                                </li>';
                    $opcion2_nav = '<li class="nav-item">
                                        <a href="aportaciones.php" class="nav-link ">
                                            <i class="fas fa-coins mr-3 tamañoIconos"></i>
                                            Aportaciones
                                        </a>
                                    </li>';
                    $opcion3_nav = '<li class="nav-item">
                                        <a href="denuncias.php" class="nav-link ">
                                            <i class="fas fa-exclamation-triangle mr-3 tamañoIconos"></i>
                                            Denuncias
                                        </a>
                                    </li>';
                    $opcion4_nav = '<li class="nav-item">
                                        <a href="menu_materiales.php" class="nav-link ">
                                            <i class="fas fa-boxes mr-3 tamañoIconos"></i>
                                            Materiales
                                        </a>
                                    </li>';   
                    $opcion5_nav = '<li class="nav-item">
                                        <a href="menu_usuarios.php" class="nav-link ">
                                            <i class="fas fa-users-cog mr-3 tamañoIconos"></i>
                                            Usuarios
                                        </a>
                                    </li>'; 
                    $opcion6_nav = '<li class="nav-item">
                                        <a href="menu_visitas.php" class="nav-link ">
                                            <i class="fas fa-car mr-3 tamañoIconos"></i>
                                            Visitas
                                        </a>
                                    </li>';
                    $fin_navbar = '</div>
                                    </ul>
                                </div>
                            </nav>';                        
                    //Declarando contador para evaluar que opción imprimir
                    $contador = 1;
                    $contadorNav = 1;
                    //Creación de array para evaluar todos los permisos
                    $permisos = $_SESSION['permisos'];
                    foreach($permisos as $permiso){
                        //Imprimiendo el inicio del sidebar
                        if ($contador == 1){
                            echo $inicio_sidebar;
                        }
                        //Evaluando que permisos tiene permitido para imprimir la opción
                        if ($permiso['permitido'] == '1') {
                            switch($permiso['permiso']) {
                                //Opción de alquileres
                                case 'Alquileres':
                                    echo $opcion1;
                                    break;
                                //Opción de aportaciones
                                case 'Aportaciones':
                                    echo $opcion2;
                                    break;
                                //Opción de denuncias
                                case 'Denuncias':
                                    echo $opcion3;
                                    break;
                                //Opción de materiales
                                case 'Materiales':
                                    echo $opcion4;
                                    break;
                                //Opción de usuarios
                                case 'Usuarios':
                                    echo $opcion5;
                                    break;
                                //Opción de visitas
                                case 'Visitas':
                                    echo $opcion6;
                                    break;
                            }
                        }
                        //Imprimiendo el final del sidebar
                        if($contador == 6) {
                            echo $fin_sidebar;
                        }
                        $contador++;
                    }

                    //Creación de array para evaluar todos los permisos
                    $permisosNav = $_SESSION['permisos'];
                    foreach($permisosNav as $permisoNav){
                        //Imprimiendo el inicio del sidebar
                        if ($contadorNav == 1){
                            echo $inicio_navbar;
                        }
                        //Evaluando que permisos tiene permitido para imprimir la opción
                        if ($permisoNav['permitido'] == '1') {
                            switch($permisoNav['permiso']) {
                                //Opción de alquileres
                                case 'Alquileres':
                                    echo $opcion1_nav;
                                    break;
                                //Opción de aportaciones
                                case 'Aportaciones':
                                    echo $opcion2_nav;
                                    break;
                                //Opción de denuncias
                                case 'Denuncias':
                                    echo $opcion3_nav;
                                    break;
                                //Opción de materiales
                                case 'Materiales':
                                    echo $opcion4_nav;
                                    break;
                                //Opción de usuarios
                                case 'Usuarios':
                                    echo $opcion5_nav;
                                    break;
                                //Opción de visitas
                                case 'Visitas':
                                    echo $opcion6_nav;
                                    break;
                            }
                        }
                        //Imprimiendo el final del sidebar
                        if($contador == 6) {
                            echo $fin_navbar;
                        }
                        $contadorNav++;
                    }
                    
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
                        <h1 class="tituloDashboard">¡Bienvenido '.$_SESSION['usuario_dashboard'].'!</h1>
                    </div>
                </div>
            '                
            );
        }

        public static function footerTemplate($controller){
            print('
                    <script src="../../resources/js/jquery-3.5.1.slim.min.js"></script>
                    <script src="../../resources/js/popper.min.js"></script>
                    <script src="../../resources/js/bootstrap.min.js"></script>
                    <script src="../../app/controllers/dashboard/'.$controller.'"></script>
                    <script src="../../resources/js/datatables.min.js"></script>
                    <script src="../../resources/js/sweetalert.min.js"></script>
                    <script src="../../resources/js/chart.min.js"></script>
                    <script src="../../app/helpers/components.js"></script>
                </body>
                </html> 
            ');
        }
    }
?>