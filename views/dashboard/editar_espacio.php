<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Espacios | Citiger');
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
                <h1 class="tituloPagina text-center">Editar Datos de Espacio</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombre">Nombre:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombre"
                        placeholder="PISCINA">

                    <label class="tituloCajaTextoFormulario" for="txtDescripcion">Descripción:</label>
                    <textarea class="form-control cajaTextoFormulario" placeholder="Piscina semiolimpica para personas mayores de 7 años"
                    id="txtDescripcion" rows="3"></textarea>

                    <label class="tituloCajaTextoFormulario" for="txtCapacidad">Capacidad:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtCapacidad" placeholder="35">

                </form>

            </div>

            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form>
                    <!-- Cargar Fotografia -->
                    <div class="row pl-2 my-4">
                        <div class="col">
                            <div class="divFotografia">
                                <div class="cargarFoto6"><img src="../../resources/img/piscina.JPG" alt="" class="img-fluid cargarFoto6"></div>
                                <button class="btn btnCargarFoto"><span class="fas fa-file-upload"></span></button>
                            </div>
                        </div>
                        <!-- Final Cargar Fotografia -->
                    </div>
                    <!-- Cargar Fotografia -->
                    <div class="row pl-1 my-4">
                        <div class="col-12">
                            <div class="divFotografia4">
                            <div class="cargarFoto7"><img src="../../resources/img/piscina.JPG" alt="" class="img-fluid cargarFoto7"></div>
                                <div class="cargarFoto8"><img src="../../resources/img/piscina.JPG" alt="" class="img-fluid cargarFoto7"></div>
                                <div class="cargarFoto8"><img src="../../resources/img/piscina.JPG" alt="" class="img-fluid cargarFoto7"></div>
                                <button class="btn btnCargarFoto6"><i class="fas fa-arrow-down"></i></button>
                            </div>
                        </div>
                        <!-- Final Cargar Fotografia -->
                    </div>
                </form>
            </div>
        </div>

        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnAgregarFormulario"><span
                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Espacio</a>
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