<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
?>
    <link rel="stylesheet" href="../../resources/css/estilos3.css">
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken">
                <i class="fa fa-bars categoriasFuente tamañoIconos"></i>
                <small class="text-uppercase font-weight-bold"></small>
            </button>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Alquiler</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListado">
                            <span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>

                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>
                </div>

            </div>
            <br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp">
                <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                    <!-- Inicio de Tarjeta -->
                    <div class="tarjeta">
                        <!-- Fila para Imagen -->
                        <div class="row">
                            <div class="col-12">
                                <img src="../../resources/img/piscina.JPG" alt="#" class="img-fluid fit-images imagenTarjeta">
                            </div>
                        </div>
                        <!-- Fila para Información -->
                        <div class="row mt-2">
                            <div class="col-12 text-left">
                                <h1 class="letraTarjetaTitulo">PISCINA</h1>
                                <h1 class="letraTarjeta">Hora de inicio: <span class="letraDestacadaTarjeta">8:20</span></h1>
                            </div>
                        </div>
                        <!-- Fila para Boton -->
                        <div class="row">
                            <div class="col-12">
                                <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn btnTabla"><span class="fas fa-eye"></span></a>
                            </div>
                        </div>

                    <!-- Fin de Tarjeta -->
                    </div>
                </div>
                
                
            </div>
            <!-- Desde aqui finaliza el contenido -->
            <!-- Modal para Editar Visitas -->
            <div class="modal fade" id="editarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel">
                                <span class="fas fa-info-circle mr-4 iconoModal"></span>Agregar Alquiler</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <div class="row animate__animated animate__bounceIn">
                                <!-- Primera columna de controles -->
                                <div class="col-xl-7 col-md-7 col-sm-12 col-xs-12  centrarColumnas">
                                    <form id="EmpleadosColumna1">


                                        <label class="tituloCajaTextoFormulario" for="cbEspacio">Espacio:</label>
                                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                        deseado en el combobox  -->
                                        <div class="cbCitiger mb-2">
                                            <select class="custom-select">
                                                <option selected="">Seleccionar...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select> 
                                        </div>
            

                                        <label class="tituloCajaTextoFormulario mt-2" for="txtFechaAlquiler">Fecha de Alquiler:</label>
                                        <input type="date" class="form-control cajaTextoFormulario" id="txtFechaAlquiler"
                                            placeholder="AAAA-MM-DD">

                                    </form>

                                </div>

                                <!-- Segunda columna de controles -->
                                <div class="col-xl-5 col-md-5 col-sm-12 col-xs-12 centrarColumnas">
                                    <form>

                                        <!-- Controles -->
                                        <label class="tituloCajaTextoFormulario" for="txtHoraInicio">Hora inicio:</label>
                                        <input type="text" class="form-control cajaTextoFormularioHora" id="txtHoraInicio" placeholder="15:30">

                                        <label class="tituloCajaTextoFormulario" for="txtHorFin">Hora fin:</label>
                                        <input type="text" class="form-control cajaTextoFormularioHora" id="txtHorFin" placeholder="20:00">

                        
                                    </form>
                                </div>
                            </div>
                            <!-- Botones de Acción del Formulario -->
                            <div class="row justify-content-center mt-5">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnEditarFormulario">
                                        <span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>

                                    <a href="#" class="btn btnEditarFormulario">
                                        <span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</a>

                                    <a href="#" class="btn btnEditarFormulario">
                                        <span class="fas fa-trash mr-3 tamañoIconosBotones"></span>Eliminar</a>
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