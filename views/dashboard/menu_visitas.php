<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
?>
<link rel="stylesheet" href="../../resources/css/estilos3.css">
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido1">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div id="menuAlqui">
            <div class="row justify-content-center mb-4">
                <div class="col justify-content-center d-flex">
                    <h1 class="tituloMenu">Seleccione una opción</h1>
                </div>
            </div>
            <!-- Menú -->
            <div class="row">
                <!-- Opción "alquiler" de menú -->
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                    <a href="listado_visitantes.php" class="btn botonMenu1">
                        <i class="fas fa-child iconosBotonesMenu"></i>
                        <label class="textoBotonesMenu">Visitantes</label>
                    </a>
                </div>

                <!-- Opción "espacios" de menú -->
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                    <a href="listado_visitas.php" class="btn botonMenu2">
                        <i class="fas fa-address-book iconosBotonesMenu"></i>
                        <label class="textoBotonesMenu">Visitas</label>
                    </a>
                </div>
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