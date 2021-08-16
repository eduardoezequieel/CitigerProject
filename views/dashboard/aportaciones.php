<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Aportaciones | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Casas</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarCasa" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{Número, dirección}                                                                          &#xf002;">
                </form>

                <form method="post" id="filtrarTipoEmpleado-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                    cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                    deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbTipoEmpleado">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idTipoEmpleado" id="idTipoEmpleado" class="d-none">
                    <button class="d-none" id="btnFiltrarEmpleado" type="submit"></button>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="../../app/reports/dashboard/residentes_mora.php" id="btnReporte" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-file-alt mr-3 tamañoIconosBotones"></span>Reporte</a>
                </div>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>

            </div>

        </div><br>


        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaCasasPendientes">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Casa</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">



                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar Casa -->
<div class="modal fade" id="administrarCasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Casas</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="adminCasa-form">
                    <div class="row">
                        <input class="d-none" type="number" id="txtId" name="txtId" />
                        <div class="col-12">
                            <label class="tituloCajaTextoFormulario" for="txtNum">Número de Casa:</label>
                            <input type="text" class="form-control cajaTextoModal" id="txtNum" name="txtNum" placeholder="Escriba el número de casa..." required>

                            <label class="tituloCajaTextoFormulario" for="txtUbicacion">Ubicación:</label>
                            <textarea class="form-control cajaTextoModal" id="txtUbicacion" name="txtUbicacion" rows="3" placeholder="Escriba los detallles de la ubicación de la casa..."></textarea>
                        </div>
                    </div>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                            <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                            <button id="btnSuspender" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                            <button id="btnActivar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>
                        </div>
                    </div>
                </form>

                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Administrar Pagos -->
<div class="modal fade" id="administrarPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Pagos</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="casa-form" enctype="multipart/form-data">
                    <input class="d-none" type="number" id="txtIdx" name="txtIdx" />
                    <input class="d-none" type="number" id="txtIdAportacion" name="txtIdAportacion" />

                </form>
                <!-- Desde aqui comienza el contenido -->
                <div class="row justify-content-center mb-3">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <h1 class="tituloPagina text-center">Registro de Aportaciones</h1>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-12 d-flex justify-content-center">
                        <form method="post" id="filtrarAportacion-form" class="mx-3">
                            <h1 class="tituloCajaTextoFormulario">Año:</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                            deseado en el combobox  -->
                            <div class="cbCitiger">
                                <select class="custom-select" id="cbAnio">
                                    <option selected="">Seleccionar...</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <input class="d-none" type="number" id="txtId2" name="txtId2" />
                            <input type="number" name="anio" id="anio" class="d-none">
                            <button class="d-none" id="btnFiltrar" type="submit"></button>
                        </form>
                    </div>
                </div>

                <!-- Información de la Casa -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                        <form>
                            <h1 class="tituloDato text-center">Casa:</h1>
                            <label class="campoDato text-center" id="casa"></label>
                        </form>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                        <form>
                            <h1 class="tituloDato text-center">Fecha:</h1>
                            <label class="campoDato text-center" id="lblFecha"></label>
                        </form>
                    </div>
                </div>

                <br>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-4 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable" id="data-table2">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha Limite</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows2">
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<!-- Modal para agregar pagos de años siguientes -->
<div class="modal fade" id="agregarPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Pagos</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="adminPagos-form">
                    <input class="d-none" type="number" id="Casa" name="Casa" />
                    <div class="row justify-content-center mb-3">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h1 class="tituloPagina text-center">Registro de Aportaciones</h1>

                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">

                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                            <h1 class="tituloDato text-center" id="casa2"></h1>
                        </div>

                    </div>
                    <div class="row animate__animated animate__bounceIn">
                        <!-- Primera columna de controles -->
                        <div class="col-xl-6 mb-4 col-md-12 col-sm-12 col-xs-12  centrarColumnas">
                            <div class="#" id="EmpleadosColumna1">

                                <!-- Select para años -->
                                <h1 class="tituloCajaTextoFormulario mb-2">Año</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger">
                                    <select class="custom-select" id="cbAnio2" name="cbAnio2">
                                        <option selected="">Seleccionar...</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                    <input type="number" name="anio2" id="anio2" class="d-none">

                                </div>
                            </div>
                        </div>

                        <!-- Segunda columna de controles -->
                        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 mt-4 centrarColumnas">
                                <button id="btnAgregarPago" type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                        </div>
                    </div>

                </form>
                <br>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('aportaciones.js');
?>