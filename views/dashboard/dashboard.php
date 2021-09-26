<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Admin_Page::sidebarTemplate('Dashboard | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars tamañoIconos"></i></button>

            <?php
                Admin_Page::welcomeMessage();
            ?>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas" id="tarjeta_denuncia">
                    <!-- Inicio de Tarjeta -->
                    <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                        <!-- Boton de opciones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="denuncias.php">Denuncias</a>
                                        <a class="dropdown-item" href="#">Generar Reporte</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Icono -->
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <i class="fas fa-exclamation-triangle icono1"></i>
                            </div>
                        </div>
                        <!-- Labels -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="tituloTarjetaDashboard">Denuncias por Atender</h1>
                                <h1 class="contadorTarjetaDashboard mt-1" id="txtDenuncia">0</h1>
                            </div>
                        </div>
                    <!-- Final de Tarjeta -->
                    </div>
                </div>

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas" id="tarjeta_visita">
                    <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                        <div class="row">
                            <div class="col-12">
                            <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard2" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="visitas.php">Visitas</a>
                                        <a class="dropdown-item" href="#">Generar Reporte</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <i class="fas fa-car-side icono2"></i>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="tituloTarjetaDashboard">Visitas<br>Vigentes</h1>
                                <h1 class="contadorTarjetaDashboard mt-1" id="txtVisitas">0</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas" id="tarjeta_aportacion">
                    <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                        <div class="row">
                            <div class="col-12">
                            <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard3" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="aportaciones.php">Aportaciones</a>
                                        <a class="dropdown-item" href="#">Generar Reporte</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <i class="fas fa-money-bill-wave icono3"></i>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="tituloTarjetaDashboard">Aportaciones Pendientes del mes</h1>
                                <h1 class="contadorTarjetaDashboard mt-1" id="txtAportaciones">0</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Titulo -->
            <div class="row my-4" id="rowTitulo">
                <div class="col-12">
                    <h1 class="tituloDashboard">Ultimos 6 Meses</h1>
                </div>
            </div>

            <!--  Graficas de Visitas y Denuncias -->
            <div class="row justify-content-center align-items-center animate__animated animate__fadeInUp" id="rowGraficaVisitas">
                <div class="margenGraficas d-flex justify-content-center align-items-center">
                    <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                        <div class="tarjetaDashboardGrafica" id="graficaVisitas">
                            <div id="contenedorVisitas">
                                <canvas class="#" id="cnVisitas6Meses"></canvas>
                            </div>
                            <div id="noVisitas" class="d-none">
                                <i class="fas fa-sad-tear icono4"></i>
                                <h1 class="tituloTarjetaDashboard text-center my-4">No hay visitas</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center mtResponsive">
                        <div class="tarjetaDashboardGrafica" id="graficaDenuncias">
                            <div class="graficasCuadradas">
                                <canvas class="#" id="cnEstadoDenuncia"></canvas>
                            </div>
                            <div id="noDenuncias" class="d-none">
                                <i class="fas fa-sad-tear icono4"></i>
                                <h1 class="tituloTarjetaDashboard text-center my-4">No hay denuncias</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <button id="btnCollapseGraficas" class="btn bg-darken" type="button" data-toggle="collapse" data-target="#graficasCollapse" aria-expanded="false" aria-controls="graficasCollapse"><i id="iconoCollapse" class="fas fa-caret-down animate__animated animate__swing"></i></button>
                </div>
            </div>

            <div class="collapse" id="graficasCollapse">
                <div class="row justify-content-center align-items-center mt-4">
                    <div class="margenGraficas2 d-flex justify-content-center align-items-center" id="grafica_materiales">
                        <!-- Grafica de productos demandados -->
                        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                            <div class="tarjetaDashboardGrafica">
                                <div id="graficaProducto" class="graficasCuadradas">
                                    <canvas class="#" id="cnProductoDemandado"></canvas>
                                </div>
                                <div id="noProductos" class="d-none">
                                    <i class="fas fa-sad-tear icono4"></i>
                                    <h1 class="tituloTarjetaDashboard text-center my-4">No hay productos</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Grafica de historial de inventario -->
                        <div class="mtResponsive col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                            <div class="tarjetaDashboardGrafica" id="graficaHistorialInventario2">
                                <form method="post" id="historialInventario-form" class="d-none">
                                    <input type="number" id="txtIdMaterial" name="txtIdMaterial" value="1">
                                    <button type="submit" id="btnFormHistorial"></button>
                                </form>
                                <div id="graficaInventario" class=#>
                                    <button data-toggle="modal" data-target="#historialInventario" id="btnModalInventario" class="btn bg-darken float-right"><i class="fas fa-edit"></i></button>
                                    <h1 class="tituloGrafica text-center">Historial de Inventario por Material</h1>
                                    <div id="graficaHistorialInventario">
                                        <canvas class="#" id="cnHistorialInventario"></canvas>
                                    </div>
                                </div>
                                <div id="noInventario" class="d-none">
                                    <i class="fas fa-sad-tear icono4"></i>
                                    <h1 class="tituloTarjetaDashboard text-center my-4">No hay productos :(</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mt-4">
                    <div class="mtResponsive col-12 d-flex justify-content-center align-items-center">
                        <!-- Grafica de visitas por residente -->
                        <div class="tarjetaDashboardGrafica" id="graficaVisitasResidente">
                            <form class="d-none" method="post" id="residenteVisita-form">
                                <input type="number" value="1" id="idresidente" name="idresidente">
                                <button type="submit" id="btnResidenteVisita"></button>
                            </form>
                            <div id="graficaResidente">
                                <button data-toggle="modal" data-target="#residenteVisita" id="btnModalResidente" class="btn bg-darken float-right"><i class="fas fa-edit"></i></button>
                                <h1 class="tituloGrafica text-center">Historial de Visitas por Residente</h1>
                                <div id="contenedorGraficaVisitasResidente">
                                    <canvas class=# id="cnVisitasResidente"></canvas>
                                </div>
                            </div>
                            <div id="noVisitasResidente" class="d-none">
                                <i class="fas fa-sad-tear icono4"></i>
                                <h1 class="tituloTarjetaDashboard text-center my-4">No hay visitas para este residente :(</h1>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row justify-content-center align-items-center mt-4">
                    <div class="margenGraficas d-flex justify-content-center align-items-center">
                        <!-- Grafica de la cantidad de veces que un espacio ha sido usado -->
                        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                            <div class="tarjetaDashboardGrafica" id="graficaEspacio">
                                <form method="post" class="d-none" id="espacioVeces-form">
                                    <input type="number" value="3" id="idespacio" name="idespacio">
                                    <button type="submit" id="btnEspacio"></button>
                                </form>
                                <div id="graficaEspacioVeces">
                                    <button data-toggle="modal" data-target="#espacioVeces" id="btnModalEspacio" class="btn bg-darken float-right"><i class="fas fa-edit"></i></button>
                                    <h1 class="tituloGrafica text-center">Historial de Usos por Espacio del Último Semestre</h1>
                                    <div id="contenedorGraficaEspacio">
                                        <canvas id="cnEspacioVeces"></canvas>
                                    </div>
                                </div>
                                <div id="noEspacioVeces" class="d-none">
                                    <i class="fas fa-sad-tear icono4"></i>
                                    <h1 class="tituloTarjetaDashboard text-center my-4">No hay usos para este espacio :(</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Grafica de espacios demandados -->
                        <div class="mtResponsive col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                            <div class="tarjetaDashboardGrafica">
                                <div class="graficasCuadradas" id="graficaEspacios">
                                    <canvas class="#" id="cnEspacioDemandado" width="230"></canvas>
                                </div>
                                <div id="noEspacio" class="d-none">
                                    <i class="fas fa-sad-tear icono4"></i>
                                    <h1 class="tituloTarjetaDashboard text-center my-4">No hay espacios</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mt-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <!-- Grafica de aportaciones por estado por mes y año -->
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="tarjetaDashboardGrafica" id="graficaAportacionesInicio">
                                <form method="post" class="d-none" id="aportacionesEstado-form">
                                    <input type="number" id="idmespago" name="idmespago" value="1">
                                    <button type="submit" id="btnMesPago"></button>
                                </form>
                                <div id="graficaAportaciones">
                                    <button data-toggle="modal" data-target="#mesAño" id="btnModalAportaciones" class="btn bg-darken float-right"><i class="fas fa-edit"></i></button>
                                    <h1 class="tituloGrafica text-center">Porcentaje Mensual de Aportaciones por Estado</h1>
                                    <div id="contenedorGraficaAportaciones">
                                        <canvas id="cnAportaciones"></canvas>
                                    </div>
                                </div>
                                <div id="noAportaciones" class="d-none">
                                    <i class="fas fa-sad-tear icono4"></i>
                                    <h1 class="tituloTarjetaDashboard text-center my-4">No hay aportaciones en este mes:    (</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Actividad Reciente -->
            <div class="row my-4" id="titulo_tabla">
                <div class="col-12">
                    <h1 class="tituloDashboard">Actividad Reciente</h1>
                </div>
            </div>
            <!-- Tabla-->
            <div class="row justify-content-center table-responsive animate__animated animate__fadeInUp tablaResponsive" id="tablaDashboard">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable" id="data-table2">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Accion</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                            
                        </tbody>
                    </table>
                </div>
            </div><br>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<!-- Modal para ver detalles de la bitacora -->
<div class="modal fade" id="bitacoraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Bitacora</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row justify-content-center">
                    <div class="d-flex flex-column justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <div class="bordeDivFotografia mb-1">
                                <div class="divFotografia" id="divFoto">
                                    <!--<img src="../../resources/img/67641302_948622395468919_4792483860753416192_n.jpg" alt="#" class="fit-images rounded-circle" width="150px">-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h1 class="text-center tituloDato" id="txtUsuario">edu4rdorivera</h1>
                        </div>
                    </div>
                    <div class=" d-flex flex-column justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <h1 class="text-center tituloDato2">Hora</h1>
                            <h1 class="text-center campoDato" id="txtHora"></h1>
                        </div>
                        <div class="form-group">
                            <h1 class="text-center tituloDato2">Fecha</h1>
                            <h1 class="text-center campoDato" id="txtFecha"></h1>
                        </div>
                        <div class="form-group">
                            <h1 class="text-center tituloDato2">Acción</h1>
                            <h1 class="text-center campoDato" id="txtAccion"></h1>
                        </div>
                        <div class="form-group">
                            <h1 class="text-center tituloDato2">Descripción</h1>
                            <h1 class="text-center campoDato" id="txtDescripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis magni deleniti rem, harum at tenetur exercitationem vel nobis sapiente, iste sit. Pariatur consectetur saepe magnam neque suscipit tempore maxime nam!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para seleccionar un producto del inventario -->
<div class="modal fade" id="historialInventario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccione un material</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Busqueda -->
                <div class="row justify-content-center">
                    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                        <form class="mx-3 mb-2" method="post" id="search-form-historialInventario">
                            <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                            <input type="text" class="form-control buscador" id="search-historialInventario" name="search-historialInventario" aria-describedby="emailHelp" placeholder="{ Material }">
                        </form>   

                        <div class="mt-4 mx-3 mb-3">
                            <a href="#" id="btnReiniciarMovimientos" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                        </div>
                    </div>
                </div>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-3 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Material</th>
                                    <th scope="col">Movimientos</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows2">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Desde aqui termina la tabla --><br>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<!-- Modal para seleccionar un residente -->
<div class="modal fade" id="residenteVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccione un residente</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Busqueda -->
                <div class="row justify-content-center">
                    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                        <form class="mx-3 mb-2" method="post" id="search-form-residenteVisita">
                            <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                            <input type="text" class="form-control buscador" id="search-residenteVisita" name="search-residenteVisita" aria-describedby="emailHelp" placeholder="{ Residente }">
                        </form>   

                        <div class="mt-4 mx-3 mb-3">
                            <a href="#" id="btnReiniciarResidentes" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                        </div>
                    </div>
                </div>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-3 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Residente</th>
                                    <th scope="col">Visitas</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows3">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Desde aqui termina la tabla --><br>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para seleccionar un espacio -->
<div class="modal fade" id="espacioVeces" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccione un espacio</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Busqueda -->
                <div class="row justify-content-center">
                    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                        <form class="mx-3 mb-2" method="post" id="search-form-espacioVeces">
                            <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                            <input type="text" class="form-control buscador" id="search-espacioVeces" name="search-espacioVeces" aria-describedby="emailHelp" placeholder="{ Espacio }">
                        </form>   

                        <div class="mt-4 mx-3 mb-3">
                            <a href="#" id="btnReiniciarEspacios" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                        </div>
                    </div>
                </div>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-3 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Espacios</th>
                                    <th scope="col">Usos</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows4">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Desde aqui termina la tabla --><br>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para seleccionar un mes y año -->
<div class="modal fade" id="mesAño" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccione un mes</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Busqueda -->
                <div class="row justify-content-center">
                    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                        <form class="mx-3 mb-2" method="post" id="search-form-anoMes">
                            <h1 class="tituloCajaTextoFormulario">Año:</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                            deseado en el combobox  -->
                            <div class="cbCitiger">
                                <select class="custom-select" id="cbAnio">
                                </select>
                            </div>
                        </form>   
                    </div>
                </div>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-3 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Aportaciones</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows5">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Desde aqui termina la tabla --><br>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
Admin_Page::footerTemplate('dashboard.js');
?>   