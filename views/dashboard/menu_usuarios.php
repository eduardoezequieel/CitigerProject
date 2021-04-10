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
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="listado_empleados.php" class="btn botonMenu1">
                            <img src="../../resources/img/employee.png" alt="" class="img-fluid" width="50px">
                            <label class="textoBotonesMenu">Empleados</label>
                        </a>
                    </div>

                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href=listado_admin.php class="btn botonMenu2">
                            <img src="../../resources/img/usuario.png" alt="" class="img-fluid" width="66px">
                            <label class="textoBotonesMenu">Administradores</label>
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col d-flex justify-content-center align-items-center">
                        <a href="listado_residentes.php" class="btn botonMenu3">
                            <img src="../../resources/img/resident.png" alt="" class="img-fluid" width="76px">
                            <label class="textoBotonesMenu">Residentes</label>
                        </a>
                    </div>
                </div>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>   