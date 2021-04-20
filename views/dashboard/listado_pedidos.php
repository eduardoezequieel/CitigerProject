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
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Pedidos</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <a href="seleccion_materiales_pedido.php" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Crear Nuevo Pedido</a>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                         &#xf002;">
                    </form>
                </div>
            </div><br>

            <div class="row">
                <div class="col-12">
                    <h2 class="subTituloPagina1 pl-4 pb-3">Información del Pedido</h2> 
                </div>
            </div>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-1 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaPedidos">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nombre de la Marca</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh" id="imagenRegistroMarca">
                                        <div class="col-12">
                                            <img src="../../resources/img/brand.png" alt="" class="img-fluid mt-1" width="25px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>CEMEX</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            
                            
                            
                        </tbody>
                    </table>
                </div>
            </div><br>
             <!-- Desde aqui termina la tabla -->
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>  