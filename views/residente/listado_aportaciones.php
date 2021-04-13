<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Aportaciones | Citiger');
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
                <h1 class="tituloPagina">Aportaciones</h1>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 justify-content-center search buscarAlquiler">
                <form>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp"
                        placeholder="Buscar...                                                               &#xf002;">
                </form>
            </div>
        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover table-responsive-lg">
                    <thead class="tituloTabla">
                        <tr>
                            <th class="pl-5 pt-4"></th>
                            <th class="pl-5 pt-4">Casa</th>
                            <th class="pl-5 pt-4">Monto</th>
                            <th class="pl-4 pt-4">Fecha</th>
                            <th class="pl-5 pt-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center boto"><img
                                    src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                            <td class="primer">#99, ETAPA 6, BLOCK 5</td>
                            <td class="primer" id="align">$66.72</td>
                            <td class="primer" id="align">2021-12-02</td>
                            <th scope="row" class="boto1">
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTabla "><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTablaIcono "><i
                                        class="fas fa-eye tamañoIconosBotonesTabla1"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                            <td>#99, ETAPA 6, BLOCK 5</td>
                            <td>$66.72</td>
                            <td>2021-12-02</td>
                            <th scope="row">
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTabla "><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTablaIcono "><i
                                        class="fas fa-eye tamañoIconosBotonesTabla1"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                            <td>#22, ETAPA 1, BLOCK 19</td>
                            <td>$66.72</td>
                            <td>2021-12-02</td>
                            <th scope="row">
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTabla "><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTablaIcono "><i
                                        class="fas fa-eye tamañoIconosBotonesTabla1"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                            <td>#25, ETAPA 1, BLOCK 8</td>
                            <td>$66.72</td>
                            <td>2021-12-02</td>
                            <th scope="row">
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTabla "><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                                <a href="#" data-toggle="modal" data-target="#verPago"
                                    class="btn botonesListadoTablaIcono "><i
                                        class="fas fa-eye tamañoIconosBotonesTabla1"></i></a>
                            </th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

        <!-- Modal para Editar Visitas -->
        <div class="modal fade" id="verPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mr-4 iconoModal"></span>Editar Pago</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <div class="row">
                            <!-- Primera columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                                <form id="EmpleadosColumna1">
                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Casa:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="#69, Etapa 3, Block 6">


                                    <div class="row">

                                        <div class="col-6 ">
                                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Estado:</label>
                                            <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                id="txtTelefonofijo" placeholder="Completado">

                                        </div>

                                        <div class="col-6 ">

                                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Monto:</label>
                                            <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                id="txtTelefonomovil" placeholder="$120">
                                        </div>

                                    </div>
                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Mes Pago:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="Febrero, 2021">
                                    

                                </form>

                            </div>
                            <!-- Segunda columna de controles -->
                            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                                <form id="EmpleadosColumna1">
                                    
                                    <label class="tituloCajaTextoFormulario" for="txtObservacion">Descripción:</label>
                                    <textarea class="form-control cajaTextoFormulario"
                                        placeholder="Pago dirigido a mantenimiento de la piscina y ornamentación..." id="txtObservacion" rows="5"></textarea>

                                    <label class="tituloCajaTextoFormulario" for="cbResidente">Fecha Pago:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                        placeholder="2021-04-21">

                                </form>

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