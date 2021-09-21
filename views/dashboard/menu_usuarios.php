<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Usuarios | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
                <div class="row justify-content-center mb-4">
                    <div class="col justify-content-center d-flex">
                        <h1 class="tituloMenu">Seleccione una opción</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                        <a href="empleados.php" class="btn botonMenu1">
                            <i class="fas fa-user-tie iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Empleados</label>
                        </a>
                    </div>

                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                        <a href=admin.php class="btn botonMenu2">
                            <i class="fas fa-user-shield iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Administradores</label>
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                        <a href="residentes.php" class="btn float-right botonMenu3">
                            <i class="fas fa-user iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Residentes</label>
                        </a>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                        <a href="permisos.php" class="btn botonMenu4">
                            <i class="fas fa-cogs iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Permisos</label>
                        </a>
                    </div>
                </div>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('noarchivo.js');
?>   