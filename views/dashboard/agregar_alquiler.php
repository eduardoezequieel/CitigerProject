<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
?>
<link rel="stylesheet" href="../../resources/css/estilos3.css">
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido1">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Agregar Nuevo Alquiler</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-7 col-md-7 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                        placeholder="Seleccionar...">

                    <label class="tituloCajaTextoFormulario" for="cbEspacio">Espacio:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbEspacio"
                        placeholder="Seleccionar...">

                    <label class="tituloCajaTextoFormulario" for="txtFechaAlquiler">Fecha de Alquiler:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaAlquiler"
                        placeholder="AAAA-MM-DD">

                </form>

            </div>

            <!-- Segunda columna de controles -->
            <div class="col-xl-5 col-md-5 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form>

                    <!-- Controles -->
                    <label class="tituloCajaTextoFormulario" for="txtHoraInicio">Hora inicio:</label>
                    <input type="text" class="form-control cajaTextoFormularioHora" id="txtHoraInicio"
                        placeholder="HH:MM">

                    <label class="tituloCajaTextoFormulario" for="txtHorFin">Hora fin:</label>
                    <input type="text" class="form-control cajaTextoFormularioHora" id="txtHorFin"
                        placeholder="HH:MM">

                    <label class="tituloCajaTextoFormulario" for="txtPrecio">Precio:</label>
                    <input type="text" class="form-control cajaTextoFormularioPrecio" id="txtPrecio"
                        placeholder="$00.00">
                </form>
            </div>
        </div>

        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnAgregarFormulario"><span
                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Alquiler</a>
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