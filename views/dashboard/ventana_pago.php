<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Aportaciones | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Realizar pago de Aportación</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombres">Casa:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                        placeholder="#69,  Etapa 3, Block 6">

                    <label class="tituloCajaTextoFormulario" for="txtNombres">Monto a pagar:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                        placeholder="$55.70">

                </form>
            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                <form>

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Fecha de pago:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="02/02/2021">

                    <label class="tituloCajaTextoFormulario" for="txtNombres">Mes y año:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                        placeholder="Febrero, 2021">


                </form>
            </div>

        </div>

        <div class="row justify-content-center ">
            <label class="tituloCajaTextoFormulario" for="txtDireccion">Descripción del pago:</label>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <textarea class="form-control cajaTextoFormulario" placeholder="Pago dirigido a mantenimiento de la piscina y ornamentación"
                    id="txtDireccion" rows="5"></textarea>
            </div>
        </div>

        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnAgregarFormulario"><span
                        class="fas fa-dollar-sign mr-3 tamañoIconosBotones"></span>Realizar pago</a>
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