<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitantes | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Visitantes</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarVisitante"
                        class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form class="mx-3 mb-2" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search"
                        aria-describedby="emailHelp" placeholder="{ Nombre, Apellido, Teléfono, Placa }">
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span
                            class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div
            class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DUI</th>
                            <th scope="col">Placa</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla --><br>
        <!-- Modal para Administrar Visitantes -->
        <div class="modal fade" id="administrarVisitante" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mr-4 iconoModal"></span>Visitantes</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Contenido del Modal-->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="administrarVisitante-form"  autocomplete="off">
                            <input type="number" name="idVisitante" id="idVisitante" class="d-none">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-xl-end justify-content-md-center">
                                    <div class="form-group">
                                        <label class="tituloCajaTextoFormulario" for="txtNombre">Nombres:</label>
                                        <input onchange="checkInputLetras('txtNombre')" type="text" class="form-control cajaTextoFormulario mb-3" id="txtNombre"
                                            name="txtNombre" placeholder="" maxlength="30">

                                        <label class="tituloCajaTextoFormulario" for="txtApellido">Apellidos:</label>
                                        <input onchange="checkInputLetras('txtApellido')" type="text" class="form-control cajaTextoFormulario" id="txtApellido"
                                            name="txtApellido" placeholder="" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-xl-start justify-content-md-center">
                                    <div class="form-group">
                                        <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                                        <input onchange="checkDui('txtDUI')" type="text" class="form-control cajaTextoFormulario mb-3" id="txtDUI"
                                            name="txtDUI" placeholder="12345678-9" maxlength="10">

                                        <label class="tituloCajaTextoFormulario" for="txtPlaca">Placa:</label>
                                        <input type="text" class="form-control cajaTextoFormulario" id="txtPlaca"
                                            name="txtPlaca" placeholder="P123 456" maxlength="8">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="form-group">
                                        <!-- RadioButtonGroup Género -->
                                        <h1 class="tituloCajaTextoFormulario mb-2">Género</h1>
                                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                            deseado en el combobox  -->
                                        <div class="cbCitiger">
                                            <select class="custom-select" id="cbGenero" name="cbGenero">
                                                <option selected="default">Seleccionar...</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                    <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                                </div>
                            </div>
                        </form>

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

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('visitantes.js');
?>