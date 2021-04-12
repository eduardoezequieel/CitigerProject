<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Denuncias | Citiger');
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
                <h1 class="tituloPagina text-center">Denuncia</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombres">Residente:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder=""
                        disabled="disabled">


                    <label class="tituloCajaTextoFormulario" for="txtNombres">Tipo:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder=""
                        disabled="disabled">


                </form>
            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                <form>

                    <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Estado</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder=""
                        disabled="disabled">


                    <label class="tituloCajaTextoFormulario" for="txtNombres">Fecha:</label>
                    <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder=""
                        disabled="disabled">



                </form>
            </div>

        </div>

        <div class="row justify-content-center marginPrimeraColumna">
            <label class="tituloCajaTextoFormulario" for="txtDireccion">Descripción:</label>
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <textarea class="form-control cajaTextoFormulario" placeholder="" id="txtDireccion" rows="7"></textarea>
            </div>
        </div>

        <!-- Botones de Acción del Formulario -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <a href="#" class="btn btnEditarFormulario" data-toggle="modal" data-target="#agregarMarcas" data><span
                        class="fas fa-times mr-3 tamañoIconosBotones"></span>Rechazar</a>

                <a href="#" class="btn btnEditarFormulario" data-toggle="modal" data-target="#solucionar" data><span
                        class="fas fa-check mr-3 tamañoIconosBotones"></span>Solucionar</a>
            </div>
        </div>
        <!-- Desde aqui finaliza el contenido -->
    </div>

    <!-- Modal para rechazar denuncias -->
    <div class="modal fade" id="agregarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>¿Por qué será rechazada?</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <!-- Contenido del Modal -->
                <div class="textoModal px-3 pb-4 mt-2">
                    <div class="row ">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <textarea class="form-control cajaTextoFormularioR"
                                placeholder="Escriba la razón del rechazo de la denuncia..." id="txtDireccion"
                                rows="7"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="btn btnAgregarFormulario"><span
                                    class="fas fa-paper-plane mr-3 tamañoIconosBotones"></span>Enviar reporte</a>
                        </div>
                    </div>
                    <!-- Fin del Contenido del Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

    <!-- Modal para solucionar denuncias -->
    <div class="modal fade" id="solucionar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>Solucionar denuncia</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <!-- Contenido del Modal -->
                <div class="textoModal px-3 pb-4 mt-2">
                    <div class="row ">
                        <div class="col-12 offset-2">
                            <label class="tituloCajaTextoFormulario" for="txtNombres">Seleccionar empleado:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder="Seleccionar...">
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                            
                            <textarea class="form-control cajaTextoFormularioR"
                                placeholder="Escriba detalles para el empleado..." id="txtDireccion"
                                rows="7"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="btn btnAgregarFormulario"><span
                                    class="fas fa-paper-plane mr-3 tamañoIconosBotones"></span>Enviar reporte</a>
                        </div>
                    </div>
                    <!-- Fin del Contenido del Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->
</div>
<!-- Final del contenido -->



<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>