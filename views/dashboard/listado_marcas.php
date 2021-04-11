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
            <!-- Desde aqui finaliza el contenido -->
            <!-- Modal para Agregar Marcas -->
            <div class="modal fade" id="agregarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <div class="modal-header">

                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Agregar Marca</h5>
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <div class="textoModal px-3 pb-4">
                            <div class="row">
                                <div class="col-12">
                                <label class="tituloCajaTextoFormulario" for="txtTelefono">Nombre de la Marca:</label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                    
                                    <input type="text" class="form-control cajaTextoModal" id="txtTelefonomovil"
                                    placeholder="0000-0000">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnAgregarFormulario"><span
                                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>   