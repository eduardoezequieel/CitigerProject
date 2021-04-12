<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
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
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                    <a href="agregar_visitante.php" class="btn botonMenu1">
                        <img src="../../resources/img/grupo.png" alt="" class="img-fluid" width="100px">
                        <label class="textoBotonesMenu">Visitantes</label>
                    </a>
                </div>

                <!-- Opción "espacios" de menú -->
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                    <a href="agregar_visita.php" class="btn botonMenu2">
                        <img src="../../resources/img/carro.png" alt="" class="img-fluid" width="100px">
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