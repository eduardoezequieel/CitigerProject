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
                <h1 class="tituloPagina text-center">Editar Datos de Visita</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                        placeholder="OLIVER PÉREZ">

                    <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtcbResidente"
                        placeholder="2021-08-12">


                    <!-- RadioButtonGroup Visita recurrente -->
                    <h1 class="tituloCajaTextoFormulario mb-3">Visita recurrente:</h1>
                    <div class="row justify-content-center">
                        <div class="col d-flex justify-content-center align-items-center text-center">
                            <div class="generoRadioButtons">
                                <label class="container pr-5">Si
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container pr-5">No
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <label class="tituloCajaTextoFormulario" for="txtObservacion">Observación:</label>
                    <textarea class="form-control cajaTextoFormulario"
                        placeholder="El visitante podría venir en otro carro" id="txtObservacion" rows="5"></textarea>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="btn btnEditarFormulario"><span
                                    class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>

                            <a href="#" class="btn btnEditarFormularioIcono"><span
                                    class="fas fa-edit tamañoIconosBotones"></span></a>

                            <a href="#" class="btn btnEditarFormulario"><span
                                    class="fas fa-minus mr-3 tamañoIconosBotones"></span>Eliminar</a>

                            <a href="#" class="btn btnEditarFormularioIcono"><span
                                    class="fas fa-minus tamañoIconosBotones"></span></a>
                        </div>
                    </div>

                </form>

            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginSegundaColumna centrarColumnas contenedorDetalle1">
                <div>
                    <br>
                    <form class="contenedorDetalle">
                        <h3 class="subtituloPaginaV text-center">Añadir detalle de visita</h3><br>

                        <!-- Controles -->
                        <label class="tituloCajaTextoFormulario" for="cbVisitante">Visitante:</label>
                        <input type="text" class="form-control cajaTextoFormulario" id="cbVisitante"
                            placeholder="KARLA VALERIA RIOS MONTANO">

                        <!-- Botones de Acción del Formulario -->
                        <div class="row justify-content-center mt-4 botonVisita">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <a href="#" class="btn btnEditarFormulario"><span
                                        class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>

                                <a href="#" class="btn btnEditarFormularioIcono"><span
                                        class="fas fa-edit tamañoIconosBotones"></span></a>

                                <a href="#" class="btn btnEditarFormulario"><span
                                        class="fas fa-minus mr-3 tamañoIconosBotones"></span>Eliminar</a>

                                <a href="#" class="btn btnEditarFormularioIcono"><span
                                        class="fas fa-minus tamañoIconosBotones"></span></a>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>