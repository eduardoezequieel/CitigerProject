<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>
<link rel="stylesheet" href="../../resources/css/estilos3.css">
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Visitas</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarVisita"
                        class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form method="post" id="filtrarEstadoVisita-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Estado Visita:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                    cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                    deseado en el combobox  -->
                    <div class="cbCitigerBusqueda" id="cbc1">
                        <select class="custom-select" id="cbEstadoVisita" onchange="checkCb('cbc1')">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idEstadoVisita" id="idEstadoVisita" class="d-none">
                    <button class="d-none" id="btnFiltrarEstado" type="submit"></button>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span
                            class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
                

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="#">
                    <a type="button" href="../../app/reports/dashboard/visitas_semanales.php" id="btnReporte" target="_blank" data-toggle="tooltip" data-target="#" data-placement="bottom" title="Reporte de visitas semanal" class="btn botonesListado"><span class="fas fa-file-alt mr-3 tamañoIconosBotones"></span>Reporte</a>
                    </div>
                </div>
            </div>

        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div
            class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col">Residente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Recurrente</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Estado de la Visita</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para administrar visitas -->
<div class="modal fade" id="administrarVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                        class="fas fa-info-circle mr-4 iconoModal"></span>Visitas</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4">
                <form method="post" id="administrarVisita-form" autocomplete="off">
                    <input type="number" name="idVisita" id="idVisita" class="d-none">
                    <div class="row">
                        <div class="d-flex justify-content-center col-xl-6 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                        deseado en el combobox  -->
                                <div class="cbCitiger" id="cbc2">
                                    <select class="custom-select" id="cbResidente" name="cbResidente" onchange="checkCb('cbc2')">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <label class="tituloCajaTextoFormulario mt-2" for="cbResidente">Visitante:</label>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                        deseado en el combobox  -->
                                <div class="cbCitiger" id="cbc3">
                                    <select class="custom-select" id="cbVisitante" name="cbVisitante" onchange="checkCb('cbc3')">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <!-- RadioButtonGroup Género -->
                                <h1 class="tituloCajaTextoFormulario mb-2 mt-2">Visita Recurrente</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                        deseado en el combobox  -->
                                <div class="cbCitiger" id="cbc4">
                                    <select class="custom-select" id="cbVisitaR" name="cbVisitaR" onchange="checkCb('cbc4')">
                                        <option selected="default">Seleccionar...</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                                <input type="date" class="form-control cajaTextoModal" onchange="checkInput('txtFecha')" id="txtFecha" name="txtFecha"
                                    placeholder="">
                                <label class="tituloCajaTextoFormulario" for="txtObservacion">Observación:</label>
                                <textarea id="txtObservacion" name="txtObservacion" rows="4"
                                    class="form-control cajaTextoModal"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span
                                    class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                            <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span
                                    class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                            <button id="btnSuspender" class="btn btnAgregarFormulario mr-2"><span
                                    class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                            <button id="btnActivar" class="btn btnAgregarFormulario mr-2"><span
                                    class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>
                        </div>
                    </div>

                </form>

                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('visitas.js');
?>