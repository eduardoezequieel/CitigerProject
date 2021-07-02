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
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarMarcas" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form class="mx-3 mb-2" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Nombre de la marca }">
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center" id="tablaMarcas">
                <table class="table table-borderless citigerTable">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre de la marca</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla --><br>
        <!-- Modal para Administrar Marcas -->
        <div class="modal fade" id="administrarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Marcas</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="administrarMarcas-form">
                            <input type="number" name="idMarca" id="idMarca" class="d-none">

                            <label class="tituloCajaTextoFormulario" for="txtNombre">Nombre de la Marca:</label>
                            <input onchange="checkInputLetras('txtNombre')" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Escriba el nombre de la marca...">
                            <!-- Botones de Acción del Formulario -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                    <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>

                                </div>
                            </div>
                        </form>
                        <!-- Desde aqui finaliza el contenido -->
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->

        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('marcas.js');
?>