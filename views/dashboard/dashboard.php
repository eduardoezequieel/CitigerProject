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

            <div class="row my-4">
                <div class="col-12">
                    <h1 class="tituloDashboard">¡Bienvenido Eduardo!</h1>
                </div>
            </div>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <!-- Inicio de Tarjeta -->
                    <div class="tarjetaDashboard animate__animated animate__backInDown">
                        <!-- Boton de opciones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="listado_denuncias.php">Denuncias</a>
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
                                <h1 class="contadorTarjetaDashboard mt-1">14</h1>
                            </div>
                        </div>
                    <!-- Final de Tarjeta -->
                    </div>
                </div>

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <div class="tarjetaDashboard animate__animated animate__backInDown">
                        <div class="row">
                            <div class="col-12">
                            <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard2" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="listado_visitas.php">Visitas</a>
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

                <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
                <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                    <div class="tarjetaDashboard animate__animated animate__backInDown">
                        <div class="row">
                            <div class="col-12">
                            <div class="dropdown">
                                    <button class="btn btnTarjetaDashboard3" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-ellipsis-v"></span></button>
                                    <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="listado_denuncias.php">Aportaciones</a>
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
                                <h1 class="contadorTarjetaDashboard mt-1">2</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Actividad Reciente -->
            <div class="row my-4">
                <div class="col-12">
                    <h1 class="tituloDashboard">Actividad Reciente</h1>
                </div>
            </div>
            <!-- Tabla-->
            <div class="row justify-content-center table-responsive animate__animated animate__backInUp tablaResponsive" id="tablaDashboard">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
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
                        <tbody>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/ppEdenilson.png" alt="" class="img-fluid rounded-circle" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>Edenilson Ramírez</td>
                                <td>7:30:49</td>
                                <td>3/4/2021</td>
                                <td>Actualizar</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/ppEdenilson.png" alt="" class="img-fluid rounded-circle" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>Edenilson Ramírez</td>
                                <td>7:30:49</td>
                                <td>3/4/2021</td>
                                <td>Actualizar</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/ppEdenilson.png" alt="" class="img-fluid rounded-circle" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>Edenilson Ramírez</td>
                                <td>7:30:49</td>
                                <td>3/4/2021</td>
                                <td>Actualizar</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
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
Admin_Page::footerTemplate('dashboard.js');
?>   