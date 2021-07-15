<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Inventario | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row my-3 animate__animated animate__bounceIn">
            <div class="col-12">
                <h1 class="tituloPagina text-center">Seleccione el material que se incluira en el pedido.</h1>
            </div>
        </div>

        <!-- Controles del Inicio -->
        <div class="row justify-content-center animate__animated animate__bounceIn">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones" id="agregarMaterial">
                <a href="#" onclick="readOrder()" data-toggle="modal" data-target="#verCarrito"
                    class="btn botonesListadoInventario ml-5"><span
                        class="fas fa-shopping-cart mr-3 tamañoIconosBotones"></span>Ver Pedido</a>

                <a href="#" data-toggle="modal" data-target="#verCarrito"
                    class="btn botonesListadoInventarioIcono"><span
                        class="fas fa-shopping-cart tamañoIconosBotones"></span></a>

            </div>

            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                <!--
                <form>
                    <input type="email" class="form-control buscador mr-5" id="buscar" aria-describedby="emailHelp"
                        placeholder="Buscar...                                                                           &#xf002;">
                </form>-->
            </div>
        </div><br>

        <!-- Fila de Tarjetas -->
        <div class="row justify-content-center animate__animated animate__backInUp" id="tbody-rows">
            
        </div>
        <!-- Desde aqui finaliza el contenido -->
        <!-- Modal para Ver Carrito -->
        <div class="modal fade" id="verCarrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mr-4 iconoModal"></span>Pedido</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal pb-4 mt-2 justify-content-center">
                        <!-- Inicio de la Tabla -->
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="row justify-content-center table-responsive">
                                    <div class="col-12 justify-content-center align-items-center text-center">
                                        <table class="table table-borderless citigerTable">
                                            <thead>
                                                <!-- Columnas-->
                                                <tr>
                                                    <th scope="col">Material</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">Subtotal</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-rows2">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Desde aqui termina la tabla -->

                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <h1 class="totalLabel">Total: <span class="totalNumeroLabel" id="lblTotal">$0.00</span></h1>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12 d-flex justify-content-center align-items-center ">
                                <a href="detalles_pedido.php" class="btn botonesListadoInventario"><span
                                        class="fas fa-arrow-right mr-3"></span>Continuar</a>
                                <a href="detalles_pedido.php" class="btn botonesListadoInventarioIcono"><span
                                        class="fas fa-arrow-right"></span></a>
                                        
                            </div>
                        </div>
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->

        <!-- Modal de Materiales -->
        <div class="modal fade" id="verMateriales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Información del Material</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="verMateriales-form">
                                <div class="row justify-content-center">
                                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="imagenModal mb-2 pt-3 responsiveImagenModal" id="divFoto">
                                        
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="number" class="d-none" name="idMaterial" id="idMaterial">
                                                    <h1 class="tituloModal2" id="txtTitulo">CEMENTO CEMEX USO GRAL.</h1>
                                                    <h1 class="textoModal2">Marca: <span  id="txtMarca" class="letraDestacadaTarjeta">CEMEX</span></h1>
                                                    <h1 class="textoModal2">En Stock: <span id="txtCantidad" class="letraDestacadaTarjeta">122</span></h1>
                                                    <h1 class="textoModal2">Unidad de Medida: <span id="txtUnidadMedida" class="letraDestacadaTarjeta">kg</span></h1>
                                                    <h1 class="textoModal2">Tamaño: <span id="txtTamaño" class="letraDestacadaTarjeta">16m3</span></h1>
                                                    <h1 class="textoModal2">Costo: <span id="txtCosto" class="letraDestacadaTarjeta">$17.99</span></h1>
                                                </div>
                                                <div id="controlesCantidad" class="form-group d-flex justify-content-center align-items-center text-center">
                                                    <a id="btnMinus" class="btn botonesTarjeta"><span class="fas fa-minus tamañoIconosBotones"></span></a>

                                                            <h1 class="cantidadNumeroLabel mx-4 pt-1" id="cantidadMaterial">10</h1>

                                                    <a id="btnPlus" class="btn botonesTarjeta"><span class="fas fa-plus tamañoIconosBotones"></span></a>
                                                </div>
                                                <div>
                                                    <input type="text" class="d-none" id="txtPrecioMaterial" name="txtPrecioMaterial">
                                                    <input type="text" class="d-none" id="txtCantidadMaterial" name="txtCantidadMaterial">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" id="btnAgregarCarrito" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-cart-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                    </div>
                                </div>
                            </form>
                        <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para actualizar cantidades -->
<div class="modal fade" id="actualizarCantidades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Actualizar Cantidad</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" data-toggle="modal" data-target="#verCarrito" aria-label="Close">
                    <span class="fas fa-chevron-left"></span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="actualizarCantidades-form">
                    <div class="row">
                        <div class="col-12">
                            <h1 id="lblProductoCant" class="tituloModal2 text-center">Producto</h1>
                            <h1 class="textoModal2 text-center my-3">En Stock: <span id="txtCantidad2" class="letraDestacadaTarjeta">122</span></h1>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div id="controlesCantidad" class="form-group d-flex justify-content-center align-items-center text-center">
                                <a id="btnMinus2" class="btn botonesTarjeta"><span class="fas fa-minus tamañoIconosBotones"></span></a>
                                <label class="cantidadNumeroLabel mx-4 pt-1" id="lblCantidadMaterial"></label>
                                <a id="btnPlus2" class="btn botonesTarjeta"><span class="fas fa-plus tamañoIconosBotones"></span></a>
                            </div>
                            <div class="form-group d-none">
                                <label>Id detalle</label>
                                <input type="number" name="iddetalle" id="iddetalle">

                                <label>Id material</label>
                                <input type="number" name="idmaterial" id="idmaterial">

                                <label>Stock real</label>
                                <input type="number" name="stockReal" id="stockReal">

                                <label>Stock para el pedido</label>
                                <input type="number" name="stockPedido" id="stockPedido">

                                <label>Stock nuevo para la bodega</label>
                                <input type="number" name="stockBodega" id="stockBodega">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" id="btnActualizarCantidad" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-save mr-3 tamañoIconosBotones"></span>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('seleccion_materiales_pedido.js');
?>