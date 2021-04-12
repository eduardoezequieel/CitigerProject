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
                <h1 class="tituloPagina text-center">Agregar Nuevo Visitante</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 botonVisi">
                <a href="listado_visitantes.php" class="btn botonesListado"><i class="fas fa-eye"></i>   Ver Visitantes</a>
            </div>
        </div><br>

        <!-- Inicio de Fila -->
        <div class="row">
            
            <!-- Columna de controles -->
            <div class="col-12 marginSegundaColumna centrarColumnas contenedorDetalle1">
                <div class="row">
                    <div class="col-12 contenedorDetalle4">
                        <!-- Inicio de Fila -->
                        <div class="row">
                            <!-- Primera columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginTerceraColumna centrarColumnas">
                                <form id="EmpleadosColumna1">
                                    <label class="tituloCajaTextoFormulario" for="txtNombres">Nombres:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                                        placeholder="Escriba sus nombres...">

                                    <label class="tituloCajaTextoFormulario" for="txtApellidos">Apellidos:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtApellidos"
                                        placeholder="Escriba sus apellidos...">

                                    <!-- RadioButtonGroup Género -->
                                    <h1 class="tituloCajaTextoFormulario mb-3">Género</h1>
                                    <div class="row justify-content-center">
                                        <div class="col d-flex justify-content-center align-items-center text-center">
                                            <div class="generoRadioButtons">
                                                <label class="container">Masculino
                                                    <input type="radio" name="radio">
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
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginTerceraColumna centrarColumnas">
                                <form>
                                    <!-- Controles -->
                                    <label class="tituloCajaTextoFormulario" for="txtDui">DUI:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtDui"
                                        placeholder="Escriba su DUI...">

                                    <label class="tituloCajaTextoFormulario" for="txtPlaca">Placa:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtPlaca"
                                        placeholder="Escriba su placa...">
                                </form>
                            </div>
                    </div>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="btn btnAgregarFormulario"><span
                                    class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Visitante</a>
                        </div>
                    </div>
                    <!-- Desde aqui finaliza el contenido -->
                    </div>
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