<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Dashboard | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

            <div class="row my-4">
                <div class="col-12">
                    <h1 class="tituloDashboard">¡Bienvenido Edenilson!</h1>
                </div>
            </div>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-5">
                <div class="col justify-content-center text-center d-flex">
                    <h1 class="tituloMenu">¿Cómo desea verificar la visita?</h1>
                </div>
            </div>

            <div class="row pb-5 animate__animated animate__backInDown">
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                    <a href="verificar_dui.php" class="btn botonMenu1">
                        <i class="fas fa-id-card iconosBotonesMenu"></i>
                        <label class="textoBotonesMenu">DUI</label>
                    </a>
                </div>

                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                    <a href="verificar_placa.php" class="btn botonMenu2 float-left">
                        <i class="fas fa-car-side iconosBotonesMenu"></i>
                        <label class="textoBotonesMenu">Placa</label>
                    </a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="tituloMenu text-white text-center">Datos Recientes</h1>
                </div>
            </div>

            

            <div class="row justify-content-center animate__animated animate__backInUp">
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <div class="tarjetaDashboard">
                        <div class="row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
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
                                <h1 class="contadorTarjetaDashboard mt-1">30</h1>
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