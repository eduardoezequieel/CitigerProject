<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
?>
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
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#seleccionarEspacio" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Solicitar</a>
                </div>
                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Espacio }  ">
                </form>

                <form method="post" id="filtrarEstadoAlquiler-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbEstadoAlquiler">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idEstadoAlquiler" id="idEstadoAlquiler" class="d-none">
                    <button class="d-none" id="btnFiltrarAlquiler" type="submit"></button>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

            </div>
            <br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp" id="show-tarjeta">


            </div>
            <!-- Desde aqui finaliza el contenido -->
            <!-- Modal para Administrar Alquileres -->
            <div class="modal fade" id="agregarAlquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres
                            </h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close closeModalButton lead" data-dismiss="modal" id="salir2" name="salir2" data-toggle="modal" data-target="#seleccionarEspacio" aria-label="Close">
                                <span aria-hidden="true" class="fas fa-chevron-left"></span>
                            </button>

                        </div>
                        <!-- Contenido del Modal -->
                        <div class="textoModal modal-body px-3 pb-4 mt-2">
                            <form method="post" id="alquiler-form" autocomplete="off">
                                <input type="number" name="idAlquiler" id="idAlquiler" class="d-none">
                                <input type="number" name="idEspacio" id="idEspacio" class="d-none">
                                <div class="row justify-content-center">
                                    <div class="col col-xl-6 col-md-6 col-sm-12 col-xs-12 align-items-center">

                                        <label class="tituloCajaTextoFormulario mt-2" for="txtFecha">Fecha de alquiler:</label>
                                        <input type="date" class="form-control cajaTextoModal" onchange="checkInput('txtFecha')" id="txtFecha" name="txtFecha" placeholder="AAAA-MM-DD" Required>

                                        <label class="tituloCajaTextoFormulario mt-2" for="txtHoraInicio">Hora inicio:</label>
                                        <input type="time" class="form-control cajaTextoModal" onchange="checkInputHora('txtHoraInicio','txtHoraFin')" id="txtHoraInicio" name="txtHoraInicio" min="00:00" max="23:59" placeholder="HH:MM" onchange="checkInput('txtHoraInicio')" Required>
                                        <label class="tituloCajaTextoFormulario mt-2" for="txtHoraFin">Hora Fin:</label>
                                        <input type="time" class="form-control cajaTextoModal" onchange="checkInputHora('txtHoraInicio','txtHoraFin')" id="txtHoraFin" name="txtHoraFin" min="00:00" max="23:59" placeholder="HH:MM" onchange="checkInput('txtHoraFin')" Required>


                                        <h1 class="tituloDato2 text-center mt-3" id="tituloEspacio">Espacio Seleccionado:</h1>
                                        <h1 class="campoDato text-center" id="lblEspacio2">Cancha</h1>


                                    </div>

                                </div>
                                <div class="row justify-content-center mt-2">
                                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                        <button type="submit" id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                        <button type="submit" id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                                        <a id="btnCancelar" class="btn btnAgregarFormularioResident mr-2"><span class="fas fa-times mr-3 tamañoIconosBotones"></span>Cancelar</a>
                                    </div>
                                </div>
                            </form>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
        </div>

        <!-- Modal para seleccionar un lugar de alquiler -->
        <div class="modal fade" id="seleccionarEspacio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccionar espacio</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Contenido del Modal -->
                    <div class="textoModal modal-body px-3 pb-4 mt-2">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="tituloDato2">Selecciona espacio para el alquiler</h1>
                            </div>
                        </div>
                        <form method="post" id="seleccionarEspacio-form" autocomplete="off">

                            <div class="row justify-content-center" id="espacios">


                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->

        <!-- Modal para ver denuncias-->
        <div class="modal fade" id="verAlquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres</h5>
                        <!-- Boton para Cerrar -->
                        <a type="button" class="close closeModalButton lead" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="verAlquiler-form">
                            <input type="number" class="d-none" id="idAlquiler2" name="idAlquiler2">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">


                                    <h1 class="tituloDato text-center">Fecha</h1>
                                    <h1 class="campoDato text-center mb-3" id="lblFecha">11/6/2021</h1>

                                    <h1 class="tituloDato text-center">Estado</h1>
                                    <h1 class="campoDato text-center mb-3" id="lblEstado">Activo</h1>

                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <h1 class="tituloDato text-center">Hora de inicio</h1>
                                    <h1 class="campoDato text-center mb-3" id="lblInicio">10:00</h1>

                                    <h1 class="tituloDato text-center">Hora fin</h1>
                                    <h1 class="campoDato text-center mb-3" id="lblFin">11:08</h1>



                                </div>

                            </div>
                        </form>
                        <br>
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Final del contenido -->

    <?php
    //Se imprimen los JS necesarios
    admin_Page::footerTemplate('alquileres.js');
    ?>