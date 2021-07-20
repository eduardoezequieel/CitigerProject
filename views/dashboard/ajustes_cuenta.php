<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Ajustes | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        <!-- Desde aqui comienza el contenido -->

        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="contenedorMiCuenta">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h1 class="tituloPagina text-center">Mi Cuenta</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center">
                            <form method="post" id="img-form">
                                <!-- Cargar Fotografia -->
                                <div class="row">
                                    <div class="col">
                                        <div class="divFotografiaAjustes">
                                            <div class="bordeDivFotografia mb-1">
                                                <div id="divFoto">
                                                </div>
                                            </div>
                                            <div id="btnAgregarFoto">
                                                <button class="btn btnCargarFoto2"><span class="fas fa-plus"></span></button>
                                            </div>
                                            <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
                                            <button class="d-none" id="btnUpload" type="submit"></button>
                                            <h1 id="nombres" class="tituloUsuario mt-3"></h1>
                                        </div>
                                    </div>
                                    <!-- Final Cargar Fotografia -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sección para cambiar información personal -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h1 class="tituloTarjetaAjustes">Información Personal</h1>

                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <!-- Div especializado para cada sección -->
                            <div class="informacionPersonal">
                                <div class="row justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <!-- Titulo -->
                                            <h1 class="tituloInformacion">Nombres</h1>
                                            <!-- Información -->
                                            <h2 class="informacion" id="lblNombres"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Apellidos</h1>
                                            <h2 class="informacion" id="lblApellidos"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">DUI</h1>
                                            <h2 class="informacion" id="lblDUI"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Genéro</h1>
                                            <h2 class="informacion" id="lblGenero"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Teléfono Fijo</h1>
                                            <h2 class="informacion" id="lblTelFijo"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Teléfono Celular</h1>
                                            <h2 class="informacion" id="lblTelCelular"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Fecha de Nacimiento</h1>
                                            <h2 class="informacion" id="lblFechaNac"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <a href="#" id="btnEditarAjustes" onclick="readDataOnModal()" data-toggle="modal" data-target="#administrarCuenta" class="btn botonesAjustes">Editar</a>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sección para administrar ajustes de la cuenta (mismo formato de arriba) -->
                    <div class="row mt-4">
                        <div class="col">
                            <h1 class="tituloTarjetaAjustes">Ajustes de la Cuenta</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="informacionPersonal">
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Usuario</h1>
                                        <h2 class="informacion" id="lblUser"></h2>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn botonesAjustes">Editar</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Correo Electrónico</h1>
                                        <h2 class="informacion" id="lblCorreo"></h2>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn botonesAjustes">Editar</a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Contraseña</h1>
                                        <h2 class="informacion">*********</h2>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn botonesAjustes">Cambiar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Desde aqui finaliza el contenido -->
    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar informacion personal -->
<!-- Modal para Administrar informacion personal -->
<div class="modal fade" id="administrarCuenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Editar información</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="admin-form">

                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="tituloCajaTextoFormulario mt-2" for="txtNombres">Nombres:</label>
                            <input onchange="checkInputLetras('txtNombres')" type="text" class="form-control cajaTextoModal" id="txtNombres" name="txtNombres" placeholder="">

                            <label class="tituloCajaTextoFormulario " for="txtApellidos">Apellidos:</label>
                            <input onchange="checkInputLetras('txtApellidos')" type="text" class="form-control cajaTextoModal" id="txtApellidos" name="txtApellidos" placeholder="">

                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                            <h1 class="tituloCajaTextoFormulario mb-2">Género</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                            <div class="cbCitiger w-20 col-md-12" id="cbCitiger">
                                <select class="custom-select" id="cbGenero" name="cbGenero">
                                    <option selected="">Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control cajaTextoModal" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="">

                                <label class="tituloCajaTextoFormulario " for="txtTelefonoFijo">Teléfono Fijo:</label>
                                <input onchange="checkTelefono('txtTelefonoFijo')" type="text" class="form-control cajaTextoModal" id="txtTelefonoFijo" name="txtTelefonoFijo" placeholder="">

                                <label class="tituloCajaTextoFormulario" for="txtTelefonomovil">Teléfono Movil:</label>
                                <input onchange="checkTelefono('txtTelefonomovil')" type="text" class="form-control cajaTextoModal" id="txtTelefonomovil" name="txtTelefonomovil" placeholder="">

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col col-xl-6 col-md-6 col-sm-12 col-xs-12 align-items-center">
                            <label class="tituloCajaTextoFormulario" for="txtDUI">DUI</label>
                            <input input onchange="checkDUI('txtDUI')" type="text" class="form-control cajaTextoModal" id="txtDUI" name="txtDUI" placeholder="">
                        </div>

                    </div>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnActualizar" type="submit" name="btnActualizar" href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('ajustes_cuenta.js');
?>
