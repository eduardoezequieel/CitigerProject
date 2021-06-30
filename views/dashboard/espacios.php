    <?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Admin_Page::sidebarTemplate('Espacios | Citiger');
?>    

    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Espacio</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarEspacio" class="btn botonesListado">
                            <span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>
                        
                    <form class="mx-3 mb-2" method="post" id="search-form">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="text" class="form-control buscador searchInput" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Nombre }">
                    </form>   

                    <form method="post" id="filtrarEstadoEspacio-form" class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitigerBusqueda">
                            <select class="custom-select" id="cbEstadoEspacio">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>
                        <input type="number" name="idEstadoEspacio" id="idEstadoEspacio" class="d-none">
                        <button class="d-none" id="btnFiltrarEspacio" type="submit"></button>
                    </form>

                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                    </div>
                </div>
                
            </div><br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp" id="show-tarjeta">
                
                
            </div>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

    </div>
    <!-- Final del contenido -->

    <!-- Modal para Administrar Espacios -->
    <div class="modal fade" id="administrarEspacio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Espacios</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <!-- Contenido del Modal -->
                <div class="textoModal px-3 pb-4 mt-2"> 
                    <form method="post" id="espacio-form">
                        <div class="row animate__animated animate__bounceIn">
                            <!-- Primera columna de controles -->
                            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                                <div id="EmpleadosColumna1">
                                    <input type="number" name="idEspacio" id="idEspacio" class="d-none">
                                    <label class="tituloCajaTextoFormulario" for="txtNombre">Nombre:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombre" name="txtNombre"
                                        placeholder="Escriba nombre del espacio..." onchange="checkInput('txtNombre')" Required>

                                    <label class="tituloCajaTextoFormulario" for="txtDescripcion">Descripción:</label>
                                    <textarea class="form-control cajaTextoFormulario" placeholder="Escriba la descripción del espacio..."
                                    id="txtDescripcion" name="txtDescripcion" rows="3" onchange="checkInput('txtDescripcion')" Required></textarea>

                                    <label class="tituloCajaTextoFormulario" for="txtCapacidad">Capacidad:</label>
                                    <input type="number" class="form-control cajaTextoFormulario" id="txtCapacidad" name="txtCapacidad" 
                                    placeholder="Escriba la capacidad..." min="1" step="any" onchange="checkInput('txtCapacidad')" Required>

                                </div>

                            </div>

                            <!-- Segunda columna de controles -->
                            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                                    <!-- Cargar Fotografia -->
                                    <div class="row pl-2 my-4">
                                        <div class="col">
                                            <div class="divFotografia">
                                                <div class="cargarFoto6"></div>
                                                <button class="btn btnCargarFoto2 mx-2"><span class="fas fa-file-upload"></span></button>
                                            </div>
                                            <button href="#" class="btn btnAgregarFormulario mt-4"><span class="fas fa-images mr-3 tamañoIconosBotones"></span>Fotografias</button>
                                        </div>
                                        <!-- Final Cargar Fotografia -->
                                    </div>

                                    
                                    <!-- Cargar Fotografia -->

                            </div>
                            <input type="number" name="idEstadoEspacio1" id="idEstadoEspacio1" class="d-none">
                        </div>
                        <!-- Botones de Acción del Formulario -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <button href="#" type="submit" id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                <button href="#" type="submit" id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                                <button href="#" id="btnSuspender" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                                <button href="#" id="btnActivar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del Contenido del Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->
<?php
//Se imprimen los JS necesarios
Admin_Page::footerTemplate('espacios.js');
?>   