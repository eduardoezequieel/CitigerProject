<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Visitas</h1>
            </div>
        </div>
        <!-- Controles del Inicio -->
        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">  
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnNew" data-toggle="modal" data-target="#modal1" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Nuevo</a>
                </div>
                <form class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                </form>           
            </div>
        </div><br>

        <div class="row">
            <div class="col-12">
                <h1 class="tituloDato2 text-center">Historial de Visitas</h1>
            </div>
        </div>

        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col">Visitante</th>
                            <th scope="col">Estado de la Visita</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        <tr class="animate__animated animate__fadeIn">
                            <!-- Datos-->   
                            <td>Disturbio</td>
                            <td>Pendiente</td>
                            <td>1/7/2021</td>
                            <!-- Boton-->
                            <th scope="row">
                                <div class="row paddingBotones">
                                    <div class="col-12">
                                        <a href="#" data-toggle="modal" data-target="#administrarDenunciaPendiente" class="btn btnTabla"><i class="fas fa-info-circle"></i></a>

                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        
    </div>

</div>
<!-- Final del contenido -->

<!-- primer modal -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccionar</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="tituloDato2 text-center">¿La persona que desea visitarlo ya está registrado en el sistema?</h1>
                    </div>
                </div>
                <!-- Menú -->
                <div class="row">
                    <!-- Opción "alquiler" de menú -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="#" class="btn botonMenu1">
                            <i class="fas fa-thumbs-up iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Si</label>
                        </a>
                    </div>

                    <!-- Opción "espacios" de menú -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="#" class="btn botonMenu2">
                            <i class="fas fa-thumbs-down iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">No</label>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>