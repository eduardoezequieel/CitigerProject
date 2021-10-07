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
                
                    <!-- Fuentes -->
                    <link rel="preconnect" href="https://fonts.gstatic.com">
                    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
                    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">


                    <meta http-equiv="Expires" content="0">
                    <meta http-equiv="Last-Modified" content="0">
                    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                    <meta http-equiv="Pragma" content="no-cache">
                    <link rel="icon" type="image/png" href="../../resources/img/iconocitiger.png" />


                    <title>'.$titulo.'</title>
                </head>
                <body>
            ');

            // Se obtiene el nombre del archivo de la página web actual.
            $filename = basename($_SERVER['PHP_SELF']);
            // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
            if (isset($_SESSION['idusuario_caseta'])) {
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
                                        <img src="http://34.125.88.216/resources/img/dashboard_img/usuarios_fotos/' . $_SESSION['foto_caseta'] . '"
                                            id="fotoPerfil" alt="" class="rounded-circle fit-images" width="60px"
                                            height="60px">
                                    </div>
                                    <div class="col-9">
                                        <label for="ajustes" class="pl-4 pt-2" id="usuario">'. $_SESSION['usuario_caseta'].'</label><br>
                                        <label for="ajustes" class="pl-4" id="tipoUsuario">'. $_SESSION['tipousuario_caseta'].'</label>
                                        <input type="text" id="txtModo" class="d-none" value="'. $_SESSION['modo_caseta'].'">
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
                                <a href="#" class="nav-link" id="lightModeCaseta"
                                onclick="lightMode3()"><i class="fas fa-sun mr-3 tamañoIconos"></i>Dia</a>
                                <a href="#" class="nav-link" id="darkModeCaseta"
                                onclick="darkMode3()"><i class="fas fa-moon mr-3 tamañoIconos"></i>Nocturno</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" onclick="logOut3()" class="nav-link ">
                                <i class="fas fa-sign-out-alt mr-3 tamañoIconos"></i>
                                Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Fin del sidebar -->

                    <!-- Inicio del navbar para dispositivos moviles -->
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
                            <!-- Perfil -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <div id="tarjeta">
                                        <div id="tarjetaPerfil" class="p-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="../../resources/img/dashboard_img/usuarios_fotos/' . $_SESSION['foto_caseta'] . '"
                                                        id="fotoPerfil" alt="" class="rounded-circle fit-images" width="60px"
                                                        height="60px">
                                                </div>
                                                <div class="col-9">
                                                    <label for="ajustes" class="pl-4 pt-2" id="usuario">'. $_SESSION['usuario_caseta'].'</label><br>
                                                    <label for="ajustes" class="pl-4" id="tipoUsuario">'. $_SESSION['tipousuario_caseta'].'</label>
                                                    <input type="text" id="txtModo" class="d-none" value="'. $_SESSION['modo_caseta'].'">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="navbar-nav mr-auto d-flex justify-content-center align-items-center colorCitiger mt-4 bg-dark">
                                <div>
                                    <li class="nav-item">
                                        <a href="../../views/caseta/ajustes_cuenta.php" class="nav-link">
                                            <i class="fas fa-cog mr-3 tamañoIconos"></i>
                                            Ajustes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="lightModeCaseta" onclick="lightMode3()"><i
                                                class="fas fa-sun mr-3 tamañoIconos"></i>Dia</a>
                                        <a href="#" class="nav-link" id="darkModeCaseta" onclick="darkMode3()"><i
                                                class="fas fa-moon mr-3 tamañoIconos"></i>Nocturno</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" onclick="logOut3()" class="nav-link ">
                                            <i class="fas fa-sign-out-alt mr-3 tamañoIconos"></i>
                                            Cerrar Sesión
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </nav>
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
                        <h1 class="tituloDashboard">¡Bienvenido '.$_SESSION['usuario_caseta'].'!</h1>
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
                    <script src="../../app/controllers/caseta/'.$controller.'"></script>
                    <script src="../../resources/js/datatables.min.js"></script>
                    <script src="../../resources/js/sweetalert.min.js"></script>
                    <script src="../../app/helpers/components.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
 
                    <script>
                        var modo = document.getElementById(\'txtModo\').value;
                        if (modo == \'light\') {
                            document.getElementById(\'lightModeCaseta\').className = \'d-none\';
                            document.getElementById(\'darkModeCaseta\').className = \'nav-link\';
                        } else if (modo == \'dark\') {
                            document.getElementById(\'lightModeCaseta\').className = \'nav-link\';
                            document.getElementById(\'darkModeCaseta\').className = \'d-none\';
                        }
                    </script>
                </body>
                </html> 
            ');
        }
    }
?>