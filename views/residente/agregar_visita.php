<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
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
                <h1 class="tituloPagina text-center">Agregar Nueva Visita</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                        placeholder="Seleccionar...">

                    <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtcbResidente" placeholder="AAAA-MM-DD">


                    <!-- RadioButtonGroup Visita recurrente -->
                    <h1 class="tituloCajaTextoFormulario mb-3">Visita recurrente:</h1>
                    <div class="row justify-content-center">
                        <div class="col d-flex justify-content-center align-items-center text-center">
                            <div class="generoRadioButtons">
                                <label class="container pr-5">Si
                                    <input type="radio" name="radio">
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
                    <textarea class="form-control cajaTextoFormulario" placeholder="Escriba la observación..."
                        id="txtObservacion" rows="5"></textarea>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="btn btnAgregarFormulario"><span
                                    class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Visita</a>
                        </div>
                    </div>
                    
                </form>
            
            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas contenedorDetalle1">
                <div>
                    <br>
                    <form class="contenedorDetalle">
                        <h3 class="subtituloPaginaV text-center">Añadir detalle de visita</h3><br>

                        <!-- Controles -->
                        <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                        <input type="text" class="form-control cajaTextoFormulario" id="txtFecha"
                            placeholder="AAAA-MM-DD">

                        <label class="tituloCajaTextoFormulario" for="cbVisitante">Visitante:</label>
                        <input type="text" class="form-control cajaTextoFormulario" id="cbVisitante"
                            placeholder="Seleccionar...">

                        <!-- Botones de Acción del Formulario -->
                        <div class="row justify-content-center mt-4 botonVisita">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <a href="#" class="btn btnAgregarFormulario"><span
                                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar detalle de visitas</a>
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