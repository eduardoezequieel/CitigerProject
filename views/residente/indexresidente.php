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
                <div class="col-12">
                    <h1 class="tituloDashboard">¡Bienvenido Eduardo!</h1>
                </div>
            </div>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <!-- Inicio de Tarjeta -->
                    <div class="tarjetaDashboard">
                        <!-- Boton de opciones -->
                        <div class="row">
                            <div class="col-12">
                                <a href="" class="btn btnTarjetaDashboard3"><span class="fas fa-ellipsis-v"></span></a>
                            </div>
                        </div>
                        <!-- Icono -->
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <i class="fas fa-money-bill-wave icono3"></i>
                            </div>
                        </div>
                        <!-- Labels -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="tituloTarjetaDashboard">Aportaciones Pendientes</h1>
                                <h1 class="contadorTarjetaDashboard mt-1">14</h1>
                            </div>
                        </div>
                    <!-- Final de Tarjeta -->
                    </div>
                </div>

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <div class="tarjetaDashboard">
                        <div class="row">
                            <div class="col-12">
                                <a href="" class="btn btnTarjetaDashboard2"><span class="fas fa-ellipsis-v"></span></a>
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

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <div class="tarjetaDashboard">
                        <div class="row">
                            <div class="col-12">
                                <a href="" class="btn btnTarjetaDashboard"><span class="fas fa-ellipsis-v"></span></a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <i class="fas fa-exclamation-triangle icono1"></i>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="tituloTarjetaDashboard">Denuncias realizadas</h1>
                                <h1 class="contadorTarjetaDashboard mt-1">2</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Actividad Reciente -->
            <div class="row my-4">
                <div class="col-12">
                    <h1 class="tituloDashboard">Aportaciones pendientes y mora</h1>
                </div>
            </div>
            <!-- Desde aqui comienza la tabla -->
            <div class="row">
                <div class="col">
                    <table class="table table-dark table-hover table-responsive-lg tablaAportacion">
                        <thead class="tituloTabla">
                            <tr>
                                <th class="pl-5 pt-4"></th>
                                <th class="pl-5 pt-4">Casa</th>
                                <th class="pl-4 pt-4">Monto</th>
                                <th class="pl-5 pt-4">Fecha</th>
                                <th class="pl-5 pt-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th scope="row" class="d-flex justify-content-center boto"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td class="primer" >#99, ETAPA 6, BLOCK 5</td>
                                <td class="primer" id="align">$66.72</td>
                                <td class="primer" id="align">2021-04-12</td>
                                <th scope="row" class="boto1">
                                    <a href="" class="btn botonesListadoTabla"><i class="fas fa-eye"></i>  Ver</a>
                                    <a href="" class="btn botonesListadoTablaIcono"><i class="fas fa-eye"></i>  Ver</a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#99, ETAPA 6, BLOCK 5</td>
                                <td>$66.72</td>
                                <td>2021-01-12</td>
                                <th scope="row">
                                    <a href="" class="btn botonesListadoTabla"><i class="fas fa-eye"></i>  Ver</a>
                                    <a href="" class="btn botonesListadoTablaIcono"><i class="fas fa-eye"></i>  Ver</a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#22, ETAPA 1, BLOCK 19</td>
                                <td>$66.72</td>
                                <td>2021-04-12</td>
                                <th scope="row">
                                    <a href="" class="btn botonesListadoTabla"><i class="fas fa-eye"></i>  Ver</a>
                                    <a href="" class="btn botonesListadoTablaIcono"><i class="fas fa-eye"></i>  Ver</a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#25, ETAPA 1, BLOCK 8</td>
                                <td>$66.72</td>
                                <td>2021-03-12</td>
                                <th scope="row">
                                <a href="" class="btn botonesListadoTabla"><i class="fas fa-eye"></i>  Ver</a>
                                    <a href="" class="btn botonesListadoTablaIcono"><i class="fas fa-eye"></i>  Ver</a>
                                </th>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div><br>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>   