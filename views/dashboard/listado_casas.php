<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Casas | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Casas</h1>
                </div>
            </div>

            <div class="row px-5 animate__animated animate__bounceIn">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <a href="#" data-toggle="modal" data-target="#agregarCasa" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Casa</a>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>
                </div>
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaAlquileres">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Casa</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/bluehouse.png" alt="" class="img-fluid" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>#69</td>
                                <td>En remodelación</td>
                                <td>ETAPA 3 BLOCK 6</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="editar_alquiler.php" class="btn btnTabla"><i class="fas fa-edit"></i></a>
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
    <!-- Modal para Agregar Casas -->
    <div class="modal fade" id="agregarCasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Agregar Casa</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close colorCerrarModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <div class="row">
                                <div class="col-12"> 
                                    <form>
                                        <label class="tituloCajaTextoFormulario" for="txtTelefono">Número de Casa:</label>
                                        <input type="text" class="form-control cajaTextoModal" id="txtTelefonomovil"
                                        placeholder="Escriba el número de casa...">

                                        <label class="tituloCajaTextoFormulario" for="txtTelefono">Ubicación:</label>
                                        <textarea class="form-control cajaTextoModal" rows="3" placeholder="Escriba los detallles de la ubicación de la casa..."></textarea>
                                    </form>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnEditarFormulario"><span
                                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                                    <a href="#" class="btn btnEditarFormularioIcono"><span
                                            class="fas fa-plus tamañoIconosBotones"></span></a>
                                </div>
                            </div>
                        <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>  