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
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Marcas</h1>
                </div>
            </div>

            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" data-toggle="modal" data-target="#agregarMarcas" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>
                      
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>            
                </div>
                
            </div><br>

            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-1 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaMarcas">
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
                            <tr class="animate__animated animate__fadeIn">
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
                                            <a href="#" class="btn btnTabla2"><i class="fas fa-trash"></i></a>
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
                                    <a href="#" class="btn btnAgregarFormulario"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>
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