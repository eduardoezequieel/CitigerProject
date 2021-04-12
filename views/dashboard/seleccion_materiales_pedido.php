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
        <div class="row my-3">
            <div class="col-12">
                <h1 class="tituloPagina text-white">Seleccione el material que se incluira en el pedido.</h1>
            </div>
        </div>

        <!-- Controles del Inicio -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones" id="agregarMaterial">
                <a href="#" data-toggle="modal" data-target="#verCarrito" class="btn botonesListadoInventario ml-5"><span
                        class="fas fa-shopping-cart mr-3 tamañoIconosBotones"></span>Ver Carrito</a>

                <a href="#" data-toggle="modal" data-target="#verCarrito" class="btn botonesListadoInventarioIcono"><span
                        class="fas fa-shopping-cart tamañoIconosBotones"></span></a>

            </div>

            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                <form>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp"
                        placeholder="Buscar...                                                                           &#xf002;">
                </form>
            </div>
        </div><br>

        <!-- Fila de Tarjetas -->
        <div class="row justify-content-center">
            <div
                class="col-xl-4 col-md-4 col-sm-12 col-xs-12 d-flex margenTarjetas justify-content-center align-items-center text-center">
                <!-- Inicio de Tarjeta -->
                <div class="tarjeta">
                    <!-- Fila para Imagen -->
                    <div class="row">
                        <div class="col-12">
                            <img src="../../resources/img/Stockage_de_ciments.JPG" alt=""
                                class="img-fluid imagenTarjeta">
                        </div>
                    </div>
                    <!-- Fila para Información -->
                    <div class="row mt-2">
                        <div class="col-12 text-left">
                            <h1 class="letraTarjeta">CEMENTO CEMEX USO GRAL.</h1>
                            <h1 class="letraTarjeta">En Stock: <span class="letraDestacadaTarjeta">122</span></h1>
                        </div>
                    </div>
                    <!-- Fila para Boton -->
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</a>
                        </div>
                    </div>
                    <!-- Fin de Tarjeta -->
                </div>
            </div>
            <!-- Tarjetas de relleno -->
            <div
                class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas d-flex justify-content-center align-items-center text-center">
                <div class="tarjeta">
                    <div class="row">
                        <div class="col-12">
                            <img src="../../resources/img/Stockage_de_ciments.JPG" alt=""
                                class="img-fluid imagenTarjeta">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-left">
                            <h1 class="letraTarjeta">CEMENTO CEMEX USO GRAL.</h1>
                            <h1 class="letraTarjeta">En Stock: <span class="letraDestacadaTarjeta">122</span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas d-flex justify-content-center align-items-center text-center">
                <div class="tarjeta">
                    <div class="row">
                        <div class="col-12">
                            <img src="../../resources/img/Stockage_de_ciments.JPG" alt=""
                                class="img-fluid imagenTarjeta">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-left">
                            <h1 class="letraTarjeta">CEMENTO CEMEX USO GRAL.</h1>
                            <h1 class="letraTarjeta">En Stock: <span class="letraDestacadaTarjeta">122</span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="textoModal px-3 pb-4 mt-2">
                        <div class="row justify-content-center">
                            <div class="col-12 table-responsive d-flex justify-content-center align-items-center">
                                <div class="colorTabla">
                                    <form>
                                        <table class="table table-dark table-borderless" id="tablaCarrito">
                                            <thead>
                                                <tr class="text-center">
                                                    <th id="columnaFotoCarrito" scope="col">#</th>
                                                    <th id="columnaMaterialCarrito" scope="col">Material</th>
                                                    <th id="columnaCantidadCarrito" scope="col">Cantidad</th>
                                                    <th id="columnaSubtotalCarrito" scope="col">Subtotal</th>
                                                    <th id="columnaEliminarCarrito" scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <th scope="row">
                                                        <div class="row paddingTh">
                                                            <div class="col-12"><img src="../../resources/img/Stockage_de_ciments.JPG" alt="" class="img-fluid rounded-circle" width="25px"></div>
                                                        </div>
                                                    </th>
                                                    <td>CEMENTO CEMEX USO GRAL.</td>
                                                    <th scope="row">
                                                        <div class="row paddingBotones justify-content-center">
                                                            <div class="col-12 columnaBotones">
                                                                <button class="btn botonesCarrito mr-2"><span
                                                                        class="fas fa-minus"></span></button>
                                                                1
                                                                <button class="btn botonesCarrito ml-2"><span
                                                                        class="fas fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>$14.99</td>
                                                    <th scope="row">
                                                        <div class="row paddingBotones">
                                                            <div class="col-12">
                                                                <button class="btn botonesCarrito ml-2"><span
                                                                        class="fas fa-times"></span></button>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <h1 class="totalLabel">Total: <span class="totalNumeroLabel">$14.99</span></h1>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12 d-flex justify-content-center align-items-center ">
                                <a href="" class="btn botonesListadoInventario"><span class="fas fa-arrow-right mr-3"></span>Continuar</a>
                            </div>
                        </div>
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>