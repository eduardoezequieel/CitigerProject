<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Casas | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido2">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Agregar casa</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombres">Estado de la casa:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                        placeholder="Seleccionar">

                </form>
            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form>

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Número de casa:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="Escriba el número de la casa">


                </form>
            </div>

        </div>
        
        <div class="row justify-content-center marginPrimeraColumna">
            <label class="tituloCajaTextoFormulario" for="txtDireccion">Dirección:</label>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <textarea class="form-control cajaTextoFormulario" placeholder="Escriba su dirección..."
                    id="txtDireccion" rows="7"></textarea>
            </div>
        </div>
        
        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnAgregarFormulario"><span
                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
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