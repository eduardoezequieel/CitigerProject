<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Materiales | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido" class="menuDiv">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
                <div class="row justify-content-center mb-4 mt-5 pt-4">
                    <div class="col justify-content-center d-flex">
                        <h1 class="tituloMenu">Seleccione una opción</h1>
                    </div>
                </div>

                <div class="row pb-5">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="listado_pedidos.php" class="btn botonMenu1">
                            <img src="../../resources/img/lend.png" alt="" class="img-fluid" width="90px">
                            <label class="textoBotonesMenu">Pedidos</label>
                        </a>
                    </div>

                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="listado_inventario.php" class="btn botonMenu2">
                            <img src="../../resources/img/stock.png" alt="" class="img-fluid" width="66px">
                            <label class="textoBotonesMenu">Inventario</label>
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