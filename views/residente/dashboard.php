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
            <div class="row justify-content-center animate__animated animate__backInDown">
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
                    <h1 class="tituloDashboard">Aportaciones del año</h1>
                </div>
            </div>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaCasasPendientes">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Casa</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Dueño</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="animate__animated animate__fadeIn">
                                <!-- Datos-->
                                <td>#69 ETAPA 3 BLOCK 6</td>
                                <td>Disponible</td>
                                <td>Eduardo Rivera</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="#" data-toggle="modal" data-target="#administrarCasa" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                                            
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div><br>
             <!-- Desde aqui termina la tabla -->
            <!-- Desde aqui finaliza el contenido -->
                    <!-- Modal para Editar Visitas -->
        <div class="modal fade" id="verPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mr-4 iconoModal"></span>Editar Pago</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <div class="row">
                            <!-- Primera columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                                <form id="EmpleadosColumna1">
                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Casa:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="#69, Etapa 3, Block 6">


                                    <div class="row">

                                        <div class="col-6 ">
                                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Estado:</label>
                                            <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                id="txtTelefonofijo" placeholder="Completado">

                                        </div>

                                        <div class="col-6 ">

                                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Monto:</label>
                                            <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                id="txtTelefonomovil" placeholder="$120">
                                        </div>

                                    </div>
                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Mes Pago:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="Febrero, 2021">
                                    

                                </form>

                            </div>
                            <!-- Segunda columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                                <form id="EmpleadosColumna1">
                                    
                                    <label class="tituloCajaTextoFormulario" for="txtObservacion">Descripción:</label>
                                    <textarea class="form-control cajaTextoFormulario"
                                        placeholder="Pago dirigido a mantenimiento de la piscina y ornamentación..." id="txtObservacion" rows="5"></textarea>

                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Fecha Pago:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="2021-04-21">

                                </form>

                            </div>
                        </div>
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>   