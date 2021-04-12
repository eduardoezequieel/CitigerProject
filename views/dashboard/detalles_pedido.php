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
            <div class="row px-5">
                <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <h1 class="tituloPagina text-white text-center centrarTitulo">Detalles del Pedido</h1>
                </div>

            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row tablaDetallePedidoResponsive justify-content-center">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                    <form>
                        <a href="seleccion_materiales_pedido.php" class="btn botonesListado float-right"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>
                    </form>
                    <div class="colorTablaDetallePedido justify-content-center mt-4">
                        <form>
                            <table class="table table-dark table-borderless" id="tablaDetallePedido">
                                <thead>
                                    <tr class="text-center">
                                        <th id="columnaFotoCarrito" scope="col">#</th>
                                        <th id="columnaMaterialCarrito" scope="col">Material</th>
                                        <th id="columnaCantidadCarrito" scope="col">Cantidad</th>
                                        <th id="columnaSubtotalCarrito" scope="col">Subtotal</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <div class="row paddingTh">
                                                <div class="col-12"><img
                                                        src="../../resources/img/Stockage_de_ciments.JPG" alt=""
                                                        class="img-fluid rounded-circle" width="25px"></div>
                                            </div>
                                        </th>
                                        <td>CEMENTO CEMEX USO GRAL.</td>
                                        <th scope="row">
                                            <div class="row paddingTh justify-content-center">
                                                <div class="col-12 columnaBotones">
                                                    
                                                    1
                                                    
                                                </div>
                                            </div>
                                        </th>
                                        <td>$14.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Desde aqui termina la tabla -->

            <!-- Datos del pedido -->
            <div class="row mt-3">
                <div class="col-12">
                    <h1 class="tituloPagina text-white text-center">¿Quién solicita este pedido?</h1>
                </div>
            </div>

            <div class="row mt-3 justify-content-center">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <form>
                        <label class="tituloCajaTextoFormulario" for="cbEmpleado">Empleado que encargo el pedido:</label>
                        <input type="text" class="form-control cajaTextoFormulario" id="cbEmpleado"
                            placeholder="Seleccionar...">
                    </form>
                </div>
            </div>

            <!-- Botones -->
            <div class="row mt-3 justify-content-center">
                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                    <form>
                        <a href="listado_pedidos.php" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Crear Nuevo Pedido</a>
                    </form>
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