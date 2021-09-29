<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Dashboard | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <?php
                Admin_Page::welcomeMessage();
            ?>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-5">
            <div class="col justify-content-center text-center d-flex">
                <h1 class="tituloMenu">¿Cómo desea verificar la visita?</h1>
            </div>
        </div>

        <div class="row pb-5 animate__animated animate__backInDown">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                <button type="button" data-toggle="modal" data-target="#verificarDui" class="btn botonMenu1">
                    <i class="fas fa-id-card iconosBotonesMenu"></i>
                    <label class="textoBotonesMenu">DUI</label>
                </button>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                <button data-toggle="modal" data-target="#verificarPlaca" class="btn botonMenu2 float-left">
                    <i class="fas fa-car-side iconosBotonesMenu"></i>
                    <label class="textoBotonesMenu">Placa</label>
                </button>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <h1 class="tituloMenu text-white text-center">Datos Recientes</h1>
            </div>
        </div>



        <div class="row justify-content-center animate__animated animate__backInUp">
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <div class="tarjetaDashboard">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-haspopup="true" aria-expanded="false"><span
                                        class="fas fa-ellipsis-v"></span></button>
                                <div class="dropdown-menu animate__animated animate__bounceIn mt-5"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Generar Reporte</a>
                                    <a class="dropdown-item" href="visitas.php">Visitas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <i class="fas fa-car-side icono2"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                            <h1 class="tituloTarjetaDashboard">Visitas<br>Vigentes</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtVisitas">90</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desde aqui finaliza el contenido -->

        </div>

    </div>
    <!-- Final del contenido -->

    <!-- Modal para verificar mediante DUI una visita -->
    <div class="modal fade" id="verificarDui" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>Verificar DUI</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="textoModal modal-body px-3 pb-4">
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <i class="fas fa-id-card icono5"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="tituloDato2">Ingrese el DUI del visitante para verificar la información.</h1>
                        </div>
                    </div>
                    <form id="verificarDui-form" autocomplete="off">
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="form-group">
                                    <label class="tituloCajaTextoFormulario" for="txtDuiVerificar">DUI:</label>
                                    <input type="text" onchange="checkDui('txtDui')"
                                        class="form-control cajaTextoFormulario" id="txtDui"
                                        name="txtDui" data-inputmask="'txtDui': 'phonebe'" placeholder="00000000-0" maxlength="10" Required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btnAgregarFormulario mr-2"><span
                                        class="fas fa-check mr-3 tamañoIconosBotones"></span>Verificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

    <!-- Modal para verificar mediante placa una visita -->
    <div class="modal fade" id="verificarPlaca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>Verificar Placa</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="textoModal modal-body px-3 pb-4">
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <i class="fas fa-car-side icono5"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="tituloDato2  ">Ingrese la placa del visitante para verificar la información.</h1>
                        </div>
                    </div>
                    <form id="verificarPlaca-form" autocomplete="off">
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="form-group">
                                    <label class="tituloCajaTextoFormulario" for="txtPlacaVerificar">Placa:</label>
                                    <input type="text"
                                        class="form-control cajaTextoFormulario" id="txtPlaca"
                                        name="txtPlaca" placeholder="P000 000" onchange="checkInput('txtPlaca')" Required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button  type="submit" class="btn btnAgregarFormulario mr-2"><span
                                        class="fas fa-check mr-3 tamañoIconosBotones"></span>Verificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

    <!-- Modal que muestra la info de la visita -->
    <div class="modal fade" id="infoVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>Información de la Visita</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="textoModal modal-body px-3 pb-4">
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <i class="fas fa-calendar-day icono5"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <h1 class="tituloDato2">El registro corresponde a: </h1>
                        </div>
                    </div>
                    <form id="info-form" autocomplete="off">
                        <input type="number" class="form-control cajaTextoDUI d-none" id="txtVisita" name="txtVisita">
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <!-- Titulo -->
                                    <h1 class="tituloInformacion">Residente</h1>
                                    <!-- Información -->
                                    <h2 class="informacion" id="lblResidente">Eduardo Rivera</h2>
                                </div>
                                <div class="form-group">
                                    <!-- Titulo -->
                                    <h1 class="tituloInformacion">Fecha</h1>
                                    <!-- Información -->
                                    <h2 class="informacion" id="lblFecha">27/9/2021</h2>
                                </div>
                                <div class="form-group">
                                    <!-- Titulo -->
                                    <h1 class="tituloInformacion">Visitante</h1>
                                    <!-- Información -->
                                    <h2 class="informacion" id="lblVisitante">Katherine Gonzalez</h2>
                                </div>
                                <div class="form-group">
                                    <!-- Titulo -->
                                    <h1 class="tituloInformacion">Casa</h1>
                                    <!-- Información -->
                                    <h2 class="informacion" id="lblCasa">#1</h2>
                                </div>
                                <div class="form-group">
                                    <!-- Titulo -->
                                    <h1 class="tituloInformacion">Observación</h1>
                                    <!-- Información -->
                                    <h2 class="informacion" id="lblObservacion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ducimus cupiditate, asperiores non praesentium doloribus suscipit cum hic culpa sint laudantium enim debitis unde. Mollitia sunt expedita aperiam ducimus consectetur.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btnAgregarFormulario mr-2"><span
                                        class="fas fa-check mr-3 tamañoIconosBotones"></span>Confirmar visita</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

    <?php
//Se imprimen los JS necesarios
Admin_Page::footerTemplate('dashboard.js');
?>