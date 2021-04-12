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
            <!-- Desde aqui comienza la tabla -->
            <div class="row">
                <div class="col-12">
                    <h2 class="subTituloPagina1 pl-4 pb-3">Información del Residente</h2>
                </div>
                <div class="col">
                    <table class="table table-dark table-hover table-responsive-lg">
                        <thead class="tituloTabla">
                            <tr>
                                <th class="pl-5 pt-4"></th>
                                <th class="pl-4 pt-4">Empleado que solicito el pedido</th>
                                <th class="text-center pt-4">Estado</th>
                                <th class="text-center pt-4">Pedido</th>
                                <th class="pt-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th scope="row" class="d-flex justify-content-center boto"><img src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                                <td class="primer" >JUAN ERNESTO LEIVA</td>
                                <td class="primer text-center" id="align">Programado</td>
                                <td class="primer text-center" id="align">#123456</td>
                                <th scope="row" class="boto1">
                                    <a href="editar_pedido.php" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="editar_pedido.php" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
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