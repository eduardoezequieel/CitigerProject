<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Denuncias | Citiger');
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
                <h1 class="tituloPagina text-center">Agregar Nueva Denuncia</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 botonVisi">
                <a href="listado_denuncias.php" class="btn botonesListado"><i class="fas fa-eye"></i> Ver Historial</a>
            </div>
        </div><br>
        s
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
                                    <label class="tituloCajaTextoFormulario" for="txtTipoDenuncia">Tipo
                                        Denuncia:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                                        placeholder="Seleccione el tipo de  denuncia...">

                                    <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtApellidos"
                                        placeholder="Ingrese la fecha...">

                                </form>

                            </div>

                            <!-- Segunda columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginTerceraColumna centrarColumnas">
                                <form>
                                    <!-- Controles -->
                                    <label class="tituloCajaTextoFormulario" for="txtDescripcion">Descripción:</label>
                                    <textarea class="form-control cajaTextoFormulario"
                                        placeholder="Escriba su denuncia..." id="txtDescripcion" rows="5"></textarea>

                                </form>
                            </div>
                        </div>

                        <!-- Botones de Acción del Formulario -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <a href="#" class="btn btnAgregarFormulario"><span
                                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Denuncia</a>
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