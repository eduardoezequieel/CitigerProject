<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Pedidos | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <h1 class="tituloPagina text-white text-center centrarTitulo">Detalles del Pedido</h1>
            </div>

        </div><br>

        <div class="row justify-content-center animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <!-- Inicio de la Tabla -->
                <div class="row justify-content-center table-responsive tablaResponsive" id="tablaCarritoDetalle">
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
                            <tbody id="tbody-rows">
                                
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

        <!-- Datos del pedido -->
        <div class="row animate__animated animate__bounceIn">
            <div class="col-12">
                <h1 class="tituloPagina text-white text-center">¿Quién solicita este pedido?</h1>
            </div>
        </div>

        <form method="post" id="finalizarPedido-form">
            <div class="row mt-3 justify-content-center animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="form-group">
                        <h1 class="tituloCajaTextoFormulario">Empleado que encargo el pedido:</h1>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitiger">
                            <select class="custom-select" id="txtEmpleadoPedido" name="txtEmpleadoPedido">
                                
                            </select> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="row mt-3 justify-content-center animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                    
                    <button type="submit" class="btn botonesListado"><span
                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Crear Nuevo Pedido</button>
                    
                </div>
            </div>
        </form>

        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('detalles_pedido.js');
?>