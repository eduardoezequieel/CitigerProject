<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Empleados | Citiger');
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
                <h1 class="tituloPagina">Empleados</h1>
            </div>
        </div>

        <div class="row animate__animated animate__bounceIn">
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <a href="#" data-toggle="modal" data-target="#administrarEmpleado" class="btn botonesListado"><span
                        class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search">
                <form>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp"
                        placeholder="Buscar...                                                                         &#xf002;">
                </form>
            </div>
        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div class="row animate__animated animate__bounceInUp">
            <div class="col-12">
                <h2 class="subTituloPagina text-center pb-2">Caseta</h2>
            </div>
        </div>
        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
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
                    <tbody>
                        <tr>
                            <!-- Fotografia-->
                            <th scope="row">
                                <div class="row paddingTh">
                                    <div class="col-12">
                                        <img src="../../resources/img/140025816_1267548823644856_116407320835883935_n.jpg" alt=""
                                            class="rounded-circle fit-images" width="30px" height="30px">
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->
                            <td>Eduardo Rivera</td>
                            <td>12345678-9</td>
                            <td>1111-2222</td>
                            <td>Activo</td>
                            <!-- Boton-->
                            <th scope="row">
                                <div class="row paddingBotones">
                                    <div class="col-12">
                                        <a href="#" data-toggle="modal" data-target="#administrarEmpleado" class="btn btnTabla mx-2"><i
                                                class="fas fa-edit"></i></a>

                                        <a href="#" class="btn btnTabla2 mx-2"><i
                                        class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla --><br>
        <!-- Desde aqui termina la tabla -->
        <div class="row animate__animated animate__bounceInUp">
            <div class="col-12">
                <h2 class="subTituloPagina text-center pb-2">Limpieza</h2>
            </div>
        </div>
        <div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
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
                    <tbody>
                        <tr>
                            <!-- Fotografia-->
                            <th scope="row">
                                <div class="row paddingTh">
                                    <div class="col-12">
                                        <img src="../../resources/img/140025816_1267548823644856_116407320835883935_n.jpg" alt=""
                                            class="rounded-circle fit-images" width="30px" height="30px">
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->
                            <td>Eduardo Rivera</td>
                            <td>12345678-9</td>
                            <td>1111-2222</td>
                            <td>Activo</td>
                            <!-- Boton-->
                            <th scope="row">
                                <div class="row paddingBotones">
                                    <div class="col-12">
                                        <a href="#" data-toggle="modal" data-target="#administrarEmpleado" class="btn btnTabla mx-2"><i
                                                class="fas fa-edit"></i></a>

                                        <a href="#" class="btn btnTabla2 mx-2"><i
                                        class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>

<!-- Modal para Administrar Empleados -->
<div class="modal fade" id="administrarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Empleados</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row">
                    <!-- Primera columna de controles -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                        <form id="EmpleadosColumna1">
                            <label class="tituloCajaTextoFormulario" for="txtNombres">Nombres:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtNombres"
                                placeholder="Escriba sus nombres...">

                            <label class="tituloCajaTextoFormulario" for="txtApellidos">Apellidos:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtApellidos"
                                placeholder="Escriba sus apellidos...">

                            <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" placeholder="12345678-9">

                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Teléfono:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtTelefono"
                                placeholder="0000-0000">
                                

                            <label class="tituloCajaTextoFormulario" for="txtCorreo">Correo Electrónico:</label>
                            <input type="text" class="form-control cajaTextoFormulario" id="txtCorreo"
                                placeholder="ejemplo@mail.com">

                            <!-- RadioButtonGroup Género -->
                            <h1 class="tituloCajaTextoFormulario mb-3">Género</h1>
                            <select class="form-control cajaTextoFormulario" id="cbGenero"
                                placeholder="Seleccionar..."></select>

                        </form>
                    </div>

                    <!-- Segunda columna de controles -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarColumnas">
                        <form>
                            <!-- Cargar Fotografia -->
                            <div class="row pl-5 my-4">
                                <div class="col">
                                    <div class="divFotografia">
                                        <div class="cargarFoto"></div>
                                        <button class="btn btnCargarFoto2 mx-2"><span class="fas fa-plus"></span></button>
                                    </div>
                                </div>
                                <!-- Final Cargar Fotografia -->
                            </div>

                            <!-- Controles -->
                            <label class="tituloCajaTextoFormulario" for="cbTipoEmpleado">Tipo de Empleado:</label>
                            <select class="form-control cajaTextoFormulario" id="cbTipoEmpleado"
                                placeholder="Seleccionar..."></select>

                            <label class="tituloCajaTextoFormulario" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control cajaTextoFormulario" id="txtFechaNacimiento"
                                placeholder="01-01-2000">

                            <label class="tituloCajaTextoFormulario" for="txtDireccion">Dirección:</label>
                            <textarea class="form-control cajaTextoFormulario" placeholder="Escriba su dirección..."
                                id="txtDireccion" rows="4"></textarea>
                        </form>
                    </div>
                </div>
                <!-- Botones de Acción del Formulario -->
                <div class="row justify-content-center mt-4">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button> 
                    </div>
                </div>
                <!-- Desde aqui finaliza el contenido -->
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>