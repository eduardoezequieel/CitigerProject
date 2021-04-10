<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Empleados | Citiger');
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
                <h1 class="tituloPagina text-center">Agregar Nuevo Empleado</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombres">Nombres:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                        placeholder="Escriba sus nombres...">

                    <label class="tituloCajaTextoFormulario" for="txtApellidos">Apellidos:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtApellidos"
                        placeholder="Escriba sus apellidos...">

                    <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder="12345678-9">

                    <label class="tituloCajaTextoFormulario" for="txtTelefono">Teléfono:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtTelefono"
                        placeholder="0000-0000">

                    <label class="tituloCajaTextoFormulario" for="txtCorreo">Correo Electrónico:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtCorreo"
                        placeholder="ejemplo@mail.com">

                    <!-- RadioButtonGroup Género -->
                    <h1 class="tituloCajaTextoFormulario mb-3">Género</h1>
                    <div class="row justify-content-center">
                        <div class="col d-flex justify-content-center align-items-center text-center">
                            <div class="generoRadioButtons">
                                <label class="container">Masculino
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Femenino
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarColumnas">
                <form>
                    <!-- Cargar Fotografia -->
                    <div class="row pl-5 my-4">
                        <div class="col">
                            <div class="divFotografia">
                                <div class="cargarFoto"></div>
                                <button class="btn btnCargarFoto"><span class="fas fa-file-upload"></span></button>
                            </div>
                        </div>
                        <!-- Final Cargar Fotografia -->
                    </div>

                    <!-- Controles -->
                    <label class="tituloCajaTextoFormulario" for="cbTipoEmpleado">Tipo de Empleado:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="cbTipoEmpleado"
                        placeholder="Seleccionar...">

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                        placeholder="01-01-2000">

                    <label class="tituloCajaTextoFormulario" for="txtDireccion">Dirección:</label>
                    <textarea class="form-control cajaTextoFormulario" placeholder="Escriba su dirección..."
                        id="txtDireccion" rows="3"></textarea>
                </form>
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