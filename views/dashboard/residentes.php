<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Residentes | Citiger');
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
                <h1 class="tituloPagina">Residentes</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarResidente"
                        class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form class="mx-3 mb-2" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search"
                        aria-describedby="emailHelp" placeholder="{ Nombre, Apellido, DUI, Teléfono }">
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
                <table class="table table-borderless citigerTable">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DUI</th>
                            <th scope="col">Telefono</th>
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
        <!-- Modal para Administrar Empleados -->
        <div class="modal fade" id="administrarResidente" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mr-4 iconoModal"></span>Residentes</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="administrarResidente-form">
                            <input type="number" name="idResidente" id="idResidente" class="d-none">
                            <div class="row">
                                <!-- Primera columna de controles -->
                                <div
                                    class="col-xl-6 mb-4 col-md-12 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                                    <div class="#" id="ResidentesColumna1">
                                        <label class="tituloCajaTextoFormulario" for="txtNombre">Nombres:</label>
                                        <input onchange="checkInputLetras('txtNombre')" type="text"
                                            class="form-control cajaTextoFormulario" id="txtNombre" name="txtNombre"
                                            placeholder="Escriba sus nombres...">

                                        <label class="tituloCajaTextoFormulario" for="txtApellido">Apellidos:</label>
                                        <input type="text" onchange="checkInputLetras('txtApellido')"
                                            class="form-control cajaTextoFormulario" id="txtApellido" name="txtApellido"
                                            placeholder="Escriba sus apellidos...">

                                        <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                                        <input type="text" onchange="checkDui('txtDUI')"
                                            class="form-control cajaTextoFormulario" id="txtDUI" name="txtDUI"
                                            placeholder="12345678-9">

                                        <div class="row">
                                            <div class="col-6 ">
                                                <label class="tituloCajaTextoFormulario" for="txtTelefonofijo">Teléfono
                                                    Fijo:</label>
                                                <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                    id="txtTelefonofijo" name="txtTelefonofijo" placeholder="0000-0000">

                                            </div>

                                            <div class="col-6 ">
                                                <label class="tituloCajaTextoFormulario" for="txtTelefonomovil">Teléfono
                                                    Movil:</label>
                                                <input type="text" class="form-control cajaTextoFormularioTelefono"
                                                    id="txtTelefonomovil" name="txtTelefonomovil"
                                                    placeholder="0000-0000">
                                            </div>

                                        </div>


                                        <label class="tituloCajaTextoFormulario" for="txtCorreo">Correo
                                            Electrónico:</label>
                                        <input type="text" onchange="checkCorreo('txtCorreo')"
                                            class="form-control cajaTextoFormulario" id="txtCorreo" name="txtCorreo"
                                            placeholder="ejemplo@mail.com">
                                    </div>
                                </div>

                                <!-- Segunda columna de controles -->
                                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                                    <div class="form-group">
                                        <!-- Cargar Fotografia -->
                                        <div class="d-flex justify-content-center align-items-center mb-4">
                                            <div class="bordeDivFotografia mb-1">
                                                <div class="divFotografia" id="divFoto">
                                                    <!--<img src="../../resources/img/67641302_948622395468919_4792483860753416192_n.jpg" alt="#" class="fit-images rounded-circle" width="150px">-->
                                                </div>
                                            </div>
                                            <div id="btnAgregarFoto">
                                                <button type="submit" class="btn btnCargarFoto2 mx-2"
                                                    id="botonFoto"><span class="fas fa-plus"></span></button>
                                            </div>
                                            <input id="archivo_residente" type="file" class="d-none"
                                                name="archivo_residente" accept=".gif, .jpg, .png">
                                        </div>

                                        <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de
                                            Nacimiento:</label>
                                        <input type="date" class="form-control cajaTextoFormulario"
                                            id="txtFechaNacimiento" name="txtFechaNacimiento" value="2000-01-01">

                                        <label class="tituloCajaTextoFormulario" for="txtUser">Nombre de Usuario:</label>
                                        <input type="text" onchange="checkInputLetras('txtUser')"
                                            class="form-control cajaTextoFormulario" id="txtUser" name="txtUser"
                                            placeholder="Escriba su nombre de usuario...">

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
                            <!-- Botones de Acción del Formulario -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                    <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                                    <button id="btnSuspender" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                                    <button id="btnActivar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>

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

<!-- Modal para asignar casa a residente -->
<div class="modal fade" id="casaResidente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Casas</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-12">
                        <h1 class="tituloDato text-center">Casa del Residente:</h1>
                        <h1 class="campoDato text-center">Sin asignar</h1>
                    </div>
                </div>
                <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                    <div class="col-xl-12 d-flex flex-column justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                        <form class="mx-3 mb-2" method="post" id="search-form">
                            <h1 class="tituloCajaTextoFormulario">Número de Casa:</h1>
                            <input type="number" class="form-control buscador" id="search" name="search"
                                aria-describedby="emailHelp" placeholder="{ Número }">
                        </form>
                        <form class="mx-3 mb-2" method="post" id="search-form">
                            <h1 class="tituloCajaTextoFormulario">Dirección:</h1>
                            <input type="text" class="form-control buscador" id="search" name="search"
                                aria-describedby="emailHelp" placeholder="{ Dirección }">
                        </form>
                    </div>

                </div><br>
                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-3 justify-content-center table-responsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Número de Casa</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows">
                                <tr>
                                    <td>1</td>
                                    <td>Tu mama</td>
                                    <!-- Boton-->
                                    <th scope="row">
                                        <div class="row paddingBotones">
                                            <div class="col-12">
                                                <a href="#" class="btn btnTabla mx-2"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Desde aqui termina la tabla --><br>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->



<!-- Final del contenido -->



<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('residentes.js');
?>