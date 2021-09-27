<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
    <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

<!-- Desde aqui comienza el contenido -->
<div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <h1 class="tituloPagina">Visitas</h1>
    </div>
</div>

<div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
        <form class="mx-3 mb-2" method="post" id="search-form">
            <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
            <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Residente, Visitante }">
        </form>

        <div class="mt-4 mx-3 mb-3">
            <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
        </div>
    </div>

</div><br>
<!-- Desde aqui comienza la tabla -->
<div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
    <div class="col-12 justify-content-center align-items-center text-center">
        <table class="table table-borderless citigerTable" id="data-table">
            <thead>
                <!-- Columnas-->
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Residente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Visitante</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tbody-rows">

            </tbody>
        </table>
    </div>
</div>
<!-- Desde aqui termina la tabla --><br>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('visitas.js');
?>