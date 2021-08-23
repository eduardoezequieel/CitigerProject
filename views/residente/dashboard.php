<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Dashboard | Citiger');
?>
<link rel="stylesheet" href="../../resources/css/estilos3.css">
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <div class="row my-4">
            <?php
            Admin_Page::welcomeMessage();
            ?>
        </div>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <!-- Inicio de Tarjeta -->
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <!-- Boton de opciones -->
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
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
                            <h1 class="tituloTarjetaDashboard">Denuncias Realizadas</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtDenuncia">0</h1>
                        </div>
                    </div>
                    <!-- Final de Tarjeta -->
                </div>
            </div>

            <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
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
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
                                <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Aportaciones</a>
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
                            <h1 class="tituloTarjetaDashboard">Aportaciones Pendientes</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtAportaciones">0</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Actividad Reciente -->
        <div class="row my-4">
            <div class="col-12">
                <h1 class="tituloDashboard">Aportaciones del año</h1>
            </div>
        </div>
        <!-- Desde aqui comienza la tabla -->
        <div class="row justify-content-center table-responsive animate__animated animate__fadeInUp tablaResponsive" id="tablaCasasPendientes">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table2">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha Limite</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        
                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

        <!-- Fin del Modal -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('dashboard.js');
?>