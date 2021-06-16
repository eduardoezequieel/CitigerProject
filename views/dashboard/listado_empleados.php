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

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarEmpleado" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>
                    
                <form class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                </form>   

                <form class="mx-3">
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
                </form>
            </div>
            
        </div><br>
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
                            <th scope="col">Tipo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        <tr class="animate__animated animate__fadeIn">
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
                            <td>Limpieza</td>
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
                <form method="post" id="administrarEmpleado-form">
                    <div class="row">
                        <!-- Primera columna de controles -->
                        <div class="col-xl-6 mb-4 col-md-12 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                            <div class="#" id="EmpleadosColumna1">
                                <label class="tituloCajaTextoFormulario" for="txtNombre">Nombres:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtNombre" name="txtNombre"
                                    placeholder="Escriba sus nombres...">

                                <label class="tituloCajaTextoFormulario" for="txtApellido">Apellidos:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtApellido" name="txtApellido"
                                    placeholder="Escriba sus apellidos...">

                                <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtDUI" name="txtDUI" placeholder="12345678-9">

                                <label class="tituloCajaTextoFormulario" for="txtTelefono">Teléfono:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtTelefono" name="txtTelefono"
                                    placeholder="0000-0000">
                                    

                                <label class="tituloCajaTextoFormulario" for="txtCorreo">Correo Electrónico:</label>
                                <input type="text" class="form-control cajaTextoFormulario" id="txtCorreo" name="txtCorreo"
                                    placeholder="ejemplo@mail.com">

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
                                        <button type="submit" class="btn btnCargarFoto2 mx-2" id="botonFoto"><span class="fas fa-plus" ></span></button>
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
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> 
                                </div>

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control cajaTextoFormulario" id="txtFechaNacimiento" name="txtFechaNacimiento"
                                    placeholder="01-01-2000">

                                <label class="tituloCajaTextoFormulario" for="txtDireccion">Dirección:</label>
                                <textarea class="form-control cajaTextoFormulario" placeholder="Escriba su dirección..." id="txtDireccion" name="txtDireccion" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button href="#" id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
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

<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('empleados.js');
?>