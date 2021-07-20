<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Administradores | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Administradores</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarAdmin" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>

                </div>

                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{Nombre, Apellido, Usuario, DUI}                                                                          &#xf002;">
                </form>

                <form method="post" id="filtrarTipoEmpleado-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Tipo:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                    cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                    deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbTipoEmpleado">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idTipoEmpleado" id="idTipoEmpleado" class="d-none">
                    <button class="d-none" id="btnFiltrarEmpleado" type="submit"></button>
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
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->
<!-- Modal para Administrar Administradores -->
<div class="modal fade" id="administrarAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Administradores</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="administrarEmpleado-form">
                    <input class="d-none" type="number" id="txtId" name="txtId" />
                    <input class="d-none" type="text" id="txtContrasenia" name="txtContrasenia" />
                    <div class="row animate__animated animate__bounceIn">
                        <!-- Primera columna de controles -->
                        <div class="col-xl-6 mb-4 col-md-12 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                            <div class="#" id="EmpleadosColumna1">
                                <label class="tituloCajaTextoFormulario" for="txtNombre">Nombres:</label>
                                <input onchange="checkInputLetras('txtNombre')" type="text" class="form-control cajaTextoFormulario" id="txtNombre" name="txtNombre" placeholder="Escriba sus nombres..." Required>

                                <label class="tituloCajaTextoFormulario" for="txtApellido">Apellidos:</label>
                                <input onchange="checkInputLetras('txtApellido')" type="text" class="form-control cajaTextoFormulario" id="txtApellido" name="txtApellido" placeholder="Escriba sus apellidos..." Required>

                                <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                                <input onchange="checkDui('txtDUI')" type="text" class="form-control cajaTextoFormulario" id="txtDUI" name="txtDUI" placeholder="12345678-9" Required>

                                <div class="row">
                                    <div class="col-6 ">
                                        <label class="tituloCajaTextoFormulario" for="txtTelefonofijo">Teléfono
                                            Fijo:</label>
                                        <input onchange="checkTelefono('txtTelefonofijo')" type="text" class="form-control cajaTextoFormularioTelefono" id="txtTelefonofijo" name="txtTelefonofijo" placeholder="0000-0000" Required>

                                    </div>

                                    <div class="col-6 ">
                                        <label class="tituloCajaTextoFormulario" for="txtTelefonomovil">Teléfono
                                            Movil:</label>
                                        <input onchange="checkTelefono('txtTelefonomovil')" type="text" class="form-control cajaTextoFormularioTelefono" id="txtTelefonomovil" name="txtTelefonomovil" placeholder="0000-0000"Required>
                                    </div>

                                </div>


                                <label class="tituloCajaTextoFormulario" for="txtCorreo">Correo Electrónico:</label>
                                <input onchange="checkCorreo('txtCorreo')" type="text" class="form-control cajaTextoFormulario" id="txtCorreo" name="txtCorreo" placeholder="ejemplo@mail.com" Required>

                                <label class="tituloCajaTextoFormulario" for="txtUsuario">Nombre de usuario:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtUsuario" name="txtUsuario" placeholder="Escriba su nombre de usuario" Required>

                                <!-- RadioButtonGroup Género -->
                                <h1 class="tituloCajaTextoFormulario mb-2">Género</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger">
                                    <select class="custom-select" id="cbGenero" name="cbGenero">
                                        <option selected="">Seleccionar...</option>
                                        <option value="F">Masculino</option>
                                        <option value="M">Femenino</option>
                                    </select>
                                </div>
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
                                        <button type="submit" class="btn btnCargarFoto2 mx-2" id="botonFoto"><span class="fas fa-plus"></span></button>
                                    </div>
                                    <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
                                </div>

                                <!-- Controles -->
                                <label class="tituloCajaTextoFormulario" for="cbTipoEmpleado2">Tipo de Empleado:</label>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger w-75">
                                    <select class="custom-select" id="cbTipoEmpleado2" name="cbTipoEmpleado2">
                                        <option selected="">Seleccionar...</option>
                                    </select>
                                </div>

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de
                                    Nacimiento:</label>
                                <input type="date" class="form-control cajaTextoFormulario" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="01-01-2000" Required>

                                <label class="tituloCajaTextoFormulario" for="txtDireccion">Dirección:</label>
                                <textarea class="form-control cajaTextoFormulario" placeholder="Escriba su dirección..." id="txtDireccion" name="txtDireccion" rows="4"Required ></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                            <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                            <button id="btnSuspender" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                            <button id="btnActivar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>
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

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('administradores.js');
?>