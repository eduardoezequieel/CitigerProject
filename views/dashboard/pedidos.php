<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Pedidos | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Pedidos</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="seleccion_materiales_pedido.php" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Crear</a>
                </div>

                <form class="mx-3" id="search-form-estado">
                    <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                    <input type="number" id="txtEstadoPedido" name="txtEstadoPedido" class="d-none">
                    <button type="submit" class="d-none" id="btnBuscarEstado"></button>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbEstadoPedido">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="../../app/reports/dashboard/pedidos.php" id="btnReporte" type="button" data-target="#" class="btn botonesListado" data-toggle="tooltip" data-placement="bottom" title="Reporte de pedidos por estado"><span class="fas fa-file-alt mr-3 tamañoIconosBotones"></span>Reporte</a>
                </div>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

        </div><br>

        <div class="row animate__animated animate__bounceIn">
            <div class="col-12">
                <h2 class="subTituloPagina1 pl-4 pb-3">Pedidos recientes</h2>
            </div>
        </div>
        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-1 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col">Empleado</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Pedido</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar Pedido -->
<div class="modal fade" id="administrarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Pedidos</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Desde aqui comienza el contenido -->
                <div class="row px-5">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 centrarBotones animate__animated animate__bounceIn">
                        <h1 class="tituloPagina text-white text-center centrarTitulo">Detalles del Pedido</h1>
                    </div>

                </div><br>
                <div class="row justify-content-center animate__animated animate__bounceIn">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <!-- Inicio de la Tabla -->
                        <div class="row justify-content-center table-responsive tablaResponsive">
                            <div class="col-12 justify-content-center align-items-center text-center">
                                <table class="table table-borderless citigerTable">
                                    <thead>
                                        <!-- Columnas-->
                                        <tr>
                                            <th scope="col">Material</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-rows2">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Desde aqui termina la tabla -->
                    </div>
                </div>

                <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <h1 class="totalLabel">Total: <span class="totalNumeroLabel" id="lblTotal">$0.00</span></h1>
                    </div>
                </div>

                <div class="row mt-3 animate__animated animate__bounceIn">
                    <div class="col-12">
                        <h1 class="tituloPagina text-white text-center">¿Quién solicita este pedido?</h1>
                    </div>
                </div>

                <!-- Datos del pedido -->
                <div class="row mt-3 justify-content-center animate__animated animate__bounceIn">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center minimizarDiv">
                        <form>
                            <label class="tituloCajaTextoFormulario" for="cbEmpleado">Empleado que encargo el pedido:</label>
                            <h1 class="tituloCajaTextoFormulario text-white" id="lblEmpleado">EDUARDO RIVERA</h1>
                        </form>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center minimizarDiv">
                        <form>
                            <label class="tituloCajaTextoFormulario" for="cbEmpleado">Estado del pedido:</label>
                            <h1 class="tituloCajaTextoFormulario text-white" id="lblEstado">Programado</h1>
                        </form>
                    </div>
                </div>

                <form method="post" id="administrarPedido-form">
                    <div class="row mt-2">
                        <div class="col-12">
                            <h1 class="tituloDato2 text-center">Confirmar como:</h1>
                        </div>
                    </div>
                    <!-- Botones -->
                    <div class="row mt-3 justify-content-center animate__animated animate__bounceIn">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <input type="number" class="d-none" id="txtIdPedido" name="txtIdPedido">
                            <button type="submit" class="btn botonesListado m-1" id="btnRecibido"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Recibido</a>
                            <button type="submit" class="btn botonesListado m-1" id="btnCancelado"><span class="fas fa-times mr-3 tamañoIconosBotones"></span>Cancelado</a>
                        </div>
                    </div>
                </form>

                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('pedidos.js');
?>