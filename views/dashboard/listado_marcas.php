<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Marcas | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Marcas</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <a href="#" class="btn botonesListado" data-toggle="modal" data-target="#agregarMarcas" data><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar Marca</a>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>
                </div>
            </div><br>

            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="subTituloPagina pl-4 pb-3">Marcas Registradas</h2>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <table class="table table-dark table-hover table-responsive-lg tablaMarcas">
                        <thead class="tituloTabla">
                            <tr>
                                <th class="pl-4 pt-4">Nombre de la Marca</th>
                                <th class="pl-5 pt-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td class="primer" >CERAMICA PIEROLA</td>
                                <th scope="row" class="boto1">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr >
                                <td class="primer" >TEXSA</td>
                                <th scope="row" class="boto1">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr >
                                <td class="primer" >MAYDISA</td>
                                <th scope="row" class="boto1">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div><br>
            <!-- Desde aqui finaliza el contenido -->
            <!-- Modal para Agregar Marcas -->
            <div class="modal fade" id="agregarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Agregar Marca</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <div class="row">
                                <div class="col-12"> 
                                    <label class="tituloCajaTextoFormulario" for="txtTelefono">Nombre de la Marca:</label>
                                    <input type="text" class="form-control cajaTextoModal" id="txtTelefonomovil"
                                    placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnAgregarFormulario"><span
                                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                                </div>
                            </div>
                        <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->

            <!-- Modal para Editar Marcas -->
            <div class="modal fade" id="editarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Editar Marca</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <div class="row">
                                <div class="col-12"> 
                                    <label class="tituloCajaTextoFormulario" for="txtTelefono">Nombre de la Marca:</label>
                                    <input type="text" class="form-control cajaTextoModal" id="txtTelefonomovil"
                                    placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnEditarFormulario"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>

                                    <a href="#" class="btn btnEditarFormulario"><span
                                            class="fas fa-minus mr-3 tamañoIconosBotones"></span>Eliminar</a>
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