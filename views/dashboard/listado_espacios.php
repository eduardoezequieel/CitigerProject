<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Espacios | Citiger');
?>    

    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Espacio</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center animate__animated animate__bounceIn">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones" id="">
                    <a href="agregar_espacio.php" class="btn botonesListado centrarBotones ml-5"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Nuevo Espacio</a>
                </div>

                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                    <form>
                        <input type="email" class="form-control buscador centrarBotones mr-5" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                           &#xf002;">
                    </form>
                </div>
            </div><br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp">
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 d-flex margenTarjetas justify-content-center align-items-center text-center">
                    <!-- Inicio de Tarjeta -->
                    <div class="tarjeta">
                        <!-- Fila para Imagen -->
                        <div class="row">
                            <div class="col-12">
                                <img src="../../resources/img/piscina.JPG" alt="" class="img-fluid imagenTarjeta">
                            </div>
                        </div>
                        <!-- Fila para Información -->
                        <div class="row mt-2">
                            <div class="col-12 text-left">
                                <h1 class="letraTarjetaTitulo">PISCINA</h1>
                                <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">20</span></h1>
                            </div>
                        </div>
                        <!-- Fila para Boton -->
                        <div class="row">
                            <div class="col-12">
                                <a href="editar_espacio.php" class="btn botonesTarjeta"><span class="fas fa-edit"></span></a>
                            </div>
                        </div>
                    <!-- Fin de Tarjeta -->
                    </div>
                </div>
                    <!-- Tarjetas de relleno -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas d-flex justify-content-center align-items-center text-center">
                    <div class="tarjeta">
                        <div class="row">
                            <div class="col-12">
                                <img src="../../resources/img/piscina.JPG" alt="" class="img-fluid imagenTarjeta">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-left">
                                <h1 class="letraTarjetaTitulo">PISCINA</h1>
                                <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">20</span></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <a href="editar_espacio.php" class="btn botonesTarjeta"><span class="fas fa-edit"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas d-flex justify-content-center align-items-center text-center">
                    <div class="tarjeta">
                        <div class="row">
                            <div class="col-12">
                                <img src="../../resources/img/piscina.JPG" alt="" class="img-fluid imagenTarjeta">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-left">
                                <h1 class="letraTarjetaTitulo">PISCINA</h1>
                                <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">20</span></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <a href="editar_espacio.php" class="btn botonesTarjeta"><span class="fas fa-edit"></span></a>
                            </div>
                        </div>
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