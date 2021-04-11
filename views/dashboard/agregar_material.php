<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Materiales | Citiger');
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
                <h1 class="tituloPagina text-center">Agregar Nuevo Material</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">

                    <!-- Cargar Fotografia -->
                    <div class="row pl-2 my-4">
                        <div class="col">
                            <div class="divFotografia2">
                                <div class="cargarFoto2"></div>
                                <button class="btn btnCargarFoto"><span class="fas fa-file-upload"></span></button>
                            </div>
                        </div>
                        <!-- Final Cargar Fotografia -->
                    </div>

                    <label class="tituloCajaTextoFormulario" for="txtNombres">Nombres del material:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres" placeholder="Escriba los nombres del material">

                    <label class="tituloCajaTextoFormulario" for="txtApellidos">Marca:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtApellidos" placeholder="Escriba la marca del material">

                    <label class="tituloCajaTextoFormulario" for="txtDUI">Categoria:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder="Seleccionar">


                </form>

            </div>

            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 margin2 centrarColumnas">
                <form>

                    <!-- Controles -->
                    <label class="tituloCajaTextoFormulario" for="cbTipoEmpleado">Tamaño:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbTipoEmpleado" placeholder="Escriba el tamaño">

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Unidad de medida:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="Seleccionar">

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Costo:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="Ingrese el costo del material">

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Cantidad:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="Escriba la cantidad">

                    <label class="tituloCajaTextoFormulario" for="txtDireccion">Descripción:</label>
                    <textarea class="form-control cajaTextoFormulario" placeholder=""
                        id="txtDireccion" rows="5"></textarea>
                </form>
            </div>
        </div>

        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnAgregarFormulario"><span
                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Nuevo Material</a>
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